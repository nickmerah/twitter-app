<?php

namespace App\Services\Channel;

interface ChannelServiceInterface
{
    public function sendMessage($userId, $message);
    public function subscribe($userId);
    public function subscribeToChannel($userId, $channelId);
    public function handleWebhook($payload);
}
