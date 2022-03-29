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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--fonts-->
    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <!--coustom css-->
    <link href="{{asset('public/frontend/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/frontend/css/index.css')}}" rel="stylesheet" type="text/css" />
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap"
        rel="stylesheet">
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
    <header class=" header">

        <nav class="container navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed-top" style="height: 90px;">
            <div class="login">
                @if (Auth::id())
                <div class="login-bars">
                    <a class="btn btn-default log-bar" href="{{ url('/thong-tin/'.Auth::user()->id) }}"
                        role="button">Hello {{ Auth::user()->Name }}</a>
                    <a class="btn btn-default log-bar" href="{{ url('/admin/logout') }}" role="button">Logout</a>
                    @include('partial.cartpartial');
                </div>
                @else
                <div class="login-bars">
                    <a class="btn btn-default log-bar" href="{{ url('/register') }}" role="button">Sign up</a>
                    <a class="btn btn-default log-bar" href="{{ url('/admin/login') }}" role="button">Login</a>
                    @include('partial.cartpartial')
                </div>
                @endif
            </div>
            <a class="navbar-brand" href="{{URL::to('/trang-chu')}}">
                <img src="{{asset('public/backend/img/logo.svg')}}" alt="why">
            </a>
            <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#movieNavbar"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button> -->
            <div class="collapse navbar-collapse" id="movieNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        @include('partial.category');
                    </li>
                </ul>
                <form class="example" action="{{ URL::to('/tim-kiem') }}" style="margin:auto;max-width:300px" method="GET">
                    <input type="text" placeholder="Tìm kiếm sản phẩm" name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>

        </nav>

    </header>
    <!-- main -->
    @yield('content')
    <!-- endmain -->

    <div class="footer-grid">
        <div class="container">
            <div class="col-md-2 re-ft-grd">

                <ul class="categories">
                    <li><a href="">ASUS</a></li>
                    <li><a href="#">DELL</a></li>
                    <li><a href="#">ACER</a></li>
                    <li><a href="#">LENOVO</a></li>
                </ul>
            </div>
            <div class="col-md-2 re-ft-grd">

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
                        <a href="{{URL::to('/trang-chu')}}" class="ft-log">Laptop</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php
    $message = session()->get('message');
    if ($message)
    {
        echo "<input type='hidden' id='register_password' placeholder='Password' onshow='show()' value='".$message."'>";
        
        session()->put('message', null);
    }
?>
    <script src="http://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- BS4 JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script>
        function show(){
           alert(document.getElementById('register_password').value)
        }
        show();
    </script>
</body>
@yield('script')


</html>