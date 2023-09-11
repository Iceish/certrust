<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Repositories\CertificateRepository;
use App\Requests\Authority\CreateAuthorityRequest;
use App\Services\OpensslService;

class AuthorityController extends Controller
{
    public function __construct(
        private readonly OpensslService $opensslService,
        private readonly CertificateRepository $certificateRepository
    ){}
    public function index()
    {
        $authorities = $this->certificateRepository->allSelfSigned();
        return view('web.dashboard.sections.authorities.index', compact('authorities'));
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

    public function store(CreateAuthorityRequest $request)
    {
        $data = $request->validated();
        $authority = $this->opensslService->generateSelfSignedCertificate($data);
        $certificate = [
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
            "issuer" => 'this',
            "sha256_fingerprint" => $authority['fingerprints']['sha256'],
            "sha1_fingerprint" => $authority['fingerprints']['sha1'],
        ];
        $this->certificateRepository->create($certificate);
        return redirect()->route('dashboard.authorities.index');
    }

}
