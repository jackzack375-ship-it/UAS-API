<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NewsHistory extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content', 'url', 'status', 'validity_score', 'ai_analysis'
    ];

    protected $casts = [
        'ai_analysis' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function hoaxCheck(): HasOne
    {
        return $this->hasOne(HoaxCheck::class);
    }
}