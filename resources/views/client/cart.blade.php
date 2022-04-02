@extends('layout')
@section('content')
<div class="check">
    
    <div class="container" style="margin-top: 70px">
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        
                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
            </ol>
        </nav>
        @if (session()->get('cart'))
        @php
        $totalprice = 0;
        foreach (session()->get('cart') as $item) {
        $totalprice += $item['product_quantity'] * $item['product_price'];
        }
        $totalpriceafter = $totalprice -($totalprice/10);
        @endphp
        <div class="col-md-3 cart-total">
            <a class="continue" href="{{ url('/trang-chu') }}">Tiếp tục mua hàng</a>
            <div class="price-details">
            
                <span>Tổng tiền</span>
                <span class="total1">{{ number_format($totalprice) }}VND</span>
               
                <div class="clearfix"></div>
            </div>
            <hr class="featurette-divider">
            <ul class="total_price">
                <li class="last_price">
                    <h4>TOTAL</h4>
                </li>

                <li class="last_price"><span>{{ number_format($totalprice) }}VND</span></li>
                <div class="clearfix"> </div>
            </ul>
            <div class="clearfix"></div>
           
            @if (Auth::id())
            <a class="order" href="{{ url('/checkout') }}">Đặt hàng</a>
            @else
            <a class="order" href="{{ url('/admin/login') }}">Bạn phải đăng nhập trước</a>
            @endif
                                
        </div>
        <div class="col-md-9 cart-items">
            <h1>Giỏ hàng của tôi (
                @php
                $qty = session()->get('cart');
                echo sizeof($qty);
                @endphp

                )</h1>
            <form action="{{ url('update-cart') }}" method="POST">
                @csrf
                @foreach ( session()->get('cart') as $item)
                <div class="cart-header" id="class-product-{{$item['session_id']}}">
                    <div class="close1" data-id="{{ $item['session_id'] }}"><span class="glyphicon glyphicon-remove"
                            aria-hidden="true"><a href="{{ url('/del-cart-ajax/' .$item['session_id']) }}"></a>
                        </span></div>
                    <div class="cart-sec simpleCart_shelfItem">
                        <div class="cart-item cyc">
                            <img src="{{ $item['product_image'] }}" class="img-responsive" alt="" />
                        </div>
                        <div class="cart-item-info">
                            <ul class="qty">
                                <li>
                                    <p>{{ $item['product_name'] }}</p>
                                </li>
                                <li>

                                    <p>Số lượng :<input type="number" value="{{ $item['product_quantity'] }}"
                                            name="cart_qty[{{ $item['session_id'] }}]"
                                            style="width: 50px; text-align: center" min="1"> </p>
                                </li>
                                <li>
                                    <p>Tổng cộng : <?php 
                                            $total = $item['product_quantity'] * $item['product_price'];
                                            echo number_format($total);
                                            ?> VND</p>
                                </li>
                            </ul>
                           
                        </div>
                        <div class="clearfix"></div>

                    </div>
                </div>
                @endforeach
                <div class="cart-header">
                    <div class="cart-sec simpleCart_shelfItem">
                        <input  type="submit" id="btn_update_qty" class="btn btn-default btn-sm"
                            value="Cập nhật giỏ hàng" name="update_qty" style="width: 50%;background: black; color: white;"
                            onmouseover="this.style.color='red'">
                        <a style="width: 40%" class="order" href="{{ url('/delete-all-cart') }}">Xóa tất cả</a>
                    </div>
                </div>
            </form>


        </div>
        @else
        <div class="col-md-3 cart-total" style="padding-top:90px;">


            <span>Giỏ hàng trống</span>
            <a class="order" href="{{ url('/trang-chu') }}">Mua hàng</a>
        </div>

        @endif


        <div class="clearfix"> </div>
    </div>
</div>
<script>
    $(document).ready(function(c) {
        $('.close1').on('click', function(c){
           var id = $(this).data('id');
            window.location.href = 'del-cart-ajax/'+id;
           $('#class-product-'+id).fadeOut('slow', function(c){
                $('#class-product-'+id).remove();

            });
            });	  
        });
</script>
@endsection