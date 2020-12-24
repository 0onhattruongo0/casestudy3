@extends('admin.master')
@section('title', 'List Contact')
@section('content')
    <main>
        <div class="container-fluid">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Contact</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Contact
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $key => $contact)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$contact->name}}</td>
                                    <td>{{$contact->email}}</td>

                                    <td>{!!$contact->message!!}</td>
                                    <td><a class="btn btn-danger" href="{{route('contacts.destroy',$contact->id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Delete</a></td>
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

