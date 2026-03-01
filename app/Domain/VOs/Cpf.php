<?php

namespace App\Domain\VOs;

class Cpf
{
    public static function formatAsNumber(?string $cpf): string
    {
        return preg_replace('/\D/', '', $cpf);
    }

    public static function applyMask(?string $cpf): string
    {
        $cpf = self::formatAsNumber($cpf);

        if (strlen($cpf) !== 11) {
            return $cpf;
        }

        return vsprintf('%s%s%s.%s%s%s.%s%s%s-%s%s', str_split($cpf));
    }
}
