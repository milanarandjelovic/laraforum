<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
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
     * Return diffForHumans for created_at.
     *
     * @param $date
     * @return string
     */
    public function getCreatedAtAttribute($date)
    {
        return $this->asDateTime($date)->diffForHumans();
    }

    /**
     * Return diffForHumans for updated_at.
     *
     * @param $date
     * @return string
     */
    public function getUpdatedAtAttribute($date)
    {
        return $this->asDateTime($date)->diffForHumans();
    }

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
