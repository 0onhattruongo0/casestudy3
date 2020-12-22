@extends('admin.master')
@section('title', 'List TypeOfNews')
@section('content')
    <main>
        <div class="container-fluid">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">TypeOfNews</li>
            </ol>
{{--            @if(\Illuminate\Support\Facades\Session::has('error'))--}}
{{--                <div class="alert alert-danger">--}}
{{--                    {{ \Illuminate\Support\Facades\Session::get('error') }}--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            <div class="col-12">--}}
{{--                @if (Session::has('success'))--}}
{{--                    <p class="text-success">--}}
{{--                        <i class="fa fa-check" aria-hidden="true"></i>{{ Session::get('success') }}--}}
{{--                    </p>--}}
{{--                @endif--}}
{{--            </div>--}}
            <a class="btn btn-primary mb-3" href="{{route('typeofnews.create')}}">Add TypeOfNews </a>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Type Of News
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name_TypeOfNews</th>
                                <th>Name_Category</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                       @foreach($typeofnews as $key => $typeofnew)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$typeofnew->name}}</td>
                                <td>{{ isset($typeofnew->categories->name) ? $typeofnew->categories->name : ''}}</td>
                                <td><a class="btn btn-info" href="{{route('typeofnews.edit', $typeofnew->id)}}">Edit</a></td>
                                <td><a class="btn btn-danger" href="{{route('typeofnews.destroy', $typeofnew->id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Delete</a></td>
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
