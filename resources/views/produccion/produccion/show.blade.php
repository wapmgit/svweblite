@extends ('layouts.master')
@section ('contenido')

<?php 
$ceros=5;
function add_ceros($numero,$ceros) {
  $numero=$numero;
$digitos=strlen($numero);
  $recibo=" ";
  for ($i=0;$i<8-$digitos;$i++){
    $recibo=$recibo."0";
  }
return $insertar_ceros = $recibo.$numero;
};
$acumout=$acumin=0;
?>	
  	<div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <img src="{{asset('dist/img/iconosistema.png')}}" title="NKS">SysVent@s
                    <small class="float-right"></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
				@include('produccion.produccion.empresa')
              </div>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
                    	<label for="concepto">Concepto: </label></br> {{$ajuste->concepto}}  
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
			<label for="concepto">Responsable: </label></br> {{$ajuste->responsable}}
			</div>
		</div>
		<div class="col-md-3">
                <div class="form-group">
                	<label for="monto">Monto: </label></br> <?php echo number_format( $ajuste->valor, 2,',','.'); ?>
                     <p></p>
                </div>
		</div>
		<div class="col-md-3">
                <div class="form-group">
				<label for="monto">Fecha: </label> </br> <?php echo date("d-m-Y",strtotime($ajuste->fecha)); ?>
			<p></p>
                </div>
		</div>
	</div>
            <div class ="row">
        	   <div class="col-6 table-responsive">
					<table width="100%">
					  <thead style="background-color: #A9D0F5">                    
                          <th colspan="4">Materia Prima</th>
                      </thead>
                      <thead style="background-color: #A9D0F5">                    
                          <th>Articulo</th>
                          <th>Cantidad</th>
                          <th>Valorizado</th>
                      </thead>
                     <tbody>
                      
                        @foreach($detallesout as $det)
                        <tr >
                          <td>{{$det->articulo}}</td>
                          <td>{{$det->cantidad}}</td>
                          <td><?php echo number_format( $det->costo, 2,',','.'); $acumout=$acumout+($det->costo);?></td>

                        </tr>
                        @endforeach
                      </tbody> <tfoot> 
                     
                          <th colspan="2">TOTAL:</th>
                          <th ><b><?php echo number_format( $acumout, 2,',','.')." $"; ?> </b></th>
                          </tfoot>
                  </table>
                    </div>
     	   <div class="col-6 table-responsive">
					<table width="100%">
					  <thead style="background-color: #A9D0F5">                    
                          <th colspan="4">Produccion</th>
                      </thead>
                      <thead style="background-color: #A9D0F5">
                     
                          <th>Articulo</th>
                          <th>Cantidad</th>

                          <th>Valorizado</th>
                      </thead>
                     <tbody>
                      
                        @foreach($detallesin as $det)
                        <tr >
                          <td>{{$det->articulo}}</td>
                          <td>{{$det->cantidad}}</td>
                          <td><?php echo number_format( $det->costo, 2,',','.');  $acumin=$acumin+($det->costo);?></td>
                           
                        </tr>
                        @endforeach
                      </tbody> <tfoot> 
                     
                          <th colspan="2">TOTAL:</th>
                          <th ><b><?php echo number_format( $acumin, 2,',','.')." $"; ?> </b></th>
                          </tfoot>
                  </table>
                    </div>
                </div>
                  
 
			<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">

					 <button type="button" id="regresar" class="btn btn-danger btn-sm" data-dismiss="modal" title="Presione Alt+flecha izq. para regresar">Regresar</button>
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button>
                    </div>
                </div> 
            	
        </div>
@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  document.getElementById('imprimir').style.display="none";
  document.getElementById('regresar').style.display="none";
  window.print(); 
  window.location="{{route('produccion')}}";
    });
$('#regresar').on("click",function(){
  window.location="{{route('produccion')}}";
  
});
});
</script>
@endpush
@endsection