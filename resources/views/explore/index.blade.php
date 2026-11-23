<x-layouts::app :title="'Explore - SUARAQ'">

    <div class="min-h-screen bg-[#fff5f9] px-6 py-10 md:px-10">
        <div class="mx-auto max-w-6xl">

            {{-- HEADER --}}
            <div class="mb-8">
                <p class="text-sm font-semibold tracking-widest text-pink-400">
                    YOUR SPACE, YOUR VOICE ♡
                </p>

                <h1 class="mt-2 text-3xl font-bold text-[#d96f9a]">
                    Explore
                </h1>

                <p class="mt-2 text-gray-500">
                    Find stories, thoughts, and confessions from the SUARAQ community.
                </p>
            </div>

            {{-- SEARCH AND FILTER --}}
            <div class="mb-8 rounded-3xl border border-pink-100 bg-white p-6 shadow-sm">

                <form action="{{ route('explore.index') }}" method="GET">

                    <div class="grid gap-4 md:grid-cols-3">

                        {{-- SEARCH --}}
                        <div class="md:col-span-2">
                            <label for="search" class="mb-2 block text-sm font-semibold text-[#75465b]">
                                Search Menfess
                            </label>

                            <input
                                type="text"
                                id="search"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search stories or keywords..."
                                class="w-full rounded-xl border border-pink-100 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-pink-400 focus:ring-2 focus:ring-pink-100"
                            >
                        </div>

                        {{-- CATEGORY --}}
                        <div>
                            <label for="category" class="mb-2 block text-sm font-semibold text-[#75465b]">
                                Category
                            </label>

                            <select
                                id="category"
                                name="category"
                                class="w-full rounded-xl border border-pink-100 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-pink-400 focus:ring-2 focus:ring-pink-100"
                            >
                                <option value="">All Categories</option>

                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category }}"
                                        {{ request('category') === $category ? 'selected' : '' }}
                                    >
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    {{-- BUTTONS --}}
                    <div class="mt-5 flex flex-wrap items-center gap-3">

                        <button
                            type="submit"
                            style="display: inline-flex; align-items: center; justify-content: center; background-color: #df7da3; color: white; padding: 10px 24px; border-radius: 9999px; font-size: 14px; font-weight: 600; border: none; cursor: pointer; transition: background-color 0.2s;"
                        >
                            Search
                        </button>

                        <a
                            href="{{ route('explore.index') }}"
                            style="display: inline-flex; align-items: center; justify-content: center; background-color: white; color: #df7da3; padding: 9px 24px; border-radius: 9999px; font-size: 14px; font-weight: 600; border: 1px solid #f5dce6; text-decoration: none;"
                        >
                            Clear Filter
                        </a>

                    </div>

                </form>

            </div>

            {{-- MENFESS LIST HEADER --}}
            <div class="mb-5 flex flex-wrap items-center justify-between gap-3">

                <div>
                    <h2 class="text-xl font-bold text-[#75465b]">
                        Discover Menfess
                    </h2>

                    <p class="mt-1 text-sm text-gray-400">
                        Explore what the community is sharing.
                    </p>
                </div>

                <span class="rounded-full bg-pink-100 px-4 py-2 text-sm font-semibold text-pink-500">
                    {{ $menfesses->total() }} posts found
                </span>

            </div>

            {{-- MENFESS CARDS --}}
            @forelse ($menfesses as $menfess)

                <div class="mb-5 rounded-2xl border border-pink-100 bg-white p-6 shadow-sm">

                    {{-- USER INFORMATION --}}
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

                    {{-- CONTENT --}}
                    <p class="whitespace-pre-line leading-relaxed text-gray-700">
                        {{ $menfess->content }}
                    </p>

                    {{-- LIKE SECTION --}}
                    <div class="mt-5 flex items-center justify-between border-t border-pink-100 pt-4">

                        <form action="{{ route('menfesses.like', $menfess) }}" method="POST">
                            @csrf

                            <button
                                type="submit"
                                class="flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold transition
                                {{ $menfess->likedByUsers->isNotEmpty()
                                    ? 'bg-pink-100 text-pink-600'
                                    : 'bg-gray-50 text-gray-500 hover:bg-pink-50 hover:text-pink-500' }}"
                            >

                                <span class="text-lg">
                                    {{ $menfess->likedByUsers->isNotEmpty() ? '♥' : '♡' }}
                                </span>

                                <span>
                                    {{ $menfess->likedByUsers->isNotEmpty() ? 'Liked' : 'Like' }}
                                </span>

                                <span>
                                    {{ $menfess->likes_count }}
                                </span>

                            </button>
                        </form>

                        <p class="text-xs text-gray-400">
                            ♡ Be kind and respectful to one another.
                        </p>

                    </div>

                </div>

            @empty

                {{-- EMPTY STATE --}}
                <div class="rounded-2xl border border-pink-100 bg-white px-6 py-16 text-center">

                    <div class="mb-4 text-5xl">
                        💌
                    </div>

                    <h3 class="text-xl font-bold text-[#75465b]">
                        No menfess found
                    </h3>

                    <p class="mt-2 text-gray-400">
                        We couldn't find any menfess matching your search.
                        Try another keyword or category.
                    </p>

                    <a
                        href="{{ route('explore.index') }}"
                        class="mt-6 inline-block rounded-full bg-[#df7da3] px-6 py-3 font-semibold text-white transition hover:bg-[#cc648d]"
                    >
                        Clear Search
                    </a>

                </div>

            @endforelse

            {{-- PAGINATION --}}
            @if ($menfesses->hasPages())
                <div class="mt-8">
                    {{ $menfesses->links() }}
                </div>
            @endif

        </div>
    </div>

</x-layouts::app>
