@extends('layouts.user_type.auth-app')
@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="PageTitle">
                    <h1>Level Team Report</h1>
                </div>
            </div>
        </div>
       <div class="row RepotPage">
            <div class="col-md-12">
                <div class="searchFormWrap">
                    <form id="searchForm">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <div class="form-group">
                                 <label>From Date</label>
                                 <input type="date" class="form-control" name="frm_date" format="dateFormat" placeholder="From Date" id="from-date">
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 <label>To Date</label>
                                 <input type="date" class="form-control" name="to_date" format="dateFormat" placeholder="To Date" id="to-date">
                              </div>
                           </div>                         
                           <div class="col-md-3">
                            <div class="form-group">
                                <label>Down ID</label>
                                <input type="text" maxlength="12" class="form-control" name="user_id" id="user-id"  placeholder="Down ID" maxlength="12" />
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <label>Select Team</label>
                            <select id="active_status" class="form-control">
                                <option value="">All Team</option>
                                <option value="1">Paid Team</option>
                                <option value="0">Unpaid Team</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="status">Select Level</label>
                            <select id="level" class="form-control">
                                <option value>All Level</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                        <div class="col-md-3 mt-lg-2">
                              <div class="mt-1 searchFormButwrap">
                                 <button type="button" name="signup1" value="Sign up" id="onSearchClick" class="btn btn-find">
                                 Find </button>
                                 <button type="button" name="signup1" value="Sign up" id="onResetClick" class="btn btn-reset">
                                 Reset </button>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
                 <div class="table-responsive">
                     <table id="structure-balance-receive" class="table nowrap align-middle" style="width:100%">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Date</th>
                            <th>Down Id</th>
                            <th>Full Name</th>
                            <th>Sponsor Station ID</th>
                            <th>Status</th>
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
                url: "{{ url('/team-level-data')}}",
                type: "POST",
                data: function (d) {
                    i = 0;
                    i = d.start + 1;

                    let params = {
                        user_id: $("#user-id").val(),
                        frm_date: $("#from-date").val(),
                        to_date: $("#to-date").val(),
                        level:$("#level").val(),
                        status:$("#active_status").val()
                    };
                    Object.assign(d, params);
                    return d;
                },
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                dataSrc: function (json) {
                    if (json.code === 200) {
                        let total_amount = 0;
                        for (let j = 0; j < json.data.records.length; j++) {
                            total_amount = total_amount + parseInt(json.data.records[j].price_in_usd);
                            $("#total_amount").text("$" + total_amount);
                        }
                        var arrGetHelp = json.data.records;
                        json["recordsFiltered"] = json.data.recordsFiltered;
                        json["recordsTotal"] = json.data.recordsTotal;
                        return json.data.records;
                    } else if (json.code === 401 || json.code === 403) {
                        location.href= '/login';
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
                            return row.entry_time;
                        }
                    },
                },
                {
                    data: "down_user_id"
                }, 
                {
                    data: "down_fullname"
                },                            
                {
                    data: "sponser_id"
                },
                {
                    data: "status"
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

</script>
@endsection
