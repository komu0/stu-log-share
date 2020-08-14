<?php

namespace App\Library;
use App;

class BaseClass
{
    public static function time_hhmm_to_double($time) {
        $time = (double)substr($time, 0, 2) +  (double)substr($time, 3, 2) / 60;
        return $time;
    }
}