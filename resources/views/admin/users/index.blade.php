@extends('admin.layouts.admin')
@section('title','Users')
@section('content')
    <div class="mt-4">
        <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
            Add New User
        </button>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.users.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fname">User Name</label>
                                    <input autocomplete="off"  name = "name" type="text" class="@error('name') is-invalid @enderror form-control" id="fname" value="{{old('name')}}">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fname">E-mail</label>
                                    <input autocomplete="off"  name = "email" type="text" class="@error('email') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp" value="{{old('email')}}">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fname">Password</label>
                                    <input autocomplete="off"  name = "password" type="password" class="@error('password') is-invalid @enderror form-control" id="fname" >
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fname">Password Confirmation</label>
                                    <input autocomplete="off"  name = "password_confirmation" type="password" class="@error('password_confirmation') is-invalid @enderror form-control" id="fname" >
                                    @error('password_confirmation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fname">Phone</label>
                                    <input autocomplete="off"  name = "phone" type="text" class="@error('phone') is-invalid @enderror form-control" id="fname" value="{{old('phone')}}">
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fname">Address</label>
                                    <input autocomplete="off"  name = "address" type="text" class="@error('address') is-invalid @enderror form-control" id="fname" value="{{old('address')}}">
                                    @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <br><br>
    @include('admin.layouts.success')
    @include('admin.layouts.error')
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr>
            <th>#</th>
            <th>User Name</th>
            <th>E-mail</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Operations</th>
        </tr>
        </thead>
        <tbody>
@foreach($users as $index=> $user)
            <tr>
                <td>{{$index+1}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->address}}</td>
                <td>
                    {{--  @if(auth('admin')->user()->store_id == null)  --}}
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#edit{{$user->id}}"
                            title="Edit"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                            data-target="#delete{{$user->id}}"
                            title="Delete"><i
                            class="fa fa-trash"></i></button>
                    {{--  @endif  --}}
                </td>
            </tr>
            <!-- edit_modal_Grade -->
            <div class="modal fade" id="edit{{$user->id}}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                id="exampleModalLabel">
                                Update
                            </h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- edit_form -->
                            <form action="{{route('admin.users.update' ,$user->id)}}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="fname">User Name</label>
                                            <input value="{{$user->name}}" autocomplete="off"  name = "name" type="text" class="@error('name') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="fname">E-mail</label>
                                            <input value="{{$user->email}}" autocomplete="off"  name = "email" type="text" class="@error('email') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                            @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="fname">Password</label>
                                            <input autocomplete="off" name = "password" type="password" class="@error('password') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                            @error('password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="fname">Phone</label>
                                            <input value="{{$user->phone}}" autocomplete="off"  name = "phone" type="text" class="@error('phone') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                            @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="fname">Address</label>
                                            <input value="{{$user->address}}" autocomplete="off"  name = "address" type="text" class="@error('address') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                            @error('address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    <button type="submit"
                                            class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- delete_modal_Grade -->
            <div class="modal fade" id="delete{{$user->id}}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                id="exampleModalLabel">
                                Delete  <b></b>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.users.delete' ,$user->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                Are You Sure ?

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    <button type="submit"
                                            class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </table>
@endsection
