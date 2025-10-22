@extends('layouts.user_type.auth-app')
@section('content')
    @php
        date_default_timezone_set('Europe/London');
        $date = time();
        $getNavData = getUserDashboardDynamicData();
        $withdrawDate = $getNavData['project_withdraw_date'];

        $totalincomev = $arrData['total_income'] + $arrData['roi_income'];
        $walletbalance = ($arrData['working_wallet'] - $arrData['working_wallet_withdraw']) + ($arrData['roi_wallet'] - $arrData['roi_wallet_withdraw']);
    @endphp

    <style>
        .page-wrapper>.container-fluid,
        .page-wrapper>.container-lg,
        .page-wrapper>.container-md,
        .page-wrapper>.container-sm,
        .page-wrapper>.container-xl,
        .page-wrapper>.container-xxl {
            min-height: 0px;
        }
   </style>

   <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Home</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">
                        <svg class="stroke-icon">
                          <use href="{{ asset('svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Station</li>
                    <li class="breadcrumb-item active">Home</li>
                  </ol>
                </div>
              </div>
            </div>
            <div class="row mb-5 progresSec d-none">
              <div class="col-md-12">
                  <i class="fa fa-3x fa-battery-full iconpro"></i>
                  <div class="progress2 progress-moved">
                  <div class="progress-bar2"></div>
                  <div class="loader" style="--n: 1; --f: 0;"></div>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-sm-12">
    <div class="card o-hidden small-widget">
      <div class="card-body total-project border-b-info border-2">
        <span class="f-light f-w-500 f-14">Server Time</span>
        <div class="project-details">
          <div class="project-counter">
            <h2 class="f-w-600 text-primary" id="server-time"
                data-time="{{ date('Y-m-d H:i:s', $date) }}" 
                data-offset="+1">
            </h2>
          </div>
          <div class="product-sub bg-info-light">
            <i class="icofont icofont-clock-time"></i>
          </div>
        </div>
        <ul class="bubbles">
          <li class="bubble"></li>
          <li class="bubble"></li>
          <li class="bubble"></li>
          <li class="bubble"></li>
          <li class="bubble"></li>
          <li class="bubble"></li>
          <li class="bubble"></li>
          <li class="bubble"></li>
          <li class="bubble"></li>
        </ul>
      </div>
    </div>
  </div>
