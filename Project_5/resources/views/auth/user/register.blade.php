
@extends("auth.auth")


@section("title","User | Register")


@section("content")




<!-- Login 12 start -->
<div class="login-12">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 bg-img none-992">
                <div class="info">
                    <h1>Welcome to Logy</h1>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the.</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 bg-color-13">
                <div class="form-section">
                    <div class="logo clearfix">
                        <a href="{{route("auth.user.register")}}">
                            <img src="{{asset("auth/assets/img/logos/logo.png")}}" alt="logo">

                        </a>
                    </div>
                    <h3>Create an account</h3>
                    <div class="btn-section clearfix">
                        <a href="{{route("auth.user.login")}}" class="link-btn active btn-1 default-bg">Login</a>
                        <a href="{{route("auth.user.register")}}" class="link-btn btn-2 active-bg">Register</a>
                    </div>
                    <div class="login-inner-form">

                        <form action="{{route("auth.user.register.post")}}" method="POST">
                            @csrf
                            <div class="form-group form-box">
                                <input type="text" name="name" class="input-text" placeholder="Full Name">
                                <i class="flaticon-user"></i>

                                <div id="emailHelp" class="form-text text-danger">
                                    @error("name")
                                        {{$message}}
                                    @enderror
                                 </div>

                            </div>
                            <div class="form-group form-box">
                                <input type="email" name="email" class="input-text" placeholder="Email Address">
                                <i class="flaticon-mail-2"></i>

                                <div id="emailHelp" class="form-text text-danger">
                                    @error("email")
                                        {{$message}}
                                    @enderror
                                 </div>
                            </div>
                            <div class="form-group form-box">
                                <input type="password" name="password" class="input-text" placeholder="Password">
                                <i class="flaticon-password"></i>
                                <div id="emailHelp" class="form-text text-danger">
                                    @error("password")
                                        {{$message}}
                                    @enderror
                                 </div>
                            </div>
                            <div class="checkbox clearfix">
                                <div class="form-check checkbox-theme">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">
                                        I agree to the <a href="#">terms of service</a>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-md btn-theme btn-block">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="social-list">
                        <a href="#" class="facebook-bg">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="#" class="twitter-bg">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="#" class="google-bg">
                            <i class="fa fa-google"></i>
                        </a>
                        <a href="#" class="linkedin-bg">
                            <i class="fa fa-linkedin"></i>
                        </a>
                        <a href="#" class="pinterest-bg">
                            <i class="fa fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login 12 end -->


@endsection
