@extends('layouts.user_type.admin-app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h4 class="card-title">User Accounts</h4>
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
                                                        :format="dateFormat" placeholder="To Date" id="to_date" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>User ID</label>
                                            <input class="admin-form-control" placeholder="enter User ID" type="text"
                                                id="user_id" v-model="username"
                                                onblur="checkUserExistedNew(1, this.value)" />
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <button type="button" class="
                                  btn btn-primary
                                  waves-effect waves-light
                                  ml-4
                                " id="onSearchClick">
                                                    Search
                                                </button>
                                                <button type="button" class="
                                  btn btn-info
                                  waves-effect waves-light
                                  ml-4
                                " onclick="exportToExcel()">
                                                    Export To Excel
                                                </button>
                                                <button type="button" class="
                                  btn btn-dark
                                  waves-effect waves-light
                                  ml-4
                                " id="onResetClick">
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
                                <th>Username</th>
                                <th>Available Funds</th>
                                <th>Binary Tokens</th>
                                <th>Buy Tokens</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var base_url = '{{url('/')}}'
var csrftoken = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function() {

    let i = 1;
    var csrf_token = "{{ csrf_token() }}";

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
            [10, 20, 30, 40, 50, 100,1000],
            [10, 20, 30, 40, 50, 100,1000],
        ],
        buttons: [
            // 'copyHtml5',
            /*'excelHtml5',
            'csvHtml5',
            'pdfHtml5',*/
            "pageLength",
        ],
        ajax: {
            url: "{{ url('1Rto5efWp86Z/getAllUsers') }}",
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
                    // product_id:$('#product_id').val(),
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
        columns: [{
            render: function () {
                //return meta.row + 1;
                return i++;
            },
        },
         
            {
                data: "user_id"
            },

           
            {
                data: "fund_wallet_balance"
            },

           

            {
                data: "binary_income_tokens_balance"
            },


            {
                data: "working_wallet_balance"
            },

           
            {

        render: function (data, type, row, meta) {
        return '<button style="margin-left: 10px; padding: 5px 10px;" class="btn btn-primary" onclick="redirectToURL(\'button1_url\', ' + row.id + ')">Sell token history</button>' +
            '<button style="margin-left: 10px; padding: 5px 10px;" class="btn btn-danger" onclick="redirectToURL(\'button2_url\', ' + row.id + ')">Buy token history</button>' +
            '<button style="margin-left: 10px; padding: 5px 10px;" class="btn btn-success" onclick="redirectToURL(\'button3_url\', ' + row.id + ')">Transfer token history</button>' +
            '<button style="margin-left: 10px; padding: 5px 10px;" class="btn btn-warning" onclick="redirectToURL(\'button4_url\', ' + row.id + ')">Add fund history</button>';
       }
    },
        ],
    });
    $("#onSearchClick").click(function () {
        table.ajax.reload(null, false);;
    });
    $("#onSearchClick").click(function () {
        var startDate = $("#frm_date").val();
        var endDate = $("#to_date").val();
        if (endDate < startDate) {
            toastr.error("To date should be greater than from date");
            return false;
            // alert("To date should not less than from date ");
        }
        table.ajax.reload(null, false);;
    });

    $("#onResetClick").click(function () {
        $("#searchForm").trigger("reset");
        username = "";
        isAvialable = "";
        table.ajax.reload(null, false);;
    });

  

});
function redirectToURL(action, id) {

    var url;
    switch (action) {
        case 'button1_url':
            url = "{{url('/1Rto5efWp86Z/user/sell-token-history/')}}/" + id;
            break;
        case 'button2_url':
            url = "{{url('/1Rto5efWp86Z/user/buy-token-history/')}}/" + id;
            break;
        case 'button3_url':
            url = "{{url('/1Rto5efWp86Z/user/transfer-token-history/')}}/" + id;
            break;
        case 'button4_url':
            url = "{{url('/1Rto5efWp86Z/user/add-fund-history/')}}/" + id;
            break;
        default:
            console.error('Invalid action:', action);
            return;
    }

    // Redirect to the generated URL
    window.location.href = url;
}
function checkUserExistedNew(para, val) {


    if (val != '') {
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
                        user_id = resp.data.user_id;
                        fullname = resp.data.fullname;
                        isAvailable = "Available";
                    } else {
                        user_id2 = resp.data.user_id;
                        fullname2 = resp.data.fullname;
                        isAvailable2 = "Available";
                    }

                    toastr.success(resp.message);

                } else {
                    if (para == 1) {
                        user_id = "";
                        isAvailable = "Not Available";
                        fullname = "";
                    } else {
                        user_id2 = "";
                        isAvailable2 = "Not Available";
                        fullname2 = "";
                    }
                    toastr.error(resp.message);
                }
            },
            error: function () {
                // handle error
            }
        });
    }
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
        url: "{{ url('1Rto5efWp86Z/getAllUsers') }}",
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

</script>
@endsection
