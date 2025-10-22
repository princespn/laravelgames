@extends('layouts.user_type.admin-app')
@section('content')
<div class="row">
    <div class="col-12 mx-auto">
        <div class="admin-card">
            <div class="admin-card-header">
                <h4 class="card-title">Update User Id</h4>
            </div>
            <input type="hidden" id="user_id" name="id" value="" />
            <div class="admin-card-body">
                <form class="row g-3" id="change-user-id">
                    
                    <div class="col-12">
                        <div class="input-group">
                        <input type="text" class="admin-form-control" id="username_top_id" placeholder="Sponsor and Upper ID in Tree" onkeyup="checkUserExistedM(this.value)" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="col-12">
                        <div class="input-group">
                        <input type="number" class="admin-form-control" id="no_of_ids" placeholder="How Many Ids Required"/>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    

                    

                    <div class="col-md-6">
                           <select class="admin-form-select" id="s_id" name="position" aria-label="Default select example">
                                     <option value="" selected>Select Position</option>
                                     <option value="1">Left</option>
                                     <option value="2">Right</option>
                                     <!-- <option value="3">Alternate Left - Right</option>                                        -->
                            </select>
                       </div>

                       <div class="col-md-6">
                           <input type="text" class="admin-form-control" name="fullname" id="fullname"  maxlength="30" onkeypress="return(event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" placeholder="Enter Full Name" required
                           />
                       </div>
                      
                       <div class="col-md-6">
                           <input type="text" class="admin-form-control" data-vv-as="mobile" name="mobile" id="mobile"  maxlength="12"  onkeypress=" return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" placeholder="Enter Your WhatsApp Number" required />
                       </div>

                       <div class="col-md-6">
                           <input type="email" class="admin-form-control" id="email" name="email" placeholder="Enter Email address" maxlength="30" required/>
                       </div> 

                       
                       <div class="col-md-6">
                          <select  class="admin-form-select" name="country" id="country" required>
                               <option >Select Country</option>
                           </select>
                       </div>
                         
                       <div class="col-md-6 mb-3">
                           <!-- <label>Password</label> -->
                           <div class="input-group">
                               <input
                                 type="password"
                                 class="admin-form-control pe-5 password-input"
                                 onpaste="return false"
                                 placeholder="Enter password"
                                 id="password" data-toggle="password" name="password"
                                 aria-describedby="passwordInput"
                                 pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                 maxlength="30"
                                 required
                                 />    
                                   <span class="input-group-text" id="opass">
                                                <i class="fas fa-eye"></i>
                                            </span>                                   
                           </div>
                       </div>
                       

                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-rounded btn-outline-primary" id="signup1"
                            onclick="changeUserId()">
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
    url: '{{url('/1Rto5efWp86Z/checkuserexistfortokenlimit')}}', // replace with the actual URL for the API endpoint
    data: data,
    dataType: "json",
    success: (resp) => {
      if (resp.code === 200) {
        var user_id = resp.data.id;
        var fullname = resp.data.fullname;

        $('#user_id').val(resp.data.id);
        var isAvialable = "Available";
        var type = "success";

        $('#available_sell_tokens').val(resp.data.sell_token);
        $('#available_sell_tokens_limit').val(resp.data.sell_token_limit);
        $('#available_binary_tokens').val(resp.data.sell_binary_token);
        $('#available_binary_tokens_limit').val(resp.data.sell_binary_limit);

      } else {
        var user_id = "";
        var isAvialable = "Not Available";
        var type = "error";
      }
      Command: toastr[type](isAvialable);

      submitButtonVisiblity(isAvialable, user_id);

    },
    error: (err) => {
      //this.$toast.error(err);
    //  Command: toastr['error'](err);
    }
  });
  }

}


var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: base_url + '/country' ,
            type: 'GET',
            success: function(data) {
                $('#country').empty();
                console.log(data.data.location_info.countryCode);
                $.each(data.data.country_list, function(key, value) {

                    if("IN" == value.iso_code)
                    {
                        console.log("Called this loop");
                        $('#country').append($('<option>', {
                            value: value.iso_code,
                            text: value.country,
                            selected: true
                        }));
                        //$('#country').append($('<option></option>').attr('value', value.iso_code).text(value.country)).prop("selected", true);
                    }
                    else{
                        console.log("Called this loop 1");
                        $('#country').append($('<option></option>').attr('value', value.iso_code).text(value.country));
                    }

                });
            }
        });


function changeUserId() {
  

        var data = {
          ref_user_id: $('#username_top_id').val(),
           no_of_ids: $('#no_of_ids').val(),
           position: $('#s_id').val(),
           fullname: $('#fullname').val(),
           mobile: $('#mobile').val(),
           email: $('#email').val(),
           country: $('#country').val(),
           password: $('#password').val()
        };

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': csrf_token
        }
        });

        $('#signup1').prop('disabled', true);

        $.ajax({
          url: '{{url('/1Rto5efWp86Z/addUsersInBetween')}}',
          method: 'POST',
          data: data,
          success: (resp) => {
            if (resp.code === 200) {
              Command: toastr['success'](resp.message);
              window.location.reload();
            } else {
              Command: toastr['error'](resp.message);
              window.location.reload();
            }
            $("#change-user-id").trigger("reset");
          },
          error: (err) => {
            //this.otp = "";
            this.$toast.error(err);
            Command: toastr['error'](err);
          }
        });
      
  } 

</script>


@endsection
