<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class SuratJalanDashboardController extends Controller
{
    public function index()
    {
        return view('surat_jalan.dashboard'); // Return the surat jalan dashboard view
    }
}
