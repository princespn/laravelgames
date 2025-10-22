@extends('layouts.user_type.auth-app')

@section('content')
@php
    $tWalletBalance = $getBalance['wallet_amount'] - $getBalance['wallet_withdrawal_amount'];
    $withdrawlAmount = ($getBalance['wallet_amount'] * 10 /100);
    $withdrawableAmount = ($withdrawlAmount < $tWalletBalance) ? $withdrawlAmount : $tWalletBalance;
@endphp
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="PageTitle">
                    <h1>B Wallet Withdrawal</h1>
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-md-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                            <div>                             
                            <div class="row">                       
                                <h5 style="width:100%;">
                                    Available Balance : {{ floor($tWalletBalance)}}<br>
                                    
                                </h5>
                            </div>
                            <div class="addfundcolorpath">
                            <form class="row g-3 incardInput z-index-999-relative" id="withdrawal_form">                           
                              <div class="col-md-12">
                                    <label>Enter Value</label>
                                    <input type="text" min="1" step="1" value="" 
                                        onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                        id="amount"
                                        name="amount"
                                        class="form-control"
                                        formcontrolname="set-working-wallet"
                                        placeholder="Enter Value"
                                    />
                                    <span class="error-msg-size tooltip-inner text-danger" id="amount_err"></span>
                                </div>
                                <input type="hidden" id="withdrawable_amount" name="withdrawable_amount" value="{{ $withdrawableAmount }}">
                                <div class="col-md-12">
                                    <label>Currency Type</label>
                                    <div class="selectMode">
                                        <div class="row">
                                            @foreach($getAllCurrency as $cur)
                                                @if($cur->default_selected == 1)
                                                    <div class="col-md-4">
                                                        <label>
                                                            <input type="radio" class="card-input-element" name="wcurrency_type" id="'wcurrency_type'. {{$cur->id}}"
                                                            value="{{$cur->currency_code}}" checked
                                                            />
                                                            <div class="panel panel-default card-input">
                                                                <h6 :for="'btnradio'+cur.id">{{$cur->currency_name}}</h6>
                                                                <img src="{{ asset('images/'.$cur->currency_img) }}" width="35" />
                                                            </div>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="col-md-4">
                                                        <label>
                                                            <input type="radio" class="card-input-element" name="wcurrency_type"
                                                            id="'wcurrency_type'. {{$cur->id}}"       value="{{$cur->currency_code}}"
                                                            />
                                                            <div class="panel panel-default card-input">
                                                                <h6 :for="'btnradio'+cur.id">{{$cur->currency_name}}</h6>
                                                                <img src="{{ asset('images/'.$cur->currency_img) }}" width="35" />
                                                            </div>
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 d-grid mt-5">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    <button type="button" class="btn loGbtn" id="working_otp_btn" onclick="sendOTPForWIthdraw()">Withdrawal</button>
                                    {{-- <button type="button" class="btn loGbtn" id="working_otp_btn" onclick="withdrawsucess()">Sell</button> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
        <!-- Energeios wallet -->
          <div class="col-md-6 withdrawl">
                <div class="addfundImgbg">
                    <img src="images/withdraw.png" class="img-fluid" />
                </div>
            </div>
    </div>
</div>


<!-----     script  ----------->

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

    var withdrawable_amount = parseFloat($('#withdrawable_amount').val());
    if (withdrawable_amount < working_wallet) {
        $("#amount_err").html('Withdrawal amount should be less or equal to '+ withdrawable_amount);
        setTimeout(function () {
            $("#amount_err").html('');
        }, 5000);
        return false;
    }

    if(working_wallet == '' || Currency_type == '')
    {
       return toastr['error']('All the fields are required');
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
              wallet_type: 3,
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

    if (nav_type == 'working') {
       url = "{{url('/store-bwithdrawal')}}";
    }
    // if (nav_type == 'roi') {
    //    url = "{{url('/withdraw-income-roi')}}";
    // }
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
                window.location.replace("{{url('/b-wallet-withdrawal-report')}}");
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