@extends('layouts.user_type.website')
@section('content')
<style type="text/css">
   #toast-container .toast-message {
   font-size: 12px;
   color: #000000 !important;
   width: 250px !important;
   background-size: cover !important;
   padding: 10px 0px 10px 60px !important;
   font-weight: 400 !important;
   text-align: center;
   justify-content: center;
   line-height: 14px;
   margin: 51px 0px!important;
   z-index: 9999 !important;
   position: fixed;
   border: none !important;
   }
</style>
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
                        <form class="theme-form" id="forgot-password-form" action="{{ route('forgot-password') }}" method="POST">
                           <h5 class="text-white">Enter your Station ID and instructions will be sent to you on your mail!</h5>
                           @csrf
                           <div class="row gy-3">
                              <div class="col-xl-12">
                                 <label for="signin-username" class="form-label text-default">Station ID</label>
                                 <input type="text" class="form-control form-control-lg ph"  required id="user_id" autofocus="" name="user_id" placeholder="Enter Station ID" maxlength="9" pattern="[A-Z0-9]{1,11}"  />
                                 <span class="text-danger" id="isUserAvailable" style="display: none;margin-bottom: -20px;"></span>  
                              </div>
                           </div>
                           <!-- Replace the button to remove ripple effect and prevent expanding -->
                           <div class="form-group mt-4">
                              <button class="btn btn-main btn-block w-100 save_btn" type="submit" style="transition:none !important;overflow:hidden;position:relative;height: 40px;">
                                 Recover Password
                              </button>
                           </div>
                           <p class="mt-4 mb-0 text-center">Already have an account? <a class="ms-2" href="{{url('/login')}}">Login</a>
                           </p>
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
               <div class="text-center mb-2">
                  <a class="logo text-center ps-0" href="https://energeios.com/">
                  <img class="img-fluid logs" src="{{ asset('images/logo_admin.png')}}" alt="" width="250"></a>
               </div>
               <div class="login-main">
                  <form class="theme-form" id="forgot-password-form" action="{{ route('forgot-password') }}" method="POST">
                     <h4>Reset Password</h4>
                     <p>Enter your Station ID Password to Reset</p>
                     @csrf
                     <div class="row gy-3">
                        <div class="col-xl-12">
                           <label for="signin-username" class="form-label text-default">Station ID</label>
                           <input type="text" class="form-control form-control-lg ph"  required id="user_id" autofocus="" name="user_id" placeholder="Enter Station ID" maxlength="15" pattern="[A-Z0-9]{1,11}"  />
                           <span class="text-danger" id="isUserAvailable" style="display: none;margin-bottom: -20px;"></span>  
                        </div>
                        <div class="col-md-12">
                           <div class="login_form">
                              <div id="captcha" class="captcha form_div">
                                 <div class="preview"></div>
                                 <div class="captcha_form">
                                    <input type="text" id="captcha_form" class="form_input_captcha" placeholder="Enter Captcha">
                                    <!-- <label class="form_label_captcha">Enter Captcha</label> -->
                                    <button class="captcha_refersh">
                                    <i class="fa fa-refresh"></i>
                                    </button>
                                 </div>
                                 <p  id="catcha_error_mm" style="display: none;font-weight: 500; margin-top: 0px; font-size: 12px; color:red; margin-left: 0px;">Please enter valid captcha details</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group mb-0">
                        <button class="btn btn-primary btn-block w-100 save_btn" type="submit">Recover Password</button>
                     </div>
                     <p class="mt-4 mb-0 text-center">Remember your password? <a class="ms-2" href="{{url('/login')}}">Login</a>
                     </p>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xl-6 b-center bg-size" style="background-image: url(./images/2.jpg); background-size: cover; background-position: center center; display: block;">
      </div>
   </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
   $(document).ready(function() {
   
               $('#forgot-password-form').validate({
                   errorPlacement: function(error, element) {
                       if (element.parent('.input-group').length) {
                           error.insertAfter(element
                               .parent()); // place the error message after the input-group element
                       } else {
                           error.insertAfter(element); // place the error message after the input element
                       }
                   },
                   rules: {
                       user_id: {
                           required: true,
                       },
                       captchavalueinput: {
                           required: true,   
                       }
                   },
                   messages: {
                       user_id: {
                           required: "Station ID is required"
                       },
                       captchavalueinput: {
                           required:"Captcha Field is Required",
                       }
                   },
                   submitHandler: function(form) {
                       var captchaStatus = validateCaptcha();
                       if (captchaStatus == 1) {
                           form.submit();
                       }
                   }
               });
           });
   
   
   
           var allowSubmit = false;
           function capcha_filled () {
               allowSubmit = true;
           }
   
           function capcha_expired () {
               allowSubmit = false;
           }
           function check_if_capcha_is_filled(event) {
           if(allowSubmit)
           {
               $('#catcha_error').hide();
               return true;
           }
           else{
               event.preventDefault();
               $('#catcha_error').show();
               return false;
           }
       }
           $('#user_id').on('input', function() {
               var user_id = $(this).val();
               $.ajax({
                   url: base_url + "/checkuserexist",
                   type: "POST",
                   dataType: "json",
                   headers: {
                       "X-CSRF-TOKEN": csrf_token
                   },
                   data: {user_id: user_id},
                   success: function(data) {
                     // console.log(data.message);
                       if(data.code == 200){
                           $("#isUserAvailable").css('display' , 'block')
                           $("#isUserAvailable").removeClass('text-danger')
                           $("#isUserAvailable").addClass('text-success')
                           //$("#isUserAvailable").text(data.response)
                           $("#isUserAvailable").text(data.message);
                           $(".save_btn").removeAttr('disabled')
   
                       }else if(data.code == 404){
                           $("#isUserAvailable").addClass('text-danger')
                           $("#isUserAvailable").css('display' , 'block')
                           //$("#isUserAvailable").text('Wrong username')
                           $("#isUserAvailable").text('Invalid Station ID');
                           $(".save_btn").attr('disabled' , true)
                       }else{
                        if(data.message == "Sponsor ID required")
   
                           //$("#isUserAvailable").css('display' , 'none')
                            $("#isUserAvailable").text("");
                          
                           $(".save_btn").attr('disabled' , true)
                       }
                      
                   }
               });
           });
       
