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

        .suraq-dashboard .stat-card {
            background: white;
            border: 1px solid #f5dce6;
            border-radius: 18px;
            padding: 20px;
        }

        .suraq-dashboard .feed-card {
            background: white;
            border: 1px solid #f5dce6;
            border-radius: 18px;
            padding: 22px;
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

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                <div class="stat-card">
                    <div class="mb-3 text-2xl">📝</div>
                    <p class="muted text-sm">My Menfess</p>
                    <h3 class="mt-1 text-2xl font-bold">0</h3>
                    <p class="muted mt-1 text-xs">Total posts created</p>
                </div>

                <div class="stat-card">
                    <div class="mb-3 text-2xl">♡</div>
                    <p class="muted text-sm">Total Likes</p>
                    <h3 class="mt-1 text-2xl font-bold">0</h3>
                    <p class="muted mt-1 text-xs">Likes received</p>
                </div>

                <div class="stat-card">
                    <div class="mb-3 text-2xl">💬</div>
                    <p class="muted text-sm">Comments</p>
                    <h3 class="mt-1 text-2xl font-bold">0</h3>
                    <p class="muted mt-1 text-xs">Interactions received</p>
                </div>

            </div>
        </section>

        <!-- Main Content -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            <!-- Community Feed -->
            <section class="space-y-4 lg:col-span-2">

                <div class="flex items-center justify-between">
                    <h2 class="section-title mb-0">Community Feed</h2>
                    <a href="{{ route('community.home') }}" class="pink-text text-sm font-semibold">
                        Explore more ♡
                    </a>
                </div>

                <!-- Sample Menfess -->
                <article class="feed-card">
                    <div class="mb-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-pink-100 text-xl">
                                🌸
                            </div>

                            <div>
                                <h3 class="text-sm font-bold">Anonymous</h3>
                                <p class="muted text-xs">Student Community · Sample post</p>
                            </div>
                        </div>

                        <span class="rounded-full bg-pink-50 px-3 py-1 text-xs font-semibold pink-text">
                            ANONYMOUS
                        </span>
                    </div>

                    <p class="text-sm leading-7">
                        Sometimes being a student is exhausting.
                        But remember, everyone has their own journey.
                        Keep going, you're doing great! ♡
                    </p>

                    <div class="muted mt-5 flex gap-5 border-t border-pink-100 pt-4 text-xs">
                        <span>♡ 24 Likes</span>
                        <span>💬 8 Comments</span>
                    </div>
                </article>

                <article class="feed-card">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-full bg-pink-100 text-xl">
                            🌷
                        </div>

                        <div>
                            <h3 class="text-sm font-bold">Anonymous</h3>
                            <p class="muted text-xs">Campus Life · Sample post</p>
                        </div>
                    </div>

                    <p class="text-sm leading-7">
                        To everyone who is working hard for their dreams:
                        don't forget to take a break and appreciate yourself.
                        You deserve happiness too. ♡
                    </p>

                    <div class="muted mt-5 flex gap-5 border-t border-pink-100 pt-4 text-xs">
                        <span>♡ 16 Likes</span>
                        <span>💬 5 Comments</span>
                    </div>
                </article>

            </section>

            <!-- Right Sidebar -->
            <aside class="space-y-6">

                <section>
                    <h2 class="section-title">Trending Topics ✨</h2>

                    <div class="space-y-3">
                        <div class="topic-card">
                            <p class="pink-text text-xs font-bold">#01 · TRENDING</p>
                            <h3 class="mt-2 text-sm font-bold">Campus Life</h3>
                            <p class="muted mt-1 text-xs">Stories and moments from campus.</p>
                        </div>

                        <div class="topic-card">
                            <p class="pink-text text-xs font-bold">#02 · POPULAR</p>
                            <h3 class="mt-2 text-sm font-bold">Love & Friendship</h3>
                            <p class="muted mt-1 text-xs">Share your little stories.</p>
                        </div>

                        <div class="topic-card">
                            <p class="pink-text text-xs font-bold">#03 · COMMUNITY</p>
                            <h3 class="mt-2 text-sm font-bold">Academic Talks</h3>
                            <p class="muted mt-1 text-xs">Discuss study and college life.</p>
                        </div>
                    </div>
                </section>

                <section class="topic-card">
                    <h2 class="mb-3 font-bold">A Little Reminder ♡</h2>
                    <p class="muted text-sm leading-6">
                        Your voice matters. Be kind to yourself and
                        respect other people's stories.
                    </p>
                </section>

            </aside>

        </div>

    </div>

</x-layouts::app>
