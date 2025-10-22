@extends('layouts.user_type.website')
@section('content')

<!-- content begin -->
<div class="no-bottom no-top" id="content">
   <div id="top"></div>
   <section class="pt10 pb10 mt80 bg-grey">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-12 text-center">
               <h3 class="mb-0">About Us </h3>
            </div>
         </div>
      </div>
   </section>
   <section>
      <div class="container">
         <div class="row g-4 gx-5">
            <div class="col-lg-6">
               <div class="position-relative p-4">
                  <div class="bg-color text-light text-center w-30 p-3 rounded-10px position-absolute top-20 end-0 z-index-2 wow zoomIn" data-wow-delay=".0s">
                     <i class="icofont-bulb-alt fs-48"></i>
                     <h5 class="">Innovation</h5>
                  </div>
                  <img src="{{ asset('web/images/misc/15.webp')}}" class="img-fluid rounded-20px position-relative z-index-1 wow fadeInRight" alt="">
                  <div class="position-absolute bg-color-2 w-90 h-80 bg-color p-3 bottom-0 start-10 rounded-20px wow fadeInLeft"></div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="subtitle wow fadeInUp mb-3">Who We Are</div>
               <h2>⚡ About  <span class="id-color">ENERGEIOS</span></h2>
               <p class="lead fw-bold">Energeios is a futuristic platform revolutionizing the EV ecosystem by turning electric vehicle infrastructure into a powerful passive income opportunity. </p>
               <p>We empower individuals to invest in EV charging stations — allowing them to earn sustainable daily PRI, all while contributing to a greener tomorrow.</p>
               <ul style="list-style-type: none;">
                  <li>🌱 <strong>Powered by clean energy</strong></li>
                  <li>🔗 <strong>Secured by blockchain technology</strong></li>
                  <li>💸 <strong>Designed for financial freedom</strong></li>
               </ul>
               <p>Join the movement where <strong>innovation meets impact</strong> — with <strong>Energeios</strong>, your future is charged.</p>
            </div>
         </div>
      </div>
   </section>
   <section class="jarallax text-light pt30 pb30">
      <img src="{{ asset('web/images/background/gradient-3.webp')}}" class="jarallax-img" alt="">
      <div class="wow fadeInRight d-flex">
         <div class="de-marquee-list wow">
            <div class="d-item">
               <span class="d-item-txt">Clean Energy</span>
               <span class="d-item-display">
               <i class="d-item-block"></i>
               </span>
               <span class="d-item-txt">Our Vision</span>
               <span class="d-item-display">
               <i class="d-item-block"></i>
               </span>
               <span class="d-item-txt">Blockchain Trust</span>
               <span class="d-item-display">
               <i class="d-item-block"></i>
               </span>
               <span class="d-item-txt">Daily PRI</span>
               <span class="d-item-display">
               <i class="d-item-block"></i>
               </span>
               <span class="d-item-txt">EV Revolution</span>
               <span class="d-item-display">
               <i class="d-item-block"></i>
               </span>
               <span class="d-item-txt">Sustainable Future</span>
               <span class="d-item-display">
               <i class="d-item-block"></i>
               </span>
               <span class="d-item-txt">Our Mission</span>
               <span class="d-item-display">
               <i class="d-item-block"></i>
               </span>
               <span class="d-item-txt">Green Mobility</span>
               <span class="d-item-display">
               <i class="d-item-block"></i>
               </span>
            </div>
         </div>
      </div>
   </section>
   <section class="jarallax">
      <img src="{{ asset('web/images/background/gradient-2.webp')}}" class="jarallax-img" alt="">
      <div class="container">
         <div class="row g-4 gx-5">
            <div class="col-lg-4">
               <div class="subtitle bg-white text-dark wow fadeInUp mb-3">Vision &amp; Mission</div>
               <h2>Empowering a Greener, Smarter Future</h2>
               <img src="{{ asset('web/images/misc/17.webp')}}" class="img-fluid" alt="Energeios Vision">
            </div>
            <div class="col-lg-8">
               <h4 class="mb-4 wow fadeInRight">Our Vision</h4>
               <p class="lead wow fadeInUp">
                  To build a cleaner and more sustainable tomorrow by enabling global citizens to participate in the EV revolution while earning passive income through smart, green investments.
               </p>
               <div class="spacer-single"></div>
               <h4 class="mb-4 wow fadeInRight">Our Mission</h4>
               <ol class="ol-style-1">
                  <li class="wow fadeInUp" data-wow-delay=".2s">
                     <span class="fw-bold id-color">Green Investment:</span>
                     Empower individuals to invest in EV charging infrastructure with ease and transparency.
                  </li>
                  <li class="wow fadeInUp" data-wow-delay=".4s">
                     <span class="fw-bold id-color">Passive Income:</span>
                     Provide consistent daily PRI to users through blockchain-powered, real-time earning mechanisms.
                  </li>
                  <li class="wow fadeInUp" data-wow-delay=".6s">
                     <span class="fw-bold id-color">Clean Energy:</span>
                     Promote sustainable energy usage by developing and expanding electric vehicle charging networks.
                  </li>
                  <li class="wow fadeInUp" data-wow-delay=".8s">
                     <span class="fw-bold id-color">Trust & Transparency:</span>
                     Leverage blockchain logic to ensure secure, reliable, and tamper-proof financial records.
                  </li>
               </ol>
            </div>
         </div>
      </div>
   </section>
   <section>
      <div class="container">
         <div class="row g-4 gx-5">
            <div class="col-lg-6">
               <div class="subtitle wow fadeInUp mb-3">Core Values</div>
               <h2>Powered by <span class="id-color">Tomorrow</span></h2>
               <p class="lead fw-bold">Energeios is shaping the future of clean transportation and digital income, offering a seamless combination of electric mobility and blockchain transparency.</p>
               <p>We believe in creating a greener planet while empowering individuals with smart earning opportunities—bridging innovation, sustainability, and financial growth.</p>
               <div class="d-flex">
                  <ul class="ul-style-2">
                     <li>Eco-Friendly Impact</li>
                     <li>Transparent Earnings</li>
                     <li>Decentralized Control</li>
                  </ul>
                  <ul class="ul-style-2 ml-30">
                     <li>Smart Charging Infrastructure</li>
                     <li>Reliable Daily PRI</li>
                     <li>Blockchain-Powered Trust</li>
                  </ul>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="position-relative p-4">
                  <div class="bg-color text-light text-center w-30 p-3 rounded-10px position-absolute top-20 start-0 z-index-2 wow zoomIn" data-wow-delay=".0s">
                     <i class="icofont-bulb-alt fs-48"></i>
                     <h5 class="">Innovation</h5>
                  </div>
                  <img src="{{ asset('web/images/misc/16.webp')}}" class="img-fluid rounded-20px position-relative z-index-1 wow fadeInLeft" alt="">
                  <div class="position-absolute bg-color-2 w-90 h-80 bg-color p-3 bottom-0 end-10 rounded-20px wow fadeInRight"></div>
               </div>
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
                     <h4 class="mb-0">Jeffery Mussman</h4>
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
   <section class="pt60 pb60">
      <div class="container">
         <div class="row g-4">
            <div class="col-md-3 col-sm-6 mb-sm-30">
               <div class="de_count pl-50 fs-15 text-center wow fadeInRight" data-wow-delay=".0s">
                  <h3 class="fs-40"><span class="timer fs-40" data-to="28950" data-speed="3000">0</span>+</h3>
                  Happy Customers
               </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-sm-30">
               <div class="de_count pl-50 fs-15 text-center wow fadeInRight" data-wow-delay=".2s">
                  <h3 class="fs-40"><span class="timer fs-40" data-to="240" data-speed="3000">0</span>+</h3>
                  Charger Stations
               </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-sm-30">
               <div class="de_count pl-50 fs-15 text-center wow fadeInRight" data-wow-delay=".4s">
                  <h3 class="fs-40"><span class="timer fs-40" data-to="158" data-speed="3000">0</span>+</h3>
                  Skilled Technicians
               </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-sm-30">
               <div class="de_count pl-50 fs-15 text-center wow fadeInRight" data-wow-delay=".6s">
                  <h3 class="fs-40"><span class="timer fs-40" data-to="20" data-speed="3000">0</span>+</h3>
                  Countries
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<!-- content close -->

@endsection
