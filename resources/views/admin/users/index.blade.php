<x-layouts::app :title="'User Management - SUARAQ'">
    <div style="padding: 24px; background: #fff6fa; min-height: 100vh;">

        <p style="color: #bd7895;">SUARAQ / ADMIN</p>

        <h1 style="font-size: 28px; font-weight: bold; color: #493044;">
            User Management 🌷
        </h1>

        <p style="color: #a47b91; margin-bottom: 24px;">
            Kelola dan pantau pengguna yang terdaftar di SUARAQ.
        </p>

        @if (session('success'))
            <div style="padding: 14px; background: #e6f7ed; color: #287747; border-radius: 10px; margin-bottom: 16px;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="padding: 14px; background: #fff0e8; color: #b45335; border-radius: 10px; margin-bottom: 16px;">
                {{ session('error') }}
            </div>
        @endif

        <div style="background: white; border: 1px solid #f5d5e3; border-radius: 16px; padding: 22px;">

            <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                <div>
                    <h2 style="font-size: 20px; color: #493044;">
                        Daftar Pengguna
                    </h2>
                    <p style="color: #a47b91; font-size: 14px;">
                        Total {{ $users->count() }} pengguna terdaftar
                    </p>
                </div>
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background: #fff0f6;">
                            <th style="padding: 14px;">No.</th>
                            <th style="padding: 14px;">Nama</th>
                            <th style="padding: 14px;">Email</th>
                            <th style="padding: 14px;">Role</th>
                            <th style="padding: 14px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr style="border-bottom: 1px solid #f5e3eb;">
                                <td style="padding: 14px;">{{ $loop->iteration }}</td>
                                <td style="padding: 14px;">{{ $user->name }}</td>
                                <td style="padding: 14px;">{{ $user->email }}</td>
                                <td style="padding: 14px;">
                                    <span style="padding: 5px 10px; border-radius: 20px; background: {{ $user->role === 'admin' ? '#fce7f3' : '#f3f4f6' }};">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td style="padding: 14px;">
                                    @if ($user->role !== 'admin')
                                        <form
                                            action="{{ route('admin.users.destroy', $user) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" style="background: #ffe5ed; color: #c94d79; border: none; padding: 8px 12px; border-radius: 8px; cursor: pointer;">
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span style="color: #a47b91;">Admin</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="padding: 25px; text-align: center;">
                                    Belum ada pengguna.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts::app>
