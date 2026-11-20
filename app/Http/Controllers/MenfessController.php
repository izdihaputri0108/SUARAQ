<?php

namespace App\Http\Controllers;

use App\Models\Menfess;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenfessController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        // Memeriksa data yang dikirim dari form
        $validated = $request->validate([
            'category' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string', 'max:2000'],
            'is_anonymous' => ['required', 'boolean'],
        ]);

        // Menyimpan menfess ke database
        Menfess::create([
            'user_id' => Auth::id(),
            'category' => $validated['category'],
            'content' => $validated['content'],
            'is_anonymous' => $validated['is_anonymous'],
            'status' => 'pending',
        ]);

        // Kembali ke halaman Create Menfess
        return redirect()
            ->route('menfesses.create')
            ->with('success', 'Menfess berhasil dikirim! Menunggu persetujuan admin ♡');
    }
}
