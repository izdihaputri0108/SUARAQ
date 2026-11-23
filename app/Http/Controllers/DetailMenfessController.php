<?php

namespace App\Http\Controllers;

use App\Models\Menfess;
use Illuminate\Contracts\View\View;

class DetailMenfessController extends Controller
{
    /**
     * Menampilkan detail satu menfess.
     */
    public function show(Menfess $menfess): View
    {
        // Menfess yang belum disetujui hanya bisa dilihat pemiliknya.
        abort_unless(
            $menfess->status === 'approved'
            || $menfess->user_id === auth()->id(),
            404
        );

        $menfess->loadCount('likes');

        $menfess->load([
            'likedByUsers' => function ($query) {
                $query->whereKey(auth()->id());
            },
        ]);

        return view('menfesses.show', compact('menfess'));
    }
}
