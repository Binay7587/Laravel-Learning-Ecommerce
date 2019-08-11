@extends('layouts.master')
@section('main-content')
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('landing') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
				Shoping Cart
			</span>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-10 col-xl-9 m-lr-auto m-b-50">
                <div class="m-l-25 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>
                                <th class="column-6">Action</th>
                            </tr>
                            @php $total_total = 0; @endphp
                            @if(session('_cart'))
                                @foreach(session('_cart') as $cart_items)
                                    @php $total_total += $cart_items['total_amount']; @endphp
                                    <tr class="table_row">
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <img src="{{ $cart_items['image'] }}" alt="IMG">
                                            </div>
                                        </td>
                                        <td class="column-2">{{ $cart_items['title'] }}</td>
                                        <td class="column-3">NPR. {{ number_format($cart_items['price']) }}</td>
                                        <td class="column-4">{{ $cart_items['quantity'] }}</td>
                                        <td class="column-5">NPR. {{ number_format($cart_items['total_amount']) }}</td>
                                        <td class="column-6">
                                            <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>

                                                <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="{{ $cart_items['quantity'] }}">

                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>

                                            <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 add_cart" data-id="{{ $cart_items['id'] }}">
                                                Add to cart
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-lg-2 col-xl-3 m-lr-auto m-b-50">
                <div class="bor10 p-lr-10 p-t-30 p-b-40 m-r-0 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
                        </div>

                        <div class="size-209">
								<span class="mtext-110 cl2">
									NPR. {{ number_format($total_total) }}
								</span>
                        </div>
                    </div>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
								<span class="stext-110 cl2">
									Delivery Charge:
								</span>
                        </div>

                        <div class="size-209">
								<span class="mtext-110 cl2">
									NPR. 150
								</span>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
                        </div>

                        <div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									NPR. {{ number_format($total_total + 150) }}
								</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout') }}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Proceed to Checkout
                    </a>
                    OR
                    Pay With:
                    <a href="{{ route('esewa') }}">
                        <img src="{{ asset('images/esewa_logo.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.add_cart').click(function(){
            var quantity = $(this).parent().find('input').val();
            var prod_id = $(this).data('id');

            $.ajax({
                url: "{{ route('add-to-cart') }}",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    quantity: quantity,
                    product_id: prod_id
                },
                success: function(response){
                    if(typeof(response) != 'object'){
                        response = $.parseJSON(response);
                    }

                    if(response.status == false){
                        swal('Error',response.msg,'error').then(function(){
                            document.location.href = document.location.href;
                        });
                    } else {
                        swal('Success',response.msg,'success').then(function(){
                            document.location.href = document.location.href;
                        });
                    }
                }
            });
        });
    </script>
@endsection
