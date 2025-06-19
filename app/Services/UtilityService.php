<?php

namespace App\Services;

class UtilityService
{
    public static function generateReference(string $prefix, int $length = 5): string
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789ZYXWVUTSRQPONMLKJIHGFEDCBA';
        $prefix = $prefix.$chars[date('L') < 0 ? 1 : date('L')];
        $baseCode =
            $prefix.
            $chars[date('m')].
            '+'.
            $chars[date('d')].
            '-'.
            $chars[date('H')].
            $chars[date('i')].
            $chars[date('s')];

        $firstPart = '';
        $secondPart = '';

        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($chars) - 1);
            $firstPart .= substr($chars, $index, 1);
        }

        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($chars) - 1);
            $secondPart .= substr($chars, $index, 1);
        }

        $baseCode = str_replace('-', $firstPart, $baseCode);

        return str_replace('+', $secondPart, $baseCode);
    }
}
