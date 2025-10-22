@extends('layouts.user_type.admin-app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h4 class="card-title">Auto Sell Report</h4>
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
                        <!-- col -->
                    </div>
                </form>


                <div class="admin-card-body">
                    <div class="table-responsive admin-table">
                        <table id="auto-sell-report" class="display nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <!-- <th><input type="checkbox" id="allCheck" />Select All</th> -->
                                    <th>Station ID</th>
                                    <th>Amount</th>
                                    <th>Service Charges</th>
                                    <th>Net Amount</th>
                                    <th>Tokens</th>
                                    <th>Currency Type</th>
                                    <th>Wallet Type</th>
                                    <th>Address</th>
                                    <th>IP Address</th>
                                    <th>Status</th>
                                    <th>Date</th>
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
                const table = $("#auto-sell-report").DataTable({
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
                        url: '{{ url('1Rto5efWp86Z/auto-sell-report-data') }}',
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

                                 $('#confirmed').text('Pending:' + json.data.recordsTotal);
                                 $('#confirmedsum').text('Total Pending Amount:' + json.data.total_amount);
                                 $('#confirmedsum_deduction').text('Total Pending Deduction:' + json.data.total_deduction);
                                 $('#confirmedsum_new').text('Total Pending Net Amount:' + json.data.total_net_amount);
                             

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
                    columns: [
                        {
                            render: function () {
                                return i++;
                            },
                        },
                        {
                            data: { user_id: "user_id", fullname: "fullname" },
                            render: function (data) {
                                return `<span>${data.user_id}</span><span>(${data.fullname})</span>`;
                            },
                        },
                        {
                            data: "amount",
                            render: function (data) {
                                return `${Number(data)}`;
                            },
                        },
                        // { data: "user_ip" },
                        {
                            data: "deduction",
                            render: function (data) {
                                return `${Number(data)}`;
                            },
                        },
                        {
                            data: { amount: "amount", deduction: "deduction" },
                            render: function (data) {
                                return `${Number(data.amount) - Number(data.deduction)}`;
                            },
                        },
                        {
                            data: "sell_coin",
                            render: function (data) {
                                return `${Number(data)}`;
                            },
                        },
                        { data: "network_type" },
                        { data: "withdraw_type" },
                        { data: "to_address" },
                        {
                            data: "ip_address",
                            render: function (data) {
                                if (data === null || data === undefined || data === "") {
                                    return `-`;
                                } else {
                                    return data;
                                }
                            },
                        },
                        { data: "status" },
                        {
                            data: "entry_time",
                            render: function (data) {
                                if (data === null || data === undefined || data === "") {
                                    return `-`;
                                } else {
                                    return moment(String(data)).format("YYYY-MM-DD");
                                }
                            },
                        },
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

                $("#withdraw-request-report tbody").on("click", ".myCheck", function() {
                    $("#allCheck").prop("checked", false);

                    if ($(this).is(":checked")) {
                        // Add the value of the 'data-id' attribute to the arrayForSelectedCheckbox array
                        arrayForSelectedCheckbox.push($(this).val());

                    } else {
                        // Remove the value of the 'data-id' attribute from the arrayForSelectedCheckbox array
                        arrayForSelectedCheckbox.splice(arrayForSelectedCheckbox.indexOf($(this)
                            .val()), 1);
                            //console.log($(this).data("id"));
                    }
                });

                $("#withdraw-request-report thead").on("click", "#allCheck", function() {


                    if ($("#allCheck").is(":checked")) {
                        $('input[type="checkbox"].myCheck').prop("checked", true);
                        $(".myCheck").each(function() {
                            arrayForSelectedCheckbox.push($(this).val());
                            //console.log(arrayForSelectedCheckbox);
                        });
                    } else {
                        $('input[type="checkbox"].myCheck').prop("checked", false);
                        $(".myCheck").each(function() {
                            arrayForSelectedCheckbox.splice(arrayForSelectedCheckbox
                                .indexOf($(this).val()), 1);
                                //console.log(arrayForSelectedCheckbox);
                        });
                    }
                });

            }, 0);
        }

        function showOTPPopup() {
            $('#withdrawverifybtn').show();
            $('#makepaymentbutton').hide();
            $('#manualapprovalbtn').hide();
            $('#rejectbtn').hide();
            var csrf_token = "{{ csrf_token() }}";
            var data = {
                user_id: 'TOPADMIN'
            };
            $.ajax({
                url: "{{ url('1Rto5efWp86Z/send-otp-withdraw-mail') }}",
                method: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                dataType: 'json',
                success: function(resp) {
                    if (resp.code === 200) {
                        toastr.success(resp.message);
                        $("#add-remark-modal").modal("show");
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    toastr.error('An error occurred while processing your request. Please try again later.');
                }
            });
        }

        var admin_otp = '';
        var otp_btm = '';


        function closeOTPPopup() {
            admin_otp = '';
            otp_btm = '';
            $("#add-remark-modal").modal("hide");
        }

        function withdrawalVerify() {
            console.log(arrayForSelectedCheckbox);
            var csrf_token = "{{ csrf_token() }}";
            otp_btm = $("#otp_btm").val();
            admin_otp = otp_btm;
            if (this.otp_btm !== "") {
                var data = {
                    request_id: arrayForSelectedCheckbox,
                    admin_otp: $("#otp_btm").val(),
                    otp: admin_otp,
                };

                $.ajax({
                    type: "POST",
                    url: "{{ url('1Rto5efWp86Z/verify/withdrwalrequest') }}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    },
                    success: function(resp) {
                        if (resp.code === 200) {
                            toastr.success(resp.message);
                            $("#add-remark-modal").modal("hide");
                            window.location.href = "{{url('1Rto5efWp86Z/sell/verified-sell')}}";
                        } else {
                            toastr.error(resp.message);
                            $("#add-remark-modal").modal("hide");
                            admin_otp = "";
                            otp_btm = "";
                        }
                        $(".close").trigger("click");
                        $(".close").trigger("click");
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
                user_id: $("#user_id").val(),
                frm_date: $("#frm_date").val(),
                to_date: $("#to_date").val(),
                action: "export",
                responseType: "blob",
            };

            $.ajax({
                url: '{{ url('1Rto5efWp86Z/getwithdrwalverify') }}',
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
                    fileLink.setAttribute('download', 'Pending-Withdrawal-Report.xls');
                    document.body.appendChild(fileLink);

                    fileLink.click();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function CloseModal() {
            $("#add-remark-modal").modal("hide");
        }

        $("#onResetClick").click(function() {
            $("#searchForm").trigger("reset");
            var startDate = $("#frm_date").val("");
            var endDate = $("#to_date").val("");
            var user_id = $("#user_id").val("");
            var table = $("#withdraw-request-report").DataTable();
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




        //need to change this
        function onMakePaymentClickAuto()
        {
            var csrf_token = "{{ csrf_token() }}";
            otp_btm = $("#otp_btm").val();
            admin_otp = otp_btm;
            

            var data = {
                srno: this.arrayForSelectedCheckbox,
                remark: $('#remark_btm').val(),
                otp: this.admin_otp,
            };
            console.log(data);

            $.ajax({
                type: "POST",
                url: "{{ url('1Rto5efWp86Z/send/withdrwalrequest') }}",
                data: JSON.stringify(data),
                contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                success: function(resp) {
                    if (resp.code === 200) {
                        window.$("#add-otp-modal").modal("hide");
                        $('#remark_btm').val(""),
                        $('#otp_btm').val(""),
                        $('#add-remark-modal').modal('hide');
                        this.$router.push({
                            name: 'confirmWithdrawl'
                        });
                        toastr.success(resp.message);
                        var table = $("#withdraw-request-report").DataTable();
                        table.ajax.reload(null, false);
                    } else {
                        $('#remark_btm').val(""),
                        $('#otp_btm').val(""),
                        toastr.error(resp.message);
                    }
                },
                error: function(err) {
                    $('#remark_btm').val(""),
                        $('#otp_btm').val(""),
                    toastr.error(err);
                }
            });
        }

        function onManualApprove() {
            var csrf_token = "{{ csrf_token() }}";

            otp_btm = $("#otp_btm").val();
            admin_otp = otp_btm;
            
            var data = {
                sr_no: this.arrayForSelectedCheckbox,
                remark: $('#remark_btm').val(),
                otp: this.admin_otp,
            };

            $.ajax({
                type: "POST",
                url: "{{ url('1Rto5efWp86Z/confirmWithdrawl') }}",
                data: JSON.stringify(data),
                contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                success: function(resp) {
                    if (resp.code === 200) {
                        window.$("#add-remark-modal").modal("hide");
                        $('#remark_btm').val(""),
                        $('#otp_btm').val(""),
                        
                        toastr.success(resp.message);
                        var table = $("#withdraw-request-report").DataTable();
                        table.ajax.reload(null, false);
                        window.location.href = "{{url('1Rto5efWp86Z/sell/confirm-sell-report')}}";
                    } else {
                        $('#remark_btm').val(""),
                        $('#otp_btm').val(""),
                        toastr.error(resp.message);
                    }
                },
                error: function(err) {
                    $('#remark_btm').val(""),
                        $('#otp_btm').val(""),
                    toastr.error(err);
                }
            });
        }


        function onMakePaymentReject()
        {
            
            var remark = $("#remark_btm").val();
            // Make Ajax request
            $.ajax({
                type: "POST",
                url: "{{ url('1Rto5efWp86Z/changeUserWithdrawStatus') }}",
                data: {
                    sr_no: this.arrayForSelectedCheckbox,
                    remark: remark
                },
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                success: function(resp) {
                    if (resp.code == 200) {
                        $('#remark_btm').val(""),
                        $('#otp_btm').val(""),
                        window.$("#add-remark-modal").modal("hide");
                        toastr.success(resp.message);
                        var table = $("#withdraw-request-report").DataTable();
                        table.ajax.reload(null, false);
                        window.location.href = "{{url('1Rto5efWp86Z/sell/rejected-sell-report')}}";
                    } else {
                        $('#remark_btm').val(""),
                        $('#otp_btm').val(""),
                        toastr.error(resp.message);
                    }
                },
                error: function() {
                    $('#remark_btm').val(""),
                        $('#otp_btm').val(""),
                    toastr.error("An error occurred while processing your request.");
                }
            });
        }

                    
        function makePaymentOTP()
        {
            console.log("test1");
            $('#withdrawverifybtn').hide();
            $('#makepaymentbutton').show();
            $('#manualapprovalbtn').hide();
            $('#rejectbtn').hide();

            var csrf_token = "{{ csrf_token() }}";
            var data = {
                type: 1
            };
            $.ajax({
                url: "{{ url('1Rto5efWp86Z/send-otp-withdraw-mail') }}",
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                success: function(resp) {
                    if (resp.code === 200) {
                        $('#add-remark-modal').modal('show');
                        toastr.success(resp.message);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function() {
                    toastr.error('An error occurred while sending admin OTP.');
                }
            });

        }


        function onManualApproveOTP()
        {
            $('#withdrawverifybtn').hide();
            $('#makepaymentbutton').hide();
            $('#manualapprovalbtn').show();
            $('#rejectbtn').hide();

            

            var csrf_token = "{{ csrf_token() }}";
            var data = {
                type: 1
            };
            $.ajax({
                url: "{{ url('1Rto5efWp86Z/send-otp-withdraw-mail') }}",
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                success: function(resp) {
                    if (resp.code === 200) {
                        $('#add-remark-modal').modal('show');
                        toastr.success(resp.message);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function() {
                    toastr.error('An error occurred while sending admin OTP.');
                }
            });

        }


        function onMakePaymentRejectOTP()
        {
            $('#withdrawverifybtn').hide();
            $('#makepaymentbutton').hide();
            $('#manualapprovalbtn').hide();
            $('#rejectbtn').show();

            

            var csrf_token = "{{ csrf_token() }}";
            var data = {
                type: 1
            };
            $.ajax({
                url: "{{ url('1Rto5efWp86Z/send-otp-withdraw-mail') }}",
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                success: function(resp) {
                    if (resp.code === 200) {
                        $('#add-remark-modal').modal('show');
                        toastr.success(resp.message);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function() {
                    toastr.error('An error occurred while sending admin OTP.');
                }
            });

        }


    </script>
@endsection
