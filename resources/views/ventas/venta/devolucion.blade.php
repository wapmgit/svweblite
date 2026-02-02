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
?>
@include('ventas.venta.modaldevolucion')
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
					<h4 align="center"><u>  DEVOLUCION VENTA </u></h4>	
				</div>	
				<div class="col-sm-3 invoice-col" align="center">
					<img src="{{ asset('dist/img/'.$empresa->logo)}}" width="50%" height="80%" title="NKS">
				</div>
			</div>
			@include('ventas.venta.modaldelete')
			@include('ventas.venta.modaladd')
	<div class="row">
		<form action="{{route('devolucion')}}" id="formdevolucion" method="POST" enctype="multipart/form-data" >         
        {{csrf_field()}}
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<table width="100%"><tr><td width="30%"><strong>Cliente</strong></td><td width="20%"><strong>Telefono</strong></td><td width="30%"><strong>Direccion</strong></td><td width="20%"><strong>Documento</strong></td>
				</tr>
				<tr><td>{{$venta->cedula}} -> {{$venta->nombre}}</td><td>{{$venta->telefono}}</td><td>{{$venta->direccion}}</td><td>{{$venta->tipo_comprobante}} {{$venta->serie_comprobante}} <?php $idv=$venta->num_comprobante; echo add_ceros($idv,$ceros); ?></td>
				</tr>
			</table>
			  <input type="hidden" name="idventa" value="{{$venta->idventa}}">
			  <input type="hidden" name="comprobante" value="{{$venta->num_comprobante}}">
			  </br>
		</div>
	</div>
	<div class ="row">                   
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<table id="detalles" width="100%">
			<thead style="background-color: #A9D0F5">                      
			  <th>Articulo @if($rol->ajustarventa==1)<?php if($venta->total_venta==$venta->saldo){?>  <a href="" data-target="#modaldelete" data-toggle="modal"><i class="fa fa-eraser"></i> </a>&nbsp;
			  <a href="" data-target="#modaladd" data-toggle="modal"><i class="fa fa-plus"></i> </a><?php } ?> @endif</th>
			  <th>Cantidad</th>
			  <th>Descuento</th>
			  <th>Precio venta</th>
			  <th>Subtotal</th>
			</thead>
			<tfoot> 
			
			  <th colspan="4">TOTAL:</th>
			  <th ><h4 id="total"><b><?php echo "$ ".number_format($venta->total_venta, 2,',','.'); ?> </b></h4></th>
			  </tfoot>
			<tbody>
			@foreach($detalles as $det)
			<tr >
			  <td>
			  <input type="hidden" name="idarticulo[]" value="{{$det->idarticulo}}">{{$det->articulo}}</td>
			   <td> <?php 
						    if(($det->cantidad>0)and ($venta->devolu==0)){
						  ?>
						  <button type="button" onclick="javascript:abrirdiv({{$det->idarticulo}},{{$det->iddetalle_venta}},{{$det->precio_venta}},{{$det->cantidad}},'{{$det->articulo}}');">  <a href="" data-target="#modaldevolucion" data-toggle="modal">{{$det->cantidad}}</a></button>
						  <?php } else { echo $det->cantidad;} ?> 
			<input type="hidden" name="cantidad[]" value="{{$det->cantidad}}"></td>
			  <td><input type="hidden" name="descuento[]" value="{{$det->descuento}}">{{$det->descuento}}</td>
			  <td><input type="hidden" name="precio_venta[]" value="{{$det->precio_venta}}"><?php echo number_format( $det->precio_venta, 2,',','.'); ?></td>
			  <td><?php echo number_format( ($det->cantidad*$det->precio_venta), 2,',','.'); ?></td>
			</tr>
			@endforeach
			</tbody>
			</table>
		</div>
	</div>                            
	<div class ="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><h4 align="center">Desglose de pago</h4>
			<table width="100%">
			  <thead style="background-color: #A9D0F5">
				  <th>Tipo</th>
				  <th>Monto</th>
				  <th>Tasa</th>
				  <th>Monto$</th>
				  <th>Referencia</th>                         
			  </thead>                    
			  <tbody>
				@foreach($recibo as $re) <?php  $acum=$acum+$re->monto;?>
				<tr >
				  <td><input type="hidden" name="idrecibo[]" value="{{$re->idrecibo}}">{{$re->idbanco}}</td>
				  <td><?php echo number_format( $re->recibido, 2,',','.'); ?></td>
					  <td> <?php if ($re->idpago==2){echo number_format( $re->tasap, 2,',','.'); }
					  if ($re->idpago==3){echo number_format( $re->tasab, 2,',','.'); }?></td>
				   <td><?php echo number_format( $re->monto, 2,',','.'); ?></td>
				  <td>{{$re->referencia}}</td>                        
				</tr>
				@endforeach                                      
			  </tbody>
			   <tfoot >                    
				  <th colspan="3">Total</th>
				  <th><?php echo "$ ".number_format( $acum, 2,',','.');?></th>
				  <th ><input type="hidden" class="form-control" name="montonc" value="<?php echo $acum;?>"> </th>
				  </tfoot>
		  </table>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
			<label for="num_comprobante">Fecha:</label>
			<p><?php echo date("d-m-Y h:i:s a",strtotime($venta->fecha_hora)); ?></p>
		</div>
	</div>      
	<div class="modal-footer">		
		<div class="col-lg-12 ol-md-12 col-sm-12 col-xs-12" align="center">	
       <a href="{{route('ventas')}}"> <button type="button" class="btn btn-danger btn-sm" id="regresar" data-dismiss="modal" title="Presione Alt+flecha izq. para regresar">Cancelar</button></a>
        <input name="_token" value="{{ csrf_token() }}" type="hidden" ></input>
        <button type="button"id="procesa" class="btn btn-primary btn-sm">Procesar</button>     
        </div>
    </div>
</form>
@push ('scripts')
<script>
$(document).ready(function(){


    $('#procesa').click(function(){
Swal.fire({
  title: "¿ Seguro de Aplicar Devolucion Total?",
  text: "",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Si, Procesar!"
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      title: "Devuelta!",
      text: "Factura Devuelta.",
      icon: "success"
    });
	document.getElementById('formdevolucion').submit(); 
  }
});
    });
	$('#btnadd').on("click",function(){		
		document.getElementById('btnadd').style.display="none"; 
	});
	$('#btndelete').on("click",function(){ 
		document.getElementById('btndelete').style.display="none"; 
	});
    });
		
	function abrirdiv(ida,iddet,precio,cnt,na){
//alert(na);
$("#idarticulo").val(ida);
$("#iddetalle").val(iddet);
$("#idprecio").val(precio);
$("#idcantidad").val(cnt);
$("#art").text(na);
$("#idcantidad").prop('max', cnt);
}
	</script>
	@endpush
@endsection