<?php

namespace App\Http\Controllers;

use App\Models\Menfess;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'category' => [
                'nullable',
                'string',
                'in:Campus Life,Love & Friendship,Academic Talks,Confession,Other',
            ],
        ]);

        $query = Menfess::query()
            ->where('status', 'approved')
            ->withCount('likes')
            ->with([
                'likedByUsers' => function ($query) {
                    $query->whereKey(auth()->id());
                },
            ]);

        if (!empty($validated['search'])) {
            $search = $validated['search'];

            $query->where(function ($query) use ($search) {
                $query->where('content', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%');
            });
        }

        if (!empty($validated['category'])) {
            $query->where('category', $validated['category']);
        }

        $menfesses = $query->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = [
            'Campus Life',
            'Love & Friendship',
            'Academic Talks',
            'Confession',
            'Other',
        ];

        return view('explore.index', compact(
            'menfesses',
            'categories'
        ));
    }
}
