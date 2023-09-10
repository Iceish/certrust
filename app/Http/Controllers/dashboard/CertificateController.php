<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
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
        $certificates = $this->certificateRepository->all();
        return view('web.dashboard.sections.certificates.index', compact('certificates'));
    }
}
