@extends('layouts.user_type.admin-app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h4 class="card-title">Zoom Meeting Report</h4>
                </div>
                <form id="searchForm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
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
                        <table id="zoom-meeting-report" class="display nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Meeting Link</th>
                                    <th>Meeting ID</th>
                                    <th>Meeting Password</th>
                                    <th>Meeting Date</th>
                                    <th>Meeting Time</th>
                                    <th>Meeting Banner</th>
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
        $(document).ready(function() {
            qualifiedUsersReport();
        });

        function qualifiedUsersReport() {
            let i = 1;
            var csrf_token = "{{ csrf_token() }}";

            setTimeout(function() {
                const table = $("#zoom-meeting-report").DataTable({
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
                        "pageLength"
                    ],
                    ajax: {
                        url: "{{ url('1Rto5efWp86Z/zoom-meeting-completed-report') }}",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': csrf_token
                        },
                        data: function(d) {
                            i = 0;
                            i = d.start + 1;
                            let params = {
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
                            data: "recorded_session_youtube_link",
                            render: function(data, type, row) {
                                if (data === null || data === undefined || data === '') {
                                    return ``;
                                } else {
                                    return '<a href="'+data+'" target="_blank" class="btn btn-danger">Click Here</a>';
                                }
                                    
                            }
                        },
                        {
                            data: 'meeting_id'
                        },
                        {
                            data: 'meeting_password'
                        },
                        {
                            data: "meeting_date"
                        },
                        {
                            data: "meeting_time"
                        },
                        {
                            data: "zoom_banner",
                            render: function(data, type, row) {
                                return '<img class="img-fluid" src="'+data+'" style="height: 210px;">';
                            },
                        },
                        {

                        render: function(data, type, row) {
                        return `
                                <a class="editmyProfile waves-effect" data-id="${row.sr_no}" title="Edit">
                                    <i class="fa fa-pencil font-16"></i>Edit
                                </a>&nbsp;
                                <label class="text-danger waves-effect" id="removeTool" data-id="${row.sr_no}">Remove
                                </label>`;
                        },
                        },
                    ]
                });
                $(document).on('click', '.editmyProfile', function() {
                    var id = $(this).data('id');
                    // window.location.href = '1Rto5efWp86Z/edit-marketing-tool/' + id;;
                    window.location.href = "{{ url('1Rto5efWp86Z/edit-zoommeeting-completed') }}/" + id;
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

        $(document).on('click', '#removeTool', function() {
            var id = $(this).data('id');
            var csrf_token = "{{ csrf_token() }}";
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to remove this tool data?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    var data = {
                        tool_id: id
                    };
                    $.ajax({
                        url: "{{ url('1Rto5efWp86Z/remove-zoommeeting') }}",
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': csrf_token
                        },
                        data: data,
                        success: function(resp) {
                            if (resp.code == 200) {
                                toastr.success(resp.message);
                                // location.reload();
                                $('#zoom-meeting-report').DataTable().ajax.reload(null, false);
                                
                            } else {
                                toastr.error(resp.message);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            toastr.error('An error occurred while processing your request.');
                        }
                    });
                }
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
                url: "{{ url('1Rto5efWp86Z/zoom-meeting-completed-report') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                data: data,
                dataType: 'json',
                success: function(resp) {
                    if (resp.code === 200) {
                        var mystring = resp.data.data;
                        // console.log(resp.data.data);
                        var myblob = new Blob([mystring], {
                            type: 'text/plain'
                        });

                        var fileURL = window.URL.createObjectURL(new Blob([myblob]));
                        var fileLink = document.createElement('a');

                        fileLink.href = fileURL;
                        fileLink.setAttribute('download', 'ZoomMeetingsReport.xls');
                        document.body.appendChild(fileLink);

                        fileLink.click();
                    } else {
                        toastr.error(resp.message);
                    }
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
            $('#zoom-meeting-report').DataTable().ajax.reload(null, false);
        });
    </script>
@endsection
