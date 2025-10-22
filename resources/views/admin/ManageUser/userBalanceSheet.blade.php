@extends('layouts.user_type.admin-app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h4 class="card-title">User Balance Sheet Report</h4>
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
                                                <label>Station ID</label>
                                                <input class="admin-form-control" placeholder="enter Station ID" type="text"
                                                    id="to_user_id" onkeyup="checkUserExisted(this.value)" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">country</label>
                                            <select class="admin-form-control" name="country" id="country">
                                                <option value="">Select country</option>
                                            </select>
                                        </div>
                                    </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label id="isAvialable"></label>
                                                <input id="fullname" class="admin-form-control d-none">
                                            </div>
                                        </div>
                                        <div class="row">
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
                        <table id="balance-sheet-report" class="display nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Station ID</th>
                                    <th>Total Special Buying</th>
                                    <th>Total Special Power</th>
                                    <th>Binary Deduction %</th>
                                    <th>Binary Wallet Balance</th>
                                    <th>Available Tokens of Binary Wallet</th>
                                    <th>Token Wallet Balance</th>
                                    <th>Value Of Available Token Wallet</th>
                                    <th>Remaining Balance</th>
                                    <th>Country</th>
                                    <th>Date</th>
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
        $.ajax({
            url: base_url + '/country' ,
            type: 'GET',
            success: function(data) {
                $('#country').empty();
                console.log(data.data.location_info.countryCode);
                $.each(data.data.country_list, function(key, value) {

                    if("IN" == value.iso_code)
                    {
                        console.log("Called this loop");
                        $('#country').append($('<option>', {
                            value: value.iso_code,
                            text: value.country,
                            selected: true
                        }));
                        //$('#country').append($('<option></option>').attr('value', value.iso_code).text(value.country)).prop("selected", true);
                    }
                    else{
                        console.log("Called this loop 1");
                        $('#country').append($('<option></option>').attr('value', value.iso_code).text(value.country));
                    }

                });
            }
        });


        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var i = 0;
        var reportsTable = $("#balance-sheet-report").DataTable({
            responsive: true,
            lengthMenu: [
                [10, 20, 30, 40, 50, 100,1000],
                [10, 20, 30, 40, 50, 100,1000],
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
                url: '{{ url('1Rto5efWp86Z/balance-sheet-report-data') }}',
                type: "POST",
                data: function(d) {
                    i = 0;
                    i = d.start + 1;

                    let params = {
                        id: $("#to_user_id").val(),
                        frm_date: $("#frm_date").val(),
                        to_date: $("#to_date").val(),
                        country: $("#country").val(),
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
                    data: "total_special_buying_amount"
                },
                {
                    data: "total_power_amount"
                },
                {
                    data: "binary_sell_deduction"
                },
                {
                    data: "binary_wallet_balance"
                },
                {
                    render: function(data, type, row) {
                         const tokens = parseFloat(row.sell_rate);
                         const balance = parseFloat(row.binary_wallet_balance);
                        
                         return `<span>${balance * tokens} </span>`;
                    }
                },
                {
                    data: "token_wallet_balance"
                },
                {
                    render: function(data, type, row) {
                         const avltokens = parseFloat(row.sell_rate);
                         const tokenbalance = parseFloat(row.token_wallet_balance);
                        
                         return `<span>${tokenbalance * avltokens} </span>`;
                    }
                },
                {
                    data: "available_fund"
                },
                {
                    data: "country"
                },
                {
                    data: "entry_time",
                    render: function(data) {
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
            var startDate = $("#from-date").val();
            var endDate = $("#to-date").val();
            if (endDate < startDate) {
                toastr.error('To date should be greater than from date');
                return false;
            }
            reportsTable.ajax.reload(null, false);;
        });
        $('#pin').keypress(function(e) {
            var key = e.which;
            if (key == 13) // the enter key code
            {
                e.preventDefault();
                $('#onSearchClick').click();
                reportsTable.ajax.reload(null, false);;
            }
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
            url: '{{ url('1Rto5efWp86Z/getbinaryincome') }}',
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
                    fileLink.setAttribute("download", "BinaryIncome.xls");
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
