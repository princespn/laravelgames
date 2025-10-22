@extends('layouts.user_type.auth-app')
@section('content')
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Installation Report</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard')}}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('svg/icon-sprite.svg#stroke-home')}}"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item">Power Station</li>
                    <li class="breadcrumb-item active"> Installation Report</li>
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
                                 <label>Invoice ID</label>
                                 <input type="text" maxlength="20" class="form-control" name="deposit_id" id="deposit_id" placeholder="Invoice ID" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57">
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
                                <table id="topup-report" class="display nowrap table table-bordered text-nowrap w-100" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Invoice ID</th>
                                            <th>Remark</th>
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
    <script type="text/javascript">
        $(document).ready(function(){
            let i = 0;
            var reportsTable = $("#topup-report").DataTable({
                scrollX: true,
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
                {{-- dom: "lrtip", --}}
                "language": {
                    "emptyTable": "Nothing here yet. Stay tuned!"
                },
                ajax: {
                    url: '{{url('/get-topup-report')}}',
                    type: "POST",
                    data: function (d) {
                        i = 0;
                        i = d.start + 0;
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
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },

                   {{--  {
                        data: "entry_time"
                    }, --}}
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
                        render: function (data, type, row) {
                            return `<span>${Number(row.amount).toFixed(2)}</span>  `;
                        },
                    },
                    {
                        data: "pin"
                    },

                    // {
                    //   data: "percentage"
                    // },
                    /*{
                                       render: function (data, type, row) {
                                           if (row.topupfrom === '') {
                                             return `Self`;
                                           } else {
                                               return row.topupfrom;
                                           }
                                       }
                                   },*/
                    {
                        data: "remark"
                    },
                    /*{
                                        render: function (data, type, row) {
                                            return `<span>${row.user_id}</span><span>(${row.fullname})</span>`;
                                        }
                                    },*/

                    /*{ data: 'amount' },*/

                    // { render: function (data, type, row,) {
                    //      return row.name/* + ' ( ' + row.package_type + ' ) ' */ ;

                    //  }
                    // },
                    // { data: 'franchise_user_id' },
                    /*{ data: 'name' },*/
                    /* { data: 'top_up_by' },
                                    { data: 'top_up_type' },
                                    { data: 'payment_type' },*/
                    /*{ data: 'withdraw' },*/

                    /* {
                                        render: function (data, type, row) {
                                            if (row.entry_time === null || row.entry_time === undefined || row.entry_time === '') {
                                              return `-`;
                                            } else {
                                                return `<label class="waves-effect" id="view" data-amount="${row.amount}" data-id="${row.franchise_user_id}" data-date="${row.entry_time}"data-currency="${row.currency_code}" style="color:#7367f0">View
                                                    </label>`;
                                            }
                                        }
                                    }*/
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

