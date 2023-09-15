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
        return view('web.dashboard.sections.authorities.index', compact('rootAuthorities'));
    }

    public function show(Certificate $authority)
    {
        $certificates = $this->certificateRepository->allIssuedBy($authority->id);
        return view('web.dashboard.sections.authorities.show', compact('certificates', 'authority'));
    }

    public function create()
    {
        return view('web.dashboard.sections.authorities.create');
    }

    public function destroy(Certificate $authority)
    {
        $this->certificateRepository->delete($authority->id);
        return redirect()->route('dashboard.authorities.index');
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
        return redirect()->route('dashboard.authorities.index');
    }

    public function download(Certificate $authority, string $field)
    {
        $extension = match ($field) {
            "public_key" => "crt",
            "private_key" => "key",
        };
        return response($authority->$field, 200, [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => "attachment; filename=$authority->common_name.$extension",
        ]);
    }

}
