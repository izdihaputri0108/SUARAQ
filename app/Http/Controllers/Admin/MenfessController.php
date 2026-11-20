<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menfess;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MenfessController extends Controller
{
    /**
     * Menampilkan daftar menfess untuk moderasi.
     */
    public function index(): View
    {
        $menfesses = Menfess::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.menfesses.index', compact('menfesses'));
    }

    /**
     * Menyetujui menfess.
     */
    public function approve(Menfess $menfess): RedirectResponse
    {
        $menfess->update([
            'status' => 'approved',
        ]);

        return redirect()
            ->route('admin.menfesses.index')
            ->with('success', 'Menfess berhasil disetujui!');
    }

    /**
     * Menolak menfess.
     */
    public function reject(Menfess $menfess): RedirectResponse
    {
        $menfess->update([
            'status' => 'rejected',
        ]);

        return redirect()
            ->route('admin.menfesses.index')
            ->with('success', 'Menfess berhasil ditolak.');
    }

    /**
     * Menghapus menfess.
     */
    public function destroy(Menfess $menfess): RedirectResponse
    {
        $menfess->delete();

        return redirect()
            ->route('admin.menfesses.index')
            ->with('success', 'Menfess berhasil dihapus.');
    }
}
