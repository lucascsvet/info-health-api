<?php

namespace App\Domain\VOs;

class Phone
{
    public static function formatAsNumber($phone)
    {
        return preg_replace('/\D/', '', $phone);
    }

    public static function applyMask($phone)
    { 
        $phone = str_replace(' ','',$phone);

        if(strlen($phone) == 11){
            return vsprintf("(%s%s)%s%s%s%s%s-%s%s%s%s", str_split($phone));
        }

        return $phone;
    }

    public static function formatWithMask($phone)
    {
        $phone = str_replace(" ", "", $phone);
        
        if(strlen($phone) == 11){
            return sprintf('(%s) %s-%s', substr($phone, 0, 2), substr($phone, 2, 5), substr($phone, 7));
        }

        return $phone;
    }
}