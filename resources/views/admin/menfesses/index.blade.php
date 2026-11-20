<x-layouts::app :title="'Admin Moderation - SUARAQ'">

<style>
    .admin-page {
        max-width: 1100px;
        margin: 0 auto;
        color: #493640;
    }

    .admin-heading {
        color: #493640;
        font-size: 28px;
        font-weight: 800;
    }

    .admin-subtitle {
        color: #a98796;
        margin-top: 5px;
    }

    .admin-card {
        background: white;
        border: 1px solid #f5dce6;
        border-radius: 18px;
        padding: 22px;
        margin-top: 20px;
    }

    .admin-button {
        border: 0;
        border-radius: 10px;
        padding: 9px 15px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .approve-button {
        background: #e5f5e9;
        color: #278348;
    }

    .reject-button {
        background: #fff0e7;
        color: #bd673b;
    }

    .delete-button {
        background: #ffe8ed;
        color: #c34d70;
    }
</style>

<div class="admin-page">

    <div class="mb-7">
        <div class="text-sm font-semibold text-pink-500 mb-2">
            SUARAQ / ADMIN
        </div>

        <h1 class="admin-heading">
            Menfess Moderation 🌷
        </h1>

        <p class="admin-subtitle">
            Kelola dan periksa menfess sebelum ditampilkan kepada komunitas.
        </p>
    </div>

    @if (session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 p-4 mb-5 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-card">

        <div class="flex items-center justify-between gap-3 flex-wrap mb-5">
            <div>
                <h2 class="text-lg font-bold">
                    Menfess Menunggu Persetujuan
                </h2>

                <p class="text-sm text-gray-400 mt-1">
                    Periksa setiap kiriman sebelum menyetujuinya.
                </p>
            </div>

            <span class="rounded-full bg-pink-50 px-4 py-2 text-sm font-bold text-pink-600">
                {{ $menfesses->count() }} Pending
            </span>
        </div>

        @forelse ($menfesses as $menfess)

            <div class="border border-pink-100 rounded-xl p-5 mb-4">

                <div class="flex items-center justify-between gap-3 flex-wrap mb-4">
                    <div>
                        <span class="text-xs font-bold text-pink-500">
                            {{ $menfess->category }}
                        </span>

                        <p class="font-bold text-gray-800 mt-1">
                            {{ $menfess->is_anonymous ? 'Anonymous' : $menfess->user->name }}
                        </p>

                        <p class="text-xs text-gray-400">
                            {{ $menfess->created_at->diffForHumans() }}
                        </p>
                    </div>

                    <span class="rounded-full bg-yellow-50 px-3 py-1 text-xs font-bold text-yellow-700">
                        PENDING
                    </span>
                </div>

                <p class="text-sm leading-7 text-gray-700 whitespace-pre-line">
                    {{ $menfess->content }}
                </p>

                <div class="flex flex-wrap gap-2 mt-5">

                    <form method="POST"
                        action="{{ route('admin.menfesses.approve', $menfess->id) }}">
                        @csrf
                        @method('PATCH')

                        <button type="submit" class="admin-button approve-button">
                            ✓ Approve
                        </button>
                    </form>

                    <form method="POST"
                        action="{{ route('admin.menfesses.reject', $menfess->id) }}">
                        @csrf
                        @method('PATCH')

                        <button type="submit" class="admin-button reject-button">
                            ✕ Reject
                        </button>
                    </form>

                    <form method="POST"
                        action="{{ route('admin.menfesses.destroy', $menfess->id) }}"
                        onsubmit="return confirm('Yakin ingin menghapus menfess ini?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="admin-button delete-button">
                            Delete
                        </button>
                    </form>

                </div>
            </div>

        @empty

            <div class="text-center py-12">
                <div class="text-4xl mb-3">🌸</div>

                <h3 class="font-bold text-gray-700">
                    Tidak ada menfess pending
                </h3>

                <p class="text-sm text-gray-400 mt-2">
                    Semua kiriman sudah diperiksa.
                </p>
            </div>

        @endforelse

    </div>

</div>

</x-layouts::app>
