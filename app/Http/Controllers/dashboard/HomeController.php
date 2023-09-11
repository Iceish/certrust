<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Repositories\CertificateRepository;
use App\Services\OpensslService;

class HomeController extends Controller
{
    public function __construct(){}

    public function index()
    {
        return view('web.dashboard.sections.home.index');
    }

}
