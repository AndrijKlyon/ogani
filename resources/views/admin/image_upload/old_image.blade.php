<div id="img_single" class="table table-striped">
    <div class="file-row">
        <div>
            <span class="preview"><img style="width: 80px;" src="{{ asset($filePath) }}" /></span>
        </div>
        <div>
            <p class="name" >{{ old('img') }}</p>
        </div>
        <div>
            <p class="size">
                <span style="font-weight:bold;">
                    {{ round(Storage::disk('local_public')->size($filePath)/1000, 2) }}
                </span> KB
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
