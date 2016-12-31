<?php

namespace App\Models;

class Channel extends BaseModel
{

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
