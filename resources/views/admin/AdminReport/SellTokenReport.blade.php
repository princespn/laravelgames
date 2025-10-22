@extends('layouts.user_type.admin-app')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h4 class="card-title">Sell Token History</h4>
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
                                                        :format="dateFormat" placeholder="From Date" id="frm_date" />
                                                    <!-- <input type="text" class="admin-form-control" placeholder="From Date" id="datepicker"> -->
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
                                                        :format="dateFormat" placeholder="To Date" id="to_date" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <input class="admin-form-control"  type="hidden"
                                                id="user_id"  value="{{$arrInput['id']}}"/>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <button type="button" class="
                                  btn btn-primary
                                  waves-effect waves-light
                                  ml-4
                                " id="onSearchClick">
                                                    Search
                                                </button>
                                                <button type="button" class="
                                  btn btn-info
                                  waves-effect waves-light
                                  ml-4
                                " onclick="exportToExcel()">
                                                    Export To Excel
                                                </button>
                                                <button type="button" class="
                                  btn btn-dark
                                  waves-effect waves-light
                                  ml-4
                                " id="onResetClick">
                                                    Reset
                                                </button>
                                            </div>
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
            <div class="admin-card-body">
                <div class="table-responsive admin-table">
                    <table v-once id="sell-token-history" class="display nowrap" style="width: 100%">
                        <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Requested Date</th>
                            <th>Approved Date</th>
                            <th>Amount</th>
                            <th>Token</th>
                            <th>Sell Rate</th>
                            <th>Address</th>
                            <th>Sell From</th>
                            <th>Status</th>
                            <th>Currency Type</th>
                            <th>Remark</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var base_url = '{{url('/')}}'
var csrftoken = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function() {

    let i = 1;
    var csrf_token = "{{ csrf_token() }}";

     var table = $("#sell-token-history").DataTable({
        responsive: true,
        retrieve: true,
        destroy: true,
        processing: false,
        serverSide: true,
        stateSave: false,
        ordering: false,
        dom: "Brtip",
        lengthMenu: [
            [10, 20, 30, 40, 50, 100,1000],
            [10, 20, 30, 40, 50, 100,1000],
        ],
        buttons: [
            "pageLength",
        ],
        ajax: {
            url: "{{ url('1Rto5efWp86Z/user/sellTokenHistoryData') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            data: function (d) {
                i = 0;
                i = d.start + 1;

                let params = {
                    frm_date: $("#frm_date").val(),
                    to_date: $("#to_date").val(),
                    id: $("#user_id").val(),
                };
                Object.assign(d, params);
                return d;
            },
            dataSrc: function (json) {
                if (json.code === 200) {
                    let arrGetHelp = json.data.records;
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
                        data: "entry_time"
                    },
                    {
                        data: "withdraw_approved"
                    },
                    {
                        render: function (data, type, row) {
                            return `<span>${(row.amount).toFixed(2)}</span>`;
                        },
                    },
                    {
                        render: function (data, type, row) {
                            return `<span>${row.sell_coin.toFixed(11)}</span>`;
                        },
                    },
                    {
                        render: function (data, type, row) {
                            return `<span>${(row.sell_rate).toFixed(11)}</span>`;
                        },
                    },
                    {data:'to_address'},
                    {
                        render: function (data, type, row) {
                            if (row.withdraw_type == 2) {
                                return `<span>Token Wallet</span>`;
                            } else {
                                return `<span>Binary Wallet</span>`;
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
        table.ajax.reload(null, false);;
    });
    $("#onSearchClick").click(function () {
        var startDate = $("#frm_date").val();
        var endDate = $("#to_date").val();
        if (endDate < startDate) {
            toastr.error("To date should be greater than from date");
            return false;
            // alert("To date should not less than from date ");
        }
        table.ajax.reload(null, false);;
    });

    $("#onResetClick").click(function () {
        $("#searchForm").trigger("reset");
        username = "";
        isAvialable = "";
        table.ajax.reload(null, false);;
    });

});

function exportToExcel() {
    var params = {
        frm_date: $("#frm_date").val(),
        to_date: $("#to_date").val(),
        id: $("#user_id").val(),
        action: "export",
        responseType: "blob",
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrftoken
        }
    });

    $.ajax({
        url: "{{ url('1Rto5efWp86Z/user/sellTokenHistoryData') }}",
        type: "POST",
        data: params,
        dataType: "json",
        success: function (resp) {
            if (resp.code === 200) {
                var mystring = resp.data.data;
                var myblob = new Blob([mystring], {
                    type: "text/plain",
                });

                var fileURL = window.URL.createObjectURL(new Blob([myblob]));
                var fileLink = document.createElement("a");

                fileLink.href = fileURL;
                fileLink.setAttribute("download", "SellTokenReport.xls");
                document.body.appendChild(fileLink);

                fileLink.click();
            } else {
                alert(resp.message);
            }
        },
        error: function (xhr, status, error) {
            alert("An error occurred while exporting data.");
        }
    });


}


</script>
@endsection
