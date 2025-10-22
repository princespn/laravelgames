@extends('layouts.user_type.auth-app')
@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="PageTitle">
                    <h1>Differentiate Level Income Report</h1>
                </div>
            </div>
        </div>
        <div class="row RepotPage">
            <div class="col-md-12">
                <div class="searchFormWrap">
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
                           
                       <div class="col-md-3">
                                <div class="text-center searchFormButwrap">
                                    <button type="button" name="signup1" value="Sign up" id="onSearchClick" class="btn btn-find">Find</button>
                                    <button type="button" name="signup1" value="Sign up" id="onResetClick" class="btn btn-reset">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                     <table id="roi-report" class="table nowrap align-middle" style="width:100%">
                        <thead>
                        <tr>
                             <th>No.</th>
                              <th>Date</th>
                              <th>From username</th>
                              <th>Amount</th>
                              <th>Level</th>
                              <th>Percentage</th>
                        </tr>
                        </thead>
                     </table>
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
       var reportsTable = $("#roi-report").DataTable({
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
               url: '{{url('/differentiate-level-income-reports')}}',
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
                   data: 'from_user_id'
               },
               {
                   render: function (data, type, row) {
                       return `<span>${Number(row.amount).toFixed(2)}</span>`;
                   },
               },

                { 
                   data: 'level'
                },              

               {
                   render: function (data, type, row) {
                       return `<span>${Number(row.on_percentage).toFixed(2)}</span>`;
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
