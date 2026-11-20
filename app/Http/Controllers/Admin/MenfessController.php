<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menfess;

class MenfessController extends Controller
{
    /**
     * Menampilkan daftar menfess untuk moderasi.
     */
    public function index()
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
    public function approve(Menfess $menfess)
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
    public function reject(Menfess $menfess)
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
    public function destroy(Menfess $menfess)
    {
        $menfess->delete();

        return redirect()
            ->route('admin.menfesses.index')
            ->with('success', 'Menfess berhasil dihapus.');
    }
}
