<?php

namespace App\Models;

use App\Models\User;

class Comment extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'user_id',
        'discussion_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function discussion()
    {
        return $this->belongsTo('App\Models\Discussion');
    }

    public function votes()
    {
        return $this->morphMany('App\Models\Vote', 'voteable');
    }

    public function upVotes()
    {
        return $this->votes->where('type', 'up');
    }

    public function downVotes()
    {
        return $this->votes->where('type', 'down');
    }

    public function voteFromUser(User $user)
    {
        return $this->votes()->where('user_id', $user->id);
    }
}
