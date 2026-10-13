<div class="modal fade" id="modal_alta{{$cat->idmiembro}}">
<form action="{{route('suspendermiembro')}}" method="get" id="formulario" enctype="multipart/form-data" >    
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                 
                </button>
                <h4 class="modal-title">Suspender cliente</h4>
			</div>
			<div class="modal-body">
				<p>¿Confirma Suspender Cliente? {{$cat->idmiembro}}</bR>
				{{ $cat->nombre}}</p>
				<input type="hidden" class="form-class" name="tipo" value="0">
				<input type="hidden" class="form-class" name="ids" value="{{$cat->idmiembro}}">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>

</form>
</div>