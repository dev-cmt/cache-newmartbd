@extends('layouts.master')

@section('title')
    Contact Us
@endsection

@section('body')
    <section>
        <div class="cart-section">
            <div class="container">
                <div class="row">
                    <div class="col-12 mb-md-0 mb-4">
                        <h5 class="font-weight-bold">Contact Us</h5>
                        <div class="p-2">
                            @if($web_settings->website_phone ?? null)
                                <p><i class="fa fa-phone"></i> {{$web_settings->website_phone}}</p>
                            @endif
                            @if($web_settings->website_address ?? null)
                                <p><i class="fa fa-map-marker"></i> {{$web_settings->website_address}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
