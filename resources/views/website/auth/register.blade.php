@extends('website.layouts.site')

@section('title', 'Register')

@section('content')
    <!--================ Register Box Area =================-->
    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>Already have an account?</h4>
                            <p>There are advances being made in science and technology every day, and a good example of this is the</p>
                            <a class="button button-account" href="{{ route('login') }}">Login Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner register_form_inner">
                        <h3>Create an account</h3>
                        <form class="row login_form" action="{{ route('signUp') }}" method="POST" id="register_form">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" value="{{ old('name') }}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone_number" name="phone" placeholder="Phone Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone Number'" value="{{ old('phone') }}">
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'" value="{{ old('address') }}">
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'" value="{{ old('email') }}">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmPassword" name="password_confirmation" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'">
                                @error('password_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="button button-register w-100">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Register Box Area =================-->
@endsection
