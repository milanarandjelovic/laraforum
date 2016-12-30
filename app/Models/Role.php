<?php

namespace App\Models;

class Role extends BaseModel
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
}
