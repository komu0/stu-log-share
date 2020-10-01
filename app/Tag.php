<?php

namespace App;
use App\Library\BaseClass;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //createするときはcategoryから
    protected $fillable = [
        'category_id',
        'name',
        'order',
    ];
    
    public function user()
    {
        return $this->category->user();
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function movable_category_names()
    {
        $user = $this->user;
        $category_id = $this->category->id;
        $array = $user->categories()->where('categories.id', '!=', $category_id)->get('categories.name')->toArray();
        $movable_categories_names = [];
        foreach ($array as  $name) {
            $movable_categories_names[$name["name"]] = $name["name"];
        };
        return $movable_categories_names;
    }
    
    public function stulog_contents()
    {
        return $this->hasMany(StulogContent::class)->join('stulogs', 'stulog_contents.stulog_id', '=', 'stulogs.id')->select('stulog_contents.*','log_date')->orderBy('log_date');
    }
    
    public function study_time()
    {
        return $this->stulog_contents()->sum('study_time');
    }
    
    public function display_study_time()
    {
        return BaseClass::time_double_to_japanese($this->study_time());
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
                $time += $this->stulog_contents()->where('log_date', date('Y-m-d',$date))->first()->study_time;
            }
            $time_trans_array[$display_date] = $time;
        }
        return $time_trans_array;
    }
    
    public function study_time_percentage()
    {
        $percentage = round($this->study_time() / $this->category->study_time() * 100, 1);
        return $percentage;
    }
    
    //dropdownのclassを返す
    public function can_move_to_another_category()
    {
        if(count($this->movable_category_names())==0) {
            return "disabled text-muted";
        }
        return "";
    }
}
