@extends('layout')
@section('content')
<div class="showcase-grid">
    <div class="container">
        <div class="col-md-8 showcase">
            <div class="flexslider">
                <ul class="slides">
                    <li data-thumb="{{ $product -> Image }}">
                        <div class="thumb-image">
                            <img src="{{ $product -> Image }}" data-imagezoom="true" class="img-responsive"
                                style="height: 400px; width: auto">
                        </div>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-md-4 showcase">
            <div class="showcase-rt-top">
                <div class="pull-left shoe-name">
                    <h3>{{ $product->Name }}</h3>
                    <p></p>
                    <h4> <?php
                        $price = $product->Price;
                        echo number_format($price, 0, '', ',');
                             ?>VND</h4>
                </div>
                <div class="pull-left rating-stars">
                    <ul>
                        <li><a href="#" class="active"><span class="glyphicon glyphicon-star star-stn"
                                    aria-hidden="true"></span></a></li>
                        <li><a href="#" class="active"><span class="glyphicon glyphicon-star star-stn"
                                    aria-hidden="true"></span></a></li>
                        <li><a href="#" class="active"><span class="glyphicon glyphicon-star star-stn"
                                    aria-hidden="true"></span></a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-star star-stn" aria-hidden="true"></span></a>
                        </li>
                        <li><a href="#"><span class="glyphicon glyphicon-star star-stn" aria-hidden="true"></span></a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
            <hr class="featurette-divider">
            <form>
                @csrf
                <div class="shocase-rt-bot">
                    <div class="float-qty-chart">
                        <ul>
                            <li class="qty">
                                <h4>QTY</h4>
                                <select id="ddlViewBy" onclick="check2()">
                                    <option value="1" selected="selected">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                                <input name="product_id" type="hidden" value="{{ $product-> id }}"
                                    class="product_id_{{ $product-> id }}" />
                                <input name="product_name" type="hidden" value="{{ $product-> Name }}"
                                    class="product_name_{{ $product-> id }}" />
                                <input name="product_image" type="hidden" value="{{ $product-> Image }}"
                                    class="product_image_{{ $product-> id }}" />
                                <input name="product_price" type="hidden" value="{{ $product-> Price }}"
                                    class="product_price_{{ $product-> id }}" />
                                <input name="product_qty" type="hidden" value="1" id="qty"
                                    class="product_qty_{{ $product-> id }}" />
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <ul>
                        <li class="ad-2-crt simpleCart_shelfItem">
                            <a class="btn item_add" href="#" role="button" style="width: fit-content ;">Add To Cart</a>
                            <button type="button" name="add-to-cart" data-id="{{ $product -> id }}"
                                class="add-to-cart"><a class="btn" role="button" style="">Buy Now</a></button>

                        </li>
                    </ul>
                </div>
            </form>

            <div class="showcase-last">
                <h3>product details</h3>
                <ul>
                    <li>{{ $product-> Description }}</li>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="specifications">
    <div class="container">
        <h3>Chi tiết sản phẩm</h3>
        <div class="detai-tabs">
            <!-- Nav tabs -->
            <ul class="nav nav-pills tab-nike" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                        data-toggle="tab">Chi tiết</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Nội
                        dung</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <p>The full-length Max Air unit delivers excellent cushioning with enhanced flexibility for smoother
                        transitions through footstrike.</p>
                    <p>Dynamic Flywire cables integrate with the laces and wrap your midfoot for a truly adaptive,
                        supportive fit.</p>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <p>Nike is one of the leading manufacturer and supplier of sports equipment, footwear and apparels.
                        Nike is a global brand and it continuously creates products using high technology and design
                        innovation. Nike has a vast collection of sports shoes for men at Snapdeal. You can explore our
                        range of basketball shoes, football shoes, cricket shoes, tennis shoes, running shoes, daily
                        shoes or lifestyle shoes. Take your pick from an array of sports shoes in vibrant colours like
                        red, yellow, green, blue, brown, black, grey, olive, pink, beige and white. Designed for top
                        performance, these shoes match the way you play or run. Available in materials like leather,
                        canvas, suede leather, faux leather, mesh etc, these shoes are lightweight, comfortable, sturdy
                        and extremely sporty. The sole of all Nike shoes is designed to provide an increased amount of
                        comfort and the material is good enough to provide an improved fit. These shoes are easy to
                        maintain and last for a really long time given to their durability. Buy Nike shoes for men
                        online with us at some unbelievable discounts and great prices. So get faster and run farther
                        with your Nike shoes and track how hard you can play.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="you-might-like">
    <div class="container">
        <h3 class="you-might">Sản phẩm liên quan</h3>
        @foreach ($prorela as $item)
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

@endsection
@section('script')
<script>
    var check2 =() => {
        var e = document.getElementById("ddlViewBy");
     document.getElementById('qty').value =  e.value;
      }
   
    $(document).ready(function(){
        $('.add-to-cart').click(function(){
        var id = $(this).data('id');
        var cart_id = $('.product_id_'+id).val() ;
        var cart_name = $('.product_name_'+id).val();
        var cart_img = $('.product_image_'+id).val();
        var cart_price = $('.product_price_'+id).val();
        var cart_qty = $('.product_qty_'+id).val();
        var _token = $('input[name="_token"]').val();


           $.ajax({
               url: '{{url('/add-cart-ajax') }}',
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               method: 'POST',
              
               data:{
                _token:_token,
                cart_id:cart_id,
                cart_name:cart_name,
                cart_img:cart_img,
                cart_price:cart_price,
                cart_qty:cart_qty
            },
               
                success:function(data)
                {
                    swal({
                        title:"abcduy says:",
                        text:"Đã thêm sản phẩm vào giỏ hàng",
                        showCancelButton: true,
                        cancelButtonText:"Xem tiếp",
                        confirmButtonClass:"btn-success",
                        confirmButtonText:"Đi đến giỏ hàng",
                        closeOnConfirm:false

                    },
                    function(){
                        window.location.href = "{{ url('/gio-hang') }}"
                    }
                   );
                }

           });
        });
    });
</script>
@endsection