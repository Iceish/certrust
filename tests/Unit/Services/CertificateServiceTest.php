<?php

namespace Tests\Unit\Services;

use App\Models\Certificate;
use App\Services\CertificateService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CertificateServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthorityStatistic()
    {
        $certificateService = new CertificateService();

        // Create a root certificate

        $rootCertificate = new Certificate();
        $id = $rootCertificate->newUniqueId();
        $rootCertificate = Certificate::factory()->create([
            'id' => $id,
            'type' => 0,
            'issuer' => $id,
        ]);
        $rootCertificate->issuer()->associate($rootCertificate);
        $rootCertificate->save();

        // Create a sub-certificate
        $subCertificate = Certificate::factory()->create([
            'issuer' => $rootCertificate,
            'type' => 1,
        ]);

        // Create a sub-sub-certificate
        $subSubCertificate = Certificate::factory()->create([
            'issuer' => $subCertificate,
            'type' => 2,
        ]);

        // Calculate statistics for the root certificate
        $rootCertificateStatistics = $certificateService->authorityStatistic($rootCertificate);

        $this->assertEquals(1, $rootCertificateStatistics['certificates']);
        $this->assertEquals(0, $rootCertificateStatistics['certificates_expired']);
        $this->assertEquals(1, $rootCertificateStatistics['sub_ca']);
        $this->assertEquals(0, $rootCertificateStatistics['sub_ca_expired']);

        // Calculate statistics for the sub-certificate
        $subCertificateStatistics = $certificateService->authorityStatistic($subCertificate);

        $this->assertEquals(1, $subCertificateStatistics['certificates']);
        $this->assertEquals(0, $subCertificateStatistics['certificates_expired']);
        $this->assertEquals(1, $subCertificateStatistics['sub_ca']);
        $this->assertEquals(0, $subCertificateStatistics['sub_ca_expired']);

        // Calculate statistics for the sub-sub-certificate
        $subSubCertificateStatistics = $certificateService->authorityStatistic($subSubCertificate);

        $this->assertEquals(1, $subSubCertificateStatistics['certificates']);
        $this->assertEquals(0, $subSubCertificateStatistics['certificates_expired']);
        $this->assertEquals(0, $subSubCertificateStatistics['sub_ca']);
        $this->assertEquals(0, $subSubCertificateStatistics['sub_ca_expired']);
    }


    public function testAuthorityStatisticWithExpiredCertificates()
    {
        $certificateService = new CertificateService();

        // Create a root certificate

        $rootCertificate = new Certificate();
        $id = $rootCertificate->newUniqueId();
        $rootCertificate = Certificate::factory()->create([
            'id' => $id,
            'type' => 0,
            'issuer' => $id,
        ]);
        $rootCertificate->issuer()->associate($rootCertificate);
        $rootCertificate->save();

        // Create a sub-certificate
        $subCertificate = Certificate::factory()->create([
            'issuer' => $rootCertificate,
            'type' => 1,
            'expires_on' => now()->subDays(1),
        ]);

        // Create a sub-sub-certificate
        $subSubCertificate = Certificate::factory()->create([
            'issuer' => $subCertificate,
            'type' => 2,
            'expires_on' => now()->subDays(1),
        ]);

        // Calculate statistics for the root certificate
        $rootCertificateStatistics = $certificateService->authorityStatistic($rootCertificate);

        $this->assertEquals(1, $rootCertificateStatistics['certificates']);
        $this->assertEquals(1, $rootCertificateStatistics['certificates_expired']);
        $this->assertEquals(1, $rootCertificateStatistics['sub_ca']);
        $this->assertEquals(1, $rootCertificateStatistics['sub_ca_expired']);

        // Calculate statistics for the sub-certificate
        $subCertificateStatistics = $certificateService->authorityStatistic($subCertificate);

        $this->assertEquals(1, $subCertificateStatistics['certificates']);
        $this->assertEquals(1, $subCertificateStatistics['certificates_expired']);
        $this->assertEquals(1, $subCertificateStatistics['sub_ca']);
        $this->assertEquals(1, $subCertificateStatistics['sub_ca_expired']);

        // Calculate statistics for the sub-sub-certificate
        $subSubCertificateStatistics = $certificateService->authorityStatistic($subSubCertificate);

        $this->assertEquals(1, $subSubCertificateStatistics['certificates']);
        $this->assertEquals(1, $subSubCertificateStatistics['certificates_expired']);
        $this->assertEquals(0, $subSubCertificateStatistics['sub_ca']);
        $this->assertEquals(0, $subSubCertificateStatistics['sub_ca_expired']);
    }
}

