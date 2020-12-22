<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    function TypeOfNews(){
        return $this->belongsTo(TypeOfNews::class,'typeofnews_id','id');
    }
    function Comments(){
        return $this->hasMany(Comments::class,'news_id','id');
    }
}
