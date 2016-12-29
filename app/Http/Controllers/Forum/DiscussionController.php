<?php

namespace App\Http\Controllers\Forum;

use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiscussionRequest;

class DiscussionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $channels = DB::table('channels')->orderBy('name', 'asc')->get();

        return view('forum.discussion.index')
            ->with('channels', $channels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $channels = DB::table('channels')->select('id', 'name')->orderBy('name', 'asc')->get();

        return view('forum.discussion.create')
            ->with('channels', $channels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DiscussionRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscussionRequest $request)
    {
        Discussion::create([
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'channel_id'  => $request->input('channel_id'),
            'user_id'     => $request->input('user_id'),
        ]);

        return redirect()->route('discussion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $channelSlug
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($channelSlug, $slug)
    {

//        $discussion = DB::table('discussions')
//            ->where('slug', $slug)
//            ->leftJoin('channels', 'channel_id', '=', 'channels.id')
//            ->leftJoin('users', 'user_id', '=', 'users.id')
//            ->orderBy('discussions.created_at', 'desc')
//            ->select('discussions.*', 'channels.name', 'channels.channel_url', 'users.username')
//            ->first();

        $discussion = Discussion::where('slug', $slug)
            ->with('channel')
            ->with('user')
            ->with('comments')->first();
//        dd($comments);

        return view('forum.channels.show')
            ->with('discussion', $discussion);
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
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
