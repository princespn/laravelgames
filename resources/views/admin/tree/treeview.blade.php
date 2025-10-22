@extends('layouts.user_type.admin-app')
@section('content')
@php    
    $userdata =$arrData['user'];
    $tree_data =$arrData['tree_data'];
    $referrallink = url('/register');
@endphp
<div class="container-fluid" style="padding-top: 0px !important">
    <div class="row introscreen">
        <div class="col-md-4 offset-md-4">
            <h1><span>T</span>ree <span>V</span>iew</h1>
        </div>
        <div class="col-md-4">
            <div class="d-flex">
                <div>
                    <form class="input-group flex-nowrap" @submit.prevent="onSearchClick">
                        <input type="text" class="admin-form-control-search" id="searchuserid" onblur="checkUserExistedSearch()" name="search" placeholder="Search..." autocomplete="off" />&nbsp;&nbsp;&nbsp;
                        <span class="input-group-text" id="addon-wrapping">
                            <a href="javascript:void(0)" onclick="onSearchClick()"> <i class="fa fa-search"></i></a>
                        </span>
                    </form>
                  <span class="text-success" > </span>
                </div>
                <button class="btn btntree" onclick="onBackClick('{{$userdata->user_id}}')" style="padding: 3px; cursor: pointer;">
                    <i class="fa fa-arrow-left"></i>
                </button>
                <button class="btn btntree" onclick="onForwardClick()" style="padding: 3px; cursor: pointer;">
                    <i class="fa fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
    
    <div class="adminTree">
        <div class="row admin-midline">
            <div class="col-12">
                <div class="admin-tree-level1">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                        <!-- <img src="/admin-assets/images/active.png" /> -->
                           @php
                                $userdataimage = asset("images/treeicon/$userdata->image");
                           @endphp
                        <img class="img-a" src="{{$userdataimage}}" width="40">
                        <div class="adminTree-tooip-text">
                            <ul>
                                <li>
                                    <span>User Name</span>
                                    <span>{{$userdata->user_id}}</span>
                                </li>
                                <li>
                                    <span>Full Name</span>
                                    <span>{{$userdata->fullname}}</span>
                                </li>
                                <li>
                                    <span>Sponsor Full Name</span>
                                    <span>{{$userdata->sponsor_fullname}}</span>
                                </li>
                                <li>
                                    <span>Sponsor Username</span>
                                    <span>{{$userdata->sponsor_id}}</span>
                                </li>
                                <li>
                                    <span>Placement Id</span>
                                    <span>{{$userdata->virtual_id}}</span>
                                </li>
                                <li>
                                    <span>Date of joining</span>
                                    @php 
                                    if($userdata->entry_time != "Absent"){

                                     $date = $userdata->entry_time;
                                     }else{
                                        $date = "";
                                     }
                                    $datetime = new DateTime($date); @endphp
                                    <span>{{$datetime->format('Y-m-d')}}</span>
                                </li>
                                <li>
                                    <span>Left ID</span>
                                    <span>{{$userdata->l_c_count}}</span>
                                </li>
                                <li>
                                    <span>Right ID</span>
                                    <span>{{$userdata->r_c_count}}</span>
                                </li>
                                <li>
                                    <span>Left Business</span>
                                    <span>{{$userdata->l_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Business</span>
                                    <span>{{$userdata->r_bv}}</span>
                                </li>
                                <li>
                                    <span>Left Balance</span>
                                    <span>{{$userdata->left_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Balance</span>
                                    <span>{{$userdata->right_bv}}</span>
                                </li> 
                                <li>
                                    <span>User Rank</span>
                                    <span>{{$userdata->rank}}</span>
                                </li>
                                <li>
                                    <span>Buying</span>
                                    <span>{{$userdata->selftopup}}</span>
                                </li>
                            </ul>
                        </div>
                    </a>
                    <h6>{{$userdata->user_id}}</h6>
                </div>
            </div>
        </div>
        <div class="row admin-midline AdminVHline">
            <div class="col-6 admintree-2-1">
                <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                    <!-- <img src="/admin-assets/images/absent.png" /> -->
                       @php
                          $simg0 = $tree_data[0]['level'][0]->image;
                          $treelevelimage0 = asset("images/treeicon/$simg0");
                       @endphp
                       <img class="img-a" src="{{$treelevelimage0}}" width="40" onclick='getMatrixTreeData("{{$tree_data[0]['level'][0]->user_id}}")'>
                        <div class="adminTree-tooip-text">
                            <ul>
                                <li>
                                    <span>User Name</span>
                                    <span>{{$tree_data[0]['level'][0]->user_id}}</span>
                                </li>
                                <li>
                                    <span>Full Name</span>
                                    <span>{{$tree_data[0]['level'][0]->fullname}}</span>
                                </li>
                                <li>
                                    <span>Sponsor Full Name</span>
                                    <span>{{$tree_data[0]['level'][0]->sponsor_fullname}}</span>
                                </li>
                                 <li>
                                    <span>Sponsor Username</span>
                                    <span>{{$tree_data[0]['level'][0]->sponsor_id}}</span>
                                </li>
                                <li>
                                    <span>Placement Id</span>
                                    <span>{{$tree_data[0]['level'][0]->virtual_id}}</span>
                                </li>
                                <li>
                                <span>Date of joining</span>
                                @php 
                                    if($tree_data[0]['level'][0]->entry_time != "Absent"){

                                     $date = $tree_data[0]['level'][0]->entry_time;
                                     }else{
                                        $date = "";
                                     }
                                    $datetime = new DateTime($date); @endphp
                                    <span>{{$datetime->format('Y-m-d')}}</span>
                                </li>
                                <li>
                                    <span>Left ID</span>
                                    <span>{{$tree_data[0]['level'][0]->l_c_count}}</span>
                                </li>
                                <li>
                                    <span>Right ID</span>
                                    <span>{{$tree_data[0]['level'][0]->r_c_count}}</span>
                                </li>
                                <li>
                                    <span>Left Business</span>
                                    <span>{{$tree_data[0]['level'][0]->l_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Business</span>
                                    <span>{{$tree_data[0]['level'][0]->r_bv}}</span>
                                </li>
                                <li>
                                    <span>Left Balance</span>
                                    <span>{{$tree_data[0]['level'][0]->left_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Balance</span>
                                    <span>{{$tree_data[0]['level'][0]->right_bv}}</span>
                                </li> 
                                <li>
                                    <span>User Rank</span>
                                    <span>{{$tree_data[0]['level'][0]->rank}}</span>
                                </li>
                                <li>
                                    <span>Buying</span>
                                    <span>{{$tree_data[0]['level'][0]->selftopup}}</span>
                                </li>
                            </ul>
                        </div>
                    </a>
                <h6>{{$tree_data[0]['level'][0]->user_id}}</h6>
            </div>
            <div class="col-6 admintree-2-2">
                <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                    <!-- <img src="/admin-assets/images/absent.png" /> -->
                       @php
                            $simg1 = $tree_data[0]['level'][1]->image;
                            $treelevelimage1 = asset("images/treeicon/$simg1");
                       @endphp
                        <img class="img-a" src="{{$treelevelimage1}}" width="40" onclick="getMatrixTreeData('{{$tree_data[0]['level'][1]->user_id}}')">
                        <div class="adminTree-tooip-text">
                            <ul>
                                <li>
                                    <span>User Name</span>
                                    <span>{{$tree_data[0]['level'][1]->user_id}}</span>
                                </li>
                                <li>
                                    <span>Full Name</span>
                                    <span>{{$tree_data[0]['level'][1]->fullname}}</span>
                                </li>
                                <li>
                                    <span>Sponsor Full Name</span>
                                    <span>{{$tree_data[0]['level'][1]->sponsor_fullname}}</span>
                                </li>
                                 <li>
                                    <span>Sponsor Username</span>
                                    <span>{{$tree_data[0]['level'][1]->sponsor_id}}</span>
                                </li>

                                <li>
                                    <span>Placement Id</span>
                                    <span>{{$tree_data[0]['level'][1]->virtual_id}}</span>
                                </li>
                                <li>
                                    <span>Date of joining</span>
                                    @php 
                                    if($tree_data[0]['level'][1]->entry_time != "Absent"){

                                     $date = $tree_data[0]['level'][1]->entry_time;
                                     }else{
                                        $date = "";
                                     }
                                    $datetime = new DateTime($date); @endphp
                                    <span>{{$datetime->format('Y-m-d')}}</span>
                                </li>
                                <li>
                                    <span>Left ID</span>
                                    <span>{{$tree_data[0]['level'][1]->l_c_count}}</span>
                                </li>
                                <li>
                                    <span>Right ID</span>
                                    <span>{{$tree_data[0]['level'][1]->r_c_count}}</span>
                                </li>
                                <li>
                                    <span>Left Business</span>
                                    <span>{{$tree_data[0]['level'][1]->l_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Business</span>
                                    <span>{{$tree_data[0]['level'][1]->r_bv}}</span>
                                </li>
                                <li>
                                    <span>Left Balance</span>
                                    <span>{{$tree_data[0]['level'][1]->left_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Balance</span>
                                    <span>{{$tree_data[0]['level'][1]->right_bv}}</span>
                                </li> 
                                <li>
                                    <span>User Rank</span>
                                    <span>{{$tree_data[0]['level'][1]->rank}}</span>
                                </li>
                                <li>
                                    <span>Buying</span>
                                    <span>{{$tree_data[0]['level'][1]->selftopup}}</span>
                                </li>
                            </ul>
                        </div>
                    </a>
                    <h6>{{$tree_data[0]['level'][1]->user_id}}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="row admin-midline AdminVHline">
                    <div class="col-6 admintree-3-1">
                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                            <!-- <img src="/admin-assets/images/active.png" /> -->
                            @php
                              $simg10 = $tree_data[1]['level'][0]->image;
                              $treelevelimage10 = asset("images/treeicon/$simg10");
                             
                           @endphp
                               <img class="img-a" src="{{$treelevelimage10}}" width="40" onclick="getMatrixTreeData('{{$tree_data[1]['level'][0]->user_id}}')">
                            <div class="adminTree-tooip-text">
                          <ul>
                                <li>
                                    <span>User Name</span>
                                    <span>{{$tree_data[1]['level'][0]->user_id}}</span>
                                </li>
                                <li>
                                    <span>Full Name</span>
                                    <span>{{$tree_data[1]['level'][0]->fullname}}</span>
                                </li>
                                <li>
                                    <span>Sponsor Full Name</span>
                                    <span>{{$tree_data[1]['level'][0]->sponsor_fullname}}</span>
                                </li>
                                 <li>
                                    <span>Sponsor Username</span>
                                    <span>{{$tree_data[1]['level'][0]->sponsor_id}}</span>
                                </li>

                                <li>
                                    <span>Placement Id</span>
                                    <span>{{$tree_data[1]['level'][0]->virtual_id}}</span>
                                </li>
                                <li>
                                    <span>Date of joining</span>
                                    @php 
                                    if($tree_data[1]['level'][0]->entry_time != "Absent"){

                                     $date = $tree_data[1]['level'][0]->entry_time;
                                     }else{
                                        $date = "";
                                     }
                                    $datetime = new DateTime($date); @endphp
                                    <span>{{$datetime->format('Y-m-d')}}</span>
                                </li>
                                <li>
                                    <span>Left ID</span>
                                    <span>{{$tree_data[1]['level'][0]->l_c_count}}</span>
                                </li>
                                <li>
                                    <span>Right ID</span>
                                    <span>{{$tree_data[1]['level'][0]->r_c_count}}</span>
                                </li>
                                <li>
                                    <span>Left Business</span>
                                    <span>{{$tree_data[1]['level'][0]->l_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Business</span>
                                    <span>{{$tree_data[1]['level'][0]->r_bv}}</span>
                                </li>
                                <li>
                                    <span>Left Balance</span>
                                    <span>{{$tree_data[1]['level'][0]->left_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Balance</span>
                                    <span>{{$tree_data[1]['level'][0]->right_bv}}</span>
                                </li> 
                                <li>
                                    <span>User Rank</span>
                                    <span>{{$tree_data[1]['level'][0]->rank}}</span>
                                </li>
                                <li>
                                    <span>Buying</span>
                                    <span>{{$tree_data[1]['level'][0]->selftopup}}</span>
                                </li>
                            </ul>
                        </div>
                        </a>
                        <h6>{{$tree_data[1]['level'][0]->user_id}}</h6>
                    </div>
                    <div class="col-6 admintree-3-2">
                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                            <!-- <img src="/admin-assets/images/active.png" /> -->
                            @php
                              $simg11 = $tree_data[1]['level'][1]->image;
                              $treelevelimage11 = asset("images/treeicon/$simg11");
                           @endphp
                             <img class="img-a" src="{{$treelevelimage11}}" width="40" onclick="getMatrixTreeData('{{$tree_data[1]['level'][1]->user_id}}')">
                            <div class="adminTree-tooip-text">
                             <ul>
                                <li>
                                    <span>User Name</span>
                                    <span>{{$tree_data[1]['level'][1]->user_id}}</span>
                                </li>
                                <li>
                                    <span>Full Name</span>
                                    <span>{{$tree_data[1]['level'][1]->fullname}}</span>
                                </li>
                                <li>
                                    <span>Sponsor Full Name</span>
                                    <span>{{$tree_data[1]['level'][1]->sponsor_fullname}}</span>
                                </li>
                                 <li>
                                    <span>Sponsor Username</span>
                                    <span>{{$tree_data[1]['level'][1]->sponsor_id}}</span>
                                </li>

                                <li>
                                    <span>Placement Id</span>
                                    <span>{{$tree_data[1]['level'][1]->virtual_id}}</span>
                                </li>
                                <li>
                                    <span>Date of joining</span>
                                    @php 
                                    if($tree_data[1]['level'][1]->entry_time != "Absent"){

                                     $date = $tree_data[1]['level'][1]->entry_time;
                                     }else{
                                        $date = "";
                                     }
                                    $datetime = new DateTime($date); @endphp
                                    <span>{{$datetime->format('Y-m-d')}}</span>
                                </li>
                                <li>
                                    <span>Left ID</span>
                                    <span>{{$tree_data[1]['level'][1]->l_c_count}}</span>
                                </li>
                                <li>
                                    <span>Right ID</span>
                                    <span>{{$tree_data[1]['level'][1]->r_c_count}}</span>
                                </li>
                                <li>
                                    <span>Left Business</span>
                                    <span>{{$tree_data[1]['level'][1]->l_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Business</span>
                                    <span>{{$tree_data[1]['level'][1]->r_bv}}</span>
                                </li>
                                <li>
                                    <span>Left Balance</span>
                                    <span>{{$tree_data[1]['level'][1]->left_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Balance</span>
                                    <span>{{$tree_data[1]['level'][1]->right_bv}}</span>
                                </li> 
                                <li>
                                    <span>User Rank</span>
                                    <span>{{$tree_data[1]['level'][1]->rank}}</span>
                                </li>
                                <li>
                                    <span>Buying</span>
                                    <span>{{$tree_data[1]['level'][1]->selftopup}}</span>
                                </li>
                            </ul>
                        </div> 
                        </a>
                       <h6>{{$tree_data[1]['level'][1]->user_id}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row admin-midline AdminVHline">
                    <div class="col-6 admintree-3-3">
                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                            <!-- <img src="/admin-assets/images/active.png" /> -->
                            @php
                              $simg12 = $tree_data[1]['level'][2]->image;
                              $treelevelimage12 = asset("images/treeicon/$simg12");
                           @endphp
                        <img class="img-a" src="{{$treelevelimage12}}" width="40" onclick="getMatrixTreeData('{{$tree_data[1]['level'][2]->user_id}}')">
                            <div class="adminTree-tooip-text">
                            <ul>
                                <li>
                                    <span>User Name</span>
                                    <span>{{$tree_data[1]['level'][2]->user_id}}</span>
                                </li>
                                <li>
                                    <span>Full Name</span>
                                    <span>{{$tree_data[1]['level'][2]->fullname}}</span>
                                </li>
                                <li>
                                    <span>Sponsor Full Name</span>
                                    <span>{{$tree_data[1]['level'][2]->sponsor_fullname}}</span>
                                </li>
                                 <li>
                                    <span>Sponsor Username</span>
                                    <span>{{$tree_data[1]['level'][2]->sponsor_id}}</span>
                                </li>

                                <li>
                                    <span>Placement Id</span>
                                    <span>{{$tree_data[1]['level'][2]->virtual_id}}</span>
                                </li>
                                <li>
                                    <span>Date of joining</span>
                                    @php 
                                    if($tree_data[1]['level'][2]->entry_time != "Absent"){

                                     $date = $tree_data[1]['level'][2]->entry_time;
                                     }else{
                                        $date = "";
                                     }
                                    $datetime = new DateTime($date); @endphp
                                    <span>{{$datetime->format('Y-m-d')}}</span>
                                </li>
                                <li>
                                    <span>Left ID</span>
                                    <span>{{$tree_data[1]['level'][2]->l_c_count}}</span>
                                </li>
                                <li>
                                    <span>Right ID</span>
                                    <span>{{$tree_data[1]['level'][2]->r_c_count}}</span>
                                </li>
                                <li>
                                    <span>Left Business</span>
                                    <span>{{$tree_data[1]['level'][2]->l_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Business</span>
                                    <span>{{$tree_data[1]['level'][2]->r_bv}}</span>
                                </li>
                                <li>
                                    <span>Left Balance</span>
                                    <span>{{$tree_data[1]['level'][2]->left_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Balance</span>
                                    <span>{{$tree_data[1]['level'][2]->right_bv}}</span>
                                </li> 
                                <li>
                                    <span>User Rank</span>
                                    <span>{{$tree_data[1]['level'][2]->rank}}</span>
                                </li>
                                <li>
                                    <span>Buying</span>
                                    <span>{{$tree_data[1]['level'][2]->selftopup}}</span>
                                </li>
                            </ul>
                        </div>
                        </a>
                        <h6>{{$tree_data[1]['level'][2]->user_id}}</h6>
                    </div>
                    <div class="col-6 admintree-3-4">
                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                            <!-- <img src="/admin-assets/images/active.png" />  -->
                            @php
                                $simg13 = $tree_data[1]['level'][3]->image;
                                $treelevelimage13 = asset("images/treeicon/$simg13");
                           @endphp
                        <img class="img-a" src="{{$treelevelimage13}}" width="40" onclick="getMatrixTreeData('{{$tree_data[1]['level'][3]->user_id}}')">
                            <div class="adminTree-tooip-text">
                             <ul>
                                <li>
                                    <span>User Name</span>
                                    <span>{{$tree_data[1]['level'][3]->user_id}}</span>
                                </li>
                                <li>
                                    <span>Full Name</span>
                                    <span>{{$tree_data[1]['level'][3]->fullname}}</span>
                                </li>
                                <li>
                                    <span>Sponsor Full Name</span>
                                    <span>{{$tree_data[1]['level'][3]->sponsor_fullname}}</span>
                                </li>
                                 <li>
                                    <span>Sponsor Username</span>
                                    <span>{{$tree_data[1]['level'][3]->sponsor_id}}</span>
                                </li>

                                <li>
                                    <span>Placement Id</span>
                                    <span>{{$tree_data[1]['level'][3]->virtual_id}}</span>
                                </li>
                                <li>
                                    <span>Date of joining</span>
                                    @php 
                                    if($tree_data[1]['level'][3]->entry_time != "Absent"){

                                     $date = $tree_data[1]['level'][3]->entry_time;
                                     }else{
                                        $date = "";
                                     }
                                    $datetime = new DateTime($date); @endphp
                                    <span>{{$datetime->format('Y-m-d')}}</span>
                                </li>
                                <li>
                                    <span>Left ID</span>
                                    <span>{{$tree_data[1]['level'][3]->l_c_count}}</span>
                                </li>
                                <li>
                                    <span>Right ID</span>
                                    <span>{{$tree_data[1]['level'][3]->r_c_count}}</span>
                                </li>
                                <li>
                                    <span>Left Business</span>
                                    <span>{{$tree_data[1]['level'][3]->l_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Business</span>
                                    <span>{{$tree_data[1]['level'][3]->r_bv}}</span>
                                </li>
                                <li>
                                    <span>Left Balance</span>
                                    <span>{{$tree_data[1]['level'][3]->left_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Balance</span>
                                    <span>{{$tree_data[1]['level'][3]->right_bv}}</span>
                                </li> 
                                <li>
                                    <span>User Rank</span>
                                    <span>{{$tree_data[1]['level'][3]->rank}}</span>
                                </li>
                                <li>
                                    <span>Buying</span>
                                    <span>{{$tree_data[1]['level'][3]->selftopup}}</span>
                                </li>
                            </ul>
                        </div> 
                        </a>
                          <h6>{{$tree_data[1]['level'][3]->user_id}}</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="row admin-midline AdminVHline">
                    <div class="col-6 admintree-4-1">
                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                            <!-- <img src="/admin-assets/images/active.png" /> -->
                            @php
                              $simg10 = $tree_data[2]['level'][0]->image;
                              $treelevelimage10 = asset("images/treeicon/$simg10");
                            @endphp
                               <img class="img-a" src="{{$treelevelimage10}}" width="40" onclick="getMatrixTreeData('{{$tree_data[2]['level'][0]->user_id}}')">
                            <div class="adminTree-tooip-text">
                                <ul>
                                    <li>
                                        <span>User Name</span>
                                        <span>{{$tree_data[2]['level'][0]->user_id}}</span>
                                    </li>
                                    <li>
                                        <span>Full Name</span>
                                        <span>{{$tree_data[2]['level'][0]->fullname}}</span>
                                    </li>
                                    <li>
                                        <span>Sponsor Full Name</span>
                                        <span>{{$tree_data[2]['level'][0]->sponsor_fullname}}</span>
                                    </li>
                                     <li>
                                        <span>Sponsor Username</span>
                                        <span>{{$tree_data[2]['level'][0]->sponsor_id}}</span>
                                    </li>

                                    <li>
                                        <span>Placement Id</span>
                                        <span>{{$tree_data[2]['level'][0]->virtual_id}}</span>
                                    </li>
                                    <li>
                                        <span>Date of joining</span>
                                        @php
                                        if($tree_data[2]['level'][0]->entry_time != "Absent"){

                                         $date = $tree_data[2]['level'][0]->entry_time;
                                         }else{
                                            $date = "";
                                         }
                                        $datetime = new DateTime($date); @endphp
                                        <span>{{$datetime->format('Y-m-d')}}</span>
                                    </li>
                                    <li>
                                        <span>Left ID</span>
                                        <span>{{$tree_data[2]['level'][0]->l_c_count}}</span>
                                    </li>
                                    <li>
                                        <span>Right ID</span>
                                        <span>{{$tree_data[2]['level'][0]->r_c_count}}</span>
                                    </li>
                                    <li>
                                        <span>Left Business</span>
                                        <span>{{$tree_data[2]['level'][0]->l_bv}}</span>
                                    </li>
                                    <li>
                                        <span>Right Business</span>
                                        <span>{{$tree_data[2]['level'][0]->r_bv}}</span>
                                    </li>
                                    <li>
                                        <span>Left Balance</span>
                                        <span>{{$tree_data[2]['level'][0]->left_bv}}</span>
                                    </li>
                                    <li>
                                        <span>Right Balance</span>
                                        <span>{{$tree_data[2]['level'][0]->right_bv}}</span>
                                    </li>
                                    <li>
                                        <span>User Rank</span>
                                        <span>{{$tree_data[2]['level'][0]->rank}}</span>
                                    </li>
                                    <li>
                                        <span>Buying</span>
                                        <span>{{$tree_data[2]['level'][0]->selftopup}}</span>
                                    </li>
                                </ul>
                            </div>
                        </a>
                        <h6>{{$tree_data[2]['level'][0]->user_id}}</h6>
                    </div>
                    <div class="col-6 admintree-4-2">
                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                            <!-- <img src="/admin-assets/images/active.png" /> -->
                            @php
                              $simg11 = $tree_data[2]['level'][1]->image;
                              $treelevelimage11 = asset("images/treeicon/$simg11");
                            @endphp
                            <img class="img-a" src="{{$treelevelimage11}}" width="40" onclick="getMatrixTreeData('{{$tree_data[2]['level'][1]->user_id}}')">
                            <div class="adminTree-tooip-text">
                                <ul>
                                    <li>
                                        <span>User Name</span>
                                        <span>{{$tree_data[2]['level'][1]->user_id}}</span>
                                    </li>
                                    <li>
                                        <span>Full Name</span>
                                        <span>{{$tree_data[2]['level'][1]->fullname}}</span>
                                    </li>
                                    <li>
                                        <span>Sponsor Full Name</span>
                                        <span>{{$tree_data[2]['level'][1]->sponsor_fullname}}</span>
                                    </li>
                                     <li>
                                        <span>Sponsor Username</span>
                                        <span>{{$tree_data[2]['level'][1]->sponsor_id}}</span>
                                    </li>

                                    <li>
                                        <span>Placement Id</span>
                                        <span>{{$tree_data[2]['level'][1]->virtual_id}}</span>
                                    </li>
                                    <li>
                                        <span>Date of joining</span>
                                        @php
                                        if($tree_data[2]['level'][1]->entry_time != "Absent"){

                                         $date = $tree_data[2]['level'][1]->entry_time;
                                         }else{
                                            $date = "";
                                         }
                                        $datetime = new DateTime($date); @endphp
                                        <span>{{$datetime->format('Y-m-d')}}</span>
                                    </li>
                                    <li>
                                        <span>Left ID</span>
                                        <span>{{$tree_data[2]['level'][1]->l_c_count}}</span>
                                    </li>
                                    <li>
                                        <span>Right ID</span>
                                        <span>{{$tree_data[2]['level'][1]->r_c_count}}</span>
                                    </li>
                                    <li>
                                        <span>Left Business</span>
                                        <span>{{$tree_data[2]['level'][1]->l_bv}}</span>
                                    </li>
                                    <li>
                                        <span>Right Business</span>
                                        <span>{{$tree_data[2]['level'][1]->r_bv}}</span>
                                    </li>
                                    <li>
                                        <span>Left Balance</span>
                                        <span>{{$tree_data[2]['level'][1]->left_bv}}</span>
                                    </li>
                                    <li>
                                        <span>Right Balance</span>
                                        <span>{{$tree_data[2]['level'][1]->right_bv}}</span>
                                    </li>
                                    <li>
                                        <span>User Rank</span>
                                        <span>{{$tree_data[2]['level'][1]->rank}}</span>
                                    </li>
                                    <li>
                                        <span>Buying</span>
                                        <span>{{$tree_data[2]['level'][1]->selftopup}}</span>
                                    </li>
                                </ul>
                            </div>
                        </a>
                       <h6>{{$tree_data[2]['level'][1]->user_id}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="row admin-midline AdminVHline">
                    <div class="col-6 admintree-4-3">
                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                            <!-- <img src="/admin-assets/images/active.png" /> -->
                            @php
                              $simg12 = $tree_data[2]['level'][2]->image;
                              $treelevelimage12 = asset("images/treeicon/$simg12");
                           @endphp
                        <img class="img-a" src="{{$treelevelimage12}}" width="40" onclick="getMatrixTreeData('{{$tree_data[2]['level'][2]->user_id}}')">
                            <div class="adminTree-tooip-text">
                            <ul>
                                <li>
                                    <span>User Name</span>
                                    <span>{{$tree_data[2]['level'][2]->user_id}}</span>
                                </li>
                                <li>
                                    <span>Full Name</span>
                                    <span>{{$tree_data[2]['level'][2]->fullname}}</span>
                                </li>
                                <li>
                                    <span>Sponsor Full Name</span>
                                    <span>{{$tree_data[2]['level'][2]->sponsor_fullname}}</span>
                                </li>
                                 <li>
                                    <span>Sponsor Username</span>
                                    <span>{{$tree_data[2]['level'][2]->sponsor_id}}</span>
                                </li>

                                <li>
                                    <span>Placement Id</span>
                                    <span>{{$tree_data[2]['level'][2]->virtual_id}}</span>
                                </li>
                                <li>
                                    <span>Date of joining</span>
                                    @php
                                    if($tree_data[2]['level'][2]->entry_time != "Absent"){

                                     $date = $tree_data[2]['level'][2]->entry_time;
                                     }else{
                                        $date = "";
                                     }
                                    $datetime = new DateTime($date); @endphp
                                    <span>{{$datetime->format('Y-m-d')}}</span>
                                </li>
                                <li>
                                    <span>Left ID</span>
                                    <span>{{$tree_data[2]['level'][2]->l_c_count}}</span>
                                </li>
                                <li>
                                    <span>Right ID</span>
                                    <span>{{$tree_data[2]['level'][2]->r_c_count}}</span>
                                </li>
                                <li>
                                    <span>Left Business</span>
                                    <span>{{$tree_data[2]['level'][2]->l_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Business</span>
                                    <span>{{$tree_data[2]['level'][2]->r_bv}}</span>
                                </li>
                                <li>
                                    <span>Left Balance</span>
                                    <span>{{$tree_data[2]['level'][2]->left_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Balance</span>
                                    <span>{{$tree_data[2]['level'][2]->right_bv}}</span>
                                </li>
                                <li>
                                    <span>User Rank</span>
                                    <span>{{$tree_data[2]['level'][2]->rank}}</span>
                                </li>
                                <li>
                                    <span>Buying</span>
                                    <span>{{$tree_data[2]['level'][2]->selftopup}}</span>
                                </li>
                            </ul>
                        </div>
                        </a>
                        <h6>{{$tree_data[2]['level'][2]->user_id}}</h6>
                    </div>
                    <div class="col-6 admintree-4-4">
                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                            <!-- <img src="/admin-assets/images/active.png" />  -->
                            @php
                              $simg13 = $tree_data[2]['level'][3]->image;
                              $treelevelimage13 = asset("images/treeicon/$simg13");
                           @endphp
                        <img class="img-a" src="{{$treelevelimage13}}" width="40" onclick="getMatrixTreeData('{{$tree_data[2]['level'][3]->user_id}}')">
                            <div class="adminTree-tooip-text">
                             <ul>
                                <li>
                                    <span>User Name</span>
                                    <span>{{$tree_data[2]['level'][3]->user_id}}</span>
                                </li>
                                <li>
                                    <span>Full Name</span>
                                    <span>{{$tree_data[2]['level'][3]->fullname}}</span>
                                </li>
                                <li>
                                    <span>Sponsor Full Name</span>
                                    <span>{{$tree_data[2]['level'][3]->sponsor_fullname}}</span>
                                </li>
                                 <li>
                                    <span>Sponsor Username</span>
                                    <span>{{$tree_data[2]['level'][3]->sponsor_id}}</span>
                                </li>

                                <li>
                                    <span>Placement Id</span>
                                    <span>{{$tree_data[2]['level'][3]->virtual_id}}</span>
                                </li>
                                <li>
                                    <span>Date of joining</span>
                                    @php
                                    if($tree_data[2]['level'][3]->entry_time != "Absent"){

                                     $date = $tree_data[2]['level'][3]->entry_time;
                                     }else{
                                        $date = "";
                                     }
                                    $datetime = new DateTime($date); @endphp
                                    <span>{{$datetime->format('Y-m-d')}}</span>
                                </li>
                                <li>
                                    <span>Left ID</span>
                                    <span>{{$tree_data[2]['level'][3]->l_c_count}}</span>
                                </li>
                                <li>
                                    <span>Right ID</span>
                                    <span>{{$tree_data[2]['level'][3]->r_c_count}}</span>
                                </li>
                                <li>
                                    <span>Left Business</span>
                                    <span>{{$tree_data[2]['level'][3]->l_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Business</span>
                                    <span>{{$tree_data[2]['level'][3]->r_bv}}</span>
                                </li>
                                <li>
                                    <span>Left Balance</span>
                                    <span>{{$tree_data[2]['level'][3]->left_bv}}</span>
                                </li>
                                <li>
                                    <span>Right Balance</span>
                                    <span>{{$tree_data[2]['level'][3]->right_bv}}</span>
                                </li>
                                <li>
                                    <span>User Rank</span>
                                    <span>{{$tree_data[2]['level'][3]->rank}}</span>
                                </li>
                                <li>
                                    <span>Buying</span>
                                    <span>{{$tree_data[2]['level'][3]->selftopup}}</span>
                                </li>
                            </ul>
                        </div>
                        </a>
                          <h6>{{$tree_data[2]['level'][3]->user_id}}</h6>
                    </div>
                </div>
            </div>

                <div class="col-3">
                    <div class="row admin-midline AdminVHline">
                        <div class="col-6 admintree-4-5">
                            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                                <!-- <img src="/admin-assets/images/active.png" /> -->
                                @php
                                  $simg12 = $tree_data[2]['level'][4]->image;
                                  $treelevelimage12 = asset("images/treeicon/$simg12");
                               @endphp
                            <img class="img-a" src="{{$treelevelimage12}}" width="40" onclick="getMatrixTreeData('{{$tree_data[2]['level'][4]->user_id}}')">
                                <div class="adminTree-tooip-text">
                                <ul>
                                    <li>
                                        <span>User Name</span>
                                        <span>{{$tree_data[2]['level'][4]->user_id}}</span>
                                    </li>
                                    <li>
                                        <span>Full Name</span>
                                        <span>{{$tree_data[2]['level'][4]->fullname}}</span>
                                    </li>
                                    <li>
                                        <span>Sponsor Full Name</span>
                                        <span>{{$tree_data[2]['level'][4]->sponsor_fullname}}</span>
                                    </li>
                                     <li>
                                        <span>Sponsor Username</span>
                                        <span>{{$tree_data[2]['level'][4]->sponsor_id}}</span>
                                    </li>

                                    <li>
                                        <span>Placement Id</span>
                                        <span>{{$tree_data[2]['level'][4]->virtual_id}}</span>
                                    </li>
                                    <li>
                                        <span>Date of joining</span>
                                        @php
                                        if($tree_data[2]['level'][4]->entry_time != "Absent"){

                                         $date = $tree_data[2]['level'][4]->entry_time;
                                         }else{
                                            $date = "";
                                         }
                                        $datetime = new DateTime($date); @endphp
                                        <span>{{$datetime->format('Y-m-d')}}</span>
                                    </li>
                                    <li>
                                        <span>Left ID</span>
                                        <span>{{$tree_data[2]['level'][4]->l_c_count}}</span>
                                    </li>
                                    <li>
                                        <span>Right ID</span>
                                        <span>{{$tree_data[2]['level'][4]->r_c_count}}</span>
                                    </li>
                                    <li>
                                        <span>Left Business</span>
                                        <span>{{$tree_data[2]['level'][4]->l_bv}}</span>
                                    </li>
                                    <li>
                                        <span>Right Business</span>
                                        <span>{{$tree_data[2]['level'][4]->r_bv}}</span>
                                    </li>
                                    <li>
                                        <span>Left Balance</span>
                                        <span>{{$tree_data[2]['level'][4]->left_bv}}</span>
                                    </li>
                                    <li>
                                        <span>Right Balance</span>
                                        <span>{{$tree_data[2]['level'][4]->right_bv}}</span>
                                    </li>
                                    <li>
                                        <span>User Rank</span>
                                        <span>{{$tree_data[2]['level'][4]->rank}}</span>
                                    </li>
                                    <li>
                                        <span>Buying</span>
                                        <span>{{$tree_data[2]['level'][4]->selftopup}}</span>
                                    </li>
                                </ul>
                            </div>
                            </a>
                            <h6>{{$tree_data[2]['level'][4]->user_id}}</h6>
                        </div>
                        <div class="col-6 admintree-4-6">
                            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                                <!-- <img src="/admin-assets/images/active.png" />  -->
                                @php
                                  $simg13 = $tree_data[2]['level'][5]->image;
                                  $treelevelimage13 = asset("images/treeicon/$simg13");
                               @endphp
                            <img class="img-a" src="{{$treelevelimage13}}" width="40" onclick="getMatrixTreeData('{{$tree_data[2]['level'][5]->user_id}}')">
                                <div class="adminTree-tooip-text">
                                 <ul>
                                    <li>
                                        <span>User Name</span>
                                        <span>{{$tree_data[2]['level'][5]->user_id}}</span>
                                    </li>
                                    <li>
                                        <span>Full Name</span>
                                        <span>{{$tree_data[2]['level'][5]->fullname}}</span>
                                    </li>
                                    <li>
                                        <span>Sponsor Full Name</span>
                                        <span>{{$tree_data[2]['level'][5]->sponsor_fullname}}</span>
                                    </li>
                                     <li>
                                        <span>Sponsor Username</span>
                                        <span>{{$tree_data[2]['level'][5]->sponsor_id}}</span>
                                    </li>

                                    <li>
                                        <span>Placement Id</span>
                                        <span>{{$tree_data[2]['level'][5]->virtual_id}}</span>
                                    </li>
                                    <li>
                                        <span>Date of joining</span>
                                        @php
                                        if($tree_data[2]['level'][5]->entry_time != "Absent"){

                                         $date = $tree_data[2]['level'][5]->entry_time;
                                         }else{
                                            $date = "";
                                         }
                                        $datetime = new DateTime($date); @endphp
                                        <span>{{$datetime->format('Y-m-d')}}</span>
                                    </li>
                                    <li>
                                        <span>Left ID</span>
                                        <span>{{$tree_data[2]['level'][5]->l_c_count}}</span>
                                    </li>
                                    <li>
                                        <span>Right ID</span>
                                        <span>{{$tree_data[2]['level'][5]->r_c_count}}</span>
                                    </li>
                                    <li>
                                        <span>Left Business</span>
                                        <span>{{$tree_data[2]['level'][5]->l_bv}}</span>
                                    </li>
                                    <li>
                                        <span>Right Business</span>
                                        <span>{{$tree_data[2]['level'][5]->r_bv}}</span>
                                    </li>
                                    <li>
                                        <span>Left Balance</span>
                                        <span>{{$tree_data[2]['level'][5]->left_bv}}</span>
                                    </li>
                                    <li>
                                        <span>Right Balance</span>
                                        <span>{{$tree_data[2]['level'][5]->right_bv}}</span>
                                    </li>
                                    <li>
                                        <span>User Rank</span>
                                        <span>{{$tree_data[2]['level'][5]->rank}}</span>
                                    </li>
                                    <li>
                                        <span>Buying</span>
                                        <span>{{$tree_data[2]['level'][5]->selftopup}}</span>
                                    </li>
                                </ul>
                            </div>
                            </a>
                              <h6>{{$tree_data[2]['level'][5]->user_id}}</h6>
                        </div>
                    </div>
                </div>
                    <div class="col-3">
                        <div class="row admin-midline AdminVHline">
                            <div class="col-6 admintree-4-7">
                                <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                                    <!-- <img src="/admin-assets/images/active.png" /> -->
                                    @php
                                      $simg12 = $tree_data[2]['level'][6]->image;
                                      $treelevelimage12 = asset("images/treeicon/$simg12");
                                   @endphp
                                <img class="img-a" src="{{$treelevelimage12}}" width="40" onclick="getMatrixTreeData('{{$tree_data[2]['level'][6]->user_id}}')">
                                    <div class="adminTree-tooip-text">
                                    <ul>
                                        <li>
                                            <span>User Name</span>
                                            <span>{{$tree_data[2]['level'][6]->user_id}}</span>
                                        </li>
                                        <li>
                                            <span>Full Name</span>
                                            <span>{{$tree_data[2]['level'][6]->fullname}}</span>
                                        </li>
                                        <li>
                                            <span>Sponsor Full Name</span>
                                            <span>{{$tree_data[2]['level'][6]->sponsor_fullname}}</span>
                                        </li>
                                         <li>
                                            <span>Sponsor Username</span>
                                            <span>{{$tree_data[2]['level'][6]->sponsor_id}}</span>
                                        </li>

                                        <li>
                                            <span>Placement Id</span>
                                            <span>{{$tree_data[2]['level'][6]->virtual_id}}</span>
                                        </li>
                                        <li>
                                            <span>Date of joining</span>
                                            @php
                                            if($tree_data[2]['level'][6]->entry_time != "Absent"){

                                             $date = $tree_data[2]['level'][6]->entry_time;
                                             }else{
                                                $date = "";
                                             }
                                            $datetime = new DateTime($date); @endphp
                                            <span>{{$datetime->format('Y-m-d')}}</span>
                                        </li>
                                        <li>
                                            <span>Left ID</span>
                                            <span>{{$tree_data[2]['level'][6]->l_c_count}}</span>
                                        </li>
                                        <li>
                                            <span>Right ID</span>
                                            <span>{{$tree_data[2]['level'][6]->r_c_count}}</span>
                                        </li>
                                        <li>
                                            <span>Left Business</span>
                                            <span>{{$tree_data[2]['level'][6]->l_bv}}</span>
                                        </li>
                                        <li>
                                            <span>Right Business</span>
                                            <span>{{$tree_data[2]['level'][6]->r_bv}}</span>
                                        </li>
                                        <li>
                                            <span>Left Balance</span>
                                            <span>{{$tree_data[2]['level'][6]->left_bv}}</span>
                                        </li>
                                        <li>
                                            <span>Right Balance</span>
                                            <span>{{$tree_data[2]['level'][6]->right_bv}}</span>
                                        </li>
                                        <li>
                                            <span>User Rank</span>
                                            <span>{{$tree_data[2]['level'][6]->rank}}</span>
                                        </li>
                                        <li>
                                            <span>Buying</span>
                                            <span>{{$tree_data[2]['level'][6]->selftopup}}</span>
                                        </li>
                                    </ul>
                                </div>
                                </a>
                                <h6>{{$tree_data[2]['level'][6]->user_id}}</h6>
                            </div>
                            <div class="col-6 admintree-4-8">
                                <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" id="myTooltip1" class="mytooltip">
                                    <!-- <img src="/admin-assets/images/active.png" />  -->
                                    @php
                                      $simg13 = $tree_data[2]['level'][7]->image;
                                      $treelevelimage13 = asset("images/treeicon/$simg13");
                                   @endphp
                                <img class="img-a" src="{{$treelevelimage13}}" width="40" onclick="getMatrixTreeData('{{$tree_data[2]['level'][7]->user_id}}')">
                                    <div class="adminTree-tooip-text">
                                     <ul>
                                        <li>
                                            <span>User Name</span>
                                            <span>{{$tree_data[2]['level'][7]->user_id}}</span>
                                        </li>
                                        <li>
                                            <span>Full Name</span>
                                            <span>{{$tree_data[2]['level'][7]->fullname}}</span>
                                        </li>
                                        <li>
                                            <span>Sponsor Full Name</span>
                                            <span>{{$tree_data[2]['level'][7]->sponsor_fullname}}</span>
                                        </li>
                                         <li>
                                            <span>Sponsor Username</span>
                                            <span>{{$tree_data[2]['level'][7]->sponsor_id}}</span>
                                        </li>

                                        <li>
                                            <span>Placement Id</span>
                                            <span>{{$tree_data[2]['level'][7]->virtual_id}}</span>
                                        </li>
                                        <li>
                                            <span>Date of joining</span>
                                            @php
                                            if($tree_data[2]['level'][7]->entry_time != "Absent"){

                                             $date = $tree_data[2]['level'][7]->entry_time;
                                             }else{
                                                $date = "";
                                             }
                                            $datetime = new DateTime($date); @endphp
                                            <span>{{$datetime->format('Y-m-d')}}</span>
                                        </li>
                                        <li>
                                            <span>Left ID</span>
                                            <span>{{$tree_data[2]['level'][7]->l_c_count}}</span>
                                        </li>
                                        <li>
                                            <span>Right ID</span>
                                            <span>{{$tree_data[2]['level'][7]->r_c_count}}</span>
                                        </li>
                                        <li>
                                            <span>Left Business</span>
                                            <span>{{$tree_data[2]['level'][7]->l_bv}}</span>
                                        </li>
                                        <li>
                                            <span>Right Business</span>
                                            <span>{{$tree_data[2]['level'][7]->r_bv}}</span>
                                        </li>
                                        <li>
                                            <span>Left Balance</span>
                                            <span>{{$tree_data[2]['level'][7]->left_bv}}</span>
                                        </li>
                                        <li>
                                            <span>Right Balance</span>
                                            <span>{{$tree_data[2]['level'][7]->right_bv}}</span>
                                        </li>
                                        <li>
                                            <span>User Rank</span>
                                            <span>{{$tree_data[2]['level'][7]->rank}}</span>
                                        </li>
                                        <li>
                                            <span>Buying</span>
                                            <span>{{$tree_data[2]['level'][7]->selftopup}}</span>
                                        </li>
                                    </ul>
                                </div>
                                </a>
                                  <h6>{{$tree_data[2]['level'][7]->user_id}}</h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>

function myFunctionRefLeft(leftId,leftCopy) {
      var copyText = document.getElementById(leftId);
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
        var url =  '{{ url('1Rto5efWp86Z/user/tree-view') }}';
        var form = $('<form action="' + url + '" method="post">' +
          '<input type="text" name="id" value="' + userid + '" />' 
          + '{{ csrf_field() }}'  +
          '</form>');
        $('body').append(form);
        form.submit();
    }
  
}

    function onBackClick(userid)
    {
        var authId = ('{{Auth::user()->user_id}}');
        if(userid == authId)
        {
            return false;
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
        getMatrixTreeData(userid);
  }


  function checkUserExistedSearch(){
      var user_id = $('#searchuserid').val();
      $.ajax({
            type:'POST',
            url:"{{url('/checkuserexist/crossleg')}}",
            data:{user_id:user_id, '_token': '{{ csrf_token() }}'},
            success:function(response){
                if(response.code == '200'){
                    toastr.success(response.message);
                    $('#btnsearch').prop('disabled', false)
                }
                else{
                    $('#btnsearch').prop('disabled', true)
                }
            }
      });

        
      }



</script>
  @endsection
