@if(isset($cart_products) && $cart_products->isNotEmpty() )
<section class="checkout spad">
    <div class="container">
        @guest
        <div class="row">
            <div class="col-lg-12">
                <h6 class="p-4">
                     @include('site.parts.auth_form', ['auth_mode' => 'checkout'])
                </h6>
            </div>
        </div>
        @endguest
        <div class="checkout__form">
            <h4>Детали доставки</h4>
            <form id="checkout_form" action="{{ route('checkout_finish') }}" method="post" data-toggle="validator">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        @include('site.checkout.billing_info')
                        @guest
                           @include('site.checkout.register_info')
                        @endguest
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Ваш заказ</h4>
                            @include('site.checkout.order_info')
                            <button id="checkout_finish" type="submit" class="site-btn">Продолжить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@else
    <section>
        <div class="container py-5">
            <div class="row py-5">
                <div class="col-lg-12 text-center">
                    <p class="pb-5">Корзина пуста</p>
                </div>
            </div>
        </div>
    </section>
@endif
