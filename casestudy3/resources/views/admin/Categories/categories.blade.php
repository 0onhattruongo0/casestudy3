@extends('admin.master')
@section('title', 'Categories ')
@section('content')
    <section>
        <div class="container-fluid">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Category</li>
            </ol>
            <a class="btn btn-primary mb-3" data-toggle="modal" data-target="#categoriesModal">Add Category </a>
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
                                    <td><a class="btn btn-info" href="{{route('categories.edit', $category->id)}}" data-toggle="modal" data-target="#categoriesEditModal{{$category->id}}">Edit</a></td>
                                    <td><a class="btn btn-danger" href="{{route('categories.destroy', $category->id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Delete</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--Add Modal -->
    <div class="modal fade" id="categoriesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="modal-body">
                    <form id="categoryForm" action="{{route('categories.add')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Categoryname</label>
                            <span class="text-danger"></span>
                            <strong id="name-error"></strong>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <button id="submitaddForm" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--Edit Modal -->
    <div class="modal fade" id="categoriesEditModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="categoryEditForm{{$category->id}}" action="{{route('categories.update',$category->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Categoryname</label>
                            <input type="text" value="{{$category->name}}" name="name" class="form-control" id="name1" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        // $('body').on('click', '#submitaddForm', function(){
        //     var registerForm = $("#categoryForm");
        //     var formData = registerForm.serialize();
        //     $( '#name-error' ).html( "" );
        //
        //     $.ajax({
        //         url:'/category',
        //         type:'POST',
        //         data:formData,
        //         success:function(data) {
        //             console.log(data);
        //             if(data.errors) {
        //                 if(data.errors.name){
        //                     $( '#name-error' ).html( data.errors.name[0] );
        //                 }
        //
        //             }
        //             if(data.success) {
        //                 $('#success-msg').removeClass('hide');
        //                 setInterval(function(){
        //                     $('#SignUp').modal('hide');
        //                     $('#success-msg').addClass('hide');
        //                 }, 3000);
        //             }
        //         },
        //     });
        // });

        @if(Session::has('errors'))
        $(document).ready(function(){
            $('#categoriesModal').modal({show: true});
        }
    @endif
    </script>
@endsection
