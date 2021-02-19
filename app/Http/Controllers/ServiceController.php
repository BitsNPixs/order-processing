<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function getServices()
    {
    	$services = Service::where('status', 1)->get();

    	return view('services', compact('services'));
    }
}
