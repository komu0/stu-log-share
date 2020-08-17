<?php

namespace App;
use App\Library\BaseClass;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // createするときはuserから。
    protected $fillable = [
        'name',
        'order',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function tags()
    {
        return $this->hasMany(Tag::class)->orderBy('order');
    }
    
    public function study_time()
    {
        return $this->stulog_contents()->sum('study_time');
    }
    
    public function display_study_time()
    {
        return BaseClass::time_double_to_japanese($this->study_time());
    }
    
    public function stulog_contents()
    {
        return $this->hasManyThrough(StulogContent::class, Tag::class);
    }
}
