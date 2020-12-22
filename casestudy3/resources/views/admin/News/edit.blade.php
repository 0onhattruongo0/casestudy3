@extends('admin.master')
@section('title','Edit News')
@section('content')
    <div class="col-12 col-md-12">
        <div class="row">
            <ol class="container-fluid breadcrumb mb-4">
                <li class="breadcrumb-item active">Edit News</li>
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
            <div class="col-12">
                <form method="post" action="" enctype="multipart/form-data">
                    @csrf
{{--                    <div class="form-group" >--}}
{{--                        <label>News</label>--}}
{{--                        <select name="typeofnews">--}}
{{--                            <option disabled selected multiple="">--Chọn--</option>--}}
{{--                            @foreach($typeofnews as $typeofnew)--}}
{{--                                <option value="{{$typeofnew->id}}"--}}
{{--                                {{($typeofnew->id == $news->typeofnews_id) ? "selected":''}}--}}
{{--                                >{{$typeofnew->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
                    <div class="form-group" >
                        <label>Category:</label>
                        <select name="categories" id="categories">
                            <option disabled selected multiple="">--Chọn--</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{($category->id == $news->typeofnews->categories->id) ? "selected":''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type Of News:</label>
                        <select name="typeofnews_id" id="typeofnews">
                            <option disabled selected multiple="">--Chọn--</option>
                            @foreach($typeofnews as $typeofnew)
                                <option value="{{$typeofnew->id}}" {{($typeofnew->id == $news->typeofnews_id) ? "selected":''}} >{{$typeofnew->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" value="{{$news->title}}" name="title"  placeholder="Enter Title" required>
                    </div>
                    <div class="form-group">
                        <label>Summary</label>
                        <textarea type="text" class="form-control ckeditor" value="{{($news->summary)}}" name="summary"  placeholder="Enter Content" id="ckeditor2" required>{{($news->summary)}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea type="text" class="form-control ckeditor" value="" name="Content"  placeholder="Enter Content" id="ckeditor3" required>{{$news->content}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" value="" name="image" >
                    </div>
                    <div>
                        <label>Highlights</label><br>
                        <label>
                            <input type="radio" name="highlights" value="1" {{($news->highlights==1)?"checked":""}}>Hot News
                        </label>
                        <label>
                            <input type="radio" name="highlights" value="0" {{($news->highlights==0)?"checked":""}}>Normal
                        </label>
                    </div>
                    <div class="form-group">
                        <label>View</label>
                        <input type="number" class="form-control" value="{{$news->view}}" name="view"  placeholder="Enter View" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>



    <main class="mt-5">
        <div class="container-fluid">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Comments</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Comment
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr >
                                <th>ID</th>
                                <th>Content</th>
                                <th>UserName</th>
                                <th>Create_at</th>
                                <th>Update_at</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($news->comments as $key => $comment)
{{--                                {{dd($comment->user)}}--}}
                                <tr id="mid{{$comment->id}}">
                                    <td>{{$key+1}}</td>
                                    <td>{!! $comment->content !!}</td>
                                    <td>{{$comment->user->username}}</td>
                                    <td>{{$comment->created_at}}</td>
                                    <td>{{$comment->update_at}}</td>
{{--                                    <td><a href="{{route('comments.destroy',$comment->id)}}" onclick="">Delete</a></td>--}}
                                    <td><a href="javascript:void(0)" class="btn btn-danger deletecmt" data-id="{{ $comment->id }}" data-token="{{ csrf_token() }}" >Delete</a></td>
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
        $(document).ready(function (){
            $("#categories").change(function (){
                var categoties_id = $(this).val();
                $.get("/admin/ajax/typeofnews/"+categoties_id,function (data){
                    $("#typeofnews").html(data);
                });
            });
        });

        $(".deletecmt").click(function(){
            var id = $(this).data("id");
            var token = $(this).data("token");
            $.ajax(
                {
                    url: "/admin/comments/destroy/"+id,
                    type: 'GET',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'POST',
                        "_token": token,
                    },
                    success: function ()
                    {
                        console.log("it Work");
                        location.reload();
                    }
                });

            console.log("It failed");
        });
    </script>


@endsection
