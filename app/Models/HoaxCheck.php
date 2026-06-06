<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoaxCheck extends Model
{
    protected $fillable = [
        'news_history_id', 'clickbait_score', 'provocation_score',
        'source_credibility', 'summary'
    ];

    public function newsHistory(): BelongsTo
    {
        return $this->belongsTo(NewsHistory::class);
    }
}
