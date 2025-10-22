@extends('layouts.user_type.guest-app')
@section('content')
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<div class="container-fluid p-0">
   <div class="row m-0">
      <div class="col-12 p-0">
         <div class="login-card login-dark">
            <div>
               <div>
                  <a class="logo" href="{{ url('/')}}"><img class="img-fluid for-dark" src="{{ asset('images/logo/logo.png') }}" alt="looginpage"><img class="img-fluid for-light" src="{{ asset('images/logo/logo_dark.png') }}" alt="looginpage"></a>
               </div>
               <div class="login-main">
                  <form class="theme-form"  method="post" action="{{ url('/store-login') }}" id="login-form">
                     @csrf
                     <h4>Hello, Welcome Back</h4>
                     <p>Login to your account</p>
                     <div class="form-group">
                        <label class="col-form-label">Station ID</label>
                        <div class="input-group">
                           <input type="text" class="form-control" name="user_id" id="user_id" placeholder="Enter Station ID" value="{{old('user_id')}}" maxlength="30"  onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : /^[a-zA-Z0-9 ]+$/.test(event.key) && (event.target.value).length < 23" tabindex="1" style="cursor: text;">
                        </div>
                        <p class="text-danger" id="isUserAvailable" style="display: none;font-weight: 500;margin-bottom: 5px;font-size: 11px; margin-top: 0px;color: red;!important"> User not available
                        </p>
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <div class="form-input position-relative">
                           <input type="password" class="form-control" maxlength="30" placeholder="Enter Password" name="password" value="{{old('password')}}" id="password" tabindex="2" style="cursor: text;">
                           <div class="show-hide" id="opass" style="cursor: pointer;"> <i class="fas fa-eye-slash"></i></div>
                        </div>
                        @error('password')
                        <p class="text-danger text-xs">{{ $message }}</p>
                        @enderror
                     </div>
                     <div class="col-md-12 mb-3 hide" id="g2faDiv">
                        <input type="hidden" class="form-control" name="otp_2fa" id="otp_2fa" placeholder="Enter G2fa" value="{{old('otp_2fa')}}" maxlength="8"  onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : /^[a-zA-Z0-9 ]+$/.test(event.key) && (event.target.value).length < 23" tabindex="1">
                     </div>
                     <div class="mb-3">
                         <label class="col-form-label">Human Check </label>
                        <div style="display: flex; align-items: center; gap: 10px;">
                           <div id="cf-turnstile-container">
                              <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}"></div>
                           </div>
                           <button type="button" class="btn btn-outline-secondary btn-sm" id="refresh-captcha" title="Refresh Captcha">↻</button>
                        </div>
                        @error('cf-turnstile-response')
                           <p class="text-danger text-xs">{{ $message }}</p>
                        @enderror
                     </div>
                     <div class="form-group mb-0">
                        <div class="checkbox p-0">
                           <input id="checkbox1" type="checkbox">
                           <label class="text-muted" for="checkbox1">Remember password</label>
                        </div><a class="link" href="{{ url('/forget-password') }}">Forgot password?</a>
                        <div class="text-end mt-3">
                           <button class="btn btn-primary btn-block w-100" type="submit" id="save_btn" tabindex="4">Sign in</button>
                        </div>
                     </div>
                     <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="{{ url('/sign-up') }}">Create Account</a></p>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- model -->
<div class="modal fade enterOTP modal-lg" id="login_2fa_modal" tabindex="-1" aria-labelledby="loginFormLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="loginFormLabel">Enter Otp</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form class="row g-4 border-bottom-input z-index-999-relative">
               <div class="col-md-12">
                  <div class="">
                     <div class="col-md-12">
                        <input type="text" name="otp_2fa" id="pass-otp" class="form-control w1000" placeholder="Enter G2FA OTP" maxlength="6" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button class="btn btn-primary" onclick="submitLogin()" type="button">Submit</button>
         </div>
      </div>
   </div>
</div>

<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
   var base_url = '{{url('/')}}';
   var csrf_token = $('meta[name="csrf-token"]').attr('content');
   window.addEventListener('pageshow', function(event) {
      if (event.persisted) {
         window.location.reload();
      }
   });
   $(document).ready(function () {
      $('#login-form').validate({
         errorPlacement: function (error, element) {
            if (element.closest('.input-group').length) {
               error.insertAfter(element.closest('.input-group'));
            } else if (element.closest('.form-input').length) {
               error.insertAfter(element.closest('.form-input'));
            } else {
               error.insertAfter(element);
            }
         },
         rules: {
            user_id: {
               required: true,
            },
            password: {
               required: true,
            },
         },
         messages: {
            user_id: {
               required: "Station ID is required"
            },
            password: {
               required: "Password is required"
            }
         }
      });
   });

   var google2fa_status;
   $('#user_id').on('input', function() {
       let user_id = $(this).val().trim();

       // optional: clean pasted text to allow only alphanumeric
       user_id = user_id.replace(/[^a-zA-Z0-9]/g, '');
       $(this).val(user_id);

       if (user_id.length === 0) {
           $("#isUserAvailable").css('display', 'none');
           $("#save_btn").attr('disabled', true);
           return;
       }

       $.ajax({
           url: base_url + "/checkuserexist",
           type: "POST",
           dataType: "json",
           headers: { "X-CSRF-TOKEN": csrf_token },
           data: { user_id: user_id },
           success: function(data) {
               if (data.code == 200) {
                   google2fa_status = data.data.google2fa_status;
                   $("#isUserAvailable")
                     .show()
                     .removeClass('text-danger')
                     .addClass('text-success')
                     .text('Authorised Station');
                   $("#save_btn").attr('disabled', false);
               } else if (data.code == 404) {
                   $("#isUserAvailable")
                     .show()
                     .removeClass('text-success')
                     .addClass('text-danger')
                     .text('Unauthorised Station');
                   $("#save_btn").attr('disabled', true);
               } else {
                   $("#isUserAvailable").hide();
                   $("#save_btn").attr('disabled', true);
               }
           }
       });
   });

   // Captcha refresh logic
   $(document).ready(function() {
      $('#refresh-captcha').on('click', function() {
         // Remove the old captcha
         $('#cf-turnstile-container').empty();
         // Add a new captcha widget
         $('#cf-turnstile-container').append('<div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}"></div>');
         // Re-initialize Turnstile
         if (typeof turnstile !== 'undefined') {
            turnstile.render(document.querySelector('.cf-turnstile'));
         }
      });
   });
</script>
@endsection
