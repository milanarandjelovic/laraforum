<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

class Discussion extends BaseModel
{

    use HasSlug, Searchable, AlgoliaEloquentTrait;

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

    public function votes()
    {
        return $this->morphMany('App\Models\Vote', 'voteable');
    }

    public function toSearchableArray()
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'slug'        => $this->slug,
            'description' => $this->description,
            'channel'     => $this->channel,
        ];
    }

    public function getAlgoliaRecord()
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'slug'        => $this->slug,
            'description' => $this->description,
            'channel'     => $this->channel,
        ];
    }
}
