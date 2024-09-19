<div class="modal fade" id="modalproveedor">
<form action="{{route('almacenaproveedor')}}" method="POST" id="formularioproveedor" enctype="multipart/form-data" >         
        {{csrf_field()}}
	<div class="modal-dialog">
	<div class="modal-content bg-primary">
		<div class="modal-primary">
			    <div class="modal-header ">
                     <h5 class="modal-title">Registrar Nuevo Proveedor</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                 
			    </div>
	    	</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						 <div class="form-group">
							    <label for="nombre">Nombres o Razon</label>
							<input type="text" name="cnombre" id="cnombre" required onchange="conMayusculas(this)" value="" class="form-control" placeholder="Nombre...">
						</div>
					</div>
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						 <div class="form-group">
							    <label for="nombre">Contacto</label>
							<input type="text" name="contacto"  onchange="conMayusculas(this)" value="" class="form-control" placeholder="Nombre Contacto...">
						</div>
					</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="rif">Rif</label>
                    <input type="text" name="rif" id="rif" class="form-control" placeholder="V00000000">
                </div>
            </div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					  <div class="form-group">
					<label for="descripcion">Telefono</label>
					<div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" name="ctelefono" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>
				</div>
				</div>
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					 <div class="form-group">
				 <label for="direccion">Direccion</label>
				<input type="text" name="cdireccion" class="form-control" placeholder="Direccion...">
				 <input type="hidden" name="idempresa"  class="form-control" value="{{$empresa->idempresa}}">
			   </div>
				</div>
				</div>  <!-- del row -->

	
			</div>
					<div class="modal-footer justify-content-between">
	
				<button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-outline-light"id="Nenviar2">Confirmar</button>

			</div>

		</div>
			
	</div>
</form>	
</div>

@push('scripts')
  <script>
$(document).ready(function(){
		$('[data-mask]').inputmask();
document.getElementById('Nenviar2').style.display="none";
 
		      $("#rif").on("change",function(){
         var form2= $('#formularioproveedor');
var url2 = '{{route("validarif")}}';
        var data2 = form2.serialize();
    $.post(url2,data2,function(result2){  
      var resultado2=result2;
         console.log(resultado2); 
         rows=resultado2.length; 
      if (rows > 0){
            var nombre=resultado2[0].nombre;
          var rif=resultado2[0].rif; 
          var telefono=resultado2[0].telefono;   
          alert ('Rif ya existe!!, Nombre: '+nombre+' Rif: '+rif+' Telefono: '+telefono);   
           $("#rif").val("");
}    else{
	document.getElementById('Nenviar2').style.display="";
}
          });
     });
});
  function conMayusculas(field) {
            field.value = field.value.toUpperCase();
}

  </script>
	@endpush
   