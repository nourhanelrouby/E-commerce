@extends('admin.layouts.admin')
@section('title','Edit Profile ' . $user->name)
@section('content')
    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>Edit profile page</h4>
                            <p>Update Admin Profile</p>
                        </div>
                    </div>
                </div>
                @include('admin.layouts.success')
                @include('admin.layouts.error')
                <div class="col-lg-6">
                    <div class="login_form_inner register_form_inner">
                        <h3>Edit profile {{$user->name}}</h3>
                        <form class="row login_form" action="{{route('admin.updateProfile')}}" method="POST" id="register_form">
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="col-md-12 form-group">
                                <input value="{{$user->name}}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input value="{{$user->email}}" type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'">
                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="button button-register w-100">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
