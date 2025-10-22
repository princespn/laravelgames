@extends('layouts.user_type.auth-app')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Deposit Report</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('svg/icon-sprite.svg#stroke-home')}}"></use>
                            </svg></a></li>
                            <li class="breadcrumb-item">Deposit Funds</li>
                            <li class="breadcrumb-item active"> Deposit Report</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
     <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                     <table id="fund-reports" class="responsive display nowrap table table-bordered text-nowrap w-100" style="width:100%">
                        <thead>
                           <tr>
                              <th>
                                 <div class="d-flex align-items-center">  
                                    <span class="icon-format_list_numbered me-1 fs-5s"></span>No.
                                 </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  
                                    <span class="icon-calendar me-1 fs-5s"></span> Date
                                 </div>
                              </th>
                              <!-- <th>
                                 <div class="d-flex align-items-center">  <span class="icon-add_task me-1 fs-5s"></span> Transaction ID 
                                 </div>
                              </th> -->
                              <th>
                                 <div class="d-flex align-items-center">  
                                    <span class="icon-assignment_turned_in me-1 fs-5s"></span> System ID
                                 </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-graphic_eq me-1 fs-5s"></span> Amount
                                 </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">   <span class="icon-add_task me-1 fs-5s"></span> Received USDT                                 </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  
                                    <span class="icon-add_task me-1 fs-5s"></span> Payment Mode 
                                 </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">   
                                    <span class="icon-add_task me-1 fs-5s"></span> Address 
                                 </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  
                                    <span class="icon-add_task me-1 fs-5s"></span> Status 
                                 </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  
                                    <span class="icon-add_task me-1 fs-5s"></span> Action 
                                 </div>
                              </th>
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>
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
    <script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
    <script type="text/javascript">
        // Function: Copy to clipboard
function copyToClipboard() {
    let copyText = document.getElementById("addressInput");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    alert("Address copied: " + copyText.value);
}

