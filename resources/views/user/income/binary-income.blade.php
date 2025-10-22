@extends('layouts.user_type.auth-app')

@section('content')

<div class="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <nav aria-label="breadcrumb ms-3">
            <!-- <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6">
              <li class="breadcrumb-item text-sm">
                <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
              </li>
              <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                Binary Income

              </li>
            </ol> -->
            <h6 class="font-weight-bolder mb-0">Binary Income</h6>
          </nav>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-md-12">
          <div class="card RepotPage">
            <div class="card-header">
              <div class="searchFormWrap position-relative">
                <form id="searchForm">
                  <div class="row align-items-center">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>From Date</label>
                        <input type="date" class="form-control" name="frm_date" :format="dateFormat"
                          placeholder="From Date" id="from-date" />
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>To Date</label>
                        <input type="date" class="form-control" name="to_date" :format="dateFormat"
                          placeholder="To Date" id="to-date" />
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Pin</label>
                        <input type="text" class="form-control" name="user_id" id="pin" placeholder="Pin" />
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="text-center searchFormButwrap">
                        <button type="button" name="signup1" value="Sign up" id="onSearchClick" class="btn btn-find">
                          Find </button>
                        <button type="button" name="signup1" value="Sign up" id="onResetClick" class="btn btn-reset">
                          Reset </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table v-once id="structure-balance-receive" class="display nowrap table-striped" style="width: 100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Date</th>
                      <th>Designation</th>
                      <th>Pin</th>
                      <th>Amount</th>
                      <th>Token</th>
                      <th>Lapse Amount</th>
                      <th>Left Business</th>
                      <th>Right Business</th>
                      <th>Percentage</th>
                      <th>Remark</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($datas as $data)
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $data->entry_time }}</td>
                            <td>{{ $data->designation }}</td>
                            <td>{{ $data->pin }}</td>
                            <td>{{ $data->amount }}</td>
                            <td>{{ $data->token }}</td>
                            <td>{{ $data->laps_amount }}</td>
                            <td>{{ $data->left_bv }}</td>
                            <td>{{ $data->right_bv }}</td>
                            <td>{{ $data->percentage }}%</td>
                            <td>{{ $data->remark }}</td>
                        @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection
