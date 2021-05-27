<div class="sidebar__item">
    <h4>Опции</h4>
    @foreach($options as $item)
        <div class="sidebar__item__size">
            <label for="{{ $item->id }}">
                {{ $item->title }}
                <input type="radio" id="{{ $item->id }}" value="{{ $item->alias }}">
            </label>
        </div>
    @endforeach
</div>
