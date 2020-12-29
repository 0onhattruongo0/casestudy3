@extends('masterhome')
@section('content')
        <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
          <div class="row">
            <div class="middle_bar">
              <div class="category_archive_area">
                  <ol class="breadcrumb">
                      <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home<i class="fa fa-angle-right"></i></a></li>
                      <li><a href="{{route('category',$categoriesfind->id)}}">{{$categoriesfind->name}}<i class="fa fa-angle-right"></i></a></li>
                      @foreach($categoriesfind->typeofnews as $typeofnew)
                      <li><a href="{{route('typeofnews',$typeofnew->id)}}"><small>{{$typeofnew->name}}</small><i class="fa fa-angle-right"></i></a></li>
                      @endforeach
                  </ol>
                  @foreach($newsindex as $new)
                <div class="single_archive wow fadeInDown"> <a href="{{route('news',$new->id)}}"><img src="{{asset('storage/'.substr($new->image,7))}}" alt=""></a> <a href="single_page.html" class="read_more">Read More <i class="fa fa-angle-double-right"></i></a>
                  <div class="singlearcive_article">
                    <h2><a href="{{route('news',$new->id)}}">{{$new->title}}</a></h2>
{{--                    <a class="author_name" href="#"><i class="fa fa-user"></i>Mohamed Kuddus Mia</a> <a class="post_date" href="#"><i class="fa  fa-clock-o"></i>Thursday,December 01,2045</a>--}}
                    <p>{!! $new->summary !!}</p>
                  </div>
                </div>
                  @endforeach
                  {!! $newsindex->links() !!}
              </div>
            </div>
          </div>
        </div>
@endsection
