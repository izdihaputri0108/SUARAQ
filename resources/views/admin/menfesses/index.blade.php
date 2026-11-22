<x-layouts::app :title="'Admin - Moderasi Menfess'">

    <style>
        .admin-page {
            min-height: 100vh;
            padding: 40px;
            background: #fff5f9;
        }

        .admin-container {
            max-width: 1150px;
            margin: auto;
        }

        .admin-eyebrow {
            color: #df78a0;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .admin-title {
            margin-top: 12px;
            color: #d96f9a;
            font-size: 35px;
            font-weight: 700;
        }

        .admin-description {
            margin-top: 10px;
            color: #987b89;
        }

        .admin-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .admin-link {
            display: inline-block;
            padding: 12px 20px;
            border: 1px solid #f3c9da;
            border-radius: 30px;
            color: #d96f9a;
            text-decoration: none;
            transition: .2s;
        }

        .admin-link:hover {
            background: #fce8ef;
        }

        .admin-stats {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            margin: 30px 0 20px;
            padding: 22px 25px;
            background: white;
            border: 1px solid #f5d5e2;
            border-radius: 18px;
        }

        .admin-stats p {
            color: #987b89;
            font-size: 13px;
        }

        .admin-stats strong {
            display: block;
            margin-top: 5px;
            color: #d96f9a;
            font-size: 28px;
        }

        .menfess-card {
            margin-bottom: 20px;
            padding: 27px;
            background: white;
            border: 1px solid #f5d5e2;
            border-radius: 20px;
            box-shadow: 0 10px 35px rgba(217, 111, 154, .06);
        }

        .menfess-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 22px;
        }

        .menfess-category {
            color: #d96f9a;
            font-size: 14px;
            font-weight: 700;
        }

        .menfess-meta {
            margin-top: 7px;
            color: #a28a96;
            font-size: 12px;
        }

        .pending-badge {
            padding: 8px 15px;
            border-radius: 30px;
            background: #fff4d9;
            color: #a97816;
            font-size: 12px;
            font-weight: 700;
        }

        .menfess-content {
            color: #624957;
            font-size: 15px;
            line-height: 1.9;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .menfess-footer {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
            padding-top: 17px;
            border-top: 1px solid #f7e4ec;
            color: #a28a96;
            font-size: 12px;
        }

        .moderation-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 22px;
        }

        .action-button {
            padding: 10px 18px;
            border: none;
            border-radius: 25px;
            color: white;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .approve-button {
            background: #67b982;
        }

        .approve-button:hover {
            background: #4c9e68;
        }

        .reject-button {
            background: #e58a9d;
        }

        .reject-button:hover {
            background: #d96b83;
        }

        .delete-button {
            background: #81717a;
        }

        .delete-button:hover {
            background: #62535c;
        }

        .success-message {
            margin-top: 25px;
            padding: 16px 20px;
            border: 1px solid #b8e5c5;
            border-radius: 14px;
            background: #effaf2;
            color: #267344;
            font-size: 14px;
        }

        .empty-card {
            padding: 60px 25px;
            text-align: center;
            background: white;
            border: 1px solid #f5d5e2;
            border-radius: 22px;
        }

        .empty-icon {
            font-size: 48px;
        }

        .empty-card h2 {
            margin-top: 15px;
            color: #d96f9a;
            font-size: 22px;
            font-weight: 700;
        }

        .empty-card p {
            margin-top: 9px;
            color: #987b89;
            font-size: 14px;
        }

        @media (max-width: 640px) {
            .admin-page {
                padding: 25px 16px;
            }

            .admin-title {
                font-size: 28px;
            }

            .menfess-card {
                padding: 20px;
            }
        }
    </style>

    <div class="admin-page">
        <div class="admin-container">

            <!-- HEADER -->
            <div>
                <span class="admin-eyebrow">
                    SUARAQ ADMIN PANEL ♡
                </span>

                <h1 class="admin-title">
                    Menfess Moderation
                </h1>

                <p class="admin-description">
                    Periksa, setujui, atau tolak menfess yang dikirim oleh pengguna SUARAQ.
                </p>

                <div class="admin-actions">
                    <a href="{{ route('dashboard') }}" class="admin-link">
                        ← Back to Dashboard
                    </a>

                    <a href="{{ route('community.home') }}" class="admin-link">
                        Community Feed
                    </a>
                </div>
            </div>

            <!-- SUCCESS MESSAGE -->
            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <!-- PENDING COUNT -->
            <div class="admin-stats">
                <div>
                    <p>Menfess Menunggu Persetujuan</p>

                    <strong>{{ $menfesses->count() }}</strong>
                </div>

                <span style="font-size: 35px;">📩</span>
            </div>

            <!-- MENFESS LIST -->
            @forelse ($menfesses as $menfess)

                <article class="menfess-card">

                    <!-- HEADER -->
                    <div class="menfess-header">
                        <div>
                            <p class="menfess-category">
                                {{ $menfess->category ?? 'General' }}
                            </p>

                            <p class="menfess-meta">
                                Pengirim:
                                @if ($menfess->is_anonymous)
                                    Anonymous
                                @else
                                    {{ $menfess->user?->name ?? 'User tidak ditemukan' }}
                                @endif
                            </p>
                        </div>

                        <span class="pending-badge">
                            Pending
                        </span>
                    </div>

                    <!-- CONTENT -->
                    <div class="menfess-content">
                        {{ $menfess->content }}
                    </div>

                    <!-- FOOTER -->
                    <div class="menfess-footer">
                        <span>
                            ID Menfess: #{{ $menfess->id }}
                        </span>

                        <span>
                            {{ $menfess->created_at->format('d M Y, H:i') }}
                        </span>
                    </div>

                    <!-- MODERATION BUTTONS -->
                    <div class="moderation-actions">

                        <form
                            action="{{ route('admin.menfesses.approve', $menfess) }}"
                            method="POST"
                        >
                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="action-button approve-button"
                            >
                                ✓ Approve
                            </button>
                        </form>

                        <form
                            action="{{ route('admin.menfesses.reject', $menfess) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menolak menfess ini?')"
                        >
                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="action-button reject-button"
                            >
                                ✕ Reject
                            </button>
                        </form>

                        <form
                            action="{{ route('admin.menfesses.destroy', $menfess) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus menfess ini secara permanen?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="action-button delete-button"
                            >
                                🗑 Delete
                            </button>
                        </form>

                    </div>

                </article>

            @empty

                <!-- EMPTY STATE -->
                <div class="empty-card">
                    <div class="empty-icon">🌷</div>

                    <h2>Belum Ada Menfess Pending</h2>

                    <p>
                        Semua menfess sudah diperiksa.
                        Saat ada kiriman baru, menfess tersebut akan muncul di sini.
                    </p>
                </div>

            @endforelse

        </div>
    </div>

</x-layouts::app>
