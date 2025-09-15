<?php

declare(strict_types=1);

namespace Application;

final class DataHelper
{
    public static function formatarParaBrasileiro(?string $data): ?string
    {
        if ($data === null || $data === '') {
            return null;
        }

        $timestamp = strtotime($data);
        if ($timestamp === false) {
            return null;
        }

        return date('d/m/Y', $timestamp);
    }
}
