@include('site.products.side_categories')

@include('site.products.side_price')

@include('site.products.side_sizes')

{{-- @include('site.products.side_latest_products') --}}

<div class="sidebar__item">
    <div>
        <div class="p-2">
            <a href="{{ route('products') }}" class="site-btn medium" id="price_btn">СБРОСИТЬ ФИЛЬТРЫ</a>
        </div>
    </div>
</div>
