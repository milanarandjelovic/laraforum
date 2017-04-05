<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use App\LaraForum\Repositories\RoleRepository;

class RoleController extends Controller
{

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * RoleController constructor.
     *
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.index');
    }

    /**
     * Returns all roles.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function roles()
    {
        $roles = $this->roleRepository->paginate(10);

        $response = [
            'pagination' => [
                'total'        => $roles->total(),
                'per_page'     => $roles->perPage(),
                'current_page' => $roles->currentPage(),
                'last_page'    => $roles->lastPage(),
                'from'         => $roles->firstItem(),
                'to'           => $roles->lastItem(),

            ],
            'roles'      => $roles,
        ];

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\RoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleRequest $request)
    {
        $role = $this->roleRepository->create($request->all());

        return response()->json([
            'message' => 'Role has been successfully created.',
            'role'    => $role,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $channel = $this->roleRepository->findBy('id', $id);

        return response()->json($channel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest $request
     * @param  int                            $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $this->roleRepository->update($request->all(), $id);

        return response()->json([
            'message' => 'Role has been successfully updated.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->roleRepository->delete($id);

        return response()->json([
            'message' => 'Role has been successfully deleted.',
        ]);
    }
}
