@extends('masterhome')
@section('slide')
    <div class="thumbnail_slider_area">
        <div class="owl-carousel">
            @foreach($news1 as $key => $new)
{{--                {{dd(count($new->comments))}}--}}
                <div class="signle_iteam" style="width: 395px; height: 320px;">
                    <img src="{{asset('storage/'.substr($new->image,7))}}" alt="">
                    <div class="sing_commentbox slider_comntbox">
                        <p><i class="fa fa-calendar"></i>{{$new->created_at}}</p>
                        <a href=""><i class="fa fa-comments"></i>{{count($new->comments)}} comments</a></div>
                    <a class="slider_tittle" href="{{route('news',$new->id)}}">{{$new->title}}</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('content')
                    <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
                        <div class="row">
                            <div class="middle_bar">
                                <div class="featured_sliderarea">
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                            <li data-target="#myCarousel" data-slide-to="1"></li>
                                            <li data-target="#myCarousel" data-slide-to="2"></li>
                                            <li data-target="#myCarousel" data-slide-to="3"></li>
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active"> <img src="{{asset('storage/'.substr($news[count($news2)-1]->image,7))}}" alt="" style="width: 100%; height: 100%">
                                                <div class="carousel-caption">
                                                    <h1><a href="{{route('news',$news[count($news2)-1]->id)}}"> {{$news[count($news2)-1]->title}}</a></h1>
                                                </div>
                                            </div>
                                            <div class="item"> <img src="{{asset('storage/'.substr($news[count($news2)-2]->image,7))}}" alt="" style="width: 100%; height: 100%">
                                                <div class="carousel-caption">
                                                    <h1><a href="{{route('news',$news[count($news2)-2]->id)}}">{{$news[count($news2)-2]->title}}</a></h1>
                                                </div>
                                            </div>
                                            <div class="item"> <img src="{{asset('storage/'.substr($news[count($news2)-3]->image,7))}}" alt="" style="width: 100%; height: 100%">
                                                <div class="carousel-caption">
                                                    <h1><a href="{{route('news',$news[count($news2)-3]->id)}}"> {{$news[count($news2)-3]->title}}</a></h1>
                                                </div>
                                            </div>
                                            <div class="item"> <img src="{{asset('storage/'.substr($news[count($news2)-4]->image,7))}}" alt="" style="width: 100%; height: 100%">
                                                <div class="carousel-caption">
                                                    <h1><a href="{{route('news',$news[count($news2)-4]->id)}}">{{$news[count($news2)-4]->title}}</a></h1>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="left left_slide" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> </a> <a class="right right_slide" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> </a></div>
                                </div>
                                <div class="single_category wow fadeInDown">
                                    <div class="category_title"> <a href="{{route('category',$categories[0]->id)}}"> Xã Hội </a></div>
                                    <div class="single_category_inner">
                                        <ul class="catg_nav">
                                            @foreach($categories[0]->News->sortByDesc('created_at')->take(4) as $new)
                                            <li>
                                                <div class="catgimg_container"> <a class="catg1_img" href="{{route('news',$new->id)}}"> <img src="{{asset('storage/'.substr($new->image,7))}}" alt=""> </a></div>
                                                <a class="catg_title" href="{{route('news',$new->id)}}"> {{$new->title}}</a>
                                                <div class="sing_commentbox">
                                                    <p><i class="fa fa-calendar"></i>{{$new->created_at}}</p>
                                                    <a href="#"><i class="fa fa-comments"></i>{{count($new->comments)}} Comments</a></div>
                                            </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                                <div class="single_category  wow fadeInDown">
                                    <div class="category_title"> <a href="{{route('category',$categories[5]->id)}}">Giải Trí</a></div>
                                    <div class="single_category_inner">
                                        <ul class="catg_nav catg_nav2">
                                            @foreach($categories[5]->News->sortByDesc('created_at')->take(2) as $new)
                                            <li>
                                                <div class="catgimg_container"> <a class="catg1_img" href="{{route('news',$new->id)}}">
                                                        <img src="{{asset('storage/'.substr($new->image,7))}}" alt=""> </a>
                                                </div>
                                                <div style="height: 46px;"><a class="catg_title" href="{{route('news',$new->id)}}">{{$new->title}}</a></div>
                                                <p class="post-summary">{!!$new->summary!!}</p>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="category_three_fourarea  wow fadeInDown">
                                    <div class="category_three">
                                        <div class="single_category">
                                            <?php $categories =App\Models\Categories::all();
                                            $data = $categories[1]->News->sortByDesc('created_at')->take(5);
                                            $data1=$data->shift();
                                            ?>
                                            <div class="category_title"> <a href="{{route('category',$categories[1]->id)}}">Thế Giới</a></div>
                                            <div class="single_category_inner">
                                                <ul class="catg_nav catg_nav3">
                                                    <li>
                                                        <div class="catgimg_container"> <a class="catg1_img" href="{{route('news',$data1->id)}}"> <img src="{{asset('storage/'.substr($data1->image,7))}}" alt=""> </a></div>
                                                        <a class="catg_title" href="{{route('news',$data1->id)}}">{{$data1->title}}</a>
                                                        <div class="sing_commentbox">
                                                            <p><i class="fa fa-calendar"></i>{{$data1->created_at}}</p>
                                                            <a href="#"><i class="fa fa-comments"></i>{{count($data1->comments)}} Comments</a></div>
                                                        <p class="post-summary">{!!$data1->summary!!}</p>
                                                    </li>
                                                </ul>
                                                <div class="catg3_bottompost wow fadeInDown">
                                                    <ul class="catg3_snav">
                                                        @foreach($data as $new)
                                                        <li>
                                                            <div class="media"> <a class="media-left" href="{{route('news',$new->id)}}"> <img src="{{asset('storage/'.substr($new->image,7))}}" alt=""> </a>
                                                                <div class="media-body"> <a class="catg_title" href="{{route('news',$new->id)}}"> {{$new->title}}</a>
                                                                    <div class="sing_commentbox">
                                                                        <p><i class="fa fa-calendar"></i>{{$new->created_at}}</p>
                                                                        <a href="#"><i class="fa fa-comments"></i>{{count($new->comments)}} Comments</a></div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="category_four wow fadeInDown">
                                        <div class="single_category">
                                            <?php $datasp = $categories[4]->News->sortByDesc('created_at')->take(5);
                                            $datasp1=$datasp->shift();
                                            ?>
                                            <div class="category_title"> <a href="{{route('category',$categories[4]->id)}}">Thể Thao</a></div>
                                            <div class="single_category_inner">
                                                <ul class="catg_nav catg_nav3">
                                                    <li>
                                                        <div class="catgimg_container"> <a class="catg1_img" href="{{route('news',$datasp1->id)}}"> <img src="{{asset('storage/'.substr($datasp1->image,7))}}" alt=""> </a></div>
                                                        <a class="catg_title" href="{{route('news',$datasp1->id)}}"> {{$datasp1->title}}</a>
                                                        <div class="sing_commentbox">
                                                            <p><i class="fa fa-calendar"></i>{{$datasp1->created_at}}</p>
                                                            <a href="#"><i class="fa fa-comments"></i>{{count($datasp1->comments)}} Comments</a></div>
                                                        <p class="post-summary">{!!$datasp1->summary!!}</p>
                                                    </li>
                                                </ul>
                                                <div class="catg3_bottompost wow fadeInDown">
                                                    <ul class="catg3_snav">
                                                        @foreach($datasp as $new)
                                                        <li>
                                                            <div class="media"> <a class="media-left" href="{{route('news',$new->id)}}"> <img src="{{asset('storage/'.substr($new->image,7))}}" alt=""> </a>
                                                                <div class="media-body"> <a class="catg_title" href="{{route('news',$new->id)}}"> {{$new->title}}</a>
                                                                    <div class="sing_commentbox">
                                                                        <p><i class="fa fa-calendar"></i>{{$new->created_at}}</p>
                                                                        <a href="#"><i class="fa fa-comments"></i>{{count($new->comments)}} Comments</a></div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single_category wow fadeInDown">
                                    <div class="category_title"> <a href="{{route('category',$categories[6]->id)}}">Công Nghệ</a></div>
                                    <div class="single_category_inner">
                                        <ul class="catg3_snav catg5_nav">
                                            @foreach($categories[3]->News->sortByDesc('created_at')->take(6) as $new)
                                            <li>
                                                <div class="media"> <a href="{{route('news',$new->id)}}" class="media-left"> <img alt="" src="{{asset('storage/'.substr($new->image,7))}}"> </a>
                                                    <div class="media-body"> <a href="{{route('news',$new->id)}}" class="catg_title">{{$new->title}}</a>
                                                        <div class="sing_commentbox">
                                                            <p><i class="fa fa-calendar"></i>{{$new->created_at}}</p>
                                                            <a href="#"><i class="fa fa-comments"></i>{{count($new->comments)}} Comments</a></div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

