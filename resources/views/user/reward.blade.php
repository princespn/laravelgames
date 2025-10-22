@extends('layouts.user_type.auth-app')
@section('content')
{{--print_r($data)--}}
<div class="page-wrapper">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <nav aria-label="breadcrumb ms-3">
               <h6 class="font-weight-bolder mb-0">Ranks and Rewards</h6>
            </nav>
         </div>
      </div>
      <div class="container">
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header pb-0">
                  <!-- <h2><b>Binary Points </h2> -->
               </div>
               <div class="card-body">
                  <h3><b>Binary points Remaining</b>:  <b>{{ $data['currentrank_target_remain'] }}</b> to achieve the next rank</h3>
               </div>
            </div>
            <div class="card">
             <!--   <div class="card-header pb-0">
                  <h2>Ranks and Rewards</h2>
               </div> -->
               <div class="card-body">
                  <div class="row">
                     @foreach ($data['allranks'] as $item)
                     <div class="col-md-4 col-sm-6">
                        <h3 class="mh1">Earn ${{$item->binary_income_required}} as binary income</h3>
                        <div class="box">
                           <img src="images/award/reward1.png">
                           <div class="box-content">
                              <h3 class="title">{{$item->rank_name}}</h3>
                              <!-- <span class="post">Web designer</span> -->
                              <span class="post">${{$item->reward_points}}</span>
                              <span class="post">or</span>
                              <span class="post">{{$item->reward_gift}}</span>
                           </div>
                           <!--   <ul class="icon">
                              <li><a href="#"><i class="fa fa-search"></i></a></li>
                              <li><a href="#"><i class="fa fa-link"></i></a></li>
                              </ul> -->
                        </div>
                        @if(sizeof($item->myrankstatus) > 0)
                        @php $datetime = new DateTime($item->myrankstatus[0]->created_at); @endphp
                        <p class="txt-g">Achieved On {{ $datetime->format("Y-m-d") }}</p>
                        @else
                        <p class="txt-r">Locked</p>
                        @endif
                     </div>
                     @endforeach
                  </div>
       <!--            <div class="row" style="display: none;">
                     @foreach ($data['allranks'] as $item)
                     <div class="col-md-4">
                        <div class="outer text-center">
                           <h3>Earn {{$item->binary_income_required}} as binary income</h3>
                           <div class="box-reward">
                              <h1 class="heads">{{$item->rank_name}}</h1>
                              <p>{{$item->reward_points}}</p>
                              <p>or</p>
                              <p>{{$item->reward_gift}}</p>
                           </div>
                           @if(sizeof($item->myrankstatus) > 0)
                           @php $datetime = new DateTime($item->myrankstatus[0]->created_at); @endphp
                           <p>Achieved On {{ $datetime->format("Y-m-d") }}</p>
                           @else
                           <p>Locked</p>
                           @endif
                        </div>
                     </div>
                     @endforeach
                  </div> -->
                  <table class="table table-bordered" style="display:none;">
                     <thead>
                        <tr class="bg-gradient-primary text-center">
                           <th scope="col">Condition</th>
                           <th scope="col">Rank</th>
                           <th scope="col">Reward</th>
                           <th scope="col">Status</th>
                           <th scope="col">Date </th>
                        </tr>
                     </thead>
                     <tbody class="text-center">
                        <tr>
                           <td>Earn $2000 as binary income</td>
                           <td>HSCC Newbie</td>
                           <td>$400 or JBL Partybox 110</td>
                           <td><b class="text-success">Achieved</b> </td>
                           <td>22/05/2023</td>
                        </tr>
                        <tr>
                           <td>Earn $3500 as binary income</td>
                           <td>HSCC Explorer</td>
                           <td>$875 or Balenciaga (Logo-Engraved Gold-Tone Bracelet)</td>
                           <td><b class="text-danger">Not Achieved</b> </td>
                           <td>22/05/2023</td>
                        </tr>
                        <tr>
                           <td>Earn $5000 as binary income</td>
                           <td>HSCC Enthusiast</td>
                           <td>$1500 or iPhone 14 Max Pro</td>
                           <td><b class="text-danger">Not Achieved</b> </td>
                           <td>22/05/2023</td>
                        </tr>
                        <tr>
                           <td>Earn $7500 as binary income</td>
                           <td>HSCC Contributor</td>
                           <td>$2625 or Hermes Silver Collier de Chien MM Bracelet</td>
                           <td><b class="text-danger">Not Achieved</b> </td>
                           <td>22/05/2023</td>
                        </tr>
                        <tr>
                           <td>Earn $10000 as binary income</td>
                           <td>HSCC Specialist</td>
                           <td>$4000 or Ralph Lauren Home Sutton 5-In-1 Game</td>
                           <td><b class="text-danger">Not Achieved</b> </td>
                           <td>22/05/2023</td>
                        </tr>
                        <tr>
                           <td>Earn $25000 as binary income</td>
                           <td>HSCC Supervisor</td>
                           <td>$10000 or Sponsored Global Office </td>
                           <td><b class="text-danger">Not Achieved</b> </td>
                           <td>22/05/2023</td>
                        </tr>
                        <tr>
                           <td>Earn $50000 as binary income</td>
                           <td>HSCC Senator</td>
                           <td>$22000 or Rolex Submariner</td>
                           <td><b class="text-danger">Not Achieved</b> </td>
                           <td>22/05/2023</td>
                        </tr>
                        <tr>
                           <td>Earn $100000 as binary income</td>
                           <td>HSCC Mentor</td>
                           <td>$50000 or Kawasaki Ninja H2R</td>
                           <td><b class="text-danger">Not Achieved</b> </td>
                           <td>22/05/2023</td>
                        </tr>
                        <tr>
                           <td>Earn $250000 as binary income</td>
                           <td>HSCC Royal Mentor</td>
                           <td>$125,000 or VIP Trip to Dubai (4 Members)</td>
                           <td><b class="text-danger">Not Achieved</b> </td>
                           <td>22/05/2023</td>
                        </tr>
                        <tr>
                           <td>Earn $500000 as binary income</td>
                           <td>HSCC Master</td>
                           <td>$300,000 or 180 Days Around the World Cruise Trip (6 Members)</td>
                           <td><b class="text-danger">Not Achieved</b> </td>
                           <td>22/05/2023</td>
                        </tr>
                        <tr>
                           <td>Earn $1 Million as binary income</td>
                           <td>HSCC Grand Master</td>
                           <td>$650,000 or Lamborghini Revuelto</td>
                           <td><b class="text-danger">Not Achieved</b> </td>
                           <td>22/05/2023</td>
                        </tr>
                        <tr>
                           <td>Earn $5 Million as binary income</td>
                           <td>HSCC Champion</td>
                           <td>$3.75 Million or Mansion At Beverly Hills</td>
                           <td><b class="text-danger">Not Achieved</b> </td>
                           <td>22/05/2023</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection