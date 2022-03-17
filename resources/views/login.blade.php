@extends('layouts.layout')
@section('title', 'Login')
<link rel="stylesheet" href="/public/dist/css/loginform.css">

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
                @if(Session::has('flash_message_error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>{!! session('flash_message_error') !!}</strong>
                    </div>
                @endif
                <div class="form-inner">
                    <form action="{{ route('login2') }}" Method="get" class="login">
                        @csrf
                        <div class="field">
                            <input name="email" id="email" type="email" placeholder="Email" required>
                        </div>
                        <div class="field">
                            <input name="password" id="password" type="password" placeholder="Password" required>

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
                            <span class="invalid-feedback" role="alert">
                                <small style="color:#f80d0d"></small>
                            </span>

                        </div>
                        <div class="field">
                            <input type="hidden" name="status" value="checked">
                            <input type="text" name="name" placeholder="Name" required>
                            <span class="invalid-feedback" role="alert">
                                <small style="color:#f80d0d"></small>
                            </span>

                        </div>
                        <div class="field">
                            <input type="text" name="email" placeholder="Email Address" required>
                            <span class="invalid-feedback" role="alert">
                                <small style="color:#f80d0d"></small>
                            </span>

                        </div>
                        <div class="field">
                            <input type="password" name="password" placeholder="Password" required>
                            <span class="invalid-feedback" role="alert">
                                <small style="color:#f80d0d"></small>
                            </span>

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
            // here we declare variables and via query selector
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector("form .signup-link a");

        // here if the singup button is clicked it slides to the signup form
        signupBtn.onclick = (()=>{
            loginForm.style.marginLeft = "-50%";
            loginText.style.marginLeft = "-50%";
        });
        // here if the login button is clicked it slides to the login form
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


         {{-- scripts  --}}
        <script src="public/plugins/jquery/jquery.min.js"></script>
        <script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="public/js/adminlte.min.js"></script>
        <script src="public/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <script>
        $(function () {
            bsCustomFileInput.init();
        });
        </script>
    </section>
</div>
@endsection
