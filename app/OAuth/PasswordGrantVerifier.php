<?php
/**
 * Created by PhpStorm.
 * User: marce
 * Date: 22/03/2016
 * Time: 21:54
 */

namespace Code\OAuth;

use Illuminate\Support\Facades\Auth;

class PasswordGrantVerifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}