<x-layouts::app :title="__('Notifications')">

    <div class="suraq-notifications">

        <style>
            .suraq-notifications {
                color: #493640;
                font-family: 'DM Sans', sans-serif;
            }

            .suraq-notifications .notification-header {
                background: linear-gradient(120deg, #f9dce8, #fff0f5);
                border-radius: 22px;
                padding: 28px;
                margin-bottom: 25px;
            }

            .suraq-notifications .pink-text {
                color: #d9799d;
            }

            .suraq-notifications .muted {
                color: #a98796;
            }

            .suraq-notifications .notification-card {
                background: white;
                border: 1px solid #f5dce6;
                border-radius: 18px;
                padding: 20px;
                display: flex;
                align-items: flex-start;
                gap: 15px;
                margin-bottom: 14px;
            }

            .suraq-notifications .notification-card.unread {
                background: #fff7fa;
                border-color: #edb5cb;
            }

            .suraq-notifications .notification-icon {
                width: 45px;
                height: 45px;
                min-width: 45px;
                border-radius: 50%;
                background: #fce5ee;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
            }

            .suraq-notifications .notification-content {
                flex: 1;
                min-width: 0;
            }

            .suraq-notifications .notification-link {
                display: block;
                color: inherit;
                text-decoration: none;
                border-radius: 8px;
            }

            .suraq-notifications .notification-link:hover .notification-title {
                color: #d9799d;
            }

            .suraq-notifications .notification-title {
                font-weight: 700;
                font-size: 15px;
                margin-bottom: 5px;
                transition: color 0.2s;
            }

            .suraq-notifications .notification-message {
                font-size: 13px;
                line-height: 1.6;
                color: #806b75;
                overflow-wrap: anywhere;
            }

            .suraq-notifications .notification-time {
                font-size: 11px;
                color: #b69aa6;
                margin-top: 9px;
            }

            .suraq-notifications .unread-badge {
                display: inline-block;
                background: #fce5ee;
                color: #cc668d;
                padding: 5px 11px;
                border-radius: 20px;
                font-size: 11px;
                font-weight: 700;
            }

            .suraq-notifications .read-badge {
                display: inline-block;
                background: #f1f1f1;
                color: #888;
                padding: 5px 11px;
                border-radius: 20px;
                font-size: 11px;
                font-weight: 600;
            }

            .suraq-notifications .action-btn {
                border: none;
                background: #df7da1;
                color: white;
                padding: 10px 17px;
                border-radius: 25px;
                font-size: 12px;
                font-weight: 700;
                cursor: pointer;
            }

            .suraq-notifications .action-btn:hover {
                background: #cc668d;
            }

            .suraq-notifications .empty-state {
                background: white;
                border: 1px solid #f5dce6;
                border-radius: 20px;
                padding: 55px 20px;
                text-align: center;
            }

            .suraq-notifications .empty-icon {
                font-size: 45px;
                margin-bottom: 15px;
            }

            @media (max-width: 640px) {
                .suraq-notifications .notification-header {
                    padding: 22px;
                }

                .suraq-notifications .notification-card {
                    padding: 15px;
                }
            }
        </style>

        <!-- HEADER -->
        <div class="notification-header">
            <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; flex-wrap: wrap;">
                <div>
                    <h1 style="font-size: 25px; font-weight: 800; margin: 0 0 7px;">
                        Notifications <span class="pink-text">♡</span>
                    </h1>

                    <p class="muted" style="font-size: 13px; margin: 0;">
                        Stay updated with what's happening on SUARAQ.
                    </p>
                </div>

                <div style="background: white; padding: 12px 18px; border-radius: 15px;">
                    <div class="pink-text" style="font-size: 23px; font-weight: 800;">
                        {{ $unreadCount }}
                    </div>
                    <div class="muted" style="font-size: 11px;">
                        Unread Notifications
                    </div>
                </div>
            </div>
        </div>

        <!-- NOTIFICATION LIST HEADER -->
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 17px; flex-wrap: wrap;">
            <div>
                <h2 style="font-size: 18px; font-weight: 800; margin: 0;">
                    All Notifications
                </h2>
                <p class="muted" style="font-size: 12px; margin-top: 5px;">
                    Your latest updates and activities.
                </p>
            </div>

            @if ($unreadCount > 0)
                <form action="{{ route('notifications.read-all') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="action-btn">
                        Mark All as Read
                    </button>
                </form>
            @endif
        </div>

        <!-- SUCCESS MESSAGE -->
        @if (session('success'))
            <div style="background: #f0fff4; border: 1px solid #c6efd2; color: #287a46; padding: 13px 17px; border-radius: 12px; margin-bottom: 18px; font-size: 13px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- NOTIFICATIONS -->
        @forelse ($notifications as $notification)

            @php
                $detailUrl = !empty($notification->data['menfess_id'])
                    ? route('menfesses.show', $notification->data['menfess_id'])
                    : ($notification->data['url'] ?? route('notifications.index'));
            @endphp

            <div class="notification-card {{ $notification->read_at ? '' : 'unread' }}">

                <div class="notification-icon">
                    @if (($notification->data['title'] ?? '') === 'Menfess Disetujui!')
                        🎉
                    @elseif (($notification->data['title'] ?? '') === 'Menfess Ditolak')
                        💌
                    @else
                        ❤️
                    @endif
                </div>

                <div class="notification-content">

                    <a href="{{ $detailUrl }}" class="notification-link">

                        <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px; flex-wrap: wrap;">
                            <div class="notification-title">
                                {{ $notification->data['title'] ?? 'New Notification' }}
                            </div>

                            @if ($notification->read_at)
                                <span class="read-badge">Read</span>
                            @else
                                <span class="unread-badge">New</span>
                            @endif
                        </div>

                        <div class="notification-message">
                            {{ $notification->data['message'] ?? 'You have a new notification.' }}
                        </div>

                        @if (!empty($notification->data['category']))
                            <div class="notification-time">
                                Category: {{ $notification->data['category'] }}
                            </div>
                        @endif

                        <div class="notification-time">
                            {{ $notification->created_at->diffForHumans() }}
                        </div>

                    </a>

                    @if (!$notification->read_at)
                        <form action="{{ route('notifications.read', $notification->id) }}" method="POST" style="margin-top: 12px;">
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="action-btn">
                                Mark as Read
                            </button>
                        </form>
                    @endif

                </div>

            </div>

        @empty

            <div class="empty-state">
                <div class="empty-icon">🔔</div>

                <h3 style="font-size: 17px; font-weight: 800; margin-bottom: 8px;">
                    You're All Caught Up!
                </h3>

                <p class="muted" style="font-size: 13px; margin: 0;">
                    You don't have any notifications yet.
                    We'll let you know when something happens.
                </p>
            </div>

        @endforelse

        <!-- PAGINATION -->
        <div style="margin-top: 22px;">
            {{ $notifications->links() }}
        </div>

    </div>

</x-layouts::app>
