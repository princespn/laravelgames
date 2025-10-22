@extends('layouts.user_type.auth-app')
@section('content')
<?php
    $query = DB::table('tbl_country_new')
        ->select('iso_code', 'country', 'code')
        ->where('block_country_status', '=', 'Active');
    $getCountry = $query->orderBy('country', 'asc')->get();

    $selectedCountry = DB::table('tbl_country_new')
        ->select('country', 'iso_code', 'code')
        ->where('iso_code', '=', $profile->country)
        ->get();

    $sponsor_id = DB::table('tbl_users')
        ->where('id', '=', $profile->ref_user_id)
        ->pluck('user_id')->first();
    $google2fa_status = Auth::user()->google2fa_status;
?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Profile Management</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('profile')}}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('/svg/icon-sprite.svg#stroke-home')}}"></use>
                            </svg></a></li>
                            <li class="breadcrumb-item">Profile</li>
                            <li class="breadcrumb-item active"> Profile Management</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="edit-profile">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header card-header border-t-primary border-3">
                                <h4 class="card-title mb-0">My Profile</h4>
                                <div class="card-options"><a class="card-options-collapse" href="javascript:void(0)" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                            </div>
                            <div class="card-body">
                                <form>
                                <div class="row mb-2">
                                    <div class="profile-title">
                                        <div class="media">
                                            <img class="img-70 rounded-circle" alt="" src="{{ asset('/images/user.png')}}">
                                            <div class="media-body">
                                                <h4 class="mb-1">{{Auth::user()->fullname}}</h4>
                                                <p>{{Auth::user()->user_id}}</p>
                                                <p>{{Auth::user()->rank}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('/images/usdt_bep.png')}}" width="50">
                                        <span class="txt-primary ms-3">USDT. BEP20</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Fullname</label>
                                    <input class="form-control" disabled="" placeholder="User Name" value="{{Auth::user()->fullname}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email-Address</label>
                                    <input class="form-control" placeholder="your-email@domain.com" disabled="" value="{{Auth::user()->email}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Sponsor ID</label>
                                    <input class="form-control" type="text" disabled="" value="{{$sponsor_id}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Whatsapp Number</label>
                                    <input class="form-control" placeholder="" disabled="" value="{{Auth::user()->mobile}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Country</label>
                                    <select class="form-select" disabled="">
                                        <option>
                                            @if ($profile->country != '')
                                            @if(sizeof($selectedCountry) > 0)
                                            [ {{ $selectedCountry[0]->iso_code }} ] - {{ $selectedCountry[0]->country }} (+ {{ $selectedCountry[0]->code }})
                                            @endif
                                            @endif
                                        </option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <div class="col-xl-8">
               <form class="card" method="POST" action="{{ route('update-profile', $profile->id) }}" id="updateUserData">
                @csrf
                @if(Auth::user()->topup_status == 1)
                    @php
                        $disabled = "disabled";
                        $disabledcountry = "disabled";
                    @endphp
                @else
                    @php
                        $disabled = "";
                        $disabledcountry = "";
                    @endphp
                @endif
                <div class="card-header card-header border-t-primary border-3">
                    <h4 class="card-title mb-0">Edit Profile</h4>
                    <div class="card-options">
                        <a class="card-options-collapse" href="javascript:void(0)" data-bs-toggle="card-collapse">
                            <i class="fe fe-chevron-up"></i>
                        </a>
                        <a class="card-options-remove" href="javascript:void(0)" data-bs-toggle="card-remove">
                            <i class="fe fe-x"></i>
                        </a>
                    </div>
                </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                              <label class="form-label">Station ID</label>
                              <input class="form-control" type="text" value="{{Auth::user()->user_id}}" placeholder="Station ID" readonly="">
                           </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                           <div class="mb-3">
                              <label class="form-label">Email address</label>
                              <input type="text" class="form-control" placeholder="Enter Email ID" name="email" id="email" value="{{ $profile->email }}" {{$disabled}} maxlength="30" />  
                           </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                           <div class="mb-3">
                              <label class="form-label">Full Name</label>
                              <input type="text" class="form-control" placeholder="Enter Full Name"  value="{{ $profile->fullname }}"name="fullname" id="fullname" maxlength="30"
                           onkeypress="return(event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" {{$disabled}} />
                           </div>
                        </div>
                        
                        <div class="col-sm-6 col-md-6">
                           <div class="mb-3">
                              <label class="form-label">Whatsapp Number</label>
                              <input
                                type="text"
                                class="form-control"
                                placeholder="Enter Whatsapp Number"
                               onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57 && (event.target.value).length <23" name="mobile" id="mobile" maxlength="12" value="{{ $profile->mobile }}" {{$disabled}}
                            /> 
                           </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                           <div class="mb-3">
                              <label class="form-label">Country</label>
                              <select class="form-control btn-square" name="country" {{$disabledcountry}}>
                                @if ($profile->country != '')
                                    @if(sizeof($selectedCountry) > 0)
                                        <option value="{{ $profile->country }}" selected>
                                        [ {{ $selectedCountry[0]->iso_code }} ] - {{ $selectedCountry[0]->country }} (+ {{ $selectedCountry[0]->code }})</option>
                                    @endif
                                @else
                                    <option value="null">Select Country</option>
                                @endif
                                @foreach ($getCountry as $val)
                                    <option value="{{ $val->iso_code }}">[ {{ $val->iso_code }} ] -
                                        {{ $val->country }} (+ {{ $val->code }})</option>
                                @endforeach
                            </select>
                           </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                           <div class="mb-3">
                                <label class="form-label">OTP</label>
                                @if ($google2fa_status == 'disable')
                                    <input type="text" id="profile-otp" name="otp" class="form-control w1000" placeholder="Enter OTP" maxlength="6" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" required>
                                @else
                                    <input type="text" name="otp_2fa" id="profile-otp" class="form-control w1000" placeholder="Enter G2FA OTP" maxlength="6" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                                @endif
                                <input type="hidden" name="type" value="user">
                            </div>
                        </div>
                    </div>
                    <span>NOTE: Confirm your email address is accurate; if not, please contact our support team because once you top up, it can't be changed.</span>
                    <div class="card-footer row mt-2">
                        <div class="col-md-6 col-12 pb-3">
                            <a class="btn btn-primary btn-md" href="{{ url('/get-notification') }}" style="padding: 8px; font-size: 13px;">Request for WhatsApp notification</a>
                        </div>
                        <div class="col-md-6 col-12">
                            @if ($google2fa_status == 'disable')
                                <button class="btn btn-primary" type="button" id="resend_otp_profile" onclick="updateUserProfileOtp()" {{$disabled}}>Send OTP</button>
                            @endif
                            <button onclick="editProfileUserData()" type="button" class="btn btn-primary"  {{$disabled}}>Update Profile</button>
                        </div>
                    </div>
                </div>
            </form>

                <form class="card" ethod="POST" id="address_form" action="{{ route('update-profile-address', $profile->id) }}">
                    @csrf
                   <div class="card-header card-header border-t-primary border-3">
                      <h4 class="card-title mb-0">Edit Address</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                  <input type="hidden" name="type" value="address">
                  <div class="card-body">
                     <div class="row">
                     @foreach($getAllCurrency as $cur)
                        @if($cur->currency_code == "USDT.TRC20")
                            <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{$cur->currency_name}} Address</label>
                                <input type="text" class="form-control" placeholder="Enter {{$cur->currency_name}} Address" onblur="validateUSDTTRCAddress()" name="usdt_trc20_address" id="usdt_trc20_address" value="{{ $profile->usdt_trc20_address }}" minlength="26" maxlength="50"
                                    onkeypress="return  (event.charCode > 64 && event.charCode < 91)|| (event.charCode > 96 && event.charCode < 123)||(event.charCode > 47 && event.charCode < 58) && (event.target.value).length <=45"
                                />
                            <p class="text-danger text-xs mt-2" id="usdt_trc20_address_error"></p>
                            </div>
                            </div>
                        @elseif($cur->currency_code == "USDT.BEP20")
                            <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">USDT.BEP20 Address</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter USDT.BEP20 Address"
                                onblur="validateUSDTBEPAddress()" name="usdt_bep20_address" id="usdt_bep20_address" value="{{ $profile->usdt_bep20_address }}" minlength="20" maxlength="50"
                                    onkeypress="return (event.charCode > 64 && event.charCode < 91)|| (event.charCode > 96 && event.charCode < 123)||(event.charCode > 47 && event.charCode < 58) && (event.target.value).length <=45"
                                />
                            <p class="text-danger text-xs mt-2" id="usdt_bep20_address_error"></p>
                            </div>
                            </div>
                        @elseif($cur->currency_code == "BTC")
                            <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">BTC Address</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter BTC Address"
                                onblur="btcAddressValidate()" name="btc_address" id="btc_address" value="{{ $profile->btc_address }}" minlength="20" maxlength="50"
                                    onkeypress="return (event.charCode > 64 && event.charCode < 91)|| (event.charCode > 96 && event.charCode < 123)||(event.charCode > 47 && event.charCode < 58) && (event.target.value).length <=45"
                                />
                            <p class="text-danger text-xs mt-2" id="btc_address_error"></p>
                            </div>
                            </div>
                        @elseif($cur->currency_code == "TRON")
                            <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{$cur->currency_name}} Address</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter {{$cur->currency_name}} Address"
                                 name="trn_address" id="trn_address" value="{{ $profile->trn_address }}" minlength="20" maxlength="50"
                                    onkeypress="return (event.charCode > 64 && event.charCode < 91)|| (event.charCode > 96 && event.charCode < 123)||(event.charCode > 47 && event.charCode < 58) && (event.target.value).length <=45"
                                />
                            <p class="text-danger text-xs mt-2" id="trn_address_error"></p>
                            </div>
                            </div>
                        @endif
                    @endforeach

                        
                        <div class="col-md-6 col-sm-6">
                           <div class="mb-3">
                              <label class="form-label">Enter OTP</label>
                              @if ($google2fa_status == 'disable')
                                <input type="text" id="address-otp" name="otp" class="form-control w1000" placeholder="Enter OTP" maxlength="6" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" required>
                            
                            @else
                                <input type="text" name="otp_2fa" id="address-otp" class="form-control w1000" placeholder="Enter G2FA OTP" maxlength="6" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                            @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer text-end">
                    @if ($google2fa_status == 'disable')
                    <button id="updateAddressOtp" type="button" onclick="updateCoinAddressOtp()" class="btn btn-primary">Send OTP</button>
                    @endif
                    <button onclick="updateCoinAddress()" type="button" class="btn btn-primary" id="updateAddressBTN">Update Address</button>
                  </div>
               </form>
            </div>
            </div>

           <div class="row">
                <div class="col-md-12">
                    <form class="card" id="passwordForm" method="POST" action="{{ route('update-password', $profile->id) }}">
                    @csrf
                 <div class="card height-equal">
                  <div class="card-header border-l-primary border-3">
                    <h4>Change Password</h4>
                  </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                              <label class="form-label">Old Password*</label>
                            <div class="input-group">
                                    <input name="current_password" class="form-control" placeholder="Old Password" maxlength="30" id="old_password" type="password" onkeyup="oldpasswordvalidate()" />
                                    <span class="input-group-text" id="opass">
                                        <i class="fa fa-eye-slash"></i>
                                    </span>
                                </div>
                            <span id="oPassError" class="error-msg-size tooltip-inner text-danger"></span>
                        </div>
                        <div class="col-lg-4">
                           <div class="auth-pass-inputgroup">
                              <label for="password-input" class="form-label">New Password*</label>
                                <div class="input-group">
                                    <input name="new_password"
                                    class="form-control form-input pass-input text-dark"
                                    placeholder=" New Password" maxlength="16" id="new_password" type="password" onkeyup="newpasswordvalidate()" required />
                                     <span class="input-group-text" id="opass1">
                                        <i class="fa fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                                <span id="nPassError" class="error-msg-size tooltip-inner text-danger"></span>
                        </div>
                            <div class="col-lg-4">
                            <div class="auth-pass-inputgroup">
                              <label for="confirm-password-input" class="form-label">Confirm Password*</label>
                                <div class="input-group">
                                  <input name="confirm_password" class="form-control form-input pass-input text-dark" placeholder="Confirm Password" maxlength="15" id="confirm_password" onkeyup="confirmpasswordvalidate()" type="password" required />
                                 <span class="input-group-text" id="opass2">
                                    <i class="fa fa-eye-slash"></i>
                                </span>
                                </div>
                            </div>
                                <span id="cPassError" class="error-msg-size tooltip-inner text-danger"></span>
                            </div>
                             <input type="hidden" id="passwordOtp" name="otp">
                             <input type="hidden" id="password2fa" name="otp_2fa">
                              <ol class="list-group list-group-numbered">
                      <li class="list-group-item txt-primary fw-bold">*Minimum 8 characters</li>
                      <li class="list-group-item txt-danger fw-bold">*At lowercase letter (a-z)</li>
                      <li class="list-group-item txt-success fw-bold">*At least uppercase letter (A-Z)</li>
                      <li class="list-group-item txt-warning fw-bold">*A least number (0-9) </li>
                    </ol>
                </div>
                        <div class="card-footer text-end">
                     <button class="btn btn-primary" id="sendPasswdOtp" type="button" onclick="sendOTPPassword()">Change Password</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- Container-fluid Ends-->
