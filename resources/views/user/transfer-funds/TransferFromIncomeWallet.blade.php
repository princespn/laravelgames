@extends('layouts.user_type.auth-app')
@php
    $google2fa_status = Auth::user()->google2fa_status;
    $sellbalance = $getBalance['working_wallet'] - $getBalance['working_wallet_withdraw'];
@endphp
@section('content')

 <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Income Migration</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">
                        <svg class="stroke-icon">
                          <use href="{{ asset('svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Wallet Transfer</li>
                    <li class="breadcrumb-item active">Income Migration</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="edit-profile">
              <div class="row">
                <div class="col-md-12">
                <form class="card">
                 <div class="card-header card-header border-t-primary border-3">
                      Transfer your Income Wallet to Fund Wallet
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="mb-3">
                            <h5>
                              Income Wallet Balance : ${{ number_format($sellbalance, 2)}}   ||   Station ID : {{Auth::user()->user_id}}
                            </h5>
                            <hr>
                          </div>
                        </div>
                        <div class="col-md-6">
                         <div class="mb-3">
                                    <label>Enter Value</label>
                                    <input
                                        type="number"
                                        id="amount"
                                        name="amount"
                                        class="form-control"
                                        formcontrolname="set-fund-wallet"
                                        placeholder="Enter Value"
                                    />
                                </div>
                            </div>
                            <div class="col-sm-12">
                          <div class="mb-3">
                            <label class="form-label">Transfer Type</label>
                              <div class="form-check radio radio-primary ps-0">
                              <ul class="radio-wrapper justify-content-start">
                                <li>
                                  <input class="form-check-input" type="radio" name="transfer_type" id="transfer_type1" value="1" checked>
                                  <label class="form-check-label" for="radio-icon">
                                    <i class="icofont icofont-ui-user"></i>
                                    <p>Self Transfer <br><small>For your self transfer.</small></p>
                                  </label>
                                </li>
                                <li>
                               <input class="form-check-input" type="radio" name="transfer_type" id="transfer_type2" value="2">
                                  <label class="form-check-label" for="radio-icon4">
                                    <i class="icofont icofont-users-social"></i>
                                    <p>Transfer to Other User <br><small>For other users.</small></p>
                                  </label>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>





                                <div class="col-md-12" id="hideselftransferdivs">
                                     <div class="mb-3">
                                    <label>Enter Station ID</label>
                                    <input
                                        type="text"
                                        id="username"
                                        name="username"
                                        value="{{Auth::user()->user_id}}"
                                        class="form-control"
                                        placeholder="Enter Station ID"
                                    />
                                </div>
                            </div>
                                 <div class="col-md-6">
                         <div class="mb-3">
                                  <label>Deduction Fee</label>
                                  <input type="text" class="form-control" id="deduction" value="5%" disabled style="background-color: #ffffff;">
                                </div>
                                </div>
                                <div class="card-footer">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <input type="hidden" name="topup_bal" id="topup_bal" value="">
                                    <button type="button" class="btn btn-primary" id="topupsub" onclick="saveForm()" style="color: #ffffff;">Transfer</button>
                                </div>
                            </form>
                        </div>                
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Energeios wallet -->
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter OTP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                 <form class="row g-4 border-bottom-input z-index-999-relative">
                      @if(Auth::user()->google2fa_status == "disable")
                        <div class="col-md-12 otp">
                            <input type="text" class="form-control" placeholder="Enter OTP" name="otp" id="otp" maxlength="6"
                              onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                              <span class="error-msg-size tooltip-inner text-white">OTP sent to
                            @php
                                $email = Auth::user()->email;
                                $modifiedEmail = substr_replace($email, "********", 4, 8); // Add an asterisk after the fourth character
                            @endphp
                            {{ $modifiedEmail }}</span>
                            <div class="tooltip2">
                              <span class="error-msg-size tooltip-inner text-danger" id="otp_err"></span>
                            </div>
                            </div>
                      </form>
                   </div>                   
                        <div class="modal-footer">
                        <button class="btn btn-primary" id="resend_otp_btn" onclick="sendOTP()" type="button">Resend</button>
                      @else
                      <div class="col-md-12 G2FA">
                        <input type="text" name="2fa-otp" id="otp_2fa" class="form-control" placeholder="Enter G2FA OTP" maxlength="6"
                          onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                        <div class="tooltip2">
                          <span class="error-msg-size tooltip-inner text-danger" id="otp_err"></span>
                        </div>
                         </div>
                      </form>
                   </div>                   
                    <div class="modal-footer">
                    @endif
                <button type="button" id="otpbtn" class="btn btn-primary" onclick="saveForm()">Submit</button>
              </div>
            </div>
          </div>
        </div>
