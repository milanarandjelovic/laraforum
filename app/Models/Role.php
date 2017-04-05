<?php

namespace App\Models;

use App\LaraForum\Traits\Dateable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    use Dateable;

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
