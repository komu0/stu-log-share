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
        return $this->hasMany(Tag::class)->orderBy('tags.order');
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
    
    //dropdownのclassを返す
    public function can_change_tags_order()
    {
        if(count($this->tags)<=1) {
            return "disabled text-muted";
        }
        return "";
    }
}
