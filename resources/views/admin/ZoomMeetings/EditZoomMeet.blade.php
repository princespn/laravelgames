@extends('layouts.user_type.admin-app')
@section('content')



<div class="row">
        <div class="admin-card-button" v-if="otpstatus == 1">
          <button type="button" class="btn btn-primary waves-effect waves-light" onclick="sendAdminOtp()">Send Otp </button> 
          <p>Note :- Otp Valid 2 Hours</p>
        </div>
        <div class="col-6 mx-auto">
          <div class="admin-card">
            <div class="admin-card-header">
              <h4 class="card-title">Edit Zoom Meeting</h4>
            </div>           
            <div class="admin-card-body">
              <form class="row g-3"  id="myform" method="post" action="{{url('1Rto5efWp86Z/update-zoom-meeting')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group col-12">
                  <label for="zoom_meeting_link">Zoom Meeting Link</label>
                  <input
                    type="text"
                    class="admin-form-control"
                    id="zoom_meeting_link"
                    name="zoom_meeting_link"
                    value="{{ $data['zoommeeting']->meeting_link }}" 
                    placeholder="Zoom Meeting Link"
                    required                
                  />
                    <div class="tooltip1">
                        <span class="text-danger" id="zoom_meeting_link-err"></span>
                    </div>
                </div>


                <div class="form-group col-12">
                  <label for="zoom_meeting_id">Meeting ID</label>
                  <input
                    type="text"
                    class="admin-form-control"
                    id="zoom_meeting_id"
                    name="zoom_meeting_id"
                    value="{{ $data['zoommeeting']->meeting_id }}" 
                    placeholder="Zoom Meeting ID"
                    required                
                  />
                    <div class="tooltip1">
                        <span class="text-danger" id="zoom_meeting_id-err"></span>
                    </div>
                </div>


                <div class="form-group col-12">
                  <label for="zoom_meeting_password">Meeting Password</label>
                  <input
                    type="text"
                    class="admin-form-control"
                    id="zoom_meeting_password"
                    name="zoom_meeting_password"
                    value="{{ $data['zoommeeting']->meeting_password }}" 
                    placeholder="Zoom Meeting Password"
                    required                
                  />
                    <div class="tooltip1">
                        <span class="text-danger" id="zoom_meeting_password-err"></span>
                    </div>
                </div>


                <div class="form-group col-12">
                  <label for="zoom_meeting_date">Meeting Date</label>
                  <input
                    type="date"
                    class="admin-form-control"
                    id="zoom_meeting_date"
                    name="zoom_meeting_date"
                    value="{{ $data['zoommeeting']->meeting_date }}" 
                    placeholder="Zoom Meeting Date"
                    required                
                  />
                    <div class="tooltip1">
                        <span class="text-danger" id="zoom_meeting_date-err"></span>
                    </div>
                </div>

                <div class="form-group col-12">
                  <label for="zoom_meeting_date">Meeting Time</label>
                  <input
                    type="time"
                    class="admin-form-control"
                    id="zoom_meeting_time"
                    name="zoom_meeting_time"
                    value="{{ $data['zoommeeting']->meeting_time }}" 
                    placeholder="Zoom Meeting Date"
                    required                
                  />
                    <div class="tooltip1">
                        <span class="text-danger" id="zoom_meeting_time-err"></span>
                    </div>
                </div>
                

                <input type="hidden" name="sr_no_for_update" value="{{ $data['zoommeeting']->sr_no }}">

                <div class="form-group col-12">
                  <label for="zoom_banner">Choose Zoom Banner</label>
                  <input
                    type="file"
                    class="admin-form-control"
                    id="zoom_banner"
                    value="{{ old('zoom_banner') }}" 
                    name="zoom_banner"
                    placeholder="Banner"
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
                    data-vv-as="OTP"
                    required
                    maxlength="15"
                  />
                </div>
                <div class="form-group col-12 text-center">
                  <button
                    type="submit"
                    class="btn btn-rounded btn-outline-primary" id="selftopup">
                    Update
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <script>
            var csrf_token = "{{ csrf_token() }}";

            $(document).ready(function() {
            
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


@endsection