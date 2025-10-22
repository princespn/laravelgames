@extends('layouts.user_type.admin-app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h4 class="card-title">Rejected Withdrawal Report </h4>
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

                <div class="row amts-rows">
                    <div class="col-md-6 col-sm-6"></div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="admin-card-body">
                            <div class="table-responsive admin-table">
                                <table id="withdraw-rejected-report" class="display nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Date</th>
                                            <th>Station ID</th>
                                            <th>Amount</th>
                                            <th>Service Charges</th>
                                            <th>Net Amount</th>
                                            <th>Token</th>
                                            <th>Network Mode</th>
                                            <th>Wallet</th>
                                            <th>Address</th>
                                            <th>Status</th>
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



    <script>
        $(document).ready(function() {
            withdrawRequestReport();
        });

        function withdrawRequestReport() {
            let i = 1;
            var csrf_token = "{{ csrf_token() }}";

            setTimeout(function() {
                const table = $("#withdraw-rejected-report").DataTable({
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
                        url: '{{ url('1Rto5efWp86Z/rejected_withdrawals') }}',
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


                                 $('#confirmed').text('Rejected:' + json.data.recordsTotal);
                                 $('#confirmedsum').text('Total Rejected Amount:' + json.data.total_amount);
                                 $('#confirmedsum_deduction').text('Total Rejected Deduction:' + json.data.total_deduction);
                                 $('#confirmedsum_new').text('Total Rejected Net Amount:' + json.data.total_net_amount);
                             


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
                            }
                        },
                        {
                            data:"entry_time",
                            render: function (data) {
                                if (data === null || data === undefined || data === '') {
                                    return `-`;
                                } else {
                                    return data;
                                    // return moment(data).format('YYYY-MM-DD');
                                }
                            }
                        },
                        {
                            data:{user_id:"user_id",fullname:"fullname"},
                            render: function (data) {
                                return `<span>${data.user_id}</span><span>(${data.fullname})</span>`;
                            }
                        },
                        {
                            data:{amount:"amount",deduction:"deduction"},
                            render: function (data) {
                                return `${Number(data.amount) + Number(data.deduction)}`;
                            }
                        },
                        {
                            data:"deduction",
                            render: function (data) {
                                return `$${data}`;
                            }
                        },
                        {
                            data:"amount",
                            render: function (data) {
                                return `$${data}`;
                            }
                        },
                        {
                            data:"sell_coin",
                            render: function (data) {
                                return `${data}`;
                            }
                        },
                        // {
                        //     data:"doxy_amount",
                        //     render: function (data) {
                        //         return `$${data}`;
                        //     }
                        // },
                        // {
                        //     data:"doxy_deduction",
                        //     render: function (data) {
                        //         return `$${data}`;
                        //     }
                        // },
                        { data: 'network_type' },
                        { data: 'withdraw_type' },
                        { data: 'to_address' },
                        { data: 'status' },
                        
                    ]

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

        function getWithdrawalSummary() {
            var csrf_token = "{{ csrf_token() }}";
            var data = {
                status: 1,
                verify_status: 1
            };
            $.ajax({
                type: "POST",
                url: '{{ url('1Rto5efWp86Z/getwithdrawal') }}',
                data: data,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                success: function(resp) {
                    if (resp.code === 200) {
                        this.withdrawsummary = resp.data;
                    } else {
                        this.$toast.error(resp.message);
                    }
                }.bind(this),
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
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
                url: '{{ url('1Rto5efWp86Z/rejected_withdrawals') }}',
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
                    fileLink.setAttribute('download', 'Rejected-Sell-Report.xls');
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
