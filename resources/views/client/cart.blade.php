@extends('layout')
@section('content')
<div class="check">
    <div class="container">
        @php
        $totalprice = 0;
        foreach (session()->get('cart') as $item) {
        $totalprice += $item['product_quantity'] * $item['product_price'];
        }
        $totalpriceafter = $totalprice -($totalprice/10);
        @endphp
        <div class="col-md-3 cart-total">
            <a class="continue" href="#">Continue to basket</a>
            <div class="price-details">
                <h3>Price Details</h3>
                <span>Tổng tiền</span>
                <span class="total1">{{ number_format($totalprice) }}VND</span>
                <span>Discount</span>
                <span class="total1">10%(Festival Offer)</span>
                <span>Delivery Charges</span>
                <span class="total1">150.00</span>
                <div class="clearfix"></div>
            </div>
            <hr class="featurette-divider">
            <ul class="total_price">
                <li class="last_price">
                    <h4>TOTAL</h4>
                </li>

                <li class="last_price"><span>{{ number_format($totalpriceafter) }}VND</span></li>
                <div class="clearfix"> </div>
            </ul>
            <div class="clearfix"></div>
            <a class="order" href="#">Place Order</a>
        </div>
        <div class="col-md-9 cart-items">
            <h1>My Shopping Bag (
                @php
                $qty = session()->get('cart');
                echo sizeof($qty);
                @endphp

                )</h1>
            <form action="{{ url('update-cart') }}" method="POST">
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

                                    <p>Số lượng :<input type="number" value="{{ $item['product_quantity'] }}" name="qty"
                                            style="width: 50px; text-align: center" min="1"> </p>
                                </li>
                                <li>
                                    <p>Tổng cộng : <?php 
                                            $total = $item['product_quantity'] * $item['product_price'];
                                            echo number_format($total);
                                            ?> VND</p>
                                </li>
                            </ul>
                            <div class="delivery">
                                <p>Service Charges : Rs.190.00</p>
                                <span>Delivered in 2-3 bussiness days</span>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                </div>
                @endforeach
                <div class="cart-header">
                    <div class="cart-sec simpleCart_shelfItem">
                        <input type="submit" id="btn_update_qty" class="btn btn-default btn-sm"
                            value="Cập nhật giỏ hàng" name="update_qty" style="background: black; color: white;"
                            onmouseover="this.style.color='red'">
                    </div>
                </div>
            </form>


        </div>

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