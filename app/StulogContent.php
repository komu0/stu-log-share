<?php

namespace App;
use App\Library\BaseClass;

use Illuminate\Database\Eloquent\Model;

class StulogContent extends Model
{
    //createするときはuser->tagから。
    protected $fillable = [
        'tag_id',
        'study_time',
        'comment',
    ];
    
    public function stulog()
    {
        return $this->belongsTo(Stulog::class);
    }
    
    public function tag()
    {
        return $this->belongsTo(Tag::class)->orderBy('order');
    }
    
    public function display_study_time()
    {
        return BaseClass::time_double_to_japanese($this->study_time);
    }
    
    public function display_study_time_hhmm() {
        return BaseClass::time_double_to_hhmm($this->study_time);
    }
}
