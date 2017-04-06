<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\LaraForum\Repositories\UserRepository;
use App\Http\Requests\UpdateUserProfileRequest;
use App\LaraForum\Repositories\CountryRepository;
use App\LaraForum\Repositories\ActivityRepository;

class UserController extends Controller
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
     * @var CountryRepository
     */
    private $countryRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository     $userRepository
     * @param ActivityRepository $activityRepository
     * @param CountryRepository  $countryRepository
     */
    public function __construct(
        UserRepository $userRepository,
        ActivityRepository $activityRepository,
        CountryRepository $countryRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->activityRepository = $activityRepository;
        $this->countryRepository = $countryRepository;
    }

    /**
     *  Display the specified resource.
     *
     * @param $username
     * @return \Illuminate\View\View
     */
    public function show($username)
    {
        $user = $this->userRepository->getUserByUsername($username);
        $userActivities = $this->activityRepository->allUserActivities($user->id);
        $country = $this->countryRepository->findBy('id', $user->country_flag);

        return view('forum.users.show')
            ->with('user', $user)
            ->with('country', $country)
            ->with('userActivities', $userActivities);
    }

    /**
     * Display the specified resource.
     *
     * @param $username
     * @return \Illuminate\Http\JsonResponse
     */
    public function showUser($username)
    {
        $user = $this->userRepository->getUserByUsername($username);
        $countries = $this->countryRepository->all();

        return response()->json([
            'user'      => $user,
            'countries' => $countries,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \App\Http\Requests\UpdateUserProfileRequest
     * @param                           $username
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserProfileRequest $request, $username)
    {
        $this->userRepository->update($request->all(), $username, 'username');

        return response()->json([
            'message' => 'Profile has been successfully updated.',
        ]);
    }
}