</div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
                  <div class="col-xl-4 col-sm-6">
                    <div class="card o-hidden small-widget">
                      <div class="card-body total-project border-b-primary border-2"><span class="f-light f-w-500 f-14">Next Rank</span>
                        <div class="project-details">
                          <div class="project-counter">
                            <h2 class="f-w-600">{{ $arrData['nextrankname'] }}</h2>
                          </div>
                          <div class="product-sub bg-primary-light">
                            <i class="icofont icofont-star-shape"></i>
                          </div>
                        </div>
                        <ul class="bubbles">
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-sm-6">
                    <div class="card o-hidden small-widget">
                      <div class="card-body total-Progress border-b-warning border-2"> <span class="f-light f-w-500 f-14">Required (Left)</span>
                        <div class="project-details">
                          <div class="project-counter">
                            <h2 class="f-w-600">
                              @if($arrData['nextrankname'] == "Prime")
                                 @if($arrData['nextrankprimel'] < 0)
                                    0 Station
                                 @else
                                    {{ $arrData['nextrankprimel'] }} Station
                                 @endif
                              @else
                                 @if($arrData['nextrankprimel'] < 0)
                                    0 Prime
                                 @else
                                    {{ $arrData['nextrankprimel'] }} Prime
                                 @endif
                              @endif
                           </h2>
                          </div>
                          <div class="product-sub bg-warning-light">
                            <i class="icofont icofont-businessman"></i>
                          </div>
                        </div>
                        <ul class="bubbles">
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-sm-6">
                    <div class="card o-hidden small-widget">
                      <div class="card-body total-Complete border-b-secondary border-2"><span class="f-light f-w-500 f-14"> Required (Right)</span>
                        <div class="project-details">
                          <div class="project-counter">
                            <h2 class="f-w-600">
                              @if($arrData['nextrankname'] == "Prime")
                                 @if($arrData['nextrankprimer'] < 0)
                                    0 Station
                                 @else
                                    {{ $arrData['nextrankprimer'] }} Station
                                 @endif
                              @else
                                 @if($arrData['nextrankprimer'] < 0)
                                    0 Prime
                                 @else
                                    {{ $arrData['nextrankprimer'] }} Prime
                                 @endif
                              @endif
                            </h2>
                          </div>
                          <div class="product-sub bg-secondary-light">
                            <i class="icofont icofont-businessman"></i>
                          </div>
                        </div>
                        <ul class="bubbles">
                          <li class="bubble"> </li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"> </li>
                          <li class="bubble"></li>
                          <li class="bubble"> </li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"> </li>
                        </ul>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="row size-column">
              <div class="col-xl-4 col-sm-6">
                <div class="card-header card-no-border total-revenue mb-2">
                  {{-- <h4>Earning Details</h4> --}}
                </div>
                <div class="card product-widget">
                    <div class="card-body new-product">
                      <div class="product-cost">
                        <div class="add-product">
                          <div class="product-icon bg-light-primary">
                            <svg>
                              <use href="{{ asset('svg/icon-sprite.svg#cart')}}"></use>
                            </svg>
                          </div>
                          <div>
                            <h6 class="mb-1">Direct Income</h6><span class="f-light">{{ custom_round($arrData['direct_income'], 2) }}</span>
                          </div>
                        </div>
                        <div class="product-icon">
                          <a href="matching-earning-report">
                            <svg>
                              <use href="{{ asset('svg/icon-sprite.svg#arrow-down')}}"></use>
                            </svg>
                          </a>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="card product-widget">
                    <div class="card-body new-product">
                      <div class="product-cost">
                        <div class="add-product">
                          <div class="product-icon bg-light-primary">
                            <svg>
                              <use href="{{ asset('svg/icon-sprite.svg#income')}}"></use>
                            </svg>
                          </div>
                          <div>
                            <h6 class="mb-1">PRI Income</h6><span class="f-light"><?php  $rates = ($arrData['roi_income']);
                                 echo custom_round($rates, 2);
                                 ?></span>
                          </div>
                        </div>
                        <div class="product-icon">
                          <a href="roi-earning">
                            <svg>
                              <use href="{{ asset('svg/icon-sprite.svg#arrow-down')}}"></use>
                            </svg>
                          </a>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="card product-widget">
                    <div class="card-body new-product">
                      <div class="product-cost">
                        <div class="add-product">
                          <div class="product-icon bg-light-primary">
                            <svg>
                              <use href="{{ asset('svg/icon-sprite.svg#expense')}}"></use>
                            </svg>
                          </div>
                          <div>
                            <h6 class="mb-1">Matching Income</h6><span class="f-light">{{ custom_round($arrData['binary_income'], 2) }}</span>
                          </div>
                        </div>
                        <div class="product-icon">
                          <a href="matching-earning-report">
                            <svg>
                              <use href="{{ asset('svg/icon-sprite.svg#arrow-down')}}"></use>
                            </svg>
                          </a>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-xl-4 col-sm-6">
                    <div class="card">
                      <div class="card-header card-no-border total-revenue pb-0">
                        <h4>Income Status Details</h4>
                      </div>
                      <div class="card-body">
                        <ul class="product-costing">
                          <li class="product-cost">
                            <div class="product-icon bg-primary-light">
                              <svg>
                                <use href="{{ asset('svg/icon-sprite.svg#activity')}}"></use>
                              </svg>
                            </div>
                            <div><span class="f-w-500 f-14 mb-0">Total Income</span>

                              <h2 class="f-w-600 f-18">{{ number_format(round($totalincomev, 2), 2)}}</h2>
                            </div>
                          </li>
                        </ul>
                        <ul class="product-costing">
                          <li class="product-cost">
                            <div class="product-icon bg-warning-light">
                              <svg>
                                <use href="{{ asset('svg/icon-sprite.svg#people')}}"></use>
                              </svg>
                            </div>
                            <div><span class="f-w-500 f-14 mb-0">Total Withdrawal</span>
                              <h2 class="f-w-600 f-18">{{number_format(round($arrData['total_withdraw_amount'], 2), 2)}}</h2>
                            </div>
                          </li>

                        </ul>
                        <ul class="product-costing">
                          <li class="product-cost">
                            <div class="product-icon bg-light">
                              <svg>
                                <use href="{{ asset('svg/icon-sprite.svg#task-square')}}"></use>
                              </svg>
                            </div>
                            <div><span class="f-w-500 f-14 mb-0">Total Team Business</span>
                              <h2 class="f-w-600 f-18">{{number_format(round($arrData['total_team_business'], 2), 2)}}</h2>
                            </div>
                          </li>
                        </ul>
                        <ul class="product-costing">
                          <li class="product-cost">
                            <div class="product-icon bg-light">
                              <svg>
                                <use href="{{ asset('svg/icon-sprite.svg#money-recive')}}"></use>
                              </svg>
                            </div>
                            <div><span class="f-w-500 f-14 mb-0">Current Team Business</span>
                              <h2 class="f-w-600 f-18">{{number_format(round($arrData['current_team_business'], 2), 2)}}</h2>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
              <div class="col-xl-4 col-md-6 box-col-none">
                <div class="row">
                  <div class="col-md-12 col-sm-6">
                    <div class="card boost-up-card overflow-hidden mb-0" style="border-radius: 8px 8px 0 0;">
                      <div class="p-4 pt-3">
                        <div class="boostup-name row">
                          <h6 class="text-white f-20 f-w-600 mb-2 z-1 ">Station Ranks</h6>
                        </div>
                        <div class="img-boostup">
                          <img class="img-boostup-img-1" src="{{ asset('images/dashboard-3/boostup1.png')}}" alt="bostup">
                          <img class="img-boostup-img-2" src="{{ asset('images/dashboard-3/boostup2.png')}}" alt="boostup">
                        </div>
                        <div class="btn-showcase text-start p-relative mb-1">
                          <a href="javascript:void(0)">
                            <button class=" w-100 btn btn-pill btn-outline-light-2x b-r-8" type="button" onclick="myFunctionRefLeft()">Left Invite Link</button>
                          </a>
                        </div>
                        <div class="btn-showcase text-start p-relative">
                          <a href="javascript:void(0)">
                            <button class=" w-100 btn btn-pill btn-outline-light-2x b-r-8" type="button" onclick="myFunctionRefRight()">Right Invite Link</button>
                          </a>
                        </div>
                        <input type="hidden"  id="referral-left" value="{{ url('/sign-up?ref_id=' . Auth::user()->user_id) }}&position=1">
                        <input type="hidden"  id="myRightInput" value="{{ url('/sign-up?ref_id=' . Auth::user()->user_id) }}&position=2">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-6">
                    <div class="card" style="border-radius: 0 0 8px 8px;">
                      <div class="card-body pt-0">
                        <div class="table-responsive custom-scrollbar deliveries-percentage">
                          <table class="percentage-data w-100">
                            <thead>
                              <!-- <tr>
                                <th class="f-light f-12 f-w-500" scope="col">Particular</th>
                                <th class="f-light f-12 f-w-500" scope="col">Percentage</th>
                                <th class="f-light f-12 f-w-500 text-end" scope="col">Total Amount</th>
                              </tr> -->
                            </thead>
                            <tbody>
                              <tr>
                                <td class="f-w-400 f-10"> <a class="line-clamp" href="#">Current Rank</a></td>
                                <td>
                                  <div class="progress-value d-flex gap-2 align-items-center">
                                    <div class="progress">
                                      <div class="progress-bar bg-primary" role="progressbar" style="width: 75%  " aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div><span>80%</span>
                                  </div>
                                </td>
                                <td class="txt-primary f-w-600 f-10 text-end">{{Auth::user()->rank}}</td>
                              </tr>
                              <tr>
                                <td class="f-w-400 f-10"> <a class="line-clamp" href="#">Rank Income</a></td>
                                <td>
                                  <div class="progress-value d-flex gap-2 align-items-center">
                                    <div class="progress">
                                      <div class="progress-bar bg-primary" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div><span>15% </span>
                                  </div>
                                </td>
                                <td class="txt-primary f-w-600 f-10 text-end"><?php  $rates = ($arrData['hscc_bonus']);
                                  echo custom_round($rates, 2);
                                ?></td>
                              </tr>
                              <tr>
                                <td class="f-w-400 f-10"> <a class="line-clamp" href="#">Wallet Balance</a></td>
                                <td>
                                  <div class="progress-value d-flex gap-2 align-items-center">
                                    <div class="progress">
                                      <div class="progress-bar bg-primary" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div><span>15% </span>
                                  </div>
                                </td>
                                <td class="txt-primary f-w-600 f-10 text-end">{{ custom_round($walletbalance, 2) }}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 wibox">
                <div class="card">
                  <div class="card-header border-t-primary">
                    <h4>Install Station</h4>
                    <p class="mt-1 f-m-light">Avialable Amount : {{ number_format(round($arrData['fund_Wallet_balance'], 2), 2)}}</p>
                  </div>
                  <div class="card-body d-flex">
                    <a href="topup" class="btn btn-pill btn-outline-success-2x btn-air-success w-50">Top Up</a>
                    <a href="topup-report" class="btn btn-pill btn-outline-info-2x btn-air-info w-50">Top Up Summary</a>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 wibox">
                <div class="card">
                  <div class="card-header border-t-primary">
                    <h4>Withdrawal</h4>
                    <p class="mt-1 f-m-light">Avialable Amount : {{number_format(round($walletbalance, 2), 2)}}</p>
                  </div>
                  <div class="card-body d-flex">
                    <a href="wallet-withdrawal" class="btn btn-pill btn-outline-success-2x btn-air-success w-50">Withdrawal</a>
                    <a href="wallet-withdrawal-report" class="btn btn-pill btn-outline-info-2x btn-air-info w-50">Withdrawal Ledger</a>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-12">
                <div class="card height-equal">
                  <div class="card-header border-l-primary border-2">
                    <h4>Energeios Promotional Material</h4>
                  </div>
                  <div class="card-body scroll-demo">
                    <ol class="list-group scroll-rtl">
                      <li class="list-group-item d-flex align-items-start flex-wrap">
                        <div class="ms-2 me-auto">
                          <img src="{{ asset('images/pdf.png')}}">
                          PDF
                        </div>
                        <a href="{{ asset('images/new/pdf/energeios.pdf')}}" class="btn btn-primary rounded-pill p-2">View</a>
                      </li>
                      <li class="list-group-item d-flex align-items-start flex-wrap">
                        <div class="ms-2 me-auto">
                          <img src="{{ asset('images/banner.png')}}">
                          Banner
                        </div>
                        <a href="banners" class="btn btn-secondary text-white rounded-pill p-2">View</a>
                      </li>
                      <li class="list-group-item d-flex align-items-start flex-wrap">
                        <div class="ms-2 me-auto">
                          <img src="{{ asset('images/ppt.png')}}">
                          PPT
                        </div>
                        <a href="{{ asset('images/new/ppt/energeios.pdf')}}" class="btn bg-success text-white rounded-pill p-2">View</a>
                      </li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- Container-fluid Ends-->
        </div>

    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var base_url = '{{ url('/') }}'
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

      function myFunctionRefLeft() {
         toastr.remove();
         // Get the input element containing the link
         var copyText = document.getElementById("referral-left");

         // Temporarily unhide the input to copy its contents
         copyText.type = 'text';
         copyText.select();  // Select the text field
         copyText.setSelectionRange(0, 99999); // For mobile devices

         // Execute the copy command
         document.execCommand("copy");

         copyText.type = 'hidden';

         toastr.success("<span class='btn-icon-start text-secondary'><i class='fa fa-copy color-secondary'></i> </span>Left Link Copied !");
      }

      function myFunctionRefRight() {
         toastr.remove();
         var copyText = document.getElementById("myRightInput");
         // Temporarily unhide the input to copy its contents
         copyText.type = 'text';
         copyText.select();  // Select the text field
         copyText.setSelectionRange(0, 99999); // For mobile devices

         // Execute the copy command
         document.execCommand("copy");

         copyText.type = 'hidden';

         toastr.success("<span class='btn-icon-start text-secondary'><i class='fa fa-copy color-secondary'></i> </span>Right Link Copied !");
         }
    </script>
    <script>
      CSS.registerProperty({
        name: "--p",
        syntax: "<integer>",
        initialValue: 0,
        inherits: true,
      });
    </script>
<script>
  function startServerClock() {
    const el = document.getElementById("server-time");
    let serverTime = new Date(el.dataset.time.replace(" ", "T"));
    setInterval(() => {
      serverTime.setSeconds(serverTime.getSeconds() + 1);
      const d = serverTime;
      const formatted = d.toLocaleString("en-GB", {
        day: "2-digit",
        month: "short",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hour12: false
      }).replace(",", "");
      el.textContent = formatted;
    }, 1000);
  }
  startServerClock();
</script>
@endsection
