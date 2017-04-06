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

    /**
     * Return users with role.
     *
     * @param int $perPage
     * @return mixed
     */
    public function getUserWithRoles($perPage = 10)
    {
        return $this->model
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.name as role_name')
            ->paginate($perPage);
    }

    /**
     * Return user profile by username.
     *
     * @param $username
     * @return mixed
     */
    public function getUserByUsername($username)
    {
        return $this->findBy('username', $username, [
            'id',
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
        ]);
    }
}
