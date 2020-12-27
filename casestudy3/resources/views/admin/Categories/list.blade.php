@extends('admin.master')
@section('title', 'List Category')
@section('content')
    <main>
        <div class="container-fluid">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Category</li>
            </ol>
            <div class="col-12">

            </div>
            <a class="btn btn-primary mb-3" href="{{route('categories.create')}}">Add Category </a>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Category
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name_Category</th>
                                <th>Name_TypeOfNews</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                       @foreach($categories as $key => $category)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                    @foreach($category->typeofnews as $typeofnew)
                                        {{$typeofnew->name}},
                                    @endforeach
                                </td>
                                <td><a class="btn btn-info" href="{{route('categories.edit', $category->id)}}">Edit</a></td>
                                <td><a class="btn btn-danger" href="{{route('categories.destroy', $category->id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Delete</a></td>
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
