@extends('frontEnd.layouts.master')

@section('title')
    Checkout
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('backEnd/assets/vendor/select2/css/select2.css')}}">
    <style>
        /* Sticky Mobile Submit Button */
        @media (max-width: 767.98px) {
            #conf_order_btn {
                position: fixed;
                bottom: 12px;                  /* Gap from the bottom edge */
                left: 15px;                    /* Left side gap */
                width: calc(100% - 30px) !important; /* Total width minus left + right gap */
                z-index: 9999;
                margin-bottom: 0 !important;
                border-radius: 8px;           /* Rounded corners for floating look */
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            }
        }
    </style>
@endsection
@section('body')
    @if(\Cart::getContent()->count() > 0)
        <section>
            <div class="cart-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-12 mb-md-0 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="font-weight-bold mb-0">কাস্টমার ইনফরমেশন</h6>
                                </div>
                                <div class="card-body p-2">
                                    <p class="text-center">
                                        অর্ডারটি কনফার্ম করতে আপনার নাম, ঠিকানা, মোবাইল নাম্বার, লিখে
                                        <span class="text-danger font-weight-bold">অর্ডার কনফার্ম করুন</span> বাটনে ক্লিক করুন
                                    </p>
                                    <form action="{{route('place.order')}}" method="post" id="checkout_form" class="checkout_form">
                                        @csrf
                                        <input type="hidden" name="shipping_cost" id="shipping_cost">
                                        <div class="form-group">
                                            <label for="customer_name">নাম <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('customer_name')is-invalid @enderror" id="customer_name" name="customer_name" placeholder="আপনার নাম লিখুন" value="{{old('customer_name')}}" required>
                                            @error('customer_name')
                                            <span class="text-danger font-weight-bold">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="customer_name">মোবাইল <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('customer_phone')is-invalid @enderror" id="customer_phone" name="customer_phone" placeholder="আপনার ১১ সংখ্যার মোবাইল নাম্বার লিখুন"
                                                minlength="11" maxlength="11" required value="{{old('customer_phone')}}">
                                            @error('customer_phone')
                                            <span class="text-danger font-weight-bold">{{$message}}</span>
                                            @enderror
                                        </div>
                                        {{--<div class="form-group">
                                            <select name="district" id="district" class="form-control select2" required>
                                                <option value="">আপনার জেলা সিলেক্ট করুন</option>
                                                @foreach($districts as $district)
                                                    <option value="{{$district->name}}">{{$district->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>--}}
                                        <div class="form-group">
                                            <label for="customer_name">ঠিকানা <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="customer_address" name="customer_address" placeholder="আপনার সম্পূর্ণ ঠিকানা লিখুন" required></textarea>
                                        </div>

                                        {{--<div class="form-group">
                                            <select name="shipping_method" id="shipping_method" class="form-control" required>
                                                @foreach($shipping_methods as $item)
                                                    <option value="{{$item->id}}">{{$item->text}}</option>
                                                @endforeach
                                            </select>
                                        </div>--}}

                                        <div class="form-group">
                                            @foreach($shipping_methods as $key => $item)
                                                <div class="form-check">
                                                    <input type="radio" name="shipping_method" id="shipping_method{{$key}}" class="form-check-input"
                                                        value="{{$item->id}}" {{$key==0?"checked":""}}>
                                                    <label class="form-check-label font-weight-normal" for="shipping_method{{$key}}">{{$item->text}}</label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="form-group">
                                            <textarea class="form-control" name="order_note" placeholder="আপনার নোট লিখুন" required></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-success w-100 mb-2" style="height: 50px" id="conf_order_btn">অর্ডার কনফার্ম করুন</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="font-weight-bold mb-0">অর্ডার ইনফরমেশন</h6>
                                </div>
                                <div class="card-body p-2">
                                    <table class="cart_table table table-bordered table-striped text-center mb-0">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Product Name & Image</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Sub Total</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach(\Cart::getContent() as $item)
                                            <tr>
                                                <td>
                                                    <a href="{{route('cart.item.delete',$item->id)}}"><i class="fa fa-trash-o text-danger"></i></a>
                                                </td>
                                                <td class="text-left">
                                                    <img width="35" src="{{$item->associatedModel->get_thumb->file_url}}" alt="">
                                                    <a style="font-size: 12px"
                                                    href="{{route('single.product',[$item->associatedModel->slug,$item->associatedModel->id])}}">{{$item->name}}</a>
                                                </td>
                                                <td>{{$item->price}}</td>
                                                <td width="15%" class="cart_qty">
                                                    <a href="{{route('cart.item.minus',$item->id)}}"><i class="fa fa-minus" id="qty_minus"></i></a>
                                                    <input type="text" name="qty" id="qty" min="1" value="{{$item->quantity}}" readonly>
                                                    <a href="{{route('cart.item.plus',$item->id)}}"><i class="fa fa-plus" id="qty_plus"></i></a>
                                                </td>
                                                <td>{{$item->getPriceSum()}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-right pr-2">Net Total</th>
                                            <td><span id="net_total">{{\Cart::getTotal()}}</span></td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="text-right pr-2">Shipping Cost</th>
                                            <td>
                                                <span id="cart_shipping_cost">0</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="text-right pr-2">Grand Total</th>
                                            <td>
                                                <span id="grand_total"></span>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <a href="{{route('home')}}" class="btn btn-info btn-sm ">
                                        <i class="fa fa-angle-left"></i> Back To Shopping
                                    </a>
                                    <a href="{{route('cart.clear')}}" class="btn btn-danger btn-sm float-right">Cart Clear</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="py-md-5">
            <div class="cart-section">
                <div class="container">
                    <div class="row py-md-5">
                        <div class="col-12 text-center">
                            <h1 class="mb-md-4">কোন প্রোডাক্ট নেই</h1>
                            <a href="{{route('home')}}" class="btn btn-info px-5">প্রোডাক্ট বাছাই করুন</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection



@section('script')
    <script src="{{asset('backEnd/assets/vendor/select2/js/select2.min.js')}}"></script>
    <script>
        dataLayer.push({ ecommerce: null });
        dataLayer.push({
            'event': 'begin_checkout',
            'ecommerce': {
                'currency': 'BDT',
                'value': {{ \Cart::getTotal() }},
                'items': [
                    @foreach (\Cart::getContent() as $item)
                    {
                        'item_id': '{{ $item->associatedModel->id }}',
                        'item_name': '{{ $item->name }}',
                        'item_category': '{{ $item->associatedModel->get_categories->first()->category_name ?? '' }}',
                        'price': {{ $item->price }},
                        'quantity': {{ $item->quantity }}
                    },
                    @endforeach
                ]
            }
        });

        fbq('track', 'InitiateCheckout', {
            content_ids: [@foreach (\Cart::getContent() as $item) '{{ $item->associatedModel->id }}', @endforeach],
            content_type: 'product',
            value: {{ \Cart::getTotal() }},
            currency: 'BDT',
            num_items: {{ \Cart::getContent()->count() }}
        });
    </script>
    <script>
        $('.select2').select2();
        $(document).ready(function () {

            $('#customer_phone').on('change, blur', function() {
                var phone = $(this).val();
                var name = $('#customer_name').val();
                var address = $('#customer_address').val();
                var shipping_method = $('#shipping_method').val();
                var shipping_cost = $('#shipping_cost').val();
                var data = {
                    phone: phone,
                    name: name,
                    address: address,
                    shipping_method: shipping_method,
                    shipping_cost: shipping_cost
                };
                if (phone.length == 11) {
                    $.ajax({
                        url: '{{ route('abandoned.cart') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            data: data
                        },
                        success: function(data) {
                            // console.log(data)
                        }
                    });
                }
            });

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{route('ajax.get.shipp.meth')}}',
                type: 'POST',
                data: {_token: CSRF_TOKEN, id: $("input[name='shipping_method']:checked").val()},
                success: function (data) {
                    $("#cart_shipping_cost").text(data);
                    $("#shipping_cost").val(data);
                    calculate();
                }
            });

            $("input[name='shipping_method']").on('click', function () {
                if ($("input[name='shipping_method']:checked").val()) {
                    $.ajax({
                        url: '{{route('ajax.get.shipp.meth')}}',
                        type: 'POST',
                        data: {_token: CSRF_TOKEN, id: $(this).val()},
                        success: function (data) {
                            $("#cart_shipping_cost").text(data);
                            $("#shipping_cost").val(data);
                            calculate();
                        }
                    });
                } else {
                    $("#cart_shipping_cost").text(0);
                    $("#shipping_cost").val(0);
                    calculate();
                }

            });

            function calculate() {
                var net_total = parseFloat($('#net_total').text());
                var cart_shipping_cost = parseFloat($('#cart_shipping_cost').text());
                $('#grand_total').text(net_total + cart_shipping_cost);
            }


            $("#checkout_form").submit(function () {
                $("#conf_order_btn").attr("disabled", true).text('সাবমিট হচ্ছে...');
            });
        });
    </script>
@endsection
