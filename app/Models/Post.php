<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'title',
        'content',
        'brief_description',
        'author_id',
        'tags',
        'link',
        'likes',
        'comments',
        'views',
        'difficulty',
        'thumbnail',
        'upvote',
        'downvote',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('link');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post');
    }

    public function votes()
    {
        return $this->hasMany(PostVote::class);
    }

    public function getRouteKeyName()
    {
        return 'link';
    }
}
