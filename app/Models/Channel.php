<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use App\LaraForum\Traits\Dateable;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{

    use Dateable, Searchable;

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
