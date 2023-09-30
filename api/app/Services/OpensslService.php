<?php

namespace App\Services;
class OpensslService
{
    public function createPrivateKey(int $keySize = 4096): \OpenSSLAsymmetricKey
    {
        return openssl_pkey_new([
                "private_key_bits" => $keySize,
                "private_key_type" => OPENSSL_KEYTYPE_RSA,]
        );
    }

    public function createSelfSignedCertificate(array $data,\OpenSSLAsymmetricKey $privateKey): false | \OpenSSLCertificate
    {
        $certificate = openssl_csr_new(
            [
                "commonName" => $data['common_name'],
                "countryName" => $data['country_name'],
                "organizationName" => $data['organization'],
                "organizationalUnitName" => $data['organization_unit'],
                "stateOrProvinceName" => $data['state_or_province_name'],
                "localityName" => $data['locality_name'],
            ]
            , $privateKey);

        return openssl_csr_sign($certificate, null, $privateKey, $data['validity_days']);
    }

    public function createCertificateSigningRequest(array $data,\OpenSSLAsymmetricKey $privateKey): false | \OpenSSLCertificateSigningRequest
    {
        return openssl_csr_new(
            [
                "commonName" => $data['common_name'],
                "countryName" => $data['country_name'],
                "organizationName" => $data['organization'],
                "organizationalUnitName" => $data['organization_unit'],
                "stateOrProvinceName" => $data['state_or_province_name'],
                "localityName" => $data['locality_name'],
            ]
            , $privateKey);
    }

    public function signCertificateSigningRequest(
        \OpenSSLCertificateSigningRequest $csr,
        \OpenSSLCertificate $authority,
        \OpenSSLAsymmetricKey $authorityKey,
        int $validityDays)
    : false | \OpenSSLCertificate
    {
        $authString = $this->exportCertificate($authority)['public_key'];
        $csrString = $this->exportCertificateSigningRequest($csr);
        $authPrivateKeyString = $this->exportPrivateKey($authorityKey);

        $csrFile = tempnam(sys_get_temp_dir(), 'csr_');
        $authFile = tempnam(sys_get_temp_dir(), 'auth_');
        $authKeyFile = tempnam(sys_get_temp_dir(), 'auth_key_');

        file_put_contents($csrFile, $csrString);
        file_put_contents($authFile, $authString);
        file_put_contents($authKeyFile, $authPrivateKeyString);

        $out = shell_exec("openssl x509 -req \
            -in $csrFile \
            -CA $authFile \
            -CAkey $authKeyFile \
            -CAcreateserial \
            -days $validityDays \
            -sha256"
        );

        unlink($csrFile);
        unlink($authFile);
        unlink($authKeyFile);

        return openssl_x509_read($out);
    }

    public function exportCertificate(\OpenSSLCertificate $certificate): array
    {
        $sha256_fingerprint = openssl_x509_fingerprint($certificate, "sha256");
        $sha1_fingerprint = openssl_x509_fingerprint($certificate, "sha1");
        openssl_x509_export($certificate, $certificateString);

        return [
            "public_key" => $certificateString,
            "fingerprints" => [
                "sha256" => $sha256_fingerprint,
                "sha1" => $sha1_fingerprint,
            ],
        ];
    }

    public function exportCertificateSigningRequest(\OpenSSLCertificateSigningRequest $csr): string
    {
        openssl_csr_export($csr, $csrString);
        return $csrString;
    }

    public function exportPrivateKey(\OpenSSLAsymmetricKey $privateKey): string
    {
        openssl_pkey_export($privateKey, $privateKeyString);
        return $privateKeyString;
    }

    public function readPrivateKey(string $privateKey): \OpenSSLAsymmetricKey
    {
        return openssl_pkey_get_private($privateKey);
    }

    public function readCertificate(string $certificateString): \OpenSSLCertificate
    {
        return openssl_x509_read($certificateString);
    }

}
