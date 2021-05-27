<div class="product__details__tab__desc">
    <h6>Отзывы</h6>
    <div class="row">
        <div class="col-lg-5 pb-4">
            @include('site.product.rating_summary')
        </div>
        <div class="col-lg-7">
            <div class="review_box">
                @comments(['model' => $product, 'perPage' => 4, 'auth_mode' => 'product'])
            </div>
        </div>
      </div>
</div>
