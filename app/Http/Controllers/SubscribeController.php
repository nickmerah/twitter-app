<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Channel\ChannelServiceInterface;

class SubscribeController extends Controller
{
    protected $channelService;

    public function __construct(ChannelServiceInterface $channelService)
    {
        $this->channelService = $channelService;
    }

    /**
     * @SWG\Post(
     *     path="/api/v1/subscribe",
     *     summary="Subscribe users to a chat bot",
     *     @SWG\Response(response=200, description="Successfully subscribed"),
     *     @SWG\Response(response=400, description="Bad request"),
     *     @SWG\Response(response=500, description="Internal server error"),
     * )
     */
    public function subscribe(Request $request)
    {
        // Get user ID from request header
        $userId = $request->header('user-id');

        // Your subscription using the channel service
        $result = $this->channelService->subscribe($userId);

        if ($result) {
            return response()->json(['message' => 'Successfully subscribed']);
        } else {
            return response()->json(['error' => 'Failed to subscribe'], 500);
        }
    }
}
