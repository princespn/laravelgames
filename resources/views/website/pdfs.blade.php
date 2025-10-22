<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Energeios FINANCIAL LTD - Energeios | Energeios FINANCIAL LTD</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ asset('web/images/favicon.ico')}}" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('web/css/bootstrap.min.css')}}">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="{{ asset('web/css/typography.css')}}">
      <!-- media element player -->
      <link rel="stylesheet" type="text/css" href="{{ asset('web/css/mediaelementplayer.min.css')}}" />
      <!-- style CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('web/css/style.css')}}?v={{ time() }}">
      <!-- Responsive CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('web/css/responsive.css')}}?v={{ time() }}">
      <!-- TrustBox script -->
      <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
      <!-- End TrustBox script -->
      <!-- Google tag (gtag.js) -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-13NJJDREPJ"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-13NJJDREPJ');
      </script>
      <style>
         #change {
         transition: transform 0.5s;
         display: inline-block;
         width: 200px;
         text-align: center;
         }


         .out {
           transform: scale(0);
         }
      </style>
   </head>
   <body data-spy="scroll" data-offset="10">
      <!-- loading -->
      <div id="loading">
         <div id="loading-center">
            <div class='loader loader2'>
               <div>
                  <div>
                     <div>
                        <div>
                           <div>
                              <div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- loading End -->
      <!-- Header -->
      <header>
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
                  <nav class="navbar navbar-expand-lg navbar-light">
                     <a class="navbar-brand" href="{{ url('/') }}">
                     <img src="{{ asset('web/images/logo-w.webp')}}" class="img-fluid" alt="">
                     </a>
                     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <i class="la la-bars"></i>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto w-100 justify-content-end">
                           <li class="nav-item">
                              <a class="nav-link active" href="{{ url('/') }}">Home</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ url('/') }}">About Us</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ url('/') }}">Plan</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ url('/') }}">Presentation</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ url('/') }}">Team</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ url('/') }}">FAQ</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ url('/') }}">Contact</a>
                          </li>
                        </ul>
                     </div>
                     <ul class="nav justify-content-end align-items-center">
                        <li class="nav-item dropdown">
                                 <div class="gtranslate_wrapper"></div>

                        </li>
                        <li class="nav-item iq-mlr-0">
                           <a class="button" href="{{ url('/login') }}">Login</a>
                           <a class="button" href="{{ url('/sign-up') }}">Register</a>
                        </li>
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
      </header>
      <!-- Header END -->
<!-- Main-Contain -->
<div class="main-contain">
<!-- Our Mission -->
<section class="overview-block-pb padding-60">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 align-self-center mt-5 mt-lg-0">
            <div class="heading-title center">
               <!-- <small class="iq-font-green">Energeios</small> -->
               <h2 class="">Presentations</h2>
               <p>Energeios PDF's</p>
            </div>
         </div>
      </div>
   </div>
