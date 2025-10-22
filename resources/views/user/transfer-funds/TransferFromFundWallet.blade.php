@extends('layouts.user_type.auth-app')
@php
    $google2fa_status = Auth::user()->google2fa_status;
    $topupworkingbalance = $getBalance['fund_wallet'] - $getBalance['fund_wallet_withdraw'];
@endphp
@section('content')
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Transfer Fund</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">
                        <svg class="stroke-icon">
                          <use href="{{ asset('svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Wallet Transfer</li>
                    <li class="breadcrumb-item active">Transfer Fund</li>
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
                      Transfer your fund to any account
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="mb-3">
                            <h5>
                              Fund Wallet Balance : ${{$topupworkingbalance}}   ||   Station ID : {{Auth::user()->user_id}}
                            </h5>
                            <hr>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-3">
                                <label>To Station ID</label>
                                <input type="text" class="form-control" id="touser-id" placeholder="Enter Station ID" maxlength="15">
                                <p class="text-danger" id="isUserAvailable" style="display: none;font-weight: 500;font-size: 15px; margin-top: 5px;"> Station ID Not Available
                                </p>
                                <input type="text" style="display:none;" readonly class="form-control" id="touser-id-name" value="">
                            </div>
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
                        </div>
                    </div>
                    <div class="card-footer">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <input type="hidden" name="topup_bal" id="topup_bal" value="">
                                    <button type="button" class="btn btn-primary" id="topupsub" disabled onclick="saveForm()" style="color: #ffffff;">Transfer</button>
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

    <div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        $(function () {
            $.ajax({
                url: base_url + '/get-wallet-balance',
                type: 'GET',
                data: {wallet_type: 'fund_wallet'},
                success: function (data) {
                    if (data.code == 200) {
                        $('#topup_bal').val(data.data);
                    } else {
                        $('#topup_bal').val(data.data);
                    }
                }
            });
        });
        $('#touser-id').on('input paste', function () {
            var user_id = $(this).val();
            if (user_id == '') {
                $("#isUserAvailable").css('display', 'block')
                $("#isUserAvailable").addClass('text-danger')
                $("#isUserAvailable").removeClass('text-success')
                $("#isUserAvailable").text('')
                $("#isUserAvailable").text('Station ID required.')
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
                        let currentUserId = $("#touser-id").val();
                        let curr_user_id = data.data.curr_user_id;
                        $("#touser-id-name").css('display', 'block')
                        $("#touser-id-name").val(data.data.fullname)
                        if(currentUserId == curr_user_id){
                            $("#isUserAvailable").css('display', 'block')
                            $("#isUserAvailable").addClass('text-danger')
                            $("#isUserAvailable").removeClass('text-success')
                            $("#isUserAvailable").text('Self Transfer Not Allowed')
                            $("#topupsub").attr('disabled', true)
                        }else{
                            $("#isUserAvailable").css('display', 'block')
                            $("#isUserAvailable").removeClass('text-danger')
                            $("#isUserAvailable").addClass('text-success')
                            $("#isUserAvailable").text('')
                            $("#isUserAvailable").text(data.message)
                            $("#topupsub").removeAttr('disabled')
                        }
                    } else {
                        $("#isUserAvailable").css('display', 'block')
                        $("#isUserAvailable").addClass('text-danger')
                        $("#isUserAvailable").removeClass('text-success')
                        $("#isUserAvailable").text(data.message)
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
        var transfer_amount = $("#amount").val();
        if(transfer_amount <= 0){
            toastr.error('Please enter a valid amount');
            return false;
        }
        if(Number($("#topup_bal").val()) < Number($("#amount").val())){
            toastr.error('Insufficient balance');
            return false;
        }
        var currentOTP = $("#otp").val();
        var touser_id = $("#touser-id").val();
        // if(currentOTP == ''){
        //     toastr.error("'Please enter otp send to you'r email");
        //     return false;
        // }
            $("#topupsub").prop('disabled', true)
            $("#otptbn").prop('disabled', true)
            $.ajax({

                url: "{{ url('/store-transferfromfundwallet') }}",
                type: 'POST',
                headers: {

                    'X-CSRF-TOKEN': csrf_token

                },
                data: {
                    otp: currentOTP,
                    otp_2fa: currentOTP,
                    to_user_id: touser_id,
                    amount: transfer_amount
                },
                success: function (response) {
                    if (response.code == 200) {
                        $('#exampleModal').modal('hide');
                        toastr.success(response.message);
                        $("#otp").val('');
                        $("#amount").val('');
                        $("#touser-id").val('');
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
