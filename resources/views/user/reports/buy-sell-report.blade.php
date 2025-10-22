@extends('layouts.user_type.auth-app')
@section('content')
<div class="page-body">
   <!-- Container-fluid starts-->
   <div class="container-fluid">
      <div class="row">
            <div class="col-md-12">
                <div class="PageTitle">
                    <h1>Buy / Sell Rate Chart</h1>
                </div>
            </div>
        </div>
      <div class="row">
         <div class="col-xl-12">
            <div class="card custom-card">
               <div class="card-body">
                     <form id="searchForm">
                        <div class="row align-items-center">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>From Date</label>
                                 <input type="date" class="form-control" name="frm_date" format="dateFormat" placeholder="From Date" id="frm_date">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>To Date</label>
                                 <input type="date" class="form-control" name="to_date" format="dateFormat" placeholder="To Date" id="to_date">
                              </div>
                           </div>
                           
                       <div class="col-md-3 mt-lg-2">
                              <div class="mt-1 searchFormButwrap">
                                 <button type="button" name="signup1" value="Sign up" id="onSearchClick" class="btn btn-success">
                                 Search </button>
                                 <button type="button" name="signup1" value="Sign up" id="onResetClick" class="btn btn-warning">
                                 Reset </button>
                              </div>
                           </div>
                        </div>
                     </form>
                </div>
            </div>
                <div class="card custom-card">
                   <div class="card-header">
                      <div class="card-title">
                     Directs Statement Entries
                  </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="binary-report" class="table table-bordered text-nowrap w-100" style="width:100%">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Buy Amount</th>
                            <th>Buy Rate</th>
                            <th>Buy %</th>
                            <th>Token Value</th>
                            <th>Tokens Received</th>
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
</div>
</div>
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
               url: '{{ url('/buy-sell-history-details')}}',
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
                            return `<span>${row.actual_buy_amount}</span>`;
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
                            return `<span>${Number(tt).toFixed(2)}</span>`;
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
                       
                       return `<span>${row.buy_rate}</span>`;
                   },
               },
               {
                   render: function (data, type, row) {
                       return `<span>${row.sell_rate}}</span>`;
                   },
               },

               
               {
                   render: function (data, type, row) {
                       if(row.transaction_type == 2)
                       {
                            return `<span>${row.received_coin}</span>`;
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
                       if(row.transaction_type == 2)
                       {
                            return `<span>${row.actual_buy_amount}</span>`;
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


</script>
@endsection
