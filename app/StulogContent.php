<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StulogContent extends Model
{
    //createするときはuser->tagから。
    protected $fillable = [
        'tag_id',
        'study_time',
        'comment',
    ];
    
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
    
    public function display_study_time_hhmm() {
        return (sprintf('%02d', floor($this->study_time))) . ':'
        . (sprintf('%02d', (($this->study_time - floor($this->study_time)) * 60)));
    }
}
