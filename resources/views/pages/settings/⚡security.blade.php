<?php

use App\Concerns\PasswordValidationRules;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Livewire\Attributes\Title;
use Livewire\Component;
use Laravel\Passkeys\Actions\DeletePasskey;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;

new #[Title('Security settings')] class extends Component {
    use PasswordValidationRules;

    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public bool $canManageTwoFactor;
    public bool $twoFactorEnabled;
    public bool $requiresConfirmation;

    #[Locked]
    public bool $canManagePasskeys;

    #[Locked]
    public array $passkeys = [];

    public bool $showDeleteModal = false;

    #[Locked]
    public ?int $deletingPasskeyId = null;

    #[Locked]
    public string $deletingPasskeyName = '';

    public function mount(DisableTwoFactorAuthentication $disableTwoFactorAuthentication): void
    {
        $this->canManageTwoFactor = Features::canManageTwoFactorAuthentication();

        if ($this->canManageTwoFactor) {
            if (Fortify::confirmsTwoFactorAuthentication() && is_null(auth()->user()->two_factor_confirmed_at)) {
                $disableTwoFactorAuthentication(auth()->user());
            }

            $this->twoFactorEnabled = auth()->user()->hasEnabledTwoFactorAuthentication();
            $this->requiresConfirmation = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirm');
        }

        $this->canManagePasskeys = Features::canManagePasskeys();

        if ($this->canManagePasskeys) {
            $this->loadPasskeys();
        }
    }

    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => $this->currentPasswordRules(),
                'password' => $this->passwordRules(),
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => $validated['password'],
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        Flux::toast(variant: 'success', text: __('Password updated.'));
    }

    public function loadPasskeys(): void
    {
        $this->passkeys = auth()->user()->passkeys()
            ->select(['id', 'name', 'credential', 'created_at', 'last_used_at'])
            ->latest()
            ->get()
            ->map(fn ($passkey) => [
                'id' => $passkey->id,
                'name' => $passkey->name,
                'authenticator' => $passkey->authenticator,
                'created_at_diff' => $passkey->created_at->diffForHumans(),
                'last_used_at_diff' => $passkey->last_used_at?->diffForHumans(),
            ])
            ->toArray();
    }

    public function confirmDelete(int $passkeyId): void
    {
        $passkey = auth()->user()->passkeys()->findOrFail($passkeyId);

        $this->deletingPasskeyId = $passkey->id;
        $this->deletingPasskeyName = $passkey->name;
        $this->showDeleteModal = true;
    }

    public function deletePasskey(DeletePasskey $deletePasskey): void
    {
        if (! $this->deletingPasskeyId) {
            return;
        }

        $passkey = auth()->user()->passkeys()->findOrFail($this->deletingPasskeyId);

        $deletePasskey(auth()->user(), $passkey);

        $this->closeDeleteModal();
        $this->loadPasskeys();
    }

    public function closeDeleteModal(): void
    {
        $this->showDeleteModal = false;
        $this->deletingPasskeyId = null;
        $this->deletingPasskeyName = '';
    }

    #[On('two-factor-enabled')]
    public function onTwoFactorEnabled(): void
    {
        $this->twoFactorEnabled = true;
    }

    public function disable(DisableTwoFactorAuthentication $disableTwoFactorAuthentication): void
    {
        $disableTwoFactorAuthentication(auth()->user());

        $this->twoFactorEnabled = false;
    }
}; ?>

