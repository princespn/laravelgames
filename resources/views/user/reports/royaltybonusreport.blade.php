@extends('layouts.user_type.auth-app')
@section('content')
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0">Dailypayz Royalty Bonus</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Dailypayz Royalty Bonus</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-header">
                     <form id="searchForm">
                        <div class="row align-items-center">
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label>From Date</label>
                                 <input type="date" class="form-control" name="frm_date" format="dateFormat" placeholder="From Date" id="from-date">
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label>To Date</label>
                                 <input type="date" class="form-control" name="to_date" format="dateFormat" placeholder="To Date" id="to-date">
                              </div>
                           </div>
                                               
                        
                        <div class="col-md-3 mt-lg-2">
                              <div class="mt-1 searchFormButwrap">
                                 <button type="button" name="signup1" value="Sign up" id="onSearchClick" class="btn btn-success">
                                 Find </button>
                                 <button type="button" name="signup1" value="Sign up" id="onResetClick" class="btn btn-warning">
                                 Reset </button>
                              </div>
                           </div>
                        </div>
                     </form>
                     <!-- <h5 class="card-title mb-0">Scroll - Horizontal</h5> -->
                  </div>
                  <div class="card-body">
                     <table id="bonus-report" class="table nowrap align-middle" style="width:100%">
                        <thead>
                        <tr>
                         <th>No.</th>
                        <th>Date</th>
                        <th>On Downline</th>
                        <th>Transaction Id</th>
                        <th>Weekly Amount</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        </tr>
                        </thead>
                     </table>
                  </div>
               </div>
            </div>
            <!--end col-->
         </div>
         <!--end row-->
         <!-- end page title -->
      </div>
      <!-- container-fluid -->
   </div>
   <!-- End Page-content -->
</div>
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>

<script type="text/javascript">


   $(document).ready(function () {
       var csrf_token = $('meta[name="csrf-token"]').attr('content');
       var i = 0;
       var reportsTable = $("#bonus-report").DataTable({
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
               url: '{{ url('/reports/royalty-bonus-reports') }}',
               type: "POST",
               data: function (d) {
                   i = 0;
                   i = d.start + 1;

                   let params = {
                       user_id: $("#user_id").val(),
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
                        if (row.total_downId != "") {
                            return `<span class="label label-success">${(row.total_downId)} Left & ${(row.total_downId)} Right</span>`;
                        } else {
                            return `<span class="label label-danger">UNPAID</span>`;
                        }
                    }
                }, 

                {
                   data: 'pin'
                }, 

                 {
                    render: function (data, type, row) {
                       return `<span>${Number(row.weekly_amount).toFixed(2)}</span>`;
                    }
                 },

                {
                   render: function (data, type, row) {
                        return `<span>${Number(row.amount).toFixed(2)}</span>`;
                    },
                },              
             

                {
                    render: function (data, type, row) {
                        if (row.amount != "") {
                            return `<span class="label label-success"><b>PAID</b></span>`;
                        } else {
                            return `<span class="label label-danger">UNPAID</span>`;
                        }
                    }
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
