<?php

namespace App\Service;

class CustomDataFormatter
{
    public function getConvertedWorkerAvailableExactTime(int $workerAvailableExactTime): string
    {
        $hours = intval($workerAvailableExactTime/60);
        $minutes = str_pad(($workerAvailableExactTime/60 - $hours) * 6, 2, 0);

        return "$hours:$minutes";
    }
}