<?php

namespace App\Http\Controllers;

use App\Models\Menfess;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class MenfessLikeController extends Controller
{
    public function toggle(Menfess $menfess): RedirectResponse
    {
        $user = Auth::user();

        $like = $menfess->likes()
            ->where('user_id', $user->id)
            ->first();

        if ($like) {
            $like->delete();

            return back()->with('success', 'Like berhasil dibatalkan.');
        }

        $menfess->likes()->create([
            'user_id' => $user->id,
        ]);

        return back()->with('success', 'Menfess berhasil disukai!');
    }
}
