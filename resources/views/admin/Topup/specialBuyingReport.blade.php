@extends('layouts.user_type.admin-app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h4 class="page-title">Special Buying Report</h4>
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
                                                        <input type="date" class="admin-form-control" name="frm_date" placeholder="From Date" id="frm_date" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>To Date</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="date" class="admin-form-control" name="to_date" placeholder="To Date" id="to_date" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Station ID</label>
                                                <input class="admin-form-control" onkeyup="checkUserExisted(this.value)" placeholder="enter Station ID" type="text" id="user_id" />
                                            </div>
                                        </div>
    
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-primary  waves-effect waves-light ml-4" id="onSearchClick">
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
                            </div>
                        </div>
                    </div>
                </form>

                <div class="admin-card-body">
                    <div class="table-responsive admin-table">
                        <table v-once id="buying-user-report" class="display nowrap" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Date</th>
                                <th>To Station ID</th>
                                <th>Amount</th>
                                <th>Binary Deduction %</th>
                                <th>Remark</th>
                                {{-- <th>Action</th> --}}
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
            powerReport();
        });

  

        function powerReport() {
            let i = 0;
            var csrf_token = "{{ csrf_token() }}";
            setTimeout(function() {
                const table = $('#buying-user-report').DataTable({
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
                    "createdRow": function (row, data, dataIndex) {
            // Add a click event to the button with class 'btn-open-modal'
            $(row).on('click', '.btn-open-modal', function () {
                var id = $(this).data('id');

                // Open SweetAlert2 modal
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to proceed?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Handle the confirmation, e.g., make an AJAX request
                        $.ajaxSetup({
                        headers: {
                        'X-CSRF-TOKEN': csrf_token
                        }
                        });
                        $.ajax({
                        url: '{{url('/1Rto5efWp86Z/releaseCoins')}}',
                        method: 'POST',
                        data: {'id' : id},
                        success: (resp) => {
                            if (resp.code === 200) {
                            toastr['success'](resp.status);
                            window.location.reload();
                            } else {
                            toastr['error'](resp.status);
                            window.location.reload();
                            }
                        },
                        error: (err) => {
                            //this.otp = "";
                        // this.$toast.error(err);
                        // Command: toastr['error'](err);
                        }
                        });
                    }
                });
            });
        },
                   
                    ajax: {
                        url: '{{ url('1Rto5efWp86Z/special-buying-report-data') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf_token
                        },
                        data: function(d) {
                            i = 0;
                            i = d.start + 1;
                            let params = {
                                frm_date: $('#frm_date').val(),
                                to_date: $('#to_date').val(),
                                user_id: $('#user_id').val(),
                            };
                            Object.assign(d, params);
                            return d;
                        },
                        dataSrc: function(json) {
                            if (json.code === 200) {
                                json['recordsFiltered'] = json.data.recordsFiltered;
                                json['recordsTotal'] = json.data.recordsTotal;
                                return json.data.records;
                            } else if (json.code === 401 || json.code === 403) {
                                localStorage.removeItem("admin_token");
                                location.reload();
                            } else {
                                $('#totalSum').html(0);
                                json['recordsFiltered'] = 0;
                                json['recordsTotal'] = 0;
                                return json;
                            }
                        }
                    },
                    columns: [
                        {
                            render: function() {
                                return i++;
                            },
                        },
                        {
                            render: function(data, type, row) {
                                if (row.entry_time === null || row.entry_time === undefined || row
                                    .entry_time === '') {
                                    return `-`;
                                } else {
                                    return row.entry_time;
                                }
                            }
                        },
                        {
                            data: 'to_user_id'
                        },
                        {
                            data: 'amount'
                        },
                        {
                            data: 'binary_deduction_percent'
                        },
                        
                        
                        {
                            data: 'remark'
                        },
                //         {
                //         render: function (data, type, row) {
                //         if (row.relase_status == 0) {
                //             return `<button class="btn btn-primary btn-sm btn-open-modal" data-id="${row.id}">Relase</button>`;
                //         }else{
                //             return ``;
                //         }
                //         }
                // },
                    ]
                });
                $('#onSearchClick').click(function() {
                    table.ajax.reload(null, false);;
                });
                $('#onResetClick').click(function() {
                    $('#searchForm').trigger("reset");
                    table.ajax.reload(null, false);;
                });
            }, 0);
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
                url: '{{ url('1Rto5efWp86Z/special-buying-report-data') }}',
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
                    fileLink.setAttribute('download', 'Special-Buying-Report.xls');
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
            $('#manage-user-report').DataTable().ajax.reload(null, false);
        });
    </script>
@endsection
