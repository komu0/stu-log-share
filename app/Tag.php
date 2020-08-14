<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //createするときはcategoryから
    protected $fillable = [
        'category_id',
        'name',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function stulog_contents()
    {
        return $this->hasMany(StulogContent::class);
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
}
