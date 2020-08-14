<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stulog extends Model
{
    // createするときはuserから。
    protected $fillable = [
        'log_date',
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
    
    public function tags()
    {
        return $this->hasMany(StulogContent::class);
    }
    
    public function study_time()
    {
        return $this->contents()->sum('study_time');
    }
    
    public function display_study_time()
    {
        $H = floor($this->study_time());
        $M = ($this->study_time() - floor($this->study_time())) * 60;
        $studyTime =  $H . '時間' . $M . '分';
        return $studyTime;
    }
}