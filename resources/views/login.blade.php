@extends('layouts.layout')
@section('title', 'Login')
<link rel="stylesheet" href="/dist/css/loginform.css">

<style>
.sbtn {
        text-align: center;
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 4px;
  margin: 5px 0;
  opacity: 0.85;
  display: inline-block;
  font-size: 17px;
  line-height: 20px;
  text-decoration: none; /* remove underline from anchors */
}

.sbtn:hover {
  opacity: 1;
}

/* add appropriate colors to fb, twitter and google buttons */
.fb {
  background-color: #3B5998;
  color: white;
}

.twitter {
  background-color: #55ACEE;
  color: white;
}

.google {
  background-color: #dd4b39;
  color: white;
}
</style>


@section("section")
<div class="d-flex justify-content-center">

    <section style="padding:25px;" class="section">
        <div class="wrapper">
            <div class="title-text">
                <div class="title login">
                    <small>Welcome Back</small>
                </div>
                <div class="title signup">
                    <small>Sign Up Form</small>
                </div>
            </div>
            <div class="form-container">
                <div class="slide-controls">
                    <input type="radio" name="slide" id="login">
                    <input type="radio" name="slide" id="signup">
                    <label for="login" class="slide login"> <small>Login </small></label>
                    <label for="signup" class="slide signup"> <small>Signup </small></label>
                    <div class="slider-tab"></div>
                </div>
                <div class="form-inner">
                    <form action="#" Method="Post" class="login">
                        @csrf
                        <div class="field">
                            <input name="login-email" type="text" placeholder="Email Address"
                                value="{{ old('login-email') }}" required>
                            @error('login-email')
                            <span class="invalid-feedback" role="alert">
                                <small style="color:#f80d0d">{{ $message }}</small>
                            </span>
                            @enderror
                        </div>
                        <div class="field">
                            <input name="login-password" type="password" placeholder="Password" required>
                            @error('login-password')
                            <span class="invalid-feedback" role="alert">
                                <small style="color:#f80d0d">{{ $message }}</small>
                            </span>
                            @enderror
                        </div>
                        <div class="pass-link">
                            <a href="#">Forgot password?</a>
                        </div>
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Login">


                        </div>
                        <div class="signup-link">
                            Not a member? <a href="">Signup now</a>
                        </div>
                        <div class="line">
                            <p><span>OR</span></p>
                        </div>
                        <div class="col">
                            <a href="#" class="fb sbtn">
                              <i class="fab fa-facebook"></i> Login with Facebook
                             </a>
                            <a href="#" class="google sbtn">
                                <i class="fab fa-google">
                              </i> Login with Google
                            </a>
                          </div>
                    </form>
                    <form action="#" Method="Post" class="signup" enctype="multipart/form-data">
                        @csrf
                        <div class="field">
                            <div class="custom-file">
                                <input id="image" name="image" type="file" class="custom-file-input">
                                <label class="custom-file-label" for="image">Upload picture</label>
                            </div>
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <small style="color:#f80d0d">{{ $message }}</small>
                            </span>
                            @enderror
                        </div>
                        <div class="field">
                            <input type="hidden" name="status" value="checked">
                            <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <small style="color:#f80d0d">{{ $message }}</small>
                            </span>
                            @enderror
                        </div>
                        <div class="field">
                            <input type="text" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <small style="color:#f80d0d">{{ $message }}</small>
                            </span>
                            @enderror
                        </div>
                        <div class="field">
                            <input type="password" name="password" placeholder="Password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <small style="color:#f80d0d">{{ $message }}</small>
                            </span>
                            @enderror
                        </div>
                        <div class="field">
                            <input type="password" name="password_confirmation" placeholder="Confirm password" required>
                        </div>
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Signup" onsubmit="this.disabled = true;">
                        </div>
                        <div class="line">
                            <p><span>OR</span></p>
                        </div>
                        <div class="col">
                            <a href="#" class="fb sbtn">
                                <i class="fab fa-facebook"></i> Signup with Facebook
                            </a>
                            <a href="#" class="google sbtn"><i class="fab fa-google">
                                </i> Signup with Google
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <script>
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector("form .signup-link a");

        signupBtn.onclick = (()=>{
            loginForm.style.marginLeft = "-50%";
            loginText.style.marginLeft = "-50%";
        });
        loginBtn.onclick = (()=>{
            loginForm.style.marginLeft = "0%";
            loginText.style.marginLeft = "0%";
        });
        signupLink.onclick = (()=>{
            signupBtn.click();
            return false;
        });
        </script>

        @if(old('status') == 'checked')
        <script>
            signupLink.click();
        </script>
        @endif

        <script src="/plugins/jquery/jquery.min.js"></script>
        <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/js/adminlte.min.js"></script>
        <script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <script>
        $(function () {
            bsCustomFileInput.init();
        });
        </script>
    </section>
</div>
@endsection
