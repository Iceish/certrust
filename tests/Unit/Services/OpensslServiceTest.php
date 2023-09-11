<?php

namespace Services;

use App\Services\OpensslService;
use PHPUnit\Framework\TestCase;

class OpensslServiceTest extends TestCase
{
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
}