</section>
<section  id="Presentation" class="overview-block-pb">
   <div class="container">
      <!--          <div class="row">
         <div class="col-sm-12">
            <div class="heading-title">
               <h2 class="title">Presentations</h2>
            </div>
         </div>
         </div> -->
      <div class="row mt-30 justify-content-center">
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">English PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld.pdf')}}">English PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <!--Next 19 starts here-->
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Arabic PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_arabic.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_arabic.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_arabic.pdf')}}">Arabic PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_arabic.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_arabic.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Bangla PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_bangla.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_bangla.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_bangla.pdf')}}">Bangla PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_bangla.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_bangla.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Chinese PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_chinese.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_chinese.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_chinese.pdf')}}">Chinese PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_chinese.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_chinese.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Dutch PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_dutch.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_dutch.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_dutch.pdf')}}">Dutch PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_dutch.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_dutch.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Filipino PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_filipino.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_filipino.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_filipino.pdf')}}">Filipino PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_filipino.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_filipino.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">French PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_french.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_french.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_french.pdf')}}">French PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_french.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_french.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">German PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_german.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_german.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_german.pdf')}}">German PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_german.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_german.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Hindi PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_hindi.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_hindi.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_hindi.pdf')}}">Hindi PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_hindi.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_hindi.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Indonesian PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_indonesian.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_indonesian.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_indonesian.pdf')}}">Indonesian PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_indonesian.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_indonesian.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Kannada PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_kannada.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_kannada.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_kannada.pdf')}}">Kannada PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_kannada.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_kannada.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Persian PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_persian.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_persian.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_persian.pdf')}}">Persian PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_persian.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_persian.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Portuguese PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_portuguese.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_portuguese.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_portuguese.pdf')}}">Portuguese PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_portuguese.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_portuguese.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Russian PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_russian.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_russian.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_russian.pdf')}}">Russian PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_russian.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_russian.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Spanish PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_spanish.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_spanish.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_spanish.pdf')}}">Spanish PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_spanish.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_spanish.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Swahili PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_swahili.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_swahili.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_swahili.pdf')}}">Swahili PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_swahili.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_swahili.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Tamil PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_tamil.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_tamil.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_tamil.pdf')}}">Tamil PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_tamil.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_tamil.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Thai PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_thai.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_thai.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_thai.pdf')}}">Thai PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_thai.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_thai.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Turkish PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_turkish.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_turkish.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_turkish.pdf')}}">Turkish PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_turkish.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_turkish.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Urdu PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_urdu.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_urdu.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_urdu.pdf')}}">Urdu PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_urdu.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_urdu.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 iq-mtb-15">
            <div class="iq-our-team-2 text-center">
               <div class="team-blog mb-30">
                  <div class="team-images"> 
                     <img src="{{ asset('web/images/pdf.webp')}}" class="img-fluid ob" alt="">
                  </div>
                  <div class="team-description">
                     <div class="mt-10 text-dark">Vietnamese PDF</div>
                  </div>
                  <div class="team-social">
                     <ul>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_vietnamese.pdf')}}" download> <i class="fa fa-download"></i> </a> </li>
                        <li> <a href="{{ asset('images/new/pdf/halvingworld_vietnamese.pdf')}}" target="_blank"> <i class="fa fa-eye"></i> </a> </li>
                     </ul>
                  </div>
               </div>
               <h6 class="iq-mt-10"><a href="{{ asset('images/new/pdf/halvingworld_vietnamese.pdf')}}">Vietnamese PDF</a></h6>
               <a href="{{ asset('images/new/pdf/halvingworld_vietnamese.pdf')}}" target="_blank">
               <span class="badge rounded-pill bg-warning text-dark">View</span>
               </a>
               <a href="{{ asset('images/new/pdf/halvingworld_vietnamese.pdf')}}" download >
               <span class="badge rounded-pill bg-success">Download</span>
               </a>
            </div>
         </div>
         <!--Next 11 ends here-->
      </div>
   </div>
