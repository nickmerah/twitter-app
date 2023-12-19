<?php

namespace App\Services\Channel;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Log;

class TwitterChannelService implements ChannelServiceInterface
{
    private function initializeTwitterOAuth()
    {
        return new TwitterOAuth(
            env('TWITTER_CONSUMER_KEY'),
            env('TWITTER_CONSUMER_SECRET'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET')
        );
    }

    public function sendMessage($userId, $message)
    {
        // Initialize TwitterOAuth
        $twitterOAuth = $this->initializeTwitterOAuth();

        // Send the tweet
        $status = $twitterOAuth->post(
            'statuses/update',
            ['status' => "@$userId $message"]
        );

        return $status;
    }

    public function subscribe($userId)
    {
        // Initialize TwitterOAuth
        $twitterOAuth = $this->initializeTwitterOAuth();

        // Subscribe
        $response = $twitterOAuth->post(
            'friendships/create',
            ['user_id' => $userId]
        );

        // var_dump($response);

        return $response && $twitterOAuth->getLastHttpCode() === 200;
    }

    public function subscribeToChannel($userId, $channelId)
    {
        // Initialize TwitterOAuth
        $twitterOAuth = $this->initializeTwitterOAuth();

        $response = $twitterOAuth->post(
            'lists/members/create',
            [
                'list_id' => $channelId,
                'user_id' => $userId,
            ]
        );

        //var_dump($response);

        return $response && $twitterOAuth->getLastHttpCode() === 200;
    }

    public function handleWebhook($payload)
    {
        Log::info('Twitter Webhook Received: ' . json_encode($payload));
    }
}
