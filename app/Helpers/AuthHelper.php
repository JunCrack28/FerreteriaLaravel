<?php

namespace App\Helpers;

use Tymon\JWTAuth\JWTAuth as JWT;
use Illuminate\Support\Facades\Log;

class AuthHelper
{
    protected static $jwt;

    public static function setJWT($jwt)
    {
        static::$jwt = $jwt;
    }

    public static function check()
    {
        if (!static::$jwt) {
            static::setJWT(app('Tymon\JWTAuth\JWTAuth'));
        }

        $token = request()->cookie('jwt_token');
        if (!$token) {
            Log::info('AuthHelper::check - No token found in cookie');
            return false;
        }

        try {
            return static::$jwt->setToken($token)->check();
        } catch (\Exception $e) {
            Log::error('AuthHelper::check - Error validating token: ' . $e->getMessage());
            return false;
        }
    }

    public static function user()
    {
        if (!static::$jwt) {
            static::setJWT(app('Tymon\JWTAuth\JWTAuth'));
        }

        $token = request()->cookie('jwt_token');
        Log::info('AuthHelper::user - Token in user: ', ['token' => $token]);

        if (!$token) {
            Log::info('AuthHelper::user - No token found in cookie');
            return null;
        }

        try {
            $user = static::$jwt->setToken($token)->toUser();
            Log::info('AuthHelper::user - User retrieved: ', ['user' => $user ? $user->toArray() : 'null']);
            return $user;
        } catch (\Exception $e) {
            Log::error('AuthHelper::user - Error retrieving user: ' . $e->getMessage());
            return null;
        }
    }
}