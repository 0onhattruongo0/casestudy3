<?php

namespace App\Http\Controllers;

use App\Models\TypeOfNews;
use Illuminate\Http\Request;

class ajaxController extends Controller
{
    public function getTypeofnews($id){
        $typeofnews= TypeOfNews::where('category_id',$id)->get();
        foreach ($typeofnews as $typeofnew){
           echo "<option value='".$typeofnew->id."'>".$typeofnew->name."</option>";
        }
    }
}

