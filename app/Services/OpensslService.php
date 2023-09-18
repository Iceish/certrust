<?php

namespace App\Services;
use App\Models\Certificate;

class OpensslService
{
    public function generatePrivateKey($keySize = 4096){
        $privateKey = openssl_pkey_new(array(
            "private_key_bits" => $keySize,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        ));
        $privateKey = openssl_pkey_export($privateKey, $privateKeyString);
        return($privateKeyString);
    }

    public function viewCertificate($certificate){
        $certificate = openssl_x509_read($certificate);
        $certificateData = openssl_x509_parse($certificate);
        return($certificateData);
    }

    public function generateSelfSignedCertificate($data){
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
        return(array(
            "private_key" => $privateKey,
            "public_key" => $certificateString,
            "fingerprints" => array(
                "sha256" => $sha256_fingerprint,
                "sha1" => $sha1_fingerprint,
            ),
            ));
        }

    public function generateCertificateSigningRequest(){
        $privateKey = $this->generatePrivateKey();
        $csr = openssl_csr_new(array(
            "countryName" => "FR",
            "stateOrProvinceName" => "Ile de France",
            "localityName" => "Paris",
            "organizationName" => "LCV",
            "organizationalUnitName" => "test",
            "commonName" => "test.lacroixverte.fr",
        ), $privateKey);
        openssl_csr_export($csr, $csrString);
        return($csrString);
    }

    public function signCertificateSigningRequest($csr, $authority, $authorityKey){
        $authorityKey = openssl_pkey_get_private($authorityKey);
        $authorityData = openssl_x509_parse($authority);
        $certificate = openssl_csr_sign($csr, $authority, $authorityKey, 365);
        openssl_x509_export($certificate, $certificateString);
        return($certificateString);
    }

    public function authorityStatistic(Certificate $certificate): array
    {
        $nbSubCertificates = $certificate->certificates()->count();
        $result = [
            "certificates" => 0,
            "certificates_expired" => 0,
            "sub_ca" => 0,
            "sub_ca_expired" => 0
        ];
        if($nbSubCertificates == 0){
            $result["certificates"] = 1;
            $result["certificates_expired"] = $certificate->hasExpired() ? 1 : 0;
        }else if($certificate->issuer !== $certificate->id){
            $result["sub_ca"] = 1;
            $result["sub_ca_expired"] = $certificate->hasExpired() ? 1 : 0;
        }

        foreach($certificate->certificates as $subCertificate){
            if($subCertificate->id === $certificate->id) continue;
            $subCertificateStatistic = $this->authorityStatistic($subCertificate);
            $result["certificates"] += $subCertificateStatistic["certificates"];
            $result["certificates_expired"] += $subCertificateStatistic["certificates_expired"];
            $result["sub_ca"] += $subCertificateStatistic["sub_ca"];
            $result["sub_ca_expired"] += $subCertificateStatistic["sub_ca_expired"];
        }
        return $result;
    }

}
