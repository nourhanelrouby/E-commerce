@extends('admin.layouts.admin')
@section('title','Products')
@section('content')
    <div class="mt-4">
        <button type="button" class="button x-small mb-3" data-toggle="modal" data-target="#exampleModal">
            Add New Product
        </button>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input name="name" type="text" class="@error('name') is-invalid @enderror form-control" id="name" value="{{old('name')}}" >
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="description">Product Description</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="@error('description') is-invalid @enderror form-control">{{old('description')}}</textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <input name="image" type="file" class="@error('image') is-invalid @enderror form-control" id="image">
                                    @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="price">Product Price</label>
                                    <input name="price" type="number" class="@error('price') is-invalid @enderror form-control" id="price" value = "{{old('price')}}">
                                    @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="stock">Product Amount</label>
                                    <input name="stock" type="number" class="@error('stock') is-invalid @enderror form-control" id="stock" value=" {{old('description')}}">
                                    @error('stock')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="category_id">Product Category</label>
                                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="category_id">
                                    <option value="">--Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Product Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" >
                                        <option value="1">Active</option>
                                        <option value="0">Not Active</option>
                                    </select>
                                    @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input is_offer" type="checkbox" value="1" id="offerCheck" name="offer">
                                        <label class="form-check-label" for="offerCheck">
                                            Offer
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div><div class="col-12 d-none new_price">
                            <div class="form-group">
                                <label for="offer_price">New Price</label>
                                <input name="offer_price" type="number" class="@error('offer_price') is-invalid @enderror form-control" id="offer_price" value="{{old('offer_price')}}">
                                @error('offer_price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
    @include('admin.layouts.success')
    @include('admin.layouts.error')
    <div class="table-responsive">
        <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
            <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Has Offer</th>
                <th>New Price</th>
                <th>Product Amount</th>
                <th>Product Category</th>
                <th>Status</th>
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $index=> $product)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>
                        <img src="{{asset('storage/' . $product->image)}}" width="100">
                    </td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->offer ? "Yes": "No"}}</td>
                    <td>{{$product->offer_price ? $product->offer_price : 0}}</td>
                    <td>{{$product->stock}}</td>
                    <td>{{$product->Category->name}}</td>
                    <td>
                        @if($product->status == 1)
                            {{'Active'}}
                        @else
                            {{'Not Active'}}
                        @endif
                    </td>
                    <td>
                        {{--  @if(auth('admin')->user()->store_id == null)  --}}
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{$product->id}}" title="Edit"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$product->id}}" title="Delete"><i class="fa fa-trash"></i></button>
                        {{--  @endif  --}}
                    </td>
                </tr>
                <!-- edit_modal_product -->
                <div class="modal fade" id="edit{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{$product->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="editModalLabel{{$product->id}}">
                                    Update
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- edit_form -->
                                <form action="{{route('admin.product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name{{$product->id}}">Product Name</label>
                                                <input value="{{$product->name}}" name="name" type="text" class="@error('name') is-invalid @enderror form-control" id="name{{$product->id}}" aria-describedby="nameHelp{{$product->id}}">
                                                @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="description{{$product->id}}">Product Description</label>
                                            <textarea name="description" id="description{{$product->id}}" cols="30" rows="10" class="@error('description') is-invalid @enderror form-control">{{$product->description}}</textarea>
                                            @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="image{{$product->id}}">Product Image</label>
                                                <input name="image" type="file" class="@error('image') is-invalid @enderror form-control" id="image{{$product->id}}">
                                                @error('image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="price{{$product->id}}">Product Price</label>
                                                <input value="{{$product->price}}" name="price" type="number" class="@error('price') is-invalid @enderror form-control" id="price{{$product->id}}">
                                                @error('price')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="stock{{$product->id}}">Product Price</label>
                                                <input value="{{$product->stock}}" name="stock" type="number" class="@error('stock') is-invalid @enderror form-control" id="stock{{$product->id}}">
                                                @error('stock')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="category_id{{$product->id}}">Product Category </label>
                                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="category_id{{$product->id}}">
                                                <option value="">--Choose Category--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="status{{$product->id}}">Product Status</label>
                                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status{{$product->id}}">
                                                    <option value="1" {{$product->status == 1 ? 'selected' : ''}}>Active</option>
                                                    <option value="0" {{$product->status == 0 ? 'selected' : ''}}>Not Active</option>
                                                </select>
                                                @error('status')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input is_offer" type="checkbox" value="1" id="offerCheck{{$product->id}}" name="offer" {{$product->offer ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="offerCheck{{$product->id}}">
                                                        عرض
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none new_price">
                                        <div class="form-group">
                                            <label for="offer_price">New Price</label>
                                            <input name="offer_price" value="{{$product->offer_price}}" type="number" class="@error('offer_price') is-invalid @enderror form-control" id="offer_price">
                                            @error('offer_price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- delete_modal_product -->
                <div class="modal fade" id="delete{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$product->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="deleteModalLabel{{$product->id}}">
                                    Delete Product
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('admin.product.delete', $product->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-body">
                                        Are You Sure?
                                        <input type="hidden" name="id" value="{{$product->id}}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </table>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.is_offer').on('change', function() {
                if($(this).is(':checked')) {
                    $(this).closest('.modal-body').find('.new_price').removeClass('d-none');
                } else {
                    $(this).closest('.modal-body').find('.new_price').addClass('d-none');
                }
            });
        });
    </script>
@endsection