</section>
<footer id="contact" class="iq-footer">
         <div class="footer-top iq-mtb-30">
            <div class="container">
               <div class="row">
                  <div class="col-lg-3 col-md-6 col-sm-12 mb-4 mb-lg-0">
                     <div class="logo">
                        <a href="{{ url('/') }}">
                        <img id="logo_img_2" class="img-fluid" src="{{ asset('web/images/logo-w.webp')}}" alt="">
                        </a>
                        <div class="text-white iq-mt-15 ">Welcome to Energeios—an exhilarating journey awaits! Join us as we delve into the transformative power of Bitcoin halving, reshaping the landscape of finance. Dive into our resources, connect with our vibrant community, and unearth the boundless opportunities that lie ahead in the realm of Energeios.
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-6 col-sm-12 mb-4 mb-lg-0 footer-menu">
                     <h5 class="small-title iq-tw-5 text-white">Menu</h5>
                     <ul class="iq-pl-0">
                        <li class="nav-item">
                              <a class="nav-link" href="{{ url('/') }}">Home</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ url('/') }}">About Us</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ url('/') }}">Plan</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ url('/') }}">Presentation</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ url('/') }}">Team</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ url('/') }}">FAQ</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ url('/') }}">Contact</a>
                          </li>
                           <li class="">
                              <a class="" href="{{ url('/privacy') }}">Privacy Policy</a>
                          </li>
                       <!--  <li>
                              <a class="" href="{{ url('/privacy') }}">Privacy Policy</a>
                     </li> -->
                     </ul>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 iq-contact mb-4 mb-lg-0">
                     <h5 class="small-title iq-tw-5 text-white">Contact Energeios</h5>
                     <div class="iq-mb-30">
                        <div class="blog">
                           <i class="ion-ios-telephone-outline"></i>
                           <div class="content ">
                              <div class="title ">Support Number</div>
                              <a href="https://wa.me/9293339296" target="_blank">+929 333 9296</a>
                           </div>
                        </div>
                     </div>
                     <div class="iq-mb-30">
                        <div class="blog ">
                           <i class="ion-ios-email-outline"></i>
                           <div class="content ">
                              <div class="title ">Mail</div>
                              <a href="mailto:support@energeios.io">support@energeios.io</a>
                           </div>
                        </div>
                     </div>
                     <div class="blog">
                        <i class="ion-ios-location-outline"></i>
                        <div class="content ">
                           <div class="title ">Address</div>
                           <a href="javascript:void(0)">
                              36 - 38 Cornhill, London, England, EC3V 3NG
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 mb-4 mb-lg-0">
                     <div class="call-back">
                        <h5 class="small-title iq-tw-5 text-white">Request a Call Back</h5>
                        <form id="emailForm">
                           <div class="form-group iq-mb-20">
                              <input type="text" class="form-control" id="exampleInputName" placeholder="Enter Name">
                           </div>
                           <div class="form-group iq-mb-20">
                              <input type="email" class="form-control" id="exampleInputEmail" placeholder="Email">
                           </div>
                           <div class="form-group iq-mb-20">
                              <input type="text" class="form-control" id="exampleInputPhone" placeholder="Phone Number">
                           </div>
                           <div class="form-group iq-mb-20">
                              <input type="text" class="form-control" id="exampleInputsubject" placeholder="Message">
                           </div>
                           <p style="color: red; display: none" id="emailError"></p>
                           <p style="color: green; display: none" id="emailSucess"></p>

                           {{-- <a class="button" href="javascript:sendMail()">Submit</a> --}}
                           <button class="button" type="submit">Submit</button>
                        </form>
                     </div>
                  </div>
                  <div class="col-lg-12 text-center mt-4">
                     <!-- TrustBox widget - Review Collector -->
                     <div class="trustpilot-widget" data-locale="en-GB" data-template-id="56278e9abfbbba0bdcd568bc" data-businessunit-id="663f59a9ab923937fdb81338" data-style-height="52px" data-style-width="100%">
                       <a href="https://uk.trustpilot.com/review/energeios.com" target="_blank" rel="noopener">Trustpilot</a>
                     </div>
                     <!-- End TrustBox widget -->
                  </div>
               </div>
            </div>
         </div>
         <div class="footer-bottom iq-ptb-20 ">
            <div class="container">
               <div class="row">
                  <div class="col-md-7 align-self-center">
                     <div class="iq-copyright text-white">
                        © Copyright <script>document.write(new Date().getFullYear())</script> Energeios . Made With ❤️ In <span id="job-title"></span>

                     </div>
                  </div>
                  <div class="col-md-5 ">
                     <ul class="iq-media-blog ">
                        <li><a href="https://www.facebook.com/halvingworld" class="fa fa-facebook" target="_blank"></a>
                        </li>
                        <li><a href="https://www.instagram.com/halving_world" class="fa fa-instagram" target="_blank"></a></li>
                        {{-- <li><a href="https://t.me/+hUjlQnSoTZFmNTQ0" class="fa fa-telegram" target="_blank"></a> </li> --}}
                        {{-- <li><a href="#" class="fa fa-twitter"></a> </li> --}}
                        
                        <li><a href="https://www.youtube.com/@HalvingWorld" class="fa fa-youtube" target="_blank"></a> </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>

      <div class="livechat">
         <a href="https://wa.me/9293339296" class="chatbtn" target="_blank">
         <img src="{{ asset('web/images/whatsapp.webp')}}" alt="">
         </a>
      </div>
      <div class="tele-livechat">
         <a href="https://t.me/+hUjlQnSoTZFmNTQ0" target="_blank">
         <img src="{{ asset('web/images/telegram.webp')}}" alt="">
         </a>
      </div>
      </footer>
      <!-- Token Sale Proceeds END -->
      <!-- back-to-top -->
      <div id="back-to-top">
         <a class="top" id="top" href="#top"><i class="fa fa-angle-double-up" aria-hidden="true"></i> </a>
      </div>
      <!-- back-to-top End -->
      <!-- bubbly -->
      <canvas id="canvas1"></canvas>
      <!-- bubbly End -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->

      <script src="{{ asset('web/js/jquery-min.js')}}"></script>
      <!-- popper JavaScript -->
      <script src="{{ asset('web/js/popper.min.js')}}"></script>
      <!-- Bootstrap JavaScript -->
      <script src="{{ asset('web/js/bootstrap.min.js')}}"></script>
      <!-- All-plugins JavaScript -->
      <script src="{{ asset('web/js/all-plugins.js')}}"></script>
      <!-- timeline JavaScript -->
      <script src="{{ asset('web/js/timeline.min.js')}}"></script>
      <!-- wave JavaScript -->
      <script src="{{ asset('web/js/wave/three.min.js')}}"></script>
      <script src="{{ asset('web/js/wave/Projector.js')}}"></script>
      <script src="{{ asset('web/js/wave/CanvasRenderer.js')}}"></script>
      <script src="{{ asset('web/js/wave/index.js')}}"></script>
      <!-- bubbly JavaScript -->
      <script src="{{ asset('web/js/bubbly-bg.js')}}"></script>
      <!-- amcharts -->
      <script src="{{ asset('web/js/amcharts/amcharts.js')}}"></script>
      <script src="{{ asset('web/js/amcharts/serial.js')}}"></script>
      <script src="{{ asset('web/js/amcharts/export.min.js')}}"></script>
      <script src="{{ asset('web/js/amcharts/none.js')}}"></script>
      <!-- carousel JavaScript -->
      <script src="{{ asset('web/js/owl.carousel.min.js')}}"></script>
      <!-- Custom JavaScript -->
      <script src="{{ asset('web/js/custom.js')}}"></script>
      <script type="text/javascript">
         let titles = ['USA', 'Germany', 'UAE', 'UK', 'Spain', 'Portugal', 'Turkey', 'Brazil', 'Japan', 'Italy', 'France', 'Indonesia', 'Singapore'];
         let currentIndex = 0;
         let aSpan = document.getElementById('job-title');
         setInterval(() => {
             aSpan.innerHTML = titles[currentIndex];
             currentIndex++;
             if (currentIndex === 13)
                 currentIndex = 0;
         }, 1500)
      </script>
      
      <!-- <script type="text/javascript">
         const navLinks = document.querySelectorAll('.nav-item')
         const menuToggle = document.getElementById('navbarSupportedContent')
         const bsCollapse = bootstrap.Collapse.getOrCreateInstance(menuToggle, {toggle: false})
         navLinks.forEach((l) => {
         l.addEventListener('click', () => { bsCollapse.toggle() })
         })

         document.addEventListener("DOMContentLoaded", function() {
          const navLinks = document.querySelectorAll('.nav-link');

          navLinks.forEach(link => {
              link.addEventListener('click', function(event) {
                  event.preventDefault();

                  const targetId = this.getAttribute('data-target');
                  const targetElement = document.getElementById(targetId);

                  if (targetElement) {
                      window.scrollTo({
                          top: targetElement.offsetTop,
                          behavior: 'smooth'
                      });
                  }
              });
          });
      });

      </script> -->

