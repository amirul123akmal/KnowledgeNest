<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'brief_description',
        'author',
        'link',
        'likes',
        'comments',
        'views',
        'difficulty',
        'thumbnail',
        'upvote',
        'downvote',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post');
    }
}
