<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Google\Client;
use Google\Service\Drive;
use App\Services\GoogleDriveService;
use Illuminate\Support\Facades\Log;

class GoogleDriveServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register Google Client
        $this->app->singleton(Client::class, function () {
            $client = new Client();
            
            // Cek apakah menggunakan Service Account atau OAuth
            $driveType = config('filesystems.disks.google.type', 'oauth');
            
            if ($driveType === 'service_account') {
                // Service Account Setup
                $credentials = [
                    'type' => 'service_account',
                    'project_id' => config('filesystems.disks.google.project_id'),
                    'private_key_id' => config('filesystems.disks.google.private_key_id'),
                    'private_key' => config('filesystems.disks.google.private_key'),
                    'client_email' => config('filesystems.disks.google.client_email'),
                    'client_id' => config('filesystems.disks.google.client_id'),
                    'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
                    'token_uri' => 'https://oauth2.googleapis.com/token',
                ];
                
                $client->setAuthConfig($credentials);
                $client->setScopes([Drive::DRIVE]);
                
                Log::info('Google Drive initialized with Service Account');
                
            } else {
                // OAuth Setup (existing method)
                $client->setClientId(config('services.google.client_id', config('filesystems.disks.google.clientId')));
                $client->setClientSecret(config('services.google.client_secret', config('filesystems.disks.google.clientSecret')));
                
                // Set redirect URI jika ada route
                if (app('router')->has('google.callback')) {
                    $client->setRedirectUri(route('google.callback'));
                }
                
                $client->setAccessType('offline');
                $client->setPrompt('consent');
                $client->setScopes([Drive::DRIVE]);
                
                // Set refresh token jika ada
                $refreshToken = config('services.google.refresh_token', config('filesystems.disks.google.refreshToken'));
                if ($refreshToken) {
                    try {
                        $client->refreshToken($refreshToken);
                        Log::info('Google Drive initialized with OAuth refresh token');
                    } catch (\Exception $e) {
                        Log::warning('Failed to refresh OAuth token: ' . $e->getMessage());
                    }
                }
            }

            return $client;
        });
        
        // Register GoogleDriveService
        $this->app->singleton(GoogleDriveService::class, function ($app) {
            return new GoogleDriveService();
        });
    }
    
    public function boot()
    {
        // Test connection saat boot (optional)
        if (config('app.env') !== 'testing') {
            try {
                $client = app(Client::class);
                Log::info('Google Drive Service Provider booted successfully');
            } catch (\Exception $e) {
                Log::error('Google Drive Service Provider boot failed: ' . $e->getMessage());
            }
        }
    }
}