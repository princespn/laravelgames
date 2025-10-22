@extends('layouts.user_type.website')
@section('content')
<!-- content begin -->
<div class="no-bottom no-top" id="content">
   <div id="top"></div>
   <section class="pt10 pb10 mt80 bg-grey">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-12 text-center">
               <h3 class="mb-0">Reset Password In Energeios </h3>
            </div>
         </div>
      </div>
   </section>
   <section class="account-section ptb-30">
      <!-- Account Section Starts Here -->
      <div class=" padding-top padding-bottom">
         <div class="container">
            <div class="row justify-content-between align-items-center">
               <div class="col-lg-6 col-xl-6 d-none d-lg-block">
                  <div class="section__thumb rtl me-5">
                     <img src="{{ asset('web/images/background/login.webp')}}" alt="account" class="img-fluid">
                  </div>
               </div>
               <div class="col-lg-6 col-xl-5">
                  <div class="account__form__wrapper">
                     <h3 class="title text-white">Hello, Reset Your Password!</h3>
                     <div class="p-2">
                        <form class="theme-form" action="{{ route('reset-password') }}" method="POST" id="reset-form" role="form text-left">
                           <h5 class="text-white">Enter your Station ID Password to Reset</h5>
                           @csrf
                           <input type="hidden" name="token" value="{{ $token }}">
                           <div class="row gy-3">
                              <div class="col-xl-12 mb-2">
                                 <label for="reset-password" class="form-label text-default">Station ID</label>
                                 <input type="text" class="form-control form-control-lg user-id" placeholder="Station ID" name="user_id" maxlength="20" id="user_id" autofocus="" disabled value="{{ $user_id }}">
                              </div>
                              <input type="hidden" name="user_id" value="{{$user_id}}">                             
                           </div>
                           <div class="col-xl-12 mb-2">
                              <label for="reset-newpassword" class="form-label text-default">New Password</label>
                              <div class="input-group">
                                 <input type="password" maxlength="30" class="form-control form-control-lg password-input" onpaste="return false" placeholder="Enter New Password" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required name="password" id="password" autofocus="">
                                 <span class="input-group-text" id="opass">
                                 <i class="fas fa-eye"></i>
                                 </span>
                              </div>
                           </div>
                           <div class="col-xl-12 mb-4">
                              <label for="reset-confirmpassword" class="form-label text-default">Confirm Password</label>
                              <div class="input-group">
                                 <input type="password" maxlength="30" class="form-control form-control-lg password-input" onpaste="return false" placeholder="Enter confirm password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="confirm_password" id="confirmpassword"   autofocus="" required >
                                 <span class="input-group-text" id="opass1">
                                 <i class="fas fa-eye"></i>
                                 </span>
                              </div>
                           </div>
                           <span class="fs-14">Note: Password must be 8–16 characters, include at least one uppercase letter, one number, and one special character.</span>
                           <div class="form-group mt-4">
                              <button class="btn btn-main btn-block w-100" id="save_btn" type="submit" style="transition:none !important;overflow:hidden;position:relative;height: 40px;">Change Password</button>
                           </div>
                           <p class="mt-4 mb-0 text-center">Remember your password?<a class="ms-2" href="{{url('/login')}}">Login</a></p>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Account Section Ends Here -->
   </section>
</div>
<!-- content close -->


<div class="container-fluid d-none">
   <div class="row">
      <div class="col-xl-6 p-0">
         <div class="login-card login-dark">
            <div>
               <div class="text-center">
                  <a class="logo text-center ps-0" href="https://energeios.com/">
                  <img class="img-fluid logs" src="{{ asset('images/logo_admin.png')}}" alt="" width="250"></a>
                  
               </div>
               <div class="login-main">
                  <form class="theme-form" action="{{ route('reset-password') }}" method="POST" id="reset-form" role="form text-left">
                     <h4>Reset Password</h4>
                     <p>Enter your Station ID Password to Reset</p>
                     @csrf
                     <input type="hidden" name="token" value="{{ $token }}">
                     <div class="row gy-3">
                        <div class="col-xl-12 mb-2">
                           <label for="reset-password" class="form-label text-default">Station ID</label>
                           <input type="text" class="form-control form-control-lg user-id" placeholder="Station ID" name="user_id" maxlength="20" id="user_id" autofocus="" disabled value="{{ $user_id }}">
                        </div>
                        <input type="hidden" name="user_id" value="{{$user_id}}">                             
                     </div>
                     <div class="col-xl-12 mb-2">
                        <label for="reset-newpassword" class="form-label text-default">New Password</label>
                        <div class="input-group">
                           <input type="password" maxlength="30" class="form-control form-control-lg password-input" onpaste="return false" placeholder="Enter New Password" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required name="password" id="password" autofocus="">
                           <span class="input-group-text" id="opass">
                           <i class="fas fa-eye"></i>
                           </span>
                        </div>
                     </div>
                     <div class="col-xl-12 mb-4">
                        <label for="reset-confirmpassword" class="form-label text-default">Confirm Password</label>
                        <div class="input-group">
                           <input type="password" maxlength="30" class="form-control form-control-lg password-input" onpaste="return false" placeholder="Enter confirm password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="confirm_password" id="confirmpassword"   autofocus="" required >
                           <span class="input-group-text" id="opass1">
                           <i class="fas fa-eye"></i>
                           </span>
                        </div>
                     </div>
                     <div class="form-group mb-0">
                        <button class="btn btn-primary btn-block w-100" id="save_btn" type="submit">Change Password</button>
                     </div>
                     <p class="mt-4 mb-0 text-center">Already have an account?<a class="ms-2" href="{{url('/login')}}">Login</a></p>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xl-6 b-center bg-size" style="background-image: url(./images/2.jpg); background-size: cover; background-position: center center; display: block;">
      </div>
   </div>
