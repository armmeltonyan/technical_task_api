<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
        'news_id',
    ];

    function answers()
    {
        return $this->hasMany("App\Models\Answer","comment_id");
    }
}
