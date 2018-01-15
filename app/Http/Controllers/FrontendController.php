<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class FrontendController extends Controller
{

    public function index()
    {
        $config = [
            'message' => 'Hello World!'
        ];

        // Serve the view
        return view('frontend.index', compact(['config']));
    }
}
