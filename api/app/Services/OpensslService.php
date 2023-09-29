<?php

namespace App\Services;
class OpensslService
{
    public function generatePrivateKey($keySize = 4096): string
    {
        $privateKey = openssl_pkey_new([
            "private_key_bits" => $keySize,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        ]);
        openssl_pkey_export($privateKey, $privateKeyString);
        return $privateKeyString;
    }

    public function generateSelfSignedCertificate($data): array
    {
        $privateKey = $this->generatePrivateKey();

        $certificate = openssl_csr_new(array(
            "countryName" => $data['country_name'],
            "stateOrProvinceName" => $data['state_or_province_name'],
            "localityName" => $data['locality_name'],
            "organizationName" => $data['organization'],
            "organizationalUnitName" => $data['organization_unit'],
            "commonName" => $data['common_name'],
        ), $privateKey);

        $certificate = openssl_csr_sign($certificate, null, $privateKey, $data['validity_days']);
        $sha256_fingerprint = openssl_x509_fingerprint($certificate, "sha256");
        $sha1_fingerprint = openssl_x509_fingerprint($certificate, "sha1");
        openssl_x509_export($certificate, $certificateString);
        return [
                "private_key" => $privateKey,
                "public_key" => $certificateString,
                "fingerprints" => [
                    "sha256" => $sha256_fingerprint,
                    "sha1" => $sha1_fingerprint,
                ],
            ];
    }

    public function generateCertificateSigningRequest(): string
    {
        $privateKey = $this->generatePrivateKey();
        $csr = openssl_csr_new(array(
            "countryName" => "FR",
            "stateOrProvinceName" => "TODO",
            "localityName" => "TODO",
            "organizationName" => "TODO",
            "organizationalUnitName" => "test",
            "commonName" => "TODO.fr",
        ), $privateKey);
        openssl_csr_export($csr, $csrString);
        return $csrString;
    }

    public function signCertificateSigningRequest($csr, $authority, $authorityKey): string
    {
        $authorityKey = openssl_pkey_get_private($authorityKey);
        $certificate = openssl_csr_sign($csr, $authority, $authorityKey, 365);
        openssl_x509_export($certificate, $certificateString);
        return $certificateString;
    }

}