</div>
</div>
<script>
    var google2fa  =  '{{$google2fa_status}}'
    
    $(document).ready(function () {

        $('#hideselftransferdivs').hide();
        document.querySelectorAll('input[name="transfer_type"]').forEach((radio) => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    let value = this.value;
                    if(value == 1)
                    {
                        $('#hideselftransferdivs').hide();
                        $('#username').val("{{Auth::user()->user_id}}");
                        $("#topupsub").attr('disabled', false);
                    }
                    else{
                        $('#hideselftransferdivs').show();
                        $('#username').val('');
                        $("#topupsub").attr('disabled', true);
                    }

                }
            });
        });


        $(function () {
            $.ajax({
                url: base_url + '/get-wallet-balance',
                type: 'GET',
                data: {wallet_type: 'sell_wallet'},
                success: function (data) {
                    if (data.code == 200) {
                        $('#topup_bal').val(data.data);
                    } else {
                        $('#topup_bal').val(data.data);
                    }
                }
            });
        });


        $('#username').on('blur paste', function () {
            var user_id = $(this).val();
            if (user_id == '') {
                $("#topupsub").attr('disabled', true)
                return;
            }
            $.ajax({
                url: base_url + "/checkuserexistAuth",
                type: "POST",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrf_token
                },
                data: {user_id: user_id},
                success: function (data) {                            
                    if (data.code == 200) {
                        let currentUserId = $("#username").val();
                        let curr_user_id = data.data.curr_user_id;
                        if(currentUserId == curr_user_id){
                            $("#topupsub").attr('disabled', true);
                            toastr.remove();
                            toastr.error('Self Transfer Not Allowed');
                        }else{
                            toastr.remove();
                            toastr.success(data.message)
                            $("#topupsub").removeAttr('disabled')
                        }
                    } else {
                        toastr.remove();
                        toastr.error(data.message)
                        $("#topupsub").attr('disabled', true)
                    }
                }
            });
        });


    });

    function  sendOTP(){

        if($("#amount").val() <= 0){
            toastr.error('Please enter a valid amount');
            return false;
        }
        if(Number($(".topup_bal").val()) < Number($("#amount").val())){
            toastr.error('Insufficient balance');
            return false;
        }
        if (google2fa == 'disable') {
            $.ajax({

                url: "{{ url('/sendOtp-update-user-profile') }}",
                type: 'POST',
                headers: {

                    'X-CSRF-TOKEN': csrf_token

                },
                success: function(response) {
                    if(response.code == 200){
                      // OTP sent successfully
                     
                          $("#exampleModal").modal("show");
                          toastr['success'](response.message);
                           $('#topupsub').prop('disabled', false);
                    }else{
                        $('#topupsub').prop('disabled', false);
                        toastr['error'](response.message)
                    }
                },

            });
        }
        $("#exampleModal").modal('show');
    }

    $('#amount').on('input paste', function() {
    var maxLength = 15;
        if ($(this).val().length > maxLength) {
            $(this).val($(this).val().slice(0, maxLength));
        }
    });
   
    function  saveForm(){
            toastr.remove();
        var transfer_amount = $("#amount").val();
        if(transfer_amount <= 0){
            toastr.error('Please enter a valid amount');
            return false;
        }
        if(Number($("#topup_bal").val()) < Number($("#amount").val())){
            toastr.remove();
            toastr.error('Insufficient balance');
            return false;
        }
        var currentOTP = $("#otp").val();
        var touser_id = $("#username").val();
        // if(currentOTP == ''){
        //     toastr.error("'Please enter otp send to you'r email");
        //     return false;
        // }
            $("#topupsub").prop('disabled', true)
            $("#otptbn").prop('disabled', true)
            $.ajax({

                url: "{{ url('/store-transferfromincomewallet') }}",
                type: 'POST',
                headers: {

                    'X-CSRF-TOKEN': csrf_token

                },
                data: {
                    otp: currentOTP,
                    otp_2fa: currentOTP,
                    username: touser_id,
                    amount: transfer_amount
                },
                success: function (response) {
                    if (response.code == 200) {
                        $('#exampleModal').modal('hide');
                        toastr.success(response.message);
                        $("#otp").val('');
                        $("#amount").val('');
                        $("#username").val('');
                        $("#topupsub").attr('disabled', true)
                        setTimeout(function () {
                                    window.location.href = '{{url('/transfer-report')}}';
                                }, 100);
                        // new Swal({
                        //     title: `${response.message}!!`,
                        //     type: "warning",
                        //     showCancelButton: true,
                        //     confirmButtonColor: "#3085d6",
                        //     cancelButtonColor: "#d33",
                        //     confirmButtonText: "Go to Report",
                        // }).then((result) => {
                        //     if (result.value) {
                        //         setTimeout(function () {
                        //             window.location.href = '{{url('/transfer-report')}}';
                        //         }, 100);
                        //     } else {
                        //         location.reload();
                        //     }
                        // });

                    } else if (response.code == 401) {
                        toastr.error(response.message);
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    } else {
                        toastr.error(response.message);
                        $("#topupsub").prop('disabled', false)
                        $("#otpbtn").prop('disabled', false)
                    }

                }
            });
        }
</script>
@endsection
