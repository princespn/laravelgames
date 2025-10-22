@extends('layouts.user_type.auth-app')

@section('content')
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0">Downline Deposit Report</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Downline Deposit Report</li>
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
                                                     
                           <div class="col-md-3">
                            <div class="form-group">
                                <label>Station ID</label>
                                <input type="text" maxlength="12" class="form-control" name="user_id" id="user-id"  placeholder="Station ID" />
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
                     <table id="downline-deposit-report" class="table nowrap align-middle" style="width:100%">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Date</th>
                            <th>username</th>
                            <th>Amount</th>
                            <th>Payment Mode</th>
                            <th>Invoice Id</th>
                            <!-- <th>ROI %</th> -->
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
<!-- end main content-->

    <!--/ Kick start -->

    <script type="text/javascript">
        $(document).ready(function(){
            let i = 0;
            var reportsTable = $("#downline-deposit-report").DataTable({
                responsive: true,
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
                dom: "lrtip",
                "language": {
                    "emptyTable": "Nothing here yet. Stay tuned!"
                },
                ajax: {
                    url: '{{url('/get-downline-deposit-report')}}',
                    type: "POST",
                    data: function (d) {
                        i = 0;
                        i = d.start + 1;

                        let params = {
                            deposit_id: $("#deposit_id").val(),
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
                    { data: "entry_time" },
                    {
                        render: function (data, type, row,) {
                            return `<span>${row.user_id}</span>`;
                            //`<span>(${row.fullname})</span>`;
                        }
                    },
                    { render: function (data, type, row,) {
                            return `<span>$${Number(row.price_in_usd).toFixed(2)}</span>  `;
                        }
                    },
                    { data: 'payment_mode' },
                    { data: 'invoice_id' },
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
            $('#user_id').keypress(function (e) {
                var key = e.which;
                if(key == 13)  // the enter key code
                {
                    e.preventDefault();
                    $('#onSearchClick').click();
                    reportsTable.ajax.reload(null, false);;
                }
            });
            // $("#topup-report tbody").on("click", "#view", function () {
            //     onViewClick(
            //         $(this).data("id"),
            //         $(this).data("amount"),
            //         $(this).data("currency"),
            //         $(this).data("date")
            //     );
            // });

            // function onViewClick(id, amount, currency, date1, franchise_id) {
            //     $.ajax({
            //         url: '/certificate',
            //         type: 'GET',
            //         data: {
            //             amount: amount,
            //             currency: currency,
            //             user_id: id,
            //             date1: date1,
            //             franchise_id: franchise_id
            //         },
            //         success: function(response) {
            //             window.location.href = '/certificate';
            //         },
            //         error: function(xhr, status, error) {
            //             console.log(error);
            //         }
            //     });
            // }

        });
    </script>

@endsection

