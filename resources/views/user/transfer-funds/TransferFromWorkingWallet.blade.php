@extends('layouts.user_type.auth-app')
@php
    $google2fa_status = Auth::user()->google2fa_status;
    $topupworkingbalance = $getBalance['working_wallet'] - $getBalance['working_wallet_withdraw'];
@endphp
@section('content')
   <div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="PageTitle">
                    <h1>Transfer Token</h1>
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-md-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="addfundcolorpath">
                            <form class="row g-3 incardInput z-index-999-relative">
                            <div>
                                <h5>
                                    Token Value : {{$topupworkingbalance}} &nbsp; || &nbsp; Station ID : {{Auth::user()->user_id}}
                                </h5>
                            </div>                                                                        <div class="col-md-12">
                                <label>To Station ID</label>
                                <input type="text" class="form-control" id="touser-id" placeholder="enter Station ID" maxlength="15">
                                <p class="text-danger" id="isUserAvailable" style="display: none;font-weight: 500;margin-bottom: 5px;font-size: 15px; margin-top: 0px;"> Station ID not available
                                </p>
                            </div>                           
                              <div class="col-md-12">
                                    <label>Enter Token Value</label>
                                    <input
                                        type="number"
                                        id="amount"
                                        name="amount"
                                        class="form-control"
                                        formcontrolname="set-working-wallet"
                                        placeholder="Enter Token Value"
                                    />
                                </div>
                                                                  
                                <div class="col-md-12 d-grid mt-5">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <input type="hidden" name="topup_bal" id="topup_bal" value="">
                                    <button type="button" class="btn loGbtn" id="topupsub" disabled onclick="saveForm()" style="color: #ffffff;">Transfer</button>
                                </div>
                            </form>
                        </div>                
                    </div>
                </div>
            </div>
            <div class="col-md-6 withdrawl">
                <div class="addfundImgbg">
                    <img src="images/withdraw.png" class="img-fluid" />
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
        $(function () {
            $.ajax({
                url: base_url + '/get-wallet-balance',
                type: 'GET',
                data: {wallet_type: 'working_wallet'},
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
            toastr.error('Please enter a valid token range');
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
            toastr.error('Please enter a valid token range');
            return false;
        }
        if(Number($(".topup_bal").val()) < Number($("#amount").val())){
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

                url: "{{ url('/store-transferfromworkingwallet') }}",
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
                        new Swal({
                            title: `${response.message}!!`,
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Go to Report",
                        }).then((result) => {
                            if (result.value) {
                                setTimeout(function () {
                                    window.location.href = '{{url('/transfer-report')}}';
                                }, 100);
                            } else {
                                location.reload();
                            }
                        });

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
