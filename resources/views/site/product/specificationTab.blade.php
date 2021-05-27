<div class="product__details__tab__desc">
    <h6>Характеристики товара</h6>
    <table class="table">
        <tbody>
          <tr>
            <td>
                <h5>Бренд</h5>
            </td>
            <td>
                <h5>{{ $product->brand->title }}</h5>
            </td>
          </tr>

          @foreach($product->specifications as $item)
            <tr>
                <td>
                    <h5>{{ $item->feature }}</h5>
                </td>
                <td>
                    <h5>{{ $item->value }}</h5>
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
</div>
