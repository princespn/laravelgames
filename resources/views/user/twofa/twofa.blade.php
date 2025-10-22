@extends('layouts.user_type.auth-app')
@section('content')
  <?php
    $google2fa_status = Auth::user()->google2fa_status;
  ?>
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>2FA</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">
                        <svg class="stroke-icon">
                          <use href="{{ asset('svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Profile</li>
                    <li class="breadcrumb-item active"> 2FA</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Steps</h4>
                  </div>
                  <div class="card-body">
                    <div class="horizontal-wizard-wrapper vertical-options vertical-variations">
                      <div class="row g-3">
                        <div class="col-xl-3 main-horizontal-header">
                          <div class="nav nav-pills horizontal-options" id="vertical-n-wizard-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="wizard-n-info-tab" data-bs-toggle="pill" href="#wizard-n-info" role="tab" aria-controls="wizard-n-info" aria-selected="true">
                              <div class="horizontal-wizard">
                                <div class="stroke-icon-wizard"><span>1</span></div>
                                <div class="horizontal-wizard-content">
                                  <h6>Step 1</h6>
                                </div>
                              </div>
                            </a>
                            <a class="nav-link" id="bank-n-wizard-tab" data-bs-toggle="pill" href="#bank-n-wizard" role="tab" aria-controls="bank-n-wizard" aria-selected="false">
                              <div class="horizontal-wizard">
                                <div class="stroke-icon-wizard"><span>2</span></div>
                                <div class="horizontal-wizard-content">
                                  <h6>Step 2</h6>
                                </div>
                              </div>
                            </a>
                            <a class="nav-link" id="inquiry-n-wizard-tab" data-bs-toggle="pill" href="#inquiry-n-wizard" role="tab" aria-controls="inquiry-n-wizard" aria-selected="false">
                              <div class="horizontal-wizard">
                                <div class="stroke-icon-wizard"><span>3</span></div>
                                <div class="horizontal-wizard-content">
                                  <h6>Step 3</h6>
                                </div>
                              </div>
                            </a>
                          </div>
                        </div>
                        <div class="col-xl-9">
                          <div class="tab-content dark-field" id="vertical-n-wizard-tabContent">
                            <div class="tab-pane fade show active" id="wizard-n-info" role="tabpanel" aria-labelledby="wizard-n-info-tab">
                              <form class="row g-3 needs-validation" novalidate="">
                                <div class="col-12">
                                  <h5>Download an authentication app for our mobile device</h5>
                                  <p>If you purchased an Annual plan and if you've not canceled the automatic renewal, our license management system automatically</p>
                                </div>
                                <div class="col-12">
                                  <div class="form-check radio radio-primary ps-0 select-account">
                                    <ul class="radio-wrapper">
                                      <li>
                                        <span class="txt-primary fw-bold">
                                          1. Install Google Authenticator on your mobile device.
                                        </span>
                                        <span class="ms-3">Exclusively for our Premium members</span>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="tab-pane fade" id="bank-n-wizard" role="tabpanel" aria-labelledby="bank-n-wizard-tab">
                              <form class="row g-3 needs-validation" novalidate="">
                                <div class="col-12">
                                  <h5>Scan the barcode or enter the key code in your authenticator app</h5>
                                  <p>If you purchased an Annual plan and if you've not canceled the automatic renewal, our license management system automatically</p>
                                </div>
                                <div class="col-12">
                                  <div class="form-check radio radio-primary ps-0 select-account">
                                    <div>
                                      <span class="txt-primary fw-bold">
                                          Open your authenticator app and use your mobile device's camera to scan the QR code below.
                                      </span>
                                    </div>
                                    <div class="mt-3">
                                      <span>Your secret code is : <b id="secretecode"></b></span>
                                      <div class="border">
                                       <div id="myqrcode"></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="tab-pane fade" id="inquiry-n-wizard" role="tabpanel" aria-labelledby="inquiry-n-wizard-tab">
                              <form class="row g-3 needs-validation" novalidate="">
                                <div class="col-12">
                                  <h5>Enter the six-digit token generated by your app</h5>
                                  <p>If you purchased an Annual plan and if you've not canceled the automatic renewal, our license management system automatically</p>
                                </div>
                                <div class="col-12">
                                  <div class="form-check radio radio-primary ps-0 select-account">
                                    <div class="txt-primary fw-bold">
                                          Enter the six-digit token generated by your app
                                    </div>
                                    <div class="mt-3 mb-2">
                                      <span>Two Factor Auth is {{ucfirst($data['google2fa_status'])}}</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                    <input type="text" maxlength="20" name="token" class="form-control " placeholder="Enter Token" id="otp-input">
                                  </div>
                                  <div class="col-md-8">
                                    <button class="btn btn-primary" type="button" id="fastatusChkOtpButton"></button>
                                  </div>
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
            </div>
          </div>
        </div>
<script>

    var google2fa = '{{ $google2fa_status }}';
    var fastatus  = "";
    var profile;
    getProfileInfo();
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
        {   toastr.remove();
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

</script>


  @endsection
