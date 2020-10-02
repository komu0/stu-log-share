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
        return $this->hasManyThrough(StulogContent::class, Tag::class)->join('stulogs', 'stulog_contents.stulog_id', '=', 'stulogs.id')->select('stulog_contents.*','log_date')->orderBy('log_date');
    }
    
    public function time_trans_array()
    {
        $firstLogDate = strToTime(date($this->stulog_contents()->orderBy('log_date')->first()->log_date));
        $startDate = strToTime('-1 day', $firstLogDate);
        $today = strToTime(date('Y-m-d'));
        $time_trans_array = [];
        $time = 0;
        for($date =$startDate; $date <= $today; $date = strToTime('+1 day', $date)){
            $display_date = date('Y年m月d日', $date);
            if($this->stulog_contents()->where('log_date', date('Y-m-d', $date))->exists()){
                foreach($this->stulog_contents()->where('log_date', date('Y-m-d', $date))->get() as $content) {
                    $time += $content->study_time;
                }
            }
            $time_trans_array[$display_date] = $time;
        }
        return $time_trans_array;
    }
    
    //dropdownのclassを返す
    public function can_change_tags_order()
    {
        if(count($this->tags)<=1) {
            return "disabled text-muted";
        }
        return "";
    }
    
    public function study_time_percentage()
    {
        $percentage = round($this->study_time() / $this->user->study_time() * 100, 1);
        return $percentage;
    }
    
    public function study_time_percentage_array()
    {
        $study_time_percentage_array = [];
        foreach ($this->tags as $tag) {
            $study_time_percentage_array[$tag->name] = $tag->study_time_percentage();
        }
        return $study_time_percentage_array;
    }
}
