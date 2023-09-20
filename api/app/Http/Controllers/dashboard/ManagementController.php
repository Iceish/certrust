<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class ManagementController extends Controller
{
    public function __construct(){}
    public function index()
    {
        return view('web.dashboard.sections.management.index');
    }

}
