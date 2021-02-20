<?php

namespace App\Http\Controllers;

use App\Models\Service;

class DashboardController extends Controller
{
    /**
     * Show user dashboard screen
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getDashboard()
    {
    	$services = Service::where('status', 1)->get();

    	return view('index', compact('services'));
    }
}
