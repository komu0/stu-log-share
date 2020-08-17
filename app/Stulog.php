<?php

namespace App;
use App\Library\BaseClass;

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
        return $this->hasMany(StulogContent::class)->join('tags', 'stulog_contents.tag_id', '=', 'tags.id')->orderBy('tags.order');
    }
    
    public function tags()
    {
        return $this->hasMany(StulogContent::class)->orderBy('tags.order');
    }
    
    public function study_time()
    {
        return $this->contents()->sum('study_time');
    }
    
    public function display_study_time()
    {
        return BaseClass::time_double_to_japanese($this->study_time());
    }
}