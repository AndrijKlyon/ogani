<div class="sidebar__item">
    <h4>Цена</h4>
    <div class="price-range-wrap">
        <div class="price-range-custom ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
            data-min="0" data-max="1000" data-currency="{{ config('template_settings.currency_symbol') }}">
            <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
        </div>
        <div class="range-slider">
            <div class="price-input">
                <input type="text" id="minamount">
                <input type="text" id="maxamount">
            </div>
        </div>
        <div class="p-2">
            <button class="site-btn medium" id="price_btn">OK</button>
        </div>
    </div>
</div>
