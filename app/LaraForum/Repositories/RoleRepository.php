<?php

namespace App\LaraForum\Repositories;

use App\Models\Role;
use App\LaraForum\Repositories\Eloquent\Repository;

class RoleRepository extends Repository
{

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }
}
