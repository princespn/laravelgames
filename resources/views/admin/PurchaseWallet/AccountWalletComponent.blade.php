s@extends('layouts.user_type.admin-app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h4 class="card-title">Account Wallet Report</h4>
                </div>
                <form id="searchForm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4 ml-4">
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
                                        <div class="col-md-4">
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
                                                <label>User ID</label>
                                                <input class="admin-form-control" placeholder="enter User ID" type="text"
                                                    id="user_id" onkeyup="checkUserExisted(this.value)" />
                                                <p></p>
                                                <span></span>
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

                <div class="row" id="withdraw-summary"></div>
                <div class="row">
                    <div class="col-12">
                        <div class="admin-card-body">
                            <div class="table-responsive admin-table">
                                <table id="account-wallet-report" class="display nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>username</th>
                                            <th>Total Income</th>
                                            <th>Account Wallet Balance</th>
                                            <th>Topup Wallet Balance</th>
                                            <th>Entry Date</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Total Balance</th>
                                            <th id="withdraw" style="color: red"></th>
                                            <th id="inv" style="color: red"></th>
                                            <th id="fund_bal" style="color: red"></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            roiIncomeReport();
        });

        function roiIncomeReport() {
            // let i = 1;
            var csrf_token = "{{ csrf_token() }}";

            setTimeout(function() {
                const table = $("#account-wallet-report").DataTable({
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
                        url: '{{ url('1Rto5efWp86Z/getaccountwallet') }}',
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
                            }
                        },
                        {
                            render: function(data, type, row) {
                                return "<span>" + row.user_id + "</span><span>(" + row.fullname +
                                    ")</span>";
                            }
                        },
                        {
                            render: function(data, type, row) {
                                return "<span>$" + (row.working_wallet).toFixed(2) + "</span>";
                            }
                        },
                        {
                            render: function(data, type, row) {
                                return "<span>$" + (row.working_wallet) - (data
                                    .working_wallet_withdraw).toFixed(2) + "</span>";
                            }
                        },
                        {
                            render: function(data, type, row) {
                                return "<span>$" + (row.fund_wallet) - (data.fund_wallet_withdraw)
                                    .toFixed(2) + "</span>";
                            }
                        },
                        {
                            render: function(data, type, row) {
                                return "<span>$" + row.passive_wallet + "</span>";
                            }
                        },
                        {
                            render: function(data, type, row) {
                                return "<span>$" + row.passive_income + "</span>";
                            }
                        },
                        {
                            render: function(data, type, row) {
                                if (row.entry_time === null || row.entry_time === undefined || row
                                    .entry_time === '') {
                                    return "-";
                                } else {
                                    return row.entry_time;
                                }
                            }
                        },
                    ],
                });

               

            });
        }

        $("#onSearchClick").click(function() {
                    alert("ok");
                    var startDate = $("#frm_date").val();
                    var endDate = $("#to_date").val();
                    if (endDate < startDate) {
                        toastr.error("To date should be greater than from date");
                        return false;
                        // alert("To date should not less than from date ");
                    }
                    table.ajax.reload(null, false);;
                });
                
        $(document).ready(function() {
            var withdrawsummary = [ /* array of objects */ ];

            $.each(withdrawsummary, function(index, summary) {
                var panel = $("<div>").addClass("panel");
                var panelBody = $("<div>").addClass("panel-body");
                var title = $("<h5>").addClass("panel-title text-muted");
                var currency = $("<span>").text("Total " + summary.currency + " Amount");
                var amount = $("<span>").addClass("pull-right").text(summary.total_amount);

                title.append(currency);
                title.append(amount);
                panelBody.append(title);
                panel.append(panelBody);

                $("<div>").addClass("col-md-3 col-sm-6").append(panel).appendTo("#withdraw-summary");
            });
        });

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
                url: '{{ url('1Rto5efWp86Z/getaccountwallet') }}',
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
                    fileLink.setAttribute('download', 'Account-Wallet-Report.xls');
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
            $('#account-wallet-report').DataTable().ajax.reload(null, false);
        });
    </script>
@endsection
