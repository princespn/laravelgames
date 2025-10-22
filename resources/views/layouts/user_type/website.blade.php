<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Energeios Financial LTD">
    <meta name="keywords" content="Energeios Financial LTD">
    <meta name="author" content="Energeios Financial LTD">

    <title>Energeios Financial LTD - Energeios | Energeios Financial LTD</title>
    <link rel="icon" href="{{ asset('web/images/favicon.png')}}" type="image/png" sizes="16x16">

    <!-- CSS Files -->
    <link href="{{ asset('web/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('web/css/plugins.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('web/css/swiper.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('web/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/toast.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('web/css/coloring.css')}}" rel="stylesheet" type="text/css">
    <!-- Color Scheme -->
    <link id="colors" href="{{ asset('web/css/colors/scheme-01.css')}}" rel="stylesheet" type="text/css">

    <style>
p#isUserAvailable, .text-danger {
    font-size: 12px!important;
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
</head>

<body>
<div id="wrapper">
    <div class="float-text show-on-scroll">
        <span><a href="#">Scroll to top</a></span>
    </div>
    <div class="scrollbar-v show-on-scroll"></div>

    <!-- Loader -->
   <div id="ev-loader" class="ev-loader-container">
      <div class="ev-loader-ring">
          <div class="ev-inner-circle">
            <div class="ev-plug-icon">⚡</div>
          </div>
        </div>
        <div class="ev-loading-text">Charging your Station...</div>
   </div>

    <!-- Header -->
    <header class="header-lightscroll-light has-topbar">
        <div class="container">
            <div class="de-flex sm-pt10">
                <div class="de-flex-col">
                    <div id="logo">
                        <a href="{{ url('/') }}">
                            <img class="logo-main" src="{{ asset('web/images/logo-white.webp')}}" alt="">
                            <img class="logo-scroll" src="{{ asset('web/images/logo-black.webp')}}" alt="">
                            <img class="logo-mobile" src="{{ asset('web/images/logo-white.webp')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="de-flex-col header-col-mid">
                    <ul id="mainmenu">
                        <li><a class="menu-item" href="{{ url('/') }}">Home</a></li>
                        <li><a class="menu-item" href="{{ url('/about') }}">About Us</a></li>
                        <li><a class="menu-item" href="{{ url('/plan') }}">Plan</a></li>
                        <li><a class="menu-item" href="{{ url('/presentation') }}">Presentation</a></li>
                        <li><a class="menu-item" href="{{ url('/team') }}">Team</a></li>
                        <li><a class="menu-item" href="{{ url('/faq') }}">FAQ</a></li>
                        <li><a class="menu-item" href="{{ url('/contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="de-flex-col">
                    <div class="menu_side_area">
                        <a href="{{ url('/login') }}" class="btn-line">Login</a>
                        <a href="{{ url('/sign-up') }}" class="btn-line">Register</a>
                        <span id="menu-btn"></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="section-dark">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4 col-sm-6">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('web/images/logo-white.webp')}}" alt="" class="foot-logo">
                    </a>
                    <div class="spacer-20"></div>
                    <p>Energeios is a futuristic platform revolutionizing the way people invest in green energy. We transform EV infrastructure into a global passive income opportunity by allowing individuals to invest in electric vehicle charging stations.</p>
                    <div class="social-icons mb-sm-30">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12 order-lg-1 order-sm-2">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="widget">
                                <h5>Company</h5>
                                <ul>
                                    <li><a class="menu-item" href="{{ url('/') }}">Home</a></li>
                                    <li><a class="menu-item" href="{{ url('/about') }}">About Us</a></li>
                                    <li><a class="menu-item" href="{{ url('/plan') }}">Plan</a></li>
                                    <li><a class="menu-item" href="{{ url('/presentation') }}">Presentation</a></li>
                                    <li><a class="menu-item" href="{{ url('/team') }}">Team</a></li>
                                    <li><a class="menu-item" href="{{ url('/faq') }}">FAQ</a></li>
                                    <li><a class="menu-item" href="{{ url('/contact') }}">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="widget">
                                <h5>Quick Links</h5>
                                <ul>
                                    <li><a href="{{ url('/privacy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ url('/terms') }}">Terms</a></li>
                                    <li><a href="{{ url('/anti-spam-policy') }}">Anti Spam Policy</a></li>
                                    <li><a href="{{ url('/disclaimer') }}">Disclaimer</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-sm-6 order-lg-2 order-sm-1">
                    <div class="widget">
                        <div class="text-white">
                            <i class="icofont-building-alt me-2 id-color"></i><storng class="fw-bold">COMPANY NAME : </storng> ENERGEIOS
                        </div>
                        <div class="text-white">
                            <i class="icofont-user-alt-3 me-2 id-color"></i><storng class="fw-bold"> CEO NAME : </storng> Rhona Lennox
                        </div>
                        <div class="text-white">
                            <i class="icofont-phone me-2 id-color"></i><storng class="fw-bold"> ADMINISTRATION NUMBER : </storng> <a href="tel:+447414217868" class="text-white">+44 7414 217868</a>
                        </div>
                        <div class="text-white">
                            <i class="icofont-location-pin me-2 id-color"></i><storng class="fw-bold"> COMPANY ADDRESS : </storng> 80 George Street, Edinburgh, Scotland, EH2 3BU
                        </div>
                        <div class="text-white">
                            <i class="icofont-verification-check me-2 id-color"></i><storng class="fw-bold"> VERIFICATION LINK : </storng> <a href="https://find-and-update.company-information.service.gov.uk/company/SC861016" target="_blank" class="text-white">
                            Click To Verify
                        </a>
                        </div>
                         <div class="spacer-20"></div>
                        <div class="fw-bold text-white">
                            <i class="icofont-envelope me-2 id-color"></i>
                            <a href="mailto:support@energeios.io" class="text-white">Send a Message</a>
                        </div>
                        support@energeios.io

                        <div class="spacer-20"></div>
                        <div class="fw-bold text-white">
                            <i class="icofont-brand-whatsapp me-2 id-color"></i>
                            <a href="https://wa.me/447414217868" target="_blank" class="text-white">Chat on WhatsApp</a>
                        </div>
                        +44 7414 217868
                    </div>
                </div>
            </div>
        </div>
        <div class="subfooter">
            <div class="container">
                <div class="de-flex">
                    <div class="de-flex-col">
                        Copyrights 2025 - Energeios |
                        Designed & Developed By Energeios
                    </div>
                    <ul class="menu-simple">
                        <li><a href="{{ url('/terms') }}">Terms & Conditions</a></li>
                        <li><a href="{{ url('/privacy') }}">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>

<div id="buy-now" class="show-on-scroll">
    <a class="btn-buy" href="{{ url('/sign-up') }}" target="_blank">Charge Now</a>
</div>

<!-- jQuery core -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Other plugins first -->
<script src="{{ asset('web/js/plugins.js')}}"></script>
<script src="{{ asset('web/js/designesia.js')}}"></script>
<script src="{{ asset('web/js/swiper.js')}}"></script>
<script src="{{ asset('web/js/custom-marquee.js')}}"></script>
<script src="{{ asset('web/js/custom-swiper-2.js')}}"></script>

<!-- NOW load validation last -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script>

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
  window.addEventListener("load", function () {
    const loader = document.getElementById("ev-loader");
    loader.style.opacity = "0";
    setTimeout(() => {
      loader.style.display = "none";
    }, 500); // fade-out duration
  });

</script>
</body>
</html>
