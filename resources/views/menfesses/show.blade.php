<x-layouts::app :title="'Detail Menfess - SUARAQ'">

    <div class="min-h-screen bg-[#fff5f9] px-6 py-10 md:px-10">
        <div class="mx-auto max-w-4xl">

            {{-- BACK BUTTON --}}
            <a
                href="{{ url()->previous() }}"
                class="mb-6 inline-flex items-center gap-2 text-sm font-semibold text-pink-500 transition hover:text-pink-700"
            >
                ← Back
            </a>

            {{-- HEADER --}}
            <div class="mb-8">
                <p class="text-sm font-semibold tracking-widest text-pink-400">
                    YOUR SPACE, YOUR VOICE ♡
                </p>

                <h1 class="mt-2 text-3xl font-bold text-[#d96f9a]">
                    Menfess Detail
                </h1>

                <p class="mt-2 text-gray-500">
                    Every story matters. Take a moment to listen.
                </p>
            </div>

            {{-- MENFESS DETAIL CARD --}}
            <div class="rounded-3xl border border-pink-100 bg-white p-6 shadow-sm md:p-8">

                {{-- USER INFORMATION --}}
                <div class="mb-6 flex items-center justify-between gap-3">

                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-pink-100 text-2xl">
                            🌷
                        </div>

                        <div>
                            <p class="font-bold text-[#75465b]">
                                {{ $menfess->is_anonymous ? 'Anonymous' : 'Mahasiswa' }}
                            </p>

                            <p class="mt-1 text-xs text-gray-400">
                                {{ $menfess->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>

                    </div>

                    @if ($menfess->is_anonymous)
                        <span class="rounded-full bg-pink-50 px-3 py-1 text-xs font-semibold text-pink-500">
                            ANONYMOUS
                        </span>
                    @endif

                </div>

                {{-- CATEGORY AND STATUS --}}
                <div class="mb-6 flex flex-wrap items-center gap-3">

                    <span class="rounded-full bg-pink-100 px-4 py-2 text-xs font-semibold text-pink-600">
                        {{ $menfess->category }}
                    </span>

                    @if ($menfess->status === 'approved')
                        <span class="rounded-full bg-green-100 px-4 py-2 text-xs font-semibold text-green-600">
                            APPROVED
                        </span>
                    @elseif ($menfess->status === 'pending')
                        <span class="rounded-full bg-yellow-100 px-4 py-2 text-xs font-semibold text-yellow-700">
                            PENDING
                        </span>
                    @elseif ($menfess->status === 'rejected')
                        <span class="rounded-full bg-red-100 px-4 py-2 text-xs font-semibold text-red-600">
                            REJECTED
                        </span>
                    @endif

                </div>

                {{-- STATUS INFORMATION --}}
                @if ($menfess->status === 'pending')
                    <div class="mb-6 rounded-2xl border border-yellow-200 bg-yellow-50 p-4">
                        <p class="text-sm text-yellow-700">
                            Menfess kamu sedang menunggu persetujuan admin. Silakan tunggu sampai proses moderasi selesai.
                        </p>
                    </div>
                @elseif ($menfess->status === 'rejected')
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">
                        <p class="text-sm text-red-700">
                            Maaf, menfess kamu belum dapat disetujui oleh admin.
                        </p>
                    </div>
                @endif

                {{-- CONTENT --}}
                <div class="rounded-2xl bg-[#fff8fb] p-6 md:p-8">
                    <p class="whitespace-pre-line text-base leading-8 text-gray-700">
                        {{ $menfess->content }}
                    </p>
                </div>

                {{-- LIKE SECTION --}}
                @if ($menfess->status === 'approved')
                    <div class="mt-6 flex flex-wrap items-center justify-between gap-4 border-t border-pink-100 pt-5">

                        <form action="{{ route('menfesses.like', $menfess) }}" method="POST">
                            @csrf

                            <button
                                type="submit"
                                class="flex items-center gap-2 rounded-full px-5 py-3 text-sm font-semibold transition
                                {{ $menfess->likedByUsers->isNotEmpty()
                                    ? 'bg-pink-100 text-pink-600'
                                    : 'bg-gray-50 text-gray-500 hover:bg-pink-50 hover:text-pink-500' }}"
                            >
                                <span class="text-xl">
                                    {{ $menfess->likedByUsers->isNotEmpty() ? '♥' : '♡' }}
                                </span>

                                {{ $menfess->likedByUsers->isNotEmpty() ? 'Liked' : 'Like' }}

                                <span>
                                    {{ $menfess->likes_count }}
                                </span>
                            </button>
                        </form>

                        <p class="text-xs text-gray-400">
                            ♡ Be kind and respectful to one another.
                        </p>

                    </div>
                @endif

            </div>

            {{-- FOOTER --}}
            <div class="mt-6 rounded-2xl bg-gradient-to-r from-[#f9dce8] to-[#fff0f5] p-6 text-center">
                <h2 class="font-bold text-[#75465b]">
                    Every voice deserves to be heard ♡
                </h2>

                <p class="mt-2 text-sm text-[#987184]">
                    Thank you for being part of the SUARAQ community.
                </p>
            </div>

        </div>
    </div>

</x-layouts::app>
