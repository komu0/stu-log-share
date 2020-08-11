<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StulogContent extends Model
{
    public function stulog()
    {
        return $this->belongsTo(Stulog::class);
    }
    
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
    
    public function display_study_time()
    {
        $H = floor($this->study_time);
        $M = ($this->study_time - floor($this->study_time)) * 60;
        $studyTime =  $H . '時間' . $M . '分';
        return $studyTime;
    }
}
