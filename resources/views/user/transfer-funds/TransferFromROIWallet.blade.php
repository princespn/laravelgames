@extends('layouts.user_type.auth-app')
@php
    $google2fa_status = Auth::user()->google2fa_status;
@endphp
@section('content')
     <div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0">Transfer From ROI Wallet</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Place Withdrawal</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <!-- end page title -->
      </div>
      <!-- container-fluid -->
   </div>
   <!-- End Page-content -->
<!-- end main content-->
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="myeditotpmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enter OTP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="closePopup()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-4">
                                <img src="{{asset('images/email-vector.png')}}" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    @if($google2fa_status == 'disable')
                                        <div class="col-md-12" v-if="profile.google2fa_status=='disable'">
                                            <input type="text" id="profile-otp" name="otp" class="form-control w1000" placeholder="Enter OTP" v-model="otp_edit" maxlength="6" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                                            <!-- <span class="error-msg-size tooltip-inner text-white">OTP sent to {{Auth::user()->email}}</span> -->
                                            <span class="error-msg-size tooltip-inner text-white">OTP sent to
                                                @php
                                                $email = Auth::user()->email;
                                                $modifiedEmail = substr_replace($email, "********", 4, 8); // Add an asterisk after the fourth character
                                                @endphp

                                                {{ $modifiedEmail }}
                                            </span>
                                        </div>
                                    @else
                                        <div class="col-md-12 mt-3" v-else>
                                            <input type="text" name="2fa-otp" id="profile-otp" class="form-control w1000" placeholder="Enter G2FA OTP" v-model="otp_2fa" maxlength="6" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                                            <!-- <input type="text" class="form-control" placeholder="Enter OTP"> -->
                                        </div>
                                    @endif
                                    <div class="col-md-12 text-center mt-3" v-if="profile.google2fa_status=='disable'">
                                        <button type="button" class="btn bg-gradient-primary" id="resend_otp_profile" onclick="updateUserData()">Resend</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button onclick="saveForm()" type="button" class="btn btn-primary kbb-bbt">Submit</button>
                        <!-- <button type="button" class="btn btn-light">Submit</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var google2fa  =  '{{$google2fa_status}}'
    
    $(document).ready(function () {
        $(function () {
            $.ajax({
                url: base_url + '/get-wallet-balance',
                type: 'GET',
                data: {wallet_type: 'roi_wallet'},
                success: function (data) {
                    if (data.code == 200) {
                        $('#topup_bal').text('');
                        $('#topup_bal').text(data.data);
                        $('.topup_bal').val(data.data);
                    } else {
                        $('#topup_bal').text('');
                        $('#topup_bal').text(0);
                        $('.topup_bal').val(data.data);
                    }
                }
            });
        });
        $('#touser-id').on('input', function () {
            var user_id = $(this).val();
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
                        $("#isUserAvailable").text(data.message)
                        $("#topupsub").attr('disabled', true)
                    }
                }
            });
        });
    });

    function  sendOTP(){
        if($("#transfer-amount").val() == ''){
            toastr.error('Transfer Amount Balance Required');
            return false;
        }
        if(Number($(".topup_bal").val()) < Number($("#transfer-amount").val())){
            toastr.error('Insufficient balance');
            return false;
        }
        if (google2fa == 'disable') {
            $.ajax({

                url: "{{ url('/sendOtp-update-user-profile') }}",
                type: 'POST',
                headers: {

                    'X-CSRF-TOKEN': "{{ csrf_token() }}"

                },
                success: function(response) {
                },

            });
        }

        $("#myeditotpmodal").modal('show');
    }


    function  saveForm(){
        var currentOTP = $("#profile-otp").val();
        var transfer_amount = $("#transfer-amount").val();
        var touser_id = $("#touser-id").val();
        if(currentOTP == ''){
            toastr.error("'Please enter otp send to you'r email");
            return false;
        }else {

            $.ajax({

                url: "{{ url('/store-transferfromroiwallet') }}",
                type: 'POST',
                headers: {

                    'X-CSRF-TOKEN': "{{ csrf_token() }}"

                },
                data: {
                    otp: currentOTP,
                    otp_2fa: currentOTP,
                    to_user_id: touser_id,
                    amount: transfer_amount
                },
                success: function (response) {
                    if (response.code == 200) {
                        $('#myeditotpmodal').modal('hide');
                        toastr.success(response.message);
                        $("#profile-otp").val('');
                        $("#transfer-amount").val('');
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
                                    window.location.href = '{{url('/reports/transfer-report')}}';
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
                        $("#topupsub").attr('disabled', true)
                    }

                }
            });
        }
    }
</script>
