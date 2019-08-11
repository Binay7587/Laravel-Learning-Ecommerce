@extends('layouts.master')
@section('title','Home | '.env('APP_SLOGAN'))

@section('meta')
    <meta content="nepali shopping site, ecommerce, electronics, mobiles, phones, shop, cart" name="keywords">
    <meta content="Nayabazar is an online ecommerce portal for Nepal where you can get all the goods and services you need." name="description">

    <meta property="og:title" content="{{ isset($meta['title']) ? $meta['title'] : 'Home | Nayabazar.com, An online Nepali Ecommerce Portal, Where all you need, you can get' }}">
    <meta property="og:url" content="{{ route('landing') }}">
    <meta property="og:description" content="{{ isset($meta['title']) ? $meta['title'] : 'Nayabazar is an online ecommerce portal for Nepal where you can get all the goods and services you need.'}}">
    <meta property="og:image" content="{{ isset($meta['image']) ? $meta['image'] : asset('images/icons/logo-01.png') }}">
    <meta property="og:type" content="website">
@endsection
@section('main-content')
<!-- Slider -->
<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">

            @if($banner)
                @foreach($banner as $banner_info)
                    <div class="item-slick1" style="background-image: url({{ asset($banner_info->image) }});">
                        <div class="container h-full">
                            <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                                <div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
                                    <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                        {{ $banner_info->title }}
                                    </h2>
                                </div>

                                <div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
                                    <a href="{{ $banner_info->link }}" target="_banner"
                                       class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                        Shop Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>


<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            @if($parent_cats)
                @foreach($parent_cats as $parent_category)
                    <div class="col-md-3 col-xl-3 p-b-30 m-lr-auto">
                        <!-- Block1 -->
                        <div class="block1 wrap-pic-w">
                            @if($parent_category->image != null && file_exists(public_path().$parent_category->image))
                                <img src="{{ asset($parent_category->image) }}" alt="IMG-BANNER">
                            @endif
                            <a href="{{ route('category-list',$parent_category->slug) }}"
                               class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                <div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									{{ $parent_category->title }}
								</span>

                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        Shop Now
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>


<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                Featured Products
            </h3>
        </div>

        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                    All Products
                </button>
                @if($parent_cats)
                    @foreach($parent_cats as $cat_info)
                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{ $cat_info->id }}">
                            {{ $cat_info->title }}
                        </button>
                    @endforeach

                @endif
            </div>

            <div class="flex-w flex-c-m m-tb-10">

                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Search
                </div>
            </div>

            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10 p-b-15">
                <div class="bor8 dis-flex p-l-15">
                    <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>

                    <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product"
                           placeholder="Search">
                </div>
            </div>


        </div>

        @include('front.section.list')

        {{ $all_products->links() }}


    </div>
</section>

@endsection
