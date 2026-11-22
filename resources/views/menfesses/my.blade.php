<x-layouts::app :title="'My Menfess'">

    <div class="min-h-screen bg-[#fff5f9] px-5 py-8 sm:px-8">

        <!-- HEADER -->
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="mb-2 text-sm font-medium text-pink-400">
                    YOUR SPACE, YOUR VOICE ♡
                </p>

                <h1 class="text-3xl font-bold text-[#493640]">
                    My Menfess
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Semua cerita dan pikiran yang pernah kamu bagikan.
                </p>
            </div>

            <a href="{{ route('menfesses.create') }}"
                class="rounded-full bg-[#df7da1] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#cf6b91]">
                + Create Menfess
            </a>
        </div>

        <!-- COMMUNITY LINK -->
        <div class="mb-8">
            <a href="{{ route('community.home') }}"
                class="text-sm font-medium text-pink-500 hover:text-pink-700">
                ← Back to Community Feed
            </a>
        </div>

        <!-- MENFESS LIST -->
        @forelse ($menfesses as $menfess)

            <div class="mb-5 rounded-2xl border border-pink-100 bg-white p-6 shadow-sm">

                <!-- POST HEADER -->
                <div class="mb-5 flex flex-wrap items-center justify-between gap-3">

                    <div>
                        <p class="font-semibold text-[#493640]">
                            {{ $menfess->is_anonymous ? 'Anonymous' : auth()->user()->name }}
                        </p>

                        <p class="mt-1 text-xs text-gray-400">
                            {{ $menfess->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @if ($menfess->category)
                            <span class="rounded-full bg-pink-50 px-3 py-1 text-xs font-medium text-pink-500">
                                {{ $menfess->category }}
                            </span>
                        @endif

                        @if ($menfess->status)
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                                {{ ucfirst($menfess->status) }}
                            </span>
                        @endif
                    </div>

                </div>

                <!-- POST CONTENT -->
                <div class="leading-7 text-[#493640]">
                    {!! nl2br(e($menfess->content)) !!}
                </div>

            </div>

        @empty

            <!-- EMPTY STATE -->
            <div class="rounded-3xl border border-pink-100 bg-white px-6 py-16 text-center">

                <div class="mb-5 text-5xl">
                    🌷
                </div>

                <h2 class="text-xl font-bold text-[#493640]">
                    Belum Ada Menfess
                </h2>

                <p class="mx-auto mt-3 max-w-md text-sm leading-6 text-gray-500">
                    Kamu belum membagikan cerita apa pun.
                    Yuk, mulai bagikan pikiran dan ceritamu di SUARAQ!
                </p>

                <a href="{{ route('menfesses.create') }}"
                    class="mt-6 inline-block rounded-full bg-[#df7da1] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#cf6b91]">
                    + Buat Menfess Pertama
                </a>

            </div>

        @endforelse

    </div>

</x-layouts::app>
