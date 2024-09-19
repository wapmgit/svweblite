@extends ('layouts.master')
@section ('contenido')
<?php $cont=0; ?>
    <?php
// fecha 1
$fecha_dada= "1985/08/28";
// fecha actual
$fecha_actual= date("Y/m/d");

function dias_pasados($fecha_inicial,$fecha_final)
{
$dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
$dias = abs($dias); $dias = floor($dias);
return $dias;
}
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
				@include('vendedor.vendedor.empresa')
              </div>
		       <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                 <div class="form-group">
                      <label for="proveedor">Nombre</label>
                   <p>{{$vendedores->nombre}}</p>
                    </div>
            </div>
           <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                 <div class="form-group">
                      <label for="proveedor">Cedula</label>
                   <p>{{$vendedores->cedula}}</p>
                    </div>
            </div>
			  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="form-group">
                      <label for="proveedor">Telefono</label>
                   <p>{{$vendedores->telefono}}</p>
                    </div>
            </div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="form-group">
                      <label for="proveedor">Comision</label>
                   <p>{{$vendedores->comision}} %</p>
                    </div>
            </div>
            </div>
            <div class ="row">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <table id="detalles" width="100%">
                      <thead style="background-color: #A9D0F5">
                                          
                          <th>Nombre</th>
                          <th>Cedula</th>
                          <th>Telefono</th>
                          <th>Direccion</th>
                          <th>Ult. Compra</th>
                         
              </thead><?php $acumcosto=0; $acumprecio=0; $acum=0; $monto=0;?>
                      <tbody>
                        @foreach($clientes as $det)
						<?php $cont++; ?>
                        <tr > 
                          <td><small>{{$det->nombre}}</small></td>
                          <td><small><small>{{$det->cedula}}<small></small></td>
                          <td><small><small>{{$det->telefono}}</small></small></td>
                          <td><small><small>{{$det->direccion}}</small></small></td>                          
                          <td><?php if($det->lastfact==NULL){ echo "<small><small>Sin Ventas</small></small>";} else{
						  echo "<small><small>".date("d-m-Y",strtotime($det->lastfact)).", ".dias_pasados($det->lastfact,$fecha_actual)." Dias </small></small>"; } ?></td>                          
                        </tr>
                        @endforeach
						<tr><td colspan="4">Total:  <?php echo $cont; ?> Clientes</td></tr>
                      </tbody> 
                  </table>
                 
                    </div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <table id="detalles" width="100%">
				  <thead ><th colspan="3" align="center">Clientes con Mayor Monto en Facturacion</th></thead>
                      <thead style="background-color: #A9D0F5">                                        
                          <th>Nombre</th>
                          <th>Total</th>
                          <th>Saldo</th>                                                
					</thead >
                      <tbody>
                        @foreach($maventas as $ma)	
                        <tr > 
                          <td><small><small>{{$ma->nombre}}</small></small></td>
                          <td><small><small><?php echo number_format( $ma->facturado,'2',',','.'); ?></small></small></td>
                          <td><small><small><?php echo number_format( $ma->pendiente,'2',',','.'); ?></small></small></td>                                                   
                        </tr>
                        @endforeach
                      </tbody> 
                  </table>                
                    </div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <table id="detalles" width="100%">
				  	  <thead ><th colspan="3" align="center">Clientes con Menor Monto en Facturacion</th></thead>
                      <thead style="background-color: #A9D0F5">                                        
                          <th>Nombre</th>
                          <th>Total</th>
                          <th>Saldo</th>                                                
					</thead>
                      <tbody>
                        @foreach($meventas as $me)	
                        <tr > 
                          <td><small><small>{{$me->nombre}}</small></small></td>
                          <td><small><small><?php echo number_format( $me->facturado,'2',',','.'); ?></small></small></td>
                          <td><small><small><?php echo number_format( $me->pendiente,'2',',','.'); ?></small></small></td>                                                   
                        </tr>
                        @endforeach
                      </tbody> 
                  </table>                
                    </div>
       </div>
	   			<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12"></br>
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
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  document.getElementById('regresar').style.display="none";
  window.print(); 
  window.location="{{route('vendedores')}}";
    });
$('#regresar').on("click",function(){
  window.location="{{route('vendedores')}}";
  
});
});
</script>
@endpush
@endsection