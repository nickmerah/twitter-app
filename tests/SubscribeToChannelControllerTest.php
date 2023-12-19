<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class SubscribeToChannelControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testSubscribeToChannel()
    {
        $response = $this->json('POST', '/api/v1/subscribe-channel', ['user_id' => '90000009-9009-9009-9009-900000000009', 'channel_id' => 'channel123']);

        $response->seeStatusCode(200)
            ->seeJson(['message' => 'Successfully subscribed to channel']);
    }
}
