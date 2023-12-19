<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Channel\ChannelServiceInterface;

class ChannelController extends Controller
{
    protected $channelService;

    public function __construct(ChannelServiceInterface $channelService)
    {
        $this->channelService = $channelService;
    }

    /**
     * @SWG\Post(
     *     path="/api/v1/subscribe-channel",
     *     summary="Subscribe users to a channel or chat",
     *     @SWG\Response(response=200, description="Successfully subscribed"),
     *     @SWG\Response(response=400, description="Bad request"),
     *     @SWG\Response(response=500, description="Internal server error"),
     * )
     */
    public function subscribeToChannel(Request $request)
    {
        // Get user ID from request header
        $userId = $request->header('user-id');

        // Your channel subscription using the channel service
        $channelId = $request->input('channel_id');
        $result = $this->channelService->subscribeToChannel($userId, $channelId);

        if ($result) {
            return response()->json(['message' => 'Successfully subscribed to channel']);
        } else {
            return response()->json(['error' => 'Failed to subscribe to channel'], 500);
        }
    }
}
