@extends('layouts.user_type.auth-app')

@section('content')
@php
    $walletBalance = $getBalance['working_wallet'] - $getBalance['working_wallet_withdraw'];
    $roiWalletBalance = $getBalance['roi_wallet'] - $getBalance['roi_wallet_withdraw'];
@endphp
<style type="text/css">
.selectMode .card-input-element {
    display: block!important;
}

</style>
 <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Income Withdrawal</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Withdrawal</li>
                    <li class="breadcrumb-item active">Income Withdrawal</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="edit-profile">
              <div class="row">
                <div class="col-md-12">
                  <form class="card" id="withdrawal_form">
                    <div class="card-header card-header border-t-primary border-3">
                      <h5>Working Wallet Balance : {{ number_format($walletBalance, 2) }}</h5>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="mb-3">
                            <h5>
                                ROI Wallet Balance : {{ number_format($roiWalletBalance, 2) }}
                            </h5>
                            <hr>
                          </div>
                        </div>

                        <div class="col-md-6">
                         <div class="mb-3">
                            <label>Enter Value</label>
                            <input type="text" min="1" step="1" value=""
                            onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                            id="amount"
                            name="amount"
                            class="form-control"
                            formcontrolname="set-working-wallet"
                            placeholder="Enter Value" maxlength="10"
                            />
                            <p class="error-msg-size tooltip-inner text-danger" id="amount_err"></p>
                        </div>
                                  <div class="mb-3">
                                      <label>Deduction Fee</label>
                                      <input type="text" class="form-control" id="deduction" value="10%" disabled style="background-color: #ffffff;">
                                    </div>
                            </div>
                                  <div class="col-sm-12">
                          <div class="mb-3">
                                        <label for="input-placeholder" class="form-label">Currency Type</label>
                                         <div class="form-check radio radio-primary ps-0">
                              <ul class="radio-wrapper justify-content-start">
                                           @foreach($currency as $cur)
                                             <li>
                                                 @if($cur->default_selected == 1)
                                                  <input checked type="radio" class="form-check-input" name="wcurrency_type" id="basic-{{$cur->currency_code}}" value="{{$cur->currency_code}}" checked/>
                                                  @else
                                                  <input checked type="radio" class="form-check-input" name="wcurrency_type" id="basic-{{$cur->currency_code}}" value="{{$cur->currency_code}}"/>
                                                  @endif
                                              <label class="form-check-label" for="radio-icon1">
                                                <img src="{{ asset('images/USDT.png')}}" width="50">
                                                <span>{{$cur->currency_code}}</span></label>
                                            </li>
                                           @endforeach
                                       </ul>
                                        </div>
                                     </div>
                                 </div>
                                     <!--Need to do dev--> 
                                     <div class="col-sm-12">
                          <div class="mb-3">
                            <label class="form-label">Wallet Type</label>
                              <div class="form-check radio radio-primary ps-0">
                              <ul class="radio-wrapper justify-content-start">
                                <li>
                                  <input class="form-check-input" type="radio" name="wallet_type" id="wallet-working" value="working" checked>
                                  <label class="form-check-label" for="radio-icon">
                                    <i class="icon-wallet"></i>
                                    <p>Working Wallet</p>
                                  </label>
                                </li>
                                <li>
                                  <input class="form-check-input" type="radio" name="wallet_type" id="wallet-binary" value="roi">
                                  <label class="form-check-label" for="radio-icon4">
                                    <i class="icofont icofont-cur-dollar-plus"></i>
                                    <p>ROI Wallet</p>
                                  </label>
                                </li>
                              </ul>

                            </div>
                          </div>
                        </div>

                        <!--This is old one now commented end-->
                        <div class="card-footer">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <button type="button" class="btn btn-primary" id="working_otp_btn" onclick="sendOTPForWIthdraw()">Withdrawal</button>
                                {{-- <button type="button" class="btn btn-primary" id="working_otp_btn" onclick="withdrawsucess()">Sell</button> --}}
                            </div>
                        </form>
                    </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade enterOTP modal-lg" id="exampleModal" tabindex="-1" toggle="modal" aria-labelledby="exampleModalLabel" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter OTP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-4 border-bottom-input z-index-999-relative">
                    <div class="col-md-12">
                        <div class="">
                            <div class="col-md-12">
                                @if(Auth::user()->google2fa_status == "disable")
                                    <input type="text" name="otp" class="form-control" placeholder="Enter OTP" id="otp"  onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"  maxlength="6"/>
                                    <span class="error-msg-size tooltip-inner text-white">OTP sent to
                                        @php
                                            $email = Auth::user()->email;
                                            $modifiedEmail = substr_replace($email, "********", 4, 8); 
                                        @endphp
                                        {{ $modifiedEmail }}
                                    </span>
                                @else
                                  <input type="text" name="2fa-otp" id="otp_2fa" class="form-control w1000" placeholder="Enter G2FA OTP"
                                  maxlength="6"
                                  onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button  onclick="withdrawsucess()" type="button" id="working" class="btn btn-primary">Submit</button>
                @if(Auth::user()->google2fa_status == "disable")
                    <button class="btn btn-primary" onclick="sendOTPForWIthdraw()" type="button">Resend</button>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>


