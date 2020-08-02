<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $keyType = 'string';
    public $incrementing = false; 
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * このユーザに関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount('stulogs');
    }
    
    public function stulogs()
    {
        return $this->hasMany(Stulog::class);
    }
    
    public function studyTime()
    {
        $studyTimeH = $this->stulogs()->sum('study_time_H');
        $studyTimeM = $this->stulogs()->sum('study_time_M');
        //繰り上がり処理
        $studyTimeH += intdiv($studyTimeM, 60);
        $studyTimeM %= 60;
        $studyTime = $studyTimeH . '時間' . $studyTimeM . '分';
        return $studyTime;
    }
}