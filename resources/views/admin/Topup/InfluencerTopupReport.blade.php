@extends('layouts.user_type.admin-app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h4 class="card-title">Influencer Top Up Report</h4>
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
                                                <p></p>
                                                <span></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label id="isAvialable"></label>
                                                <input id="fullname" class="admin-form-control d-none" disabled>
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
                        <table v-once id="binary-income-report" class="display nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Station ID</th>
                                    <th>Deposit ID</th>
                                    <th>Amount</th>
                                    <th>Package</th>
                                    <th>Topup by</th>
                                    <th>Topup Type</th>
                                    <th>Topup From</th>
                                    <th>ROI Status</th>
                                    <th>Date</th>

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
            let i = 1;
            var csrf_token = "{{ csrf_token() }}";

            setTimeout(function() {
                const table = $("#binary-income-report").DataTable({
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
                        url: '{{ url('1Rto5efWp86Z/get_influencer_topup') }}',
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
                            "render": function() {
                                return i++;
                            },
                        },
                        {
                            "render": function(data, type, row) {
                                return '<span>' + row.user_id + '</span>';
                                /*<span>(${row.fullname})</span>*/
                            }
                        },
                        {
                            "data": "pin"
                        },
                        /*{ "data": "amount" },*/
                        {
                            "render": function(data, type, row) {
                                return '<span>$' + row.amount + '</span>';
                            }
                        },
                        {
                            "data": "package_type"
                        },
                        /*{
                          "render": function (data, type, row) {
                            if (row.doxy_amount_2 != null) {
                              return '<span>' + row.doxy_amount_2 + '</span>  ';
                            } else if (row.doxy_amount != null) {
                              return '<span>' + row.doxy_amount + '</span>  ';
                            } else {
                              return '<span></span>';
                            }
                          }
                        },*/
                        /*{ "data": "name" },*/
                        {
                            "data": "top_up_by"
                        },
                        {
                            "data": "top_up_type"
                        },
                        {
                            "render": function(data, type, row) {
                                if (row.topupfrom == "1" || row.topupfrom == 1) {
                                    return 'Admin';
                                } else {
                                    return row.topupfrom;
                                }
                            },
                        },
                        {
                            "render": function(data, type, row) {
                                if (row.package_type != "Zero PIN") {
                                    return '<label class="' + (row.roi_stop_status == 1 ?
                                            'text-info btn-success' : 'text-warning btn-warning') +
                                        ' waves-effect btn-sm" onclick="changeUserRoiStatus(' + row.srno +
                                        ')">' + (row.roi_stop_status == 1 ? 'ON' : 'OFF') +
                                        '</label>';
                                } else {
                                    return '-';
                                }
                            }
                        },
                        /*{ "data": "franchise_user_id" },*/
                        /*{ "data": "payment_type" },*/
                        /*{ "data": "withdraw" },*/
                        // { "data": "topupfrom" },
                        // {
                        //   "render": function () {
                        //     return 'Admin'

                        //   },
                        // },
                        /*{
                          "render": function (data, type, row) {
                            if (row.trans_hash != null) {
                              return '<a href="' + row.link_trans_hash + '" target="_blank">' + row.trans_hash + '</a>';
                            } else {
                              return '';
                            }
                          }
                        },*/
                        {
                            "render": function(data, type, row) {
                                if (row.entry_time === null || row.entry_time === undefined || row
                                    .entry_time === '') {
                                    return '-';
                                } else {
                                    // return moment(String(row.entry_time)).format('YYYY-MM-DD');
                                    return row.entry_time;
                                }
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

        function changeUserRoiStatus(id) {
            new Swal({
                title: "Are you sure?",
                text: "You want to change ROI status of this user",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.value) {
                    var csrf_token = "{{ csrf_token() }}";
                    $.ajax({
                        type: "POST",
                        url: "{{ url('1Rto5efWp86Z/topupchangroistop') }}",
                        headers: {
                            'X-CSRF-TOKEN': csrf_token
                        },
                        data: {
                            sr_no: id,
                            // status: status,
                        },
                        success: function(resp) {
                            if (resp.code == 200) {
                                toastr.success(resp.message);
                                $('#binary-income-report').DataTable().ajax.reload(null, false);
                            } else {
                                toastr.error(resp.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        },
                    });
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
                url: '{{ url('1Rto5efWp86Z/get_influencer_topup') }}',
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
                    fileLink.setAttribute('download', 'Influencer-TopUp-Report.xls');
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
