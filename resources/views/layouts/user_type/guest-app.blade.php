<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('/images/favicon.png')}}?v1" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/images/favicon.png')}}?v1" type="image/x-icon">
    <title>Energeios</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/font-awesome.css')}}">
    <!-- ico-font-->
     <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}?v={{ time() }}" />
    <!-- App css-->
    <link id="color" rel="stylesheet" href="{{asset('css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}">
    
    <link href="{{ asset('css/captcha.css') }}?v={{ time() }}" rel="stylesheet">
 <!-- Responsive css-->

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css" />

    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="{{ asset('css/toast.css')}}" rel="stylesheet" type="text/css">

<style>
.error,
#user_id-error,
#captchavalueinput-error {
    color: red;
}
.error{
    font-size: 11px!important;
        margin:0px!important;
        color: red;
    }
.text-danger {
  color: #ff2d2d;          /* vivid red */
  font-weight: 700;        /* bold */
  line-height: 1.25;
  display: block;
}

        .ev-loader-container {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: #001a13;
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          gap: 20px;
          z-index: 9999;
        }

        .ev-loader-ring {
          width: 140px;
          height: 140px;
          border-radius: 50%;
          border: 6px solid transparent;
          border-top: 6px solid #00ff95;
          border-right: 6px solid #00ff95;
          animation: spin 1.5s linear infinite;
          position: relative;
          background: radial-gradient(circle at center, #001a13 40%, transparent 41%);
        }

        .ev-inner-circle {
          position: absolute;
          top: 18px;
          left: 18px;
          width: 100px;
          height: 100px;
          background: #001a13;
          border-radius: 50%;
          display: flex;
          justify-content: center;
          align-items: center;
          box-shadow: 0 0 25px #00ff95;
        }

        .ev-plug-icon {
          font-size: 28px;
          color: #00ff95;
          animation: pulse 1.2s ease-in-out infinite;
        }

        .ev-loading-text {
          color: #ffffff;
          font-family: 'Arial', sans-serif;
          font-size: 16px;
          letter-spacing: 1px;
          opacity: 0.8;
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }

        @keyframes pulse {
          0% { transform: scale(1); opacity: 0.8; }
          50% { transform: scale(1.2); opacity: 1; }
          100% { transform: scale(1); opacity: 0.8; }
        }


</style>
 <body>
@if(!\Request::is('sign-up-user') && !\Request::is('1Rto5efWp86Z/login'))
    {{-- @include('layouts.navbars.guest.nav') --}}
@endif
 <!-- Loader -->
   <div id="ev-loader" class="ev-loader-container">
      <div class="ev-loader-ring">
          <div class="ev-inner-circle">
            <div class="ev-plug-icon">⚡</div>
          </div>
        </div>
        <div class="ev-loading-text">Charging your Station...</div>
   </div>
    @yield('content')
    <!-- latest jquery-->
    <script src="{{asset('js/jquery.min.js')}}?v1={{ time() }}"></script>
 <!-- Bootstrap js-->
    <script src="{{ asset('/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{ asset('/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('/js/scrollbar/simplebar.js')}}"></script>
    <script src="{{ asset('/js/scrollbar/custom.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('/js/config.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('/js/sidebar-menu.js')}}"></script>
    <script src="{{ asset('/js/sidebar-pin.js')}}"></script>
    <script src="{{ asset('/js/script.js')}}"></script>
    <!-- Theme js-->
    <script src="{{ asset('js/script.js')}}"></script>
    <script src="{{ asset('js/customizer.js')}}"></script>
    <!-- Plugin used-->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>

    <script src="{{ asset('js/toast.js') }}"></script>
    <!-- Now trigger session toastr -->
    <script>
    @if(session('toast'))
        toastr["{{ session('toast.type') }}"]("{{ session('toast.message') }}");
    @endif
    </script>
<script>
    window.addEventListener("load", function () {
    const loader = document.getElementById("ev-loader");
    loader.style.opacity = "0";
    setTimeout(() => {
      loader.style.display = "none";
    }, 500); // fade-out duration
  });
    // For Password Validations
    jQuery.validator.addMethod("strongPassword", function (value) {
        if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$#!%*?&#])[A-Za-z\d@$#!%*?&#]*$/.test(value)) {
            return true;
        } else if (value.length == 0) {
            return true;
        }
    }, "Password must include at least 1 uppercase, 1 lowercase, 1 number, and 1 special character");


    // Email Validations
    jQuery.validator.addMethod("validate_email", function(value, element) {
        var urlregex = /^([a-zA-Z0-9_+\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(urlregex.test(value)){
            var str = value;
            var foundString = str.substring(str.indexOf('@') + 1);
            var count = (foundString.match(/\./g) || []).length;
            if(parseInt(count) >= 1){
                return true;
            }else{
                return false;
            }
            return true;
        }else{
            return false;
        }
    }, "Please enter a valid email address.");


    jQuery.validator.addMethod("check_other_mails", function(value, element) {
        var urlregex = /^([a-zA-Z0-9_+\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(urlregex.test(value)){
            var str = value;
            var foundString = str.substring(str.indexOf('@') + 1);
            var count = (foundString.match(/\./g) || []).length;
            if(parseInt(count) >= 1){
                if(foundString.includes("gmail"))
                {
                    return true;
                }
                else{
                    return false;
                }
            }else{
                return false;
            }
            return true;
        }else{
            return false;
        }
    }, "You can create accounts only with Gmail address.");

    var base_url = '{{url('/')}}';
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    var showpassword = 0;
    $("#opass").click(function() {
        var eye = $("#opass i");

        if (showpassword == 0) {
            $("#password").attr("type", "text");
            eye.removeClass("fas fa-eye").addClass("fas fa-eye-slash");
            showpassword = 1;
        } else if (showpassword == 1) {
            $("#password").attr("type", "password");
            eye.removeClass("fas fa-eye-slash").addClass("fas fa-eye");
            showpassword = 0;
        }
    });
    $("#opass1").click(function() {
        var eye = $("#opass1 i");

        if (showpassword == 0) {
            $("#confirmpassword").attr("type", "text");
            eye.removeClass("fas fa-eye").addClass("fas fa-eye-slash");
            showpassword = 1;
        } else if (showpassword == 1) {
            $("#confirmpassword").attr("type", "password");
            eye.removeClass("fas fa-eye-slash").addClass("fas fa-eye");
            showpassword = 0;
        }
    });
    function onClick(e) {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        e.preventDefault();
        grecaptcha.ready(function() {
            if(grecaptcha.getResponse() == ''){
                $("#catcha_error").css('display','block')
                return false;
            }else{
                $("#catcha_error").css('display','none')
            }
            grecaptcha.execute("6LcWpJQlAAAAACeq-KmbHb3l8lngJxneYyF4AM2F", {action: 'submit'}).then(function(token) {
                $.post("{{url('/verify-recaptcha')}}", {token: token, action: 'submit', _token: '{{ csrf_token() }}',})
                    .done(function(data) {
                        document.getElementById('my-form').submit();
                    })
                    .fail(function(error) {

                        console.log('reCAPTCHA verification failed.');
                    });

            });
        });
        return false;
    }
</script>
</body>
</html>

