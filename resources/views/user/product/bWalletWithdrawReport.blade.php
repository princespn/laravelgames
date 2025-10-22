@extends('layouts.user_type.auth-app')

@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="PageTitle">
                    <h1>B Wallet Withdrawal Report</h1>
                </div>
            </div>
        </div>
        <div class="row RepotPage">
            <div class="col-md-12">
                <div class="searchFormWrap">
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
                            <div class="col-md-3">
                                <div class="text-center searchFormButwrap">
                                    <button type="button" name="signup1" value="Sign up" id="onSearchClick" class="btn btn-find">Find</button>
                                    <button type="button" name="signup1" value="Sign up" id="onResetClick" class="btn btn-reset">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table id="withdrawals-income-report" v-once class="display nowrap table-striped" style="width: 100%;">
                        <thead>
                            
                            <tr>
                            <th>No.</th>
                            <th>Amount</th>
                            <th>Address</th>
                            <th>Wallet Type</th>
                            <th>Status</th>
                            <th>Currency Type</th>
                            <th>Requested Date</th>
                            <th>Approved Date</th>
                            <th>Remark</th>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript"> 
var csrf_token = '{{ csrf_token() }}';
        $(document).ready(function(){
         
            let i = 0;
            var reportsTable = $("#withdrawals-income-report").DataTable({
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
                ajax: {
                    url: '{{ url('withdrwal-income') }}',
                    type: "POST",
                    
                    data: function (d) {
                        console.log(d);
                        i = 0;
                        i = d.start + 1;

                        let params = {
                            frm_date: $("#from-date").val(),
                            to_date: $("#to-date").val(),
                            type: 9,
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
                    
                    {data:'to_address'},
                    {
                        render: function (data, type, row) {
                            if (row.withdraw_type == 9) {
                                return `<span>B Wallet</span>`;
                            } else {
                                return `<span></span>`;
                            }
                        },
                    },
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
                    {data:"network_type"},                   
                    
                    
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
                                return `-`;
                            } else {
                                return `<span>${row.remark}</span>`;
                            }
                        },
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
