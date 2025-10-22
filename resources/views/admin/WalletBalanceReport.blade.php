@extends('layouts.user_type.admin-app')
@section('content')
<style>
    table.dataTable tbody tr.influencer {
        background: #B9EDDD;
    }
    
</style>
    <div class="row">
        <div class="col-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h4 class="card-title">Wallet Balance Report</h4>
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
                                                <label>User ID</label>
                                                <input class="admin-form-control" placeholder="enter User ID" type="text"
                                                    id="user_id" onkeyup="checkUserExisted(this.value)" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label id="isAvialable"></label>
                                                <input id="fullname" class="admin-form-control d-none">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <div class="text-center">
                                                    <button type="button"
                                                        class="btn btn-primary  waves-effect waves-light ml-4"
                                                        id="onSearchClick">
                                                        Search
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-info waves-effect waves-light ml-4"
                                                        onclick="exportToExcel()">
                                                        Export To Excel
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-dark waves-effect waves-light ml-4"
                                                        id="onResetClick">
                                                        Reset
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="admin-card-body">
                    <div class="table-responsive admin-table">
                        <table id="binary-income-report" class="display nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Date</th>
                                    <th>Username</th>
                                    <th id="fundth">Fund wallet</th>
                                    <th id="topup">Total Topup</th>
                                    <th id="workingth">Income Wallet</th>
                                    <th>Topup by</th>
                                    <th>Topup Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            roiIncomeReport();
        });

        function dateFormat(date) {
            return moment(date).format("DD-MM-YYYY");
        }

        function disableFutureDate() {
            let today = new Date();
            let dd = today.getDate();
            let mm = today.getMonth() + 1; //January is 0!
            let yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
            today = yyyy + '-' + mm + '-' + dd;
            $("#to_date").attr("max", today);
            $("#frm_date").attr("max", today);
        }

        function exportToExcel() {
            var csrf_token = "{{ csrf_token() }}";
            var data = {
                product_id: $("#product_id").val(),
                id: $("#user_id").val(),
                status: $("#status").val(),
                pin: $("#pin").val(),
                frm_date: $("#frm_date").val(),
                to_date: $("#to_date").val(),
                action: "export",
                responseType: "blob",
            };
            $.ajax({
                url: '{{ url('1Rto5efWp86Z/getwalletbalance') }}',
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                data: data,
                dataType: "json",
                success: function(resp) {
                    if (resp.code === 200) {
                        var mystring = resp.data.data;
                        var myblob = new Blob([mystring], {
                            type: "text/plain",
                        });

                        var fileURL = window.URL.createObjectURL(new Blob([myblob]));
                        var fileLink = document.createElement("a");

                        fileLink.href = fileURL;
                        fileLink.setAttribute("download", "Wallet-Balance-Report.xls");
                        document.body.appendChild(fileLink);

                        fileLink.click();
                    } else {
                        alert(resp.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                },
            });
        }

        function changeUserRoiStatus(id) {
            new Swal({
                title: "Are you sure?",
                text: `You want to change ROI status of this user`,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.value) {
                    var csrf_token = "{{ csrf_token() }}";
                    $.ajax({
                        url: "{{ url('1Rto5efWp86Z/topupchangroistop') }}",
                        type: "POST",
                        data: {
                            sr_no: id,
                            // status: status,
                        },
                        headers: {
                            'X-CSRF-TOKEN': csrf_token
                        },
                        success: function(resp) {
                            if (resp.code == 200) {
                                toastr.success(resp.message);
                                $('#binary-income-report').DataTable().ajax.reload(null, false);
                            } else {
                                toastr.error(resp.message);
                            }
                        },
                        error: function() {
                            toastr.error("An error occurred while changing ROI status.");
                        }
                    });
                }
            });
        }

        function roiIncomeReport() {
            let i = 1;
            var csrf_token = "{{ csrf_token() }}";

            setTimeout(function() {
                var table = $("#binary-income-report").DataTable({
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
                        url: '{{ url('1Rto5efWp86Z/getwalletbalance') }}',
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
                           // console.log(json.data.records);
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
                                    row.userdetails.entry_time === null ||
                                    row.userdetails.entry_time === undefined ||
                                    row.userdetails.entry_time === ""
                                ) {
                                    return "-";
                                } else {
                                    // return moment(String(row.entry_time)).format(
                                    //     "YYYY-MM-DD"
                                    // );
                                    return row.userdetails.entry_time;
                                }
                            },
                        },
                        {
                            render: function(data, type, row) {
                                return "<span>" + row.userdetails.user_id + "</span>";
                            },
                        },
                        {
                            data: null,
                            orderable: true,
                            render: function(data, type, row) {
                                return "<span>" + (row.userdetails.fund_wallet - row.userdetails.fund_wallet_withdraw) + "</span>";
                            },
                        },
                        {
                            data: null,
                            orderable: true,
                            render: function(data, type, row) {
                                return "<span>" + (row.userdetails.amount) + "</span>";
                            },
                        },
                        {
                            data: null,
                            orderable: true,
                            render: function(data, type, row) {
                                return "<span>" + (row.userdetails.working_wallet - row.userdetails.working_wallet_withdraw) + "</span>";
                            },
                        },
                       
                        {
                            data: "topup_by"
                        },
                        {
                            data: "top_up_type"
                        },                        
                        
                        {
                            render: function(data, type, row){
                                if(row.userdetails.topup_status == "1")
                                {
                                    return "Activated";
                                }
                                else{
                                    return "Inactive";
                                }
                            }
                        },
                        
                    ],
                    rowCallback: function(row, data) {
                            // Check the condition for changing the background color
                            var package_type = data.package_type;
                            if (package_type == "Influencer") {
                                // Apply the background color to the row
                                $(row).addClass('influencer');
                            }
                        }
                });


                
            $('#roith').click(function() {
            // get the column index that was clicked
                var columnIdx = table.column($(this)).index();
                
                // get the current sort order for that column
                var currentOrder = table.order()[0];
                console.log(currentOrder)
                
                // set the new sort order
                var newOrder = currentOrder[0] === columnIdx && currentOrder[1] === 'asc' ? [columnIdx, 'desc'] : [columnIdx, 'asc'];
                
                // trigger the AJAX call with the new sort order
                table.ajax.url("{{ url('1Rto5efWp86Z/getwalletbalance_orderby_roi') }}").load();
                });


                $('#fundth').click(function() {
            // get the column index that was clicked
                var columnIdx = table.column($(this)).index();
                
                // get the current sort order for that column
                var currentOrder = table.order()[0];
                console.log(currentOrder)
                
                // set the new sort order
                var newOrder = currentOrder[0] === columnIdx && currentOrder[1] === 'asc' ? [columnIdx, 'desc'] : [columnIdx, 'asc'];
                
                // trigger the AJAX call with the new sort order
                table.ajax.url("{{ url('1Rto5efWp86Z/getwalletbalance_orderby_fund') }}").load();
                });
                 
                $('#hsccth').click(function() {
            // get the column index that was clicked
                var columnIdx = table.column($(this)).index();
                
                // get the current sort order for that column
                var currentOrder = table.order()[0];
                console.log(currentOrder)
                
                // set the new sort order
                var newOrder = currentOrder[0] === columnIdx && currentOrder[1] === 'asc' ? [columnIdx, 'desc'] : [columnIdx, 'asc'];
                
                // trigger the AJAX call with the new sort order
                table.ajax.url("{{ url('1Rto5efWp86Z/getwalletbalance_orderby_hscc') }}").load();
                });

                $('#workingth').click(function() {
            // get the column index that was clicked
                var columnIdx = table.column($(this)).index();
                
                // get the current sort order for that column
                var currentOrder = table.order()[0];
                console.log(currentOrder)
                
                // set the new sort order
                var newOrder = currentOrder[0] === columnIdx && currentOrder[1] === 'asc' ? [columnIdx, 'desc'] : [columnIdx, 'asc'];
                
                // trigger the AJAX call with the new sort order
                table.ajax.url("{{ url('1Rto5efWp86Z/getwalletbalance_orderby_working') }}").load();
                });

                
                

                $("#onSearchClick").click(function() {
                    var startDate = $("#frm_date").val();
                    var endDate = $("#to_date").val();
                    if (endDate < startDate) {
                        toastr.error("To date should be greater than from date");
                        return false;
                        // alert("To date should not less than from date ");
                    }
                    table.ajax.reload(null, false);;
                });


                




            });
        }

       

        $("#onResetClick").click(function() {
            $("#searchForm").trigger("reset");
            var startDate = $("#frm_date").val("");
            var endDate = $("#to_date").val("");
            var user_id = $("#user_id").val("");
            $('#binary-income-report').DataTable().ajax.reload(null, false);
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
