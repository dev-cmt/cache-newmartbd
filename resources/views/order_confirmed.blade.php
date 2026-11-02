@extends('layouts.master')

@section('title')
    Order Confirmed
@endsection
@if(request()->is('confirm-order'))
    @section('style')
        <style>
            @media (max-width: 575.98px) {
                footer {
                    display: none;
                }
            }
        </style>
    @endsection
@endif

@section('tracking')
    @if(session()->has('api_purchase_data'))
        <script>
            dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
            dataLayer.push({
                event: "purchase",
                customer: {
                    id: "{{ session('api_purchase_data')['customer_id'] ?? '' }}",
                    first_name: "{{ session('api_purchase_data')['full_name'] ?? '' }}",
                    full_name: "{{ session('api_purchase_data')['full_name'] ?? '' }}",
                    email: "{{ session('api_purchase_data')['email'] ?? '' }}",
                    phone: "{{ session('api_purchase_data')['phone'] ?? '' }}",
                    address: {
                        address_summary: "{{ session('api_purchase_data')['address_summary'] ?? '' }}",
                        address1: "{{ session('api_purchase_data')['address_summary'] ?? '' }}",
                        country: "Bangladesh"
                    }
                },
                ecommerce: {
                    transaction_id: "{{ session('api_purchase_data')['invoice_id'] ?? '' }}",
                    value: {{ floatval(number_format(session('api_purchase_data')['sub_total'] ?? 0, 2, '.', '')) }},
                    tax: 0,
                    shipping: {{ floatval(number_format(session('api_purchase_data')['shipping_cost'] ?? 0, 2, '.', '')) }},
                    currency: "BDT",
                    coupon: "",
                    items: {!! session('api_purchase_data')['products'] ?? '[]' !!}
                }
            });
            if (typeof fbq === 'function') {
                var purchaseItems = {!! session('api_purchase_data')['products'] ?? '[]' !!};
                fbq('track', 'Purchase', {
                    content_ids: purchaseItems.map(function (item) { return item.item_id; }),
                    content_type: 'product',
                    value: {{ floatval(number_format(session('api_purchase_data')['sub_total'] ?? 0, 2, '.', '')) + floatval(number_format(session('api_purchase_data')['shipping_cost'] ?? 0, 2, '.', '')) }},
                    currency: 'BDT',
                    transaction_id: {!! json_encode((string) (session('api_purchase_data')['invoice_id'] ?? '')) !!}
                });
            }
        </script>
    @endif
@endsection

@section('body')
    <section class="py-md-5 confirm-order">
        <div class="cart-section">
            <div class="container">
                <div class="row py-md-5">
                    <div class="col-12 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="90" fill="#008000" class="bi bi-bag-check" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"></path>
                            <path
                                d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"></path>
                        </svg>
                        <h1 class="mb-md-4" style="color: green;font-weight: bold">Order Place Successfully</h1>
                        <p style="color: green">আপনার অর্ডারটি সফলভাবে সম্পন্ন হয়েছে আমাদের কল সেন্টার থেকে ফোন করে আপনার অর্ডারটি কনফার্ম করা হবে</p>
                        <a href="{{route('home')}}" class="btn btn-info px-5">আরো শপিং করুন</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
