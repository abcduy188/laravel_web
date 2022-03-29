@extends('layout')
@section('content')


<div>
    <div class="header-end" style="padding-top:90px;">
        <div class="container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    @for ($i = 1; $i<= sizeof($slides); $i++)
                         <li data-target="#myCarousel" data-slide-to="{{ $i }}"></li>
                    @endfor          
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                   @php
                       $a = 0;
                   @endphp
                    @foreach ($slides as $item )
                    @php
                        $a++;
                    @endphp
                    <div class="item {{ $a ==1? 'active':'' }} ">
                        <img src="{{$item->slide_image}}" alt="..." height="200px">
                        <div class="carousel-caption car-re-posn">
                            <h3>{{ $item->slide_name }}</h3>
                            <h4>{{ $item->slide_desc }}</h4>
                            <span class="color-bar"></span>
                        </div>
                    </div>
                    @endforeach    
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left car-icn" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right car-icn" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="feel-fall">
        
        <div class="container">
            <h2>Sản Phẩm Mới</h2>
            @foreach ($productnew as  $item)
            <div class="pull-left fal-box">
                <div class=" fall-left">
                    <h5> {{ $item->Name }}</h5>
                    <img src="{{$item->Image}}" alt="/" class="img-responsive fl-img-wid" style="height: 200px">
                    <p>Inspiration and innovation<br> for every athlete in the world</p>
                    <span class="fel-fal-bar"></span>
                </div>
            </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="shop-grid">     
        <div class="container">
            <h2>Sản Phẩm Nổi Bật</h2>
            @foreach ($product as $item)
            <div class="col-md-4 grid-stn simpleCart_shelfItem">
                <!-- normal -->
                <div class="ih-item square effect3 bottom_to_top">
                    <div class="bottom-2-top">
                        <div class="img"><img src="{{$item->Image}}" alt="/" class="img-responsive gri-wid" style="height: 250px"></div>
                        <div class="info">
                            <div class="pull-left styl-hdn">
                                <h3>{{ $item->Name }}</h3>
                            </div>
                            <div class="pull-right styl-price">
                                <p><a href="{{ url('chi-tiet/'.$item->SeoTitle).'/'.$item-> id }}"
                                        class="item_add"><span class="glyphicon glyphicon-shopping-cart grid-cart"
                                            aria-hidden="true"></span> <span class=" item_price">
                                            <?php
                                            $price = $item->Price;
                                            echo number_format($price, 0, '', ',');
                                                 ?>VND
                                        </span></a></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end normal -->
                <div class="quick-view">
                    <a href="{{ url('chi-tiet/'.$item->SeoTitle).'/'.$item-> id }}">Quick view</a>
                </div>
            </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
    </div>
</div>

@endsection