@extends('layouts.user_type.auth-app')
@section('content')
@php
$userdata =$arrData['user'];
$tree_data =$arrData['tree_data'];
$referrallink = url('/sign-up');
$user_rankdata = $arrData['user_rankdata'];
@endphp

<div class="page-body overflow-x-auto">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Network Overview</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">
              <svg class="stroke-icon">
                <use href="{{ asset('svg/icon-sprite.svg#stroke-home')}}"></use>
              </svg></a>
            </li>
              <li class="breadcrumb-item">Genealogy View</li>
              <li class="breadcrumb-item active">Network Overview</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row introscreen align-items-center">
        <div class="col-md-6">
          <div class="introlist">
            <ul>
              <li>
                <img src="{{ asset('/images/tree-view/present.png')}}">
                <span>Active</span>
              </li>
              <li>
                <img src="{{ asset('/images/tree-view/no_topup.png')}}">
                <span>Inactive</span>
              </li>
              <li>
                <img src="{{ asset('/images/tree-view/absent.png')}}">
                <span>Absent</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <div class="backforword">
            <div>
              <form class="input-group flex-nowrap">
                <input type="search" class="form-control" placeholder="Search..." id="searchuserid" maxlength="15" onkeyup="checkUserExisted()">
                <span class="input-group-text bg-primary" id="btnsearch" style="cursor: pointer;" onclick="onSearchClick()">
                  <i class="fa fa-search"></i>
                </span>
              </form>
            </div>
            <div class="bf-btn">
              <button class="btn list-light-primary" onclick="onBackClick('{{$userdata->user_id}}')">
              <i class="fa fa-arrow-left txt-primary"></i>
              </button>
              <button class="btn list-light-primary" onclick="onForwardClick()">
              <i class="fa fa-arrow-right txt-primary"></i>
              </button>
            </div>
          </div>
        </div>
        <hr>
      </div>
      <div class="row">
        <div class="col-md-12 mx-auto">
          <div class="profitTree">
            <div class="row midline">
              <div class="col-12">
                <div class="tree-level1">
                  <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip activetree">
                    <img src="{{asset('images/tree-view/'.$userdata->image)}}" onclick="getMatrixTreeData('{{$userdata->user_id}}')">
                    <div class="profitTree-info">
                      <div class="row">
                        <div class="col-4">
                          <div class="leftbarwrap">
                            <ul>
                              <li>Placement Id
                              <br>{{$userdata->virtual_id}}</li>
                              <li>Total Investment
                              <br>{{$userdata->selftopup}}</li>
                              <li>Toppop date
                              <br>{{$userdata->entry_time}}</li>
                            </ul>
                          </div>
                        </div>
                        <div class="col-8">
                          <div class="rightbarwrap">
                            <div class="pi-info">
                              <h4>{{$userdata->fullname}} / {{$userdata->user_id}}</h4>
                            </div>
                            <div class="treetable">
                              <table class="table">
                                <tbody>
                                  <tr>
                                    <td>Factors</td>
                                    <td>Left side</td>
                                    <td>Right side</td>
                                  </tr>
                                  <tr>
                                    <td>Total Balance</td>
                                    <td>{{ $userdata->l_bv }}</td>
                                    <td>{{ $userdata->r_bv }}</td>
                                  </tr>
                                  <tr>
                                    <td>Current Balance</td>
                                    <td>{{ $userdata->left_bv }}</td>
                                    <td>{{ $userdata->right_bv }}</td>
                                  </tr>
                                  <tr>
                                    <td>Team</td>
                                    <td>{{ $userdata->l_c_count }}</td>
                                    <td>{{ $userdata->r_c_count }}</td>
                                  </tr>
                                  <tr>
                                    <td>Direct Users</td>
                                    @if($userdata->l_d_count == "Absent")
                                    <td>Absent</td>
                                    <td>Absent</td>
                                    @else
                                    <td>{{$userdata->l_d_count}}</td>
                                    <td>{{$userdata->r_d_count}}</td>
                                    @endif
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                  <h6>{{$userdata->user_id}}</h6>
                </div>
              </div>
            </div>
            <div class="row midline VHline">
              <div class="col-6 tree-2-1">
                <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                  <img src="{{asset('images/tree-view/'.$tree_data[0]['level'][0]->image)}}" onclick="getMatrixTreeData('{{$tree_data[0]['level'][0]->user_id}}')">
                  <div class="dprofitTree-info">
                    <div class="row">
                      <div class="col-4">
                        <div class="leftbarwrap">
                          <ul>
                            <li>Placement Id
                            <br>{{$tree_data[0]['level'][0]->virtual_id}}</li>
                            <li>Total Investment
                            <br>{{$tree_data[0]['level'][0]->selftopup}}</li>
                            <li>Toppop date
                            <br>{{$tree_data[0]['level'][0]->entry_time}}</li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-8">
                        <div class="rightbarwrap">
                          <div class="pi-info">
                            <h4>{{$tree_data[0]['level'][0]->fullname}} / {{$tree_data[0]['level'][0]->user_id}}</h4>
                          </div>
                          <div class="treetable">
                            <table class="table">
                              <tbody>
                                <tr>
                                                                  <td>Factors</td>
                                                                  <td>Left side</td>
                                                                  <td>Right side</td>
                                                              </tr>
                                <tr>
                        <th>Total Balance</th>
                        <td>{{ $tree_data[0]['level'][0]->l_bv }}</td>
                        <td>{{ $tree_data[0]['level'][0]->r_bv }}</td>
                      </tr>
                      <tr>
                        <th>Current Balance</th>
                        <td>{{ $tree_data[0]['level'][0]->left_bv }}</td>
                        <td>{{ $tree_data[0]['level'][0]->right_bv }}</td>
                      </tr>
                      <tr>
                        <th>Team</th>
                        <td>{{ $tree_data[0]['level'][0]->l_c_count }}</td>
                        <td>{{ $tree_data[0]['level'][0]->r_c_count }}</td>
                      </tr>
                      <tr>
                        <th>Direct Users</th>
                        @if($tree_data[0]['level'][0]->l_d_count == "Absent")
                        <td>Absent</td>
                        <td>Absent</td>
                        @else
                        <td>{{$tree_data[0]['level'][0]->l_d_count}}</td>
                        <td>{{$tree_data[0]['level'][0]->r_d_count}}</td>
                        @endif
                      </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
                <h6>{{$tree_data[0]['level'][0]->user_id}}</h6>
              </div>
              <div class="col-6 tree-2-2">
                <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                  <img src="{{asset('images/tree-view/'.$tree_data[0]['level'][1]->image)}}" onclick="getMatrixTreeData('{{$tree_data[0]['level'][1]->user_id}}')">
                  <div class="dprofitTree-info">
                    <div class="row">
                      <div class="col-4">
                        <div class="leftbarwrap">
                          <ul>
                            <li>Placement Id
                            <br>{{$tree_data[0]['level'][1]->virtual_id}}</li>
                            <li>Total Investment
                            <br>{{$tree_data[0]['level'][1]->selftopup}}</li>
                            <li>Toppop date
                            <br>{{$tree_data[0]['level'][1]->entry_time}}</li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-8">
                        <div class="rightbarwrap">
                          <div class="pi-info">
                            <h4>{{$tree_data[0]['level'][1]->fullname}} / {{$tree_data[0]['level'][1]->user_id}}</h4>
                          </div>
                          <div class="treetable">
                            <table class="table">
                              <tbody>
                                <tr>
                                                                  <td>Factors</td>
                                                                  <td>Left side</td>
                                                                  <td>Right side</td>
                                                              </tr>
                                <tr>
                        <th>Total Balance</th>
                        <td>{{ $tree_data[0]['level'][1]->l_bv }}</td>
                        <td>{{ $tree_data[0]['level'][1]->r_bv }}</td>
                      </tr>
                      <tr>
                        <th>Current Balance</th>
                        <td>{{ $tree_data[0]['level'][1]->left_bv }}</td>
                        <td>{{ $tree_data[0]['level'][1]->right_bv }}</td>
                      </tr>
                      <tr>
                        <th>Team</th>
                        <td>{{ $tree_data[0]['level'][1]->l_c_count }}</td>
                        <td>{{ $tree_data[0]['level'][1]->r_c_count }}</td>
                      </tr>
                      <tr>
                        <th>Direct Users</th>
                        @if($tree_data[0]['level'][1]->l_d_count == "Absent")
                        <td>Absent</td>
                        <td>Absent</td>
                        @else
                        <td>{{$tree_data[0]['level'][1]->l_d_count}}</td>
                        <td>{{$tree_data[0]['level'][1]->r_d_count}}</td>
                        @endif
                      </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
                <h6>{{$tree_data[0]['level'][1]->user_id}}</h6>
              </div>
            </div>
            <div class="row rowline-3">
              <div class="col-6">
                <div class="row midline VHline-3">
                  <div class="col-6 tree-3-1">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                      <img src="{{asset('images/tree-view/'.$tree_data[1]['level'][0]->image)}}" onclick="getMatrixTreeData('{{$tree_data[1]['level'][0]->user_id}}')">
                      <div class="dprofitTree-info">
                        <div class="row">
                          <div class="col-4">
                            <div class="leftbarwrap">
                              <ul>
                                <li>Placement Id
                                <br>{{$tree_data[1]['level'][0]->virtual_id}}</li>
                                <li>Total Investment
                                <br>{{$tree_data[1]['level'][0]->selftopup}}</li>
                                <li>Toppop date
                                <br>{{$tree_data[1]['level'][0]->selftopup}}</li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-8">
                            <div class="rightbarwrap">
                              <div class="pi-info">
                                <h4>{{$tree_data[1]['level'][0]->fullname}} / {{$tree_data[1]['level'][0]->user_id}}</h4>
                              </div>
                              <div class="treetable">
                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <td>Factors</td>
                                      <td>Left side</td>
                                      <td>Right side</td>
                                    </tr>
                                    <tr>
                            <th>Total Balance</th>
                            <td>{{ $tree_data[1]['level'][0]->l_bv }}</td>
                            <td>{{ $tree_data[1]['level'][0]->r_bv }}</td>
                          </tr>
                          <tr>
                            <th>Current Balance</th>
                            <td>{{ $tree_data[1]['level'][0]->left_bv }}</td>
                            <td>{{ $tree_data[1]['level'][0]->right_bv }}</td>
                          </tr>
                          <tr>
                            <th>Team</th>
                            <td>{{ $tree_data[1]['level'][0]->l_c_count }}</td>
                            <td>{{ $tree_data[1]['level'][0]->r_c_count }}</td>
                          </tr>
                          <tr>
                            <th>Direct Users</th>
                            @if($tree_data[1]['level'][0]->l_d_count == "Absent")
                            <td>Absent</td>
                            <td>Absent</td>
                            @else
                            <td>{{$tree_data[1]['level'][0]->l_d_count}}</td>
                            <td>{{$tree_data[1]['level'][0]->r_d_count}}</td>
                            @endif
                          </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    <h6>{{$tree_data[1]['level'][0]->user_id}}</h6>
                  </div>
                  <div class="col-6 tree-3-2">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                      <img src="{{asset('images/tree-view/'.$tree_data[1]['level'][1]->image)}}" onclick="getMatrixTreeData('{{$tree_data[1]['level'][1]->user_id}}')">
                      <div class="dprofitTree-info">
                        <div class="row">
                          <div class="col-4">
                            <div class="leftbarwrap">
                              <ul>
                                <li>Placement Id
                                <br>{{$tree_data[1]['level'][1]->virtual_id}}</li>
                                <li>Total Investment
                                <br>{{$tree_data[1]['level'][1]->selftopup}}</li>
                                <li>Toppop date
                                <br>{{$tree_data[1]['level'][1]->selftopup}}</li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-8">
                            <div class="rightbarwrap">
                              <div class="pi-info">
                                <h4>{{$tree_data[1]['level'][1]->fullname}} / {{$tree_data[1]['level'][1]->user_id}}</h4>
                              </div>
                              <div class="treetable">
                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <td>Factors</td>
                                      <td>Left side</td>
                                      <td>Right side</td>
                                    </tr>
                                    <tr>
                            <th>Total Balance</th>
                            <td>{{ $tree_data[1]['level'][1]->l_bv }}</td>
                            <td>{{ $tree_data[1]['level'][1]->r_bv }}</td>
                          </tr>
                          <tr>
                            <th>Current Balance</th>
                            <td>{{ $tree_data[1]['level'][1]->left_bv }}</td>
                            <td>{{ $tree_data[1]['level'][1]->right_bv }}</td>
                          </tr>
                          <tr>
                            <th>Team</th>
                            <td>{{ $tree_data[1]['level'][1]->l_c_count }}</td>
                            <td>{{ $tree_data[1]['level'][1]->r_c_count }}</td>
                          </tr>
                          <tr>
                            <th>Direct Users</th>
                            @if($tree_data[1]['level'][1]->l_d_count == "Absent")
                            <td>Absent</td>
                            <td>Absent</td>
                            @else
                            <td>{{$tree_data[1]['level'][1]->l_d_count}}</td>
                            <td>{{$tree_data[1]['level'][1]->r_d_count}}</td>
                            @endif
                          </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    <h6>{{$tree_data[1]['level'][1]->user_id}}</h6>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="row midline VHline-3">
                  <div class="col-6 tree-3-3">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip activetree">
                      <img src="{{asset('images/tree-view/'.$tree_data[1]['level'][2]->image)}}" onclick="getMatrixTreeData('{{$tree_data[1]['level'][2]->user_id}}')">
                      <div class="dprofitTree-info">
                        <div class="row">
                          <div class="col-4">
                            <div class="leftbarwrap">
                              <ul>
                                <li>Placement Id
                                <br>{{$tree_data[1]['level'][2]->virtual_id}}</li>
                                <li>Total Investment
                                <br>{{$tree_data[1]['level'][2]->selftopup}}</li>
                                <li>Toppop date
                                <br>{{$tree_data[1]['level'][2]->selftopup}}</li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-8">
                            <div class="rightbarwrap">
                              <div class="pi-info">
                                <h4>{{$tree_data[1]['level'][2]->fullname}} / {{$tree_data[1]['level'][2]->user_id}}</h4>
                              </div>
                              <div class="treetable">
                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <td>Factors</td>
                                      <td>Left side</td>
                                      <td>Right side</td>
                                    </tr>
                                    <tr>
                            <th>Total Balance</th>
                            <td>{{ $tree_data[1]['level'][2]->l_bv }}</td>
                            <td>{{ $tree_data[1]['level'][2]->r_bv }}</td>
                          </tr>
                          <tr>
                            <th>Current Balance</th>
                            <td>{{ $tree_data[1]['level'][2]->left_bv }}</td>
                            <td>{{ $tree_data[1]['level'][2]->right_bv }}</td>
                          </tr>
                          <tr>
                            <th>Team</th>
                            <td>{{ $tree_data[1]['level'][2]->l_c_count }}</td>
                            <td>{{ $tree_data[1]['level'][2]->r_c_count }}</td>
                          </tr>
                          <tr>
                            <th>Direct Users</th>
                            @if($tree_data[1]['level'][2]->l_d_count == "Absent")
                            <td>Absent</td>
                            <td>Absent</td>
                            @else
                            <td>{{$tree_data[1]['level'][2]->l_d_count}}</td>
                            <td>{{$tree_data[1]['level'][2]->r_d_count}}</td>
                            @endif
                          </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    <h6>{{$tree_data[1]['level'][2]->user_id}}</h6>
                  </div>
                  <div class="col-6 tree-3-4">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip activetree">
                      <img src="{{asset('images/tree-view/'.$tree_data[1]['level'][3]->image)}}" onclick="getMatrixTreeData('{{$tree_data[1]['level'][3]->user_id}}')">
                      <div class="dprofitTree-info">
                        <div class="row">
                          <div class="col-4">
                            <div class="leftbarwrap">
                              <ul>
                                <li>Placement Id
                                <br>{{$tree_data[1]['level'][3]->virtual_id}}</li>
                                <li>Total Investment
                                <br>{{$tree_data[1]['level'][3]->selftopup}}</li>
                                <li>Toppop date
                                <br>{{$tree_data[1]['level'][3]->selftopup}}</li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-8">
                            <div class="rightbarwrap">
                              <div class="pi-info">
                                <h4>{{$tree_data[1]['level'][3]->fullname}} / {{$tree_data[1]['level'][3]->user_id}}</h4>
                              </div>
                              <div class="treetable">
                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <td>Factors</td>
                                      <td>Left side</td>
                                      <td>Right side</td>
                                    </tr>
                                    <tr>
                            <th>Total Balance</th>
                            <td>{{ $tree_data[1]['level'][3]->l_bv }}</td>
                            <td>{{ $tree_data[1]['level'][3]->r_bv }}</td>
                          </tr>
                          <tr>
                            <th>Current Balance</th>
                            <td>{{ $tree_data[1]['level'][3]->left_bv }}</td>
                            <td>{{ $tree_data[1]['level'][3]->right_bv }}</td>
                          </tr>
                          <tr>
                            <th>Team</th>
                            <td>{{ $tree_data[1]['level'][3]->l_c_count }}</td>
                            <td>{{ $tree_data[1]['level'][3]->r_c_count }}</td>
                          </tr>
                          <tr>
                            <th>Direct Users</th>
                            @if($tree_data[1]['level'][3]->l_d_count == "Absent")
                            <td>Absent</td>
                            <td>Absent</td>
                            @else
                            <td>{{$tree_data[1]['level'][3]->l_d_count}}</td>
                            <td>{{$tree_data[1]['level'][3]->r_d_count}}</td>
                            @endif
                          </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    <h6>{{$tree_data[1]['level'][3]->user_id}}</h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="row rowline-4">
              <div class="col-3">
                <div class="row midline VHline-4">
                  <div class="col-6 tree-4-1">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip activetree">
                      <img src="{{asset('images/tree-view/'.$tree_data[2]['level'][0]->image)}}" onclick="getMatrixTreeData('{{$tree_data[2]['level'][0]->user_id}}')">
                      <div class="profitTree-info">
                        <div class="row">
                          <div class="col-4">
                            <div class="leftbarwrap">
                              <ul>
                                <li>Placement Id
                                <br>{{$tree_data[2]['level'][0]->virtual_id}}</li>
                                <li>Total Investment
                                <br>{{$tree_data[2]['level'][0]->selftopup}}</li>
                                <li>Toppop date
                                <br>{{$tree_data[2]['level'][0]->selftopup}}</li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-8">
                            <div class="rightbarwrap">
                              <div class="pi-info">
                                <h4>{{$tree_data[2]['level'][0]->fullname}} / {{$tree_data[2]['level'][0]->user_id}}</h4>
                              </div>
                              <div class="treetable">
                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <td>Factors</td>
                                      <td>Left side</td>
                                      <td>Right side</td>
                                    </tr>
                                    <tr>
                            <th>Total Balance</th>
                            <td>{{ $tree_data[2]['level'][0]->l_bv }}</td>
                            <td>{{ $tree_data[2]['level'][0]->r_bv }}</td>
                          </tr>
                          <tr>
                            <th>Current Balance</th>
                            <td>{{ $tree_data[2]['level'][0]->left_bv }}</td>
                            <td>{{ $tree_data[2]['level'][0]->right_bv }}</td>
                          </tr>
                          <tr>
                            <th>Team</th>
                            <td>{{ $tree_data[2]['level'][0]->l_c_count }}</td>
                            <td>{{ $tree_data[2]['level'][0]->r_c_count }}</td>
                          </tr>
                          <tr>
                            <th>Direct Users</th>
                            @if($tree_data[2]['level'][0]->l_d_count == "Absent")
                            <td>Absent</td>
                            <td>Absent</td>
                            @else
                            <td>{{$tree_data[2]['level'][0]->l_d_count}}</td>
                            <td>{{$tree_data[2]['level'][0]->r_d_count}}</td>
                            @endif
                          </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    <h6>{{$tree_data[2]['level'][0]->user_id}}</h6>
                  </div>
                  <div class="col-6 tree-4-2">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip activetree">
                      <img src="{{asset('images/tree-view/'.$tree_data[2]['level'][1]->image)}}" onclick="getMatrixTreeData('{{$tree_data[2]['level'][1]->user_id}}')">
                      <div class="dprofitTree-info">
                        <div class="row">
                          <div class="col-4">
                            <div class="leftbarwrap">
                              <ul>
                                <li>Placement Id
                                <br>{{$tree_data[2]['level'][1]->virtual_id}}</li>
                                <li>Total Investment
                                <br>{{$tree_data[2]['level'][1]->selftopup}}</li>
                                <li>Toppop date
                                <br>{{$tree_data[2]['level'][1]->selftopup}}</li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-8">
                            <div class="rightbarwrap">
                              <div class="pi-info">
                                <h4>{{$tree_data[2]['level'][1]->fullname}} / {{$tree_data[2]['level'][1]->user_id}}</h4>
                              </div>
                              <div class="treetable">
                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <td>Factors</td>
                                      <td>Left side</td>
                                      <td>Right side</td>
                                    </tr>
                                    <tr>
                            <th>Total Balance</th>
                            <td>{{ $tree_data[2]['level'][1]->l_bv }}</td>
                            <td>{{ $tree_data[2]['level'][1]->r_bv }}</td>
                          </tr>
                          <tr>
                            <th>Current Balance</th>
                            <td>{{ $tree_data[2]['level'][1]->left_bv }}</td>
                            <td>{{ $tree_data[2]['level'][1]->right_bv }}</td>
                          </tr>
                          <tr>
                            <th>Team</th>
                            <td>{{ $tree_data[2]['level'][1]->l_c_count }}</td>
                            <td>{{ $tree_data[2]['level'][1]->r_c_count }}</td>
                          </tr>
                          <tr>
                            <th>Direct Users</th>
                            @if($tree_data[2]['level'][1]->l_d_count == "Absent")
                            <td>Absent</td>
                            <td>Absent</td>
                            @else
                            <td>{{$tree_data[2]['level'][1]->l_d_count}}</td>
                            <td>{{$tree_data[2]['level'][1]->r_d_count}}</td>
                            @endif
                          </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    <h6>{{$tree_data[2]['level'][1]->user_id}}</h6>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="row midline VHline-4">
                  <div class="col-6 tree-4-3 ">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip activetree">
                      <img src="{{asset('images/tree-view/'.$tree_data[2]['level'][2]->image)}}" onclick="getMatrixTreeData('{{$tree_data[2]['level'][2]->user_id}}')">
                      <div class="profitTree-info">
                        <div class="row">
                          <div class="col-4">
                            <div class="leftbarwrap">
                              <ul>
                                <li>Placement Id
                                <br>{{$tree_data[2]['level'][2]->virtual_id}}</li>
                                <li>Total Investment
                                <br>{{$tree_data[2]['level'][2]->selftopup}}</li>
                                <li>Toppop date
                                <br>{{$tree_data[2]['level'][2]->selftopup}}</li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-8">
                            <div class="rightbarwrap">
                              <div class="pi-info">
                                <h4>{{$tree_data[2]['level'][2]->fullname}} / {{$tree_data[2]['level'][2]->user_id}}</h4>
                              </div>
                              <div class="treetable">
                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <td>Factors</td>
                                      <td>Left side</td>
                                      <td>Right side</td>
                                    </tr>
                                    <tr>
                            <th>Total Balance</th>
                            <td>{{ $tree_data[2]['level'][2]->l_bv }}</td>
                            <td>{{ $tree_data[2]['level'][2]->r_bv }}</td>
                          </tr>
                          <tr>
                            <th>Current Balance</th>
                            <td>{{ $tree_data[2]['level'][2]->left_bv }}</td>
                            <td>{{ $tree_data[2]['level'][2]->right_bv }}</td>
                          </tr>
                          <tr>
                            <th>Team</th>
                            <td>{{ $tree_data[2]['level'][2]->l_c_count }}</td>
                            <td>{{ $tree_data[2]['level'][2]->r_c_count }}</td>
                          </tr>
                          <tr>
                            <th>Direct Users</th>
                            @if($tree_data[2]['level'][2]->l_d_count == "Absent")
                            <td>Absent</td>
                            <td>Absent</td>
                            @else
                            <td>{{$tree_data[2]['level'][2]->l_d_count}}</td>
                            <td>{{$tree_data[2]['level'][2]->r_d_count}}</td>
                            @endif
                          </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    <h6>{{$tree_data[2]['level'][0]->user_id}}</h6>
                  </div>
                  <div class="col-6 tree-4-4">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                      <img src="{{asset('images/tree-view/'.$tree_data[2]['level'][3]->image)}}" onclick="getMatrixTreeData('{{$tree_data[2]['level'][3]->user_id}}')">
                      <div class="dprofitTree-info">
                        <div class="row">
                          <div class="col-4">
                            <div class="leftbarwrap">
                              <ul>
                                <li>Username
                                <br>{{$tree_data[2]['level'][3]->virtual_id}}</li>
                                <li>Station ID
                                <br>{{$tree_data[2]['level'][3]->virtual_id}}</li>
                                <li>Placement Id
                                <br>{{$tree_data[2]['level'][3]->virtual_id}}</li>
                                <li>Total Investment
                                <br>{{$tree_data[2]['level'][3]->selftopup}}</li>
                                <li>Toppop date
                                <br>{{$tree_data[2]['level'][3]->selftopup}}</li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-8">
                            <div class="rightbarwrap">
                              <div class="tiptop-img">
                                <img src="../assets/images/tree-view/absent.png">
                              </div>
                              <div class="pi-info">
                                <h4>Package : Tera</h4>
                                <h5>Total Investment : $6780000</h5>
                              </div>
                              <div class="treetable">
                                <table class="table">
                                  <tbody>
                                    <tr>
                            <th>Total Balance</th>
                            <td>{{ $tree_data[2]['level'][3]->l_bv }}</td>
                            <td>{{ $tree_data[2]['level'][3]->r_bv }}</td>
                          </tr>
                          <tr>
                            <th>Current Balance</th>
                            <td>{{ $tree_data[2]['level'][3]->left_bv }}</td>
                            <td>{{ $tree_data[2]['level'][3]->right_bv }}</td>
                          </tr>
                          <tr>
                            <th>Team</th>
                            <td>{{ $tree_data[2]['level'][3]->l_c_count }}</td>
                            <td>{{ $tree_data[2]['level'][3]->r_c_count }}</td>
                          </tr>
                          <tr>
                            <th>Direct Users</th>
                            @if($tree_data[2]['level'][3]->user_id == "Absent")
                            <td>Absent</td>
                            <td>Absent</td>
                            @else
                            <td>{{$tree_data[2]['level'][3]->l_d_count}}</td>
                            <td>{{$tree_data[2]['level'][3]->r_d_count}}</td>
                            @endif
                          </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    <h6>{{$tree_data[2]['level'][3]->user_id}}</h6>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="row midline VHline-4">
                  <div class="col-6 tree-4-5 ">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip inactivetree">
                      <img src="{{asset('images/tree-view/'.$tree_data[2]['level'][4]->image)}}" onclick="getMatrixTreeData('{{$tree_data[2]['level'][4]->user_id}}')">
                      <div class="profitTree-info">
                        <div class="row">
                          <div class="col-4">
                            <div class="leftbarwrap">
                              <ul>
                                <li>Placement Id
                                <br>{{$tree_data[2]['level'][4]->virtual_id}}</li>
                                <li>Total Investment
                                <br>{{$tree_data[2]['level'][4]->selftopup}}</li>
                                <li>Toppop date
                                <br>{{$tree_data[2]['level'][4]->selftopup}}</li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-8">
                            <div class="rightbarwrap">
                              <div class="pi-info">
                                <h4>{{$tree_data[2]['level'][4]->fullname}} / {{$tree_data[2]['level'][4]->user_id}}</h4>
                              </div>
                              <div class="treetable">
                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <td>Factors</td>
                                      <td>Left side</td>
                                      <td>Right side</td>
                                    </tr>
                                    <tr>
                            <th>Total Balance</th>
                            <td>{{ $tree_data[2]['level'][4]->l_bv }}</td>
                            <td>{{ $tree_data[2]['level'][4]->r_bv }}</td>
                          </tr>
                          <tr>
                            <th>Current Balance</th>
                            <td>{{ $tree_data[2]['level'][4]->left_bv }}</td>
                            <td>{{ $tree_data[2]['level'][4]->right_bv }}</td>
                          </tr>
                          <tr>
                            <th>Team</th>
                            <td>{{ $tree_data[2]['level'][4]->l_c_count }}</td>
                            <td>{{ $tree_data[2]['level'][4]->r_c_count }}</td>
                          </tr>
                          <tr>
                            <th>Direct Users</th>
                            @if($tree_data[2]['level'][4]->l_d_count == "Absent")
                            <td>Absent</td>
                            <td>Absent</td>
                            @else
                            <td>{{$tree_data[2]['level'][4]->l_d_count}}</td>
                            <td>{{$tree_data[2]['level'][4]->r_d_count}}</td>
                            @endif
                          </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    <h6>{{$tree_data[2]['level'][4]->user_id}}</h6>
                  </div>
                  <div class="col-6 tree-4-6">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip activetree">
                      <img src="{{asset('images/tree-view/'.$tree_data[2]['level'][5]->image)}}" onclick="getMatrixTreeData('{{$tree_data[2]['level'][5]->user_id}}')">
                      <div class="profitTree-info">
                        <div class="row">
                          <div class="col-4">
                            <div class="leftbarwrap">
                              <ul>
                                <li>Placement Id
                                <br>{{$tree_data[2]['level'][5]->virtual_id}}</li>
                                <li>Total Investment
                                <br>{{$tree_data[2]['level'][5]->selftopup}}</li>
                                <li>Toppop date
                                <br>{{$tree_data[2]['level'][5]->selftopup}}</li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-8">
                            <div class="rightbarwrap">
                              <div class="pi-info">
                                <h4>{{$tree_data[2]['level'][5]->fullname}} / {{$tree_data[2]['level'][5]->user_id}}</h4>
                              </div>
                              <div class="treetable">
                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <td>Factors</td>
                                      <td>Left side</td>
                                      <td>Right side</td>
                                    </tr>
                                    <tr>
                            <th>Total Balance</th>
                            <td>{{ $tree_data[2]['level'][5]->l_bv }}</td>
                            <td>{{ $tree_data[2]['level'][5]->r_bv }}</td>
                          </tr>
                          <tr>
                            <th>Current Balance</th>
                            <td>{{ $tree_data[2]['level'][5]->left_bv }}</td>
                            <td>{{ $tree_data[2]['level'][5]->right_bv }}</td>
                          </tr>
                          <tr>
                            <th>Team</th>
                            <td>{{ $tree_data[2]['level'][5]->l_c_count }}</td>
                            <td>{{ $tree_data[2]['level'][5]->r_c_count }}</td>
                          </tr>
                          <tr>
                            <th>Direct Users</th>
                            @if($tree_data[2]['level'][5]->l_d_count == "Absent")
                            <td>Absent</td>
                            <td>Absent</td>
                            @else
                            <td>{{$tree_data[2]['level'][5]->l_d_count}}</td>
                            <td>{{$tree_data[2]['level'][5]->r_d_count}}</td>
                            @endif
                          </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    <h6>{{$tree_data[2]['level'][5]->user_id}}</h6>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="row midline VHline-4">
                  <div class="col-6 tree-4-7 ">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip inactivetree">
                      <img src="{{asset('images/tree-view/'.$tree_data[2]['level'][6]->image)}}" onclick="getMatrixTreeData('{{$tree_data[2]['level'][6]->user_id}}')">
                      <div class="profitTree-info">
                        <div class="row">
                          <div class="col-4">
                            <div class="leftbarwrap">
                              <ul>
                                <li>Placement Id
                                <br>{{$tree_data[2]['level'][6]->virtual_id}}</li>
                                <li>Total Investment
                                <br>{{$tree_data[2]['level'][6]->selftopup}}</li>
                                <li>Toppop date
                                <br>{{$tree_data[2]['level'][6]->selftopup}}</li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-8">
                            <div class="rightbarwrap">
                              <div class="pi-info">
                                <h4>{{$tree_data[2]['level'][6]->fullname}} / {{$tree_data[2]['level'][6]->user_id}}</h4>
                              </div>
                              <div class="treetable">
                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <td>Factors</td>
                                      <td>Left side</td>
                                      <td>Right side</td>
                                    </tr>
                                    <tr>
                            <th>Total Balance</th>
                            <td>{{ $tree_data[2]['level'][6]->l_bv }}</td>
                            <td>{{ $tree_data[2]['level'][6]->r_bv }}</td>
                          </tr>
                          <tr>
                            <th>Current Balance</th>
                            <td>{{ $tree_data[2]['level'][6]->left_bv }}</td>
                            <td>{{ $tree_data[2]['level'][6]->right_bv }}</td>
                          </tr>
                          <tr>
                            <th>Team</th>
                            <td>{{ $tree_data[2]['level'][6]->l_c_count }}</td>
                            <td>{{ $tree_data[2]['level'][6]->r_c_count }}</td>
                          </tr>
                          <tr>
                            <th>Direct Users</th>
                            @if($tree_data[2]['level'][6]->l_d_count == "Absent")
                            <td>Absent</td>
                            <td>Absent</td>
                            @else
                            <td>{{$tree_data[2]['level'][6]->l_d_count}}</td>
                            <td>{{$tree_data[2]['level'][6]->r_d_count}}</td>
                            @endif
                          </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    <h6>{{$tree_data[2]['level'][6]->user_id}}</h6>
                  </div>
                  <div class="col-6 tree-4-8">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip activetree">
                      <img src="{{asset('images/tree-view/'.$tree_data[2]['level'][7]->image)}}" onclick="getMatrixTreeData('{{$tree_data[2]['level'][7]->user_id}}')">
                      <div class="profitTree-info">
                        <div class="row">
                          <div class="col-4">
                            <div class="leftbarwrap">
                              <ul>
                                <li>Placement Id
                                <br>{{$tree_data[2]['level'][7]->virtual_id}}</li>
                                <li>Total Investment
                                <br>{{$tree_data[2]['level'][7]->selftopup}}</li>
                                <li>Toppop date
                                <br>{{$tree_data[2]['level'][7]->selftopup}}</li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-8">
                            <div class="rightbarwrap">
                              <div class="pi-info">
                                <h4>{{$tree_data[2]['level'][7]->fullname}} / {{$tree_data[2]['level'][7]->user_id}}</h4>
                              </div>
                              <div class="treetable">
                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <td>Factors</td>
                                      <td>Left side</td>
                                      <td>Right side</td>
                                    </tr>
                                    <tr>
                            <th>Total Balance</th>
                            <td>{{ $tree_data[2]['level'][7]->l_bv }}</td>
                            <td>{{ $tree_data[2]['level'][7]->r_bv }}</td>
                          </tr>
                          <tr>
                            <th>Current Balance</th>
                            <td>{{ $tree_data[2]['level'][7]->left_bv }}</td>
                            <td>{{ $tree_data[2]['level'][7]->right_bv }}</td>
                          </tr>
                          <tr>
                            <th>Team</th>
                            <td>{{ $tree_data[2]['level'][7]->l_c_count }}</td>
                            <td>{{ $tree_data[2]['level'][7]->r_c_count }}</td>
                          </tr>
                          <tr>
                            <th>Direct Users</th>
                            @if($tree_data[2]['level'][7]->l_d_count == "Absent")
                            <td>Absent</td>
                            <td>Absent</td>
                            @else
                            <td>{{$tree_data[2]['level'][7]->l_d_count}}</td>
                            <td>{{$tree_data[2]['level'][7]->r_d_count}}</td>
                            @endif
                          </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    <h6>{{$tree_data[2]['level'][7]->user_id}}</h6>
                  </div>
                </div>
                <!-- end page title -->
              </div>
              <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
          </div>
        </div>
      </div>
    </div>
  </div>

          <!-- end main content-->
          <script>
          function myFunctionRefLeft(leftId,leftCopy) {
          //alert(leftId);
          //alert(leftCopy);
          var copyText = document.getElementById(leftId);
          //alert(copyText.value);
          copyText.select();
          document.execCommand("copy");
          var tooltip = document.getElementById(leftCopy);
          console.log(tooltip);
          tooltip.innerHTML =
          "<i class='fa-regular fa-copy color-secondary'></i>Copied !"; // + copyText.value;
          setTimeout(function(){
          tooltip.innerHTML =
          "<i class='fa-regular fa-copy'></i>Copy";
          },3000);
          }
          function myFunctionRefRight(rightId,rightCopy) {
          var copyText = document.getElementById(rightId);
          copyText.select();
          document.execCommand("copy");
          var tooltip = document.getElementById(rightCopy);
          console.log(tooltip);
          tooltip.innerHTML =
          "<i class='fa-regular fa-copy color-secondary'></i>Copied !"; // + copyText.value;
          setTimeout(function(){
          tooltip.innerHTML =
          "<i class='fa-regular fa-copy'></i>Copy";
          },3000);
          }
          function getMatrixTreeData(userid)
          {
          if(userid == "Absent")
          {
          }
          else{
          var url =  '{{ url('getlevelviewtree') }}';
          var form = $('<form action="' + url + '" method="post">' +
            '<input type="text" name="id" value="' + userid + '" />'
            + '{{ csrf_field() }}'  +
          '</form>');
          $('body').append(form);
          form.submit();
          }
          $('#searchuserid').val('');
          }
          function onBackClick(userid)
          {
          var authId = ('{{Auth::user()->user_id}}');
          if(userid == authId)
          {  return false;
          }else{
          window.history.go(-1);
          return false;
          }
          }
          function onForwardClick()
          {
          window.history.go(+1);
          return false;
          }
          function onSearchClick()
          {
          var userid = $('#searchuserid').val();
          if (userid != '' ) {
          getMatrixTreeData(userid);
          }
          }
          function goToTopIdClick()
          {
          window.location.href = "{{url('\getlevelviewtree')}}";
          }
          function checkUserExisted(){
          var user_id = $('#searchuserid').val();
          $.ajax({
          type:'POST',
          url:"{{url('/checkuserexist/crossleg')}}",
          data:{user_id:user_id, '_token': '{{ csrf_token() }}'},
          success:function(response){
          console.log(response);
          if(response.code == '200'){
          $('#btnsearch').prop('disabled', false)
          }
          else{
          $('#btnsearch').prop('disabled', true)
          }
          }
          });
          }
          document.getElementById('dropdownMenuButton1').addEventListener('mouseover', function () {
          document.querySelector('.dropdown-menu').style.display = 'block';
          });
          document.getElementById('dropdownMenuButton1').addEventListener('mouseout', function () {
          document.querySelector('.dropdown-menu').style.display = 'none';
          });
          </script>
          @endsection
