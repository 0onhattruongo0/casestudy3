@extends('masterhome')
@section('content')
        <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
          <div class="row">
            <div class="middle_bar">
              <div class="single_post_area">
                <ol class="breadcrumb">
{{--                    {{dd($newsshow->typeofnews->categories->name)}}--}}
                  <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home<i class="fa fa-angle-right"></i></a></li>
                  <li><a href="{{route('category',$newsshow->typeofnews->categories->id)}}">{{$newsshow->typeofnews->categories->name}}<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="{{route('typeofnews',$newsshow->typeofnews->id)}}">{{$newsshow->typeofnews->name}}</a></li>
                </ol>
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                  @if (Session::has('success'))
                      <p class="text-success">
                          <i class="fa fa-check" aria-hidden="true"></i>{{ Session::get('success') }}
                      </p>
                  @endif
                <h2 class="post_title wow ">{{$newsshow->title}}</h2>

                <div class="single_post_content">
                    <strong>{!! $newsshow->summary !!}</strong>
                 {!! $newsshow->content !!}
                    <hr>
                    @if(isset(Illuminate\Support\Facades\Auth::user()->name))
                    <br>
                    <form action="/comment/{{$newsshow->id}}" method="post">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="Content" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Bình luận</button>
                    </form>
                    <hr>
                        @endif
                    <h4>Ý KIẾN BẠN ĐỌC</h4>
                    <hr>
                    @foreach($newsshow->comments as $cmt)
                            <a class="pull-left">
                                <img class="" style="width: 60px; height: 60px; margin-right: 20px;" src="{{asset('assets/img/anh-dai-dien-facebook-doc-3.jpg')}}">
                            </a>
                            <div class="">
                                <h4 class=""><strong>{{$cmt->User->name}}</strong><small>{{$cmt->created_at}}</small></h4>
                                {{$cmt->content}}
                            </div>
                        <hr>
                    @endforeach
                </div>
                <div class="related_post">
                  <h2 class="wow fadeInLeftBig">Related Posts you may like <i class="fa fa-thumbs-o-up"></i></h2>
                  <ul class="recentpost_nav relatedpost_nav wow fadeInDown animated">
                      @foreach($newsRelated as $new)
                    <li><div style="width: 100%; height: 100%;"><a href="{{route('news',$new->id)}}"><img alt="" src="{{asset('storage/'.substr($new->image,7))}}"></a>
                        </div>
                        <a href="{{route('news',$new->id)}}" class="recent_title">{{$new->title}}</a>
                    </li>
                      @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection

