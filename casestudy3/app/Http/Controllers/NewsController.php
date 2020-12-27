<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormNewsRequest;
use App\Models\Categories;
use App\Models\Comments;
use App\Models\News;
use App\Models\TypeOfNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    public function getlist(){
        $news = News::all();
        return view('admin.News.list', compact('news'));
    }
    public function create(){
        $categories= Categories::all();
        $typeofnews= TypeOfNews::all();
        return view('admin.News.create', compact('typeofnews','categories'));
    }
    public function store(FormNewsRequest $request){
        $news = new News();
        $news->title = $request->input('title');
        $news->summary = $request->summary;
        $news->content = $request->Content;
        $news->image   =$request->image->store('public');
        $news->highlights = $request->highlights;
        $news->view = $request->input('view');
        $news->typeofnews_id=$request->typeofnews_id;
        $news->save();
        Session::flash('success', 'Successful news add');
        return redirect()->route('news.list');
    }

    public function edit($id){
        $categories= Categories::all();
        $news = News::findOrFail($id);
        $typeofnews= TypeOfNews::all();
        return view('admin.News.edit',compact('news','typeofnews', 'categories'));
    }
    public function update($id, FormNewsRequest $request){
        $news          = News::findOrFail($id);
        $news->title   = $request->input('title');
        $news->summary = $request->summary;
        $news->content = $request->Content;
        $news->image=$this-> UpdateUpload($id, $request);
        $news->highlights = $request->highlights;
        $news->view    = $request->input('view');
        $news->typeofnews_id=$request->typeofnews_id;
        $news->save();
        Session::flash('info', 'Successful news update');
        return redirect()->route('news.list');

    }
    public function UpdateUpload($id,$request){
        $new= News::findOrFail($id);
        if($request->hasFile('image')){
            $img = $request->image;
            $path = $img->store('public');
            return $path;
        } else {
            return $new->image;
        }
    }

    public function destroy($id){
        $news = News::findOrFail($id);
//        $news->delete();
//        Session::flash('success', 'Successful category delete');
//        return redirect()->route('news.list');
        $comments = Comments::where('news_id', $id)->get();
        if (count($comments)) {
            $message = "If you want to delete this news.First, you need to delete all comments of this news.";
            return redirect()->route('news.list')->with('error', $message);
        } else $news->delete();
        Session::flash('success', 'Successful news delete');
        return redirect()->route('news.list');
    }

    public function changeHighlights(Request $request){
        $news= News::findOrFail($request->news_id);
        $news->highlights=$request->highlights;
        $news->save();

    }
}
