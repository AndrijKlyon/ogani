<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6">
                    <div class="header__top__left">
                        <ul class="d-flex flex-lg-row">
                            <li><i class="fa fa-envelope"></i> {{ config('template_settings.contacts.email') }}</li>
                            <li>{{ config('template_settings.top') }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="{{ config('template_settings.fb_link') }}"><i class="fa fa-facebook"></i></a>
                            <a href="{{ config('template_settings.twitter_link') }}"><i class="fa fa-twitter"></i></a>
                            <a href="{{ config('template_settings.linkedin_link') }}"><i class="fa fa-linkedin"></i></a>
                            <a href="{{ config('template_settings.pinterest_link') }}"><i class="fa fa-pinterest-p"></i></a>
                        </div>
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
                                <form class="d-none logout_form" method="post" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" value="submit" class="">
                                        Выход
                                    </button>
                                </form>

                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" alt="{{ config('template_settings.site.title') }}"></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    {!! $menu->asUl([], ['class' => 'header__menu__dropdown']) !!}
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul class="topnav-icons">
                        <li class="cart-icon">
                            <a href="{{ route('cart.view') }}" class="cart-icon-qty">
                                <i class="fa fa-shopping-bag"></i>
                                @if( Cart::getTotalQuantity()>0)
                                    <span> {{ Cart::getTotalQuantity() }}</span>
                                @endif
                            </a>
                            <div class="cart-hover">
                                @if(Cart::getTotalQuantity()>0)
                                    @include('site.cart.modal', [
                                        'cart_products' => Cart::getContent(),
                                        'total_quantity' => Cart::getTotalQuantity(),
                                        'total_sum' => Cart::getTotal(),
                                    ])
                                @else
                                    <p class="text-center">Корзина пуста</p>
                                @endif
                            </div>
                        </li>
                        <li class="wishlist-icon">
                            <a href="{{ route('wishlist.view') }}" class="wishlist-icon-qty">
                                <i class="fa fa-heart"></i>
                                @if(app('wishlist')->getContent()->count() > 0)
                                    <span> {{ app('wishlist')->getContent()->count() }}</span>
                                @endif
                            </a>
                            <div class="wishlist-hover">
                                @include('site.wishlist.modal', [
                                    'wishlist_products' => app('wishlist')->getContent()
                                ])
                            </div>
                        </li>
                    </ul>
                    @if(Cart::getTotalQuantity()>0)
                        <div class="header__cart__price">{{ Cart::getTotalQuantity() }} {{ trans_choice('template.products', Cart::getTotalQuantity()) }}:
                            <span>{{ Cart::getTotal() }} {{ config('template_settings.currency_symbol') }}</span></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="humberger__open d-lg-none d-flex justify-content-center align-items-center">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
