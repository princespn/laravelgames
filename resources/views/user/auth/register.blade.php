@extends('layouts.user_type.guest-app')
@section('content')
@php
if (request()->input('ref_id') != '' && request()->input('position') != '') {
    $ref_id = request()->input('ref_id');
    $post = request()->input('position');
    $bttn = "disabled";
    $sid = "readonly";
} else {
    $ref_id = '';
    $post = '';
    $bttn = '';
    $sid = '';
}
if ($ref_id == '' && $post == '') {
    $ref_id = old('ref_user_id');
    $post = old('position');
}
@endphp
<style>
    label.error::before {
    content: none !important;
}

.theme-form input{
    cursor: text;";
}
</style>

<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card login-dark">
                <div>
                    <div>
                        <a class="logo" href="{{ url('/')}}">
                            <img class="img-fluid for-dark" src="{{ asset('/images/logo/logo.png') }}" alt="looginpage">
                            <img class="img-fluid for-light" src="{{ asset('/images/logo/logo_dark.png') }}" alt="looginpage">
                        </a>
                    </div>
                    <div class="login-main">
                        <form id="register_form" method="post" action="{{url('/registerUser')}}" class="theme-form row g-2">
                            @csrf
                            <div class="col-12">
                                <h4>Hello, Register With Us!</h4>
                                <p>Register to your account</p>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Sponsor ID *</label>
                                <input type="text" class="form-control" id="referral_id" name="ref_user_id" placeholder="Enter Sponsor Id" value="{{ $ref_id }}" maxlength="30" {{ $sid }} onchange="callinvitationcodevalidation()">
                                    <p class="text-danger" id="isUserAvailable" style="display: none;font-weight: 500;margin-bottom: 5px;font-size: 11px; margin-top: 0px;color: red;!important"> User not available
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Full Name *</label>
                                <input type="text" class="form-control" name="fullname" id="fullname" value="{{ old('fullname') }}"
                                maxlength="20" placeholder="Enter Full Name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                                onkeypress="return(event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" />
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Position *</label>
                                <select class="form-select" id="s_id" value="{{old('position')}}" name="position">
                                    @php
                                      if ($post != '') {
                                      if ($post == 1) {
                                      echo '<option value="1" selected>Left</option>';
                                      } elseif ($post == 2) {
                                      echo '<option value="2" selected>Right</option>';
                                      }
                                      } else {
                                      echo '<option value="">Select Position</option>';
                                      echo '<option value="1" ' . (old('position') == 1 ? 'selected' : '') . '>Left</option>';
                                      echo '<option value="2" ' . (old('position') == 2 ? 'selected' : '') . '>Right</option>';
                                      }
                              @endphp
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Email Address *</label>
                                <input type="email" value="{{ old('email') }}" class="form-control" id="email" name="email" placeholder="Enter Email address" onchange="validateEmailAndSendOtp()"/>
                            </div>
                            <label for="country" class="form-label" style="margin-bottom: -3px; margin-top: 10px;">WhatsApp Number *</label>
                            <div class="col-lg-3 col-3">
                                <div class="input-group">
                                    <select class="form-select" name="country" id="country" required>
                                        <option>Country Code</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-0 col-lg-9 col-9">
                                <div class="input-group ms-1">
                                    <input type="text" value="{{ old('mobile') }}" class="form-control" name="mobile" id="mobile" maxlength="12" placeholder="Enter Your WhatsApp Number" onkeypress=" return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">OTP *</label>
                                    <input type="text" class="form-control" id="otp" name="otp" maxlength="6" placeholder="Enter OTP" />
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">&nbsp;</label>
                                <button type="button" id="resendOtpBtn" class="btn btn-success btn-block w-100" onclick="sendOtp()" disabled style="transition:none !important;overflow:hidden;position:relative;height: 40px; font-size:11px;">Resend OTP</button>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Password *</label>
                                <div class="form-input position-relative">
                                    <input type="password" value="{{ old('password') }}" maxlength="16" class="form-control" id="password" name="password" placeholder="Enter password" />
                                    <div class="show-hide" id="opass" style="cursor: pointer;"> <i class="fas fa-eye-slash"></i></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Confirm Password *</label>
                                <div class="form-input position-relative">
                                    <input type="password" value="{{ old('password_confirmation') }}" class="form-control" id="confirmpassword" name="password_confirmation" placeholder="Confirm password" />
                                    <div class="show-hide" id="opass1" style="cursor: pointer;"> <i class="fas fa-eye-slash"></i></div>
                                </div>
                            </div>
                            <span class="fs-14">Note: Password must be 8–16 characters, include at least one uppercase letter, one number, and one special character.</span>
                            <div class="form-group mb-0">
                                <div class="checkbox p-0">
                                    <input id="terms_condition" type="checkbox" name="terms_condition" class="form-checkbox">
                                    <label for="terms_condition" class="text-muted">
                                        Agree with <a class="ms-2" href="#">Privacy Policy</a>
                                    </label>
                                    <label id="terms_condition-error" class="error" for="terms_condition"></label>
                                </div>
                            </div>
                            <!--<div class="mb-0 col-lg-12">
                               <label class="col-form-label">Human Check </label>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div id="ts_container_wrapper" style="display: flex; align-items: center; gap: 10px; width: 100%;">
                                        <div id="ts_container" class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}" data-callback="onTurnstileSuccess"></div>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" id="refresh-captcha" title="Refresh Captcha" >↻</button>
                                    </div>
                                </div>
                                <span class="text-danger" id="turnstile_error"></span>
                            </div>-->
                            <button class="btn btn-primary btn-block w-100" type="submit" id="save_btn">Create Account</button>
                            <p class="mt-4 mb-0">Already have an account?<a class="ms-2" href="{{ url('/login') }}">Sign in</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>


