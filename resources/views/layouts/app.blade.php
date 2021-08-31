<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no{{(request()->is('backend/*')) ? ', maximum-scale=1.0, user-scalable=0' : ''}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/icon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/icon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/icon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/icon/site.webmanifest')}}">
    <!-- Fonts-awesome -->
    <link href="{{asset('fontawesome/css/all.min.css')}}" rel="stylesheet">
    <!-- Google Fonts Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    @if (request()->is('backend/*'))
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
        <link href="{{asset('css/backend/material-dashboard.css?v=2.1.0')}}" rel="stylesheet">
    @else
        <!-- Main CSS -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="{{asset('css/front/mdb.min.css')}}" rel="stylesheet">
    @endif
    <!-- DataTables CSS -->
    <link href="{{ asset('css/front/addons/datatables.min.css') }}" rel="stylesheet">
    <!-- DataTables Select CSS -->
    <link href="{{ asset('css/front/addons/datatables-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front/addons/rating.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/croppie.css') }}" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    @if (!request()->is('backend/*'))
        <style type="text/css">
            html,
            body,
            header,
            .carousel {
                height: 60vh;
            }

            @media (max-width: 500px) {
                html,
                body,
                header,
                .carousel {
                    height: 30vh;
                }
            }
            
            .mlstl>a {
            color: #fff;
            }

            .view {
            position: relative;
            overflow: hidden;
            cursor: default; }
            .view .mask {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
                background-attachment: fixed; }
            .view img, .view video {
                position: relative;
                display: block; }
            .view video.video-intro {
                top: 50%;
                left: 50%;
                z-index: -100;
                width: auto;
                min-width: 100%;
                height: auto;
                min-height: 100%;
                transition: 1s opacity;
                transform: translateX(-50%) translateY(-50%); }

            .overlay .mask {
            opacity: 0;
            transition: all 0.4s ease-in-out; }
            .overlay .mask:hover {
                opacity: 1; }
        </style>
    @endif
    <style type="text/css">
        /* Logo */
        @import url('https://fonts.googleapis.com/css2?family=Dr+Sugiyama&display=swap');
        .logo {
            font-family: 'Dr Sugiyama', cursive !important;
        }
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        /* Image upload style */
        .img_div {
            position: relative;
            border-radius:50%;
            overflow:hidden;
        }

        .image {
            display: block;
            width: 100%;
            height: auto;
        }

        .overlay_img {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #fff;
            opacity: 0.75;
            overflow: hidden;
            width: 100%;
            height: 0;
            transition: .5s ease;
        }

        .img_div:hover .overlay_img {
            height: 30%;
        }

        .text {
            position: absolute;
            top: 45%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <!-- alert start -->
    @if (session('flush-alert'))
        <div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
            <div class="modal-dialog modal-notify" role="document">
                <!--Content-->
                    <div class="modal-content pr-0 bg-{{ session('flush-alert')[0] }}">
                        <!--Header-->
                        <div class="modal-body d-flex justify-content-between align-items-center pr-0 py-2">
                            <p class="h5 text-white mb-0">{{ session('flush-alert')[1] }}</p>
                            <button type="button" class="close text-white px-3 py-2 ml-4" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                <!--/.Content-->
            </div>
        </div>
    @endif
    @if(request()->get('status'))
        <!-- Success-->
        {{-- <div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
            <div class="modal-dialog modal-dialog-centered modal-sm modal-notify modal-success" role="document">
                <div class="modal-content text-center grey lighten-3" id="modal_corner">
                    <div class="modal-body">
                        <div class="mb-3">
                            <i class="fas fa-check-circle fa-7x light-green-text animated rotateIn"></i>
                        </div>
                        <p class="h4">Transaction Successful!</p>
                        <p class="font-weight-normal">Transaction ID: NOK5fd0ba2511006</p>

                        <hr id="hr_style_1">
                        
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold">Amount Paid: </span>
                            <span class="font-weight-normal">$100</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold">Platform: </span>
                            <span class="font-weight-normal">bKash</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Failed-->
        {{-- <div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
            <div class="modal-dialog modal-dialog-centered modal-sm modal-notify modal-danger" role="document">
                <div class="modal-content text-center grey lighten-3" id="modal_corner">
                    <div class="modal-body py-5">
                        <div class="mb-3">
                            <i class="fas fa-times-circle fa-7x text-danger animated rotateIn"></i>
                        </div>
                        <p class="h4">Transaction Failed!</p>
                    </div>
                </div>
            </div>
        </div> --}}
    @endif
    <!-- alert end -->
    @if (request()->is('backend/*'))
        <div id="app" class="dark-edition wrapper">
            @include('layouts.back.sidebar')
            <main class="main-panel">
                @include('layouts.back.navbar')
                @yield('content')
                @include('layouts.back.footer')
            </main>
        </div>
    @else
        <div id="app" class="special-color-dark text-light">
            @include('layouts.front.navbar')
            <main class="mt-5">
                @yield('content')
            </main>
            @include('layouts.front.footer')
        </div>
    @endif

    @if (request()->is('backend/*'))
        <script src="{{asset('js/backend/core/jquery.min.js')}}"></script>
        <script src="{{asset('js/backend/core/popper.min.js')}}"></script>
        <script src="{{asset('js/backend/core/bootstrap-material-design.min.js')}}"></script>
        <script src="https://unpkg.com/default-passive-events"></script>
        <script src="{{asset('js/backend/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
        <!-- Chartist JS -->
        <script src="{{asset('js/backend/plugins/chartist.min.js')}}"></script>
        <!--  Notifications Plugin    -->
        <script src="{{asset('js/backend/plugins/bootstrap-notify.js')}}"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="{{asset('js/backend/material-dashboard.js')}}"></script>
        <script src="{{ asset('js/addons/datatables.min.js') }}"></script>
        <script src="{{ asset('js/addons/datatables-select.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $().ready(function() {
                $sidebar = $('.sidebar');

                $sidebar_img_container = $sidebar.find('.sidebar-background');

                $full_page = $('.full-page');

                $sidebar_responsive = $('body > .navbar-collapse');

                window_width = $(window).width();

                // $(document).ready(function () {
                //     md.showNotification('top','center')
                // });

                $('.fixed-plugin a').click(function(event) {
                    // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                    if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else if (window.event) {
                            window.event.cancelBubble = true;
                        }
                    }
                });

                $('.fixed-plugin .active-color span').click(function() {
                    $full_page_background = $('.full-page-background');

                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('color');

                    if ($sidebar.length != 0) {
                    $sidebar.attr('data-color', new_color);
                    }

                    if ($full_page.length != 0) {
                    $full_page.attr('filter-color', new_color);
                    }

                    if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data-color', new_color);
                    }
                });

                $('.fixed-plugin .background-color .badge').click(function() {
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('background-color');

                    if ($sidebar.length != 0) {
                    $sidebar.attr('data-background-color', new_color);
                    }
                });

                $('.fixed-plugin .img-holder').click(function() {
                    $full_page_background = $('.full-page-background');

                    $(this).parent('li').siblings().removeClass('active');
                    $(this).parent('li').addClass('active');


                    var new_image = $(this).find("img").attr('src');

                    if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    $sidebar_img_container.fadeOut('fast', function() {
                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $sidebar_img_container.fadeIn('fast');
                    });
                    }

                    if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $full_page_background.fadeOut('fast', function() {
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                        $full_page_background.fadeIn('fast');
                    });
                    }

                    if ($('.switch-sidebar-image input:checked').length == 0) {
                    var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                    }

                    if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                    }
                });

                $('.switch-sidebar-image input').change(function() {
                    $full_page_background = $('.full-page-background');

                    $input = $(this);

                    if ($input.is(':checked')) {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar_img_container.fadeIn('fast');
                        $sidebar.attr('data-image', '#');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page_background.fadeIn('fast');
                        $full_page.attr('data-image', '#');
                    }

                    background_image = true;
                    } else {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar.removeAttr('data-image');
                        $sidebar_img_container.fadeOut('fast');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page.removeAttr('data-image', '#');
                        $full_page_background.fadeOut('fast');
                    }

                    background_image = false;
                    }
                });

                $('.switch-sidebar-mini input').change(function() {
                    $body = $('body');

                    $input = $(this);

                    if (md.misc.sidebar_mini_active == true) {
                    $('body').removeClass('sidebar-mini');
                    md.misc.sidebar_mini_active = false;

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                    } else {

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                    setTimeout(function() {
                        $('body').addClass('sidebar-mini');

                        md.misc.sidebar_mini_active = true;
                    }, 300);
                    }

                    // we simulate the window Resize so the charts will get updated in realtime.
                    var simulateWindowResize = setInterval(function() {
                    window.dispatchEvent(new Event('resize'));
                    }, 180);

                    // we stop the simulation of Window Resize after the animations are completed
                    setTimeout(function() {
                    clearInterval(simulateWindowResize);
                    }, 1000);

                });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                // Javascript method's body can be found in assets/js/demos.js
                md.initDashboardPageCharts();
            });

            // Send request
            $(document).ready(function () {
                $("#promo_discount_type-1").click(function () {
                    $("#promo_type_cash").removeClass('d-none');
                    $("#promo_search_result,#promo_service").prop('required',false);
                    if (!$("#promo_type_item").hasClass('d-none')) {
                        $("#promo_type_item").addClass('d-none');
                    }
                });
                $("#promo_discount_type-2").click(function () {
                    $("#promo_type_item").removeClass('d-none');
                    $("#promo_search_result,#promo_service").prop('required',true);
                    if (!$("#promo_type_cash").hasClass('d-none')) {
                        $("#promo_type_cash").addClass('d-none');
                    }
                });
            });
            $(document).ready(function () {
                $("#promo_search").keyup(function (e) {
                    e.preventDefault();
                    var searchVal = $(this).val();
                    if (searchVal.length > 0) {
                        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')}});
                        $.ajax({
                            url: "{{route('search_talent')}}",
                            method: "POST",
                            data: {searchVal: searchVal},
                            success: function (result) {
                                $("#promo_search_result").empty();
                                if ($("#promo_search_result").hasClass('d-none')) {
                                    $("#promo_search_result").removeClass('d-none');
                                }
                                if (result.length > 5) {
                                    $("#promo_search_result").attr("size", 5);
                                } else {
                                    $("#promo_search_result").attr("size", result.length);
                                }
                                result.forEach(element => {
                                    $("#promo_search_result").append('<option class="py-1" value="'+ element.id +','+ element.name +','+ element.avatar +'">'+ element.name +'</option>');
                                });
                            }
                        });
                    } else {
                        $("#promo_search_result").addClass('d-none');
                    }
                });
            });
            $(document).ready(function () {
                $("#promo_search_add").click(function () {
                    var promo_searchId = $("#promo_search_result").val();
                    var promo_serviceType = $("#promo_service").val();
                    if (promo_searchId && promo_serviceType) {
                        var promo_searchChank = promo_searchId.split(',');
                        var promo_searchAvatar = 'images/avatar.png';
                        if (promo_searchChank[2] != 'null') {
                            promo_searchAvatar = 'storage/content/avatar/'+ promo_searchChank[2];
                        }
                        $("#promo_search_select").append(`
                            <span class="badge badge-pill badge-secondary text-capitalize h6 m-1 p-0" id="${promo_searchChank[0] + promo_serviceType}">
                                <img class="img-fluid rounded-circle mr-1" src="{{asset('${promo_searchAvatar}')}}" alt="avatar" width="35" height="35">
                                ${promo_searchChank[1]}<a href="#" class="px-3" onclick="parentElement.remove();"><i class="fas fa-times"></i></a>
                            </span>
                        `);
                    }
                });
            });

            $(document).ready(function () {
                $("#promo_typeItem_submit").click(function () {
                    var parentDiv = [];
                    $("#promo_search_select > span").each((index, elem) => {
                        parentDiv.push(elem.id);
                    });
                    parentDiv = parentDiv.toString();
                    $('#promo_typename').val(parentDiv);
                });
            });

            $(document).ready(function () {
                $(".featureThis").click(function (e) {
                    e.preventDefault();
                    var uctInfo = $(this).val().split(',');
                    var uId = uctInfo[0];
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')}});
                    $.ajax({
                        url: "{{route('admin.userTalents.featureCategory')}}",
                        method: "POST",
                        data: {uid: uId},
                        success: function (result) {
                            if (result) {
                                $('#featureThis' + uId).val(uId).html('<i class="fas fa-star text-white"></i>');
                            } else {
                                $('#featureThis' + uId).val(uId).html('<i class="far fa-star text-white"></i>');
                            }
                        }
                    });
                });
            });
        </script>
    @else
        <!-- Core Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <!-- MDB core JavaScript -->
        <script src="{{ asset('js/front/mdb.min.js') }}"></script>
        <script src="{{ asset('js/tiny-slider.js') }}"></script>
        <script src="{{ asset('js/placeholderTypewriter.js') }}"></script>
        <!-- Initializations -->
        <script>
            // Animations initialization
            new WOW().init();

            $(document).ready(function() {
                // Login notification
                $('.toast').toast('show');
                
                // Logo animation
                $('.navbar-brand').mouseover(
                    function(){$(this).children().addClass('animated flipInX slow')},
                );
                $('.navbar-brand').mouseout(
                    function(){$(this).children().removeClass('animated flipInX slow')},
                );

                // Social icon animation
                $('.socialIcon').mouseover(
                    function(){$(this).children('i').addClass('animated bounceIn slow')},
                );
                $('.socialIcon').mouseout(
                    function(){$(this).children('i').removeClass('animated bounceIn slow')},
                );

                // See all animation
                $('.seeAll').mouseover(
                    function(){$(this).children('i').addClass('animated bounceIn slow')},
                );
                $('.seeAll').mouseout(
                    function(){$(this).children('i').removeClass('animated bounceIn slow')},
                );

                // Join us animation
                $('.join').mouseover(
                    function(){$(this).children('i').addClass('animated heartBeat')},
                );
                $('.join').mouseout(
                    function(){$(this).children('i').removeClass('animated heartBeat')},
                );
            });

            // Filter list
            $(document).ready(function () {
                $("#listNotificationSearch").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#myList *").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });

            // Go to top
            $(document).ready(function () {
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 300) {
                        $('#top').fadeIn();
                    } else {
                        $('#top').fadeOut();
                    }
                });
                // scroll body to 0px on click
                $('#top').click(function () {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 600);
                    return false;
                });
            });

            // Animated placeholder
            $('#search').placeholderTypewriter({
                delay: 50,
                pause: 1000,
                text: ["Find favourite talent", "Congratulate friend & family", "Let's celebrate together"],
            });

            $(document).ready(function () {
                $(".categoryType").click(function (e) {
                    e.preventDefault();
                    var ctname = $(this).val();
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')}});
                    $.ajax({
                        url: "{{route('category')}}",
                        method: "POST",
                        data: {ctname: ctname},
                        success: function (result) {
                            var tCards = urlName = tAvatar = mediaSize = '';
                            result.forEach(element => {
                                tAvatar = "{{asset('/')}}" + 'images/no_avatar.png';
                                if (element.avatar) {
                                    tAvatar = "{{asset('/')}}" + 'storage/content/avatar/' + element.avatar;
                                }
                                urlName = "{{url('/')}}" + '/talent-profile/' + element.username;
                                tCards += `<div class="col">
                                                <div class="card unique-color-dark border border-0">
                                                    <div class="view zoom text-center rounded">
                                                        <img class="img_size img-fluid mh-auto" src="${tAvatar}">
                                                        <a href="${urlName}">
                                                            <div class="mask d-flex align-items-end justify-content-end p-2">
                                                                <p class="h6 text-white mb-0">৳ ${element.vid_price}</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="mt-2 px-2">
                                                        <h6 class="text-light font-weight-bold mb-0">${element.name}</h6>
                                                        <p class="text-light mb-0"><small><i>${element.category}</i></small></p>
                                                    </div>
                                                </div>
                                            </div>`;
                            });
                            if (window.matchMedia("(max-width: 576px)").matches) {
                                mediaSize = 3;
                            } else {
                                mediaSize = 7;
                            }
                            $('#category-section').html(`<div class="pb-1"><div class="d-flex justify-content-between align-items-end"><p class="h3 font-width-bolder">${ctname}</p></div><div class="row row-cols-${mediaSize} mb-4">${tCards}</div></div>`);
                        }
                    });
                });
            });
        </script>
        <script>
            tns({container: '#talent_card-newcomer',controls: false,autoplay: false,loop: false,nav: false,edgePadding: 0,responsive: {280: {items: 3.2,slideBy: 2.4,gutter: 13,speed: 400,},500: {items: 7,gutter: 25,}},});
            tns({container: '#talent_card-feature',controls: false,autoplay: false,loop: false,nav: false,edgePadding: 0,responsive: {280: {items: 3.2,slideBy: 2.4,gutter: 13,speed: 400,},500: {items: 7,gutter: 25,}},});
            if($("#talent_card-2").length > 0) {tns({container: '#talent_card-2',controls: false,autoplay: false,loop: false,nav: false,edgePadding: 0,responsive: {280: {items: 3.2,slideBy: 2.4,gutter: 13,speed: 400,},500: {items: 7,gutter: 25,}},});}
            if($("#talent_card-3").length > 0) {tns({container: '#talent_card-3',controls: false,autoplay: false,loop: false,nav: false,edgePadding: 0,responsive: {280: {items: 3.2,slideBy: 2.4,gutter: 13,speed: 400,},500: {items: 7,gutter: 25,}},});}
            if($("#talent_card-4").length > 0) {tns({container: '#talent_card-4',controls: false,autoplay: false,loop: false,nav: false,edgePadding: 0,responsive: {280: {items: 3.2,slideBy: 2.4,gutter: 13,speed: 400,},500: {items: 7,gutter: 25,}},});}
            if($("#talent_card-5").length > 0) {tns({container: '#talent_card-5',controls: false,autoplay: false,loop: false,nav: false,edgePadding: 0,responsive: {280: {items: 3.2,slideBy: 2.4,gutter: 13,speed: 400,},500: {items: 7,gutter: 25,}},});}
            if($("#talent_card-6").length > 0) {tns({container: '#talent_card-6',controls: false,autoplay: false,loop: false,nav: false,edgePadding: 0,responsive: {280: {items: 3.2,slideBy: 2.4,gutter: 13,speed: 400,},500: {items: 7,gutter: 25,}},});}
            if($("#talent_card-7").length > 0) {tns({container: '#talent_card-7',controls: false,autoplay: false,loop: false,nav: false,edgePadding: 0,responsive: {280: {items: 3.2,slideBy: 2.4,gutter: 13,speed: 400,},500: {items: 7,gutter: 25,}},});}
            if($("#talent_card-8").length > 0) {tns({container: '#talent_card-8',controls: false,autoplay: false,loop: false,nav: false,edgePadding: 0,responsive: {280: {items: 3.2,slideBy: 2.4,gutter: 13,speed: 400,},500: {items: 7,gutter: 25,}},});}
            if($("#talent_card-9").length > 0) {tns({container: '#talent_card-9',controls: false,autoplay: false,loop: false,nav: false,edgePadding: 0,responsive: {280: {items: 3.2,slideBy: 2.4,gutter: 13,speed: 400,},500: {items: 7,gutter: 25,}},});}
            var category_chips = tns({container: '#category_chips',controls: false,autoplay: false,autoWidth: true,loop: false,nav: false,swipeAngle: false,edgePadding: 0,});
        </script>
        <script>
            // $(document).ready(function () {
            //     $("#allReviewBtn").click(function (e) {
            //         e.preventDefault();
            //         if ($("#allReviews").hasClass('d-none')) {
            //             $("#allReviews").removeClass('d-none');
            //             var reviewId = $(this).attr('data');
            //             $.ajaxSetup({headers: {'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')}});
            //             $.ajax({
            //                 url: "{{route('reviews')}}",
            //                 method: "POST",
            //                 data: {reviewId: reviewId},
            //                 success: function (result) {
            //                     var rvData = '';
            //                     var rvReview = '';
            //                     var rvRate = '';
            //                     result.forEach(item => {
            //                         rvRate = '';
            //                         if (item.review) {
            //                             rvReview = '<p class="mb-0 mt-2"><i>'+ item.review +'</i></p>';
            //                         }
            //                         for (let index = 0; index < 5; index++) {
            //                             if (item.rate > index) {
            //                                 rvRate += '<i class="fas fa-star yellow-text"></i>';
            //                             } else {
            //                                 rvRate += '<i class="far fa-star yellow-text"></i>';
            //                             }
            //                         }
            //                         rvData += '<div class="special-color-dark rounded-lg mb-2 p-3"><p class="h6 mb-0"><b>'+ item.uname +'</b><span class="float-right">'+ rvRate +'</span></p>'+ rvReview +'</div>';
            //                     });
            //                     $("#allReviewsBody").html(rvData);
            //                     $('#allReviews').modal("show");
            //                 }
            //             });
            //         } else {
            //             $('#allReviews').modal("show");
            //         }
            //     });
            // });
            function viderrorclear() {
                var element = document.getElementById('vidValidation');
                element.classList.remove("text-white","text-danger");
                element.innerText = '';
            }
            function fileSizeValidation() {
                const fi = document.getElementById('video');
                var errorMessage = document.getElementById('vidValidation');
                // Check if any file is selected.
                if (fi.files.length > 0) {
                    for (const i = 0; i <= fi.files.length - 1; i++) {
                        const fsize = fi.files.item(i).size;
                        const file = Math.round((fsize / 1024));
                        // The size of the file.
                        if (file >= 159744) {
                            errorMessage.classList.remove("text-white");
                            errorMessage.classList.add("text-danger");
                            errorMessage.innerText = "* File too Big, please select a file less than 155mb";
                            // alert("File too Big, please select a file less than 150mb");
                        } else if (file < 2048) {
                            errorMessage.classList.remove("text-white");
                            errorMessage.classList.add("text-danger");
                            errorMessage.innerText = "* File too small, please select a file greater than 2mb";
                            // alert("File too small, please select a file greater than 2mb");
                        } else {
                            document.getElementById('upload-intro').submit();
                        }
                    }
                } else {
                    errorMessage.classList.remove("text-white");
                    errorMessage.classList.add("text-danger");
                    errorMessage.innerText = "* Select a video file";
                }
            }
            function modalviderrorclear() {
                var element = document.getElementById('modalvidValidation');
                element.classList.remove("text-white","text-danger");
                element.innerText = '';
                document.getElementById("videoEdit").showModal();
            }
            function modalfileSizeValidation() {
                const fi = document.getElementById('video_update');
                var errorMessage = document.getElementById('modalvidValidation');
                // Check if any file is selected.
                if (fi.files.length > 0) {
                    for (const i = 0; i <= fi.files.length - 1; i++) {
                        const fsize = fi.files.item(i).size;
                        const file = Math.round((fsize / 1024));
                        // The size of the file.
                        if (file >= 159744) {
                            errorMessage.classList.remove("text-white");
                            errorMessage.classList.add("text-danger");
                            errorMessage.innerText = "* File too Big, please select a file less than 155mb";
                            // alert("File too Big, please select a file less than 150mb");
                        } else if (file < 2048) {
                            errorMessage.classList.remove("text-white");
                            errorMessage.classList.add("text-danger");
                            errorMessage.innerText = "* File too small, please select a file greater than 2mb";
                            // alert("File too small, please select a file greater than 2mb");
                        } else {
                            document.getElementById('edit-upload_intro').submit();
                        }
                    }
                } else {
                    errorMessage.classList.remove("text-white");
                    errorMessage.classList.add("text-danger");
                    errorMessage.innerText = "* Select a video file";
                }
                document.getElementById("videoEdit").showModal();
            }
        </script>
    @endif
    <script src="{{ asset('js/front/addons/datatables.min.js') }}"></script>
    <script src="{{ asset('js/front/addons/datatables-select.min.js') }}"></script>
    <script src="{{ asset('js/front/addons/progressBar.min.js') }}"></script>
    <script src="{{ asset('js/front/addons/rating.min.js') }}"></script>
    <script src="{{ asset('js/clipboard.min.js') }}"></script>
    <script src="{{ asset('js/croppie.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        // Clipboard
        new ClipboardJS('.btn');

        // Load Ckeditor
        $('textarea[data-editor="ck"]').each(function(){
            CKEDITOR.replace($(this).attr('id'));
        });
        
        // Popup modal with error
        $(document).ready(function () {
            $(function () {
                var modalId = $(".is-invalid").closest(".modal").attr('id');
                if (modalId) {
                    $('#'+modalId).modal('show');
                }
            })
        });
        
        // Tooltips Initialization
        $(document).ready(function () {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            })
        });

        // Flush message || Transaction message
        @if (session('flush-alert') || request()->get('status'))
            $(document).ready(function () {
                setTimeout(function () {$('#alert').modal("show");}, 500);
                setTimeout(function () {$('#alert').modal("hide");}, 4500);
            });
        @endif
        
        // Datatable
        $(document).ready(function () {
            $('#dtBasicExample-10,#dtBasicExample-11,#dtBasicExample-12,#dtHorizontal,#dtHorizontal-1').DataTable({
                "ordering": false,
                // "scrollX": true,
            });
            $('.dataTables_length').addClass('bs-select');
        });
        
        // Datatable banner scroll
        $(document).ready(function () {
            $('#dt-vertical-scroll-1,#dt-vertical-scroll-2').dataTable({
                "info": false,
                "ordering": false,
                "paging": false,
                "searching": false,
                "fnInitComplete": function () {
                    var myCustomScrollbar = document.querySelector('#dt-vertical-scroll_wrapper .dataTables_scrollBody');
                    var ps = new PerfectScrollbar(myCustomScrollbar);
                },
                "scrollY": 200,
            });
        });

        // Send request
        $(document).ready(function () {
            $("#forElse").click(function () {
                if (!$('#forElse').hasClass('active')) {
                    $('#forElse').addClass('btn-special gcolor active');
                    $('#forMe').removeClass('btn-special gcolor active');
                    $('#forMe').addClass('border border-light bdrthick');
                    $('<div class="md-form mb-4 animated flipInX" id="fromDiv"><input type="text" name="from" id="from" class="form-control form-control-lg bg-dark text-light border-0 rounded-lg" required><label class="text-white" for="from">From</label></div>').insertAfter('#to');
                }
            });
            $("#forMe").click(function () {
                if (!$('#forMe').hasClass('active')) {
                    $('#forMe').addClass('btn-special gcolor active');
                    $('#forElse').removeClass('btn-special gcolor active');
                    $('#forElse').addClass('border border-light bdrthick');
                    $('#fromDiv').remove();
                }
            });
        });

        // Rating Initialization
        $(document).ready(function () {
            $('#rateTalent').click(function () {
                switch (true) {
                    case $('.rate-popover').hasClass('oneStar'):
                        var rateVal = 1;
                        break;
                    case $('.rate-popover').hasClass('twoStars'):
                        rateVal = 2;
                        break;
                    case $('.rate-popover').hasClass('threeStars'):
                        rateVal = 3;
                        break;
                    case $('.rate-popover').hasClass('fourStars'):
                        rateVal = 4;
                        break;
                    default:
                        rateVal = 5;
                        break;
                }
                $('#rateTalentValue').val(rateVal);
            }).mdbRate();
        });
        
        // Image crop
        $(document).ready(function(){
            $image_crop = $('#image_banner_demo').croppie({
                enableExif: true,
                viewport: {
                    width:1126,
                    height:300,
                    type:'rectangle'
                },
                boundary:{
                    width:1200,
                    height:320
                }
            });

            $('#banner').on('change', function(){
                var reader = new FileReader();
                reader.onload = function (event) {
                    $image_crop.croppie('bind', {
                    url: event.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadimageModal').modal('show');
            });

            $('.crop_banner_image').click(function(event){
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response){
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')}});
                    $.ajax({
                        url:"{{route('admin.setting.banner.add')}}",
                        type: 'POST',
                        data: {banner: response},
                        success:function(data){location.reload();}
                    });
                })
            });
        });
        $(document).ready(function(){
            $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width:250,
                    height:250,
                    type:'square'
                },
                boundary:{
                    width:300,
                    height:300
                }
            });

            $('#avatar').on('change', function(){
                var reader = new FileReader();
                reader.onload = function (event) {
                    $image_crop.croppie('bind', {
                    url: event.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadimageModal').modal('show');
            });

            $('.ad_avatar').on('change', function(){
                var uId = $(this).attr('id');
                var reader = new FileReader();
                reader.onload = function (event) {
                    $image_crop.croppie('bind', {
                    url: event.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $(`#seeInfo${uId}`).modal('hide');
                $('#uploadimageModal').find('.admin_crop_image').val(uId);
                $('#uploadimageModal').modal('show');
            });

            $('.crop_image').click(function(event){
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response){
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')}});
                    $.ajax({
                        url:"{{route('user.profile.avatar.update')}}",
                        type: 'POST',
                        data: {avatar: response},
                        success:function(data){location.reload();}
                    });
                })
            });

            $('.adminprofile_crop_image').click(function(event){
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response){
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')}});
                    $.ajax({
                        url:"{{route('admin.profile.avatar.update')}}",
                        type: 'POST',
                        data: {avatar: response},
                        success:function(data){location.reload();}
                    });
                })
            });

            $('.admin_crop_image').click(function(event){
                var uId = $(this).val();
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response){
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')}});
                    $.ajax({
                        url:"{{route('admin.talent_avatar.update')}}",
                        type: 'POST',
                        data: {uid: uId, avatar: response},
                        success:function(data){location.reload();}
                    });
                })
            });
        });
    </script>
</body>

</html>
