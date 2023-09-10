<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Repositories\CertificateRepository;
use App\Services\OpensslService;

class CertificateController extends Controller
{
    public function __construct(
        private readonly OpensslService $opensslService,
        private readonly CertificateRepository $certificateRepository
    ){}
    public function index()
    {
        $authorities = $this->certificateRepository->allSelfSigned();
        return view('web.dashboard.sections.certificates.index', compact('authorities'));
    }

    public function show(Certificate $authority)
    {
        $certificates = $this->certificateRepository->allIssuedBy($authority->id);
        return view('web.dashboard.sections.certificates.show', compact('certificates', 'authority'));
    }
}
