
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'DM Sans', sans-serif;
            background: #fff7fa;
            color: #493640;
        }

        .auth-page {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 45px 20px;
            position: relative;
            overflow: hidden;
        }

        .auth-decoration {
            position: fixed;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: #f9dce8;
            opacity: .55;
            pointer-events: none;
        }

        .decoration-one {
            top: -150px;
            left: -100px;
        }

        .decoration-two {
            bottom: -170px;
            right: -100px;
            background: #f5cbdc;
        }

        .auth-container {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 1;
            margin: auto 0;
        }

        .auth-brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .auth-logo {
            font-size: 38px;
            font-weight: 800;
            letter-spacing: -1.5px;
            color: #df7da1;
        }

        .auth-tagline {
            font-size: 11px;
            letter-spacing: 2px;
            color: #a98796;
            margin-top: 3px;
        }

        .auth-card {
            background: #ffffff;
            padding: 36px;
            border: 1px solid #f5dce6;
            border-radius: 24px;
            box-shadow: 0 15px 45px rgba(191, 117, 148, .10);
        }

        .auth-footer {
            text-align: center;
            margin-top: 24px;
            font-size: 13px;
            color: #a98796;
        }

        @media (max-width: 480px) {
            .auth-page {
                padding: 30px 16px;
            }

            .auth-card {
                padding: 26px 20px;
            }

            .auth-logo {
                font-size: 32px;
            }
        }
    </style>
</head>

<body>
    <main class="auth-page">
        <div class="auth-decoration decoration-one"></div>
        <div class="auth-decoration decoration-two"></div>

        <div class="auth-container">
            <div class="auth-brand">
                <a href="{{ route('home') }}" style="text-decoration: none;">
                    <div class="auth-logo">SUARAQ</div>
                    <div class="auth-tagline">YOUR SPACE, YOUR VOICE ♡</div>
                </a>
            </div>

            <div class="auth-card">
                {{ $slot }}
            </div>

            <div class="auth-footer">
                A little space for every voice to be heard ♡
            </div>
        </div>
    </main>

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts
</body>
</html>