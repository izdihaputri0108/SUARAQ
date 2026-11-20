<?php

namespace App\Http\Controllers;

use App\Models\Menfess;

class HomeController extends Controller
{
    public function index()
    {
        $menfesses = Menfess::where('status', 'approved')
            ->latest()
            ->get();

        return view('home', compact('menfesses'));
    }
}
