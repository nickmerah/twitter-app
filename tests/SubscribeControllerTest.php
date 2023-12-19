<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class SubscribeControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testSubscribe()
    {
        $response = $this->json('POST', '/api/v1/subscribe', ['user_id' => '80000000-8000-8000-8000-000000000008']);

        $response->seeJson(['message' => 'Successfully subscribed'])
            ->seeStatusCode(200);
    }
}
