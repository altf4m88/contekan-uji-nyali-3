<?php

namespace App\Service;

use Illuminate\Support\Str;

class Username
{
    public static function generateUsername(String $name)
    {
        if (Str::length($name) < 10) {
            $name = str_repeat($name, 5);
        }

        $prefix = Str::substr(Str::slug(trim($name), ''), 0, 9);

        // random 3 number with format 001 010 100
        $randNumber = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);

        $username = $prefix . sprintf('%2s', $randNumber);

        return $username;
    }
}
