
<x-layouts::auth :title="__('Log in')">
    <div style="display: flex; flex-direction: column; gap: 24px;">

        <div style="text-align: center;">
            <h1 style="font-size: 26px; font-weight: 700; color: #493640; margin: 0;">
                Welcome Back! ♡
            </h1>
            <p style="font-size: 14px; color: #a98796; margin-top: 8px;">
                Log in to your SUARAQ account
            </p>
        </div>

        <x-auth-session-status
            class="text-center"
            :status="session('status')"
        />

        <form method="POST" action="{{ route('login.store') }}"
              style="display: flex; flex-direction: column; gap: 20px;">
            @csrf

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
                    autofocus
                    autocomplete="email"
                    style="width: 100%; padding: 14px; border: 1px solid #f3dce6; border-radius: 12px; background: #fffafd; outline: none;"
                >

                @error('email')
                    <p style="color: #dc5555; font-size: 12px; margin-top: 5px;">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 9px;">
                    <label style="font-size: 14px; font-weight: 600; color: #493640;">
                        Password
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           wire:navigate
                           style="font-size: 12px; color: #d9799d; text-decoration: none;">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                    autocomplete="current-password"
                    style="width: 100%; padding: 14px; border: 1px solid #f3dce6; border-radius: 12px; background: #fffafd; outline: none;"
                >

                @error('password')
                    <p style="color: #dc5555; font-size: 12px; margin-top: 5px;">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #806d77;">
                <input type="checkbox" name="remember" value="1"
                    {{ old('remember') ? 'checked' : '' }}>
                Remember me
            </label>

            <button
                type="submit"
                data-test="login-button"
                style="width: 100%; padding: 15px; border: none; border-radius: 12px; background-color: #df7da1; color: white; font-size: 15px; font-weight: 700; cursor: pointer;"
            >
                Log in to SUARAQ ♡
            </button>
        </form>

        <div style="text-align: center; font-size: 13px; color: #806d77;">
            Don't have an account?

            <a href="{{ route('register') }}"
               wire:navigate
               style="color: #d9799d; font-weight: 700; text-decoration: none;">
                Sign up
            </a>
        </div>

    </div>
</x-layouts::auth>