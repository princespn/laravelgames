@extends('layouts.user_type.auth-app')
@section('content')
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Transaction Log</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">
                        <svg class="stroke-icon">
                          <use href="{{ asset('svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Wallet Transfers </li>
                    <li class="breadcrumb-item active"> Transaction Log</li>
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
                              <label>To Station ID</label>
                              <input
                                 type="text"
                                 maxlength="12"
                                 class="form-control"
                                 name="user_id"
                                 id="user-id"
                                 placeholder="Enter Station ID"
                                 />
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
            <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                     <table id="transfer-report" class="table table-bordered text-nowrap w-100" style="width:100%">
                        <thead>
                           <tr>
                              <th>
                                 <div class="d-flex align-items-center"> 
                                    <span class="icon-format_list_numbered me-1 fs-5s"></span> No.
                                 </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-calendar me-1 fs-5s"></span> Date </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-user me-1 fs-5s"></span> To User </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-user-check me-1 fs-5s"></span>From User </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-local_atm me-1 fs-5s"></span>Value </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-local_atm me-1 fs-5s"></span>Deduction Fee </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-add_task me-1 fs-5s"></span>Net Value </div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-add_task me-1 fs-5s"></span>Transfer Type</div>
                              </th>
                              <th>
                                 <div class="d-flex align-items-center">  <span class="icon-auto_stories me-1 fs-5s"></span>Remark </div>
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
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var fundReportsTable = $("#transfer-report").DataTable({
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
            {{-- dom: "lrtip", --}}
            "language": {
                "emptyTable": "Nothing here yet. Stay tuned!"
            },
            ajax: {
                url: "{{ url('/reports/transfer-reports-data')}}",
                type: "POST",
                data: function (d) {
                    i = 0;
                    i = d.start + 1;

                    let params = {
                        user_id: $("#user-id").val(),
                        frm_date: $("#from-date").val(),
                        to_date: $("#to-date").val(),
                        wallet_type: $("#wallet-type").val()
                    };
                    Object.assign(d, params);
                    return d;
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dataSrc: function (json) {
                    if (json.code === 200) {
                        let total_amount = 0;
                        for (let j = 0; j < json.data.records.length; j++) {
                            total_amount =
                                total_amount + parseInt(json.data.records[j].price_in_usd);
                            $("#total_amount").text("$" + total_amount);
                        }
                        var arrGetHelp = json.data.records;
                        json["recordsFiltered"] = json.data.recordsFiltered;
                        json["recordsTotal"] = json.data.recordsTotal;
                        return json.data.records;
                    } else if (json.code === 401 || json.code === 403) {
                        location.href= '/login';
                    }  else {
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
                            return moment(String(row.entry_time)).format("YYYY-MM-DD");
                        }
                    },
                },
                {
                    render: function (data, type, row) {

                        return `<span>${row.to_user_id}</span>`;
                    }
                },
                {
                    render: function (data, type, row) {
                        return `<span>${row.from_user_id}</span>`;
                    }
                },
                { render: function (data, type, row) {
                    
                    if(row.wallet_type == 7)
                    {
                        var tk = row.amount;
                    }
                    else{
                        var tk = "$"+row.amount
                    }
                        return `<span>${tk}</span>`;
                    }
                },
                {
                    render: function (data, type, row) {
                        return `<span>${row.transfer_charge}</span>`;
                    }
                },
                {
                    render: function (data, type, row) {
                        return `<span>${row.net_amount}</span>`;
                    }
                },
                

                {
                    render: function (data, type, row) {
                        if(row.wallet_type == 7)
                        {
                            var typetransfer = "Income Transferred";
                        }
                        else{
                            var typetransfer = "Fund Transferred";
                        }
                        return `<span class="badge bg-primary">${typetransfer}</span>`;

                    }
                },


                {
                    render: function (data, type, row) {
                        return `<span class="badge bg-success">${row.remark}</span>`;

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
            fundReportsTable.ajax.reload(null, false);;
        });
        $('#user-id').keypress(function (e) {
            var key = e.which;
            if(key == 13)  // the enter key code
            {
                e.preventDefault();
                $('#onSearchClick').click();
                fundReportsTable.ajax.reload(null, false);;
            }
        });
        $("#onResetClick").click(function () {
            $("#searchForm").trigger("reset");
            fundReportsTable.ajax.reload(null, false);;
        });
    });

</script>
@endsection
