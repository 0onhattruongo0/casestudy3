<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormTypeOfNewsRequest;
use App\Models\Categories;
use App\Models\News;
use App\Models\TypeOfNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TypeOfNewsController extends Controller
{
    public function getlist()
    {
        $typeofnews = TypeOfNews::all();
        return view('admin.TypeOfNews.list', compact('typeofnews'));

    }

    public function create()
    {
        $categories = Categories::all();
        return view('admin.TypeOfNews.create', compact('categories'));
    }

    public function store(FormTypeOfNewsRequest $request)
    {
        $typeofnew = new TypeOfNews();
        $typeofnew->name = $request->input('name');
        $typeofnew->category_id = $request->category;
        $typeofnew->save();
        Session::flash('success', 'Successful Type of News add');
        return redirect()->route('typeofnews.list');
    }

    public function edit($id)
    {
        $typeofnews = TypeOfNews::findOrFail($id);
        $categories = Categories::all();
        return view('admin.TypeOfNews.edit', compact('typeofnews', 'categories'));
    }

    public function update($id, FormTypeOfNewsRequest $request)
    {
        $typeofnews = TypeOfNews::findOrFail($id);
        $typeofnews->name = $request->input('name');
        $typeofnews->category_id = $request->category;
        $typeofnews->save();
        Session::flash('info', 'Successful type of news update');
        return redirect()->route('typeofnews.list');
    }

    public function destroy($id)
    {
        $typeofnew = TypeOfNews::findOrFail($id);
        $news = News::where('typeofnews_id', $id)->get();
        if (count($news)) {
            $message = "If you want to delete this type of news.First, you need to delete all news of this type of news.";
            return redirect()->route('typeofnews.list')->with('error', $message);
        } else $typeofnew->delete();
        Session::flash('success', 'Successful type of news delete');
        return redirect()->route('typeofnews.list');
    }
}
