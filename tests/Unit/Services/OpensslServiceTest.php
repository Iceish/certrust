<?php

namespace Services;

use App\Models\Certificate;
use App\Services\OpensslService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OpensslServiceTest extends TestCase
{
    use RefreshDatabase;


    public function testGeneratePrivateKey()
    {
        $opensslService = new OpensslService();
        $privateKey = $opensslService->generatePrivateKey();
        $this->assertNotEmpty($privateKey);
    }

    public function testViewCertificate()
    {
        $opensslService = new OpensslService();
        $certificate = $opensslService->generateSelfSignedCertificate([
            'country_name' => 'US',
            'state_or_province_name' => 'California',
            'locality_name' => 'San Francisco',
            'organization' => 'Acme Inc.',
            'organization_unit' => 'IT',
            'common_name' => 'www.example.com',
            'validity_days' => 365,
        ]);
        $certificateData = $opensslService->viewCertificate($certificate['public_key']);
        $this->assertEquals('US', $certificateData['subject']['C']);
        $this->assertEquals('California', $certificateData['subject']['ST']);
        $this->assertEquals('San Francisco', $certificateData['subject']['L']);
        $this->assertEquals('Acme Inc.', $certificateData['subject']['O']);
        $this->assertEquals('IT', $certificateData['subject']['OU']);
        $this->assertEquals('www.example.com', $certificateData['subject']['CN']);
    }

    public function testGenerateCertificateSigningRequest()
    {
        $opensslService = new OpensslService();
        $csr = $opensslService->generateCertificateSigningRequest();
        $this->assertNotEmpty($csr);
    }

    public function testSignCertificateSigningRequest()
    {
        $opensslService = new OpensslService();
        $csr = $opensslService->generateCertificateSigningRequest();
        $authority = $opensslService->generateSelfSignedCertificate([
            'country_name' => 'US',
            'state_or_province_name' => 'California',
            'locality_name' => 'San Francisco',
            'organization' => 'Acme Inc.',
            'organization_unit' => 'IT',
            'common_name' => 'www.example.com',
            'validity_days' => 365,
        ]);
        $certificate = $opensslService->signCertificateSigningRequest($csr, $authority['public_key'], $authority['private_key']);
        $this->assertNotEmpty($certificate);
    }

    public function testGenerateSelfSignedCertificate()
    {
        $opensslService = new OpensslService();
        $certificate = $opensslService->generateSelfSignedCertificate([
            'country_name' => 'US',
            'state_or_province_name' => 'California',
            'locality_name' => 'San Francisco',
            'organization' => 'Acme Inc.',
            'organization_unit' => 'IT',
            'common_name' => 'www.example.com',
            'validity_days' => 365,
        ]);
        $this->assertNotEmpty($certificate['private_key']);
        $this->assertNotEmpty($certificate['public_key']);
        $this->assertArrayHasKey('sha256', $certificate['fingerprints']);
        $this->assertArrayHasKey('sha1', $certificate['fingerprints']);
    }

    public function testAuthorityStatistic()
    {
        $opensslService = new OpensslService();

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
        $rootCertificateStatistics = $opensslService->authorityStatistic($rootCertificate);

        $this->assertEquals(1, $rootCertificateStatistics['certificates']);
        $this->assertEquals(0, $rootCertificateStatistics['certificates_expired']);
        $this->assertEquals(1, $rootCertificateStatistics['sub_ca']);
        $this->assertEquals(0, $rootCertificateStatistics['sub_ca_expired']);

        // Calculate statistics for the sub-certificate
        $subCertificateStatistics = $opensslService->authorityStatistic($subCertificate);

        $this->assertEquals(1, $subCertificateStatistics['certificates']);
        $this->assertEquals(0, $subCertificateStatistics['certificates_expired']);
        $this->assertEquals(1, $subCertificateStatistics['sub_ca']);
        $this->assertEquals(0, $subCertificateStatistics['sub_ca_expired']);

        // Calculate statistics for the sub-sub-certificate
        $subSubCertificateStatistics = $opensslService->authorityStatistic($subSubCertificate);

        $this->assertEquals(1, $subSubCertificateStatistics['certificates']);
        $this->assertEquals(0, $subSubCertificateStatistics['certificates_expired']);
        $this->assertEquals(0, $subSubCertificateStatistics['sub_ca']);
        $this->assertEquals(0, $subSubCertificateStatistics['sub_ca_expired']);
    }


    public function testAuthorityStatisticWithExpiredCertificates()
    {
        $opensslService = new OpensslService();

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
        $rootCertificateStatistics = $opensslService->authorityStatistic($rootCertificate);

        $this->assertEquals(1, $rootCertificateStatistics['certificates']);
        $this->assertEquals(1, $rootCertificateStatistics['certificates_expired']);
        $this->assertEquals(1, $rootCertificateStatistics['sub_ca']);
        $this->assertEquals(1, $rootCertificateStatistics['sub_ca_expired']);

        // Calculate statistics for the sub-certificate
        $subCertificateStatistics = $opensslService->authorityStatistic($subCertificate);

        $this->assertEquals(1, $subCertificateStatistics['certificates']);
        $this->assertEquals(1, $subCertificateStatistics['certificates_expired']);
        $this->assertEquals(1, $subCertificateStatistics['sub_ca']);
        $this->assertEquals(1, $subCertificateStatistics['sub_ca_expired']);

        // Calculate statistics for the sub-sub-certificate
        $subSubCertificateStatistics = $opensslService->authorityStatistic($subSubCertificate);

        $this->assertEquals(1, $subSubCertificateStatistics['certificates']);
        $this->assertEquals(1, $subSubCertificateStatistics['certificates_expired']);
        $this->assertEquals(0, $subSubCertificateStatistics['sub_ca']);
        $this->assertEquals(0, $subSubCertificateStatistics['sub_ca_expired']);
    }
}

