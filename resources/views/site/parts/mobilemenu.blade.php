<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" alt="{{ config('template_settings.site.title') }}"></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li>
                <a href="{{ route('cart.show') }}">
                    <i class="fa fa-shopping-bag"></i>
                    @if( Cart::getTotalQuantity()>0)
                        <span> {{ Cart::getTotalQuantity() }}</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('wishlist.show') }}">
                    <i class="fa fa-heart"></i>
                    @if(app('wishlist')->getContent()->count() > 0)
                        <span> {{ app('wishlist')->getContent()->count() }}</span>
                    @endif
                </a>
            </li>
        </ul>
        @if(Cart::getTotalQuantity()>0)
            <div class="header__cart__price">{{ Cart::getTotalQuantity() }} {{ trans_choice('template.products', Cart::getTotalQuantity()) }}:
                <span>{{ Cart::getTotal() }} {{ config('template_settings.currency_symbol') }}</span></div>
        @endif
    </div>
    <div class="humberger__menu__widget">
        @guest
        <div class="header__top__right__auth additional_line">
            <a href="{{ route('register') }}"><i class="fa fa-user-plus"></i> Регистрация</a>
        </div>
        <div class="header__top__right__auth">
            <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Вход</a>
        </div>
    @endguest

    @auth
        <div class="header__top__right__language">
            <i class="fa fa-user pr-2"></i>
            <div>Кабинет</div>
            <span class="arrow_carrot-down"></span>
            <ul>
                <li><a href="{{ route('cabinet_orders') }}">Мои заказы</a></li>
                <li><a href="{{ route('cabinet_profile') }}">Мой профиль</a></li>
            </ul>
        </div>
        <div class="header__top__right__auth">
            <a href="logout"><i class="fa fa-sign-out"></i> Выход</a>
            <form class="d-none" id="logout_form" method="post" action="{{ route('logout') }}">
                @csrf
                <button type="submit" value="submit" class="">
                    Выход
                </button>
            </form>
        </div>
    @endauth
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        {!! $menu->asUl([], ['class' => 'header__menu__dropdown']) !!}
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="{{ config('template_settings.fb_link') }}"><i class="fa fa-facebook"></i></a>
        <a href="{{ config('template_settings.twitter_link') }}"><i class="fa fa-twitter"></i></a>
        <a href="{{ config('template_settings.linkedin_link') }}"><i class="fa fa-linkedin"></i></a>
        <a href="{{ config('template_settings.pinterest_link') }}"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> {{ config('template_settings.contacts.email') }}</li>
            <li>{{ config('template_settings.top') }}</li>
        </ul>
    </div>
</div>
