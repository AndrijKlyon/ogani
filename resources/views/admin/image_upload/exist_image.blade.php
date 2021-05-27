<div id="img_single" class="table table-striped">
    <div class="file-row">
        <div>
            @if(Storage::disk('local_public')->exists($filePath))
                <span class="preview"><img style="width: 80px;" src="{{ asset($filePath) }}" /></span>
            @else
                <span class="preview"><img style="width: 80px;" src="{{ Croppa::url('img/no-image.jpg', 90, 80) }}" /></span>
            @endif
        </div>
        <div>
            <p class="name" >{{ Str::before($image_name, '_') }}</p>
        </div>
        <div>
            <p class="size">
                @if(Storage::disk('local_public')->exists($filePath))
                <span style="font-weight:bold;">
                    {{ round(Storage::disk('local_public')->size($filePath)/1000, 2) }}
                </span> KB
                @endif
            </p>
        </div>
        <div>
            <button class="btn btn-danger image-single_delete">
                <i class="glyphicon glyphicon-trash"></i>
                <span>Удалить</span>
            </button>
        </div>
    </div>
</div>
