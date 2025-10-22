@extends('layouts.user_type.auth-app')
@section('content')
<div class="page-body">
   <!-- Container-fluid starts-->
   <div class="container-fluid">
      <div class="row">
            <div class="col-md-12">
                <div class="PageTitle">
                    <!-- <h1>Direct User </h1> -->
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
                                 <input type="date" class="form-control" name="frm_date" format="dateFormat" placeholder="From Date" id="frm_date">
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label>To Date</label>
                                 <input type="date" class="form-control" name="to_date" format="dateFormat" placeholder="To Date" id="to_date">
                              </div>
                           </div>                         
                           <div class="col-md-3">
                            <div class="form-group">
                                <label>Station ID</label>
                                <input type="text" maxlength="12" class="form-control" name="user_id" id="user-id"  placeholder="Enter Station ID" />
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
               <div class="card-body">
                 <div class="mb-2 d-flex align-items-end justify-content-between">
                    <h5 class="card-title">Compile Income Report</h5>
                    <button class="float-end btn btn-primary btn-wave waves-effect waves-light" id="compile_btn" onclick="compileFun()">Compile All Now</button>
                  </div>
                 <div class="table-responsive">
                     <table id="structure-balance-receive" class="table table-bordered text-nowrap w-100" style="width:100%">
                        <thead>
                        <tr>
                            <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span>No. </div> </th>
                            <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span>Date </div> </th>
                            <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span>Station ID </div> </th>
                            <!-- <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span>Transaction Id </div> </th>                            -->
                            <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span>Withdrawable Balance</div> </th>                            
                        </tr>
                        </thead>
                     </table>
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
</div>
</div>
<!-- end main content-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>


<script type="text/javascript">
    var csrf_token = "{{ csrf_token() }}";

    $(document).ready(function(){
        var reportsTable = $("#structure-balance-receive").DataTable({
            lengthMenu: [
                [10, 50, 100],
                [10, 50, 100],
            ],
            retrieve: true,
            destroy: true,
            processing: false,
            serverSide: true,
            responsive: true,
            stateSave: false,
            ordering: false,
            dom: "lrtip",
            "language": {
                "emptyTable": "Nothing here yet. Stay tuned!"
            },
            ajax: {
                url: "{{ url('/get-compile-data')}}",
                type: "POST",
                data: function (d) {
                    i = 0;
                    i = d.start + 1;

                    let params = {
                        user_id: $("#user-id").val(),
                        frm_date: $("#from-date").val(),
                        to_date: $("#to-date").val(),
                        position:$("#position").val()
                    };
                    Object.assign(d, params);
                    return d;
                },
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                dataSrc: function (json) {
                    if (json.code === 200) {
                        var arrGetHelp = json.data.records;
                        json["recordsFiltered"] = json.data.recordsFiltered;
                        json["recordsTotal"] = json.data.recordsTotal;
                        return json.data.records;
                    } else if (json.code === 401 || json.code === 403) {
                        location.href= '/login';
                    } else {
                        $("#compile_btn").attr('disabled', true)
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
                             return moment(String(row.entry_time)).format('YYYY-MM-DD');
                        }
                    },
                },
                {
                    data: "user_id"
                },
                // {
                //     data: "pin"
                // },
                {
                    render: function (data, type, row) {
                        return `<span>${Number(row.balance).toFixed(2)}</span>`;
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

            reportsTable.ajax.reload(null, false);
        });
        $('#user-id').keypress(function (e) {
            var key = e.which;
            if(key == 13)  // the enter key code
            {
                e.preventDefault();
                $('#onSearchClick').click();
                reportsTable.ajax.reload(null, false);
            }
        });
        $("#onResetClick").click(function () {
            $("#searchForm").trigger("reset");
            reportsTable.ajax.reload(null, false);
        });       

    });

    function compileFun()
        { 
            Swal.fire({
            title: "Are you sure?",
            text: "You want to Compile All.",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes!",
            cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('transfer-compile-income-data') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf_token
                        },
                        success: function(resp) {
                            if (resp.code === 200) {
                                toastr.success(resp.message);
                                $("#structure-balance-receive").DataTable().ajax.reload(null, false);
                            } else {
                                toastr.error(resp.message);
                            }
                        },
                        error: function() {
                            toastr.error('An error occurred.');
                        }
                    });
                }
            });
        }

</script>
@endsection
