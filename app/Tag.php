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