</script>
<script type="text/javascript">
   (function(){
   const fonts = ["cursive"];
   
   function gencaptcha()
   {
   var value = Math.round(Math.random() * 1000);
   value = value.toString().padStart(4, '0');
   captchaValue = value;
   }
   
   function setcaptcha()
   {
   let html = captchaValue.split("").map((char)=>{
       const rotate = -20 + Math.trunc(Math.random()*30);
       const font = Math.trunc(Math.random()*fonts.length);
       return`<span
       style="
       transform:rotate(${rotate}deg);
       font-family:${font[font]};
       "
      >${char} </span>`;
   }).join("");
   document.querySelector(".login_form #captcha .preview").innerHTML = html;
   }
   
   function initCaptcha()
   {
   document.querySelector(".login_form #captcha .captcha_refersh").addEventListener("click",function(){
       gencaptcha();
       setcaptcha();
   });
   
   gencaptcha();
   setcaptcha();
   }
   initCaptcha();
   
   
   
   
   })();
</script>
<script>
   // Prevent ripple effect and button expansion on submit
   $(document).ready(function() {
      $('#forgot-password-form').on('submit', function(e) {
         var $btn = $(this).find('.save_btn');
         $btn.css({
            'overflow': 'hidden',
            'transition': 'none',
            'position': 'relative'
         });
         // Remove any ripple effect classes if present
         $btn.removeClass('ripple-button');
      });
   });
</script>
@endsection
