<?php

namespace App\Services;
class OpensslService
{
    public function generatePrivateKey(){
        $privateKey = openssl_pkey_new(array(
            "private_key_bits" => 4096,
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

    public function generateSelfSignedCertificate($privateKey){
        $privateKey = openssl_pkey_get_private($privateKey);
        $certificate = openssl_csr_new(array(
            "countryName" => "FR",
            "stateOrProvinceName" => "Ile de France",
            "localityName" => "Paris",
            "organizationName" => "La croix verte",
            "organizationalUnitName" => "test",
            "commonName" => "La croix verte",
        ), $privateKey);
        $certificate = openssl_csr_sign($certificate, null, $privateKey, 365);
        openssl_x509_export($certificate, $certificateString);
        return($certificateString);
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

}
