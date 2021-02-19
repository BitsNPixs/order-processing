<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;

class DashboardController extends Controller
{
    public function getDashboard()
    {
    	$services = Service::where('status', 1)->get();

    	return view('index', compact('services'));
    }
}
