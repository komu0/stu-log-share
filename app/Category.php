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
    
    public function study_time_array()
    {
        $tags = $this->tags;
        $studyTimeH = 0;
        $studyTimeM = 0;
        foreach ($tags as $tag){
            $studyTimeH += $tag->study_time_array()['H'];
            $studyTimeM += $tag->study_time_array()['M'];
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
