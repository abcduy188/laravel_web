<!DOCTYPE html>
<html lang="en">

<head>
    <title>N-Air a E-commerce category Flat Bootstrap Responsive Website Template | Home :: w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="N-Air Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
    </script>
    <meta charset utf="8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--fonts-->
    <link href='//fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>

    <!--fonts-->
    <!--bootstrap-->
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <!--coustom css-->
    <link href="{{asset('public/frontend/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet"
        type="text/css" />
    <!--shop-kart-js-->
    <script src="{{asset('public/frontend/js/simpleCart.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--default-js-->
    <script src="{{asset('public/frontend/js/jquery-2.1.4.min.js')}}"></script>
    <!--bootstrap-js-->
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <!--script-->
    <!-- FlexSlider -->
    <script src="{{asset('public/frontend/js/imagezoom.js')}}"></script>
    <script defer src="{{asset('public/frontend/js/jquery.flexslider.js')}}"></script>
    <link rel="stylesheet" href="{{asset('public/frontend/css/flexslider.css')}}" type="text/css" media="screen" />

    <script>
        // Can also be used with $(document).ready()
  $(window).load(function() {
    $('.flexslider').flexslider({
      animation: "slide",
      controlNav: "thumbnails"
    });
  });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <!-- //FlexSlider-->
</head>

<body>
    <div class="header">
        <div class="container">
            <div class="header-top">
                <div class="logo">
                    <a href="{{URL::to('/trang-chu')}}">N-AIR</a>
                </div>
                @if (Auth::id())
                <div class="login-bars">
                    <a class="btn btn-default log-bar" href="{{ url('/thong-tin') }}" role="button">Hello {{ Auth::user()->Name }}</a>
                    <a class="btn btn-default log-bar" href="{{ url('/admin/logout') }}" role="button">Logout</a>
                    @include('partial.cartpartial');
                </div>
                @else
                <div class="login-bars">
                    <a class="btn btn-default log-bar" href="{{ url('/register') }}" role="button">Sign up</a>
                    <a class="btn btn-default log-bar" href="{{ url('/admin/login') }}" role="button">Login</a>
                    @include('partial.cartpartial');
                </div>
                @endif
               
                <div class="clearfix"></div>
            </div>
            <!---menu-----bar--->
            <div class="header-botom">
                <div class="content white">
                    <nav class="navbar navbar-default nav-menu" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="clearfix"></div>
                        <!--/.navbar-header-->

                        <div class="collapse navbar-collapse collapse-pdng" id="bs-example-navbar-collapse-1">
                            {{-- partial here --}}
                            @include('partial.category');
                            <div class="clearfix"></div>
                        </div>
                        <!--/.navbar-collapse-->
                        <div class="clearfix"></div>
                    </nav>
                    <!--/.navbar-->
                    <div class="clearfix"></div>
                </div>
                <!--/.content--->
            </div>
            <!--header-bottom-->
        </div>
    </div>

    <!-- main -->
    @yield('content')
    <!-- endmain -->

    <div class="footer-grid">
        <div class="container">
            <div class="col-md-2 re-ft-grd">
                <h3>Categories</h3>
                <ul class="categories">
                    <li><a href="#">Men</a></li>
                    <li><a href="#">Women</a></li>
                    <li><a href="#">Kids</a></li>
                    <li><a href="#">Formal</a></li>
                    <li><a href="#">Casuals</a></li>
                    <li><a href="#">Sports</a></li>
                </ul>
            </div>
            <div class="col-md-2 re-ft-grd">
                <h3>Short links</h3>
                <ul class="shot-links">
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">Support</a></li>
                    <li><a href="#">Delivery</a></li>
                    <li><a href="#">Return Policy</a></li>
                    <li><a href="#">Terms & conditions</a></li>
                    <li><a href="contact.html">Sitemap</a></li>
                </ul>
            </div>
            <div class="col-md-6 re-ft-grd">
                <h3>Social</h3>
                <ul class="social">
                    <li><a href="#" class="fb">facebook</a></li>
                    <li><a href="#" class="twt">twitter</a></li>
                    <li><a href="#" class="gpls">g+ plus</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="col-md-2 re-ft-grd">
                <div class="bt-logo">
                    <div class="logo">
                        <a href="index.html" class="ft-log">N-AIR</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="copy-rt">
            <div class="container">
                <p>&copy; 2015 N-AIR All Rights Reserved. Design by <a href="http://www.w3layouts.com">w3layouts</a></p>
            </div>
        </div>
    </div>
</body>
@yield('script')


</html>