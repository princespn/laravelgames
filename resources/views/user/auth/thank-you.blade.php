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
               <h3 class="mb-0">Registration Success In Energeios </h3>
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
                     <h3 class="title text-white">Hello, Big Congratulations !</h3>
                     <div class="p-2">
                        <form class="theme-form">
                           <h4 class="text-white mb-10">Registration Successful!</h4>
                           <br>                          
                           <h3 class="text-white mb-10">Dear User,</h3>
                           <h6 class="text-white mb-10">Your Registration is successful on <?php echo date('d-m-Y', time()); ?></h6>
                           <h6 class="text-white mb-10">You can Login to your account using below credentials :</h6>
                           <div class="form-group mt-4">
                              <h6 class="text-white">User Name: <b>{{$user_id}}</b> </h6>
                           </div>
                           <div class="form-group">
                              <h6 class="text-white">Password:  <b>{{$password}}</b> </h6>
                           </div>
                           <h6 class="mt-4 text-white"> Do not share your Login details with anyone</h6>
                           <div class="social mt-4">
                              <div class="btn-showcase">
                              </div>
                           </div>
                           <p class="mt-4 mb-0">You can Login here:<a class="ms-2" href="{{ url('/login') }}">Login Now</a></p>
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
      <div class="col-xl-6 b-center bg-size" style="background-image: url(./images/2.jpg); background-size: cover; background-position: center center; display: block;">
         <img class="bg-img-cover bg-center" src="./Mofi - Premium Admin Template_files/2.jpg" alt="looginpage" style="display: none;">
      </div>
      <div class="col-xl-6 p-0">
         <div class="login-card login-dark">
            <div>
               <div class="text-center">
                  <a class="logo text-center ps-0" href="https://energeios.com/">
                  <img class="img-fluid logs" src="{{ asset('images/logo_admin.png')}}" alt="" width="250"></a>
               </div>
               <div class="login-main">
                  <form class="theme-form">
                     <h1 class="text-white mb-10">Registration Successful!</h1>
                     <br>                          
                     <h3 class="text-white mb-10">Dear User,</h3>
                     <h3>Your Registration is successful on <?php echo date('d-m-Y', time()); ?></h3>
                     <h3>You can Login to your account <br> using below credentials :</h3>
                     <div class="form-group mt-4">
                        <h5>User Name: <b>{{$user_id}}</b> </h5>
                     </div>
                     <div class="form-group">
                        <h5>Password:  <b>{{$password}}</b> </h5>
                     </div>
                     <h6 class="mt-4"> Do not share your Login details with anyone</h6>
                     <div class="social mt-4">
                        <div class="btn-showcase">
                        </div>
                     </div>
                     <p class="mt-4 mb-0">You can Login here:<a class="ms-2" href="{{ url('/login') }}">Login Now</a></p>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
