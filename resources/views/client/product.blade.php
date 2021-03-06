@extends('layout')
@section('content')
<div class="showcase-grid" style="padding-top:90px">
    <div class="container">
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"> <a
                        href="/shopphp/san-pham/{{ $product->category-> SeoTitle }}/{{$product->category -> id }}">{{ $product->category->CategoryName }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->Name }}</li>
            </ol>
        </nav>
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
                <div class="row">
                    <div class="col-12">
                        <div class="pull-left shoe-name">
                            <h3 style="color: crimson">{{ $product->Name }}</h3>
                            <p></p>
                            <?php
                                $price = 0;
                                $product->PromotionPrice != 0 ? $price = $product->PromotionPrice : '';

                                if($price!= 0)
                                {
                                    echo '<h4>'.number_format($price, 0, '', ',').'VND</h4>';
                                    echo '<br>';
                                    echo '<h5><strike>'.number_format($product->Price, 0, '', ',').'VND</strike></h5>';
                                }else {
                                    echo  '<h4>'.number_format($product->Price, 0, '', ',').'VND</h4>';
                                }
                                
                                ?>
                        </div>
                    </div>
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
                            <button type="button" name="add-to-cart" data-id="{{ $product -> id }}"
                                class="add-to-cart"><a class="btn" role="button" style="width: fit-content ;">Th??m v??o gi??? h??ng</a></button>

                        </li>
                    </ul>
                </div>
            </form>

            <div class="showcase-last">
                <h3>Chi ti???t s???n ph???m</h3>
                <ul>
                    <li>{{ $product-> Description }}</li>
                </ul>
                <table>
                    <tbody>
                        <tr>
                            <th>CPU</th>
                            <td>
                                <p>{{ $product->cpu }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>RAM</th>
                            <td>
                                <p>{{ $product->ram }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>VGA</th>
                            <td>
                                <p>{{ $product->vga }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>M??n h??nh</th>
                            <td>
                                <p>{{ $product->monitor }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="you-might-like">
    <div class="container">
        <h3 class="you-might">S???n ph???m li??n quan</h3>
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
                alert('???? th??m s???n ph???m v??o gi??? h??ng');
                window.location.href = "{{ url('/gio-hang') }}"
                }

           });
        });
    });
</script>
@endsection