<?php

namespace App\Http\Controllers;

use App\Models\Menfess;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $myMenfesses = Menfess::where('user_id', $user->id);

        $totalMenfesses = (clone $myMenfesses)->count();

        $pendingMenfesses = (clone $myMenfesses)
            ->where('status', 'pending')
            ->count();

        $approvedMenfesses = (clone $myMenfesses)
            ->where('status', 'approved')
            ->count();

        $totalLikes = (clone $myMenfesses)
            ->withCount('likes')
            ->get()
            ->sum('likes_count');

        $latestMenfesses = Menfess::with('user')
            ->withCount('likes')
            ->where('status', 'approved')
            ->latest()
            ->take(5)
            ->get();

        $trendingTopics = Menfess::query()
            ->select('category')
            ->selectRaw('COUNT(*) as total')
            ->where('status', 'approved')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->groupBy('category')
            ->orderByDesc('total')
            ->take(3)
            ->get();

        return view('dashboard', compact(
            'totalMenfesses',
            'pendingMenfesses',
            'approvedMenfesses',
            'totalLikes',
            'latestMenfesses',
            'trendingTopics'
        ));
    }
}