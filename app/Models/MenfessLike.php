<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenfessLike extends Model
{
    protected $fillable = [
        'user_id',
        'menfess_id',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Menfess, $this>
     */
    public function menfess(): BelongsTo
    {
        return $this->belongsTo(Menfess::class);
    }
}
