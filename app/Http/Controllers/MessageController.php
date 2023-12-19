<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Channel\ChannelServiceInterface;

class MessageController extends Controller
{
    protected $channelService;

    public function __construct(ChannelServiceInterface $channelService)
    {
        $this->channelService = $channelService;
    }

    /**
     * @SWG\Post(
     *     path="/api/v1/send-message",
     *     summary="Send messages to subscribers",
     *     @SWG\Response(response=200, description="Message sent"),
     *     @SWG\Response(response=400, description="Bad request"),
     *     @SWG\Response(response=500, description="Internal server error"),
     * )
     */
    public function sendMessage(Request $request)
    {
        // Get user ID from request header
        $userId = $request->header('user-id');



        // actual user data
        $message = $request->input('message');

        // Use the channelService to send the message
        $status = $this->channelService->sendMessage($userId, $message);

        if ($status) {
            return response()->json(['message' => 'Message sent'], 200);
        } else {
            return response()->json(['error' => 'Failed to send message'], 500);
        }
    }
}
