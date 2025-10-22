@extends('layouts.user_type.auth-app')
@section('content')
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Team Report</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">
                        <svg class="stroke-icon">
                            <use href="{{ asset('svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Station Network</li>
                    <li class="breadcrumb-item active"> Team Report</li>
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
                            {{-- <div class="col-md-2">
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
                           </div> --}}
                           <div class="col-md-3">
                                <div class="form-group">
                                    <label>Station ID</label>
                                    <input type="text" maxlength="12" class="form-control" name="user_id" id="user-id" placeholder="Station ID" />
                                </div>
                            </div>
                            {{-- <div class="col-md-3">
                                <div class="form-group">
                                    <label>Select Team</label>
                                    <select id="active_status" class="form-control">
                                        <option value="">All Team</option>
                                        <option value="1" @if($data['type'] =='active') selected @endif>Paid Team</option>
                                        <option value="0" @if($data['type'] =='inactive') selected @endif>Unpaid Team</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Select Team</label>
                                    <select id="position" class="form-control">
                                        <option value="">All Team</option>
                                        <option value="1">Left Team</option>
                                        <option value="2">Right Team</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mt-lg-2">
                                <div class="mt-1 searchFormButwrap">
                                     <button type="button" name="signup1" value="Sign up" id="onSearchClick" class="btn btn-success">
                                     Find </button>
                                     <button type="button" name="signup1" value="Sign up" id="onResetClick" class="btn btn-danger">
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
                                <table id="structure-balance-receive" class="table nowrap align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Registration Date</th>
                                            <th>Station ID</th>
                                            <th>Name</th>
                                            <th>Sponsor ID</th>
                                            <th>Placement Id</th>
                                            <th>Position</th>
                                            <th>Left BV</th>
                                            <th>Right BV</th>
                                            <th>Total Investment</th>
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
</div>
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
            //dom: "lrtip",
            "language": {
                "emptyTable": "Nothing here yet. Stay tuned!"
            },
            ajax: {
                url: "{{ url('/teamview-data')}}",
                type: "POST",
                data: function (d) {
                    i = 0;
                    i = d.start + 1;

                    let params = {
                        user_id: $("#user-id").val(),
                        frm_date: $("#from-date").val(),
                        to_date: $("#to-date").val(),
                        status: $("#active_status").val(),
                        position: $("#position").val(),
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
                            row.joining_date === null ||
                            row.joining_date === undefined ||
                            row.joining_date === ""
                        ) {
                            return `-`;
                        } else {
                            return moment(String(row.joining_date)).format("YYYY-MM-DD");
                        }
                    },
                },

                {
                    render: function (data, type, row) {
                        return `<span>${row.user_id}</span>`;
                    },
                },

                {
                    render: function (data, type, row) {
                        return `<span>${row.fullname}</span>`;
                    },
                },

                {
                    render: function (data, type, row) {
                        return `<span>${row.sponser_id}</span>`;
                    },
                },

                { data: "upline_id" },
                { data: "position" },
                { data: "left_bv" },
                { data: "right_bv" },
                { data: "amount" },
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
        $('#user-id').keypress(function (e) {
            var key = e.which;
            if(key == 13)  // the enter key code
            {
                e.preventDefault();
                $('#onSearchClick').click();
                reportsTable.ajax.reload(null, false);;
            }
        });
        $("#onResetClick").click(function () {
            $("#searchForm").trigger("reset");
            reportsTable.ajax.reload(null, false);;
        });
    });

</script>
@endsection
