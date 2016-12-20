<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'channel_url',
        'channel_icon',
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
}
