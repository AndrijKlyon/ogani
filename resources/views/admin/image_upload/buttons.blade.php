@if($mode == 'single')
<div @if(!$template) style="display:none;" @endif id="actions_single" class="row">

  <div class="col-lg-7">
    <!-- The fileinput-button span is used to style the file input field as button -->
    <span class="btn btn-success fileinput-button_single">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Добавить файл...</span>
    </span>
  </div>

  <div class="col-lg-5">
    <!-- The global file processing state -->
    <span class="fileupload-process">
      <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
      </div>
    </span>
  </div>
</div>
@endif



@if($mode == 'single_ext')
<div @if(!$template) style="display:none;" @endif id="actions_single_ext" class="row">

  <div class="col-lg-7">
    <!-- The fileinput-button span is used to style the file input field as button -->
    <span class="btn btn-success fileinput-button_single_ext">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Добавить файл...</span>
    </span>
  </div>

  <div class="col-lg-5">
    <!-- The global file processing state -->
    <span class="fileupload-process">
      <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
      </div>
    </span>
  </div>
</div>
@endif



@if($mode == 'multi')
<div @if(!$template) style="display:none;" @endif id="actions_multi" class="row">

  <div class="col-lg-7">
    <!-- The fileinput-button span is used to style the file input field as button -->
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Добавить файл...</span>
    </span>
    <button type="button" class="btn btn-primary start_multi">
        <i class="glyphicon glyphicon-upload"></i>
        <span>Загрузить</span>
    </button>
    <button type="reset" class="btn btn-warning cancel_multi">
        <i class="glyphicon glyphicon-ban-circle"></i>
        <span>Отменить загрузку</span>
    </button>
  </div>

  <div class="col-lg-5">
    <!-- The global file processing state -->
    <span class="fileupload-process">
      <div id="total-progress_multi" style="opacity: 0" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
      </div>
    </span>
  </div>
</div>
@endif
