<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\TypeOfNews;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return view('admin.Categories.categories', compact('categories'));
    }

    public function addCategory(Request $request)
    {
            $category = new Categories();
            $category->name = $request->name;
            $category->save();
            Session::flash('success', 'Successful category add');
//        return response()->json($category);
            return redirect()->route('categories.index');
    }

    public function getCategoryById($id)
    {
        $category = Categories::find($id);
        return view('admin.Categories.categories', compact('category'));
    }

    public function updateCategory(Request $request)
    {
        $category = Categories::find($request->id);
        $category->name = $request->name;
        $category->save();
        Session::flash('info', 'Successful category update');
        return redirect()->route('categories.index');
    }

    public function deleteCategory($id)
    {
        $category = Categories::find($id);


        $typeofnew = TypeOfNews::where('category_id', $id)->get();
        if (count($typeofnew)) {
            $message = "If you want to delete this type of news.First, you need to delete all news of this type of news.";
            return redirect()->route('categories.index')->with('error', $message);
        } else
            $category->delete();
        Session::flash('success', 'Successful category delete');
        return redirect()->route('categories.index');
    }

}
