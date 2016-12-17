<?php

namespace App\Http\Controllers\Forum;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Webpatser\Countries\Countries;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $username
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($username)
    {
        $user = User::where('username', $username)
            ->select(
                'username',
                'first_name',
                'last_name',
                'email',
                'description',
                'personal_website',
                'twitter_username',
                'github_username',
                'place_of_employment',
                'job_title',
                'hometown',
                'country_flag',
                'for_hire'
            )
            ->first();

        $country = Countries::all()->where('id', $user->country_flag)->first();

        return view('forum.users.show')
            ->with('user', $user)
            ->with('country', $country);
    }

    /**
     * Display the specified resource.
     *
     * @param $username
     * @return \Illuminate\Http\JsonResponse
     */
    public function showUser($username)
    {
        $user = User::where('username', $username)
            ->select(
                'username',
                'first_name',
                'last_name',
                'email',
                'description',
                'personal_website',
                'twitter_username',
                'github_username',
                'place_of_employment',
                'job_title',
                'hometown',
                'country_flag',
                'for_hire'
            )
            ->first();

        $countries = Countries::all();

        return response()->json([
            'user'      => $user,
            'countries' => $countries,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param                           $username
     * @return \Illuminate\Http\Response
     * @internal param $id
     */
    public function update(Request $request, $username)
    {

        $validator = Validator::make($request->all(), [
            'first_name'          => 'min:3|max:255',
            'last_name'           => 'min:3|max:255',
            'description'         => 'min:3',
            'personal_website'    => 'min:3|max:255|url',
            'twitter_username'    => 'min:3|max:255',
            'github_username'     => 'min:3|max:255',
            'place_of_employment' => 'min:3|max:255',
            'job_title'           => 'min:3|max:255',
            'hometown'            => 'min:3|max:255',
            'country_flag'        => 'numeric',
            'for_hire'            => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => [
                    'first_name'          => $validator->errors()->first('first_name'),
                    'last_name'           => $validator->errors()->first('last_name'),
                    'description'         => $validator->errors()->first('description'),
                    'personal_website'    => $validator->errors()->first('personal_website'),
                    'twitter_username'    => $validator->errors()->first('twitter_username'),
                    'github_username'     => $validator->errors()->first('github_username'),
                    'place_of_employment' => $validator->errors()->first('place_of_employment'),
                    'job_title'           => $validator->errors()->first('job_title'),
                    'hometown'            => $validator->errors()->first('hometown'),
                    'country_flag'        => $validator->errors()->first('country_flag'),
                    'for_hire'            => $validator->errors()->first('for_hire'),
                ],
            ]);
        }

        User::where('username', $username)->update([
            'first_name'          => $request->input('first_name'),
            'last_name'           => $request->input('last_name'),
            'description'         => $request->input('description'),
            'personal_website'    => $request->input('personal_website'),
            'twitter_username'    => $request->input('twitter_username'),
            'github_username'     => $request->input('github_username'),
            'place_of_employment' => $request->input('place_of_employment'),
            'job_title'           => $request->input('job_title'),
            'hometown'            => $request->input('hometown'),
            'country_flag'        => $request->input('country_flag'),
            'for_hire'            => $request->input('for_hire'),
        ]);

        return response()->json([
            'message' => 'Profile has been successfully updated.',
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
        //
    }
}
