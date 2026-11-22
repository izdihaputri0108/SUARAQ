<?php

use Livewire\Component;

new class extends Component {}; ?>

<section class="suraq-delete-section mt-10 space-y-6">

    <style>
        .suraq-delete-section {
            padding: 22px;
            background: #fff8fa;
            border: 1px solid #f4dce5;
            border-radius: 16px;
        }

        .suraq-delete-section [data-flux-heading] {
            color: #c65f7d;
            font-weight: 700;
        }

        .suraq-delete-section [data-flux-subheading] {
            color: #987b89;
        }

        .suraq-delete-section .suraq-delete-button {
            background: #fff0f2 !important;
            color: #c65f7d !important;
            border: 1px solid #edc5d0 !important;
            border-radius: 11px !important;
            font-weight: 600 !important;
        }

        .suraq-delete-section .suraq-delete-button:hover {
            background: #fce1e7 !important;
        }
    </style>

    <div class="relative mb-5">
        <flux:heading>
            {{ __('Delete account') }}
        </flux:heading>

        <flux:subheading>
            {{ __('Delete your account and all of its resources') }}
        </flux:subheading>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <flux:button
            variant="danger"
            class="suraq-delete-button"
            data-test="delete-user-button">
            {{ __('Delete account') }}
        </flux:button>
    </flux:modal.trigger>

    <livewire:pages::settings.delete-user-modal />

</section>