<script>
var base_url = '{{url('/')}}'
var csrf_token = $('meta[name="csrf-token"]').attr('content');

let turnstileToken = "";
  function onTurnstileSuccess(token) {
    turnstileToken = token; // Cloudflare gives us the token here
  }

  document.querySelectorAll("input, select, textarea").forEach(function (element) {
    element.addEventListener("input", function () {
        let errorId = element.id + "_error";

        // Special cases mapping
        if (element.id === "s_id") errorId = "position_error";
        if (element.id === "referral_id") errorId = "isUserAvailable";

        let errorElement = document.getElementById(errorId);
        if (errorElement) {
            errorElement.textContent = "";
        }
    });

    // For select dropdown, better to listen to "change" event too
    element.addEventListener("change", function () {
        let errorId = element.id + "_error";
        if (element.id === "s_id") errorId = "position_error";
        let errorElement = document.getElementById(errorId);
        if (errorElement) {
            errorElement.textContent = "";
        }
    });
});



// Custom validation for Sponsor ID (ref_user_id)
function callinvitationcodevalidation() {
    var userId = document.getElementById("referral_id").value;
    
    // Make an AJAX request to check if the sponsor ID is valid
    $.ajax({
        url: base_url + "/checkuserexist",
        type: "POST",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": csrf_token
        },
        data: { user_id: userId },
        success: function(data) {
            if (data.code == 200) {
                // Sponsor is available
                $("#isUserAvailable").css('display', 'block');
                $("#isUserAvailable").removeClass('text-danger').addClass('text-success');
                $("#isUserAvailable").text('Sponsor Available');
                $("#save_btn").attr('disabled', false); // Enable submit button
            } else {
                // Sponsor not available
                $("#isUserAvailable").removeClass('text-success').addClass('text-danger');
                $("#isUserAvailable").css('display', 'block');
                $("#isUserAvailable").text(data.message);
                $("#save_btn").attr('disabled', true); // Disable submit button
            }
        }
    });
}

 $(document).ready(function() {
        $('#register_form').validate({
            errorPlacement: function (error, element) {
                if (element.closest('.input-group').length) {
                   error.insertAfter(element.closest('.input-group'));
                } else if (element.closest('.form-input').length) {
                   error.insertAfter(element.closest('.form-input'));
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
               position: {
                 required: true,
               },
                ref_user_id: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                    validate_email: true,
                },
                country: {
                    required: true,
                },
                mobile: {
                    required: true,
                    minlength: 6,
                    maxlength: 16,
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password",
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 16,
                    strongPassword : true
                },
                terms_condition: {
                    required: true,
                },
                otp: {
                    required: true,
                }
            },
            messages:{
               fullname: {
                  required: "Full name is required.",
               },

               pan_no: {
                  required: "PAN Number is required.",
               },
               ref_user_id: {
                  required: "Sponsor Id is required.",
               },
               email: {
                  required: "Email is required.",
               },
               country: {
                  required:"Country is required.",
               },

               mobile: {
                  required: "Mobile number is required.",
               },
               password: {
                  required: "Password is required.",
               },
               password_confirmation: {
                  equalTo: "Your passwords do not match",
                  required:"Confirm password is required.",
               },

               terms_condition: {
                  required:"Please check terms and conditions",
               },
            },
            submitHandler: function(form) {
                const tError = document.getElementById("turnstile_error");
                if (!turnstileToken) {
                    if (tError) {
                        tError.textContent = "Please complete the human check.";
                        return false;
                    }
                }
               $.ajax({
                    url: base_url + "/registerUser",
                    type: "POST",
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrf_token
                    },
                    data: {
                      ref_user_id: $('#referral_id').val(),
                      country: $('#country').val(),
                      mobile: $('#mobile').val(),
                      email: $('#email').val(),
                      password: $('#password').val(),
                      position: $('#s_id').val(),
                      otp: $('#otp').val(),
                      fullname: $('#fullname').val(),
                      'cf-turnstile-response': turnstileToken
                    },
                    success: function(data) {
                        if (data.code == 200) {
                            toastr.success("Registration successful.");
                            window.location.href = `${base_url}/thank-you?user_id=${data.data.userid}&password=${data.data.password}&email=${data.data.email}`;
                        } else {
                          {{-- toastr.error("There was an error while registration, please try again after sometime."); --}}
                          toastr.error(data.message);
                        }
                    }
                });
            }
        });
    });


