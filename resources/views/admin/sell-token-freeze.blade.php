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
                        <input type="text" class="admin-form-control" id="username" placeholder="User ID" onkeyup="checkUserExistedM(this.value)" />
                        </div>

                        <br>
                        <br>
                        <div class="col-12">
                                        <label for="available_binary_tokens">Freeze Type</label>
                                    </div>
                        <input type="checkbox" id="sell_token_freeze" class="freeze_checbox" name="sell_token_freeze" >
                        <label for="sell_token_freeze">Sell Tokens Freeze</label>

                        <input type="checkbox" id="binary_token_freeze" class="freeze_checbox" name="binary_token_freeze">
                        <label for="binary_token_freeze">Binary Tokens Freeze</label>

                        <input type="checkbox" id="both_token_freeze" class="freeze_checbox" name="both_token_freeze">
                        <label for="both_token_freeze">Both Tokens Freeze</label>

                        <br>
                        <br>
                        <div class="clearfix"></div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="available_binary_tokens">Available Sell Tokens</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group">
                                            <input type="text" class="admin-form-control" id="available_sell_tokens" placeholder="available_sell_tokens" disabled/>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                    <div class="row">
                                    <div class="col-12">
                                        <label for="available_binary_tokens">Available Sell Token Selling Freeze</label>
                                    </div>
                                    <div class="col-12">    
                                        <div class="input-group">
                                            <input type="text" class="admin-form-control" id="available_sell_tokens_freeze" placeholder="available_sell_tokens_freeze"/>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                    <div class="row">
                                    <div class="col-12">
                                        <label for="available_binary_tokens">Available Binary Tokens</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group">
                                            <input type="text" class="admin-form-control" id="available_binary_tokens" placeholder="available_binary_tokens" disabled/>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    </div>
                            </div>
                            <div class="col-6">
                            <div class="row">
                                    <div class="col-12">
                                        <label for="available_binary_tokens">Available Binary Tokens Selling Freeze</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group">
                                            <input type="text" class="admin-form-control" id="available_binary_tokens_freeze" placeholder="available_binary_tokens_freeze"/>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    </div>
                            </div>
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

$(document).ready(function() {
      $('.freeze_checbox').on('change', function() {
        $('.freeze_checbox').not(this).prop('checked', false);
      });
    });

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
    url: '{{url('/1Rto5efWp86Z/checkuserexistfortokenfreeze')}}', // replace with the actual URL for the API endpoint
    data: data,
    dataType: "json",
    success: (resp) => {
      if (resp.code === 200) {
        var user_id = resp.data.id;
        var fullname = resp.data.fullname;

        $('#user_id').val(resp.data.id);
        var isAvialable = "Available";
        var type = "success";

        $('#available_sell_tokens').val(resp.data.sell_token - resp.data.available_sell_tokens_freeze);
        $('#available_sell_tokens_freeze').val(resp.data.available_sell_tokens_freeze);
        $('#available_binary_tokens').val(resp.data.sell_binary_token - resp.data.available_binary_tokens_freeze);
        $('#available_binary_tokens_freeze').val(resp.data.available_binary_tokens_freeze);
        if(resp.data.freeze_status == 'sell_token_freeze'){
          $('#sell_token_freeze').prop('checked', true);
        }else if(resp.data.freeze_status == 'binary_token_freeze'){
          $('#binary_token_freeze').prop('checked', true);
        }else if(resp.data.freeze_status  == 'both_token_freeze'){
          $('#both_token_freeze').prop('checked', true);
        }
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


function changeUserId() {

  let userId = $('#user_id').val();
  if (userId == '') {
      toastr.error("User id required");
      return false;
  }

  if ($('input[type="checkbox"]:checked').length < 1) {
      toastr.error("Please select freeze type");
      return false;
  }
  
    Swal.fire({
      title: "Are you sure?",
      text: "You want to change freeze!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes!",
      cancelButtonText: "Cancel",
    }).then((result) => {
      if (result.value) {
        var data = {
          id:$('#user_id').val(),
          available_sell_tokens: $('#available_sell_tokens').val(),
          available_sell_tokens_freeze: $('#available_sell_tokens_freeze').val(),
          available_binary_tokens: $('#available_binary_tokens').val(),
          available_binary_tokens_freeze: $('#available_binary_tokens_freeze').val(),
          sell_token_freeze: $('#sell_token_freeze').is(':checked'),
          binary_token_freeze: $('#binary_token_freeze').is(':checked'),
          both_token_freeze: $('#both_token_freeze').is(':checked'),
        };
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': csrf_token
        }
        });
        $.ajax({
          url: '{{url('/1Rto5efWp86Z/updateUserSellFreeze')}}',
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
           // this.$toast.error(err);
           // Command: toastr['error'](err);
          }
        });
      }
    });
  } 

</script>


@endsection