<section class="w-full suraq-security-settings">

    <style>
        .suraq-security-settings {
            color: #493640;
        }

        .suraq-security-settings [data-flux-heading] {
            color: #d96f9a;
            font-weight: 700;
        }

        .suraq-security-settings [data-flux-subheading] {
            color: #987b89;
        }

        .suraq-security-settings [data-flux-input] {
            border-color: #f0d5e0;
            border-radius: 10px;
        }

        .suraq-security-settings [data-flux-input]:focus-within {
            border-color: #d96f9a;
            box-shadow: 0 0 0 3px rgba(217, 111, 154, 0.12);
        }

        /* Save Changes */
        .suraq-security-settings button[data-test="update-password-button"] {
            background: #d96f9a !important;
            background-color: #d96f9a !important;
            border-color: #d96f9a !important;
            color: #ffffff !important;
            border-radius: 10px !important;
        }

        .suraq-security-settings button[data-test="update-password-button"]:hover {
            background: #c85d89 !important;
            background-color: #c85d89 !important;
            border-color: #c85d89 !important;
        }

        /* Enable 2FA */
        .suraq-security-settings button[data-test="enable-two-factor-button"] {
            background: #d96f9a !important;
            background-color: #d96f9a !important;
            border-color: #d96f9a !important;
            color: #ffffff !important;
            border-radius: 10px !important;
        }

        .suraq-security-settings button[data-test="enable-two-factor-button"]:hover {
            background: #c85d89 !important;
            background-color: #c85d89 !important;
            border-color: #c85d89 !important;
        }

        .suraq-security-settings .suraq-security-card {
            padding: 24px;
            background: #ffffff;
            border: 1px solid #f5dce6;
            border-radius: 18px;
        }

        .suraq-security-settings .suraq-security-section {
            padding-top: 28px;
            margin-top: 28px;
            border-top: 1px solid #f5e5ec;
        }

        .suraq-security-settings [data-flux-button][data-variant="danger"] {
            border-radius: 10px;
        }

        @media (max-width: 640px) {
            .suraq-security-settings .suraq-security-card {
                padding: 18px;
            }
        }
    </style>

    @include('partials.settings-heading')

    <flux:heading level="2" class="sr-only">
        {{ __('Security settings') }}
    </flux:heading>

    <x-pages::settings.layout
        :heading="__('Update password')"
        :subheading="__('Ensure your account is using a long, random password to stay secure')"
    >

        <div class="suraq-security-card">

            <form method="POST" wire:submit="updatePassword" class="space-y-6">

                <flux:input
                    wire:model="current_password"
                    :label="__('Current password')"
                    type="password"
                    required
                    autocomplete="current-password"
                    viewable
                />

                <flux:input
                    wire:model="password"
                    :label="__('New password')"
                    type="password"
                    required
                    autocomplete="new-password"
                    passwordrules="{{ \Illuminate\Validation\Rules\Password::defaults()->toPasswordRulesString() }}"
                    viewable
                />

                <flux:input
                    wire:model="password_confirmation"
                    :label="__('Confirm password')"
                    type="password"
                    required
                    autocomplete="new-password"
                    passwordrules="{{ \Illuminate\Validation\Rules\Password::defaults()->toPasswordRulesString() }}"
                    viewable
                />

                <div class="flex items-center gap-4 pt-2">

                    <flux:button
                        variant="primary"
                        type="submit"
                        data-test="update-password-button"
                    >
                        {{ __('Save Changes') }}
                    </flux:button>

                </div>

            </form>

            @if ($canManageTwoFactor)
                <section class="suraq-security-section">

                    <flux:heading>
                        {{ __('Two-factor authentication') }}
                    </flux:heading>

                    <flux:subheading>
                        {{ __('Manage your two-factor authentication settings') }}
                    </flux:subheading>

                    <div class="flex flex-col w-full mx-auto space-y-6 text-sm mt-5" wire:cloak>

                        @if ($twoFactorEnabled)

                            <div class="space-y-4">

                                <flux:text>
                                    {{ __('You will be prompted for a secure, random pin during login, which you can retrieve from the TOTP-supported application on your phone.') }}
                                </flux:text>

                                <div class="flex justify-start">
                                    <flux:button
                                        variant="danger"
                                        wire:click="disable"
                                    >
                                        {{ __('Disable 2FA') }}
                                    </flux:button>
                                </div>

                                <livewire:pages::settings.two-factor.recovery-codes :$requiresConfirmation />

                            </div>

                        @else

                            <div class="space-y-4">

                                <flux:text variant="subtle">
                                    {{ __('When you enable two-factor authentication, you will be prompted for a secure pin during login. This pin can be retrieved from a TOTP-supported application on your phone.') }}
                                </flux:text>

                                <flux:modal.trigger name="two-factor-setup-modal">

                                    <flux:button
                                        variant="primary"
                                        wire:click="$dispatch('start-two-factor-setup')"
                                        data-test="enable-two-factor-button"
                                    >
                                        {{ __('Enable 2FA') }}
                                    </flux:button>

                                </flux:modal.trigger>

                                <livewire:pages::settings.two-factor-setup-modal :requires-confirmation="$requiresConfirmation" />

                            </div>

                        @endif

                    </div>

                </section>
            @endif

            @if ($canManagePasskeys)
                <section class="suraq-security-section">

                    <flux:heading>
                        {{ __('Passkeys') }}
                    </flux:heading>

                    <flux:subheading>
                        {{ __('Manage your passkeys for passwordless sign-in') }}
                    </flux:subheading>

                    <div class="mt-6 flex flex-col w-full mx-auto space-y-6 text-sm" wire:cloak>

                        <div class="border rounded-xl border-pink-100 overflow-hidden">

                            @forelse ($passkeys as $passkey)

                                <div class="flex items-center justify-between p-4 {{ ! $loop->last ? 'border-b border-pink-100' : '' }}">

                                    <div class="flex items-center gap-4">

                                        <div class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-pink-50">
                                            <flux:icon.key class="size-5 text-pink-500" />
                                        </div>

                                        <div class="space-y-1">

                                            <div class="flex items-center gap-2.5">
                                                <p class="font-medium tracking-tight">
                                                    {{ $passkey['name'] }}
                                                </p>

                                                @if ($passkey['authenticator'])
                                                    <flux:badge size="sm">
                                                        {{ $passkey['authenticator'] }}
                                                    </flux:badge>
                                                @endif
                                            </div>

                                            <p class="text-zinc-500 text-xs">
                                                {{ __('Added :time', ['time' => $passkey['created_at_diff']]) }}

                                                @if ($passkey['last_used_at_diff'])
                                                    <span class="opacity-50 mx-1">/</span>
                                                    {{ __('Last used :time', ['time' => $passkey['last_used_at_diff']]) }}
                                                @endif
                                            </p>

                                        </div>

                                    </div>

                                    <flux:button
                                        variant="ghost"
                                        size="sm"
                                        icon="trash"
                                        icon:variant="outline"
                                        wire:click="confirmDelete({{ $passkey['id'] }})"
                                        class="text-red-500 hover:text-red-600 hover:bg-red-50"
                                    />

                                </div>

                            @empty

                                <div class="p-8 text-center">

                                    <div class="mx-auto mb-4 flex size-14 items-center justify-center rounded-2xl bg-pink-50">
                                        <flux:icon.key class="size-7 text-pink-400" />
                                    </div>

                                    <p class="font-medium">
                                        {{ __('No passkeys yet') }}
                                    </p>

                                    <flux:text class="mt-1">
                                        {{ __('Add a passkey to sign in without a password') }}
                                    </flux:text>

                                </div>

                            @endforelse

                        </div>

                        <x-passkey-registration />

                    </div>

                </section>
            @endif

        </div>

    </x-pages::settings.layout>

    <flux:modal
        name="delete-passkey-modal"
        class="max-w-md md:min-w-md"
        @close="closeDeleteModal"
        wire:model="showDeleteModal"
    >

        <div class="space-y-6">

            <div class="space-y-2">

                <flux:heading size="lg">
                    {{ __('Remove passkey') }}
                </flux:heading>

                <flux:text>
                    {{ __('Are you sure you want to remove the passkey ":name"? You will no longer be able to use it to sign in.', ['name' => $deletingPasskeyName]) }}
                </flux:text>

            </div>

            <div class="flex gap-3 justify-end">

                <flux:button
                    variant="outline"
                    wire:click="closeDeleteModal"
                >
                    {{ __('Cancel') }}
                </flux:button>

                <flux:button
                    variant="danger"
                    wire:click="deletePasskey"
                >
                    {{ __('Remove passkey') }}
                </flux:button>

            </div>

        </div>

    </flux:modal>

</section>
