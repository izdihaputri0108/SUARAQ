<div class="suraq-settings-layout">

    <style>
        .suraq-settings-layout {
            display: flex;
            align-items: flex-start;
            gap: 32px;
            width: 100%;
        }

        .suraq-settings-navigation {
            width: 220px;
            flex-shrink: 0;
            padding: 12px;
            background: #ffffff;
            border: 1px solid #f5dce6;
            border-radius: 18px;
        }

        .suraq-settings-content {
            flex: 1;
            min-width: 0;
            padding: 28px;
            background: #ffffff;
            border: 1px solid #f5dce6;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(217, 111, 154, 0.05);
        }

        .suraq-settings-content h2 {
            color: #493640;
        }

        .suraq-settings-content [data-flux-heading] {
            color: #d96f9a;
            font-weight: 700;
        }

        .suraq-settings-content [data-flux-subheading] {
            color: #987b89;
        }

        .suraq-settings-layout [data-flux-navlist-item] {
            border-radius: 12px;
        }

        .suraq-settings-layout [data-flux-navlist-item][aria-current="page"] {
            background: #fce8ef;
            color: #d96f9a;
        }

        @media (max-width: 767px) {
            .suraq-settings-layout {
                flex-direction: column;
                gap: 18px;
            }

            .suraq-settings-navigation {
                width: 100%;
            }

            .suraq-settings-content {
                width: 100%;
                padding: 20px;
            }
        }
    </style>

    <!-- SETTINGS NAVIGATION -->
    <div class="suraq-settings-navigation">

        <flux:navlist aria-label="{{ __('Settings') }}">

            <flux:navlist.item
                :href="route('profile.edit')"
                :current="request()->routeIs('profile.edit')"
                wire:navigate>
                Profile
            </flux:navlist.item>

            <flux:navlist.item
                :href="route('security.edit')"
                :current="request()->routeIs('security.edit')"
                wire:navigate>
                Security
            </flux:navlist.item>

            <flux:navlist.item
                :href="route('appearance.edit')"
                :current="request()->routeIs('appearance.edit')"
                wire:navigate>
                Appearance
            </flux:navlist.item>

        </flux:navlist>

    </div>

    <!-- SETTINGS CONTENT -->
    <div class="suraq-settings-content">

        <flux:heading>
            {{ $heading ?? '' }}
        </flux:heading>

        <flux:subheading>
            {{ $subheading ?? '' }}
        </flux:subheading>

        <div class="mt-6 w-full">
            {{ $slot }}
        </div>

    </div>

</div>
