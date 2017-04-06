<?php

namespace App\LaraForum\Repositories;

use App\Models\Channel;
use App\LaraForum\Repositories\Eloquent\Repository;

class ChannelRepository extends Repository
{

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Channel::class;
    }
}
