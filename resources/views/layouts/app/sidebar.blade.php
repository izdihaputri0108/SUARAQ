<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')

    <style>
        :root {
            --suraq-pink: #df7da1;
            --suraq-light: #fff6fa;
            --suraq-border: #f5dce6;
            --suraq-text: #493640;
        }

        body {
            background: var(--suraq-light) !important;
            color: var(--suraq-text);
        }

        .suraq-sidebar {
            background: #ffffff !important;
            border-right: 1px solid var(--suraq-border) !important;
        }

        .suraq-brand {
            color: var(--suraq-pink);
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .suraq-tagline {
            color: #a98796;
            font-size: 10px;
            letter-spacing: 1.5px;
        }

        main {
            min-height: 100vh;
            background: var(--suraq-light);
            padding: 24px !important;
        }

        .notification-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
            border-radius: 20px;
            background: #df7da1;
            color: white;
            font-size: 10px;
            font-weight: 800;
        }

        @media (max-width: 640px) {
            main {
                padding: 14px !important;
            }
        }
    </style>
</head>

<body class="min-h-screen">

    <!-- SIDEBAR -->
    <flux:sidebar sticky collapsible="mobile"
        class="suraq-sidebar border-e">

        <flux:sidebar.header>
            <a href="{{ route('community.home') }}" wire:navigate class="block px-2 py-3">
                <div class="suraq-brand">SUARAQ.</div>

                <div class="suraq-tagline mt-1">
                    YOUR SPACE, YOUR VOICE ♡
                </div>
            </a>

            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        <!-- MENU -->
        <flux:sidebar.nav>
            <flux:sidebar.group heading="MENU UTAMA" class="grid">

                <!-- DASHBOARD -->
                <flux:sidebar.item
                    icon="home"
                    :href="route('dashboard')"
                    :current="request()->routeIs('dashboard')"
                    wire:navigate>
                    Dashboard
                </flux:sidebar.item>

                <!-- HOME -->
                <flux:sidebar.item
                    icon="home"
                    :href="route('community.home')"
                    :current="request()->routeIs('community.home')"
                    wire:navigate>
                    Home
                </flux:sidebar.item>

                <!-- EXPLORE -->
                <flux:sidebar.item
                    icon="magnifying-glass"
                    :href="route('explore.index')"
                    :current="request()->routeIs('explore.*')"
                    wire:navigate>
                    Explore
                </flux:sidebar.item>

                <!-- CREATE MENFESS -->
                <flux:sidebar.item
                    icon="plus-circle"
                    :href="route('menfesses.create')"
                    :current="request()->routeIs('menfesses.create')"
                    wire:navigate>
                    Create Menfess
                </flux:sidebar.item>

                <!-- MY MENFESS -->
                <flux:sidebar.item
                    icon="heart"
                    :href="route('menfesses.my')"
                    :current="request()->routeIs('menfesses.my')"
                    wire:navigate>
                    My Menfess
                </flux:sidebar.item>

                <!-- NOTIFICATIONS -->
                <flux:sidebar.item
                    icon="bell"
                    :href="route('notifications.index')"
                    :current="request()->routeIs('notifications.*')"
                    wire:navigate>

                    <span class="flex w-full items-center justify-between gap-2">
                        <span>Notifications</span>

                        @php
                            $sidebarUnreadCount = auth()->user()
                                ->unreadNotifications()
                                ->count();
                        @endphp

                        @if ($sidebarUnreadCount > 0)
                            <span class="notification-count">
                                {{ $sidebarUnreadCount > 99 ? '99+' : $sidebarUnreadCount }}
                            </span>
                        @endif
                    </span>

                </flux:sidebar.item>

                <!-- MY PROFILE -->
                <flux:sidebar.item
                    icon="user"
                    :href="route('profile.edit')"
                    :current="request()->routeIs('profile.edit')"
                    wire:navigate>
                    My Profile
                </flux:sidebar.item>

                <!-- ADMIN MENU -->
                @if (auth()->user()->role === 'admin')
                    <flux:sidebar.item
                        icon="shield-check"
                        :href="route('admin.menfesses.index')"
                        :current="request()->routeIs('admin.menfesses.*')"
                        wire:navigate>
                        Moderasi Menfess
                    </flux:sidebar.item>
                @endif

            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:spacer />

        <!-- USER PROFILE -->
        <div class="border-t border-pink-100 px-3 py-4">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-pink-100 text-xl">
                    🌷
                </div>

                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-bold text-gray-800">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-gray-400">
                        Welcome to SUARAQ
                    </p>
                </div>

            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf

                <button
                    type="submit"
                    class="w-full rounded-xl border border-pink-100 px-3 py-2 text-left text-sm font-medium text-pink-600 hover:bg-pink-50">
                    Log out
                </button>
            </form>

        </div>

    </flux:sidebar>

    <!-- MOBILE HEADER -->
    <flux:header class="lg:hidden bg-white">
        <flux:sidebar.toggle icon="bars-2" inset="left" />

        <flux:spacer />

        <span class="font-bold text-pink-500">
            SUARAQ.
        </span>
    </flux:header>

    <!-- SLOT -->
    {{ $slot }}

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts

</body>
</html>
