<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Discussion extends BaseModel
{

    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'channel_id',
        'user_id',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function channel()
    {
        return $this->belongsTo('App\Models\Channel');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
