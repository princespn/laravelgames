@extends('layouts.user_type.admin-app')
@section('content')
 <div class="row">
  <div class="admin-card-button">
    <button type="button" class="btn btn-primary waves-effect waves-light" onclick="sendAdminOtp()">Send Otp </button> 
    <p>Note :- Otp Valid 2 Hours</p>
  </div>
  <div class="col-6 mx-auto">
    <div class="admin-card">
      <div class="admin-card-header">
        <h4 class="card-title">Add Video</h4>
      </div>     
      <div class="admin-card-body">
        <form class="row g-3" method="post" action="{{url('1Rto5efWp86Z/store-videos')}}">   
         @csrf       
          <div class="form-group col-12">
            <label for="tool_name">Name</label>
            <input
              type="text"
              class="admin-form-control"
              id="tool_name"
              name="tool_name"
              placeholder="Name"             
            />
          <div class="tooltip1">
            <span class="text-danger" id="name-err">               
                </span>
            </div>
          </div>
          <div class="form-group">
            <label>Video Type</label>
            <select name="tool_type" id="tool_type" class="admin-form-control">
              <option selected value="">Select Video Type</option>
              <option value="2">Business Presentation Video</option>
              <option value="22">Tutorial Video</option>
              <option value="23">Promo Video</option>
            </select>
          </div>
          <div class="form-group col-12">
            <label for="video">Add Video Embed Code</label>
            <input
              type="text"
              class="admin-form-control"
              id="video"
              name="market_tool"
              placeholder="Enter video embed code"               
            />
          </div>
          <div class="form-group col-12"  v-if="otpstatus == 1">
            <label>OTP</label>
            <input
              type="text"
              class="admin-form-control"
              id="otp"
              placeholder="Enter Otp"
              name="otp"
              data-vv-as="OTP "
            />
          </div>
          <div class="form-group col-12 text-center">
            <button type="submit" id="selftopup" class="btn btn-rounded btn-outline-primary">
              Submit
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
var csrf_token = "{{ csrf_token() }}";

$(document).ready(function() {
// $("#tool_name").on("input", function() {
//     const fullname = $(this).val();
//     var fullnamel = fullname.replace(/ /g, "");
//     if (fullname == "") {
//     $('#selftopup').prop('disabled', true);
//     $("#name-err").html("Name should not be blank.");
//     } else if (fullnamel.length < 10) {
//     $("#name-err").html("Name must be atleast 10 characters long");
//     $('#selftopup').prop('disabled', true);
//     } else {
//     $("#name-err").html("");
//     $('#selftopup').prop('disabled', false);
//     }
// });
});
function sendAdminOtp() {
  var data = {type: 4};
  $.ajax({
      url: "{{url('/1Rto5efWp86Z/send-otp-withdraw-mail')}}", // Replace with your API endpoint
      type: 'POST',
      data: data,
      headers: {

      'X-CSRF-TOKEN': csrf_token

      },
      success: function(resp) {
      if (resp.code === 200) {
          toastr.success(resp.message);
      } else {
          toastr.error(resp.message);
      }
      },
      error: function(jqXHR, textStatus, errorThrown) {
      toastr.error('Error: ' + errorThrown);
      }
  });
  }
</script>