</div>
<!--Old Code Of Design Later removed-->
<div class="container-fluid" style="display:none;">
   <div class="row">
      <div class="col-xl-7 b-center bg-size" style="background-image: url(http://localhost/mathmazic/images/2.jpg); background-size: cover; background-position: center center; display: block;">
         <img class="bg-img-cover bg-center" src="./Mofi - Premium Admin Template_files/2.jpg" alt="looginpage" style="display: none;">
      </div>
      <div class="col-xl-5 p-0">
         <div class="login-card login-dark">
            <div>
               <div><a class="logo text-start" href="{{url('/')}}">
                  <img class="img-fluid for-light" src="{{ asset('/images/logo.png')}}" alt="looginpage">
                  <img class="img-fluid for-dark" src="{{ asset('/images/logo.png')}}" alt="looginpage">
                  </a>
               </div>
               <div class="login-main">
                  <form class="theme-form" action="{{ route('reset-password') }}" method="POST" id="reset-form" role="form text-left">
                     <h4>Forgot Password</h4>
                     <p>Enter your Station ID password to Reset</p>
                     @csrf
                     <input type="hidden" name="token" value="{{ $token }}">
                     <div class="row gy-3">
                        <div class="col-xl-12 mb-2">
                           <label for="reset-password" class="form-label text-default">Station ID</label>
                           <input type="text" class="form-control form-control-lg user-id" placeholder="Station ID" name="user_id" maxlength="20" id="user_id" autofocus="" disabled value="{{ $user_id }}">
                        </div>
                        <input type="hidden" name="user_id" value="{{$user_id}}">                             
                     </div>
                     <div class="col-xl-12 mb-2">
                        <label for="reset-newpassword" class="form-label text-default">New Password</label>
                        <div class="input-group">
                           <input type="password" maxlength="30" class="form-control form-control-lg password-input" onpaste="return false" placeholder="Enter password" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required name="password" id="password" autofocus="">
                           <span class="input-group-text" id="opass">
                           <i class="fas fa-eye"></i>
                           </span>
                        </div>
                     </div>
                     <div class="col-xl-12 mb-4">
                        <label for="reset-confirmpassword" class="form-label text-default">Confirm Password</label>
                        <div class="input-group">
                           <input type="password" maxlength="30" class="form-control form-control-lg password-input" onpaste="return false" placeholder="Confirm password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="confirm_password" id="confirmpassword"   autofocus="" required >
                           <span class="input-group-text" id="opass1">
                           <i class="fas fa-eye"></i>
                           </span>
                        </div>
                     </div>
                     <div class="form-group mb-0">
                        <button class="btn btn-primary btn-block w-100" id="save_btn" type="submit">Change Password</button>
                     </div>
                     <p class="mt-4 mb-0 text-center">Already have an account?<a class="ms-2" href="{{url('/login')}}">Login</a></p>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<style type="text/css">
#passwordInput{
    color:red;
}
#password-error{
    color:red;
}#confirmpassword-error{
    color:red;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#reset-form').validate({
                errorPlacement: function(error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent()); // place the error message after the input-group element
                    } else {
                        error.insertAfter(element); // place the error message after the input element
                    }
                },
                rules: {
                    password: {
                        required: true,
                        minlength: 8,
                        maxlength: 16,
                        strongPassword : true
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#password"
                    },
                },

                messages:{
                    password: {
                        required: "New passowrd is required.",
                    },
                    confirm_password: {
                        required:"Confirm password is required.",
                        equalTo: "New password and confirm password not match",
                    },
                }
            });

        });

    </script>
@endsection
