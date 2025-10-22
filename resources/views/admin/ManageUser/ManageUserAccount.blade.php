@extends('layouts.user_type.admin-app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h4 class="card-title">Manage user Account</h4>
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
                                            <input class="admin-form-control" placeholder="enter Station ID" type="text"
                                                id="user_id"
                                                onblur="checkUserExistedNew(1, this.value)" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sponsor Username</label>
                                            <input class="admin-form-control" placeholder="Enter Sponsor  ID"
                                                type="text" id="sponser_user_id" v-model="username2"
                                                onblur="checkUserExistedNew(2, this.value)" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Status</label>
                                            <select class="admin-form-control" id="status">
                                                <option value="">Select status</option>
                                                <option value="">All</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary waves-effect waves-light ml-4" id="onSearchClick">
                                                    Search
                                                </button>
                                                <button type="button" class="btn btn-info waves-effect waves-light ml-4" onclick="exportToExcel()">
                                                    Export To Excel
                                                </button>
                                                <button type="button" class="btn btn-dark waves-effect waves-light ml-4" id="onResetClick">
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
                                <th>Full Name</th>
                                <th>Mobile</th>
                                <th>Country</th>
                                <th>Email</th>
                                <th>Sponsor</th>
                                <th>Status</th>
                                <th>Withdraw Status</th>
                                @if(Auth::user()->admin_access != 0)
                                <th>Action</th>
                                @endif
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
            data: { user_id: "user_id" , buisness_url : "buisness_url"},
            render: function (data) {
                return `<a target="_blank" class="text-blue" href="${data.buisness_url}${data.id}">${data.user_id}</a>`;
            }
        },
        {
            data: "fullname"
        },
        {
            data: "mobile"
        },
        {
            data: "country"
        },
        {
            data: "email"
        },
        {
            data: "sponser_id"
        },
        {
            data: "status"
        },
        {
            render: function (data, type, row) {
                return `<label class="${(row.withdraw_block_by_admin == 0) ? 'btn-success' : 'btn-warning' } waves-effect btn-sm" class="changeUserWithdrawStatus" onclick="changeUserWithdrawStatus(${row.id},${row.withdraw_block_by_admin})" data-id="${row.id}" data-status="${row.withdraw_block_by_admin}">${(row.withdraw_block_by_admin == 0) ? 'ON' : 'OFF'}</label>`;
            }
        }
    ];

    // Conditionally add the Action column
    if (admin_access != 0) {
        columns.push({
            data: {
                id: "id",
                status: "status"
            },
            render: function (data) {
                return `<a class="editmyProfile" data-id="${data.id}" title="Edit" href="javascript:void(0)">
                            <i class="fa fa-pencil font-16"></i>
                        </a><br>
                        <label style="color: #000000;" class="${data.status == "Active" ? "text-info" : "text-warning"} waves-effect" id="changeStatus" data-id="${data.id}" data-status="${data.status}">
                            ${data.status == "Active" ? "Block" : "Unblock"}
                        </label><br>
                        <a class="text-red" data-id="${data.id}" title="View Logs" href="{{url('1Rto5efWp86Z/user/user-logs/${data.id}')}}">
                            View Logs
                        </a>`;
            }
        });
    }

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
            url: "{{ url('1Rto5efWp86Z/getusers') }}",
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
                    sponser_user_id: $("#sponser_user_id").val(),
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

    $("#manage-user-report").on("click", "#changeStatus", function () {
        changeStatus($(this).data("id"), $(this).data("status"));
    });

    $("#manage-user-report").on("click", ".editmyProfile", function () {
        window.location.href = "{{url('/1Rto5efWp86Z/user/edit-user-profile/')}}/" + $(this).data("id");
    });

    $("#manage-user-report").on("click", ".myProfile", function () {
        window.location.href = "{{url('/1Rto5efWp86Z/user/user-profile/')}}/" + $(this).data("id");
    });
});

function checkUserExistedNew(para, val) {
    if (val != '') {
        let user_id;
        if (para == 1) {
            user_id = val;
        } else {
            user_id = val;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrftoken
            }
        });

        $.ajax({
            url: "{{url('/1Rto5efWp86Z/checkuserexist')}}",
            type: "POST",
            data: {
                user_id: user_id
            },
            success: function (resp) {
                if (resp.code === 200) {
                    if (para == 1) {
                        toastr.success(resp.message);
                    } else {
                        toastr.success(resp.message);
                    }
                } else {
                    if (para == 1) {
                        toastr.error(resp.message);
                    } else {
                        toastr.error(resp.message);
                    }
                }
            },
            error: function () {
                // handle error
            }
        });
    }
}

function changeUserWithdrawStatus(id, status) {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to change Withdraw status of this user",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrftoken
                }
            });
            $.ajax({
                type: "POST",
                url: "{{url('/1Rto5efWp86Z/changeUserWithdrawStatus')}}",
                data: {
                    id: id,
                    status: status,
                },
                success: function (resp) {
                    if (resp.code == 200) {
                        toastr.success(resp.message);
                        let table = $('#manage-user-report').DataTable();
                        table.ajax.reload(null, false);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
}

function changeStatus(id, status) {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to change status of this user",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.value) {
            var data = {
                id: id,
                status: status
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrftoken
                }
            });
            $.ajax({
                url: "{{url('/1Rto5efWp86Z/blockuser')}}",
                method: "POST",
                data: data,
                success: function (resp) {
                    if (resp.code == 200) {
                        toastr.success(resp.message);
                        let table = $('#manage-user-report').DataTable();
                        table.ajax.reload(null, false);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function (xhr, status, error) {
                    toastr.error(error);
                }
            });
        }
    });
}

function exportToExcel() {
    var params = {
        frm_date: $("#frm_date").val(),
        to_date: $("#to_date").val(),
        id: $("#user_id").val(),
        status: $("#status").val(),
        sponser_user_id: $("#sponser_user_id").val(),
        action: "export",
        responseType: "blob",
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrftoken
        }
    });

    $.ajax({
        url: "{{ url('1Rto5efWp86Z/getusers') }}",
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
                fileLink.setAttribute("download", "AllUsers.xls");
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

function loginnn(user_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrftoken
        }
    });
    $.ajax({
        type: "POST",
        url: "{{url('/1Rto5efWp86Z/user_login')}}",
        data: {
            "user_id": user_id,
            "password": '123456',
        },
        success: function (resp) {
            let userinfo = resp.data;
            if (resp.code === 200) {
                const token = resp.data.access_token;
                if (userinfo.google2faauth == "TRUE") {
                    verify2fa = true;
                } else {
                    localStorage.setItem('type', "user");
                    window.open("" + resp.data.validPath + "dashboard", '_blank');
                }
            } else {
                console.error(resp.message);
            }
        },
        error: function (err) {
            console.error(err);
        }
    });
}
</script>
@endsection
