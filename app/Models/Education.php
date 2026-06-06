<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';   // <-- tambahkan ini

    protected $fillable = ['title', 'content', 'category', 'image', 'youtube_url', 'views'];
}