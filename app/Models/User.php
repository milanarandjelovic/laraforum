<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Laravel\Passport\HasApiTokens;
use App\LaraForum\Traits\Dateable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Dateable, HasApiTokens, Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'profile_description',
        'personal_website',
        'twitter_username',
        'github_username',
        'place_of_employment',
        'job_title',
        'hometown',
        'country_flag',
        'for_hire',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getName()
    {
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }
        if ($this->first_name) {
            return $this->first_name;
        }

        return null;
    }

    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }

    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function isAdmin()
    {
        // If user admin return true
        if ($this->roles()->first()->name === 'admin') {
            return true;
        }

        return false;
    }

    public function discussions()
    {
        return $this->hasMany('App\Models\Discussion');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
