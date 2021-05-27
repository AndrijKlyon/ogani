<div class="file-row" id="row_{{ $item->id }}">
    <div>
        @if(Storage::disk('local_public')->exists('img/'.$model.'/'.$item->img))
            <span class="preview"><img style="width: 80px;" src="{{ asset('img/'.$model.'/'.$item->img) }}" /></span>
        @else
            <span class="preview"><img style="width: 80px;" src="{{ Croppa::url('img/no-image.jpg', 90, 80) }}" /></span>
        @endif
    </div>
    <div>
        <p class="name" >{{ Str::before($item->img, '_') }}</p>
        <input type="hidden" name="images[]" value="{{ $item->img }}"/>
    </div>
    <div>
        <p class="size">
            @if(Storage::disk('local_public')->exists('img/'.$model.'/'.$item->img))
            <span style="font-weight:bold;">
                {{ round(Storage::disk('local_public')->size('img/'.$model.'/'.$item->img)/1000, 2) }}
            </span> KB
            @endif
        </p>
    </div>
    <div>
        <button style="width:195px!important; visibility: hidden;">
        </button>
        <button type="button" class="btn btn-danger productimage_delete" data-row="row_{{ $item->id }}">
            <i class="glyphicon glyphicon-trash"></i>
            <span>Удалить</span>
        </button>
    </div>
</div>
