<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(),
            $this->response->getContent()
        );
    }

    public function testSubscribe()
    {
        $response = $this->json('POST', '/api/v1/subscribe', ['user_id' => '80000000-8000-8000-8000-000000000008']);

        $response->seeStatusCode(200)
            ->seeJson(['message' => 'Successfully subscribed']);
    }
}
