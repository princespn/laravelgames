@extends('layouts.user_type.admin-app')
@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="PageTitle">
                    <h1>Buy / Sell Rate Chart</h1>
                </div>
            </div>
        </div>
        <div class="row RepotPage">
            <div class="col-md-12">
                <div class="searchFormWrap">
                     <form id="searchForm">
                        <div class="row align-items-center">
                           <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label>From Date</label>
                                 <input type="date" class="form-control" name="frm_date" format="dateFormat" placeholder="From Date" id="frm_date">
                              </div>
                           </div> -->
                           <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label>To Date</label>
                                 <input type="date" class="form-control" name="to_date" format="dateFormat" placeholder="To Date" id="to_date">
                              </div>
                           </div> -->
                           
                       <!-- <div class="col-md-4">
                                <div class="text-center searchFormButwrap">
                                    <button type="button" name="signup1" value="Sign up" id="onSearchClick" class="btn btn-find">Find</button>
                                    <button type="button" name="signup1" value="Sign up" id="onResetClick" class="btn btn-reset">Reset</button>
                                </div>
                            </div>
                        </div> -->
                    </form>
                </div>
                <div class="table-responsive">
                     <table id="binary-report" class="table nowrap align-middle" style="width:100%">
                        <thead>
                          <tr>
                             <th>Sr. No.</th>
                             <th>TopUp Amount</th>
                             <th>Received Coins</th>
                             <th>Total Coins</th>
                             <th>Total Amount</th>
                             <th>New Buy Rate</th>
                             <th>New Sell Rate</th>
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
               url: '{{ url('1Rto5efWp86Z/coin-chart-reports-data-mt')}}',
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
                       return `<span>${Number(row.topup_id).toFixed(11)}</span>`;
                   },
               },
               {
                   render: function (data, type, row) {
                       return `<span>${Number(row.purchasedCoin).toFixed(11)}</span>`;
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