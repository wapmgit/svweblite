<div class="modal fade" id="modalfl{{$cat->idventa}}">
	  <form action="{{route('pasarfl')}}" method="get" enctype="multipart/form-data" >    
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Confirmar Operacion. </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<div class="modal-body">
<p> Confirma Convertir a Forma Libre el Documento {{$cat->serie_comprobante}}-{{$cat->num_comprobante}}
			<input type="hidden"  name="idventafl" value="{{$cat->idventa}}"></p>
			</div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" id="btnret{{$cat->idventa}}" class="btn btn-primary">Confirmar </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
		</form>
        <!-- /.modal-dialog -->
      </div>
@push ('scripts')
<script>
	$("#btnret<?php echo $cat->idventa; ?>").on("click",function(){
  	document.getElementById('btnret<?php echo  $cat->idventa; ?>').style.display="none"; 
});	
	</script>
@endpush