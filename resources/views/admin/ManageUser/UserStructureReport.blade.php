@extends('layouts.user_type.admin-app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h4 class="card-title">User Create Structure Report</h4>
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Station ID</label>
                                            <input class="admin-form-control" placeholder="Enter Station ID" type="text"
                                                id="user_id"
                                                onblur="checkUserExistedNew(1, this.value)" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <button type="button" class="btn btn-sm btn-primary waves-effect waves-light ml-4" id="onSearchClick">
                                                    Search
                                                </button>
                                                <button type="button" class="btn btn-sm btn-info waves-effect waves-light ml-4" onclick="exportToExcel()">
                                                    Export To Excel
                                                </button>
                                                <button type="button" class="btn btn-sm btn-dark waves-effect waves-light ml-4" id="onResetClick">
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
                    <table v-once id="manage-user-report" class="display nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Entry Date</th>
                                <th>Station ID</th>
                                <th>No Of Stucture</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Amount</th>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
<script>
var base_url = '{{url('/')}}';
var csrftoken = $('meta[name="csrf-token"]').attr('content');
var admin_access = "{{ Auth::user()->admin_access }}"; // Pass the admin access value

$(document).ready(function() {
    let i = 1;
    var csrf_token = "{{ csrf_token() }}";

    var columns = [
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
                }
            },
        },
        {
            data: "structure_created_by"
        },
        {
            data: "no_structure"
        },
        {
            data: "fullname"
        },
        {
            data: "email"
        },
        {
            data: "amount_topup"
        },
        {
            render: function (data, type, row) {
                return `<label class="${(row.status == 1) ? 'text-info' : 'text-warning'}" >${(row.status == 1) ? 'Complated' : 'Pending'}</label>`;
            }
        },
         {
            render: function (data, type, row) {
                return `
                    <a class="text-white btn-yahoo btn btn-sm" data-id="${row.id}" title="View Logs"
                        href="${base_url}/1Rto5efWp86Z/user/view-structure/${row.id}">
                        View
                    </a>`;
            }
        },
    ];
    var table = $("#manage-user-report").DataTable({
        responsive: true,
        retrieve: true,
        destroy: true,
        processing: false,
        serverSide: true,
        stateSave: false,
        ordering: false,
        dom: "Brtip",
        lengthMenu: [
            [10, 20, 30, 40, 50, 100, 1000, -1],
            [10, 20, 30, 40, 50, 100, 1000, "All"],
        ],
        buttons: [
            "pageLength",
        ],
        ajax: {
            url: "{{ url('1Rto5efWp86Z/get-user-structure') }}",
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
                    status: $("#status").val(),
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
        columns: columns
    });

    $("#onSearchClick").click(function () {
        var startDate = $("#frm_date").val();
        var endDate = $("#to_date").val();
        if (endDate < startDate) {
            toastr.error("To date should be greater than from date");
            return false;
        }
        table.ajax.reload(null, false);
    });

    $("#onResetClick").click(function () {
        $("#searchForm").trigger("reset");
        table.ajax.reload(null, false);
    });
});

function exportToExcel() {
    var params = {
        frm_date: $("#frm_date").val(),
        to_date: $("#to_date").val(),
        id: $("#user_id").val(),
        status: $("#status").val(),
        action: "export",
        responseType: "blob",
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrftoken
        }
    });

    $.ajax({
        url: "{{ url('1Rto5efWp86Z/get-user-structure') }}",
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
                fileLink.setAttribute("download", "CreateUserStructureReport.xls");
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
