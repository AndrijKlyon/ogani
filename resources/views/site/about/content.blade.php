<div class="about__content container p-5">
    @foreach($aboutrecords as $k => $item)
    <div class="row d-flex flex-md-row pb-4">
        <div class="col-lg-5 order-1 @if ($k % 2 != 0) order-lg-2 order-xl-2 @else order-lg-1 order-xl-1 @endif">
            <img class="pb-4" src="{{ asset('img/aboutrecords/'. $item->img) }}" alt="{{ $item->title }}">
        </div>
        <div class="col-lg-7 order-2 @if ($k % 2 != 0) order-lg-1 order-xl-1 @else order-lg-2 order-xl-2 @endif">
            <h3 class="pb-3">{{ $item->title }}</h3>
            {!! $item->text !!}
        </div>
    </div>
    @endforeach
</div>
