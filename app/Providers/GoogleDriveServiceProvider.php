<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Google\Client;

class GoogleDriveServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Client::class, function () {
            $client = new Client();
            $client->setClientId(config('services.google.client_id'));
            $client->setClientSecret(config('services.google.client_secret'));
            $client->setRedirectUri(route('google.callback')); // optional
            $client->setAccessType('offline');
            $client->setPrompt('consent');
            $client->refreshToken(config('services.google.refresh_token'));

            return $client;
        });
    }
}
