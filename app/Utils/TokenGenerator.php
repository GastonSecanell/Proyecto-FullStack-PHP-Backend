<?php

namespace App\Utils;

use App\Models\User;

class TokenGenerator
{
    public static function generateSHA1Token(User $user)
    {
        $email = $user->email;
        $timestamp = now()->format('Y-m-d H:i:s');
        $randomNumber = mt_rand(200, 500);
        $tokenContent = "$email $timestamp $randomNumber";

        $hashedToken = sha1($tokenContent);

        return $hashedToken;
    }
}