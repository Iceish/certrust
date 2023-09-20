<?php

namespace App\Services;
use App\Models\Certificate;

class CertificateService
{
    public function authorityStatistic(Certificate $certificate): array
    {
        $nbIssuedCertificates = $certificate->certificates()->count();
        $result = [
            "certificates" => 0,
            "certificates_expired" => 0,
            "sub_ca" => 0,
            "sub_ca_expired" => 0
        ];
        if($nbIssuedCertificates == 0){
            $result["certificates"] = 1;
            $result["certificates_expired"] = $certificate->hasExpired() ? 1 : 0;
        }else if($certificate->issuer !== $certificate->id){
            $result["sub_ca"] = 1;
            $result["sub_ca_expired"] = $certificate->hasExpired() ? 1 : 0;
        }

        foreach($certificate->certificates() as $issuedCertificate){
            if($issuedCertificate->id === $certificate->id) continue;
            $issuedCertificateStatistic = $this->authorityStatistic($issuedCertificate);
            $result["certificates"] += $issuedCertificateStatistic["certificates"];
            $result["certificates_expired"] += $issuedCertificateStatistic["certificates_expired"];
            $result["sub_ca"] += $issuedCertificateStatistic["sub_ca"];
            $result["sub_ca_expired"] += $issuedCertificateStatistic["sub_ca_expired"];
        }
        return $result;
    }
}
