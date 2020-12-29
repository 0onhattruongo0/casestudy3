<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\FormRegisterRequest;
use App\Http\Requests\FormUserEditRequest;
use App\Http\Requests\FormUserLoginRequest;
use App\Models\Categories;
use App\Models\Contact;
use App\Models\News;
use App\Models\TypeOfNews;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct()
    {
        $categories_all= Categories::all();
        $news=News::all();
        $typeofnews= TypeOfNews::all();
        $news_master =News::all()->sortByDesc('created_at')->take(10);
        $news_popular=News::all()->sortByDesc('view')->take(10);
        $news_popular_foot=News::all()->sortByDesc('view')->take(3);
        $hotnews=News::all()->where('highlights',1)->sortByDesc('created_at')->take(6);
        view()->share('categories_all',$categories_all);
        view()->share('news_master',$news_master);
        view()->share('news_popular',$news_popular);
        view()->share('typeofnews',$typeofnews);
        view()->share('news_popular_foot',$news_popular_foot);
        view()->share('news',$news);
        view()->share('hotnews',$hotnews);
    }
    
    public function index(){
        return view('index');
    }
    public function category($id){
        $categoriesfind= Categories::findOrFail($id);
        $newsindex=Categories::findOrFail($id)->news()->paginate(5);
        return view('categoriesindex',compact('categoriesfind','newsindex'));
    }
    public function typeofnews($id){
        $typeofnewsindex= TypeOfNews::findOrFail($id);
        $newsindex=TypeOfNews::findOrFail($id)->news()->paginate(5);
        return view('typeofnewsindex',compact('typeofnewsindex','newsindex'));
    }
    public function news($id){
        $newsshow=News::findOrFail($id);
        $newsshow->view+=1;
        $newsshow->save();
        $newsRelated=News::where('typeofnews_id',$newsshow->typeofnews_id)->take(3)->get();
        return view('newsindex',compact('newsshow','newsRelated'));
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

    public function addcontact(ContactRequest $request){
        $contact= new Contact();
        $contact->name= $request->name;
        $contact->email=$request->email;
        $contact->message=$request->message;
        $contact->save();
        return redirect()->route('home')->with('contact-success','Cám ơn bạn đã liên hệ với chúng tôi.');
    }

    public function getcontact(){
      $contacts= Contact::all();
      return view('admin.Contact.contactlist',compact('contacts'));
    }

    public function destroycontact($id){
        $contact= Contact::findOrFail($id);
        $contact->delete();
        Session::flash('success', 'Successful contact delete');
        return redirect()->route('contacts.list');
    }
    public function searchnews(Request $request){
        $newsindex= News::where('title','like','%'.$request->search.'%')->paginate(5);
        return view('searchnews',compact('newsindex'));
    }

}
