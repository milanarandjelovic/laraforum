<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChannelController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.channel.index');
    }

    /**
     * Returns all channels.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function channels()
    {
//        $channels = Channel::paginate(10);
        $channels = DB::table('channels')->paginate(15);

        $response = [
            'pagination' => [
                'total'        => $channels->total(),
                'per_page'     => $channels->perPage(),
                'current_page' => $channels->currentPage(),
                'last_page'    => $channels->lastPage(),
                'from'         => $channels->firstItem(),
                'to'           => $channels->lastItem(),

            ],
            'channels'   => $channels,
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

        $validator = Validator::make($request->only(['name', 'color', 'channel_url']), [
            'name'        => 'required|min:3|max:255',
            'channel_url' => 'required',
            'color'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => [
                    'name'        => $validator->errors()->first('name'),
                    'channel_url' => $validator->errors()->first('channel_url'),
                ],
            ]);
        }

        Channel::create([
            'name'        => $request->input('name'),
            'channel_url' => $request->input('channel_url'),
            'color'       => $request->input('color'),
        ]);

        return response()->json([
            'message' => 'Channel has been successfully created.',
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
        $channel = Channel::all()->where('id', $id)->first();

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

        $validator = Validator::make($request->only(['name', 'color', 'channel_url']), [
            'name'        => 'required|min:3|max:255',
            'channel_url' => 'required',
            'color'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => [
                    'name'        => $validator->errors()->first('name'),
                    'channel_url' => $validator->errors()->first('channel_url'),
                ],
            ]);
        }

        Channel::where('id', $id)->update([
            'name'        => $request->input('name'),
            'channel_url' => $request->input('channel_url'),
            'color'       => $request->input('color'),
        ]);

        return response()->json([
            'message' => 'Channel has been successfully updated.',
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
        $channel = Channel::find($id);
        $channel->delete();

        return response()->json([
            'message' => 'Channel has been deleted.',
        ]);
    }
}
