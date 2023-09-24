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
    ){}

    public function index()
    {
        $certificates = Certificate::all();

        return response()->json(
            [
                'certificates' => $certificates,
            ],
            200
        );
    }

    public function show(Certificate $certificate)
    {
        Certificate::find($certificate->id);
        return response()->json(
            [
                'certificate' => $certificate,
            ],
            200
        );
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
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
            "issuer" => $data['issuer'] ?? null,
            "sha256_fingerprint" => $authority['fingerprints']['sha256'],
            "sha1_fingerprint" => $authority['fingerprints']['sha1'],
        ];

        Certificate::create($certificate);

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
