@extends('layouts.user_type.auth-app')
@section('content')
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Withdrawal Report</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">
                        <svg class="stroke-icon">
                            <use href="{{ asset('svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Withdrawal</li>
                    <li class="breadcrumb-item active"> Withdrawal Report</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
      <div class="row">
         <div class="col-xl-12">
            <div class="card custom-card">
               <div class="card-body">
                  <form id="searchForm">
                     <div class="row align-items-center">
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>From Date</label>
                              <input type="date" class="form-control" name="frm_date" :format="dateFormat" placeholder="From Date" id="frm_date" />
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>To Date</label>
                              <input type="date" class="form-control" name="to_date" :format="dateFormat" placeholder="To Date" id="to_date" />
                           </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Wallet Type</label>
                                <select class="form-control" name="wallet_type" id="wallet_type">
                                    <option value="">-- Select Wallet --</option>
                                    <option value="2">Working Wallet</option>
                                    <option value="3">ROI Wallet</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 ">
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
            <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                     <table id="withdrawals-income-report" class="table table-bordered text-nowrap w-100" style="width: 100%;">
                        <thead>
                           <tr>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span>No.</div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span>Request Amount</div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span>Deduction Fee</div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span>Net Amount</div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span>Address</div>
                              </th>
                               <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span>Wallet Type</div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span>Status</div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span>Currency Type</div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span>Requested Date</div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span>Approved Date</div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span>Remark</div>
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr class="odd">
                              <td valign="top" colspan="10" class="dataTables_empty">Data not available currently, click on the below button to Activate your account and start earning.</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript"> 
var csrf_token = '{{ csrf_token() }}';
        $(document).ready(function(){
         
            let i = 0;
            var reportsTable = $("#withdrawals-income-report").DataTable({
                responsive: true,
                scrollX: true,
                lengthMenu: [
                    [10, 50, 100],
                    [10, 50, 100],
                ],
                retrieve: true,
                destroy: true,
                processing: false,
                serverSide: true,
                stateSave: false,
                ordering: false,
                {{-- dom: "lrtip", --}}
                "language": {
                    "emptyTable": "Nothing here yet. Stay tuned!"
                },
                ajax: {
                    url: '{{ url('withdrwal-income') }}',
                    type: "POST",
                    
                    data: function (d) {
                        console.log(d);
                        i = 0;
                        i = d.start + 1;

                        let params = {
                            frm_date: $("#from-date").val(),
                            to_date: $("#to-date").val(),
                            type: $('#wallet_type').val(),
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
                       render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        render: function (data, type, row) {
                            return `<span>${(row.amount+row.deduction).toFixed(2)}</span>`;
                        },
                    },
                    {
                        render: function (data, type, row) {
                            return `<span>${(row.deduction).toFixed(2)}</span>`;
                        },
                    },
                    {
                        render: function (data, type, row) {
                            return `<span>${(row.amount).toFixed(2)}</span>`;
                        },
                    },
                    
                    {data:'to_address'},
                    {
                         render: function (data, type, row) {
                             if (row.withdraw_type == 2) {
                                 return `<span>Working Wallet</span>`;
                             } else {
                                 return `<span>ROI Wallet</span>`;
                             }
                         },
                    },
                    {
                        render: function (data, type, row) {
                            if (row.status == 0) {
                                return `<span class="label label-warning"><b>REQUESTED</b></span>`;
                            }else if (row.status === 1) {
                                return `<span class="label label-success"><b>APPROVED</b></span>`;
                            } else {
                                return `<span class="label label-danger">REJECTED</span>`;
                            }
                            /*if (row.status === "Paid") {
                              return `<span class="label label-success"><b>PAID</b></span>`;
                            } else {
                              return `<span class="label label-danger">UNPAID</span>`;
                            }*/
                        }
                    },
                    {data:"network_type"},                   
                    {
                        render: function (data, type, row) {
                            if (row.entry_time === null || row.entry_time === undefined || row.entry_time === '') {
                              return `-`;
                            } else {
                                return moment(String(row.entry_time)).format('YYYY/MM/DD');
                            }
                        }
                    },
                    {
                        data: "withdraw_approved"
                    },
                    {
                        render: function (data, type, row) {
                            if (
                                row.remark === null ||
                                row.remark === undefined ||
                                row.remark === ""
                            ) {
                                return `-`;
                            } else {
                                return `<span>${row.remark}</span>`;
                            }
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
                reportsTable.ajax.reload(null, false);;
            });
        });
    </script>
@endsection
