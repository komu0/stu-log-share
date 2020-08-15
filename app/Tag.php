<?php

namespace App;
use App\Library\BaseClass;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //createするときはcategoryから
    protected $fillable = [
        'name',
        'user_id',
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
        return BaseClass::time_double_to_japanese($this->study_time());
    }
}
