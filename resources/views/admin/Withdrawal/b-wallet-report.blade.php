@extends('layouts.user_type.admin-app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h4 class="card-title">B Wallet Report</h4>
                </div>
                <br />
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

                    </div>
                </form>


                <div class="admin-card-body">
                    <div class="table-responsive admin-table">
                        <table id="b-wallet-report" class="display nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Date</th>
                                    <th>Station ID</th>
                                    <th>Mobile</th>
                                    <th>Wallet Amount</th>
                                    <th>Wallet Withdrawal Amount</th>
                                    <th>Wallet Remaining Amount</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="container-fluid text-center">
                        <div class="row">
                            <div class="col-md-3">
                                <h5 id="total_wallet_amount"></h5>
                            </div>
                            <div class="col-md-3">
                                <h5 id="total_wallet_withdrawal_amount" class="fs-15"></h5>
                            </div>
                            <div class="col-md-3">
                                <h5 id="total_wallet_remaining_amount" class="fs-15"></h5>
                            </div>
                            <div class="col-md-3">
                                <h5 id="net_amount"></h5>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-remark-modal">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                        <span aria-hidden="true" class="fa fa-times"></span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel">Enter OTP</h5>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label>Enter Amount</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="admin-form-control" name="amount" id="amount" placeholder="Enter Amount"></input>
                        </div>
                    </div>
                    <input type="hidden" name="wallet_id" id="wallet_id" value="">
                    <input type="hidden" name="wallet_remaining_amount" id="wallet_remaining_amount" value="">
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label>Enter OTP</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="admin-form-control" name="admin_otp" id="adminOTP"
                                required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" class="btn btn-facebook" onclick="amountVerify()">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <script>
        var arrayForSelectedCheckbox = [];
        $(document).ready(function() {
            withdrawRequestReport();
        });

        function withdrawRequestReport() {
            // let i = 1;
            var csrf_token = "{{ csrf_token() }}";

            setTimeout(function() {
                const table = $("#b-wallet-report").DataTable({
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
                        url: '{{ url('1Rto5efWp86Z/b-wallet-data') }}',
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
                                $('#total_wallet_amount').text('Total Amount : ' + json.data.total_wallet_amount);
                                $('#total_wallet_withdrawal_amount').text('Total Withdraw Amount : ' + json.data.total_wallet_withdrawal_amount);
                                $('#total_wallet_remaining_amount').text('Total Remaining Amount : ' + json.data.total_wallet_remaining_amount);
                                $('#net_amount').text('Net Amount : ' + json.data.net_amount);
                                json["recordsFiltered"] = json.data.recordsFiltered;
                                json["recordsTotal"] = json.data.recordsTotal;
                                return json.data.records;
                            } else if (json.code === 401 || json.code === 403) {
                                localStorage.removeItem("admin_token");
                                location.reload();
                            } else {
                                $('#total_wallet_amount').text('Total Amount : ' + json.data.total_wallet_amount);
                                $('#total_wallet_withdrawal_amount').text('Total Withdraw Amount : ' + json.data.total_wallet_withdrawal_amount);
                                $('#total_wallet_remaining_amount').text('Total Remaining Amount : ' + json.data.total_wallet_remaining_amount);
                                $('#net_amount').text('Net Amount : ' + json.data.net_amount);
                                json["recordsFiltered"] = 0;
                                json["recordsTotal"] = 0;
                                return json;
                            }
                        }
                    },
                    columns: [
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
                                    // return moment(String(data)).format("YYYY-MM-DD");
                                }
                            },
                        },
                        {
                            data: { user_id: "user_id", fullname: "fullname" },
                            render: function (data) {
                                return `<span>${data.user_id}</span><span> ( ${data.fullname} )</span>`;
                            },
                        },
                        { data: "mobile" },
                        {
                            data: "wallet_amount",
                            render: function (data) {
                                return `${Number(data)}`;
                            },
                        },
                        {
                            data: "wallet_withdrawal_amount",
                            render: function (data) {
                                return `${Number(data)}`;
                            },
                        },
                        {
                            data: "wallet_remaining_amount",
                            render: function (data) {
                                return `${Number(data)}`;
                            },
                        },
                        // {
                        //     render: function (data, type, row) {
                        //         if (row.wallet_remaining_amount > 0) {
                        //             return `<label class="btn btn-sm btn-instagram fw-bold" id="releasebtn" onclick="releaseAmount(${row.wallet_id} ,${row.wallet_remaining_amount})">Release Amount</label>`;
                        //         } else {
                        //             return '';
                        //         }
                        //     }
                        // }                        
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
                    table.ajax.reload(null, false);
                });               

            }, 0);
        }

        function closeModal() {
            $("#add-remark-modal").modal("hide");
        }

        function releaseAmount(id, wallet_amount) {
            Swal.fire({
                title: "Are you sure?",
                text: "You want to Release Amount of this user",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.value) {
                    var csrf_token = "{{ csrf_token() }}";
                    var data = {
                        type: 1
                    };
                    $("#add-remark-modal").modal("show");
                    $("#releasebtn").prop("disabled", true);
                    $.ajax({
                        url: "{{ url('1Rto5efWp86Z/send-otp-withdraw-mail') }}",
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': csrf_token
                        },
                        success: function (resp) {
                            if (resp.code == 200) {
                                $("#wallet_id").val(id);
                                $("#wallet_remaining_amount").val(wallet_amount);
                               toastr.success(resp.message);                                
                                $("#releasebtn").prop("disabled", false);
                            } else {
                                toastr.error(resp.message)
                                $("#releasebtn").prop("disabled", false);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });
        }
       
        function amountVerify() {
            var csrf_token = "{{ csrf_token() }}";
            var id = $("#wallet_id").val();
            var otp = $("#adminOTP").val();
            var amount = parseInt($("#amount").val());
            var wallet_remaining_amount = parseInt($("#wallet_remaining_amount").val());

            if (wallet_remaining_amount < amount) {
                toastr.error("Release amount should be less or equal to remaining wallet amount.");
                return false;
            }
            if (otp !== "") {
                var data = {
                    wallet_id: id,
                    otp: otp,
                    amount: amount,
                };
                $.ajax({
                    type: "POST",
                    url: "{{ url('1Rto5efWp86Z/release-wallet-amount') }}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    },
                    success: function(resp) {
                        if (resp.code === 200) {
                            $("#add-remark-modal").modal("hide");
                            $('#amount').val("");
                            $('#adminOTP').val("");
                            toastr.success(resp.message);
                            var table = $("#b-wallet-report").DataTable();
                            table.ajax.reload(null, false);
                            $("#releasebtn").prop("disabled", false);
                        } else {
                            toastr.error(resp.message);
                            $("#releasebtn").prop("disabled", false);
                            $("#add-remark-modal").modal("hide");
                            $('#adminOTP').val("");
                            $('#amount').val("");
                        }
                    },
                    error: function() {
                        // Handle error here
                    }
                });
            } else {
                toastr.error("OTP is required");
            }
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
                url: '{{ url('1Rto5efWp86Z/b-wallet-data') }}',
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
                    fileLink.setAttribute('download', 'B-Wallet-Report.xls');
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
            var table = $("#b-wallet-report").DataTable();
            table.ajax.reload(null, false);
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
                            fullname.addClass('d-none');
                            fullname.removeClass('d-block');
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
