@extends('layouts.user_type.auth-app')
@section('content')
<div class="page-wrapper">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="PageTitle">
               <h1>Projection</h1>
            </div>
         </div>
      </div>
      <div class="ProfileHeadBox">
         <div class="row z-index-999-relative">
            <div class="col-md-8 line-v-left-desk">
               <div class="PaymentInfoflexH">
                  <!-- <h3>Payment Info</h3> -->
                  <!-- <button class="btn loGbtn" data-bs-toggle="modal" data-bs-target="#editAddress">Edit Address</button> -->
               </div>
               <div class="row row-cols-1 row-cols-md-2 HeadButton">
                  <div class="col">
                     <button class="btn btn-primary">
                        <img src="images/timetable.png" / width="50">
                        <div class="BtnDiV">
                           Monthwise Growth
                           <span>Click Here</span>
                        </div>
                     </button>
                  </div>
                  <div class="col">
                     <button class="btn btn-info">
                        <img src="images/schedule.png" / width="50">
                        <div class="BtnDiV">
                           Last 7 days Growth
                            <span>Click Here</span>

                        </div>
                     </button>
                  </div>

           
               </div>
            </div>
            <!--    <div class="col-md-12">
               <a href="" class="btn loGbtn">Monthwise Growth</a>
               <a href="" class="btn loGbtn">Last 7 days Growth</a>
               </div> -->
         </div>
      </div>
   </div>
   <!-- model for change password  -->
</div>
@endsection