<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Show services list screen
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getServices()
    {
    	$services = Service::where('status', 1)->get();

    	return view('services', compact('services'));
    }
}
