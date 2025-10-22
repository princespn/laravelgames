@extends('layouts.user_type.website')
@section('content')
<!-- content begin -->
<div class="no-bottom no-top" id="content">
   <div id="top"></div>
   <section class="pt10 pb10 mt80 bg-grey">
      <div class="container">
       <div class="row align-items-center">
            <div class="col-lg-12 text-center">
               <h3 class="mb-0">Investment Plan </h3>
            </div>
         </div>
      </div>
   </section>
   <section class="bannerUP">
      <div class="imgDown">
        <img src="{{ asset('web/images/banner-without-text.jpg')}}">
      </div>
      <div class="TextUp">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="bannertop">
                <h3>Investment plan</h3>
                <h1>$50 <span>Only</span></h1>
              </div>
            </div>
            <div class="col-md-12">
              <div class="bannerbottom">
                <div class="b-left">
                  <img src="{{ asset('web/images/DailyPRI-icon.png')}}" class="iw-50">
                  <div>
                    <h2>1%</h2>
                    <span>Daily PRI</span>
                  </div>
                </div>
                <div class="b-right">
                  <div class="b-right-1">
                    <img src="{{ asset('web/images/Returns-icon.png')}}" class="iw-35">
                    <div>
                      <h2>200%</h2>
                      <span>Returns</span>
                    </div>
                  </div>
                  <div class="b-right-1">
                    <img src="{{ asset('web/images/Direct-Income-icon.png')}}" class="iw-35">
                    <div>
                      <h2>10%</h2>
                      <span>Direct Income</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="BinaryIncome">
      <div class="container">
        <div class="row">
          <div class="col-md-12 D-heading text-center">
            <h2>Binary <span>Income</span></h2>
          </div>
        </div>
        <div class="row row-cols-2 row-cols-md-6 g-4 mt-3">
          <div class="col">
            <div class="card">
              <div class="bi-icon">
                <img src="{{ asset('web/images/icon/prime.png')}}" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title">Prime</h5>
                <p class="card-text">
                  Matching Units : 7% <br> Capping : $500
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="bi-icon">
                <img src="{{ asset('web/images/icon/apex.png')}}" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title">Apex</h5>
                <p class="card-text">
                  Matching Units : 7% <br> Capping : $500
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="bi-icon">
                <img src="{{ asset('web/images/icon/vanguard.png')}}" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title">Vanguard</h5>
                <p class="card-text">
                  Matching Units : 8% <br> Capping : $500
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="bi-icon">
                <img src="{{ asset('web/images/icon/elite.png')}}" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title">Elite</h5>
                <p class="card-text">
                  Matching Units : 8% <br> Capping : $1000
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="bi-icon">
                <img src="{{ asset('web/images/icon/poineer.png')}}" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title">Pioneer</h5>
                <p class="card-text">
                  Matching Units : 10% <br> Capping : $1000
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="bi-icon">
                <img src="{{ asset('web/images/icon/alpha.png')}}" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title">Alpha</h5>
                <p class="card-text">
                  Matching Units : 10% <br> Capping : $1000
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="bi-icon">
                <img src="{{ asset('web/images/icon/zenith.png')}}" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title">Zenith</h5>
                <p class="card-text">
                  Matching Units : 11% <br> Capping : $1000
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="bi-icon">
                <img src="{{ asset('web/images/icon/sovereing.png')}}" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title">Sovereign</h5>
                <p class="card-text">
                  Matching Units : 11% <br> Capping : $1500
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="bi-icon">
                <img src="{{ asset('web/images/icon/ascend.png')}}" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title">ascend</h5>
                <p class="card-text">
                  Matching Units : 12% <br> Capping : $1500
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="bi-icon">
                <img src="{{ asset('web/images/icon/summit.png')}}" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title">Summit</h5>
                <p class="card-text">
                  Matching Units : 12% <br> Capping : $2000
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="bi-icon">
                <img src="{{ asset('web/images/icon/titan.png')}}" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title">Titan</h5>
                <p class="card-text">
                  Matching Units : 15% <br> Capping : $3000
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="bi-icon">
                <img src="{{ asset('web/images/icon/luminary.png')}}" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title">Luminary</h5>
                <p class="card-text">
                  Matching Units : 15% <br> Capping : $5000
                </p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    <section class="RankChart">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center L-heading">
            <h2>Earnings & <span>Rank Chart</span></h2>
          </div>
        </div>
        <div class="row mt-5 text-center">
          <div class="col-md-12">
            <table class="table table-dark table-bordered roundedredius">
              <thead>
                <tr>
                  <th>Eligibility Criteria</th>
                  <th>Rank</th>
                  <th>Weekly Earning</th>
                  <th>Duration</th>
                  <th>Total Earning</th>
                </tr>
              </thead>
              <tbody>
                <tr class="custom-row-1">
                  <td>1 Affiliate Left & 1 Affiliate Right</td>
                  <td>Prime</td>
                  <td>$1</td>
                  <td>100 Weeks</td>
                  <td>$100</td>
                </tr>
                <tr class="custom-row-2">
                  <td>3 Prime Left & 3 Prime Right</td>
                  <td>Apex</td>
                  <td>$2</td>
                  <td>100 Weeks</td>
                  <td>$200</td>
                </tr>
                <tr class="custom-row-3">
                  <td>7 Prime Left & 7 Prime Right</td>
                  <td>Vanguard</td>
                  <td>$5</td>
                  <td>100 Weeks</td>
                  <td>$500</td>
                </tr>
                <tr class="custom-row-1">
                  <td>15 Prime Left & 15 Prime Right</td>
                  <td>Elite</td>
                  <td>$8</td>
                  <td>100 Weeks</td>
                  <td>$800</td>
                </tr>
                <tr class="custom-row-2">
                  <td>31 Prime Left & 31 Prime Right</td>
                  <td>Pioneer</td>
                  <td>$12</td>
                  <td>100 Weeks</td>
                  <td>$1200</td>
                </tr>
                <tr class="custom-row-3">
                  <td>100 Prime Left & 100 Prime Right</td>
                  <td>Alpha</td>
                  <td>$20</td>
                  <td>100 Weeks</td>
                  <td>$2000</td>
                </tr>
                <tr class="custom-row-1">
                  <td>250 Prime Left & 250 Prime Right</td>
                  <td>Zenith</td>
                  <td>$50</td>
                  <td>100 Weeks</td>
                  <td>$5000</td>
                </tr>
                <tr class="custom-row-2">
                  <td>500 Prime Left & 500 Prime Right</td>
                  <td>Sovereign</td>
                  <td>$100</td>
                  <td>100 Weeks</td>
                  <td>$10000</td>
                </tr>
                <tr class="custom-row-3">
                  <td>1000 Prime Left & 1000 Prime Right</td>
                  <td>ascend</td>
                  <td>$200</td>
                  <td>100 Weeks</td>
                  <td>$20000</td>
                </tr>
                <tr class="custom-row-1">
                  <td>2500 Prime Left & 2500 Prime Right</td>
                  <td>Summit</td>
                  <td>$500</td>
                  <td>100 Weeks</td>
                  <td>$50000</td>
                </tr>
                <tr class="custom-row-2">
                  <td>5000 Prime Left & 5000 Prime Right</td>
                  <td>Titan</td>
                  <td>$1100</td>
                  <td>100 Weeks</td>
                  <td>$110000</td>
                </tr>
                <tr class="custom-row-3">
                  <td>10000 Prime Left & 10000 Prime Right</td>
                  <td>Luminary</td>
                  <td>$2500</td>
                  <td>100 Weeks</td>
                  <td>$250000</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <section class="PmymentMode">
      <div class="container">
        <div class="row">
          <div class="col-md-12 D-heading">
            <h5>Pay Through</h5>
            <h2>Modes Of <span>Payments</span></h2>
          </div>
          <div class="col-md-12">
            <div class="modeImg">
              <img src="{{ asset('web/images/paymentmode.png')}}" class="img-fluid">
            </div>
          </div>
          <div class="col-md-12 D-heading">
            <h2>USDT.BEP<span>20</span></h2>
          </div>
        </div>
      </div>
    </section>
</div>
<!-- content close -->

@endsection

