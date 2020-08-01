<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stulog extends Model
{
    protected $fillable = ['log_date', 'study_time'];

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
}