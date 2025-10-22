@extends('layouts.user_type.admin-app')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h4 class="card-title">Add Fund History</h4>
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
                    <table v-once id="fund-add-history" class="display nowrap" style="width: 100%">
                        <thead>
                        <tr>
                                <th>Sr No.</th>
                                <th>Date</th>
                                <th>Transaction ID</th>
                                <th>Hash ID</th>
                                <th>Amount</th>
                                <th>Recived Amount</th>
                                <th>Payment Mode</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
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

     var table = $("#fund-add-history").DataTable({
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
            url: "{{ url('1Rto5efWp86Z/user/addFundData') }}",
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
        columns: [{
                        render: function() {
                            return i++;
                        },
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
                    {
                        render: function(data, type, row) {
                            return row.trans_id;
                        },
                    },
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
                            if (row.payment_mode && row.payment_mode.toLowerCase() == 'btc' || row.payment_mode && row.payment_mode.toLowerCase() == 'bch') {
                                return (
                                    "<span style='word-break: break-word;'>" +
                                    `<a href="https://www.blockchain.com/${(row.payment_mode).toLowerCase()}/address/${row.address}" target="_blank">${row.address}</a>` +
                                    "</span>"
                                );
                            } else if (row.payment_mode && row.payment_mode.toLowerCase() ==
                                'eth' || row.payment_mode && row.payment_mode.toLowerCase() ==
                                'usdt.erc20') {
                                return (
                                    "<span style='word-break: break-word;'>" +
                                    `<a href="https://etherscan.io/address/${row.address}" target="_blank">${row.address}</a>` +
                                    "</span>"
                                );
                            } else if (row.payment_mode && row.payment_mode.toLowerCase() ==
                                'trx' || row.payment_mode && row.payment_mode.toLowerCase() ==
                                'usdt.trc20') {
                                return (
                                    "<span style='word-break: break-word;'>" +
                                    `<a href="https://tronscan.org/#/address/${row.address}" target="_blank">${row.address}</a>` +
                                    "</span>"
                                );
                            } else if (row.payment_mode && row.payment_mode.toLowerCase() ==
                                'doge') {
                                return (
                                    "<span style='word-break: break-word;'>" +
                                    `<a href="https://dogechain.info/address/${row.address}" target="_blank">${row.address}</a>` +
                                    "</span>"
                                );
                            } else if (row.payment_mode && row.payment_mode.toLowerCase() ==
                                'ltc') {
                                return (
                                    "<span style='word-break: break-word;'>" +
                                    `<a href="https://live.blockcypher.com/${(row.payment_mode).toLowerCase()}/address/${row.address}" target="_blank">${row.address}</a>` +
                                    "</span>"
                                );
                            } else if (row.payment_mode && row.payment_mode.toLowerCase() ==
                                'sol') {
                                return (
                                    "<span style='word-break: break-word;'>" +
                                    `<a href="https://solscan.io/account/${row.address}" target="_blank">${row.address}</a>` +
                                    "</span>"
                                );
                            }
                            else if (row.payment_mode && row.payment_mode.toLowerCase() ==
                                'btg') {
                                return (
                                    "<span style='word-break: break-word;'>" +
                                    `<a href="https://explorer.bitcoingold.org/insight/address/${row.address}" target="_blank">${row.address}</a>` +
                                    "</span>"
                                );
                            }
                            else if (row.payment_mode && row.payment_mode.toLowerCase() ==
                                'zec') {
                                return (
                                    "<span style='word-break: break-word;'>" +
                                    `<a href="https://blockchair.com/zcash/address/${row.address}" target="_blank">${row.address}</a>` +
                                    "</span>"
                                );
                            }
                            else if (row.payment_mode && row.payment_mode.toLowerCase() ==
                                'etn') {
                                return (
                                    "<span style='word-break: break-word;'>" +
                                    `<a href="https://blockexplorer.electroneum.com/search?value=${row.address}" target="_blank">${row.address}</a>` +
                                    "</span>"
                                );
                            }
                            else if (row.payment_mode && row.payment_mode.toLowerCase() ==
                                'omni') {
                                return (
                                    "<span style='word-break: break-word;'>" +
                                    `<a href="https://omniexplorer.info/search/${row.address}" target="_blank">${row.address}</a>` +
                                    "</span>"
                                );
                            }
                            else if (row.payment_mode && row.payment_mode.toLowerCase() ==
                                'firo') {
                                return (
                                    "<span style='word-break: break-word;'>" +
                                    `<a href="https://firoblockexplorers.com/address/${row.address}" target="_blank">${row.address}</a>` +
                                    "</span>"
                                );
                            }
                            else if (row.payment_mode && row.payment_mode.toLowerCase() ==
                                'xvg') {
                                return (
                                    "<span style='word-break: break-word;'>" +
                                    `<a href="https://xvgblockexplorer.com/address/${row.address}" target="_blank">${row.address}</a>` +
                                    "</span>"
                                );
                            }
                            else{
                                return (
                                    "<span style='word-break: break-word;'>" +
                                    `${row.address}` +
                                    "</span>"
                                );
                            }


                        },
                    },

                    {
                        render: function(data, type, row) {
                            if (row.in_status == 0) {
                                return `<label class="text-warning fw-bold">Pending<label>`;
                            } else if (row.in_status == 2) {
                                return `<label class="text-danger" fw-bold>Expired<label>`;
                            } else if (row.in_status == 1) {
                                return `<label class="text-success fw-bold">Confirmed<label>`;
                            }
                        },
                    },

                    {
                        render: function(data, type, row) {
                            return "<a href='" + row.status_url + "' target='_blank' class='btn bg-gradient-primary'>Checkout</a>";
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
        url: "{{ url('1Rto5efWp86Z/user/addFundData') }}",
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
                fileLink.setAttribute("download", "AddFundReport.xls");
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
