<?php

namespace App\Models;

use App\LaraForum\Traits\Orderable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends BaseModel
{

    use SoftDeletes, Orderable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'user_id',
        'reply_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Comment', 'reply_id', 'id');
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
