@extends('admin.master')
@section('title', 'List News')
@section('content')
    <main>
        <div class="container-fluid">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">News</li>
            </ol>
{{--            <div class="col-12">--}}
{{--                @if(\Illuminate\Support\Facades\Session::has('error'))--}}
{{--                    <div class="alert alert-danger">--}}
{{--                        {{ \Illuminate\Support\Facades\Session::get('error') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                @if (Session::has('success'))--}}
{{--                    <p class="text-success">--}}
{{--                        <i class="fa fa-check" aria-hidden="true"></i>{{ Session::get('success') }}--}}
{{--                    </p>--}}
{{--                @endif--}}
{{--                @if(\Illuminate\Support\Facades\Session::has('Roles'))--}}
{{--                        <div class="alert alert-danger">--}}
{{--                            {{ \Illuminate\Support\Facades\Session::get('Roles') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--            </div>--}}

            <a class="btn btn-primary mb-3" href="{{route('news.create')}}">AddNews </a>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    News
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th style="padding-left: 100px; padding-right: 100px">Title</th>
                                <th>Image</th>
                                <th>Name_TypeofNews</th>
                                <th>Name_Category</th>
                                <th>Hot_News</th>
                                <th>View</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                       @foreach($news as $key => $new)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$new->title}}</td>
                                <td><img src="{{asset('/storage/'.substr($new->image,7))}}" alt="" style="width: 100px; height:100px" ></td>
                                <td>{{isset($new->TypeOfNews->name) ? $new->TypeOfNews->name : ""}} </td>
                                <td>{{isset($new->typeofnews->categories->name) ? $new->typeofnews->categories->name : ""}}</td>
                                <td><input class="toggle-class" data-id="{{$new->id}}" type="checkbox"
                                           data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Hot News" data-off="Normal"
                                           name="active"
                                           {{ ($new->highlights) ? 'checked': '' }}></td>
                                <td>{{$new->view}}</td>
                                <td><a class="btn btn-info" href="{{route('news.edit', $new->id)}}">Edit</a></td>
                                <td><a class="btn btn-danger" href="{{route('news.destroy', $new->id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Delete</a></td>
                            </tr>
                       @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
@section('script')
    <script>
        $(function(){
            $('.toggle-class').change(function(){
                var highlights = $(this).prop('checked') == true ? 1 : 0;
                var news_id = $(this).data('id');
                $.ajax({
                    type:"GET",
                    dataType:"json",
                    url:"/admin/news/changeHighlights",
                    data:{
                        'highlights':highlights,
                        'news_id':news_id,
                    },
                    success:function (data){
                        console.log('Success')
                    }

                });
            });
        });
    </script>
    @endsection
