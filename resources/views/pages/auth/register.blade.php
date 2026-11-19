
<x-layouts::auth :title="__('Register')">
    <div style="display: flex; flex-direction: column; gap: 24px;">

        <!-- Register Header -->
        <div style="text-align: center;">
            <h1 style="font-size: 26px; font-weight: 700; color: #493640; margin: 0;">
                Join SUARAQ! ♡
            </h1>
            <p style="font-size: 14px; color: #a98796; margin-top: 8px;">
                Create your account and let your voice be heard.
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status
            class="text-center"
            :status="session('status')"
        />

        <!-- Register Form -->
        <form
            method="POST"
            action="{{ route('register.store') }}"
            style="display: flex; flex-direction: column; gap: 18px;"
        >
            @csrf

            <!-- Full Name -->
            <div>
                <label style="display: block; margin-bottom: 9px; font-size: 14px; font-weight: 600; color: #493640;">
                    Full Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter your full name"
                    required
                    autofocus
                    autocomplete="name"
                    style="width: 100%; padding: 14px; border: 1px solid #f3dce6; border-radius: 12px; background: #fffafd; outline: none;"
                >

                @error('name')
                    <p style="color: #dc5555; font-size: 12px; margin-top: 5px;">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label style="display: block; margin-bottom: 9px; font-size: 14px; font-weight: 600; color: #493640;">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="email@example.com"
                    required
                    autocomplete="email"
                    style="width: 100%; padding: 14px; border: 1px solid #f3dce6; border-radius: 12px; background: #fffafd; outline: none;"
                >

                @error('email')
                    <p style="color: #dc5555; font-size: 12px; margin-top: 5px;">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label style="display: block; margin-bottom: 9px; font-size: 14px; font-weight: 600; color: #493640;">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Create your password"
                    required
                    autocomplete="new-password"
                    style="width: 100%; padding: 14px; border: 1px solid #f3dce6; border-radius: 12px; background: #fffafd; outline: none;"
                >

                @error('password')
                    <p style="color: #dc5555; font-size: 12px; margin-top: 5px;">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label style="display: block; margin-bottom: 9px; font-size: 14px; font-weight: 600; color: #493640;">
                    Confirm Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Re-enter your password"
                    required
                    autocomplete="new-password"
                    style="width: 100%; padding: 14px; border: 1px solid #f3dce6; border-radius: 12px; background: #fffafd; outline: none;"
                >
            </div>

            <!-- Register Button -->
            <button
                type="submit"
                data-test="register-user-button"
                style="width: 100%; padding: 15px; border: none; border-radius: 12px; background-color: #df7da1; color: white; font-size: 15px; font-weight: 700; cursor: pointer; margin-top: 5px;"
            >
                Create Account ♡
            </button>

        </form>

        <!-- Login Link -->
        <div style="text-align: center; font-size: 13px; color: #806d77;">
            Already have an account?

            <a
                href="{{ route('login') }}"
                wire:navigate
                style="color: #d9799d; font-weight: 700; text-decoration: none;"
            >
                Log in
            </a>
        </div>

    </div>
</x-layouts::auth>