<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{

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
        $roles = Role::paginate(10);

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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->only('name'), [
            'name' => 'required|min:3|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => [
                    'name' => $validator->errors()->first('name'),
                ],
            ]);
        }

        Role::create([
            'name' => $request->input('name'),
        ]);

        return response()->json([
            'message' => 'Role has been successfully created.',
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
        $channel = Role::all()->where('id', $id)->first();

        return response()->json($channel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->only('name'), [
            'name' => 'required|min:3|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => [
                    'name' => $validator->errors()->first('name'),
                ],
            ]);
        }

        Role::where('id', $id)->update([
            'name' => $request->input('name'),
        ]);

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
        $channel = Role::find($id);
        $channel->delete();

        return response()->json([
            'message' => 'Role has been deleted.',
        ]);
    }
}
