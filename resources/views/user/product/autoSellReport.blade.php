@extends('layouts.user_type.auth-app')
@section('content')
<div class="page-body">
   <!-- Container-fluid starts-->
   <div class="container-fluid">
      <div class="row">
            <div class="col-md-12">
                <div class="PageTitle">
                    <h1>Auto Sell Token Report</h1>
                </div>
            </div>
        </div>
        <div class="row">
         <div class="col-xl-12">
            <div class="card custom-card">
               <div class="card-body">
                    <form id="searchForm">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input type="date" class="form-control" name="frm_date" :format="dateFormat" placeholder="From Date" id="frm_date" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>To Date</label>
                                    <input type="date" class="form-control" name="to_date" :format="dateFormat" placeholder="To Date" id="to_date" />
                                </div>
                            </div>
                            <div class="col-md-3 mt-lg-4">
                              <div class="mt-1 searchFormButwrap">
                                 <button type="button" name="signup1" value="Sign up" id="onSearchClick" class="btn btn-success">
                                 Search </button>
                                 <button type="button" name="signup1" value="Sign up" id="onResetClick" class="btn btn-warning">
                                 Reset </button>
                              </div>
                           </div>
                        </div>
                     </form>
                </div>
            </div>
                <div class="card custom-card">
                   <div class="card-header">
                      <div class="card-title">
                     Auto Sell Token Report
                  </div>
               </div>
               <div class="card-body">
                <div class="table-responsive">
                    <table id="auto-sell-token-report" class="table table-bordered text-nowrap w-100" style="width: 100%;">
                        <thead>                            
                            <tr>
                            <th>No.</th>
                            <th>Amount</th>
                            <th>Token</th>
                            <th>Sell Rate</th>
                            <th>Address</th>
                            
                            <th>Status</th>
                            <th>Requested Date</th>
                            <th>Approved Date</th>
                            <th>Remark</th>
                            <th>Topup Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="odd">
                                <td valign="top" colspan="10" class="dataTables_empty">Data not available currently, click on the below button to Activate your account and start earning.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript"> 
var csrf_token = '{{ csrf_token() }}';
        $(document).ready(function(){
         
            let i = 0;
            var reportsTable = $("#auto-sell-token-report").DataTable({
                responsive: true,
                lengthMenu: [
                    [10, 50, 100],
                    [10, 50, 100],
                ],
                retrieve: true,
                destroy: true,
                processing: false,
                serverSide: true,
                stateSave: false,
                ordering: false,
                dom: "lrtip",
                "language": {
                    "emptyTable": "Nothing here yet. Stay tuned!"
                },
                "createdRow": function (row, data, dataIndex) {
            // Add a click event to the button with class 'btn-open-modal'
            $(row).on('click', '.btn-open-modal', function () {
                var id = $(this).data('id');

                // Open SweetAlert2 modal
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to proceed?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, Relase!', 
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Handle the confirmation, e.g., make an AJAX request
                        $.ajaxSetup({
                        headers: {
                        'X-CSRF-TOKEN': csrf_token
                        }
                        });
                        $.ajax({
                        url: '{{url('/update-address')}}',
                        method: 'POST',
                        data: {'id' : id},
                        success: (resp) => {
                            if (resp.code === 200) {
                            // toastr['success'](resp.status);
                            window.location.reload();
                            } else {
                            // toastr['error'](resp.status);
                            window.location.reload();
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
            });
        },
                ajax: {
                    url: '{{ url('auto-sell-token') }}',
                    type: "POST",
                    
                    data: function (d) {
                        console.log(d);
                        i = 0;
                        i = d.start + 1;

                        let params = {
                            frm_date: $("#from-date").val(),
                            to_date: $("#to-date").val(),
                        };
                        Object.assign(d, params);
                        return d;
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    },
                    dataSrc: function (json) {
                        
                        if (json.code === 200) {
                            let arrGetHelp = json.data.records;
                            json["recordsFiltered"] = json.data.recordsFiltered;
                            json["recordsTotal"] = json.data.recordsTotal;
                            return json.data.records;
                        } else if (json.code === 401 || json.code === 403) {
                            location.href='{{url('/login')}}';
                        } else {
                            json["recordsFiltered"] = 0;
                            json["recordsTotal"] = 0;
                            return json;
                        }
                    },
                },
                columns: [
                    {
                        render: function () {
                            return i++;
                        },
                    },
                    {
                        render: function (data, type, row) {
                            return `<span>${(row.amount).toFixed(2)}</span>`;
                        },
                    },
                    {
                        render: function (data, type, row) {
                            return `<span>${row.sell_coin}</span>`;
                        },
                    },
                    {
                        render: function (data, type, row) {
                            return `<span>${row.sell_rate}</span>`;
                        },
                    },
                    {data:'to_address'},
                    
                    {
                        render: function (data, type, row) {
                            if (row.status == 0) {
                                return `<span class="label label-warning"><b>REQUESTED</b></span>`;
                            }else if (row.status === 1) {
                                return `<span class="label label-success"><b>APPROVED</b></span>`;
                            } else {
                                return `<span class="label label-danger">REJECTED</span>`;
                            }
                            /*if (row.status === "Paid") {
                              return `<span class="label label-success"><b>PAID</b></span>`;
                            } else {
                              return `<span class="label label-danger">UNPAID</span>`;
                            }*/
                        }
                    },
                    {
                        data: "entry_time"
                    },
                    {
                        data: "withdraw_approved"
                    },
                    {
                        render: function (data, type, row) {
                            if (
                                row.remark === null ||
                                row.remark === undefined ||
                                row.remark === ""
                            ) {
                                return `Auto Sell`;
                            } else {
                                return `<span>${row.remark}</span>`;
                            }
                        },
                    },
                    {
                        data: "topup_date"
                    },
                    {
                        render: function (data, type, row) {
                            if (row.to_address == '' && ((row.usdt_trc20_address == "" || row.usdt_trc20_address == null) && (row.usdt_bep20_address == null || row.usdt_bep20_address == ""))) {
                                return `Please update address first`;
                            } else  if (row.to_address == '' && (row.usdt_trc20_address != "" || row.usdt_trc20_address != null || row.usdt_bep20_address != null || row.usdt_bep20_address != "")){
                                return `<button class="btn btn-primary btn-sm btn-open-modal" data-id="${row.sr_no}">Release my holding amount</button>`;
                            } else{
                                return `-`;
                            }
                        }
                    },



                ],


            });

            $("#onSearchClick").click(function () {
                var startDate = $("#from-date").val();
                var endDate = $("#to-date").val();
                
                if (endDate < startDate) {
                    toastr.error("To date should be greater than from date");
                    return false;
                }
                reportsTable.ajax.reload(null, false);;
            });
            $("#onResetClick").click(function () {
                $("#searchForm").trigger("reset");
                reportsTable.ajax.reload(null, false);;
            });
        });
    </script>
@endsection
