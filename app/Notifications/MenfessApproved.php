<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MenfessApproved extends Notification
{
    use Queueable;

    public function __construct(
        public int $menfessId,
        public string $category
    ) {
        //
    }

    /**
     * Menentukan saluran pengiriman notifikasi.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Menentukan data yang disimpan ke database.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Menfess Disetujui!',
            'message' => 'Menfess kamu berhasil disetujui admin dan sekarang sudah tampil di Community Feed.',
            'menfess_id' => $this->menfessId,
            'category' => $this->category,
            'url' => route('menfesses.show', $this->menfessId),
        ];
    }
}
