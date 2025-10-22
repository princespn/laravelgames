@extends('layouts.user_type.admin-app')
@section('content')

<div class="container">
    <h2>Cron Manager</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cron Name</th>
                <th>Command</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($crons as $cron)
            <tr>
                <td>{{ $cron->name }}</td>
                <td>{{ $cron->command }}</td>
                <td>
                    <button class="btn btn-primary run-cron" data-command="{{ $cron->command }}">Run</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- OTP Modal -->
<div class="modal fade" id="otpModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="otpForm">
      @csrf
      <input type="hidden" name="command" id="otpCommand">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Enter OTP</h5>
        </div>
        <div class="modal-body">
          <input type="password" name="otp" class="form-control" placeholder="Enter OTP">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Verify & Run</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('.run-cron').click(function(){
        let command = $(this).data('command');
        $.post("{{ url('1Rto5efWp86Z/send-admin-otp') }}", {_token:"{{ csrf_token() }}", command:command}, function(res){
            $('#otpCommand').val(command);
            $('#otpModal').modal('show');
        });
    });

    $('#otpForm').submit(function(e){
        e.preventDefault();
        $.post("{{ route('cron.verifyOtp') }}", $(this).serialize(), function(res){
            alert(res.status);
            $('#otpModal').modal('hide');
        });
    });
});
</script>
@endsection
