<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Services\OpensslService;

class HomeController extends Controller
{
    public function __construct(
        private readonly OpensslService $opensslService
    ){}

    public function index()
    {
        $cli = $this->opensslService->getVersion();
        return view('web.dashboard.sections.home.index', compact('cli'));
    }
}
