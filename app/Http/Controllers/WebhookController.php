<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Channel\ChannelServiceInterface;

use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    protected $channelService;

    public function __construct(ChannelServiceInterface $channelService)
    {
        $this->channelService = $channelService;
    }

    /**
     * @SWG\Post(
     *     path="/api/v1/webhook",
     *     summary="Webhooks to receive responses from messenger API",
     *     @SWG\Response(response=200, description="Webhook received"),
     *     @SWG\Response(response=400, description="Bad request"),
     *     @SWG\Response(response=500, description="Internal server error"),
     * )
     */
    public function handleWebhook(Request $request)
    {
        // Your webhook using the channel service
        $payload = $request->all();

        try {
            $this->channelService->handleWebhook($payload);
            Log::info('Webhook received: ' . json_encode($payload)); // Use Log facade directly
            return response()->json(['message' => 'Webhook received']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to handle webhook: ' . $e->getMessage()], 500);
        }
    }
}
