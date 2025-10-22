@extends('layouts.user_type.admin-app')
@section('content')
<style>
    option{
        padding: 10px;
    }
</style>


    <div class="row">
        <div class="page-header-title">
            <h4 class="page-title">Add Buying</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-sm-6">
            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="sendAdminOtp(6)">Send Otp </button>
            <p>Note :- Otp Valid 2 Hours</p>
        </div>
    </div>



    <div class="row">
        <div class="col-6 mx-auto">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h4 class="card-title">Add Special Buying</h4>
                </div>

                <div class="admin-card-body">
                    <form id="change-user-password" >
                        <!-- <div class="col-md-5 col-md-offset-3"> -->

                        <input type="hidden" name="user_id" id="user_id" value="">

 
                        <div class="form-group">
                            <label>To Station ID</label>
                            <input type="text" class="admin-form-control" id="to_user_id" placeholder="Station ID"
                                   name="to_user_id"  onkeyup="checkUserExistedm(this.value)" data-vv-as="username" value="">
                        </div> 

                        
                        <!-- <div class="form-group">
                            <label>Station ID</label>
                            <input type="text" class="admin-form-control" id="to_username" placeholder="Station ID"
                                   name="to_username"  onkeyup="checkUplineUserExistedm(this.value)" data-vv-as="username" value="">
                        </div>
                         -->
                        <div class="form-group">
                            <label for="amount">Enter Amount</label>
                            <input type="text" class="admin-form-control" id="amount" name="amount" v-model="amount"
                                   placeholder="Enter amount & Buy">
                        </div>
                        
                        <div class="form-group">
                        <label for="amount">Binary Deduction %</label>
                        <input type="number" class="admin-form-control" name="binary_deduction_percent" id="binary_deduction_percent" placeholder="Binary Deduction %" readonly />
                        </div>
                        


                        <div class="form-group">
                            <label for="balance">Enter Remark</label>
                            <input type="text" class="admin-form-control" id="remark" name="remark" value=""
                                   placeholder="remark">
                        </div>

                        <div class="form-group">
                            <label>OTP</label>
                            <input type="password" class="admin-form-control" id="otp" placeholder="Enter Otp" name="otp"
                                   v-model="otp" data-vv-as="OTP ">
                        </div>

                        <div class="col-md-offset-5">
                            <!--
                                                    <button :disabled="!isCompleteForm || disablebtn == true" type="button" class="btn btn-primary"
                                                        name="signup1" value="Sign up" @click="addPower"  id="signup1">Submit</button> -->
                            <button disabled type="button" class="btn btn-primary"
                                    name="signup1" value="Sign up" onclick="addPower()"  id="signup1">Submit</button>
                        </div>

                        
                        <input type="hidden" id="id" name="id" value="" />
                        <input type="hidden" id="fullname" name="fullname" value="" />
                        <input type="hidden"  name="type" value="2" />
                        <input type="hidden" name="upline_id" id="upline_id" value="">
                        <input type="hidden" id="uplineusername"name="uplineusername">
                            
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>

        //var base_url = '{{url('/')}}'
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            var data = {
                to_user_id : '',
                user_id : '',
                amount : '',
                otp : '',
                id : '',
                
            }
        });


        function isCompleteForm() {
            var amount = $('#amount').val();
            var type = $('#type').val();
            var username = $('#username').val();
            var uplineusername = $('#uplineusername').val();

            return amount && type && username && uplineusername;
        }


        function checkUserExistedm() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                }
            });
            $.ajax({
                url: '{{url('/1Rto5efWp86Z/checkuserexistforspecialpower')}}',
                method: 'POST',
                data: {
                    user_id: $('#to_user_id').val(),
                    // position: $('#position').val(),
                },
                success: function(resp) {
                    if (resp.code === 200) {
                        $('#id').val(resp.data.id);
                        $('#user_id').val(resp.data.user_id);
                        $('#fullname').val(resp.data.fullname);
                        var binary_deduction_percent = resp.data.binary_deduction_percent;
                        if (binary_deduction_percent > 0) {
                            $('#binary_deduction_percent').val(resp.data.binary_deduction_percent);
                            document.getElementById("binary_deduction_percent").readOnly = true;
                        } else {
                            document.getElementById("binary_deduction_percent").readOnly = false;
                        }
                        var msg = resp.message;
                        var isAvialable = 'Available';
                        var type_name = "success";
                    } else {
                        $('#user_id').val('');
                        $('#binary_deduction_percent').val("");
                        document.getElementById("binary_deduction_percent").readOnly = false;
                        var msg = resp.message;
                        var isAvialable = 'Not Available'
                        var type_name = "error";
                    }
                    submitButtonVisiblity(isAvialable,$('#user_id').val());
                    Command: toastr[type_name](msg);

                },
                error: function(err) {
                    Command: toastr["error"](err);
                }
            });
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

        function addPower() {
            if(this.type == '') {
                this.disablebtn = 0;
                alert("Please Select Type");
                return false;
            }
            this.disablebtn = true;
            var that = this; // save 'this' context
            Swal.fire({
                title: 'Are you sure ?',
                text: "You want to buy for this Id!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.value) {
                    $.ajax({
                        url: "{{url('/1Rto5efWp86Z/specialBuying')}}",
                        type: 'POST',
                        data: $('#change-user-password').serialize(),
                        success: function(response) {
                            if(response.code == 200) {
                                that.otp = '';
                                that.disablebtn = false;
                                Command: toastr['success']("You have buy Successfully...");
                                window.location.href = "special-buying-report";

                            } else {
                                that.otp = '';
                                that.pinvalid = false;
                                that.disablebtn = false;
                                that.message = response.message;
                                Command: toastr['error'](that.message);
                            }
                        },
                        error: function(error) {
                            alert('An error occurred while processing the request. Please try again later.');
                            that.otp = '';
                            that.disablebtn = false;
                        }
                    });
                } else {
                    that.otp = '';
                    return false;
                }
            });
        }

    </script>


@endsection
