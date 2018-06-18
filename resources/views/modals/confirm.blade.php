<div class="modal fade" id="confirm">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          <h4 class="modal-title">¿Estas seguro de eliminar la Tarea?</h4>
        </div>
        <div class="modal-body">
            <p class="text-center"> @{{ task.id }} </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" v-on:click="deleteTask">Aceptar</button>
        </div>
      </div>
    </div>
  </div>