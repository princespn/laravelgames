@extends('layouts.user_type.auth-app')
@section('content')
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Matching Income Report</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Station Income</li>
                    <li class="breadcrumb-item active"> Matching Income Report</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>

         <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                     <table id="binary-report" class="display nowrap table table-bordered text-nowrap w-100" style="width:100%">
                        <thead>
                           <tr>
                              <th>
                                 <div class="d-flex align-items-center"> 
                                    <span class="icon-format_list_numbered me-1 fs-5s"></span> No.
                                 </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center"> 
                                    <span class="icon-format_list_numbered me-1 fs-5s"></span> Date
                                 </div>
                              </th>
                              <!-- <th>
                                 <div class="d-flex align-items-center"> 
                                    <span class="icon-format_list_numbered me-1 fs-5s"></span> Transaction ID
                                 </div>
                              </th> -->
                              <th>
                                 <div class="d-flex align-items-center"> 
                                    <span class="icon-format_list_numbered me-1 fs-5s"></span> Amount
                                 </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center"> 
                                    <span class="icon-format_list_numbered me-1 fs-5s"></span> Rank
                                 </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center"> 
                                    <span class="icon-format_list_numbered me-1 fs-5s"></span> Percentage
                                 </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center"> 
                                    <span class="icon-format_list_numbered me-1 fs-5s"></span> Lapse Amount
                                 </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center"> 
                                    <span class="icon-format_list_numbered me-1 fs-5s"></span> Matching Business
                                 </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center"> 
                                    <span class="icon-format_list_numbered me-1 fs-5s"></span> Left Business
                                 </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center"> 
                                    <span class="icon-format_list_numbered me-1 fs-5s"></span> Right Business
                                 </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center"> 
                                    <span class="icon-format_list_numbered me-1 fs-5s"></span> Remark
                                 </div>
                              </th>
                           </tr>
                        </thead>
                     </table>
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
       var reportsTable = $("#binary-report").DataTable({
           responsive: true,
           // lengthMenu: [
           //     [10, 20, 30, 40, 50, 100],
           // ],
           retrieve: true,
           scrollX: true,
           destroy: true,
           processing: false,
           serverSide: true,
           stateSave: true,
           ordering: false,
           {{-- dom: 'lrtip', --}}
           "language": {
                    "emptyTable": "Nothing here yet. Stay tuned!"
                },
           buttons: [

               "pageLength",
           ],
           ajax: {
               url: '{{ url('/reports/binary-reports-data')}}',
               type: "POST",
               data: function (d) {
                   i = 0;
                   i = d.start + 1;

                   let params = {
                       deposit_id: $("#deposit_id").val(),
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
                   render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
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
                           return moment(String(row.entry_time)).format("YYYY/MM/DD");
                       }
                   },
               },
              
               // {
               //     data: 'pin'
               // },
               {
                   render: function (data, type, row) {
                       return `<span>${Number(row.amount).toFixed(2)}</span>`;
                   },
               },
               {
                   render: function (data, type, row) {
                       return `<span>${(row.rank)}</span>`;
                   },
               },
               {
                   render: function (data, type, row) {
                       return `<span>${(row.percentage)}</span>`;
                   },
               },

               {
                   render: function (data, type, row) {
                       return `<span>${(((Number(row.match_bv).toFixed(2) * row.percentage) / 100) - Number(row.amount).toFixed(2))}</span>`;
                   }
               },

               {
                   render: function (data, type, row) {
                       return `<span>${Number(row.match_bv).toFixed(2)}</span>`;
                   }
               },

               {
                   render: function (data, type, row) {
                       return `<span>${Number(row.left_bv).toFixed(2)}</span>`;
                   }
               },
               {
                   render: function (data, type, row) {
                       return `<span>${Number(row.right_bv).toFixed(2)}</span>`;
                   }
               },               
               {
                   data: 'remark'
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
