<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comments;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function destroy($id)
    {
        $comment = Comments::find($id);
        $comment->delete($id);
        Session::flash('success', 'Successful comment delete');
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }

    public function comment($id, CommentRequest $request){
        $comment = new Comments;
        $comment->news_id=$id;
        $comment->users_id=Auth::user()->id;
        $comment->content=$request->Content;
        $comment->save();

        return redirect(route('news',$id))->with('success','Bạn đã bình luận vào bài viết');
    }
}
