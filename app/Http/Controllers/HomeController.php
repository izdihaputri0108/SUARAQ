<?php

namespace App\Http\Controllers;

use App\Models\Menfess;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $menfesses = Menfess::where('status', 'approved')
            ->withCount('likes')
            ->with([
                'likedByUsers' => function ($query) {
                    $query->whereKey(auth()->id());
                },
            ])
            ->latest()
            ->get();

        return view('home', compact('menfesses'));
    }
}