var nav_type = "working";

function sendOTPForWIthdraw(){
    
    var working_wallet;
    var Currency_type;
    var tfastatus = "{{Auth::user()->google2fa_status}}";

    working_wallet =  $("#amount").val();
    
    var Currency_type = $('input[type="radio"][name="wcurrency_type"]:checked').val();
    if (working_wallet <= 0) {
        $("#amount_err").html('Please enter a valid Amount.');
        setTimeout(function () {
            $("#amount_err").html('');
        }, 2000);
        return false;
    }

    var nav_type = $('input[type="radio"][name="wallet_type"]:checked').val();
    if(nav_type == "working")
    {
        var withdrawable_amount = parseFloat("<?php echo floor($walletBalance); ?>");
    }
    else{
        var withdrawable_amount = parseFloat("<?php echo floor($roiWalletBalance); ?>");
    }
    if (withdrawable_amount < working_wallet) {
        $("#amount_err").html('Insufficient Withdrawal Balance');
        setTimeout(function () {
            $("#amount_err").html('');
        }, 5000);
        return false;
    }else if(working_wallet < 5)
    {
        $("#amount_err").html('The minimum Withdraw Value is $5');
        setTimeout(function () {
            $("#amount_err").html('');
        }, 5000);
        return false;
    }

    if(Currency_type == undefined)
    {
       return toastr['error']('Please select a currency');
    }
   
     
  if(tfastatus == "disable")
  {
    
    if(working_wallet != '' && Currency_type != '')
    {
       $('#working_otp_btn').prop('disabled', true);
       
        $.ajax({
            type:'POST',
            url:"{{url('/sendOtp-For-Withdraw')}}",
            // dataType: 'JSON',
            data:{
              type: 'Withdrawal',
              Currency_type: Currency_type,
              working_wallet: working_wallet,
               "_token": $('#token').val(),
            },
            success:function(response){
            if(response.code == 200){
               $("#exampleModal").modal("show");
                toastr['success'](response.message);
                $('#working_otp_btn').prop('disabled', false);              
                 
              }else{
                $('#working_otp_btn').prop('disabled', false);
                
                //alert('error'+response.message);
                
                toastr['error'](response.message);
               
              }
            }         
        });
    }
}
else{
  if(working_wallet != '' && Currency_type != '')
    {
       $('#working_otp_btn').prop('disabled', true);
      

     $('#working_otp_btn').prop('disabled', false);
        
     //alert('open');
     $("#exampleModal").modal("show");

  }
  
}
}


function withdrawsucess(){
    var working_wallet;
    var Currency_type;
    var url;
    var otp = $("#otp").val();
    var otp_2fa = $("#otp_2fa").val();
    
    working_wallet =  $("#amount").val();

    Currency_type = $('input[type="radio"][name="wcurrency_type"]:checked').val();
    
    if(working_wallet == '' || Currency_type == '' || nav_type == '')
    {
     return toastr['error']('All the fields are required');
    }

    var nav_type = $('input[type="radio"][name="wallet_type"]:checked').val();

    if (nav_type == 'working') {
       url = "{{url('/store-withdrawal')}}";
    }
    if (nav_type == 'roi') {
        url = "{{url('/withdraw-income-roi')}}";
    }
    // if (nav_type == 'bonus') {
    //    url = "{{url('/withdraw-income-bonus')}}";
    // }
    



    if(working_wallet != '' && Currency_type != '' && url != '')
    {
       $('#working').prop('disabled', true);
        $('#working_otp_btn').prop('disabled', true);
       // $('#roi').prop('disabled', true);
       // $('#bonus').prop('disabled', true);
        $.ajax({
            type:'POST',
            url:url,
            data:{
              Currency_type: Currency_type,
              otp: otp,
              otp_2fa: otp_2fa,
              working_wallet: working_wallet,
               "_token": $('#token').val(),
            },
            success:function(response){
            if(response.code == 200){
                $("#exampleModal").modal("hide");
                window.location.replace("{{url('/wallet-withdrawal-report')}}");
                  toastr['success'](response.message);
                   $('#working').prop('disabled', false);
                   // $('#roi').prop('disabled', false);
                   // $('#bonus').prop('disabled', false);

                 //  alert('in');
              }else{
                  $('#working').prop('disabled', false);
                   $('#working_otp_btn').prop('disabled', false);
                   // $('#roi').prop('disabled', false);
                   // $('#bonus').prop('disabled', false);
                   
                   //alert('out');
                  toastr['error'](response.message)

              }
            }
        });
    }
}

</script>
@endsection
