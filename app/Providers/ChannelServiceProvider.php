<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Channel\TwitterChannelService;

class ChannelServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Services\Channel\ChannelServiceInterface', function ($app) {
            return new TwitterChannelService();
        });
    }
}
