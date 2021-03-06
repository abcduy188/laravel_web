@extends('layout')
@section('content')
<div class="container" style="padding-top:100px;">
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"> <a href="/shopphp/san-pham/{{ $cate-> SeoTitle }}/{{$cate-> id }}">{{ $cate->CategoryName }}</a></li>
        </ol>
    </nav>
    <div class="col-md-12 grid-gallery">
        @foreach ($product as $item)
        <div class="col-md-4 grid-stn simpleCart_shelfItem">
            <!-- normal -->
            <div class="ih-item square effect3 bottom_to_top">
                <div class="bottom-2-top">
                    <div class="img"><img src="{{$item->Image}}" alt="/" class="img-responsive gri-wid"></div>
                    <div class="info">
                        <div class="pull-left styl-hdn">
                            <h3>{{ $item->Name }}</h3>
                        </div>
                        <div class="pull-right styl-price">
                            <p><a href="{{ url('chi-tiet/'.$item->SeoTitle).'/'.$item-> id }}" class="item_add"><span
                                        class="glyphicon glyphicon-shopping-cart grid-cart" aria-hidden="true"></span>
                                    <span class=" item_price">
                                        <?php
                                        $price = 0;
                                        $item->PromotionPrice != 0 ? $price = $item->PromotionPrice : '';

                                        if($price!= 0)
                                        {
                                            echo number_format($price, 0, '', ',').'VND';
                                            echo '<br>';
                                            echo '<strike>'.number_format($item->Price, 0, '', ',').'VND</strike>';
                                        }else {
                                            echo number_format($item->Price, 0, '', ',').'VND';
                                        }
                                        
                                        ?>

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
        <span style="text-align: center;">{{$product->links()}}</span>
</div>
</div>
@endsection