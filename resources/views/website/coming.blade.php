@extends('layouts.user_type.website')
@section('content')
<!-- ===============//breatcome area start here \\================= -->
<div class="clearfix" style="clear: both;"></div>
<div class="breatcome-area d-flex align-items-center">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="breatcome-content text-center">
               <div class="breatcome-title">
                  <h1>Launching Soon</h1>
               </div>
               <div class="breatcome-text">
                  <a href="about.php"><span>Home</span>Launching Soon</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="clearfix" style="clear: both;"></div>
<!-- ===============//breatcome section end here \\================= -->
<!--==================================================-->
<!-- Start cryptobit about Area -->
<!--==================================================-->
<!-- <div class="about-area pt-5">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-5 col-md-5 col-sm-12">
            <div class="dreamit-about-thumb">
               <img src="{{ asset('website/images/predict.png') }}" alt="" class="img-fluid">
            </div>
         </div>
         <div class="col-lg-7 col-md-7 col-sm-12">
            <div class="dreamit-section-title pb-5">
               <h1 class="section-title">Color
Prediction Game</h1>
            </div>
         </div>
      </div>
   </div>
</div> -->
<div class="about-area pb-5">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="dreamit-section-title pb-5">
               <h1 class="section-title">Color
Prediction Game</h1>
            </div>
         </div>
         <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="dreamit-about-thumb">
               <img src="{{ asset('website/images/launches.webp') }}" alt="" class="img-fluid">
            </div>
         </div>
             <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="dreamit-section-title pb-5">
               <h1 class="section-title">Roulette Game</h1>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection