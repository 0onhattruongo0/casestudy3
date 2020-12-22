<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfNews extends Model
{
    use HasFactory;
    function Categories(){
        return $this->belongsTo(Categories::class,'category_id','id');
    }
    function News(){
        return $this->hasMany(News::class,'typeofnews_id','id');
    }
}
