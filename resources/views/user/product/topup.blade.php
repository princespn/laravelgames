@extends('layouts.user_type.auth-app')
@section('content')
@php
$topupfundbalance = $getBalance['fund_wallet'] - $getBalance['fund_wallet_withdraw'];

if(is_numeric($topupfundbalance))
{
    $topupfundbalance = number_format($topupfundbalance, 2);
}
else{
    $topupfundbalance = 0;
}
@endphp
<style>
    .text-danger{
/*     color: #ffffff !important; */
font-weight: bold;
}
</style>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Install Station</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('svg/icon-sprite.svg#stroke-home')}}"></use>
                            </svg></a></li>
                            <li class="breadcrumb-item">Power Station</li>
                            <li class="breadcrumb-item active"> Install Station</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="edit-profile">
                <div class="row">
                    <div class="col-md-12">
                        <form class="card" id="topup_form">
                            <div class="card-header card-header border-t-primary border-3">
                                Plug into Energeios and unlock nonstop income from EV charging.
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <h5>
                                                Deposit wallet Balance: ${{$topupfundbalance}}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Installation Type</label>
                                            <div class="form-check radio radio-primary ps-0">
                                                <ul class="radio-wrapper justify-content-start">
                                                    <li>
                                                        <input class="form-check-input" checked type="radio" name="topup_type" id="basic" value="self" onChange="topupTypeValidation(this.id)"/>
                                                        <label class="form-check-label" for="radio-icon">
                                                            <i class="icon-wallet"></i>
                                                            <p>Install Station  <br><small> - For your own ID</small></p>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input class="form-check-input" type="radio" id="complete" name="topup_type" value="downline" onChange="topupTypeValidation(this.id)"/>
                                                        <label class="form-check-label" for="radio-icon4">
                                                            <i class="icofont icofont-social-newsvine"></i>
                                                            <p>Create Structure <br><small>Can be create only once</small></p>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 auth">
                                        <div class="mb-3">
                                            <label class="form-label">Station ID</label>
                                            <input type="text" class="form-control input-lg ng-untouched ng-pristine ng-invalid" placeholder="Station ID" name="user_id" disabled="" value="{{Auth::user()->user_id}}" id="user_id" style="background-color: #ffffff;">
                                        </div>
                                    </div>
                                    <div class="col-md-6 upline">
                                        <div class="mb-3">
                                            <label>Enter Name</label>
                                            <input type="text" class="form-control input-lg ng-untouched ng-pristine ng-invalid"
                                            placeholder="Enter Name(Applicable for All Station)" name="fullname" id="fullname"
                                            style="background-color: #ffffff;" maxlength="20" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                                            onkeypress="return(event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)">
                                            <input type="hidden" name="user_id" value="{{Auth::user()->user_id}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 upline">
                                        <div class="mb-3">
                                            <label>Enter Email ID</label>
                                            <input type="email" class="form-control input-lg ng-untouched ng-pristine ng-invalid" placeholder="Enter Email ID(Applicable for All Station)" maxlength="50" name="email" id="email" style="background-color: #ffffff;">
                                        </div>
                                    </div>
                                    <div class="col-md-6 upline">
                                        <div class="mb-3">
                                            <label>Enter Password</label>
                                            <input type="password" class="form-control input-lg ng-untouched ng-pristine ng-invalid" placeholder="Enter Password(Applicable for All Station)" name="password" id="password" maxlength="30" style="background-color: #ffffff;">
                                        </div>
                                    </div>
                                    <div class="col-md-6 upline">
                                        <div class="mb-3">
                                            <label>Select Number of Station Count</label>
                                            <!-- <input onpaste="return false;" placeholder="Enter Station Count" id="usercount" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Numbers only"
                                                name="usercount" class="form-control input-lg"  maxlength="9" onkeyup="userCountSelection()">  -->
                                                <select id="usercount" aria-label="Select Number of Station Count" name="usercount" class="form-select" data-vv-as="Wallet" onChange="userCountSelection()" required>
                                                    <option selected value="">Select Number of Station Count</option>
                                                    <option value="3">3 ids (Self + 2 ids)</option>
                                                    <option value="7">7 ids (Self + 6 ids)</option>
                                                    <option value="15">15 ids (Self + 14 ids)</option>
                                                    <option value="31">31 ids (Self + 30 ids)</option>
                                                    <option value="63">63 ids (Self + 62 ids)</option>
                                                    <option value="127">127 ids (Self + 126 ids)</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Amount</label>
                                                <input onpaste="return false;" placeholder="Amount" id="amount" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Numbers only"
                                                name="amount" class="form-control input-lg" value="50" maxlength="9" readonly>
                                                <span class="float-start py-2 error-msg-size tooltip-inner text-danger" id="amount_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <small class="txt-primary">NOTE:- Confirm your email address is accurate, because once you Install Station, it can't be changed.</small>
                                        </div>
                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                        <input type="hidden" id="motp" name="otp">
                                        <input type="hidden" id="g2fa" name="otp_2fa">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button id="selftopup" type="submit" class="btn btn-primary btn-wave waves-effect waves-light">Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end main content-->
        <!-- Modal -->
        <div class="modal fade enterOTP modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <button type="button" id="selftopupo" class="btn btn-primary" onclick="storeTopup()">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#topup_form').validate({
            errorPlacement: function (error, element) {
                let group = element.closest('.input-group, .form-input');
                if (group.length) {
                    error.insertAfter(group);
                } else {
                    error.insertAfter(element);
                }
            },
            rules: {
               fullname: {
                    required: true,
                    minlength: 3,
                    maxlength: 20,
               },
                email: {
                    required: true,
                    email: true,
                    validate_email: true,
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 16,
                    strongPassword : true
                },
                usercount: {
                    required: true,
                },
                amount: {
                    required: true,
                }
            },
            messages:{
                fullname: {
                    required: "Full name is required.",
                },
                usercount: {
                    required: "Select Number of Station Count is required.",
                },
                email: {
                    required: "Email is required.",
                },
                password: {
                    required: "Password is required.",
                },
            },
            submitHandler: function(form) {
                storeTopup();
            }
        });
    });

    topupTypeValidation();
    function topupTypeValidation() {
        topup_type = $('input[name="topup_type"]:checked').val();
        if (topup_type == ""){
            $('.upline').hide();
            $('.auth').show();
            $('#amount').val(50);
        }else if (topup_type == "self"){
            $('.upline').hide();
            $('.auth').show();
            $('#amount').val(50);
        }else if (topup_type == "downline"){
            $('.auth').hide();
            $('.upline').show();
            var totalTopupAmount = $('#usercount').val() * 50;
            $('#amount').val(totalTopupAmount);
        }
    }
    function userCountSelection()
    {
        var totalTopupAmount = $('#usercount').val() * 50;
        $('#amount').val(totalTopupAmount);
    }
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
    function sendOTP(){
        var amount = parseFloat($('#amount').val());
        var availableBalanceString = "<?php echo $topupfundbalance; ?>";
        var availableBalance = parseFloat(availableBalanceString.replace(/,/g, ''));
        if (availableBalance < amount) {
            toastr.error("Insufficient Deposit wallet Balance.");
            return false;
        }
        var tfastatus = "{{Auth::user()->google2fa_status}}";
        var user_id =  $("#user_id").val();
        if(user_id == ''){
            return $("#user_id_msg").fadeIn().html('The Station ID field is required.');
        }
        if (amount <= 0) {
            $("#amount_err").html('Please enter a valid amount.');
            setTimeout(function () {
                $("#amount_err").html('');
            }, 2000);
            return false;
        }
        if (amount < 50) {
            $("#amount_err").html('The minimum amount should be at least $50.');
            setTimeout(function () {
                $("#amount_err").html('');
            }, 2000);
            return false;
        }
        if(amount >= 50)
        {
            $('#selftopup').prop('disabled', true);
            if(tfastatus == "disable")
            {
                $.ajax({
                    type:'POST',
                    url:"{{url('/sendOtp-For-SelfTopup')}}",
                    data:{
                        amount: amount,
                        "_token": $('#token').val(),
                    },
                    success:function(response){
                        if(response.code == 200){
// OTP sent successfully

                            $("#exampleModal").modal("show");
                            toastr['success'](response.message);
                            $('#selftopup').prop('disabled', false);
                            $('#selftopupo').prop('disabled', false);
                        }else{
                            $('#selftopup').prop('disabled', false);
                            toastr['error'](response.message)
                        }
                    }
                });
            }
            else{
                $("#exampleModal").modal("show");
            }
        }
    }
    function storeTopup(){
        var amount = parseFloat($('#amount').val());
        var topupType = $('input[name="topup_type"]:checked').val();
        var availableBalanceString = "<?php echo $topupfundbalance; ?>";
        var availableBalance = parseFloat(availableBalanceString.replace(/,/g, ''));
        if (availableBalance < amount) {
            toastr.error("Insufficient Deposit wallet Balance.");
            return false;
        }
        var otp = $("#otp").val();
        var g2fa = $("#otp_2fa").val();
        var getOtp = $("#motp");
        var get2fa = $("#g2fa");
        getOtp.val(otp);
        get2fa.val(g2fa);

        var amount =  $("#amount").val();
        if(topupType == "self")
        {
            if (amount <= 0) {
                $("#amount_err").html('Please enter a valid amount.');
                setTimeout(function () {
                    $("#amount_err").html('');
                }, 2000);
                return false;
            }
            if (amount < 50) {
                $("#amount_err").html('Minimum amount should be least 50 or more.');
                setTimeout(function () {
                    $("#amount_err").html('');
                }, 2000);
                return false;
            }
            if(amount >= 50)
            {
                var formData = new FormData($('#topup_form')[0]);
                $('#selftopup').prop('disabled', true);
                $('#selftopupo').prop('disabled', true);
                $.ajax({
                    type:'POST',
                    url:"{{url('/store-self-topup')}}",
                    data:formData,
                    processData: false,
                    contentType: false,
                    success:function(response){
                        if(response.code == 200){
                            $('#exampleModal').modal('hide');
                            toastr.success(response.message);
                            setTimeout(function () {
                                window.location.replace("{{url('/topup-report')}}");
                            }, 50);

                        }else{
                            $('#selftopup').prop('disabled', false);
                            $('#selftopupo').prop('disabled', false);
                            $("#otp").val('');
                            toastr['error'](response.message)
                        }
                    }
                });
            }
        }
        else{
            if (amount <= 0) {
                $("#amount_err").html('Please enter a valid amount.');
                setTimeout(function () {
                    $("#amount_err").html('');
                }, 2000);
                return false;
            }
            var totalTopupAmount = $('#usercount').val() * 50;
            if (amount < totalTopupAmount) {
                $("#amount_err").html('Minimum amount should be least '+totalTopupAmount+' or more.');
                setTimeout(function () {
                    $("#amount_err").html('');
                }, 2000);
                return false;
            }
            var formData = new FormData($('#topup_form')[0]);
            $('#selftopup').prop('disabled', true);
            $('#selftopupo').prop('disabled', true);
            $.ajax({
                type:'POST',
                url:"{{url('/store-strucutre-with-topup')}}",
                data:formData,
                processData: false,
                contentType: false,
                success:function(response){
                    if(response.code == 200){
                        $('#exampleModal').modal('hide');
                        toastr.success(response.message);
                        setTimeout(function () {
                            location.reload();
                            window.location.replace("{{url('/downline-topup-report')}}");
                        }, 50);
                    }else{
                        $('#selftopup').prop('disabled', false);
                        $('#selftopupo').prop('disabled', false);
                        $("#otp").val('');
                        toastr['error'](response.message)
                    }
                }
            });
        }
    }

    function checkUserExistedNew(){
        var user_id = $('#user_id').val();
        $.ajax({
            type:'POST',
            url:"{{url('/downline')}}",
            data:{user_id:user_id, "_token": $('#token').val()},
            success:function(response){
                if(response.code == '200'){
                    $('#selftopup').prop('disabled', false);
                    $("#user_id_msg").fadeIn().html('');
                }
                else{
                    $("#user_id_msg").fadeIn().html(response.message);
                    $('#selftopup').prop('disabled', true);
                }
            }
        });
    }
</script>
@endsection
