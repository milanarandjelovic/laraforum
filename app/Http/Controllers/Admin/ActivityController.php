<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\LaraForum\Repositories\UserRepository;
use App\LaraForum\Repositories\ActivityRepository;

class ActivityController extends Controller
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ActivityRepository
     */
    private $activityRepository;

    /**
     * DashboardController constructor.
     *
     * @param \App\LaraForum\Repositories\UserRepository     $userRepository
     * @param \App\LaraForum\Repositories\ActivityRepository $activityRepository
     */
    public function __construct(UserRepository $userRepository, ActivityRepository $activityRepository)
    {
        $this->userRepository = $userRepository;
        $this->activityRepository = $activityRepository;
    }

    /**
     * Return all activities on forum.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function activities()
    {
        $activities = $this->activityRepository->getAllLatestActivity();

        $response = [
            'pagination' => [
                'total'        => $activities->total(),
                'per_page'     => $activities->perPage(),
                'current_page' => $activities->currentPage(),
                'last_page'    => $activities->lastPage(),
                'from'         => $activities->firstItem(),
                'to'           => $activities->lastItem(),

            ],
            'activities' => $activities,
        ];

        return response()->json($response);
    }
}
