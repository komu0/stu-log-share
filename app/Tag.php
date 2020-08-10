<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
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
    
    public function study_time_array()
    {
        $stulogs = $this->stulog_contents;
        $studyTimeH = 0;
        $studyTimeM = 0;
        foreach ($stulogs as $stulog){
            $studyTimeH += $stulog->study_time_array()['H'];
            $studyTimeM += $stulog->study_time_array()['M'];
        }
        //繰り上がり処理
        $studyTimeH += intdiv($studyTimeM, 60);
        $studyTimeM %= 60;
        $studyTimeArray = ['H' => $studyTimeH, 'M' => $studyTimeM];
        return $studyTimeArray;
    }
    
    public function study_time()
    {
        $studyTime = ($this->study_time_array()['H']) . '時間' . ($this->study_time_array()['M']) . '分';
        return $studyTime;
    }
}
