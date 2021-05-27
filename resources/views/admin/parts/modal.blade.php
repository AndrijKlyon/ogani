<div class="modal modal-danger fade" id="my-modal-danger">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="delete_form" action="" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Подтвердите действие: удаление</h4>
        </div>
        <div class="modal-body">
          <p>Вы уверены, что хотите удалить элемент:</p>
          <p id="deleted_element"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Отменить</button>
          <button type="submit" id="delete_yes" class="btn btn-outline">Удалить</button>
        </div>
      </form>
      </div>
    </div>
</div>
