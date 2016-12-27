<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Returns all users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function users()
    {
        $users = User::paginate(10);

        foreach ($users as $user) {
            $userData[] = [
                'id'                  => $user->id,
                'username'            => $user->username,
                'first_name'          => $user->first_name,
                'last_name'           => $user->last_name,
                'email'               => $user->email,
                'profile_description' => $user->profile_description,
                'personal_website'    => $user->personal_website,
                'twitter_username'    => $user->twitter_username,
                'github_username'     => $user->github_username,
                'place_of_employment' => $user->place_of_employment,
                'job_title'           => $user->job_title,
                'hometown'            => $user->hometown,
                'country_flag'        => $user->country_flag,
                'for_hire'            => $user->for_hire,
                'role'                => [
                    'name'  => $user->roles()->first()->name,
                    'class' => $user->roles()->first()->name == 'admin' ? 'label-primary' : 'label-success',
                ],
                'created_at'          => $user->created_at,
                'updated_at'          => $user->updated_at,
            ];
        }

        dd($userData);

        $response = [
            'pagination' => [
                'total'        => $users->total(),
                'per_page'     => $users->perPage(),
                'current_page' => $users->currentPage(),
                'last_page'    => $users->lastPage(),
                'from'         => $users->firstItem(),
                'to'           => $users->lastItem(),

            ],
            'users'      => $userData,
        ];

        return response()->json($response);
    }
}
