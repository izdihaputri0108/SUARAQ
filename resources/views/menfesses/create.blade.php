<x-layouts::app :title="'Create Menfess'">

    <style>
        .create-page {
            min-height: 100vh;
            padding: 45px;
            background: #fff5f9;
        }

        .create-heading {
            max-width: 1100px;
            margin: auto;
        }

        .create-heading .eyebrow {
            color: #df78a0;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 2px;
        }

        .create-heading h1 {
            margin-top: 12px;
            color: #d96f9a;
            font-size: 36px;
            font-weight: 700;
        }

        .create-heading p {
            margin-top: 10px;
            color: #987b89;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            border: 1px solid #f3c9da;
            border-radius: 30px;
            color: #d96f9a;
            text-decoration: none;
        }

        .menfess-card {
            max-width: 900px;
            margin: 35px auto;
            padding: 38px;
            background: white;
            border: 1px solid #f5d5e2;
            border-radius: 24px;
            box-shadow: 0 10px 35px rgba(217, 111, 154, 0.07);
        }

        .card-heading {
            display: flex;
            align-items: center;
            gap: 18px;
            padding-bottom: 25px;
            border-bottom: 1px solid #f7e4ec;
        }

        .card-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            border-radius: 18px;
            background: #fff0f6;
            font-size: 27px;
        }

        .card-heading h2 {
            color: #493440;
            font-size: 22px;
            font-weight: 700;
        }

        .card-heading p {
            margin-top: 5px;
            color: #a28a96;
            font-size: 14px;
        }

        .form-group {
            margin-top: 25px;
        }

        .form-group label,
        .form-label {
            display: block;
            margin-bottom: 10px;
            color: #624957;
            font-size: 15px;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 15px 18px;
            border: 1px solid #f0cfdd;
            border-radius: 14px;
            background: #fffbfd;
            color: #493440;
            outline: none;
        }

        .form-control:focus {
            border-color: #df78a0;
            box-shadow: 0 0 0 3px rgba(223, 120, 160, 0.12);
        }

        textarea.form-control {
            min-height: 190px;
            resize: vertical;
        }

        .identity-options {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .identity-option {
            flex: 1;
            min-width: 200px;
            padding: 18px;
            border: 1px solid #f0cfdd;
            border-radius: 14px;
            background: #fffbfd;
            color: #624957;
        }

        .identity-option input {
            margin-right: 8px;
            accent-color: #df78a0;
        }

        .identity-option p {
            margin: 8px 0 0 25px;
            color: #a28a96;
            font-size: 12px;
        }

        .submit-button {
            width: 100%;
            margin-top: 30px;
            padding: 16px;
            border: none;
            border-radius: 30px;
            background: #df78a0;
            color: white;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
        }

        .submit-button:hover {
            background: #d45f8d;
        }

        .success-message {
            max-width: 900px;
            margin: 20px auto;
            padding: 16px 20px;
            border: 1px solid #b8e3c5;
            border-radius: 12px;
            background: #effaf2;
            color: #287747;
        }

        .error-message {
            margin-top: 8px;
            color: #d64d76;
            font-size: 13px;
        }

        @media (max-width: 640px) {
            .create-page {
                padding: 25px 16px;
            }

            .menfess-card {
                padding: 22px;
            }

            .create-heading h1 {
                font-size: 29px;
            }
        }
    </style>

    <div class="create-page">

        <div class="create-heading">
            <span class="eyebrow">YOUR SPACE, YOUR VOICE ♡</span>

            <h1>Create Menfess ♡</h1>

            <p>
                Every story deserves to be heard.
                Share yours with SUARAQ!
            </p>

            <a href="{{ route('dashboard') }}" class="back-link">
                ← Back to Dashboard
            </a>
        </div>

        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="menfess-card">

            <div class="card-heading">
                <div class="card-icon">💌</div>

                <div>
                    <h2>What's on your mind?</h2>
                    <p>Feel free to express yourself. This is your safe space.</p>
                </div>
            </div>

            <form action="{{ route('menfesses.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="category">Menfess Category</label>

                    <select
                        name="category"
                        id="category"
                        class="form-control"
                        required
                    >
                        <option value="">Choose a category</option>
                        <option value="Campus Life" {{ old('category') == 'Campus Life' ? 'selected' : '' }}>Campus Life</option>
                        <option value="Love & Friendship" {{ old('category') == 'Love & Friendship' ? 'selected' : '' }}>Love & Friendship</option>
                        <option value="Academic Talks" {{ old('category') == 'Academic Talks' ? 'selected' : '' }}>Academic Talks</option>
                        <option value="Confession" {{ old('category') == 'Confession' ? 'selected' : '' }}>Confession</option>
                        <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>

                    @error('category')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Your Message</label>

                    <textarea
                        name="content"
                        id="content"
                        class="form-control"
                        placeholder="Write your thoughts here... Tell us what's on your mind ♡"
                        maxlength="2000"
                        required
                    >{{ old('content') }}</textarea>

                    @error('content')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <span class="form-label">Choose Your Identity</span>

                    <div class="identity-options">

                        <label class="identity-option">
                            <input
                                type="radio"
                                name="is_anonymous"
                                value="1"
                                {{ old('is_anonymous', '1') == '1' ? 'checked' : '' }}
                            >
                            <strong>Anonymous ♡</strong>
                            <p>Your identity will be hidden from other users.</p>
                        </label>

                        <label class="identity-option">
                            <input
                                type="radio"
                                name="is_anonymous"
                                value="0"
                                {{ old('is_anonymous') == '0' ? 'checked' : '' }}
                            >
                            <strong>Public Identity</strong>
                            <p>Your name will be visible to other users.</p>
                        </label>

                    </div>

                    @error('is_anonymous')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="submit-button">
                    Submit Menfess ♡
                </button>

            </form>
        </div>
    </div>

</x-layouts::app>