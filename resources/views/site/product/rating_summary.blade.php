<div class="row total_rate">
    <div class="col-6">
      <div class="box_total">
        <h5>Рейтинг</h5>
        <h4>{{ number_format($product->averageRating, 1) }}</h4>
        <p>({{ count($product->ratings) }} {{ trans_choice('template.reviews', count($product->ratings)) }})</p>
      </div>
    </div>
    <div class="col-6">
      <div class="rating_list">
        <h5>Всего {{ count($product->ratings) }} {{ trans_choice('template.reviews', count($product->ratings)) }}</h5>
        <ul class="list">

            @for ($k=5; $k>0; $k--)
                @php $five_ratings = $product->ratings->where('rating', $k) @endphp
                @if($five_ratings->isNotEmpty())
                <li>
                    <a href="#">{{ $k }} {{ trans_choice('template.stars', $k) }}
                        @php $i=1 @endphp
                        @while ($i<=$k)
                        <i class="fa fa-star"></i>
                        @php $i++ @endphp
                        @endwhile
                        {{ count($five_ratings) }}
                    </a>
                </li>
                @endif
            @endfor

        </ul>
      </div>
    </div>
  </div>
