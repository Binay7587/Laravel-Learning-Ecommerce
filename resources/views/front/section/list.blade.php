<div class="row isotope-grid">
    @if(isset($all_products))
        @foreach($all_products as $product_info)
            @php
                $images = explode(",",$product_info->image);
            @endphp
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ $product_info->cat_id }}">
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-pic hov-img0" style="max-height: 350px;">
                        <a href="{{ route('product-detail',$product_info->slug) }}">
                            <img src="{{ asset($images[0]) }}" alt="IMG-PRODUCT">
                        </a>
                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l ">
                            <a href="{{ route('product-detail',$product_info->slug) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                {{ $product_info->title }}
                            </a>

                            <span class="stext-105 cl3">
                                NPR.
                                @php
                                    $cost = $product_info->price;
                                    if($product_info->discount > 0){
                                        $cost = ($cost - (($cost * $product_info->discount)/100));
                                    }
                                @endphp
                                {{ number_format($cost) }}
                                @if($product_info->discount > 0)
                                    <del style="color: #ffa1ab;">NPR. {{ number_format($product_info->price) }}</del>
                                @endif
                            </span>
                        </div>


                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
