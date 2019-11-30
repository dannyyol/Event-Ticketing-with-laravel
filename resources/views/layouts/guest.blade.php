<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="/img/fav-icon.png" type="image/x-icon" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Persuit</title>
        

        <!-- Icon css link -->
        <link href="/css/font-awesome.min.css" rel="stylesheet">
        <link href="/vendors/line-icon/css/simple-line-icons.css" rel="stylesheet">
        <link href="/vendors/elegant-icon/style.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Rev slider css -->
        <link href="/vendors/revolution/css/settings.css" rel="stylesheet">
        <link href="/vendors/revolution/css/layers.css" rel="stylesheet">
        <link href="/vendors/revolution/css/navigation.css" rel="stylesheet">
        
        <!-- Extra plugin css -->
        <link href="/vendors/owl-carousel/owl.carousel.min.css" rel="stylesheet">
        <link href="/vendors/bootstrap-selector/css/bootstrap-select.min.css" rel="stylesheet">
        <link href="/vendors/vertical-slider/css/jQuery.verticalCarousel.css" rel="stylesheet">
        
        <link href="{{asset("css/style.css")}}" rel="stylesheet">
        <link href="{{ asset('css/responsive.css')}}" rel="stylesheet">
        @include('partials.guest.head')

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="home_sidebar">
        
        
        <div class="home_box">
           
            <!--================Menu Area =================-->
            <header class="shop_header_area carousel_menu_area">
                <div class="carousel_top_header black_top_header row m0">
                    <div class="container">
                        <div class="carousel_top_h_inner">
                            <div class="float-md-right">
                                <div class="top_header_left">
                                    <!-- <div class="selector">
                                        <select class="language_drop" name="countries" id="countries" style="width:300px;">
                                          <option value='yt' data-image="img/icon/flag-1.png" data-imagecss="flag yt" data-title="English">English</option>
                                          <option value='yu' data-image="img/icon/flag-1.png" data-imagecss="flag yu" data-title="Bangladesh">Bangla</option>
                                          <option value='yt' data-image="img/icon/flag-1.png" data-imagecss="flag yt" data-title="English">English</option>
                                          <option value='yu' data-image="img/icon/flag-1.png" data-imagecss="flag yu" data-title="Bangladesh">Bangla</option>
                                        </select>
                                    </div> -->
                                    <!--  -->
                                </div>
                            </div>
                            <div class="float-md-right">

                                @auth
                                <ul class="account_list">
                                        <li class="nav-item dropdown submenu">
                                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform: capitalize;">
                                            {{auth()->user()->name}}
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="nav-link">
                                                    <a href="#logout" onclick="$('#logout').submit();">
                                                        @lang('quickadmin.qa_logout')
                                                    </a>
                                                    
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                    {!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
                                    <button type="submit">@lang('quickadmin.logout')</button>
                                    {!! Form::close() !!}
                                @endauth
                                
                                @guest
                                <ul class="account_list">
                                    <li><a href="{{route("auth.login")}}">Log In</a></li>
                                </ul>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel_menu_inner">
                    <div class="container">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <a class="navbar-brand" href="/"><img src="/images/logo.png" alt=""></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>

                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item dropdown submenu active">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Home
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown submenu">
                                    <a class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Contact <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="mailto:hello@iclassticket.com">hello@iclassticket.com</a></li>
                                        </ul>
                                    </li>
                                    
                                    <li class="nav-item"><a class="nav-link" href="{{ route('guest.contact')}}">Contact Us</a></li>
                                </ul>
                                @auth
                                <ul class="navbar-nav justify-content-end">
                                    <li class="user_icon"><a href="#"><i class="icon-user icons"></i></a></li>
                                    <!-- <li class="cart_cart"><a href="#"><i class="icon-handbag icons"></i></a></li> -->
                                </ul>
                                @endauth
                            </div>
                        </nav>
                    </div>
                </div>
            </header>
            <!--================End Menu Area =================-->
            @yield('content')
                        
            <!--================World Wide Service Area =================-->
            <section class="world_service">
                <div class="container">
                    <div class="world_service_inner">
                        
                    </div>
                </div>
            </section>
            <!--================End World Wide Service Area =================-->
            
            
            <!--================Footer Area =================-->
            <footer class="footer_area border_none">
                <div class="container">
                    <div class="footer_widgets">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-6">
                                <aside class="f_widget f_about_widget">
                                    <img src="img/logo.png" alt="">
                                    <p>Persuit is a Premium PSD Template. Best choice for your online store. Let purchase it to enjoy now</p>
                                    <h6>Social:</h6>
                                    <ul>
                                        <li><a href="#"><i class="social_facebook"></i></a></li>
                                        <li><a href="#"><i class="social_twitter"></i></a></li>
                                        <li><a href="#"><i class="social_pinterest"></i></a></li>
                                        <li><a href="#"><i class="social_instagram"></i></a></li>
                                        <li><a href="#"><i class="social_youtube"></i></a></li>
                                    </ul>
                                </aside>
                            </div>
                            <div class="col-lg-2 col-md-4 col-6">
                                <aside class="f_widget link_widget f_info_widget">
                                    <div class="f_w_title">
                                        <h3>Information</h3>
                                    </div>
                                    <ul>
                                        <li><a href="#">About us</a></li>
                                        <li><a href="#">Delivery information</a></li>
                                        <li><a href="#">Terms & Conditions</a></li>
                                        <li><a href="#">Help Center</a></li>
                                        <li><a href="#">Returns & Refunds</a></li>
                                    </ul>
                                </aside>
                            </div>
                            <div class="col-lg-2 col-md-4 col-6">
                                <aside class="f_widget link_widget f_service_widget">
                                    <div class="f_w_title">
                                        <h3>Customer Service</h3>
                                    </div>
                                    <ul>
                                        <li><a href="#">My account</a></li>
                                        <li><a href="#">Ordr History</a></li>
                                        <li><a href="#">Wish List</a></li>
                                        <li><a href="#">Newsletter</a></li>
                                        <li><a href="#">Contact Us</a></li>
                                    </ul>
                                </aside>
                            </div>
                            <div class="col-lg-2 col-md-4 col-6">
                                <aside class="f_widget link_widget f_extra_widget">
                                    <div class="f_w_title">
                                        <h3>Extras</h3>
                                    </div>
                                    <ul>
                                        <li><a href="#">Brands</a></li>
                                        <li><a href="#">Gift Vouchers</a></li>
                                        <li><a href="#">Affiliates</a></li>
                                        <li><a href="#">Specials</a></li>
                                    </ul>
                                </aside>
                            </div>
                            <div class="col-lg-2 col-md-4 col-6">
                                <aside class="f_widget link_widget f_account_widget">
                                    <div class="f_w_title">
                                        <h3>My Account</h3>
                                    </div>
                                    <ul>
                                        <li><a href="#">My account</a></li>
                                        <li><a href="#">Ordr History</a></li>
                                        <li><a href="#">Wish List</a></li>
                                        <li><a href="#">Newsletter</a></li>
                                    </ul>
                                </aside>
                            </div>
                        </div>
                    </div>
                    <div class="footer_copyright">
                        <h5>© <script>document.write(new Date().getFullYear());</script> <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This website is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="" target="_blank">KingZTech</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</h5>
                    </div>
                </div>
            </footer>
            <!--================End Footer Area =================-->
        
        </div>
        
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <!-- Rev slider js -->
        <script src="/vendors/revolution/js/jquery.themepunch.tools.min.js"></script>
        <script src="/vendors/revolution/js/jquery.themepunch.revolution.min.js"></script>
        <script src="/vendors/revolution/js/extensions/revolution.extension.actions.min.js"></script>
        <script src="/vendors/revolution/js/extensions/revolution.extension.video.min.js"></script>
        <script src="/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script src="/vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script src="/vendors/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
        <script src="/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <!-- Extra plugin css -->
        <script src="{{asset('vendors/counterup/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset("vendors/counterup/jquery.counterup.min.js")}}"></script>
        <script src="{{asset('vendors/owl-carousel/owl.carousel.min.js')}}"></script>
        <script src="{{asset('vendors/bootstrap-selector/js/bootstrap-select.min.js')}}"></script>
        <script src="{{asset('vendors/image-dropdown/jquery.dd.min.js')}}"></script>
        <script src="{{asset('js/smoothscroll.js')}}"></script>
        <script src="{{asset('vendors/isotope/imagesloaded.pkgd.min.js')}}"></script>
        <script src="{{asset('vendors/isotope/isotope.pkgd.min.js')}}"></script>
        <script src="{{asset('vendors/magnify-popup/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('vendors/vertical-slider/js/jQuery.verticalCarousel.js')}}"></script>
        <script src="{{asset('vendors/jquery-ui/jquery-ui.js')}}"></script>
        <script src="{{asset('js/theme.js')}}"></script>
    </body>
</html>