<div class="checkout__order__products">Товар <span>Всего</span></div>
<ul>
    @foreach($cart_products as $item)
        <li>
            {{ $item['name'] }}
            @if($item['attributes']['option'])
                ({{ $item['attributes']['option'] }})
            @endif
            x {{ $item['quantity'] }}
            <span>{{ $item['price'] * $item['quantity'] }}
            {{ config('template_settings.currency') }}</span>
        </li>
    @endforeach
</ul>
<div class="checkout__order__total">Итого <span>{{ $total_sum }} {{ config('template_settings.currency') }}</span></div>
<h4>Способ доставки</h4>
@foreach($shipping_methods as $item)
    <div class="checkout__input__checkbox">
        <label class="shipping">
            {{ $item->title }}
            <input data-value="{{ $item->title }}" name="shipping" type="radio">
            <span class="checkmark"><span class="checkmark_symbol"></span></span>
        </label>
    </div>
@endforeach
<h4>Способ оплаты</h4>
@foreach($pay_methods as $item)
    <div class="checkout__input__checkbox">
        <label class="pay">
            {{ $item->title }}
            <input data-value="{{ $item->title }}" name="pay" type="radio">
            <span class="checkmark"><span class="checkmark_symbol"></span></span>
        </label>
    </div>
@endforeach
<input type="hidden" name="pay_method" value="">
<input type="hidden" name="shipping_method" value="">
<div id="methods_error" class="help-block with-errors mt-2 @if(!$errors->any() ) d-none @endif">
    @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
    @endif
</div>
