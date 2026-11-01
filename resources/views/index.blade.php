@extends('frontEnd.layouts.master')

@section('title')
    Home
@endsection

@section('body')
    <div id="home_slider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($sliders as $key => $item)
                <li data-target="#home_slider" data-slide-to="{{$key}}" @if($key==0) class="active" @endif></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach($sliders as $key => $item)
                <div class="carousel-item {{$key==0 ? "active":""}}">
                    <img src="{{$item->get_img ? asset($item->get_img->file_url):asset('frontEnd/images/no_image.png')}}" class="d-block w-100"
                         alt="">
                </div>
            @endforeach
        </div>
    </div>

    {{--<section>
        <div class="product_categories">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5 class="mb-3">প্রোডাক্ট ক্যাটেগরীজ</h5>
                        <div class="horiz_cat">
                            <ul>
                                @foreach($categories as $cat)
                                    <li>
                                        <a href="{{route('single.category',$cat->id)}}">{{$cat->category_name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}

    <section>
        <div class="hot-deals">
            <div class="container-fluid">
                <div class="row title">
                    <div class="col-md-6 col-6">
                        <h4 class="my-2">Featured Products</h4>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="view-all-btn text-right mt-1">
                            <a href="{{route('all.hot.deals')}}">View All <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="hot-deals-inner-wrapper">
                            <div class="owl-carousel mb-3">
                                @foreach($hot_deal_1 as $item)
                                    <?php
                                    $percentage = round(100 - (($item->sale_price / $item->price) * 100));
                                    ?>
                                    <div class="main-product-inner-wrapper text-center">
                                        <a href="{{route('single.product',[$item->slug,$item->id])}}">
                                            <img src="{{$item->get_thumb ? asset($item->get_thumb->file_url) : asset('frontEnd/images/no_image.png')}}"
                                                 alt="{{$item->name}}">
                                        </a>
                                        @if($item->sale_price != 0)
                                            <p class="mb-0" style="text-decoration: line-through;color: #b8b8b8">{{$web_settings->currency_sign}} {{$item->price}}</p>
                                            <p class="font-weight-bold mb-0" style="color: #ed362c">{{$web_settings->currency_sign}} {{$item->sale_price}}</p>
                                        @else
                                            <p class="font-weight-bold mb-0" style="margin-top: 24px;color: #ed362c">{{$web_settings->currency_sign}} {{$item->price}}</p>
                                        @endif
                                        <p class="mb-0 prod_name"><a href="{{route('single.product',[$item->slug,$item->id])}}">{{$item->name}}</a></p>
                                        <form action="{{route('add.cart',$item->id)}}" method="post">
                                            @csrf
                                            <input type="hidden" name="qty" value="1">
                                            <input type="submit" class="btn btn-sm w-100 mb-2 order_now_btn" name="order_now" value="অর্ডার করুন">
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="main-products-section">
            <div class="container-fluid">
                <div class="row title">
                    <div class="col-md-6 col-6">
                        <h4 class="my-2">All Products</h4>
                    </div>
                </div>
                <div class="row m-0">
                    @foreach($products as $item)
                        <div class="col-md-2 col-6 main-product">
                            <div class="main-product-inner-wrapper text-center">
                                <a href="{{route('single.product',[$item->slug,$item->id])}}">
                                    <img src="{{$item->get_thumb ? asset($item->get_thumb->file_url) : asset('frontEnd/images/no_image.png')}}" alt="{{$item->name}}">
                                </a>
                                @if($item->sale_price != 0)
                                    <p class="mb-0" style="text-decoration: line-through;color: #b8b8b8">{{$web_settings->currency_sign}} {{$item->price}}</p>
                                    <p class="font-weight-bold mb-0" style="color: #ed362c">{{$web_settings->currency_sign}} {{$item->sale_price}}</p>
                                @else
                                    <p class="font-weight-bold mb-0" style="margin-top: 24px;color: #ed362c">{{$web_settings->currency_sign}} {{$item->price}}</p>
                                @endif
                                <p class="mb-0 prod_name"><a href="{{route('single.product',[$item->slug,$item->id])}}">{{$item->name}}</a></p>
                                <form action="{{route('add.cart',$item->id)}}" method="post">
                                    @csrf
                                    <input type="hidden" name="qty" value="1">
                                    <input type="submit" class="btn btn-sm w-100 mb-2 order_now_btn" name="order_now" value="অর্ডার করুন">
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row mt-md-4 mt-2">
                    <div class="col-12">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



@section('script')
    <script>
        $(document).ready(function () {
            $(".owl-carousel").owlCarousel({
                margin: 15,
                loop: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 6000,
                autoplayHoverPause: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        margin: 10,
                        items: 2,
                        nav: true
                    },
                    600: {
                        items: 3,
                        nav: false
                    },
                    1000: {
                        items: 6,
                        nav: true,
                        loop: false
                    }
                }
            });

            $('.owl-nav').remove();
        });
    </script>
@endsection
