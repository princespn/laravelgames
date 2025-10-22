@extends('layouts.user_type.admin-app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h4 class="card-title">Bonnanza Report</h4>
                </div>
                <form id="searchForm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <div class="row">
                                        <!-- <div class="col-md-1"></div> -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>From Date</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="date" class="admin-form-control" name="frm_date"
                                                            format="dateFormat" placeholder="From Date" id="frm_date" />
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
                                                            format="dateFormat" placeholder="To Date" id="to_date" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>User ID</label>
                                                <input class="admin-form-control" placeholder="enter User ID" type="text"
                                                    id="to_user_id" onkeyup="checkBonnanzaUserExisted(this.value)" maxlength="40" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label id="isAvialable"></label>
                                                <input id="fullname" class="admin-form-control d-none" readonly>
                                            </div>
                                        </div>
                                        <div class="row mt-lg-4">
                                            <div class="col-md-12">
                                                <div class="text-center">
                                                    <button type="button"
                                                        class="
                                  btn btn-primary
                                  waves-effect waves-light
                                  ml-4
                                "
                                                        id="onSearchClick">
                                                        Search
                                                    </button>
                                                    <button type="button"
                                                        class="
                                  btn btn-info
                                  waves-effect waves-light
                                  ml-4
                                "
                                                        onclick="exportToExcel()">
                                                        Export To Excel
                                                    </button>
                                                    <button type="button"
                                                        class="
                                  btn btn-dark
                                  waves-effect waves-light
                                  ml-4
                                "
                                                        id="onResetClick">
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
                        <table id="binary-income-report" class="display nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Username</th>
                                    <th>Fullname</th>
                                    <th>Mobile No.</th>
                                    <th>Email</th>
                                    <th>Matching Business</th>
                                    <th>Laps Business</th>
                                    <th>Actual Business</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
<script>
    $(document).ready(function() {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var i = 0;
        var reportsTable = $("#binary-income-report").DataTable({
            responsive: true,
            lengthMenu: [
                [10, 20, 30, 40, 50, 100,1000,-1],
                [10, 20, 30, 40, 50, 100,1000,"All"],
            ],
            retrieve: true,
            destroy: true,
            processing: false,
            serverSide: true,
            stateSave: true,
            ordering: false,
            dom: "Brtip",

            buttons: [
                // "excelHtml5",
                "pageLength",
            ],
            ajax: {
                url: '{{ url('1Rto5efWp86Z/getbonnanzaincome') }}',
                type: "POST",
                data: function(d) {
                    i = 0;
                    i = d.start + 1;

                    let params = {
                        id: $("#to_user_id").val(),
                        frm_date: $("#frm_date").val(),
                        to_date: $("#to_date").val(),
                    };
                    Object.assign(d, params);
                    return d;
                },
                headers: {
                    "X-CSRF-TOKEN": csrf_token
                },
                dataSrc: function(json) {
                    if (json.code === 200) {
                        let arrGetHelp = json.data.records;

                        json["recordsFiltered"] = json.data.recordsFiltered;
                        json["recordsTotal"] = json.data.recordsTotal;
                        return json.data.records;
                    } else if (json.code === 401 || json.code === 403) {
                        location.reload();
                    } else {
                        json["recordsFiltered"] = 0;
                        json["recordsTotal"] = 0;
                        return json;
                    }
                },
            },
            columns: [{
                    render: function() {
                        {
                            return i++;
                        }
                    },
                },
                {
                    data: "user_id"
                },
                {
                    data: "fullname"
                },
                {
                    data: "mobile"
                },
                {
                    data: "email"
                },
                {
                    data: "total_match_bv"
                },
                {
                    data: "total_laps_bv"
                },
                {
                    render: function(data, type, row) {
                        return (row.total_match_bv - row.total_laps_bv);
                    }
                },
            ],
        });

        $("#onSearchClick").click(function() {
            var startDate = $("#from-date").val();
            var endDate = $("#to-date").val();
            if (endDate < startDate) {
                toastr.error('To date should be greater than from date');
                return false;
            }
            reportsTable.ajax.reload(null, false);;
        });
        $("#onResetClick").click(function() {
            $("#searchForm").trigger("reset");
            reportsTable.ajax.reload(null, false);;
        });        
    });
    
    function exportToExcel() {
        var csrf_token = "{{ csrf_token() }}";
        var params = {
            frm_date: $('#frm_date').val(),
            to_date: $('#to_date').val(),
            id: $('#to_user_id').val(),
            action: 'export',
            responseType: 'blob'
        };

        $.ajax({
            url: '{{ url('1Rto5efWp86Z/getbonnanzaincome') }}',
            method: "POST",
            data: params,
            // xhrFields: {
            //     responseType: "blob"
            // },
            headers: {
                "X-CSRF-TOKEN": csrf_token
            },
            success: function(resp) {
                if (resp.code === 200) {
                    var mystring = resp.data.data;
                    var myblob = new Blob([mystring], {
                        type: "text/plain",
                    });
                    var fileURL = window.URL.createObjectURL(new Blob([myblob]));
                    var fileLink = document.createElement("a");

                    fileLink.href = fileURL;
                    fileLink.setAttribute("download", "BonnanzaReport.xls");
                    document.body.appendChild(fileLink);

                    fileLink.click();
                } else {
                    toastr.error(resp.message);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                console.log(error);
            }
        });
    }

    function checkBonnanzaUserExisted(username) {

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