</div>
     </div>
     </div>
     </div>
     </div>
     </div>
<!-- model for change password  -->

    <div class="modal fade enterOTP modal-bookmark" id="enterPassword" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileLabel">Enter Otp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-4 border-bottom-input z-index-999-relative">
                        <div class="col-md-12">
                            <div class="">
                                <div class="col-md-12">
                                @if ($google2fa_status == 'disable')
                                <input type="text" id="pass-otp" name="otp" class="form-control w1000" placeholder="Enter OTP" maxlength="6" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" required>
                                <span class="error-msg-size tooltip-inner text-dark">OTP sent to
                                    @php
                                        $email = Auth::user()->email;
                                        $modifiedEmail = substr_replace($email, "********", 4, 8); 
                                    @endphp
                                    {{ $modifiedEmail }}
                                </span>
                            @else
                                <input type="text" name="otp_2fa" id="pass-otp" class="form-control w1000" placeholder="Enter G2FA OTP" maxlength="6" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                            @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="updateUserPassword()" type="button">Submit</button>
                    @if ($google2fa_status == 'disable')
                    <button class="btn btn-primary" id="enterOTP" onclick="sendOTPPassword()" type="button">Resend</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--end  model for change password  -->
<script>


    $(document).ready(function() {

    getProfileInfo();
    $('#enterPassword').modal('hide');
    $('#changeAddress').modal('hide');
    $('#myeditotpmodal').modal('hide');
    $('#profilePhoto').modal('hide');
    $('#exampleModal').modal('hide');
    $('#profileexampleModal').modal('hide');
     $('#updateAddressOtp').prop('disabled', true);
     $('#updateAddressBTN').prop('disabled', true);

        $("#updateUserData").validate({
            rules: {
                fullname:{ 
                  'required':true,
                  minlength: 3
                },
                mobile: {
                    'required': true,
                    minlength: 6,
                    maxlength: 16,
                },
                email:{ 
                    'required':true,
                    email: true,
                    validate_email: true,                   
                },               
            },                
       });


               // Find the carousel element by its ID
               var carousel = document.getElementById("carouselExampleControls1");

                // Check if the carousel exists before attempting to pause it
                if (carousel) {
                // Remove the 'data-bs-ride' attribute to stop auto-scrolling
                carousel.removeAttribute('data-bs-ride');
                }


    });

    var google2fa = '{{ $google2fa_status }}';
    var fastatus  = "";
    var profile;
    function getProfileInfo() {
        $(".load").hide();
        $(".loadUpdate").hide();
     
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        });
      $.ajax({
            type: 'POST',
            url: "{{url('/get-profile-info')}}",
            data: {},
            success: function(response) {
                profile = response.data;
                fastatus = profile.google2fa_status;
                if (fastatus == "disable") {
                    const div = document.getElementById("myqrcode");
                    div.innerHTML = profile.QR_Image;

                    document.getElementById("secretecode").innerHTML = profile.secret;
                    $('#secretecode').val(profile.secret);
                    document.getElementById("fastatusChkOtpButton").innerHTML = "Enable";
                    document.getElementById("fastatusChkOtpButton").onclick = resetG2fa;
                     // document.getElementById("fastatusChkOtpButton").onclick = sendOTP;
                } else {
                    var div = '';
                    document.getElementById("fastatusChkOtpButton").innerHTML = "Disable";
                    document.getElementById("fastatusChkOtpButton").onclick = resetG2fa;
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function resetG2fa()
    { 
        if($('#otp-input').val() == "" && $('#otp-input').val().length < 6)
        {
            return toastr.error("Please Enter TOKEN First");
        }
        var data;
        var token = "{{$data['token']}}";      
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': csrf_token
            }
        });

        if('{{Auth::user()->google2fa_status}}' == 'disable')
        {        
            data = {
              google2fa_secret: profile.secret,
              token: $('#otp-input').val(),
              resettoken: "",
              disable: 1
            }
        }else {
            data = {
                google2fa_secret: profile.secret,
                token: $('#otp-input').val(),
                resettoken: token,
                disable: 0
            }
        }
        $.ajax({
            url: "{{url('/reset-g2fa-user')}}",
            type: 'POST',
            data:data,
            success: function(response) {
                if (response.code == 200) {
                    toastr.success(response.message);
                    var urlforredirect = "{{url('/profile')}}";
                    setTimeout(function() {
                        window.location.href = urlforredirect;
                    }, 50);
                } else if (response.code == 401) {
                  toastr.error(response.message);
                    localStorage.removeItem('user-token');
                    localStorage.removeItem('check-in');
                    location.reload();
                } else {
                  toastr.error(response.message);
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    function btcAddressValidate(){                 
        var csrf_token = "{{ csrf_token() }}";
        var data = {"btc_address" : $('#btc_address').val()};
          if ($('#btc_address').val() == '') {
            $('#btc_address_error').html('');
            $('#updateAddressOtp').prop('disabled', false);
            $('#updateAddressBTN').prop('disabled', false);
            return false;
        }
        $('#updateAddressOtp').prop('disabled', true);
        $('#updateAddressBTN').prop('disabled', true);
        $.ajax({
            url: "{{ url('/btcAddressValidate') }}",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            data: data,
            success: function(response) {
                if(response.code == 200)
                {
                toastr.success(response.message);
                $('#btc_address_error').html('');
                $('#updateAddressOtp').prop('disabled', false);
                $('#updateAddressBTN').prop('disabled', false);
                }
                else{
                     $('#btc_address_error').show();
                    // toastr.error(response.message);
                    $('#btc_address_error').html(response.message);                    
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

    function validateMaticAddress(){      
        var csrf_token = "{{ csrf_token() }}";
        var data = {"matic_address" : $('#matic_address').val()};
        if ($('#matic_address').val() == '') {
            $('#matic_address_error').html('');
            $('#updateAddressOtp').prop('disabled', false);
            $('#updateAddressBTN').prop('disabled', false);
            return false;
        }
        $('#updateAddressOtp').prop('disabled', true);
        $('#updateAddressBTN').prop('disabled', true);
        $.ajax({
            url: "{{ url('/validateMATICAddress') }}",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            data: data,
            success: function(response) {
                if(response.code == 200)
                {
                    toastr.success(response.message);
                    $('#matic_address_error').html('');
                    $('#updateAddressOtp').prop('disabled', false);
                    $('#updateAddressBTN').prop('disabled', false);
                }
                else{
                    $('#matic_address_error').show();
                    $('#matic_address_error').html(response.message);                    
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

    function validateUSDTTRCAddress(){      
        var csrf_token = "{{ csrf_token() }}";
        var data = {"usdt_trc20_address" : $('#usdt_trc20_address').val()};
        if ($('#usdt_trc20_address').val() == '') {
            $('#usdt_trc20_address_error').html('');
            $('#updateAddressOtp').prop('disabled', false);
            $('#updateAddressBTN').prop('disabled', false);
            return false;
        }
        $('#updateAddressOtp').prop('disabled', true);
        $('#updateAddressBTN').prop('disabled', true);
        $.ajax({
            url: "{{ url('/validateUSDTTRCAddress') }}",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            data: data,
            success: function(response) {
                if(response.code == 200)
                {
                    toastr.success(response.message);
                    $('#usdt_trc20_address_error').html('');
                    $('#updateAddressOtp').prop('disabled', false);
                    $('#updateAddressBTN').prop('disabled', false);
                }
                else{
                    $('#usdt_trc20_address_error').show();
                    $('#usdt_trc20_address_error').html(response.message);                    
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }


    function validateUSDTBEPAddress(){      
        var csrf_token = "{{ csrf_token() }}";
        var data = {"usdt_bep20_address" : $('#usdt_bep20_address').val()};


        if(data.usdt_bep20_address.startsWith('0x')) {
                if ($('#usdt_bep20_address').val() == '') {
                $('#usdt_bep20_address_error').html('');
                $('#updateAddressOtp').prop('disabled', false);
                $('#updateAddressBTN').prop('disabled', false);
                return false;
                }
                $('#updateAddressOtp').prop('disabled', true);
                $('#updateAddressBTN').prop('disabled', true);
                $.ajax({
                    url: "{{ url('/validateUSDTBEPAddress') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    },
                    data: data,
                    success: function(response) {
                        if(response.code == 200)
                        {
                            toastr.success(response.message);
                            $('#usdt_bep20_address_error').html('');
                            $('#updateAddressOtp').prop('disabled', false);
                            $('#updateAddressBTN').prop('disabled', false);
                        }
                        else{
                            $('#usdt_bep20_address_error').show();
                            $('#usdt_bep20_address_error').html(response.message);                    
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
        } else {
            $('#updateAddressOtp').prop('disabled', true);
            $('#updateAddressBTN').prop('disabled', true);
            $('#usdt_bep20_address_error').show();
            $('#usdt_bep20_address_error').html("Address Must start with 0x");
        }
        
    }




    
            var showpassword = 0;
            $("#opass").click(function() {
                var eye = $("#opass i");
                if (showpassword == 0) {
                    $("#old_password").attr("type", "text");
                    eye.removeClass("fa fa-eye-slash").addClass("fa fa-eye");
                    showpassword = 1;
                } else if (showpassword == 1) {
                    $("#old_password").attr("type", "password");
                    eye.removeClass("fa fa-eye").addClass("fa fa-eye-slash");
                    showpassword = 0;
                }
            });
            $("#opass1").click(function() {
                var eye = $("#opass1 i");

                if (showpassword == 0) {
                    $("#new_password").attr("type", "text");
                    eye.removeClass("fa fa-eye-slash").addClass("fa fa-eye");
                    showpassword = 1;
                } else if (showpassword == 1) {
                    $("#new_password").attr("type", "password");
                    eye.removeClass("fa fa-eye").addClass("fa fa-eye-slash");
                    showpassword = 0;
                }
            });
            $("#opass2").click(function() {
                var eye = $("#opass2 i");

                if (showpassword == 0) {
                    $("#confirm_password").attr("type", "text");
                    eye.removeClass("fa fa-eye-slash").addClass("fa fa-eye");
                    showpassword = 1;
                } else if (showpassword == 1) {
                    $("#confirm_password").attr("type", "password");
                    eye.removeClass("fa fa-eye").addClass("fa fa-eye-slash");
                    showpassword = 0;
                }
            });

            

    function updateUserProfileOtp() { 
        $('#resend_otp_profile').prop('disabled', true);       
        $('#resend_otp_profile').text('Processing..');       
        if (google2fa == 'disable') {
            var csrf_token = "{{ csrf_token() }}";
            $.ajax({
                url: "{{ url('/sendOtp-update-user-password') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                success: function(response) {
                    $('#resend_otp_profile').prop('disabled', false);
                    $('#resend_otp_profile').text('Send OTP');   
                    toastr.success(response.message);
                },
                error: function(xhr, status, error) {
                    $('#resend_otp_profile').prop('disabled', false);
                    $('#resend_otp_profile').text('Send OTP');   
                    console.log(error);
                }
            });
        }
        $("#myeditotpmodal").modal('show');
    }           

    function editProfileUserData() {
        if($("#updateUserData").valid()){
            
                
                    var otp = $("#profile-otp").val();
                    var getOtp = $("#editprofileotp");
                    getOtp.val(otp);
                    var form = $('#updateUserData');
                    var url = form.attr('action');
                    var method = form.attr('method');
                    var data = form.serialize();
                    if(otp.length < 6 ){
                        toastr.error("OTP fields must be least 6 character");
                        return false;
                    }
                    $.ajax({
                        url: url,
                        type: method,
                        data: data,
                        success: function(response) {
                            if(response.code == 200){
                                toastr.success(response.message);
                                $("#profile-otp").val('');
                                location.reload();
                            }else{
                                toastr.error(response.message);
                                $("#profile-otp").val('');
                            }
                        }
                    });
             
        
    }
}

            function oldpasswordvalidate()
            {
                var oldpassword = $("#old_password").val();
                if(oldpassword.length < 6)
                {
                        $('#oPassError').show();
                        $('#oPassError').html("Please Enter Valid Old Password");
                        return false;
                }
                else{
                        $('#oPassError').hide();
                        return true;
                }
            }

            function newpasswordvalidate() {
                var newpassword = $("#new_password").val();
                if (newpassword.length < 8) {
                    $('#nPassError').show();
                    $('#nPassError').html("Please enter atleast 8 characters.");
                    return false;
                } else if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]*$/.test(newpassword)) {
                    $('#nPassError').hide();
                    return true;
                } else {
                    $('#nPassError').html("The password must contain atleast one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&)");
                    return false;
                }
            }



            function confirmpasswordvalidate()
            {
                var newpassword = $("#new_password").val();
                var confirmpassword = $("#confirm_password").val();
                if(newpassword != confirmpassword)
                {
                        $('#cPassError').show();
                        $('#cPassError').html("New Password & confirm password doesn't match");
                        return false;
                }
                else{
                        $('#cPassError').hide();
                        return true;
                }
            }

            function sendOTPPassword() {
                    
                    removeothermodal()

                    var oldpassword_validator = this.oldpasswordvalidate();
                    var newpassword_validator = this.newpasswordvalidate();
                    var confirmpassword_validator = this.confirmpasswordvalidate();

                    if(oldpassword_validator && newpassword_validator && confirmpassword_validator)
                    {
                        $('#enterOTP').prop('disabled', true);
                        if (google2fa == 'disable') {
                            var csrf_token = "{{ csrf_token() }}";
                            $.ajax({
                                url: "{{ url('/sendOtp-update-user-password') }}",
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrf_token
                                },
                                success: function(response) {
                                    console.log(response);
                                    toastr.success(response.message);
                                    $('#enterOTP').prop('disabled', false);
                                },
                                error: function(xhr, status, error) {
                                    console.log(error);
                                }
                            });
                            $("#enterPassword").modal('show');
                            removeothermodal();
                        } else {
                            $("#enterPassword").modal('show');
                            $('#enterOTP').prop('disabled', false);
                            removeothermodal();
                        }
                }
            }


            function updateUserPassword() {
                var otp = $("#pass-otp").val();
                var getOtp = $("#passwordOtp");
                var get2fa = $("#password2fa");
                getOtp.val(otp);
                get2fa.val(otp);
                 if(otp.length < 6 ){
                    toastr.error("OTP fields must be least 6 character");
                    return false;
                }
                $("#passwordForm").submit();
            }

            function ethereum_validator() {
              // Ethereum validator
              var ethereum_validator = true;
              // var ethereumAddressPattern = /^0x[a-fA-F0-9]{24,46}$/;
              var ethereumAddress = $('#ethereum').val();

                if (ethereumAddress.length !== 0) {
                    if ((ethereumAddress.charAt(0) != '0') || (ethereumAddress.charAt(1) != 'x')) {

                      $('#ethereum_error').show();
                      $('#ethereum_error').html("Ethereum Address should start with '0x'");
                      ethereum_validator = false;  

                    } else if (ethereumAddress.length < 26) {
                        $('#ethereum_error').show();
                        $('#ethereum_error').html("Ethereum Address length should be minimum 26");
                        ethereum_validator = false;
                
                     } else {
                        $('#ethereum_error').hide();
                        ethereum_validator = true;
                    }
                }

              return ethereum_validator;
            }


           function btn_address_validator() {
              // Bitcoin address validation
              var btn_address_validator = true;
              var bitcoinAddress = $('#btc_address').val();

              if (bitcoinAddress.charAt(0) != 'b' && bitcoinAddress.charAt(0) != '1' && bitcoinAddress.charAt(0) != '3') {
                $('#btc_address_error').show();
                $('#btc_address_error').html("Bitcoin Address should start with 'b', '1', or '3'");
                btn_address_validator = false;
              } else if (bitcoinAddress.length < 26) {
                $('#btc_address_error').show();
                $('#btc_address_error').html("Bitcoin Address length should be minimum 26");
                btn_address_validator = false;
              } else {
                $('#btc_address_error').hide();
                btn_address_validator = true;
              }

              return btn_address_validator;
            }




            function trn_address_validator()
            {
                //trn address validation
                var trn_address_validator = true;
                var trnAddress = $('#trn_address').val();
                if(trnAddress.length == 0)
                {
                    $('#trn_address_error').hide();
                    trn_address_validator = true;
                }
                else if(trnAddress.length < 26){
                    $('#trn_address_error').show();
                    $('#trn_address_error').html("TRN Address length is minimum 26")
                    trn_address_validator = false;
                }
                else{
                    $('#trn_address_error').hide();
                    trn_address_validator = true;
                }
                return trn_address_validator;
            }

            function doge_address_validator()
            {
                var doge_address_validator = true;
                //doge address validation
                var dogeAddress = $('#doge_address').val();
                if(dogeAddress.length == 0)
                {
                    $('#doge_address_error').hide();
                    doge_address_validator = true;
                }
                else if(dogeAddress.length < 26)
                {
                    $('#doge_address_error').show();
                    $('#doge_address_error').html("length is minimum 26")
                    doge_address_validator = false;
                }
                else{
                    $('#doge_address_error').hide();
                    doge_address_validator = true;
                }
                return doge_address_validator;
            }




            function ltc_address_validator()
            {
                var ltc_address_validator = true;
                //ltc address validation
                var ltcAddress = $('#ltc_address').val();
                if(ltcAddress.length == 0)
                {
                    $('#ltc_address_error').hide();
                    ltc_address_validator = true;
                }
                else if(ltcAddress.length < 26)
                {
                    $('#ltc_address_error').show();
                    $('#ltc_address_error').html("length is minimum 26")
                    ltc_address_validator = false;
                }
                else{
                    $('#ltc_address_error').hide();
                    ltc_address_validator = true;
                }
                return ltc_address_validator;
            }






            function sol_address_validator()
            {
                var sol_address_validator = true;
                //ltc address validation
                var solAddress = $('#sol_address').val();
                if(solAddress.length == 0)
                {
                    $('#sol_address_error').hide();
                    sol_address_validator = true;
                }
                else if(solAddress.length < 26)
                {
                    $('#sol_address_error').show();
                    $('#sol_address_error').html("length is minimum 26")
                    sol_address_validator = false;
                }
                else{
                    $('#sol_address_error').hide();
                    sol_address_validator = true;
                }
                return sol_address_validator;
            }


            function usdt_trc20_address_validator()
            {
                var usdt_trc20_address_validator = true;
                //usdt_trc20_addressAddress validation
                var usdt_trc20_addressAddress = $('#usdt_trc20_address').val();
                if(usdt_trc20_addressAddress.length == 0)
                {
                    $('#usdt_trc20_address_error').hide();
                    usdt_trc20_address_validator = true;
                }
                else if(usdt_trc20_addressAddress.length < 26)
                {
                    $('#usdt_trc20_address_error').show();
                    $('#usdt_trc20_address_error').html("length is minimum 26")
                    usdt_trc20_address_validator = false;
                }
                else{
                    $('#usdt_trc20_address_error').hide();
                    usdt_trc20_address_validator = true;
                }
                return usdt_trc20_address_validator;
            }
             function busd_address_validator() {
              // busd_address validator
              var busd_address_validator = true;
              // var busd_addressAddressPattern = /^0x[a-fA-F0-9]{24,46}$/;
              var busd_addressAddress = $('#busd_address').val();

                if (busd_addressAddress.length !== 0) {
                    if ((busd_addressAddress.charAt(0) != '0') || (busd_addressAddress.charAt(1) != 'x')) {

                      $('#busd_address_error').show();
                      $('#busd_address_error').html("Binance USD Address should start with '0x'");
                      busd_address_validator = false; 

                    } else if (busd_addressAddress.length < 26) {
                        $('#busd_address_error').show();
                        $('#busd_address_error').html("Binance USD Address length should be minimum 26");
                        busd_address_validator = false;
                
                     } else {
                        $('#busd_address_error').hide();
                        busd_address_validator = true;
                    }
                }

              return busd_address_validator;
            }


            function updateCoinAddressOtp() {
                if($('#usdt_bep20_address').val() == '' && $('#btc_address').val() == ''){
                    toastr.error("The fields is blank");
                    return false;
                }                    
                    if (google2fa == 'disable') {
                        $('#updateAddressOtp').prop('disabled', true);
                        $('#updateAddressOtp').text('Processing..');
                        var csrf_token = "{{ csrf_token() }}";
                        $.ajax({

                            url: "{{ url('/sendOtp-update-address') }}",
                            type: 'POST',
                            headers: {

                                'X-CSRF-TOKEN': csrf_token

                            },
                            success: function(response) {
                                $('#updateAddressOtp').prop('disabled', false);
                                $('#updateAddressOtp').text('Send OTP');
                                toastr.success(response.message);
                            }
                        });
                    }
                }

            function updateCoinAddress() {
                var otp = $("#address-otp").val();
                var form = $('#address_form');
                var url = form.attr('action');
                var method = form.attr('method');
                var data = form.serialize();
                if(otp.length < 6 ){
                    toastr.error("OTP fields must be least 6 character");
                    return false;
                }
            
                        $.ajax({
                            url: url,
                            type: method,
                            data: data,
                            success: function(response) {
                                if(response.code == 200){
                                    toastr.success(response.message);
                                    $("#address-otp").val('');
                                    location.reload();
                                }else{
                                    toastr.error(response.message);
                                    $("#address-otp").val('');
                                }
                            }
                        });
                                         
            }



            function removeothermodal(){
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }
                    
                
            }
        </script>
    @endsection
