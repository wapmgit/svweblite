@extends ('layouts.master')
@section ('contenido')
<?php $acum=0;?>
<?php $acum=0; 
$ceros=5;  $acumnc=0;
function add_ceros($numero,$ceros) {
  $numero=$numero;
	$digitos=strlen($numero);
  $recibo=" ";
  for ($i=0;$i<8-$digitos;$i++){
    $recibo=$recibo."0";
  }
return $insertar_ceros = $recibo.$numero;
};
?>
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-chart-pie"></i> Sistema de Ventas SysVent@s
                    <small class="float-right"></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
				<div class="col-sm-6 invoice-col">
				{{$empresa->nombre}}
				<address>
				<strong>{{$empresa->rif}}</strong><br>
					{{$empresa->direccion}}<br>
					Tel: {{$empresa->telefono}}<br>
				</address>
				</div>
                <!-- /.col -->
				<div class="col-sm-3 invoice-col">
				<h2 align="center"><u>  Nota de <?php if($tipo==1){ echo "Debito"; }else{ echo "Credito";}?> </u></h2>	
				<h4 align="center"># <?php $idv=$nota->ndocumento; echo add_ceros($idv,$ceros); ?></h5> 
				</div>	
				<div class="col-sm-3 invoice-col" align="center">
					<img src="{{asset('dist/img/logoempresa.png')}}" width="50%" height="80%" title="NKS">
				</div>
              </div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<table width="100%"><tr><td width="30%"><strong>Cliente</strong></td><td width="20%"><strong>Telefono</strong></td><td width="30%"><strong>Direccion</strong></td>
			</tr>
			<tr><td>{{$nota->cedula}} -> {{$nota->nombre}}</td><td>{{$nota->telefono}}</td><td>{{$nota->direccion}}</td>
			</tr>
		</table></br>
	</div>

</div>
<div class ="row">
                  <div class="col-12">
                  <table width="100%">
                      <thead style="background-color: #A9D0F5">
                     
                        
                          <th>Descripcion</th>
                          <th>Referencia</th>
                          <th>Fecha</th>                        
                          <th>Monto</th> 
                          <th>Usuario</th>
                            <th>Saldo</th> 
                      </thead>
                  <?php $acumn=$np=0; ?>
                      <tbody>
                     
                        <tr >
                  
                          <td>{{$nota->descripcion}}</td>
                          <td>{{$nota->referencia}}</td>
                          <td><?php echo date("d-m-Y h:i:s a",strtotime($nota->fecha)); ?></td>
                          <td><?php echo number_format( ($nota->monto), 2,',','.'); ?></td> 
						  <td>{{$nota->usuario}} </td>
                          <td><?php echo number_format( ($nota->pendiente), 2,',','.'); ?></td>
                        </tr>
                      
                            <tfoot> 
                          </tfoot>
                      </tbody>
                  </table>
				  </div>
</div>
<div class ="row">
                   <div class="col-12">
				   <?php if($tipo==1){ ?>
                  <table id="detalles" width="100%">
                      <thead style="background-color: #E6E6E6">
                     
                          <th>Moneda</th>
						  <th>fecha</th>
						  <th>Referencia</th>
                          <th>Recibido</th>
                          <th>Monto $</th>                      
                          
              </thead><?php $acum=0; $acumprecio=0; $acum=0; $monto=0;?>
                      <tbody>
                        @foreach($pagos as $det)
                        <tr > <?php $acum=($acum+$det->monto);  ?>
                          <td>{{$det->idbanco}}</td>
						   <td>{{$det->fecha}}</td>
						     <td>{{$det->referencia}}</td>    
                          <td>{{$det->recibido}}</td>
                          <td>{{$det->monto}}</td>                                                                   
                        </tr>
                        @endforeach
						@foreach($datond as $d)
                        <tr > <?php $acum=($acum+$d->monto);  ?>
                          <td>Nota de Credito</td>
						   <td>{{$d->fecha}}</td>
						     <td>{{$d->referencia}}</td>    
                          <td></td>
                          <td>{{$d->monto}}</td>                                                                   
                        </tr>
                        @endforeach
						
                      </tbody> 
					  <tr><td colspan="4">Total: </td>
					  <td><strong><?php echo number_format($acum, 2,',','.');?></strong></td></tr>
                  </table>
				   <?php } else{ ?>
				<table width="100%">
                      <thead style="background-color: #E6E6E6">
                     
                          <th>Tipo</th>
                          <th>Documento</th>
                          <th>Monto</th>
                          <th>Fecha</th>
                          <th>Referencia</th>
                          <th>Usuario</th>
              </thead><?php $acump=0; $acumprecio=0; $acum=0; $monto=0;?>
                      <tbody>
                        @foreach($pagos as $det)
                        <tr > <?php $acump=$acump+$det->monto; 
						 ?>
                          <td>{{$det->tipodoc}}</td>
                          <td>{{$det->iddoc}}</td>
                          <td>{{$det->monto}}</td>
                          <td>{{$det->fecha}}</td>
                          <td>{{$det->referencia}}</td>
                          <td>{{$det->user}}</td>
                          
                        </tr>
                        @endforeach
                      </tbody>   
					  <tr><td colspan="5">Total: </td>
					  <td><strong><?php echo number_format($acump, 2,',','.');?></strong></td></tr>
                  </table>
				   <?php } ?>
                    </div>
	</div>	
             <div class="col-12">
                <div class="form-group">
                    <label for="num_comprobante">Fecha:</label>
                    <?php echo date("d-m-Y h:i:s a",strtotime($nota->fecha)); ?>
                </div>
            </div> 

			<div class="col-12">
                    <div class="form-group" align="center">  
                      <a <?php if ($link=="A"){?>href="{{route('showcxc',['id'=>$nota->id_cliente])}}"<?Php } else {?>
					  href="{{route('edocuenta',['id'=>$nota->id_cliente])}}" <?php } ?>
					  >
					  
					  <button id="regresar" class="btn btn-danger btn-sm">Regresar</button></a>
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
  <?php  if ($link=="A") {?>
  window.location="{{route('showcxc',['id'=>$nota->id_cliente])}}";
  <?php }else{ ?>
  window.location="{{route('edocuenta',['id'=>$nota->id_cliente])}}";
  <?php } ?>
    });

});

</script>
@endpush
@endsection