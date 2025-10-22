@extends('layouts.user_type.auth-app')
@section('content')
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Milestone Attainment Report</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                     <li class="breadcrumb-item">Station Income</li>
                    <li class="breadcrumb-item active"> Milestone Attainment Report</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        <div class="row">
         <div class="col-xl-12">
            <div class="card custom-card d-none">
               <div class="card-body">
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
                           <div class="col-md-3 mt-lg-4">
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
                <div class="card custom-card ccd">
           <!--         <div class="card-header">
                      <div class="card-title">
                     Achived Rank
                  </div>
               </div> -->
               <div class="card-body">

                <div class="table-responsive">
                    <table v-once id="topup-report" class="table table-bordered text-nowrap w-100" style="width: 100%">
                        <thead>
                        <tr>
                           <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span> No.</div> </th>
                           <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span> Date</div> </th>
                           <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span> Achived Rank</div> </th>
                           <!-- <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span> Transaction ID</div> </th> -->
                           <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span> Match Affiliate</div> </th>
                           <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span> Weekly Amount</div> </th>
                           <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span> Total Amount</div> </th>
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


    <!--/ Kick start -->

    <script type="text/javascript">
        $(document).ready(function(){

            var csrf_token = "{{ csrf_token() }}";

            let i = 0;
            var reportsTable = $("#topup-report").DataTable({
                responsive: true,
                lengthMenu: [
                    [10, 50, 100],
                    [10, 50, 100],
                ],
                retrieve: true,
                destroy: true,
                scrollX: true,
                processing: false,
                serverSide: true,
                stateSave: false,
                ordering: false,
                {{-- dom: "lrtip", --}}
                "language": {
                    "emptyTable": "Nothing here yet. Stay tuned!"
                },
                ajax: {
                    url: '{{url('/achived-rank-report')}}',
                    type: "POST",
                    data: function (d) {
                        i = 0;
                        i = d.start + 1;
                        let params = {
                            frm_date: $("#from-date").val(),
                            to_date: $("#to-date").val(),
                        };
                        Object.assign(d, params);
                        return d;
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    },
                    dataSrc: function (json) {
                        if (json.code === 200) {
                            let arrGetHelp = json.data.records;
                            json["recordsFiltered"] = json.data.recordsFiltered;
                            json["recordsTotal"] = json.data.recordsTotal;
                            return json.data.records;
                        } else if (json.code === 401 || json.code === 403) {
                            location.href='{{url('/login')}}';
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
                               return moment(String(row.entry_time)).format("YYYY/MM/DD");
                           }
                       },
                   },
                    {
                        data: "rank"
                    },
                    // {
                    //     data: "pin"
                    // },
                    {
                        render: function (data, type, row) {
                            if (row.downline_req != "") {
                                return `<span>${(row.downline_req)} Left & ${(row.downline_req)} Right</span>`;
                            } else {
                                return `<span class="label label-danger">UNPAID</span>`;
                            }
                        }
                    },
                    {
                        render: function (data, type, row) {
                            return `<span>${Number(row.weekly_amount).toFixed(2)}</span>  `;
                        },
                    },
                    {
                        render: function (data, type, row) {
                            return `<span>${Number(row.weekly_amount * 100).toFixed(2)}</span>  `;
                        },
                    },
                ],
            });

            $("#onSearchClick").click(function () {
                var startDate = $("#from-date").val();
                var endDate = $("#to-date").val();
                if (endDate < startDate) {
                    toastr.error("To date should be greater than from date");
                    return false;
                }
                reportsTable.ajax.reload(null, false);;
            });
            $("#onResetClick").click(function () {
                $("#searchForm").trigger("reset");
                $("#deposit_id").val("");
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


                        
