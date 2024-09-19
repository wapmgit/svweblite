   <div class="modal fade" id="modal-delete-{{$cat->idretencion}}_{{$cat->afiva}}">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Anular Retencionr {{$cat->idretencion}}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<form action="{{route('anularetencion',['id'=>$cat->idretencion])}}" method="POST" enctype="multipart/form-data" >
			{{csrf_field()}}

		<p>¿Confirme si desea Anular Retencion?
		<input type="hidden" name="idret"  value="{{$cat->idretencion}}_{{$cat->afiva}}" >
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
