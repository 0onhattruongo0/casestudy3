<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table='categories';
    function TypeOfNews(){
        return $this->hasMany(TypeOfNews::class,'category_id','id');
    }
    function News(){
        return $this->hasManyThrough(News::class, TypeOfNews::class,'category_id','typeofnews_id','id');
    }
}
