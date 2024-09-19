<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-calcular-{{$categoria->idcategoria}}">
<form action="{{route('recalcularcategoria')}}" method="POST" enctype="multipart/form-data" >
{{csrf_field()}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-primary">
			    <div class="modal-header ">
                     <h5 class="modal-title">Indique Porcentaje de Incremento</h5>
				     <button type="button" class="close" data-dismiss="modal" 
			        	aria-label="Close">
                     <span aria-hidden="true">×</span>
                      </button>
                 
			    </div>
	    	</div>
			<div class="modal-body">
				<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            		 <div class="form-group">
            			<label for="nombre">Porcentaje</label>
            			<input type="number" name="tasa" required value="" class="form-control" placeholder="%...">
						<input type="hidden" name="categoria"  value="{{$categoria->idcategoria}}" >
            		</div>
            	</div>		
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			           <div class="form-group">
             <label for="modo">Modo</label><br>
        <label for="precio1"> Incremento P.v.</label> <input name="modo" type="radio" value="1" checked="checked">
         <label for="precio2"> Ajuste Utilidad</label> <input name="modo" type="radio" value="2">
           </div>
		   </div>			

				
			    </div>  <!-- del row -->
		</div>  <!-- del modal body-->
			<div class="modal-primary">
			    <div class="modal-footer">
                    <div class="form-group">
                    <button type="button" class="btn btn-default btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary btn-outline pull-right">Confirmar</button>
                    </div>
		    	</div>
			</div>
	</div>
			
    </form>   
</div>
</div>