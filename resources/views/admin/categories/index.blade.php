@extends('admin.layouts.admin')
@section('title','Categories')
@section('content')
    <div class="mt-4">
        <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
            Add new Category
        </button>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new Category </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{--                    create--}}
                    <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fname">Name </label>
                                    <input  name = "name" type="text" class="@error('name') is-invalid @enderror form-control" id="fname" value="{{old('name')}}">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="desc">Category Description</label>
                                <textarea  name="description" id="desc" cols="30" rows="10" class="@error('description') is-invalid @enderror form-control">{{old('description')}}</textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row d-none" id="cats_list" >
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="projectinput1"> Choose Main Category</label>
                                    <select name="parent" class="select2 form-control">
                                        <option value="">--Choose Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('parent')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Main Category </label>
                                <input type="radio" name="type" value="1" checked class="switchery"data-color="success"/>
                            </div>
                            <div class="col-md-4">
                                <label>Sub Category</label>
                                <input type="radio" name="type" value="2" class="switchery" data-color="success"/>
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
    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>
            <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Category Description</th>
                <th>Main Category</th>
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $index=> $category)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td>{{$category->Parent? $category->Parent->name: '-'}}</td>
                    <td>
                        {{--                              @if(auth('admin')->user()->store_id == null)--}}
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="#edit{{ $category->id }}"
                                title="Edit"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#delete{{ $category->id }}"
                                title="Delete"><i
                                class="fa fa-trash"></i></button>
                        {{--                              @endif--}}
                    </td>
                </tr>
                <!-- edit_modal_Grade -->
                <div class="modal fade" id="edit{{ $category->id }}" tabindex="-1" role="dialog"
                     aria-labelledby="editLabel{{ $category->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="editLabel{{ $category->id }}">
                                    Update
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- edit_form -->
                                <form action="{{route('admin.category.update', $category->id)}}" method="post">

                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="fname">Category Name</label>
                                                <input value="{{$category->name}}" name = "name" type="text" class="@error('name') is-invalid @enderror form-control" id="fname" aria-describedby="emailHelp">
                                                @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="desc">Category Description</label>
                                            <textarea  name="description" id="desc" cols="30" rows="10" class="@error('description') is-invalid @enderror form-control">{{$category->description}}</textarea>
                                            @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="projectinput1"> Choose Main Category</label>
                                            <select name="parent" class="select2 form-control">
                                                <option value="">--Choose Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('parent')
                                            <span class="text-danger"> {{$message}}</span>
                                            @enderror
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
                <div class="modal fade" id="delete{{ $category->id }}" tabindex="-1" role="dialog"
                     aria-labelledby="deleteLabel{{ $category->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="deleteLabel{{ $category->id }}">
                                    Delete Category <b></b>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('admin.category.delete', $category->id)}}" method="post">

                                    @csrf
                                    @method('DELETE')
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
        <script src="{{ URL::asset('assets/admin/js/jquery-3.3.1.min.js') }}"></script>
        <script>
            $('input:radio[name="type"]').change(
                function(){
                    if (this.checked && this.value == '2') {  // 1 if main cat - 2 if sub cat
                        $('#cats_list').removeClass('d-none');
                    }else{
                        $('#cats_list').addClass('d-none');
                    }
                });
        </script>
    </div>
@stop
