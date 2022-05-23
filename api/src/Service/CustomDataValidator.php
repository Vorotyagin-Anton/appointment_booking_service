<?php

namespace App\Service;

class CustomDataValidator
{
    public function validateDateTime(string $date, string $format = 'Y-m-d H:i:s'): bool
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}