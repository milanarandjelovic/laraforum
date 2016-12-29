<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'like',
        'dislike',
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
}
