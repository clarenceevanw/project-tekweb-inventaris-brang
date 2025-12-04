<?php

require_once __DIR__ . '/../../config/env.php';

class MidtransConfig {
    
    public static function getServerKey() {
        return env('MIDTRANS_SERVER_KEY', "");
    }

    public static function getClientKey() {
        return env('MIDTRANS_CLIENT_KEY', "Mid-client-pQ43NyUeWfv5LvrO");
    }

    public static function isProduction() {
        return filter_var(env('MIDTRANS_IS_PRODUCTION', false), FILTER_VALIDATE_BOOLEAN);
    }

    public static function getSnapUrl() {
        // Panggil function di atas pakai self::
        return self::isProduction() 
            ? 'https://app.midtrans.com/snap/v1/transactions' 
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';
    }
}