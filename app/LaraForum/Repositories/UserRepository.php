<?php

namespace App\LaraForum\Repositories;

use App\Models\User;
use App\LaraForum\Repositories\Eloquent\Repository;

class UserRepository extends Repository
{

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
    
    public function getUserWithRoles($perPage = 10)
    {
        return $this->model
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id',  '=', 'roles.id')
            ->select('users.*', 'roles.name as role_name')
            ->paginate($perPage);
    }
}