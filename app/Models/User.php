<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use App\LaraForum\Traits\Dateable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Dateable, HasApiTokens, Notifiable;

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

    /**
     * Get user first name or full name.
     *
     * @return mixed|null|string
     */
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

    /**
     * Get user username or full name.
     *
     * @return mixed
     */
    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }

    /**
     * Get user first name or username.
     *
     * @return mixed
     */
    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }

    /**
     * Determinate if the user is an administrator.
     *
     * @return bool
     */
    public function isAdmin()
    {
        // If user admin return true
        if ($this->roles()->first()->name === 'admin') {
            return true;
        }

        return false;
    }

    /**
     * Get user roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get user discussions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    /**
     * Get user comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
