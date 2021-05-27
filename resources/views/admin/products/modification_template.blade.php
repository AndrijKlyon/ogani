<div class="row form-horizontal modifications_template" style="display: none;">
    <div class="box-body">
        <div class="col-lg-5 form-group">
            <label for="option1" class="col-sm-4 control-label">Опция (Цвет)</label>
            <div class="col-sm-8">
                <select class="form-control" name="option[]">
                    <option value="">Выберите опцию</option>
                    @foreach($options as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-5 form-group">
            <label for="modification_price" class="col-sm-4 control-label">Цена</label>
            <div class="col-sm-8">
                <input name="modification_price[]" type="text" class="form-control" placeholder="" value="">
            </div>
        </div>
        <div class="col-lg-2 form-group text-center">
            <button type="button" class="btn btn-danger delete_addedmodification" >
                <i class="glyphicon glyphicon-trash"></i>
                <span>Удалить</span>
            </button>
        </div>
    </div>
</div>
