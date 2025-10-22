<div class="nav-header">
    <a href="#" class="brand-logo">
        <img src="{{asset('admin-assets/images/logo.png?v1')}}" class="img-fluid d-none d-sm-block">
        <img src="{{asset('admin-assets/images/icon.png?v1')}}" class="img-fluid d-block d-sm-none">
    </a>
    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>

<div class="header-top">
    <div class="header-content">
        <nav class="admin-navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar"></div>
                </div>
                <div class="header-right">
                    <li>
                        <span class="btn btn-light logout" id="logout-btn">Logout</span>
                    </li>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="deznav">
    <div class="deznav-scroll">
        <div id="sidebar-menu" style="overflow: hidden !important">

        </div>
    </div>
</div>
<script>
    var screenWidth = $( window ).width();
    if(screenWidth <= 1400 && screenWidth > 525){
        $(".hamburger").toggleClass("is-active");
        // $('#main-wrapper').toggleClass("menu-toggle");
        // $(".nav-control").on('click', function() {

        //     $('#main-wrapper').toggleClass("menu-toggle");

        // });
    }
    if(screenWidth <= 525 ){
        // $(".hamburger").toggleClass("is-active");
        // $('#main-wrapper').toggleClass("menu-toggle");
        $('#main-wrapper').removeClass("menu-toggle");
        $(".nav-control").on('click', function() {

            $('#main-wrapper').toggleClass("menu-toggle");

        });
    }

    var showMenu = "0";
    var path = window.location.href;
    var lastPart = path.substr(path.indexOf("1Rto5efWp86Z/") + 13);
    $(document).ready(function() {

        var navigationurl = "{{ url('/1Rto5efWp86Z/navigations')}}";
        //var navigationurl = "{{ url('/1Rto5efWp86Z/navigations')}}";

        $.ajax({
            url: navigationurl,
            method: 'GET',
            data: {},
            success: function(resp) {
                var navigations2 = resp.data;
                var $container = $('#sidebar-menu');
                var $navList = $('<ul class="metismenu mm-show" id="menu"></ul>');

                $.each(navigations2, function(index, nav) {
                    var $navItem = $('<li id="nav'+index+'"></li>').addClass('has_sub')/*.addClass('nav-active')*/;
                    var $navLink = $('<a></a>').addClass('waves-effect');
                    {{-- console.log(nav); --}}
                    if (nav.childmenu.length > 0) {
                        // $navLink.attr('href', '');
                    } else {
                        $navLink.attr('href', base_url + '/1Rto5efWp86Z' + '/' + nav.parentmenu.parent_path);
                    }
                    $navItem.attr('onclick', 'toggleNavItemClass(' + index + ')');
                    var $navIcon = $('<i></i>').addClass('fa fa-bars');
                    var $navText = $('<span></span>').text(nav.parentmenu.parent_menu);
                    var $navRight = $('<span></span>').addClass('pull-right');
                    if (nav.childmenu.length > 0) {
                        $navRight.append($('<i></i>').addClass('mdi mdi-chevron-right'));
                    }
                    $navLink.append($navIcon).append($navText).append($navRight);

                    var $subMenu = $('<ul></ul>').addClass('list-unstyled');
                    

                    if (nav.childmenu.length > 0) {
                        $.each(nav.childmenu, function(i, sub_nav) {
                            var $subNavItem = $('<li></li>');
                            var $subNavLink = $('<a></a>').attr('href', base_url + '/1Rto5efWp86Z' + '/' + sub_nav.path).text(sub_nav.menu);

                            if (lastPart === sub_nav.path) {

                                $subNavItem.addClass('active');
                                $navItem.addClass('nav-active');
                            }
                            $subNavItem.append($subNavLink);
                            $subMenu.append($subNavItem);
                        });
                    }
                    $navItem.append($navLink).append($subMenu);
                    $navList.append($navItem);
                });
                $container.append($navList);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });


    function toggleNavItemClass(element) {
        var $navItem = $('#nav' + element);

        if ($navItem.hasClass('nav-active')) {
            $navItem.removeClass('nav-active');
        } else {
            $('.has_sub').not($navItem).removeClass('nav-active');
            $navItem.addClass('nav-active');
        }
    }

</script>