$(document).ready(function() {
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    var userCountryCode = null;
    $.get("https://ipapi.co/json/", function(locationData) {
        userCountryCode = locationData.country_code;
        $.ajax({
            url: base_url + '/country',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            success: function(data) {
                var $countrySelect = $('#country');
                $countrySelect.empty(); // Clear old options

                $.each(data.data.country_list, function(key, value) {
                    var option = $('<option>', {
                        value: value.iso_code,
                        text: value.country
                    });

                    // Auto-select based on IP
                    if (value.iso_code === userCountryCode) {
                        option.attr('selected', true);
                    }

                    $countrySelect.append(option);
                });
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }).fail(function() {
        console.warn("Could not detect location from IP. Default will be GB.");
        userCountryCode = "GB";
    });
});


// Function to validate email and send OTP if valid
function validateEmailAndSendOtp() {
    var email = document.getElementById("email").value;

    // Validate email format
    if (validateEmail(email)) {
        sendOtp(email);  // Send OTP if the email is valid
    } else {
        document.getElementById("email_error").textContent = "Please enter a valid email address.";
    }
}

// Email validation function
function validateEmail(email) {
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return emailRegex.test(email);
}

// Function to send OTP
function sendOtp(email) {
    $.ajax({
        url: base_url + "/sendRegistrationOtpOnMail",
        type: "POST",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": csrf_token
        },
        data: { emailid: $('#email').val() },
        success: function(data) {
            if (data.code === 200) {
                toastr.success("OTP has been sent to your email.");
                startOtpTimer();
            } else {
                toastr.error(data.message);
            }
        },
        error: function(xhr, status, error) {
            toastr.error("There was an error sending OTP.");
        }
    });
}

// Timer to handle Resend OTP button disable/enable
function startOtpTimer() {
    var resendBtn = document.getElementById('resendOtpBtn');
    var timeRemaining = 30;  // 30 seconds countdown

    // Disable the button initially
    resendBtn.disabled = true;
    resendBtn.innerHTML = "Resend OTP ( Wait " + timeRemaining + " sec)";

    // Update the countdown every second
    var countdown = setInterval(function() {
        timeRemaining--;
        resendBtn.innerHTML = "Resend OTP ( Wait " + timeRemaining + " sec)";

        // When the timer reaches 0, stop the countdown and enable the button
        if (timeRemaining <= 0) {
            clearInterval(countdown);
            resendBtn.disabled = false;
            resendBtn.innerHTML = "Resend OTP";
        }
    }, 1000);  // Update every 1 second
}

$(document).ready(function() {
   // ...existing code...
   $('#refresh-captcha').on('click', function() {
      // Remove the current captcha block and add a new one in its place
      $('#ts_container').remove();
      $('#ts_container_wrapper').prepend('<div id="ts_container" class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}" data-callback="onTurnstileSuccess"></div>');
      if (typeof turnstile !== 'undefined') {
         turnstile.render(document.getElementById('ts_container'));
      }
   });
});


</script>
@endsection
