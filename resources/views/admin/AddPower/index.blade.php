
@extends('layouts.user_type.admin-app')
@section('content')
    <div class="row">
        <div class="admin-card-button" v-if="otpstatus ==1">
            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="sendAdminOtp(4)">
                Send Otp
            </button>
            <p>Note :- Otp Valid 2 Hours</p>
        </div>
        <div class="col-6 mx-auto">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h4 class="card-title">Add And Remove Business Amount</h4>
                </div>

                <div class="admin-card-body">
                    <form id="add-power-form" onsubmit="event.preventDefault()">
                        <!-- <div class="col-md-5 col-md-offset-3"> -->


                        <!-- <input type="hidden" name="user_id" value="" /> -->
                        {{-- <input type="hidden" name="id" value="" /> --}}
                        <div class="form-group">
                            <label>Station ID</label>
                            <input type="text" class="admin-form-control" id="username" placeholder="Enter Station ID"
                                name="user_id" value=""
                                onblur="checkUserExistedDemo(this.value)"
                                data-vv-as="username">
                        </div>
                        <div class="form-group">
                            <label>Position</label>
                            <select name="position" class="admin-form-control">
                                <option selected value="">Select</option>
                                <option value="2">Right</option>
                                <option value="1">Left</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="power bv">Power Business</label>
                            <input type="text" class="admin-form-control" id="power_bv" name="power_bv" value="" placeholder="Enter BV">

                        </div>

                        <div class="form-group">
                            <label>Type</label>
                            <select name="type" class="admin-form-control">
                                <option selected value="">Select</option>
                                <option value="1">Add Power only Id</option>
                                <option value="3">Remove Power only Id</option>
                            </select>

                        </div>
                        <div class="form-group" v-if="otpstatus ==1">
                            <label>OTP</label>
                            <input type="password" class="admin-form-control" id="otp" placeholder="Enter Otp" name="otp" value=""
                                   data-vv-as="OTP ">
                            <div id="otpErr"></div>
                        </div>

                        <div class="col-md-offset-5">
                            <button id="signup1" type="button" class="btn btn-primary" disabled onclick="addPower()">Submit</button>
                        </div>
                    </form>

                    <script>
                        var base_url = '{{url('/')}}'
                        var csrf_token = $('meta[name="csrf-token"]').attr('content');
                        $(document).ready(function() {
                            var user_id_ext = '';
                            var fullname_ext = '';
                            var username = '';
                            var user_id = '';
                            var position = 1;
                            var power_bv = '';
                            var isAvialable = '';
                            var user = '';
                            var id = '';
                            var disablebtn = false;
                            var pos_avl = '';
                            var optArr = {};
                            var optall = 0;
                            var type = 1;
                            var otp = '';
                            var otpstatus = '';
                        });


                        function addPower() {
                            disablebtn = true;
                            username = '';
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': csrf_token
                                }
                            });

                            $.ajax({
                                url: '{{route('add-power-post')}}',
                                type: 'POST',
                                data: $('#add-power-form').serialize(),
                                success: function(response) {
                                    if (response.code == 200) {
                                        disablebtn = false;
                                        window.location.href = "{{url('/1Rto5efWp86Z/manage-power/power-report')}}";
                                    } else {
                                        // show error message
                                        pinvalid = false;
                                        disablebtn = false;
                                        message = response.message;
                                    }
                                },
                                error: function() {
                                    // show error message
                                    disablebtn = false;
                                }
                            });
                        }



                        function isCompleteForm() {
                            return power_bv && username;

                        }

                        function getAdminOtpstatus() {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': csrf_token
                                }
                            });
                            $.ajax({
                                url: '/1Rto5efWp86Z/get_otp_status',
                                type: 'GET',
                                success: function(resp) {
                                    if (resp.code === 200) {
                                        otpstatus = resp.data.topup_update_status;
                                        // show success message
                                    } else {
                                        // show error message
                                    }
                                },
                                error: function() {
                                    // show error message
                                }
                            });
                        }

                        function OtpValidation() {
                            var OTP = $('#otp').val();
                            var OTPl = OTP.replace(/ /g, "");
                            if (OTPl == "") {
                                var   otpErr = "OTP should not be Blank.";
                            } else {
                                var  otpErr = "";
                            }
                            return otpErr;
                        }

                        //check user
                        function  submitButtonVisiblity(isAvialable, user_id){
                            if(isAvialable =='Available'){
                                $('#signup1').removeAttr('disabled');
                            }
                            else{
                                $('#signup1').prop('disabled','true');
                            }

                        }

                        function checkUserExistedDemo(username) {

                            var data = { user_id: username };

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': csrf_token
                                }
                            });
                            $.ajax({
                                url: '{{url("1Rto5efWp86Z/checkuserexist")}}',
                                type: 'POST',
                                data: data,
                                success: function(resp) {
                                    if (resp.code === 200) {
                                        id = resp.data.id;
                                        user_id = resp.data.user_id;
                                        fullname = resp.data.fullname;
                                        l_bv = resp.data.l_bv;
                                        r_bv = resp.data.r_bv;
                                        l_business = resp.data.l_business;
                                        r_business = resp.data.r_business;
                                        isAvialable = 'Available';

                                        if (resp.data.power_lbv > 0) {
                                            optArr = { 'value': 1, 'pos': 'Left' };
                                        } else if (resp.data.power_rbv > 0) {
                                            optArr = { 'value': 2, 'pos': 'Right' };
                                            position = 2;
                                        } else {
                                            optall = 0;
                                        }
                                        toastr.success(resp.message);
                                    } else {
                                        user_id = '';
                                        isAvialable = 'Not Available';
                                        toastr.error(resp.message);
                                    }
                                    submitButtonVisiblity(isAvialable, user_id, resp);
                                },
                                error: function() {
                                    // show error message
                                }
                            });
                        }



                    </script>

@endsection
