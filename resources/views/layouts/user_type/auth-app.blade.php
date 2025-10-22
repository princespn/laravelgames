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
     <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/vendors/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/vendors/scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/vendors/animate.css')}}">

    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/vendors/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{ asset('/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('/css/color-1.css" media="screen')}}">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/responsive.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css" />
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <link href="{{ asset('css/toast.css')}}" rel="stylesheet" type="text/css">

    <script>
        var base_url = '{{url('/')}}';
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
    </script>
    <script>window.gtranslateSettings = {"default_language":"en","languages":["en","fr","de","it","es","nl","fi","el","hi","ja","da","cs","hr","ko","zh-TW","no","lt"],"wrapper_selector":".gtranslate_wrapper","flag_style":"3d","alt_flags":{"en":"usa","pt":"brazil","es":"argentina"}}</script>
    <script src="https://cdn.gtranslate.net/widgets/latest/popup.js" defer></script>
    <style>
        /* jQuery validation error style */
        label.error {
            color: #f44336;
            font-size: 12px;
            font-weight: 500;
            margin-top: 5px;
            margin-bottom: 0;
            display: block;
        }
        .form-group {
            margin-bottom: 20px;
        }

        .error{
            margin:0px!important;
            color: red;
        }

          .text-danger {
      color: #ff2d2d;          /* vivid red */
      font-weight: 700;        /* bold */
      line-height: 1.25;
      display: block;
    }
</style>
</head>
<body>
    @include('layouts.navbars.auth.nav')
    @include('layouts.navbars.auth.sidebar')
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
    @include('layouts.footers.auth.footer')
    
   <!-- latest jquery-->
    <script src="{{ asset('/js/jquery.min.js')}}"></script>
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
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <!-- Plugin used-->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
     <script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>

 <script src="{{ asset('js/toast.js') }}"></script>
    <!-- Now trigger session toastr -->
    <script>
    @if(session('toast'))
        toastr["{{ session('toast.type') }}"]("{{ session('toast.message') }}");
    @endif
    </script>

    <script>
        new DataTable('#example');
        window.addEventListener("load", function () {
            const loader = document.getElementById("ev-loader");
            loader.style.opacity = "0";
            setTimeout(() => {
              loader.style.display = "none";
            }, 500); // fade-out duration
          });
        // For Password Validations
        jQuery.validator.addMethod("strongPassword", function (value) {
            // Allow empty value (handled by required rule if needed)
            if (value.length === 0) {
                return true;
            }

            // Check strong password conditions
            return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]*$/.test(value);

        }, "Password must include at least 1 uppercase, 1 lowercase, 1 number, and 1 special character.");



    // Email Validations
    jQuery.validator.addMethod("validate_email", function(value, element) {
        var urlregex = /^([a-zA-Z0-9_+\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(urlregex.test(value)){
            var str = value;
            var foundString = str.substring(str.indexOf('@') + 1);
            var count = (foundString.match(/\./g) || []).length;
            if(parseInt(count) == 1){
                return true;
            }else{
                return false;
            }
            return true;
        }else{
            return false;
        }
    }, "Please enter a valid email address.");

  

    function sidebarLogout() {
        // new Swal({
        //     title: "Are you sure?",
        //     text: "You want to logout?",
        //     type: "warning",
        //     showCancelButton: true,
        //     confirmButtonColor: "#3085d6",
        //     cancelButtonColor: "#d33",
        //     cancelButtonText: "No",
        //     confirmButtonText: "Yes",
        // }).then((result) => {
        //     if (result.value) {
        //         setTimeout(function () {
        window.location.href = '{{url('/logout')}}';
        //         }, 100);
        //     }
        // });
    }

    // jQuery code
    $(document).ready(function() {
        $('#sidebar').show(); // hide the spinner initially
        $('#logoattop').show();
        
        // Exit access from impersonate login
        $(document).on('click', '.existAccess', function (e) {
            $('nav').addClass('adjust_navbar');
            var message = "Your current session will expire, Please click below to continue.";
            var id = $(this).data('logoutuserid');
            var endpoint = base_url + '/returnLogin/' + id;
            
            Swal.fire({
                title: "Are you sure?",
                text: "You want to login to the admin panel",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.value) {
                    var urls = endpoint;
                    window.location.href = urls;
                }
            });
        });

        document.addEventListener('visibilitychange', function() {
            if (document.visibilityState === 'visible') {
                $.ajax({
                    url: `{{ url('check-auth') }}`,
                    type: 'GET',
                    success: function(data) {
                        // User is logged in
                        console.log('User is authenticated', data);
                    },
                    error: function(jqXHR) {
                        if (jqXHR.status === 401) {
                            // Not logged in → redirect to login page
                            window.location.href = '{{ url('login') }}';
                        }
                    }
                });
            }
        });


    });
</script>

</body>
</html>
