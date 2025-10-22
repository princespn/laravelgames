@extends('layouts.user_type.admin-app')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h4 class="card-title">User Per Day Wise Buisness</h4>
                <a href="{{ url('1Rto5efWp86Z/user/manage-user-account') }}" class="btn btn-primary float-right">Back</a>

            </div>

             <form id="searchForm">
            <input type="hidden" name="user_id" id="user_id" value="{{$id}}">

            <!--    <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <div class="row">
                                   
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>From Date</label>
                                            <div>
                                                <div class="input-group">
                                                    <input type="date" class="admin-form-control" name="frm_date"
                                                        :format="dateFormat" placeholder="From Date" id="frm_date" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>To Date</label>
                                            <div>
                                                <div class="input-group">
                                                    <input type="date" class="admin-form-control" name="to_date"
                                                        :format="dateFormat" placeholder="To Date" id="to_date" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <button type="button" class="
                                  btn btn-primary
                                  waves-effect waves-light
                                  ml-4
                                " id="onSearchClick">
                                                    Search
                                                </button>
                                                <button type="button" class="
                                  btn btn-info
                                  waves-effect waves-light
                                  ml-4
                                " onclick="exportToExcel()">
                                                    Export To Excel
                                                </button>
                                                <button type="button" class="
                                  btn btn-dark
                                  waves-effect waves-light
                                  ml-4
                                " id="onResetClick">
                                                    Reset
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </form>
            <div class="admin-card-body">
                <div class="table-responsive admin-table">
                    <table v-once id="user-logs-report" class="display nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Entry Date</th>
                                <th>Station ID</th>
                                <th>Left BV</th>
                                <th>Right BV</th>
                                <th>Total BV</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
<script>
var base_url = '{{url('/')}}'
var csrftoken = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function() {

    let i = 1;
    var csrf_token = "{{ csrf_token() }}";

     var table = $("#user-logs-report").DataTable({
        responsive: true,
        retrieve: true,
            destroy: true,
            processing: false,
            serverSide: true,
            stateSave: true,
            ordering: false,
            dom: "Brtip",
        lengthMenu: [
            [10, 20, 30, 40, 50, 100,1000,-1],
            [10, 20, 30, 40, 50, 100,1000,"All"],
        ],
        buttons: [
            "pageLength",
        ],
        ajax: {
            url: "{{ url('1Rto5efWp86Z/user-per-day-total-buisness-report-data') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            data: function (d) {
                i = 0;
                i = d.start + 1;

                let params = {
                    id: $("#user_id").val(),
                };
                Object.assign(d, params);
                return d;
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
            }
        },
        columns: [{
            render: function () {
                return i++;
            },
        },
        {
                render: function(data, type, row) {
                    if (
                        row.entry_time === null ||
                        row.entry_time === undefined ||
                        row.entry_time === ""
                    ) {
                        return "-";
                    } else {
                        return moment(row.entry_time).format("YYYY-MM-DD HH:mm:ss");
                    }
                },
            },
          
            {
                data: "user_id"
            },

            {
                data: "left_bv"
            },
            {
                data: "right_bv"
            },
            {
                render: function(data,type, row){
                    return  `${row.left_bv + row.right_bv}`
                }
            },
            
        ],
        

    });

});

</script>
