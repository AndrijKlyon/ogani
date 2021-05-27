
@if($mode == 'single')
<div class="table table-striped" class="files" id="previews_single">
  <div id="template_single" class="file-row">
     <!-- This is used as the file preview template -->
  <div>
    <span style="width: 120px;" class="preview"><img data-dz-thumbnail /></span>
</div>
<div>
    <p class="name" data-dz-name></p>
    <strong class="error text-danger" data-dz-errormessage></strong>
</div>
<div>
    <p class="size" data-dz-size></p>
    <div class="progress progress-striped active previews-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
    </div>
</div>
<div>
  <button type="button" class="btn btn-primary start previews-start start_single">
      <i class="glyphicon glyphicon-upload"></i>
      <span>Загрузить</span>
  </button>
  <button data-dz-remove class="btn btn-warning cancel previews-cancel cancel_single">
      <i class="glyphicon glyphicon-ban-circle"></i>
      <span>Отмена</span>
  </button>
  <button data-dz-remove class="btn btn-danger delete">
    <i class="glyphicon glyphicon-trash"></i>
    <span>Удалить</span>
  </button>
</div>
</div>
</div>
<div class="imageupload-errors" style="color: #dd4b39;"></div>
@endif


@if($mode == 'single_ext')
<div class="table table-striped" class="files" id="previews_single_ext">
  <div id="template_single_ext" class="file-row">
     <!-- This is used as the file preview template -->
  <div>
    <span style="width: 120px;" class="preview"><img data-dz-thumbnail /></span>
</div>
<div>
    <p class="name" data-dz-name></p>
    <strong class="error text-danger" data-dz-errormessage></strong>
</div>
<div>
    <p class="size" data-dz-size></p>
    <div class="progress progress-striped active previews-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
    </div>
</div>
<div>
  <button type="button" class="btn btn-primary start previews-start start_single_ext">
      <i class="glyphicon glyphicon-upload"></i>
      <span>Загрузить</span>
  </button>
  <button data-dz-remove class="btn btn-warning cancel previews-cancel cancel_single_ext">
      <i class="glyphicon glyphicon-ban-circle"></i>
      <span>Отмена</span>
  </button>
  <button data-dz-remove class="btn btn-danger delete">
    <i class="glyphicon glyphicon-trash"></i>
    <span>Удалить</span>
  </button>
</div>
</div>
</div>
<div class="imageupload-errors" style="color: #dd4b39;"></div>
@endif


@if($mode == 'multi')
<div class="table table-striped" class="files" id="previews_multi">
  <div id="template_multi" class="file-row">
     <!-- This is used as the file preview template -->
  <div>
    <span style="width: 120px;" class="preview"><img data-dz-thumbnail /></span>
</div>
<div>
    <p class="name" data-dz-name></p>
    <strong class="error text-danger" data-dz-errormessage></strong>
</div>
<div>
    <p class="size" data-dz-size></p>
    <div class="progress progress-striped active previews-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
    </div>
</div>
<div>
  <button type="button" class="btn btn-primary start start_multi previews-start">
      <i class="glyphicon glyphicon-upload"></i>
      <span>Загрузить</span>
  </button>
  <button data-dz-remove class="btn btn-warning cancel cancel_multi previews-cancel">
      <i class="glyphicon glyphicon-ban-circle"></i>
      <span>Отмена</span>
  </button>
  <button data-dz-remove class="btn btn-danger delete">
    <i class="glyphicon glyphicon-trash"></i>
    <span>Удалить</span>
  </button>
</div>
</div>
</div>
<div class="imageupload-errors" style="color: #dd4b39;"></div>
@endif
