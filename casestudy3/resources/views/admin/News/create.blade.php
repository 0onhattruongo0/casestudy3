@extends('admin.master')
@section('title','Add News')
@section('content')
    <div class="col-12 col-md-12">
        <div class="row">
            <ol class="container-fluid breadcrumb mb-4">
                <li class="breadcrumb-item active">Add News</li>
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

                    <div class="form-group" >
                        <label>Category:</label>
                        <select name="categories" id="categories">
                            <option disabled selected multiple="">--Chọn--</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" >{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type Of News:</label>
                        <select name="typeofnews_id" id="typeofnews">
                            <option disabled selected multiple="">--Chọn--</option>
                            @foreach($typeofnews as $typeofnew)
                                <option value="{{$typeofnew->id}}" >{{$typeofnew->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" value="" name="title"  placeholder="Enter Title" required>
                    </div>
                    <div class="form-group">
                        <label>Summary</label>
                        <textarea type="text" class="form-control ckeditor" value="" name="summary"  placeholder="Enter Content" id="ckeditor" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea type="text" class="form-control ckeditor" value="" name="Content"  placeholder="Enter Content" id="ckeditor1" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" value="" name="image">
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label>Highlights</label>--}}
{{--                        <input type="number" class="form-control" value="" name="highlights"  placeholder="Enter Highlights" required>--}}
{{--                    </div>--}}
                    <div>
                        <label>Highlights</label><br>
                        <label>
                            <input type="radio" name="highlights" value="1"> Hot News
                        </label>
                        <label>
                            <input type="radio" name="highlights" value="0">Normal
                        </label>
                    </div>
                    <div class="form-group">
                        <label>View</label>
                        <input type="number" class="form-control" value="" name="view"  placeholder="Enter View" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

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
    </script>
@endsection
