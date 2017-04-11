<?php

namespace App\LaraForum\Repositories;

use App\Models\Activity;
use App\LaraForum\Repositories\Eloquent\Repository;

class ActivityRepository extends Repository
{

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Activity::class;
    }

    /**
     * Return all activity for given user.
     *
     * @param $userId
     * @return mixed
     */
    public function allUserActivities($userId)
    {
        return $this->model->all()->where('causer_id', $userId);
    }

    /**
     * Return all user activities on forum.
     *
     * @param int $perPage
     * @return mixed
     */
    public function getAllLatestActivity($perPage = 10)
    {
        return $this->model
            ->join('users', 'activity_log.causer_id', '=', 'users.id')
            ->select('users.username as user_username', 'activity_log.*')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
