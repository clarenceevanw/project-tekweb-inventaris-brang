<?php

require_once __DIR__ . '/./env.php';

class GoogleConfig {
    public static function getGoogleClientId() {
        return env('GOOGLE_CLIENT_ID', null);
    }

    public static function getGoogleClientSecret() {
        return env('GOOGLE_CLIENT_SECRET', null);
    }

    public static function getGoogleRedirectUri() {
        return env('GOOGLE_REDIRECT_URI', null);
    }

    public static function getClient() {
        require_once __DIR__ . '/../vendor/autoload.php'; 

        $client = new Google\Client();
        $client->setClientId(self::getGoogleClientId());
        $client->setClientSecret(self::getGoogleClientSecret());
        $client->setRedirectUri(self::getGoogleRedirectUri());
        
        // Minta izin akses Email & Profil
        $client->addScope("email");
        $client->addScope("profile");

        return $client;
    }
}