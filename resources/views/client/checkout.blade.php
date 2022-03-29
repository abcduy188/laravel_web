@extends('layout')
@section('content')
<div class="check">
  
    <div class="container" style="margin-top: 70px">
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url("/") }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url("/gio-hang") }}">Giỏ hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đặt hàng</li>
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
<div>
    <div class="col-md-6 reg-form">
		<div class="container">
			<div class="reg" >
				 <form action="{{ URL::to('/confirm-order') }}" method="POST">
                    {{ csrf_field() }}
					<ul>
						<li class="text-info">Email </li>
						<li><input type="text" name="ship_email" class="ship_email" value="{{ Auth::user()->email }}"></li>
					</ul>
					<ul>
						<li class="text-info">Họ tên người nhận: </li>
						<li><input type="text"name="ship_name" class="ship_name"value="{{ Auth::user()->Name }}"></li>
					 </ul>
                     <ul>
						<li class="text-info">Số điện thoại: </li>
						<li><input type="text"name="ship_phone"class="ship_phone" value="{{ Auth::user()->Phone }}"></li>
					</ul>				 
					<ul>
						<li class="text-info">Địa chỉ nhận hàng: </li>
						<li><input type="text"name="ship_address"class="ship_address" value=""></li>
					</ul>
				
					<ul>
						<li class="text-info">Ghi chú thêm:</li>
						<li><input type="text"name="ship_note"class="ship_note" value=""></li>
					</ul>
                    <ul>
                        <li class="text-info">Chọn hình thức</li>
                        <select name="payment_option" class="payment_option">
                            <option value="0"> Paypal</option>
                            <option value="1" selected> Tiền mặt</option>
                        </select>
                    </ul>					
					<input type="submit" class="send_order" value="Xác nhận đặt hàng">
				</form>
			</div>
		</div>
	</div>

    <div class="col-md-3 cart-total" style="margin-left: 10px; padding-top: 20px">
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
    </div>
</div>
            <!-- reg-form -->
	
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
                            <a class="order" href="{{ url('/delete-all-cart') }}">Xóa tất cả</a>
                    </div>
                </div>
            </form>


        </div>
        @else
        <div class="col-md-3 cart-total">
            

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
@section('script')
<script>
    var check2 =() => {
        var e = document.getElementById("ddlViewBy");
     document.getElementById('qty').value =  e.value;
      }
   
</script>
@endsection