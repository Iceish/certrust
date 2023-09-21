<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class ManagementController extends Controller
{
    public function __construct(){}
    public function index()
    {
        return response()->json('Management', 200);
    }

}
