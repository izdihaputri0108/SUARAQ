<?php

use App\Concerns\ProfileValidationRules;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Profile settings')] class extends Component {
    use ProfileValidationRules;

    public string $name = '';
    public string $email = '';

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        if (config('fortify.lowercase_usernames')) {
            $this->email = Str::lower($this->email);
        }

        $validated = $this->validate($this->profileRules($user->id));

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        Flux::toast(variant: 'success', text: __('Profile updated.'));
    }

    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    #[Computed]
    public function hasUnverifiedEmail(): bool
    {
        return Auth::user() instanceof MustVerifyEmail && ! Auth::user()->hasVerifiedEmail();
    }

    #[Computed]
    public function showDeleteUser(): bool
    {
        return ! Auth::user() instanceof MustVerifyEmail
            || (Auth::user() instanceof MustVerifyEmail && Auth::user()->hasVerifiedEmail());
    }
}; ?>

<section class="w-full suraq-profile">

    <style>
        .suraq-profile {
            color: #493640;
        }

        .suraq-profile .suraq-profile-form {
            margin-top: 25px;
            padding-bottom: 28px;
            border-bottom: 1px solid #f5dce6;
        }

        .suraq-profile .suraq-save-button {
            background: #df7da1 !important;
            color: #ffffff !important;
            border: 1px solid #df7da1 !important;
            border-radius: 12px !important;
            padding: 10px 25px !important;
            font-weight: 600 !important;
            transition: .2s ease;
        }

        .suraq-profile .suraq-save-button:hover {
            background: #cf6b91 !important;
            border-color: #cf6b91 !important;
        }

        .suraq-profile [data-flux-input] {
            border-color: #f1d5e0;
            border-radius: 11px;
        }

        .suraq-profile [data-flux-input]:focus-within {
            border-color: #df7da1;
            --tw-ring-color: #df7da1;
        }
    </style>

    @include('partials.settings-heading')

    <flux:heading level="2" class="sr-only">
        {{ __('Profile settings') }}
    </flux:heading>

    <x-pages::settings.layout
        :heading="__('Profile')"
        :subheading="__('Update your name and email address')">

        <form wire:submit="updateProfileInformation"
            class="suraq-profile-form w-full space-y-6">

            <flux:input
                wire:model="name"
                :label="__('Name')"
                type="text"
                required
                autofocus
                autocomplete="name"
            />

            <div>
                <flux:input
                    wire:model="email"
                    :label="__('Email')"
                    type="email"
                    required
                    autocomplete="email"
                />

                @if ($this->hasUnverifiedEmail)
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link
                                class="text-sm cursor-pointer"
                                wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <flux:button
                    variant="primary"
                    type="submit"
                    class="suraq-save-button"
                    data-test="update-profile-button">
                    {{ __('Save Changes') }}
                </flux:button>
            </div>

        </form>

        @if ($this->showDeleteUser)
            <livewire:pages::settings.delete-user-form />
        @endif

    </x-pages::settings.layout>
</section>
