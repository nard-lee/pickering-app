<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id', 
        'username', 
        'message'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
