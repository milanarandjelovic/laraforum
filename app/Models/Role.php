<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];


    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

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
