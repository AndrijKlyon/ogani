<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" alt="{{ config('template_settings.site.title') }}"></a>
                    </div>
                    <ul>
                        <li>Адрес: {{ config('template_settings.contacts.address') }}</li>
                        <li>Телефон: {{ config('template_settings.contacts.phone') }}</li>
                        <li>Email: {{ config('template_settings.contacts.email') }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>Меню</h6>
                    <ul>
                        @foreach($categories->where('parent_id', 0) as $item)
                            <li><a href="{{ url('products?filter[category.alias]='.$item->alias) }}">{{ $item->title }}</a></li>
                        @endforeach
                    </ul>
                    {!! $footer_menu->asUl([], ['class' => 'header__menu__dropdown']) !!}
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>Подписка</h6>
                    <p>Оформите подписку и узнавайте первыми о новостях и скидках нашего магазина.</p>
                    <form id="newsletter_form" action="{{ route('subscribe') }}" data-toggle="validator">
                        <div class="form-group has-feedback">
                            <input type="email"
                                    placeholder="Введите свой email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    required
                                    data-required-error="Поле обязательно"
                                    data-error="Введите корректный email">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="help-block success"></div>
                            <button type="submit" class="site-btn">Подписаться</button>
                        </div>
                    </form>

                    <div class="footer__widget__social">
                        <a href="{{ config('template_settings.fb_link') }}"><i class="fa fa-facebook"></i></a>
                            <a href="{{ config('template_settings.twitter_link') }}"><i class="fa fa-twitter"></i></a>
                            <a href="{{ config('template_settings.linkedin_link') }}"><i class="fa fa-linkedin"></i></a>
                            <a href="{{ config('template_settings.pinterest_link') }}"><i class="fa fa-pinterest-p"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        &copy; {{ now()->year }}, {{ config('template_settings.site.title') }}. Все права защищены. Дизайн-макет <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                    <div class="footer__copyright__payment"><img src="{{ asset('img/payment-item.png') }}" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</footer>
