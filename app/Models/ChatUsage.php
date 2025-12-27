<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatUsage extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'model',
        'prompt_tokens',
        'completion_tokens',
        'total_tokens',
        'input_text',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
