<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct(){}

    public function index()
    {
        return response()->json('Welcome to the Certrust API!', 200);
    }

}
