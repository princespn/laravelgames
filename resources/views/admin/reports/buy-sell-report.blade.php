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
                        <table id="binary-report" class="display nowrap" style="width: 100%">
                            <thead>
                            <tr>
                            <th>Sr. No.</th>
                            <th>Buy Amount</th>
                            <th>Buy Rate</th>
                            <th>Buy %</th>
                            <th>Token Value</th>
                            <th>Total Tokens</th>
                            <th>New Buy Rate</th>
                            <th>New Sell Rate</th>
                            <th>Sell Token</th>
                            <th>Sell Rate</th>
                            <th>Sell Token Amount</th>
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

               
<script type="text/javascript">


   $(document).ready(function () {
       var csrf_token = $('meta[name="csrf-token"]').attr('content');
       var i = 0;
       var lastRowData = null;
       var reportsTable = $("#binary-report").DataTable({
           responsive: true,
           // lengthMenu: [
           //     [10, 20, 30, 40, 50, 100],
           // ],
           retrieve: true,
           destroy: true,
           processing: false,
           serverSide: true,
           stateSave: true,
           ordering: false,
           dom: 'lrtip',
           "language": {
                    "emptyTable": "Nothing here yet. Stay tuned!"
                },
           buttons: [

               "pageLength",
           ],
           ajax: {
               url: '{{ url('1Rto5efWp86Z/reports/buy-sell-history-details')}}',
               type: "POST",
               data: function (d) {
                   i = 0;
                   i = d.start + 1;

                   let params = {
                       frm_date: $("#frm_date").val(),
                       to_date: $("#to_date").val(),
                   };
                   Object.assign(d, params);
                   return d;
               },
               headers: {
                   "X-CSRF-TOKEN": csrf_token
               },
               dataSrc: function (json) {
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
           columns: [
               {
                   render: function () {
                       return i++;
                   },
               },
               
               {
                   render: function (data, type, row) {
                        if(row.transaction_type == 1)
                        {
                            return `<span>${Number(row.actual_buy_amount).toFixed(11)}</span>`;
                        }
                        else{
                            return `<span>0</span>`;
                        }
                   },
               },

               {
                   render: function (data, type, row) {
                        if(row.transaction_type == 1)
                       {
                            var rr = `<span>${row.received_buy_sell_rate}</span>`;
                            return rr;
                       }
                       else{
                            return `<span>0</span>`;
                       }
                   },
               },

               {
                   render: function (data, type, row) {
                       if(row.transaction_type == 1)
                       {
                            return `<span>${row.received_coin_percent}</span>`;
                       }
                       else{
                            return `<span>0</span>`;
                       }
                   },
               },

               {
                   render: function (data, type, row) {
                        
                        if(row.transaction_type == 1)
                        {
                            var tt = (row.actual_buy_amount * row.received_coin_percent) / 100;
                            return `<span>${Number(tt).toFixed(11)}</span>`;
                        }
                        else{
                            return `<span>0</span>`;
                        }

                      
                   },
               },

               {
                   render: function (data, type, row) {
                        if(row.transaction_type == 1)
                        {
                            return `<span>${Number(row.received_coin).toFixed(11)}</span>`;
                        }
                        else{
                            return `<span>0</span>`;
                        }
                       
                   },
               },

               {
                   render: function (data, type, row) {
                       
                       return `<span>${Number(row.buy_rate).toFixed(11)}</span>`;
                   },
               },
               {
                   render: function (data, type, row) {
                       return `<span>${Number(row.sell_rate).toFixed(11)}</span>`;
                   },
               },

               
               {
                   render: function (data, type, row) {
                       if(row.transaction_type == 2)
                       {
                            return `<span>${Number(row.received_coin).toFixed(11)}</span>`;
                       }
                       else{
                            return `<span>0</span>`;
                       }
                   },
               },

               {
                   render: function (data, type, row) {
                       if(row.transaction_type == 2)
                       {
                            var rr = `<span>${Number(row.received_buy_sell_rate).toFixed(11)}</span>`;
                            return rr;
                       }
                       else{
                            return `<span>0</span>`;
                       }
                   },
               },


               {
                   render: function (data, type, row) {
                       if(row.transaction_type == 2)
                       {
                            return `<span>${Number(row.actual_buy_amount).toFixed(11)}</span>`;
                       }
                       else{
                            return `<span>0</span>`;
                       }
                   },
               },

               


           ],

       });

       $("#onSearchClick").click(function () {
           var startDate = $("#from-date").val();
           var endDate = $("#to-date").val();
           if (endDate < startDate) {
               toastr.error('To date should be greater than from date');
               return false;
           }
           reportsTable.ajax.reload(null, false);;
       });
       $("#onResetClick").click(function () {
           $("#searchForm").trigger("reset");
           reportsTable.ajax.reload(null, false);;
       });
       $('#deposit_id').keypress(function (e) {
           var key = e.which;
           if(key == 13)  // the enter key code
           {
               e.preventDefault();
               $('#onSearchClick').click();
               reportsTable.ajax.reload(null, false);;
           }
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
            url: '{{ url('1Rto5efWp86Z/reports/buy-sell-history-details') }}',
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
                    fileLink.setAttribute("download", "BuySellReportChart.xls");
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



</script>
@endsection
