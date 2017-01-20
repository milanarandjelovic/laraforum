<?php

namespace App\LaraForum\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;
use Thomaswelton\LaravelGravatar\Facades\Gravatar;

class UserTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'         => $user->id,
            'username'   => $user->username,
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'avatar'     => Gravatar::src($user->email, 60)
        ];
    }

}