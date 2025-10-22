@extends('layouts.user_type.admin-app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h4 class="card-title">Direct Signup Report</h4>
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
                                                <p></p>
                                                <span></span>
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
                <div class="admin-card-body">
                    <div class="table-responsive admin-table">
                        <table v-once id="direct-signup-report" class="display nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Date</th>
                                    <th>Direct Signup</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Deposit Received</th>
                                    <th>Active Package</th>
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

        function roiIncomeReport() {
            // let i = 1;
            var csrf_token = "{{ csrf_token() }}";

            setTimeout(function() {
                const table = $("#direct-signup-report").DataTable({
                    responsive: true,
                    retrieve: true,
                    destroy: true,
                    processing: false,
                    serverSide: true,
                    stateSave: false,
                    ordering: false,
                    dom: "Brtip",
                    language: {
                        "emptyTable": "Please search username for Direct Signup Report"
                    },
                    lengthMenu: [
                        [10, 20, 30, 40, 50, 100,1000,-1],
                        [10, 20, 30, 40, 50, 100,1000,"All"],
                    ],
                    buttons: [
                        "pageLength"
                    ],
                    ajax: {
                        url: '{{ url('1Rto5efWp86Z/get-direct-signup-report') }}',
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': csrf_token
                        },
                        data: function(d) {
                            i = 0;
                            i = d.start + 1;
                            let params = {
                                user_id: $("#user_id").val(),
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
                            },
                        },
                        {
                            render: function(data, type, row) {
                                if (row.entry_time === null || row.entry_time === undefined || row
                                    .entry_time === '') {
                                    return '-';
                                } else {
                                    // return moment(String(row.entry_time)).format('YYYY-MM-DD');
                                    return row.entry_time;
                                }
                            }
                        },
                        {
                            render: function(data, type, row) {
                                return '<span>' + row.user_id + '</span>';
                            }
                        },
                        {
                            render: function(data, type, row) {
                                return '<span>' + row.fullname + '</span>';
                            }
                        },
                        {
                            render: function(data, type, row) {
                                return '<span>' + row.email + '</span>';
                            }
                        },
                        {
                            render: function(data, type, row) {
                                return '<span>' + row.mobile + '</span>';
                            }
                        },
                        {
                            render: function(data, type, row) {
                                return '<span>$' + row.total_topup + '</span>';
                            }
                        },
                        {
                            render: function(data, type, row) {
                                if (row.last_topup === null || row.last_topup === undefined || row
                                    .last_topup === '') {
                                    return '-';
                                } else {
                                    return '<span>' + row.last_topup + '</span>';
                                }
                            }
                        },
                        {
                            render: function(data, type, row) {
                                var labelClass = row.user_status == 'Active' ? 'text-info' :
                                    'text-warning';
                                return '<label class="' + labelClass + ' waves-effect">' + row
                                    .user_status + '</label>';
                            }
                        }
                    ],
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


        function exportToExcel() {
            var csrf_token = "{{ csrf_token() }}";
            var data = {
                user_id: $("#user_id").val(),
                frm_date: $("#frm_date").val(),
                to_date: $("#to_date").val(),
                action: "export",
                responseType: "blob",
            };

            $.ajax({
                url: '{{ url('1Rto5efWp86Z/get-direct-signup-report') }}',
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
                    fileLink.setAttribute('download', 'Direct-Signup-Report.xls');
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
            $('#direct-signup-report').DataTable().ajax.reload(null, false);
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
