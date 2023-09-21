<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function __construct(){}
    public function index()
    {
        return response()->json('Settings', 200);
    }

}
