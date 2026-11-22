<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MenfessLiked extends Notification
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
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Menentukan data yang disimpan ke database.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Menfess Mendapat Like!',
            'message' => 'Seseorang menyukai menfess yang kamu bagikan.',
            'menfess_id' => $this->menfessId,
            'category' => $this->category,
            'url' => route('menfesses.my'),
        ];
    }
}
