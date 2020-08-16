<?php

namespace App\Library;
use App;

class BaseClass
{
    public static function time_hhmm_to_double($time) {
        $time = (double)substr($time, 0, 2) +  (double)substr($time, 3, 2) / 60;
        return $time;
    }
    
    public static function time_hhmm_to_japanese($time) {
        $time = round(self::time_hhmm_to_double($time),6);
        $H = floor($time);
        $M = round(($time - floor($time)) * 60);
        $studyTime =  $H . '時間' . $M . '分';
        return $studyTime;
    }
    
    public static function time_double_to_hhmm($time) {
        return (sprintf('%02d', floor($time))) . ':'
        . (sprintf('%02d', round((($time - floor($time)) * 60))));
    }
    
    public static function time_double_to_japanese($time) {
        $H = floor($time);
        $M = round(($time - floor($time)) * 60);
        $studyTime =  $H . '時間' . $M . '分';
        return $studyTime;
    }
}