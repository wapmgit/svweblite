@extends ('layouts.master')
@section ('contenido')
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
$cntser=0;
?>
<style type="text/css">
.class1{
	width: 100%;
	border: 2px solid #000000;
}
</style>
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <img src="{{asset('dist/img/iconosistema.png')}}" title="NKS"> SysVent@s
                    <small class="float-right"></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
			@include('ventas.venta.empresa')
              </div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<table width="100%"><tr><td width="30%"><strong>Cliente</strong></td><td width="20%"><strong>Telefono</strong></td><td width="30%"><strong>Direccion</strong></td><td width="20%"><strong># Control</strong></td>
			</tr>
			<tr><td>{{$venta->rif}} -> {{$venta->nombre}}</td><td>{{$venta->telefono}}</td><td>{{$venta->direccion}}</td><td>{{$venta->control}}</td>
			</tr>
			<tr><td colspan="4"><hr/ class="class1"></td></tr>
		</table>
		
	</div>

</div>
<div class ="row">
                                              
        <div class="col-md-12">
	
            <table id="detalles" width="100%">
                      <thead style="background-color: #A9D0F5">                    
                          <th>Articulo</th>
                          <th>Cantidad</th>
                          <th>Unidad</th>
                          <th>Precio</th>
                          <th>Subtotal</th>
                      </thead>
                    
                        @foreach($detalles as $det)
						<?php if ($det->cantidad>0){?>
                        <tr >
                          <td>{{$det->articulo}}</td>
                          <td>{{$det->cantidad}}</td>
                          <td>{{$det->unidad}}</td>
                          <td><?php echo number_format( $det->precio_venta, 2,',','.'); ?></td>
                          <td><?php echo number_format( (($det->cantidad*$det->precio_venta)-$det->descuento), 2,',','.'); ?></td>
                        </tr>
							<?php } ?>
                        @endforeach
                      </tbody>
					   <tfoot>                      
                          <th colspan="4"><div align="right">TOTAL: </div></th>
                          <th ><b><font size="4"><?php echo " $ ".number_format($venta->total_venta, 2,',','.'); ?> </b></font></th>
                          </tfoot> 
                         
                      <tbody>
            </table>
	 <tfoot> 
						   <th colspan="5"><hr/ class="class1"></th> </tfoot>
        </div>                   
				<?php if(count($recibos)>0){?>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><h6 align="center">Desglose de pago</h6>
                  <table width="100%">
                      <thead style="background-color: #A9D0F5">                   
                          <th>Tipo</th>
                          <th>Monto</th>
						  <th>Tasa</th>
                          <th>Monto$</th>
                          <th>Ref.</th>                          
                      </thead>                    
                      <tbody>                        
                        @foreach($recibos as $re) <?php  $acum=$acum+$re->monto;?>
                        <tr >
                          <td>{{$re->idbanco}}</td>
                          <td><?php echo number_format( $re->recibido, 2,',','.'); ?></td>
						      <td> <?php if ($re->idpago==2){echo number_format( $re->tasap, 2,',','.'); }
							  if ($re->idpago==3){echo number_format( $re->tasab, 2,',','.'); }?></td>
						   <td><?php echo number_format( $re->monto, 2,',','.'); ?></td>
                          <td>{{$re->referencia}}</td>                        
                        </tr>
                        @endforeach
				
                        <tfoot >                    
                          <th colspan="3">Total</th>
						  <th><?php echo "$ ".number_format( $acum, 2,',','.');?></th>
                          <th ><h4 id="total"><b></b></h4></th>
                          </tfoot>
                      </tbody>
                  </table>
                </div><?php } ?>
				<?php if(count($recibonc)>0){?>
				                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><h6 align="center">Nota de Credito Aplicada</h6>
                  <table width="100%">
                      <thead style="background-color: #A9D0F5">
                     
                          <th>Fecha</th> 
						  <th>Usuario</th>
                          <th>Monto</th>
						 
                      </thead>
                     
                      <tbody>
                        
                        @foreach($recibonc as $renc) <?php  $acumnc=$acumnc+$renc->monto;?>
                        <tr >
                          <td>{{$renc->fecha}}</td>
                          <td>{{$renc->user}}</td> 
						<td><?php echo number_format( $renc->monto, 2,',','.'); ?></td>						  
                        </tr>
                        @endforeach
                        <tfoot >                    
                          <th colspan="2">Total</th>
						  <th><?php echo "$ ".number_format( $acumnc, 2,',','.');?></th>
                          <th ><h4 id="total"><b></b></h4></th>
                          </tfoot>
                      </tbody>
                  </table>
                </div>
				<?php } ?>
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
         
                    <p>           <label for="num_comprobante">Fecha: </label><?php echo " ".date("d-m-Y h:i:s a",strtotime($venta->fecha_hora)); ?></p>
                </div>
            </div> 
			<input type="hidden" name="ruta" id="ruta" value="{{$ruta}}"></input>
		@if(Auth::user()->nivel=="A")
			<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
					 <button type="button" id="regresar" class="btn btn-danger btn-sm" data-dismiss="modal" title="Presione Alt+flecha izq. para regresar">Regresar</button>
					 <button type="button" id="nventa" class="btn btn-info btn-sm" data-dismiss="modal">Facturar</button>
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button>
                    </div>
			</div>  
		@else
			<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
					 <button type="button" id="regresarvc" class="btn btn-danger btn-sm" data-dismiss="modal" title="Presione Alt+flecha izq. para regresar">Regresar</button>
					<button type="button" id="nventavc" class="btn btn-info btn-sm" data-dismiss="modal">Facturar</button>                 
					<button type="button" id="imprimirvc" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button>
                    </div>
			</div> 
			@endif
        </div>
	</div>
@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  document.getElementById('regresar').style.display="none";
  document.getElementById('nventa').style.display="none";
  window.print(); 
window.location.href="/{{$ruta}}";
    });
$('#regresar').on("click",function(){
window.location.href="/{{$ruta}}";
  
});
    $('#imprimirvc').click(function(){
  //  alert ('si');
  document.getElementById('imprimirvc').style.display="none";
  document.getElementById('regresarvc').style.display="none";
  document.getElementById('nventavc').style.display="none";
  window.print(); 
window.location.href="/{{$ruta}}";
    });
$('#regresarvc').on("click",function(){
window.location.href="/{{$ruta}}";
  
});
$('#nventavc').on("click",function(){
window.location.href="/newventa";
  
});
$('#nventa').on("click",function(){
window.location.href="/newventa";
  
});
});
</script>
@endpush
@endsection