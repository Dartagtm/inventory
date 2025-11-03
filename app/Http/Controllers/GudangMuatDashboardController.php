<?php

   namespace App\Http\Controllers;

   use App\Http\Controllers\Controller;
   use Illuminate\Http\Request;

   class GudangMuatDashboardController extends Controller
   {
       public function index()
       {
           // Your logic for Gudang Muat dashboard
           return view('gudang_muat.dashboard'); // Adjust the view name as necessary
       }
   }
   