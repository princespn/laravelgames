@extends('layouts.user_type.website')
@section('content')
<!-- content begin -->
<div class="no-bottom no-top" id="content">
   <div id="top"></div>
   <section class="pt10 pb10 mt80 bg-grey">
      <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center">
               <h3 class="mb-0">Team </h3>
            </div>
         </div>
      </div>
   </section>
   <section class="jarallax">
      <img src="{{ asset('web/images/background/gradient-2.webp')}}" class="jarallax-img" alt="">
      <div class="container">
         <div class="row g-4 gx-5">
            <div class="col-lg-6">
               <div class="subtitle ow fadeInUp mb-3">Behind the Scene</div>
               <h2 class="wow fadeInUp mb-0" data-wow-delay=".2s">Our Team</h2>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-3 col-sm-6">
               <div class="relative">
                  <img src="{{ asset('web/images/team/1.webp')}}" class="img-fluid rounded-10px" alt="">
                  <div class="p-3 text-center
                     ">
                     <h4 class="mb-0">OMKAR ATWAL</h4>
                     <p class="mb-2">Founder | Visionary Leader | EV Finance Pioneer</p>
                     <div class="social-icons">
                        <a href="#"><i class="bg-color text-white bg-hover-2 text-hover-white fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="bg-color text-white bg-hover-2 text-hover-white fa-brands fa-x-twitter"></i></a>
                        <a href="#"><i class="bg-color text-white bg-hover-2 text-hover-white fa-brands fa-instagram"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-sm-6">
               <div class="relative">
                  <img src="{{ asset('web/images/team/2.webp')}}" class="img-fluid rounded-10px" alt="">
                  <div class="p-3 text-center
                     ">
                     <h4 class="mb-0">Olivia Grace Parker</h4>
                     <p class="mb-2">Founder &amp;  CEO</p>
                     <div class="social-icons">
                        <a href="#"><i class="bg-color text-white bg-hover-2 text-hover-white fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="bg-color text-white bg-hover-2 text-hover-white fa-brands fa-x-twitter"></i></a>
                        <a href="#"><i class="bg-color text-white bg-hover-2 text-hover-white fa-brands fa-instagram"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-sm-6">
               <div class="relative">
                  <img src="{{ asset('web/images/team/3.webp')}}" class="img-fluid rounded-10px" alt="">
                  <div class="p-3 text-center
                     ">
                     <h4 class="mb-0">Jacob Williams</h4>
                     <p class="mb-2">Founder &amp;  CEO</p>
                     <div class="social-icons">
                        <a href="#"><i class="bg-color text-white bg-hover-2 text-hover-white fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="bg-color text-white bg-hover-2 text-hover-white fa-brands fa-x-twitter"></i></a>
                        <a href="#"><i class="bg-color text-white bg-hover-2 text-hover-white fa-brands fa-instagram"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-sm-6">
               <div class="relative">
                  <img src="{{ asset('web/images/team/4.webp')}}" class="img-fluid rounded-10px" alt="">
                  <div class="p-3 text-center
                     ">
                     <h4 class="mb-0">Ethan Johnson</h4>
                     <p class="mb-2">Founder &amp;  CEO</p>
                     <div class="social-icons">
                        <a href="#"><i class="bg-color text-white bg-hover-2 text-hover-white fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="bg-color text-white bg-hover-2 text-hover-white fa-brands fa-x-twitter"></i></a>
                        <a href="#"><i class="bg-color text-white bg-hover-2 text-hover-white fa-brands fa-instagram"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<!-- content close -->
@endsection