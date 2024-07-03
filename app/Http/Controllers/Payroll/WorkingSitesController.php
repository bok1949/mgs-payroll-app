<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkingSitesController extends Controller
{
    public function index()
    {
        return view('payroll.working-site-management.workingSiteIndex');
    }
}
