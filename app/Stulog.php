<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stulog extends Model
{
    protected $fillable = [
        'log_date',
        'study_time_H',
        'study_time_M',
        'content',
        'thought',
    ];

    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    protected $dates = [
        'created_at',
        'updated_at',
        'log_date',
    ];
    
    
    public function contents()
    {
        return $this->hasMany(StulogContent::class);
    }
    
    public function study_time_array()
    {
        $studyTimeH = $this->contents()->sum('study_time_H');
        $studyTimeM = $this->contents()->sum('study_time_M');
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