        <div class="modal fade" id="modal-delete-{{$ing->idgasto}}">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Anular Gasto {{$ing->documento}}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<form action="{{route('anulargasto',['id'=>$ing->idgasto])}}" method="POST" enctype="multipart/form-data" >
			{{csrf_field()}}

		<p>Confirme si desea Eliminar el gasto
		<input type="hidden" name="id"  value="{{$ing->idgasto}}" >
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-outline-light">Confirmar</button>
            </div>
			</form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>