@extends('layouts.user_type.admin-app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h4 class="card-title">Buy / Sell Rate Chart</h4>
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
                                                            <input type="date" class="admin-form-control" name="frm_date" format="dateFormat" placeholder="From Date" id="frm_date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>To Date</label>
                                                <div>
                                                    <div class="input-group">
                                                            <input type="date" class="admin-form-control" name="to_date" format="dateFormat" placeholder="To Date" id="to_date">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-center searchFormButwrap">
                                                    <button type="button" name="signup1" value="Sign up" id="onSearchClick" class="btn btn-primary
                                  waves-effect waves-light
                                  ml-4">Find</button>
                                  <button type="button" class="btn btn-info waves-effect waves-light ml-4" onclick="exportToExcel()">
                                                    Export To Excel
                                                </button>
                                                    <button type="button" name="signup1" value="Sign up" id="onResetClick" class="btn btn-dark
                                  waves-effect waves-light
                                  ml-4">Reset</button>
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
                     <table id="binary-report" class="display nowrap"  style="width:100%">
                        <thead>
                        <tr>
                             <th>Sr. No.</th>
                             <th>Date</th>
                             <th>Time</th>

                             <th>Current Buy Amount</th>
                             <!-- <th>Total Buy Amount</th> -->

                             <th>Current Received</th>
                             <!-- <th>Total Received Token</th> -->

                             <th>Buy Rate</th>
                             <th>Sell Rate</th>
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

<script type="text/javascript">


   $(document).ready(function () {

        var previousValue = 0;

       var csrf_token = $('meta[name="csrf-token"]').attr('content');
       var i = 0;
       var reportsTable = $("#binary-report").DataTable({
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
               [10, 20, 30, 40, 50, 100,1000]
           ],
           "language": {
                    "emptyTable": "Nothing here yet. Stay tuned!"
                },
           buttons: [

               "pageLength",
           ],
           ajax: {
               url: '{{ url('1Rto5efWp86Z/coin-chart-reports-data')}}',
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
                       if (
                           row.entry_time === null ||
                           row.entry_time === undefined ||
                           row.entry_time === ""
                       ) {
                           return `-`;
                       } else {
                           return moment(String(row.entry_time)).format("YYYY-MM-DD");
                       }
                   },
               },
              
               {
                    render: function (data, type, row) {
                       if (
                           row.entry_time === null ||
                           row.entry_time === undefined ||
                           row.entry_time === ""
                       ) {
                           return `-`;
                       } else {
                           return moment(String(row.entry_time)).format("hh:mm:ss a");
                       }
                   },
               },
               
               
               
               
               
               {
                   render: function (data, type, row) {
                       return `<span>${Number(row.total_coin).toFixed(11)}</span>`;
                   },
               },
            //    {
            //        render: function (data, type, row) {
            //             var currentValue = Number(row.total_coin);
            //             var difference = currentValue - previousValue;
            //             previousValue = currentValue; // Update the previousValue for the next row
            //             return `<span>${difference.toFixed(11)}</span>`;
                        
            //            //return `<span>${Number(row.total_coin).toFixed(11)}</span>`;
            //        },
            //    },


               {
                   render: function (data, type, row) {
                       return `<span>${Number(row.total_amount).toFixed(11)}</span>`;
                   },
               },
            //    {
            //        render: function (data, type, row) {
            //             var currentValue = Number(row.total_amount);
            //             var difference = currentValue - previousValue;
            //             previousValue = currentValue; // Update the previousValue for the next row
            //             return `<span>${difference.toFixed(11)}</span>`;
                        
            //            //return `<span>${Number(row.total_coin).toFixed(11)}</span>`;
            //        },
            //    },





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
        var data = {
            product_id: $("#product_id").val(),
            id: $("#user_id").val(),
            status: $("#status").val(),
            pin: $("#pin").val(),
            frm_date: $("#frm_date").val(),
            to_date: $("#to_date").val(),
            action: "export",
            responseType: "blob",
        };
        $.ajax({
            url: '{{ url('1Rto5efWp86Z/coin-chart-reports-data') }}',
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            data: data,
            dataType: "json",
            success: function(resp) {
                if (resp.code === 200) {
                    var mystring = resp.data.data;
                    var myblob = new Blob([mystring], {
                        type: "text/plain",
                    });

                    var fileURL = window.URL.createObjectURL(new Blob([myblob]));
                    var fileLink = document.createElement("a");

                    fileLink.href = fileURL;
                    fileLink.setAttribute("download", "Coinrate.xls");
                    document.body.appendChild(fileLink);

                    fileLink.click();
                } else {
                    alert(resp.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            },
        });
    }


</script>