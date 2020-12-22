<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRegisterRequest;
use App\Http\Requests\FormUserEditRequest;
use App\Http\Requests\FormUserLoginRequest;
use App\Models\Categories;
use App\Models\News;
use App\Models\TypeOfNews;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(){
        $typeofnews= TypeOfNews::all();
        $categories = Categories::all();
        $news3=News::all()->sortByDesc('view')->take(10);
        $news4=News::all()->sortByDesc('view')->take(3);
        $news2=News::all();
        $news =News::all()->sortByDesc('created_at')->take(10);
        $news1=News::all()->where('highlights',1)->sortByDesc('created_at')->take(6);
        return view('index',compact('categories','news','news1','news2','news3','typeofnews','news4'));
    }
    public function category($id){
        $typeofnews= TypeOfNews::all();
        $categories1= Categories::findOrFail($id);
        $newsindex=Categories::findOrFail($id)->news()->paginate(5);
        $categories = Categories::all();
        $news3=News::all()->sortByDesc('view')->take(10);
        $news4=News::all()->sortByDesc('view')->take(3);
        $news2=News::all();
        $news =News::all()->sortByDesc('created_at')->take(3);
        $news1=News::all()->where('highlights',1)->sortByDesc('created_at')->take(6);
        return view('categoriesindex',compact('categories','news','news1','news2','news3','typeofnews','news4','categories1','newsindex'));
    }
    public function typeofnews($id){
        $typeofnews= TypeOfNews::all();
        $typeofnewsindex= TypeOfNews::findOrFail($id);
        $newsindex=TypeOfNews::findOrFail($id)->news()->paginate(5);
        $categories = Categories::all();
        $news3=News::all()->sortByDesc('view')->take(10);
        $news4=News::all()->sortByDesc('view')->take(3);
        $news2=News::all();
        $news =News::all()->sortByDesc('created_at')->take(3);
        $news1=News::all()->where('highlights',1)->sortByDesc('created_at')->take(6);
        return view('typeofnewsindex',compact('categories','news','news1','news2','news3','typeofnews','news4','typeofnewsindex','newsindex'));
    }
    public function news($id){
        $newsshow=News::findOrFail($id);
        $newsshow->view+=1;
        $newsshow->save();
        $newsRelated=News::where('typeofnews_id',$newsshow->typeofnews_id)->take(3)->get();
        $typeofnews= TypeOfNews::all();
        $categories = Categories::all();
        $news3=News::all()->sortByDesc('view')->take(10);
        $news4=News::all()->sortByDesc('view')->take(3);
        $news2=News::all();
        $news =News::all()->sortByDesc('created_at')->take(3);
        $news1=News::all()->where('highlights',1)->sortByDesc('created_at')->take(6);
        return view('newsindex',compact('categories','news','news1','news2','news3','typeofnews','news4','newsshow','newsRelated'));
    }

    public function usereditform(){
        $user= Auth::user();
        return view('useredit', compact('user'));
    }

    public function useredit($id, FormUserEditRequest $request){
        $user= User::find($id);
        if(Hash::check($request->oldpassword,Auth::user()->password) ){
            $user->password=Hash::make($request->newpassword);
            $user->save();
            return redirect()->route('useredit')->with('login-success', "Đổi mật khẩu thành công");

        }
        else {
            return redirect()->route('useredit')->with('login-error', 'Mật khẩu cũ không đúng!');
        }

    }

    public function registerForm(){
        return view('register-user');
    }

    public function register(FormRegisterRequest $request){
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->username=$request->username;
        $user->password= Hash::make($request->password);
        $user->roles=0;
        $user->save();
        return redirect()->route('registerform')->with('register-success', " Bạn tạo tài khoản thành công");


    }

    public function showLogin(){
        return view('userlogin');
    }
    public function login(FormUserLoginRequest $request){
        $user = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        if (!Auth::attempt($user)) {
            return redirect()->route('userlogin')->with('login-error', 'Tài khoản hoặc mật khẩu không đúng!');
        } else {
            return redirect()->route('home');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

}
