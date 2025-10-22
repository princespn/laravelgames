<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex,nofollow" />
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <title>Energeios</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}" />
{{--    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />--}}
    <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/fonts-icon.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link href="{{ asset('css/toast.css')}}" rel="stylesheet" type="text/css">
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- jQuery (required for Toastr) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>


<body data-typography="roboto" data-theme-version="light" data-layout="vertical" data-nav-headerbg="color_1" data-headerbg="color_1" data-sidebar-style="overlay" data-sibebarbg="color_1" data-sidebar-position="fixed" data-header-position="fixed" data-container="wide" direction="ltr" data-primary="color_1">


    <div id="main-wrapper" class="menu-toggle show">
            @include('layouts.navbars.admin.sidebar')
    </div>
        <div class="admin-content-body ">
            <div class="container-fluid">
                @yield('content')
                <!--   Core JS Files   -->
                {{-- Datatable Js --}}
                <script
                    src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/b-print-2.3.6/datatables.min.js">
                </script>

                <script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

                <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>

                <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.4/dataTables.bootstrap5.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('js/app.init.mini-sidebar.js') }}"></script>
    <script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('js/sparkline.js') }}"></script>
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
    {{-- Laravel backend toastr messages --}}
 <script src="{{ asset('js/toast.js') }}"></script>
    <!-- Now trigger session toastr -->
    <script>
    @if(session('toast'))
        toastr["{{ session('toast.type') }}"]("{{ session('toast.message') }}");
    @endif
    </script>
    <script>
        var base_url = '{{ url('/') }}';
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

    $(document).ready(function() {
        var base_url = '{{url('/')}}';
        $('#logout-btn').click(function() {
            new Swal({
                title: "Are you sure?",
                text: `you want to logout?`,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "No",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.value) {
                    setTimeout(function () {
                        window.location.href = '{{url('/1Rto5efWp86Z/logout')}}';
                    }, 100);
                }
            });
        });



// impersonate login
        $(document).on('click', '.org_login', function (e) {
            $('nav').addClass('adjust_navbar');
            var message = "Your current session will expire, Please click below to continue.";
            var id = $(this).data('id');
            var endpoint = base_url + '/1Rto5efWp86Z/user_login/' + id;
            Swal.fire({
                title: "Are you sure?",
                text: "You want to login to user panel",
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

        var showpassword = 0;
        $("#opass").click(function() {
            var eye = $("#opass i");

            if (showpassword == 0) {
                $("#password").attr("type", "text");
                eye.removeClass("fa-solid fa-face-smile-beam").addClass("fa-solid fa-face-laugh-beam");
                showpassword = 1;
            } else if (showpassword == 1) {
                $("#password").attr("type", "password");
                eye.removeClass("fa-solid fa-face-laugh-beam").addClass("fa-solid fa-face-smile-beam");
                showpassword = 0;
            }
        });
        $("#opass1").click(function() {
            var eye = $("#opass1 i");

        if (showpassword == 0) {
            $("#retype_password").attr("type", "text");
            eye.removeClass("fa-solid fa-face-smile-beam").addClass("fa-solid fa-face-laugh-beam");
            showpassword = 1;
        } else if (showpassword == 1) {
            $("#retype_password").attr("type", "password");
            eye.removeClass("fa-solid fa-face-laugh-beam").addClass("fa-solid fa-face-smile-beam");
            showpassword = 0;
        }
    });
    });

    //opt fun


        function sendAdminOtp(type) {
            var data = {
                type: type
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                }
            });
            $.ajax({
                url: "{{ route('send-otp-withdraw-mail') }}",
                method: "POST",
                data: data,
                success: function(resp) {
                    if (resp.code === 200) {
                        toastr.success(resp.message)
                    } else {
                        toastr.error(resp.message)
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }

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
                            window.location.href = '{{ url('1Rto5efWp86Z/login') }}';
                        }
                    }
                });
            }
        });

        function checkUserExisted(username) {

            if (username != '') {
                var data = {
                    user_id: username
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '{{ url('/1Rto5efWp86Z/checkuserexist') }}', // replace with the actual URL for the API endpoint
                    data: data,
                    dataType: "json",
                    success: (resp) => {

                        console.log(resp);
                        if (resp.code === 200) {
                            var fullname = $("#fullname");
                            var user_id = resp.data.id;
                            fullname.val(resp.data.fullname);
                            fullname.addClass('d-block');
                            fullname.removeClass('d-none');
                            fullname.removeClass('text-danger');
                            fullname.addClass('text-success');
                            var isAvialable = $("#isAvialable").html("User");

                            toastr.success(resp.message);
                        } else {
                            var fullname = $("#fullname");
                            var user_id = "";
                            var isAvialable = $("#isAvialable").html("User");
                            fullname.val("Not available");
                            fullname.addClass('d-block');
                            fullname.removeClass('d-none');
                            fullname.addClass('admin-form-control');
                            fullname.addClass('text-danger');
                            fullname.removeClass('text-success');
                            toastr.error(resp.message);
                        }

                    },
                    error: (err) => {
                        //   toastr.error(err)
                    }
                });

            }
        }
    </script>




</body>

</html>
