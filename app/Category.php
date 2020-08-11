<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
    
    public function study_time()
    {
        return $this->stulog_contents()->sum('study_time');
    }
    
    public function display_study_time()
    {
        $H = floor($this->study_time());
        $M = ($this->study_time() - floor($this->study_time())) * 60;
        $studyTime =  $H . '時間' . $M . '分';
        return $studyTime;
    }
    
    public function stulog_contents()
    {
        return $this->hasManyThrough(StulogContent::class, Tag::class);
    }
    
}
