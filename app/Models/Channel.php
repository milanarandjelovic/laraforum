<?php

namespace App\Models;

use Laravel\Scout\Searchable;

class Channel extends BaseModel
{

    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'channel_url',
        'channel_icon',
    ];

    public function discussions()
    {
        return $this->hasMany('App\Models\Discussion');
    }
}
