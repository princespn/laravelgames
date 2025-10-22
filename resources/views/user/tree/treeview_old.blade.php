@extends('layouts.user_type.auth-app')

@section('content')

@php
    $userdata =$arrData['user'];
    $tree_data =$arrData['tree_data'];
    $referrallink = url('/sign-up');
@endphp

<style>
  .dnnn{
    display: none !important;
  }
      ul{
  margin:0;
  padding:0;
  list-style: none;
  position: relative;
}
.wrapper {
  max-width: 800px;
  width: 100%;
  height: 600px;
/*  background-color: #eeeeee;*/
  margin: 0 auto;
  padding: 10px;
  display: flex;
  align-items: center;
}
.wrapper li {
  width: 100px;
  text-align: center;
  position: relative;
}
.wrapper li::before {
  position: absolute;
  content: "";
  width: 100px;
  height: 2px;
  background-color: #333333;
  left: 50%;
  transform: translateX(-50%);
  top: 15px;
}
.circle {
  height: 30px;
  width: 30px;
  display: block;
  background-color: #24244c;
  border-radius: 50%;
  position: relative;
  margin: 0 auto;
  font-size: 12px;
  line-height: 30px;
  cursor:pointer;
}
.children {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  left: 100%;
  height: 300px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.circle.hide-childs + ul.children {
  visibility: hidden;
  opacity: 0;
}
.children.first-child.top-child {
  height: 150px;
}
.children.first-child.bottom-child {
  height: 230px;
}
.children.second-child.bottom-child {
  height: 126px;
}
.children.second-child.top-child {
  height: 30px;
}
.children.third-child.top-child {
  height: 80px;
}
.children.first-child.bottom-child .children.second-child.top-child,
.children.first-child.bottom-child .children.second-child.middle-child {
  height: 30px;
}
.children.first-child.bottom-child .children.second-child.bottom-child{
  height:120px;
}
.children::before {
  position: absolute;
  content: "";
  left: 0;
  width: 2px;
  background-color: #333333;
  top: 15px;
  bottom: 15px;
}
.wrapper .last-child li::before,
.wrapper li.hide-node::before {
  width: 50px;
  left: 0;
  transform: translateX(0);
}
.red{
  background-color: #24244c;
}
.green{
  background-color: #24244c;
}
.purple{
  background-color: #24244c;
}
.yellow{
  background-color: #24244c;
}
.brown{
  background-color:#24244c;
}
.hide-node::after {
  position: absolute;
  content: "+";
  font-size: 12px;
  top: -14px;
  left: 0;
  right: 0;
}
.last-child .hide-node::after {
  content: "";
}
.circle:active {
  transform: scale(0.9);
}
</style>

    <div class="page-wrapper overflow-auto-mobile">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="PageTitle">
                        <h1>Tree View</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="wrapper">
                    <ul class="parent">
                        <li>
                            <span class="circle green">20</span>
                            <ul class="children first-child">
                                <li>
                                    <span class="circle red">10</span>
                                    <ul class="children first-child top-child">
                                        <li>
                                            <span class="circle brown">6</span>
                                            <ul class="children second-child top-child">
                                                <li>
                                                    <span class="circle">14</span>
                                                    <ul class="children third-child top-child last-child">
                                                        <li>
                                                            <span class="circle red">11</span>
                                                        </li>
                                                        <li>
                                                            <span class="circle yellow">1</span>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <span class="circle purple">13</span>
                                            <ul class="children second-child bottom-child last-child">
                                                <li>
                                                   <span class="circle red">2</span>
                                                </li>
                                                <li>
                                                   <span class="circle green">5</span>
                                                </li>
                                                <li>
                                                   <span class="circle purple">19</span>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>            
                                <li>
                                   <span class="circle yellow">0</span>
                                   <ul class="children first-child bottom-child">
                                      <li>
                                         <span class="circle red">9</span>
                                         <ul class="children second-child top-child last-child">
                                            <li>
                                               <span class="circle">15</span>
                                            </li>
                                         </ul>
                                      </li>
                                      <li>
                                         <span class="circle">16</span>
                                         <ul class="children second-child middle-child last-child">
                                            <li>
                                               <span class="circle purple">7</span>
                                            </li>
                                         </ul>
                                      </li>
                                      <li>
                                         <span class="circle purple">4</span>
                                         <ul class="children second-child bottom-child last-child">
                                            <li>
                                               <span class="circle red">8</span>
                                            </li>
                                            <li>
                                               <span class="circle green">17</span>
                                            </li>
                                            <li>
                                               <span class="circle brown">20</span>
                                            </li>
                                         </ul>
                                      </li>
                                   </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<!-- end main content-->

<script type="text/javascript">
  jQuery(document).ready(function($) {
      $('.circle').on('click',function(){
        $(this).toggleClass('hide-childs');
        $(this).parent('li').toggleClass('hide-node');
      });
    });
</script>
<script>


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


    

</script>
  @endsection
