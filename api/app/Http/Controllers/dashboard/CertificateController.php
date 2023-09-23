<?php

namespace App\Http\Controllers\dashboard;

use App\Enums\CertificateTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Repositories\CertificateRepository;
use App\Requests\Certificate\CreateCertificateRequest;
use App\Services\OpensslService;

class CertificateController extends Controller
{
    public function __construct(
        private readonly OpensslService $opensslService,
        private readonly CertificateRepository $certificateRepository
    ){}

    public function index()
    {
        $rootAuthorities = $this->certificateRepository->allRootAuthorities();
        return response()->json(
            [
                'certificates' => $rootAuthorities,
            ],
            200
        );
    }

    public function show(Certificate $certificate)
    {
        $paths = $this->certificateRepository->getPathToRootCA($certificate->id);
        $issuedCertificates = $this->certificateRepository->allIssuedBy($certificate->id, CertificateTypeEnum::CERT);
        $issuedSubCAs = $this->certificateRepository->allIssuedBy($certificate->id, CertificateTypeEnum::SUB_CA);
        return response()->json(
            [
                'certificate' => $certificate,
                'issued_certificates' => $issuedCertificates,
                'issued_sub_cas' => $issuedSubCAs,
                'paths' => $paths,
            ],
            200
        );
    }

    public function destroy(Certificate $certificate)
    {
        $this->certificateRepository->delete($certificate->id);
        return response()->json(
            [
                'success' => 'Certificates deleted successfully',
            ],
            200
        );
    }

    public function store(CreateCertificateRequest $request)
    {
        $data = $request->validated();
        $authority = $this->opensslService->generateSelfSignedCertificate($data);
        $certificate = [
            "type" => $data['type'],
            "common_name" => $data['common_name'],
            "organization" => $data['organization'],
            "organization_unit" => $data['organization_unit'],
            "country_name" => $data['country_name'],
            "state_or_province_name" => $data['state_or_province_name'],
            "locality_name" => $data['locality_name'],
            "public_key" => $authority['public_key'],
            "private_key" => $authority['private_key'],
            "expires_on" => (new \DateTime())->modify($data['validity_days'] . ' days'),
            "issued_on" => new \DateTime(),
            "issuer" => $data['issuer'] ?? 'this',
            "sha256_fingerprint" => $authority['fingerprints']['sha256'],
            "sha1_fingerprint" => $authority['fingerprints']['sha1'],
        ];
        $this->certificateRepository->create($certificate);
        return response()->json(
            [
                'success' => 'Certificates created successfully',
            ],
            200
        );
    }

    public function download(Certificate $certificate, string $field)
    {
        $extension = match ($field) {
            "public_key" => "crt",
            "private_key" => "key",
        };
        return response($certificate->$field, 200, [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => "attachment; filename=$certificate->common_name.$extension",
        ]);
    }

}
