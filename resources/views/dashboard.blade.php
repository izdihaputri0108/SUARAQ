<x-layouts::app :title="__('Dashboard')">

    <style>
        .suraq-dashboard {
            color: #493640;
            font-family: 'DM Sans', sans-serif;
        }

        .suraq-dashboard .pink-text {
            color: #d9799d;
        }

        .suraq-dashboard .welcome-card {
            background: linear-gradient(120deg, #f9dce8, #fff0f5);
            border-radius: 22px;
            padding: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .suraq-dashboard .create-btn {
            display: inline-block;
            background: #df7da1;
            color: white;
            padding: 12px 22px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
        }

        .suraq-dashboard .create-btn:hover {
            background: #cc668d;
        }

        .suraq-dashboard .stat-card,
        .suraq-dashboard .feed-card {
            background: white;
            border: 1px solid #f5dce6;
            border-radius: 18px;
            padding: 20px;
        }

        .suraq-dashboard .topic-card {
            background: #fff7fa;
            border: 1px solid #f5dce6;
            border-radius: 14px;
            padding: 15px;
        }

        .suraq-dashboard .muted {
            color: #a98796;
        }

        .suraq-dashboard .section-title {
            font-size: 19px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .suraq-dashboard .stat-number {
            color: #493640;
            font-size: 28px;
            font-weight: 800;
        }

        .suraq-dashboard .feed-content {
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        @media (max-width: 640px) {
            .suraq-dashboard .welcome-card {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <div class="suraq-dashboard space-y-7">

        <!-- Header -->
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold">
                    Hi, {{ auth()->user()->name }}! ♡
                </h1>

                <p class="muted mt-1 text-sm">
                    Welcome to your little space. What's on your mind today?
                </p>
            </div>

            <div class="rounded-full border border-pink-100 bg-white px-4 py-2 text-sm pink-text">
                ✿ SUARAQ Community
            </div>
        </div>

        <!-- Welcome Banner -->
        <section class="welcome-card">
            <div>
                <p class="pink-text mb-2 text-sm font-bold">
                    YOUR SPACE, YOUR VOICE ♡
                </p>

                <h2 class="max-w-lg text-2xl font-bold leading-tight md:text-3xl">
                    Your thoughts deserve a place to be heard.
                </h2>

                <p class="muted mt-3 max-w-lg text-sm leading-6">
                    Share your stories, thoughts, and little secrets.
                    Be yourself and connect with other students.
                </p>

                <a href="{{ route('menfesses.create') }}" class="create-btn mt-5">
                    + Create Menfess
                </a>
            </div>

            <div class="hidden text-7xl md:block">
                💌
            </div>
        </section>

        <!-- Statistics -->
        <section>
            <h2 class="section-title">Your Activity Overview</h2>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

                <div class="stat-card">
                    <div class="mb-3 text-2xl">📝</div>
                    <p class="muted text-sm">Total Menfess</p>
                    <p class="stat-number mt-1">{{ $totalMenfesses }}</p>
                    <p class="muted mt-2 text-xs">All your submissions</p>
                </div>

                <div class="stat-card">
                    <div class="mb-3 text-2xl">⏳</div>
                    <p class="muted text-sm">Waiting Approval</p>
                    <p class="stat-number mt-1">{{ $pendingMenfesses }}</p>
                    <p class="muted mt-2 text-xs">Waiting for admin review</p>
                </div>

                <div class="stat-card">
                    <div class="mb-3 text-2xl">💗</div>
                    <p class="muted text-sm">Approved Menfess</p>
                    <p class="stat-number mt-1">{{ $approvedMenfesses }}</p>
                    <p class="muted mt-2 text-xs">Published in the community</p>
                </div>

                <div class="stat-card">
                    <div class="mb-3 text-2xl">♡</div>
                    <p class="muted text-sm">Likes Received</p>
                    <p class="stat-number mt-1">{{ $totalLikes }}</p>
                    <p class="muted mt-2 text-xs">Likes on your menfesses</p>
                </div>

            </div>
        </section>

        <!-- Main Content -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            <!-- Community Feed -->
            <section class="space-y-4 lg:col-span-2">

                <div class="flex flex-wrap items-center justify-between gap-3">
                    <h2 class="section-title mb-0">
                        Latest from Community
                    </h2>

                    <a href="{{ route('community.home') }}"
                       class="pink-text text-sm font-bold hover:underline">
                        View All →
                    </a>
                </div>

                @forelse ($latestMenfesses as $menfess)

                    <article class="feed-card">

                        <div class="mb-4 flex items-center gap-3">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-pink-100 text-xl">
                                {{ $menfess->is_anonymous ? '🌷' : '💗' }}
                            </div>

                            <div class="min-w-0">
                                <h3 class="text-sm font-bold">
                                    {{ $menfess->is_anonymous ? 'Anonymous' : ($menfess->user?->name ?? 'User') }}
                                </h3>

                                <p class="muted text-xs">
                                    {{ $menfess->category ?: 'General' }}
                                    ·
                                    {{ $menfess->created_at->diffForHumans() }}
                                </p>
                            </div>

                        </div>

                        <p class="feed-content text-sm leading-7">
                            {{ $menfess->content }}
                        </p>

                        <div class="muted mt-5 flex items-center gap-2 border-t border-pink-100 pt-4 text-xs">
                            <span>♡ {{ $menfess->likes_count }} Likes</span>
                        </div>

                    </article>

                @empty

                    <div class="feed-card py-10 text-center">
                        <div class="mb-3 text-4xl">🌸</div>

                        <h3 class="font-bold">
                            No menfess yet
                        </h3>

                        <p class="muted mt-2 text-sm">
                            There are no approved menfesses to show right now.
                        </p>

                        <a href="{{ route('menfesses.create') }}"
                           class="create-btn mt-5">
                            Create the First Menfess
                        </a>
                    </div>

                @endforelse

            </section>

            <!-- Right Sidebar -->
            <aside class="space-y-6">

                <!-- Trending Topics -->
                <section>
                    <h2 class="section-title">
                        Trending Topics ✨
                    </h2>

                    <div class="space-y-3">

                        @forelse ($trendingTopics as $index => $topic)

                            <div class="topic-card">

                                <p class="pink-text text-xs font-bold">
                                    #{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                    ·
                                    {{ $index === 0 ? 'TRENDING' : 'POPULAR' }}
                                </p>

                                <h3 class="mt-2 text-sm font-bold">
                                    {{ $topic->category }}
                                </h3>

                                <p class="muted mt-1 text-xs">
                                    {{ $topic->total }} approved menfess
                                </p>

                            </div>

                        @empty

                            <div class="topic-card">
                                <p class="muted text-sm">
                                    No trending topics yet. Be the first to share your story!
                                </p>
                            </div>

                        @endforelse

                    </div>
                </section>

                <!-- Reminder -->
                <section class="topic-card">
                    <h2 class="mb-3 font-bold">
                        A Little Reminder ♡
                    </h2>

                    <p class="muted text-sm leading-6">
                        Your voice matters. Be kind to yourself and
                        respect other people's stories.
                    </p>
                </section>

            </aside>

        </div>

    </div>

</x-layouts::app>
