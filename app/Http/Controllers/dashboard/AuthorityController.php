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

    public function store(CreateAuthorityRequest $request)
    {
        $data = $request->validated();
        $authority = $this->opensslService->generateSelfSignedCertificate($data);
        $data['expires_on'] = (new \DateTime())->modify($data['validity_days'] . ' days');
        $data['issued_on'] = new \DateTime();
        $data['issuer'] = 'this';
        $data['sha256_fingerprint'] = $this->opensslService->viewCertificate($authority['public_key'])['extensions']['authorityKeyIdentifier'];
        $data['sha1_fingerprint'] = $this->opensslService->viewCertificate($authority['public_key'])['extensions']['authorityKeyIdentifier'];
        unset($data['validity_days']);
        $this->certificateRepository->create([...$authority, ...$data]);
        return redirect()->route('dashboard.authorities.index');
    }

}
