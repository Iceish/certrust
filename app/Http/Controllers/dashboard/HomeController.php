<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Repositories\CertificateRepository;
use App\Services\OpensslService;

class HomeController extends Controller
{
    public function __construct(
        private readonly OpensslService $opensslService,
        private readonly CertificateRepository $certificateRepository
    ){}

    public function index()
    {
//        $this->certificateRepository->create(['common_name' => 'La croix verte', 'organization' => 'test', 'country_name' => 'FR', 'public_key' => 'Pub key', 'private_key' => 'Priv key', 'expires_on' => '2023-09-09 11:25:06', 'issued_on' => '2023-09-09 11:25:06', 'sha256_fingerprint' => 'test', 'sha1_fingerprint' => 'tAZE65sqAZEAZ', 'issuer' => 'this']);
//        dd($this->certificateRepository->all());
        $selfkey = $this->opensslService->generatePrivateKey();
        $selfcert = $this->opensslService->generateSelfSignedCertificate($selfkey);
        $cli = $this->opensslService->signCertificateSigningRequest($this->opensslService->generateCertificateSigningRequest(), $selfcert, $selfkey);
        return view('web.dashboard.sections.home.index', compact('cli'));
    }

}
