<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\LaraForum\Repositories\UserRepository;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

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
        $users = $this->userRepository->getUserWithRoles();

        $response = [
            'pagination' => [
                'total'        => $users->total(),
                'per_page'     => $users->perPage(),
                'current_page' => $users->currentPage(),
                'last_page'    => $users->lastPage(),
                'from'         => $users->firstItem(),
                'to'           => $users->lastItem(),

            ],
            'users'      => $users,
        ];

        return response()->json($response);
    }
}
