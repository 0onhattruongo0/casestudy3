@extends('admin.master')
@section('title','Edit Type Of News')
@section('content')
    <div class="col-12 col-md-12">
        <div class="row">
            <ol class="container-fluid breadcrumb mb-4">
                <li class="breadcrumb-item active">Edit Type Of News</li>
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
                <form method="post" action="">
                    @csrf
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{($category->name==$typeofnews->categories->name) ? "selected":""}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Typeofnews</label>
                        <input type="text" class="form-control" value="{{$typeofnews->name}}" name="name"  placeholder="Enter TypeOfNews" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