// Function: Countdown Timer
function updateCountdown(seconds) {
    var countdownEl = document.getElementById("countdown");
    clearInterval(window.countdownTimer); // reset if already running

    window.countdownTimer = setInterval(function () {
        let hrs = Math.floor(seconds / 3600);
        let mins = Math.floor((seconds % 3600) / 60);
        let secs = seconds % 60;

        countdownEl.textContent =
            String(hrs).padStart(2, "0") + ":" +
            String(mins).padStart(2, "0") + ":" +
            String(secs).padStart(2, "0");

        seconds--;

        if (seconds < 0) {
            clearInterval(window.countdownTimer);
            countdownEl.textContent = "Expired";
            // Optional: Auto close modal
             bootstrap.Modal.getInstance(document.getElementById('paymentmodal')).hide();
        }
    }, 1000);
}

        $(document).ready(function() {
            var i = 0;

            var reportsTable = $("#fund-reports").DataTable({
                scrollX: true,
                responsive: true,
                lengthMenu: [
                    [10, 50, 100],
                    [10, 50, 100],
                ],
                retrieve: true,
                destroy: false,
                processing: false,
                serverSide: true,
                stateSave: false,
                ordering: false,
                {{-- dom: "lrtip", --}}
                "language": {
                    "emptyTable": "Nothing here yet. Stay tuned!",
                    search: "Search System ID:"
                },
                ajax: {
                    url: '{{ url('/reportfund') }}',
                    type: "POST",
                    data: function(d) {
                        i = d.start;
                        let params = {
                            deposit_id: $("#deposit_id").val(),
                            frm_date: $("#from-date").val(),
                            to_date: $("#to-date").val(),
                            payment_mode: $("#payment-mode").val(),
                        };
                        Object.assign(d, params);
                        return d;
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    },
                    dataSrc: function(json) {
                        if (json.code === 200) {
                            let total_amount = 0;
                            for (let j = 0; j < json.data.records.length; j++) {
                                total_amount = Number(
                                    total_amount + json.data.records[j].amount
                                ).toFixed(3);
                                $("#total_amount").text(total_amount);
                            }

                            let arrGetHelp = json.data.records;
                            json["recordsFiltered"] = json.data.recordsFiltered;
                            json["recordsTotal"] = json.data.recordsTotal;
                            return json.data.records;
                        } else if (json.code === 401 || json.code === 403) {
                            location.href = '{{ url('/login') }}';
                        } else {
                            json["recordsFiltered"] = 0;
                            json["recordsTotal"] = 0;
                            return json;
                        }
                    },
                },
                columns: [{
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        render: function(data, type, row) {
                            if (
                                row.entry_time === null ||
                                row.entry_time === undefined ||
                                row.entry_time === ""
                            ) {
                                return `-`;
                            } else {
                                return moment(String(row.entry_time)).format("YYYY/MM/DD");
                            }
                        },
                    },
                    // {
                    //     data: "invoice_id"
                    // },
                    {
                        render: function(data, type, row) {
                            return row.invoice_id;
                        },
                    },
                    // {
                    //     render: function(data, type, row) {
                    //         return row.trans_id;
                    //     },
                    // },
                    {
                        render: function(data, type, row) {

                            return `<span>$${Number(row.price_in_usd).toFixed(3)}</span>`;

                        },
                    },
                    {
                        render: function(data, type, row) {

                            return `<span>$${Number(row.rec_amt).toFixed(3)}</span>`;

                        },
                    },
                    {
                        render: function(data, type, row) {
                            return "<span class='fw-bold'>" + row.payment_mode +
                                "</span>";
                        },
                    },
                    {
                            render: function(data, type, row) {
                                if (row.payment_mode && row.payment_mode.toLowerCase() == 'usdt.bep20') {
                                    return `<span style='word-break: break-word;'>
                                                <a href="https://bscscan.com/address/${row.address}" target="_blank">${row.address}</a>
                                            </span>`;
                                } else {
                                    return `<span style='word-break: break-word;'>${row.address}</span>`;
                                }
                            },
                        },

                    {
                        render: function(data, type, row) {
                            if (row.in_status == 0) {
                                return `<button class="btn btn-info-gradien open-payment"
                                    data-qr="${row.qrcode_url}"
                                    data-address="${row.address}"
                                    data-amount="${row.price_in_usd}"
                                    data-currency="${row.payment_mode}"
                                    data-timeout="${row.timeouttt}">
                                    Pending
                                </button>`;
                            } else if (row.in_status == 2) {
                                return `<label class="text-danger" fw-bold>Expired<label>`;
                            } else if (row.in_status == 1) {
                                return `<label class="text-success fw-bold">Confirmed<label>`;
                            }
                        },
                    },

                    {
                        render: function(data, type, row) {
                            return "<a href='" + row.status_url + "' target='_blank' class='btn btn-info-gradien'>Checkout</a>";
                        },
                    },
                ],
            });

            $(document).on("click", ".open-payment", function () {
                let qr = $(this).data("qr");
                let address = $(this).data("address");
                let amount = $(this).data("amount");
                let currency = $(this).data("currency");
                let timeout = $(this).data("timeout");

                // Fill modal content
                $("#paymentqr").attr("src", qr);
                $("#addressdisp").html(`
                    <div class="form-group">
                        <label>Your Address:</label>
                        <div class="input-group">
                            <input type="text" id="addressInput" class="form-control" value="${address}" readonly>
                            <button class="btn btn-primary copy-btn" onclick="copyToClipboard()">Copy</button>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Amount:</label>
                        <input type="text" class="form-control" value="$${amount} ${currency}" readonly>
                    </div>
                `);

                // Start countdown
                updateCountdown(timeout);

                // Show modal
                var myModal = new bootstrap.Modal(document.getElementById('paymentmodal'));
                myModal.show();
            });


            $("#onSearchClick").click(function() {
                var startDate = $("#from-date").val();
                var endDate = $("#to-date").val();
                if (endDate < startDate) {
                    toastr.error('To date should be greater than from date')
                    return false;
                }
                reportsTable.ajax.reload(null, false);;
            });
            $("#onResetClick").click(function() {
                $("#searchForm").trigger("reset");
                $("#deposit_id").val("");
                reportsTable.ajax.reload(null, false);;
            });
            $('#deposit_id').keypress(function(e) {
                var key = e.which;
                if (key == 13) // the enter key code
                {
                    $('#onSearchClick').click();
                    reportsTable.ajax.reload(null, false);;
                }
            });
        });
    </script>
@endsection
