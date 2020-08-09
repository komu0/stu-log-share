<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StulogContent extends Model
{
    public function stulog()
    {
        return $this->belongsTo(Stulog::class);
    }
    
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
