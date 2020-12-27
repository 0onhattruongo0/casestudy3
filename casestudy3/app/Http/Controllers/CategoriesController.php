<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormCategoryRequest;
use App\Models\Categories;
use App\Models\TypeOfNews;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    public function getlist(){
        $categories = Categories::all();
        return view('admin.Categories.list',compact('categories'));

    }
    public function create(){
        return view('admin.Categories.create');
    }
    public function store(FormCategoryRequest $request){
        $category = new Categories();
        $category->name = $request->input('name');
        $category->save();
        Session::flash('success', 'Successful category add');
        return redirect()->route('categories.list');
    }

    public function edit($id){
        $categories = Categories::findOrFail($id);
        return view('admin.Categories.edit',compact('categories'));
    }
    public function update($id, FormCategoryRequest $request){
        $categories = Categories::findOrFail($id);
        $categories->name=$request->input('name');
        $categories->save();
        Session::flash('success', 'Successful category update');
        return redirect()->route('categories.list');
    }
    public function destroy($id){
//        $categories = Categories::findOrFail($id);
//        $typeofnew= DB::table('type_of_news')->where('category_id',$id);
//        $typeofnew->delete();
//        $categories->delete();
//        Session::flash('success', 'Successful category delete');
//        return redirect()->route('Categories.list');

        $category = Categories::find($id);
        $typeofnew = TypeOfNews::where('category_id', $id)->get();
        if (count($typeofnew)) {
            $message = "If you want to delete this type of news.First, you need to delete all news of this type of news.";
            return redirect()->route('categories.list')->with('error', $message);
        } else
            $category->delete();
        Session::flash('success', 'Successful category delete');
        return redirect()->route('categories.list');
    }

}
