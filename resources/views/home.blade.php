<x-layouts::app :title="'Home - SUARAQ'">

    <div class="min-h-screen bg-[#fff5f9] px-6 py-10 md:px-10">

        <div class="mx-auto max-w-6xl">

            <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold tracking-widest text-pink-400">
                        YOUR SPACE, YOUR VOICE ♡
                    </p>

                    <h1 class="mt-2 text-3xl font-bold text-[#d96f9a]">
                        Community Feed
                    </h1>

                    <p class="mt-2 text-gray-500">
                        Discover stories and thoughts from students.
                    </p>
                </div>

                <a href="{{ route('menfesses.create') }}"
                   class="rounded-full bg-[#df7da3] px-6 py-3 font-semibold text-white transition hover:bg-[#cc648d]">
                    + Create Menfess
                </a>
            </div>

            <div class="mb-8 rounded-3xl bg-gradient-to-r from-[#f9dce8] to-[#fff0f5] p-8">
                <h2 class="text-2xl font-bold text-[#75465b]">
                    Every voice deserves to be heard ♡
                </h2>

                <p class="mt-2 text-[#987184]">
                    Share your stories, thoughts, and little secrets with the SUARAQ community.
                </p>
            </div>

            <div class="mb-5 flex items-center justify-between">
                <h2 class="text-xl font-bold text-[#75465b]">
                    Latest Menfess
                </h2>

                <span class="text-sm text-gray-400">
                    {{ $menfesses->count() }} posts
                </span>
            </div>

            @forelse ($menfesses as $menfess)

                <div class="mb-5 rounded-2xl border border-pink-100 bg-white p-6 shadow-sm">

                    <div class="mb-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">

                            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-pink-100 text-xl">
                                🌷
                            </div>

                            <div>
                                <p class="font-semibold text-[#75465b]">
                                    {{ $menfess->is_anonymous ? 'Anonymous' : 'Mahasiswa' }}
                                </p>

                                <p class="text-xs text-gray-400">
                                    {{ $menfess->category }}
                                    ·
                                    {{ $menfess->created_at->diffForHumans() }}
                                </p>
                            </div>

                        </div>

                        @if ($menfess->is_anonymous)
                            <span class="rounded-full bg-pink-50 px-3 py-1 text-xs font-semibold text-pink-500">
                                ANONYMOUS
                            </span>
                        @endif

                    </div>

                    <p class="whitespace-pre-line leading-relaxed text-gray-700">
                        {{ $menfess->content }}
                    </p>

                    <div class="mt-5 border-t border-pink-100 pt-4">
                        <p class="text-xs text-gray-400">
                            ♡ Be kind and respectful to one another.
                        </p>
                    </div>

                </div>

            @empty

                <div class="rounded-2xl border border-pink-100 bg-white px-6 py-16 text-center">
                    <div class="mb-4 text-5xl">💌</div>

                    <h3 class="text-xl font-bold text-[#75465b]">
                        No menfess yet
                    </h3>

                    <p class="mt-2 text-gray-400">
                        Be the first to share your story with the community!
                    </p>

                    <a href="{{ route('menfesses.create') }}"
                       class="mt-6 inline-block rounded-full bg-[#df7da3] px-6 py-3 font-semibold text-white hover:bg-[#cc648d]">
                        Create Your First Menfess
                    </a>
                </div>

            @endforelse

        </div>

    </div>

</x-layouts::app>