<script>window.gtranslateSettings = {"default_language":"en","languages":["en","fr","de","it","es","nl","fi","el","hi","ja","da","cs","hr","ko","zh-TW","no","lt"],"wrapper_selector":".gtranslate_wrapper","flag_style":"3d","alt_flags":{"en":"usa","pt":"brazil","es":"argentina"}}</script>
<script src="https://cdn.gtranslate.net/widgets/latest/popup.js" defer></script>


<script>


let temp;
   var form = document.getElementById('emailForm');

   form.addEventListener('submit', function(event) {
      event.preventDefault();
      var sucessElement = document.getElementById('emailSucess');
      var errorElement = document.getElementById('emailError');
      errorElement.style.display = 'none';
      sucessElement.style.display = 'none';
      
      var name = document.getElementById('exampleInputName');
      var email = document.getElementById('exampleInputEmail');
      var phone = document.getElementById('exampleInputPhone');
      var subject = document.getElementById('exampleInputsubject');

      if(!name.value || !email.value || !phone.value || !subject.value){
         errorElement.textContent = "All field are required";
         errorElement.style.display = 'block';
         return 
      }

      var formData = new FormData(form);
      fetch(`{{ route('send-callback-mail') }}`, {
         method: 'POST',
         headers: {
             'Content-Type': 'application/json',
             'Accept': 'application/json',
             'X-CSRF-TOKEN': `{{ csrf_token() }}`
         },
         body: JSON.stringify({
            "name":name.value,
            "phone":phone.value,
            "subject":subject.value,
            "email":email.value,
         }),
      })
      .then(response => {
          if (response.ok) {
               sucessElement.textContent = "Email sent, we will contact you soon.";
               sucessElement.style.display = 'block';
          }
      })
      
   });
</script>


   </body>
</html>
