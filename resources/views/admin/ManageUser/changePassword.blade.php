@extends('layouts.user_type.admin-app')
@section('content')
<div class="row">
    <div class="admin-card-button">
        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="sendAdminOtp(8)">
            Send Otp
        </button>
        <p>Note :- Otp Valid 2 Hours</p>
    </div>
    <div class="col-8 mx-auto">
        <div class="admin-card">
            <div class="admin-card-header">
                <h4 class="card-title">Change Password</h4>
            </div>
            <input type="hidden" id="user_id" name="id" value="" />
            <div class="admin-card-body">
                <form class="row g-3" id="change-user-password">
                    <div class="col-6">
                    <label> Station ID </label>
                        <div class="input-group">
                        <input type="text" class="admin-form-control" id="username" placeholder="Station ID" value="" autocomplete="off"
                            onblur="checkUserExistedM(this.value)" />
                        </div>
                    </div>
                    <div class="col-6">
                        <label> Fullname </label>
                        <div class="input-group">
                            <input type="text" class="admin-form-control" id="fullname" readonly="" />
                        </div>
                    </div>
                    <div class="col-6">
                        <label> New Password </label>
                        <div class="input-group">
                        <input name="new_password" class="admin-form-control" placeholder="New Password" id="password"
                            type="password" value="" onblur="onPassword(this.value)" />
                        <span class="input-group-text" id="opass">
                            <i class="fa-solid fa-face-smile-beam"></i>
                        </span>
                        </div>

                    </div>
                    <div class="col-6">
                        <label> Confirm Password </label>
                        <div class="input-group">
                        <input name="retype_password" class="admin-form-control" formcontrolname="retype_password"
                            placeholder="Re-enter Password" id="retype_password" type="password" value=""
                            onblur="matchPassword(this.value)" />
                            <span class="input-group-text" id="opass1">
                                <i class="fa-solid fa-face-smile-beam"></i>
                            </span>
                        </div>

                        <div v-if="errorcpwd !== ''" class="tooltip1">
                            <small class="text-danger"> </small>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label class="control-label text-danger">
                            Enter Otp
                            <span class="madatoryStar text-danger"> *</span>
                        </label>
                        <input class="admin-form-control" name="otp" placeholder="otp" type="text" id="otp"
                            data-vv-as="otp" onkeyup="OtpValidation(this.value)" />
                        <div v-if="otpErr !== ''" class="tooltip1">
                            <span class="text-danger"> </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <p>
                            Note:- Password must be more than 6 characters. It should
                            contain uppercase, lowercase, numerical and special
                            characters.
                        </p>
                    </div>

                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-md  btn-outline-primary" id="signup1"
                            onclick="changeUserPassword(8)" disabled>
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
var base_url = '{{url('/')}}'
var csrf_token = $('meta[name="csrf-token"]').attr('content');

function checkUserExistedM(username) {
    var data = { user_id: username };
    if(username !=''){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        });
          $.ajax({
            type: "POST",
            url: '{{url('/1Rto5efWp86Z/checkuserexist')}}', // replace with the actual URL for the API endpoint
            data: data,
            dataType: "json",
            success: (resp) => {
              if (resp.code === 200) {
                var user_id = resp.data.id;
                var fullname = resp.data.fullname;

                $('#user_id').val(resp.data.id);
                $('#fullname').val(fullname);
                var isAvialable = "Available";
                var type = "success";
              } else {
                var user_id = "";
                var isAvialable = "Not Available";
                var type = "error";
                $('#fullname').val('');
              }
              toastr.remove();
              Command: toastr[type](isAvialable);

              submitButtonVisiblity(isAvialable, user_id);

            },
            error: (err) => {
              //this.$toast.error(err);
            //  Command: toastr['error'](err);
            }
        });
    }else {
        $('#fullname').val('');
        $('#user_id').val('');
    }
}



    function  submitButtonVisiblity(isAvialable, user_id){
        if(isAvialable =='Available'){
            $('#signup1').removeAttr('disabled');
        }
        else{
            $('#signup1').prop('disabled','true');
        }
    }

    function onPassword(pwd) {
        var pwdpattern = new RegExp("^(?=.*[!@#$%^&/*])");
        var errorpwd = '';
        if (pwd == "") {
            errorpwd = "Password should not be blank.";
        } else if (pwd.length < 6) {
            errorpwd = "Password must be more than 6 characters.";
        } else if (pwd.length > 15) {
            errorpwd = "Password must be less than 15 characters.";
        } else if (!/[a-z]/.test(pwd)) {
            errorpwd = "Password must contain at least one lowercase character.";
        } else if (!/[A-Z]/.test(pwd)) {
            errorpwd = "Password must contain at least one uppercase character.";
        } else if (!/[0-9]/.test(pwd)) {
            errorpwd = "Password must contain at least one digit.";
        } else if (!pwdpattern.test(pwd)) {
            errorpwd = "Password must contain at least one special character.";
        }
        if (errorpwd != "") {
            toastr.remove();
            toastr['error'](errorpwd);
            $('#signup1').prop('disabled', true);
        } else {
            $('#signup1').prop('disabled', false);
        }
    }



    function matchPassword(cpwd) {
      //const cpwd = e.target.value;
      var pwd = $('#password').val();
      if (cpwd == "") {
        this.errorcpwd = "Password should not be blank.";
      } else if (cpwd != pwd) {
        this.errorcpwd = "password does not match.";
      } else {
        this.errorcpwd = "";
      }
      if( this.errorcpwd !=""){
      Command: toastr['error'](this.errorcpwd);
    }
    }

    function OtpValidation(OTP) {

      var OTPl = OTP.replace(/ /g, "");
      if (OTPl == "") {
        this.otpErr = "OTP should not be blank.";
      } else {
        this.otpErr = "";
      }


    }


function changeUserPassword() {
  var new_pwd = $('#password').val();
  var conf_pwd = $('#retype_password').val();
  if (new_pwd == conf_pwd) {
    this.isDisabledBtn = false;
    Swal.fire({
      title: "Are you sure?",
      text: "You want to change password!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes!",
      cancelButtonText: "Cancel",
    }).then((result) => {
      if (result.value) {
        var data = {
          id:$('#user_id').val(),
          password: new_pwd,
          confirm_password: conf_pwd,
          otp: $('#otp').val(),
        };

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': csrf_token
        }
        });
        $.ajax({
          url: '{{url('/1Rto5efWp86Z/updateuserpassword')}}',
          method: 'POST',
          data: data,
          success: (resp) => {
            if (resp.code === 200) {
              Command: toastr['success'](resp.message);
                $("#change-user-password").trigger("reset");
                setTimeout(function() {
                    window.location.href ="{{url('1Rto5efWp86Z/user/change-password-report')}}";
                }, 2000);
            } else {
              Command: toastr['error'](resp.message);
            }
          },
          error: (err) => {
            //this.otp = "";
           // this.$toast.error(err);
           // Command: toastr['error'](err);
          }
        });
      }
    });
  } else {
   // this.$toast.error("New Password and Reset Password Not Matched...");
    Command: toastr['error']("New Password and Reset Password Not Matched...");
  }
}
</script>


@endsection
