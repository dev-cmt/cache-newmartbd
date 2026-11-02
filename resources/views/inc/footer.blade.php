<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-md-auto">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="social_links">
                            <ul>
                                <li>
                                    <a class="facebook" target="_blank" href="{{$web_settings->website_facebook ?? ''}}"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a class="youtube" target="_blank" href="{{$web_settings->website_youtube ?? ''}}"><i class="fa fa-youtube"></i></a>
                                </li>
                                <li>
                                    <a class="instagram" target="_blank" href="{{$web_settings->website_instagram ?? ''}}"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a class="twitter" target="_blank" href="{{$web_settings->website_linkedin ?? ''}}"><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 important-links">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="{{route('about_us')}}">About Us</a></li>
                                <li><a href="{{route('delivery_policy')}}">Delivery Policy</a></li>
                                <li><a href="{{route('return_policy')}}">Return Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="copyright_text">
                    <p>{!! $web_settings->website_copyright_text !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
