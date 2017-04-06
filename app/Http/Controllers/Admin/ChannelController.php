<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ChannelRequest;
use App\Http\Controllers\Controller;
use App\LaraForum\Repositories\ChannelRepository;

class ChannelController extends Controller
{

    /**
     * @var ChannelRepository
     */
    private $channelRepository;

    /**
     * ChannelController constructor.
     *
     * @param ChannelRepository $channelRepository
     */
    public function __construct(ChannelRepository $channelRepository)
    {
        $this->channelRepository = $channelRepository;
    }

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
        $channels = $this->channelRepository->paginate(10);

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
     * @param \App\Http\Requests\ChannelRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ChannelRequest $request)
    {
        $this->channelRepository->create($request->all());

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
        $channel = $this->channelRepository->findBy('id', $id);

        return response()->json($channel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ChannelRequest $request
     * @param  int                               $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChannelRequest $request, $id)
    {
        $this->channelRepository->update($request->all(), $id);

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
        $this->channelRepository->delete($id);

        return response()->json([
            'message' => 'Channel has been successfully deleted.',
        ]);
    }
}
