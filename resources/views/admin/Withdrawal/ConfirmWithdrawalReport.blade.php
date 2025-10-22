@extends('layouts.user_type.admin-app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h4 class="card-title">Confirm Withdrawal Report</h4>
                </div>
                <form id="searchForm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>From Date</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="date" class="admin-form-control" name="frm_date"
                                                            placeholder="From Date" id="frm_date" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>To Date</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="date" class="admin-form-control" name="to_date"
                                                            placeholder="To Date" id="to_date" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Station ID</label>
                                                <input class="admin-form-control" placeholder="enter Station ID" type="text"
                                                    id="user_id" onkeyup="checkUserExisted(this.value)" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label id="isAvialable"></label>
                                                <input id="fullname" class="admin-form-control d-none">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary waves-effect waves-light ml-4"
                                                    id="onSearchClick">
                                                    Search
                                                </button>
                                                <button type="button" class="btn btn-info waves-effect waves-light ml-4"
                                                    onclick="exportToExcel()">
                                                    Export To Excel
                                                </button>
                                                <button type="button" class="btn btn-dark waves-effect waves-light ml-4"
                                                    id="onResetClick">
                                                    Reset
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- panel-body -->
                            </div>
                            <!-- panel -->
                        </div>
                        <!-- col -->
                    </div>
                </form>

                <div id="withdrawsummary-container" class="row amts-rows"></div>

                <div class="row">
                    <div class="col-12">
                        <div class="admin-card-body">
                            <div class="table-responsive admin-table">
                                <table id="confirm-withdrawal-report" class="display nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Date</th>
                                            <th>Station ID</th>
                                            <th>Total Amount</th>
                                            <th>Deduction</th>
                                            <th>Net Amount</th>
                                            
                                            <th>Network Type</th>
                                            <th>Auto Sell Wallet</th>
                                            <th>Address</th>
                                            <th>Country</th>
                                            <th>Status</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="container px-5 py-5">
                                <div class="row">
                                    <div class="col-md-2">
                                        <h6 id="confirmed"></h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 id="confirmedsum"></h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 id="confirmedsum_deduction"></h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 id="confirmedsum_new"></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--

    <div id="confirm-withdrawal-model" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Withdrawal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to withdraw {amount} {currency}?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="OnConfirmWithdrawal()">Confirm</button>
                </div>
            </div>
        </div>
    </div> --}}
    <script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
    <script>
        $(document).ready(function() {
            productReport();
        });


        function productReport() {
            var csrf_token = "{{ csrf_token() }}";
            let i = 1;

            setTimeout(function() {
                const table = $("#confirm-withdrawal-report").DataTable({
                    responsive: true,
                    retrieve: true,
                    destroy: true,
                    processing: false,
                    serverSide: true,
                    stateSave: false,
                    ordering: false,
                    dom: "Brtip",
                    lengthMenu: [
                        [10, 20, 30, 40, 50, 100,1000,-1],
                        [10, 20, 30, 40, 50, 100,1000,"All"],
                    ],
                    buttons: [
                        // "excelHtml5",
                        "pageLength"
                    ],
                    ajax: {
                        url: '{{ url('1Rto5efWp86Z/getconfirmedwithdrwal') }}',
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': csrf_token
                        },
                        data: function(d) {
                            i = 0;
                            i = d.start + 1;
                            let params = {
                                id: $("#user_id").val(),
                                frm_date: $("#frm_date").val(),
                                to_date: $("#to_date").val()
                            };
                            Object.assign(d, params);
                            return d;
                        },
                        dataSrc: function(json) {
                            if (json.code === 200) {
                                let arrGetHelp = json.data.records;



                                $('#confirmed').text('Confirmed:' + json.data.recordsTotal);
                                $('#confirmedsum').text('Total Confirmed Amount:' + json.data.total_amount);
                                $('#confirmedsum_deduction').text('Total Confirmed Deduction:' + json.data.total_deduction);
                                $('#confirmedsum_new').text('Total Confirmed Net Amount:' + json.data.total_net_amount);
                               
                                json["recordsFiltered"] = json.data.recordsFiltered;
                                json["recordsTotal"] = json.data.recordsTotal;
                                return json.data.records;
                            } else if (json.code === 401 || json.code === 403) {
                                localStorage.removeItem("admin_token");
                                location.reload();
                            } else {
                                json["recordsFiltered"] = 0;
                                json["recordsTotal"] = 0;
                                return json;
                            }
                        }
                    },
                    columns: [
                        {
                            render: function () {
                                return i++;
                            },
                        },
                        {
                            data: "entry_time",
                            render: function (data) {
                                if (data === null || data === undefined || data === "") {
                                    return `-`;
                                } else {
                                    return data;
                                    // return moment(String(data)).format("YYYY-MM-DD");
                                }
                            },
                        },
                        {
                            data: { user_id: "user_id", fullname: "fullname" },
                            render: function (data) {
                                return `<span>${data.user_id}</span><span>(${data.fullname})</span>`;
                            },
                        },
                        {
                            data: { amount: "amount", deduction: "deduction" },
                            render: function (data) {
                                {
                                    var total_amount =
                                        data.amount + data.deduction;
                                    return total_amount;
                                }
                            },
                        },
                        { data: "deduction" },
                        { data: "amount" },
                        // { data: 'doxy_amount' },
                        // { data: 'doxy_deduction' },
                        { data: "network_type" },
                        // {
                        //     data: "link_transaction_hash",
                        //     render: function(data) {
                        //         if(data != null){
                        //         return `<a href="${data}" target="_blank">${data}</a>`;
                        //         }else{
                        //         return ``;
                        //         }
                        //         //return `${row.to_address}`;
                        //     }
                        // },
                        { data: "withdraw_type" },
                        { data: "to_address" },
                        { data: "country" },
                        /* {
                          data: "ip_address",
                          render: function (data) {
                            if (data === null || data === undefined || data === "") {
                              return `-`;
                            } else {
                              return data;
                            }
                          },
                        }, */
                        /*  { data: 'perfect_money_address' },*/
                        { data: "status" },
                        
                        { data: "remark" },
                    ],

                });

                $("#onSearchClick").click(function() {
                    table.ajax.reload(null, false);
                });

                $("#onSearchClick").click(function() {
                    var startDate = $("#frm_date").val();
                    var endDate = $("#to_date").val();
                    if (endDate < startDate) {
                        toastr.error("To date should be greater than from date");
                        return false;
                        // alert("To date should not less than from date ");
                    }
                    table.ajax.reload(null, false);
                });

            });
        }



        function exportToExcel() {
            var csrf_token = "{{ csrf_token() }}";
            var data = {
                id: $("#user_id").val(),
                frm_date: $("#frm_date").val(),
                to_date: $("#to_date").val(),
                action: "export",
                responseType: "blob",
            };

            $.ajax({
                url: '{{ url('1Rto5efWp86Z/getconfirmedwithdrwal') }}',
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                data: data,
                dataType: 'json',
                success: function(resp) {
                    var mystring = resp.data.data;
                    var myblob = new Blob([mystring], {
                        type: 'text/plain'
                    });

                    var fileURL = window.URL.createObjectURL(new Blob([myblob]));
                    var fileLink = document.createElement('a');

                    fileLink.href = fileURL;
                    fileLink.setAttribute('download', 'ConfirmSellReport.xls');
                    document.body.appendChild(fileLink);

                    fileLink.click();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        $("#onResetClick").click(function() {
            $("#searchForm").trigger("reset");
            var startDate = $("#frm_date").val("");
            var endDate = $("#to_date").val("");
            var user_id = $("#user_id").val("");
            var table = $("#confirm-withdrawal-report").DataTable();
            table.ajax.reload(null, false);
        });

        function checkUserExisted(username) {

            if (username != '') {
                var data = {
                    user_id: username
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '{{ url('/1Rto5efWp86Z/checkuserexist') }}', // replace with the actual URL for the API endpoint
                    data: data,
                    dataType: "json",
                    success: (resp) => {

                        console.log(resp);
                        if (resp.code === 200) {
                            var fullname = $("#fullname");
                            var user_id = resp.data.id;
                            fullname.val(resp.data.fullname);
                            fullname.addClass('d-block');
                            fullname.removeClass('d-none');
                            fullname.removeClass('text-danger');
                            fullname.addClass('text-success');
                            var isAvialable = $("#isAvialable").html("User");

                            toastr.success(resp.message);
                        } else {
                            var fullname = $("#fullname");
                            var user_id = "";
                            var isAvialable = $("#isAvialable").html("User");
                            fullname.val("Not available");
                            fullname.addClass('d-block');
                            fullname.removeClass('d-none');
                            fullname.addClass('admin-form-control');
                            fullname.addClass('text-danger');
                            fullname.removeClass('text-success');
                            toastr.error(resp.message);
                        }

                    },
                    error: (err) => {
                        //   toastr.error(err)
                    }
                });

            }
        }
    </script>
@endsection
