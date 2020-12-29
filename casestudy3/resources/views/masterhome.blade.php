
<!DOCTYPE html>
<html>
<head>
    <title>NTnews</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/li-scroller.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
<!--[if lt IE 9]>
    <script src="{{asset('/assets/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('/assets/js/respond.min.js')}}"></script>
    <![endif]-->
</head>
<body>
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
    <div class="box_wrapper">
        <header id="header">
            <div class="header_top">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav custom_nav">
                                <li><a href="{{route('home')}}">Trang chủ</a></li>
                                @foreach($categories_all as $category)
                                    <li><a href="{{route('category',$category->id)}}">{{$category->name}}</a></li>
                                @endforeach
                                @if(isset(Illuminate\Support\Facades\Auth::user()->name))
                                    <li class="text-center" style="width: 100px;"><a href="{{route('useredit')}}"><strong>{{\Illuminate\Support\Facades\Auth::user()->name}}</strong></a></li>
                                    <li class="active"><a href="{{route('user.logout')}}">Đăng xuất</a></li>
                                @endif
                                @if(empty(Illuminate\Support\Facades\Auth::user()->name))
                                    <li class="active"><a href="{{route('registerform')}}">Đăng Ký</a></li>
                                    <li class="active"><a href="{{route('userlogin')}}">Đăng nhập</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="header_search">
                    <button id="searchIcon"><i class="fa fa-search"></i></button>
                    <div id="shide">
                        <div id="search-hide">
                            <form action="{{route('searchnews')}}" method="get">
                                <input type="text" size="40" name="search" placeholder="Search here ...">
                            </form>
                            <button class="remove"><span><i class="fa fa-times"></i></span></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header_bottom">
                <div class="logo_area"><a class="logo" href="{{route('home')}}"><b>NT</b>news</a></div>
            </div>
        </header>
        <div class="latest_newsarea"> <span>Latest News</span>
            <ul id="ticker01" class="news_sticker">
                @foreach($news_master as $key => $new)
                    <li><a href="{{route('news',$new->id)}}">{{$new->title}}</a></li>
                @endforeach
            </ul>
        </div>
        @yield('slide')
        <section id="contentbody">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="row">
                        <div class="left_bar">
                            <div class="single_leftbar">
                                <h2><span>Recent Post</span></h2>
                                <div class="singleleft_inner">
                                    <ul class="recentpost_nav wow fadeInDown">
                                        @foreach($news_master as $key => $new)
                                            <li><a href="{{route('news',$new->id)}}"><img src="{{asset('/storage/'.substr($new->image,7))}}" alt=""></a>
                                                <a class="recent_title" href="{{route('news',$new->id)}}">{{$new->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @yield('content')
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="right_bar">
                            <div class="single_leftbar wow fadeInDown">
                                <h2><span>Popular Post</span></h2>
                                <div class="singleleft_inner">
                                    <ul class="catg3_snav ppost_nav wow fadeInDown">
                                        @foreach($news_popular as $key => $new)
                                            <li>
                                                <div class="media"> <a href="{{route('news',$new->id)}}" class="media-left"> <img alt="" src="{{asset('storage/'.substr($new->image,7))}}"> </a>
                                                    <div class="media-body"> <a href="{{route('news',$new->id)}}" class="catg_title">{{$new->title}}</a></div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="single_leftbar wow fadeInDown">
                                <h2><span>Labels</span></h2>
                                <div class="singleleft_inner">
                                    <ul class="label_nav">
                                        @foreach($typeofnews as $typeofnew)
                                            <li><a href="{{route('typeofnews',$typeofnew->id)}}">{{$typeofnew->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer id="footer">
            <div class="footer_top">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single_footer_top wow fadeInLeft">
                        <h2>Popular Post</h2>
                        <ul class="catg3_snav ppost_nav">
                            @foreach($news_popular_foot as $key => $new)
                                <li>
                                    <div class="media"> <a class="media-left" href="{{route('news',$new->id)}}"> <img src="{{asset('storage/'.substr($new->image,7))}}" alt=""> </a>
                                        <div class="media-body"> <a class="catg_title" href="{{route('news',$new->id)}}"> {{$new->title}}</a></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single_footer_top wow fadeInRight">
                        <h2>Labels</h2>
                        <ul class="footer_labels">
                            @foreach($typeofnews as $typeofnew)
                                <li><a href="{{route('typeofnews',$typeofnew->id)}}">{{$typeofnew->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single_footer_top wow fadeInRight">
                        <h2>Contact Form</h2>
                        <form action="{{route('addcontact')}}" class="contact_form" method="post">
                            @csrf
                            <label>Name</label>
                            <input class="form-control" name="name" type="text">
                            <label>Email*</label>
                            <input class="form-control" name="email" type="email">
                            <label>Message*</label>
                            <textarea class="form-control" name="message" cols="30" rows="10"></textarea>
                            <input class="send_btn" type="submit" value="Send">
                        </form>
                    </div>
                </div>
            </div>
            <div class="footer_bottom">
                <div class="footer_bottom_left">
                    <p>Copyright &copy; 2045</p>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="{{asset('/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('/assets/js/wow.min.js')}}"></script>
<script src="{{asset('/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/js/slick.min.js')}}"></script>
<script src="{{asset('/assets/js/jquery.li-scroller.1.0.js')}}"></script>
<script src="{{asset('/assets/js/custom.js')}}"></script>

</body>
</html>
