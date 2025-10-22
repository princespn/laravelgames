@extends('layouts.user_type.auth-app')
@section('content')
<style type="text/css">
div#amount-error{
color: red;
}
div#inputState-error{
color: red;
}
</style>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Deposit Funds</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('svg/icon-sprite.svg#stroke-home')}}"></use>
                            </svg></a></li>
                            <li class="breadcrumb-item">Deposit Funds</li>
                            <li class="breadcrumb-item active"> Deposit Funds</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="edit-profile">
                <div class="row">
                    <div class="col-md-12">
                        <form id="user_add_fund_form" class="card">
                            @csrf
                            <div class="card-header card-header border-t-primary border-3">
                                <h4 class="card-title mb-0">Add Funds</h4>
                                <p>Invest in Energeios and unlock amazing income opportunities!</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="input-placeholder" class="form-label">Amount (In USD)</label>
                                            <input id="amount" name="amount" class="form-control"  placeholder="Enter Value" type="text" min="1" step="1"  maxlength="6" value="" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                          <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                              <div class="form-check radio radio-primary ps-0">
                              <ul class="radio-wrapper justify-content-start">
                                       @foreach($currency as $cur)
                                         <li>
                                             <input  class="form-check-input" checked type="radio" name="payment_mode" id="basic-{{$cur->currency_code}}" value="{{$cur->currency_code}}" @if($cur->default_selected == 1)  checked @endif />
                                          <label class="form-check-label" for="radio-icon1">
                                            <img src="{{ asset('images/USDT.png')}}" width="50">
                                            <span>{{$cur->currency_name}}</span></label>
                                        </li>
                                       @endforeach
                               </ul>
                                </div>
                             </div>

                                    <button class="btn btn-primary btn-wave waves-effect waves-light" type="button" onclick="payment_call()">
                                    Make Payment
                                    </button>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <small class="txt-primary">Note: The deposit value must be greater than $50.</small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="modal" tabindex="-1" id="paymentmodal">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">For Payment(Untile Payment Completion Please do not close this popup, Once payment done close this popup, it will reflect to your wallet in 5min)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="data">
            <img id="paymentqr" style="display: block;-webkit-user-select: none;margin: auto;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;" src="">
            <br>
            <p id="addressdisp"></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
<script>
    var base_url = '{{url('/')}}'
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
    {{-- $(document).ready(function() {
        $("#user_add_fund_form").validate({
            errorElement: 'div',
            rules: {
                amount:{ 'required':true,digits:true,min:50},
                payment_mode: 'required',
            },
            messages: {
                amount: {
                    required: "Please Enter Value (In USD)",
                    digits: "Please Enter a valid Value",
                    min: "Deposit value should be more than $50",
                },
                payment_mode: 'Please Select Payment Mode'
            }
        });
    }); --}}
    function openUrlInNewTab(url) {
        var a = document.createElement("a");
        a.href = url;
        a.target = "_blank";
        var event = new MouseEvent("click", {
            "view": window,
            "bubbles": true,
            "cancelable": false
        });
        a.dispatchEvent(event);
//window.location.href = url;
    }
    function payment_call(){
        let amount = $('#amount').val();
        let payment_mode = $('input[name="payment_mode"]:checked').val();
        let isValid = true;
// Reset previous errors
        $('.error-message').remove();
// Validate amount
        if (!amount || isNaN(amount) || parseFloat(amount) < 50) {
            $('#amount').after('<div class="error-message text-danger mt-1">Please enter a valid amount greater than $50</div>');
            isValid = false;
        }
// Validate payment mode
        if (!payment_mode) {
            $('input[name="payment_mode"]').last().parent().after('<div class="error-message text-danger mt-1">Please select a payment mode</div>');
            isValid = false;
        }

        if(isValid){

            var currency_code = $('input[name="payment_mode"]:checked').val();
            var hash_unit = $('#amount').val();
            var data = { product_id: 1, currency_code: currency_code,hash_unit:hash_unit};

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                }
            });
            $.ajax({
                url: '{{url('/purchase-package')}}',
                type: 'POST',
                data: data,
                success: function(resp) {
                    console.log(resp);
                    var qrcode_url = resp.data.qrcode_url;
                    var status_url = resp.data.status_url;
                    var checkout_url = resp.data.checkout_url;
                    var address = resp.data.address;
                    var amountdisp = resp.data.amount;
                    var currency_code = $('input[name="payment_mode"]:checked').val();
                    let totalTimeInSeconds = resp.data.timeout;
                    let currenttimeinsec = resp.data.currenttimeinsec;
                    var timeouttt = totalTimeInSeconds-currenttimeinsec;


                    $('#paymentqr').attr('src', qrcode_url);
                    $('#addressdisp').html('<div class="form-group"><label for="addressInput">Your Address:</label><div class="input-group"><input type="text" id="addressInput" class="form-control" value="'+address+'" readonly><div class="input-group-append"><button class="btn btn-primary copy-btn" onclick="copyToClipboard()">Copy</button></div></div></div><br><br><div class="form-group"><label for="addressInput">Amount:</label><div class="input-group"><input type="text" id="amountInput" class="form-control" value="'+amountdisp+' '+currency_code+'" readonly></div></div></div> <div class="row justify-content-center"><div class="col-md-6 countdown-container"><div class="countdown" id="countdown">03:00:00</div><div class="label">Time Remaining</div></div></div>');
                    updateCountdown(timeouttt);
                    var myModal = new bootstrap.Modal(document.getElementById('paymentmodal'));
                    myModal.show();

                },
                error: function() {
// show error message
                }
            });
        }
    }
    function copyToClipboard() {
// Select the input field
        const addressInput = document.getElementById('addressInput');
// Select the text inside the input field
        addressInput.select();
addressInput.setSelectionRange(0, 99999); // For mobile devices
// Copy the selected text to the clipboard
navigator.clipboard.writeText(addressInput.value).then(() => {
    toastr.success('Address copied to clipboard!');
}).catch(err => {
    toastr.success('Failed to copy address. Please try again.');
});
}
function formatTime(seconds) {
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const secs = seconds % 60;
// Add leading zeros if necessary
    return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
}
function updateCountdown(totalTimeInSeconds) {
    const countdownElement = document.getElementById('countdown');
// Update the countdown every second
    const interval = setInterval(() => {
        if (totalTimeInSeconds <= 0) {
clearInterval(interval); // Stop the timer when it reaches 0
countdownElement.textContent = "00:00:00";
alert("Time's up!");
return;
}
// Update the displayed time
countdownElement.textContent = formatTime(totalTimeInSeconds);
// Decrease the remaining time by 1 second
totalTimeInSeconds--;
}, 1000);
}
document.getElementById('paymentmodal').addEventListener('hidden.bs.modal', function () {
// Reload the page when the modal is closed
    location.reload();
});
</script>
@endsection
