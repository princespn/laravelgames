@extends('layouts.user_type.auth-app')

@section('content')

@php
    $userdata =$arrData['user'];
    $tree_data =$arrData['tree_data'];
    $referrallink = url('/sign-up');
@endphp

<style>
  .wrapper {
    overflow: auto;
}
.wrapper {
  max-width: 800px;
  width: 100%;
  height: 100vh;
  /*  background-color: #eeeeee;*/
  margin: 0 auto;
  padding: 10px;
  display: flex;
  align-items: center;
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
                <div class="wrapper" id="userHierarchy">
                    <ul class="parent">
                        <li>
                            <span class="circle" data-user-id="{{Auth::user()->id}}">{{Auth::user()->user_id}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<!-- end main content-->

{{-- <script type="text/javascript">
  jQuery(document).ready(function($) {
      $('.circle').on('click',function(){
        $(this).toggleClass('hide-childs');
        $(this).parent('li').toggleClass('hide-node');
      });
    });
</script> --}}
<script>
$(document).ready(function() {
    $('#userHierarchy').on('click', '.circle', function() {
        var userId = $(this).data('user-id'); 
        var parentElement = $(this).parent(); 

        var childrenElement = parentElement.children('.children');

        if (childrenElement.is(':visible')) {
            childrenElement.hide();
        } else {            
            if (!childrenElement.is(':visible')) {
                // childrenElement.show();
                loadUserHierarchy(userId, parentElement);
                
                var rowElement = parentElement.parent();
                rowElement.find('.children:visible').not(childrenElement).hide();
            }
        }
    });

    function loadUserHierarchy(userId, parentElement) {
        $.ajax({
            url: "{{ url('/level-view/') }}/" + userId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.code === 200) {
                    var userHierarchy = generateUserHierarchy(response.data);
                    parentElement.append(userHierarchy);
                } else {
                }
            },
            error: function(error) {
                console.error('Error loading user hierarchy:', error);
            }
        });
    }

    function generateUserHierarchy(data) {
        var hierarchyHTML = '<ul class="children">';
        
        for (var i = 0; i < data.length; i++) {
            var item = data[i];
            
            hierarchyHTML += '<li>';
            hierarchyHTML += '<span class="circle" data-user-id='+ item.id +'>' + item.user_id + '</span>';
            
            if (item.children && item.children.length > 0) {
                hierarchyHTML += generateUserHierarchy(item.children);
            }
            
            hierarchyHTML += '</li>';
        }

        hierarchyHTML += '</ul>';
        return hierarchyHTML;
    }

});



</script>
  @endsection
