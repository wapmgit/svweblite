     <div class="modal fade" id="modaleditar{{$cat->idretencion}}_{{$cat->afiva}}">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Ajustar N° de Retencion </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<form action="{{route('editretencion')}}" method="post" enctype="multipart/form-data" >
			{{csrf_field()}}
				<p align="center">¿Confirme si desea Ajustar numero de Retencion? -> {{$cat->correlativo}}
				<input type="hidden" value="{{$cat->idretencion}}_{{$cat->afiva}}" name="idret"></input></br></br>
				<label> Indique nuevo Numero:</label>
				<input type="number" value="" step="1" min ="1" name="ncorre"></input> </br></br>
				Desea afectar numeracion de Proxima retencion?
					<input type="checkbox" name="ajuste" >
				</p>
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