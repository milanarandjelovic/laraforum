<?php

namespace App\Models;

use App\LaraForum\Traits\Dateable;
use App\LaraForum\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

    use Dateable, SoftDeletes, Orderable;

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

    /**
     * A comment belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'reply_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    /**
     * @return mixed
     */
    public function upVotes()
    {
        return $this->votes->where('type', 'up');
    }

    /**
     * @return mixed
     */
    public function downVotes()
    {
        return $this->votes->where('type', 'down');
    }

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function voteFromUser(User $user)
    {
        return $this->votes()->where('user_id', $user->id);
    }
}
