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
}
