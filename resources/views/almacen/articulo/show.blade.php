@extends ('layouts.master')
@section ('contenido')
<?php
$fserver=date('Y-m-d');
if (!empty($ultcompra->fecha_hora)){ $fecha_a=$ultcompra->fecha_hora;}
 if (!empty($ultventa->fecha_emi)){$fechaventa=$ultventa->fecha_emi;}
function dias_transcurridos($fecha_a,$fserver){
$dias = (strtotime($fecha_a)-strtotime($fserver))/86400;
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
				<div class="col-sm-6 invoice-col">
				{{$empresa->nombre}}
				<address>
				<strong>{{$empresa->rif}}</strong><br>
					{{$empresa->direccion}}<br>
					Tel: {{$empresa->telefono}}<br>
				</address>
				</div>
                <!-- /.col -->
			<div class="col-sm-6 invoice-col">
			<h2 align="center"> Estadisticas del Articulo </h2>		
			</div>	
              </div>
		       <div class="row">
             	   <div class="col-8 table-responsive">
					<table width="100%">
					<thead>			
						<th>Codigo</th>
						<th>Nombre</th>					
						<th>Stock</th>
						<th>Costo$</th>		
						<th>Utilidad</th>
						<th>Iva</th>
						<th>Precio$</th>			
					</thead>
					<tr>
						<td>{{ $articulo->codigo}}</td>
						<td>{{$articulo->nombre}}</td>					
						<td>{{ $articulo->stock}}</td>
						<td><?php echo number_format($articulo->costo, 2,',','.'); ?></td>
						<td><?php echo number_format($articulo->utilidad, 2,',','.'); ?></td>
						<td><?php echo number_format($articulo->iva, 2,',','.'); ?></td>
						<td><?php echo number_format($articulo->precio1, 2,',','.'); ?></td>
					</tr>
					</table>
				</div>
				<div class="col-4 table-responsive">
					<div align="center">
					 <?php if ($articulo->imagen==""){?> <img src="{{ asset('/img/articulos/ninguna.jpg')}}" alt="{{$articulo->nombre}}" height="50px" width="50px" class="img-circle"><?php }else{ ?><img src="{{ asset('/img/articulos/'.$articulo->imagen)}}" alt="{{$articulo->nombre}}" height="100px" width="100px" class="img-circle"><?php } ?> 
					</div>
				</div>	
				</div>
          </br>
            <div class ="row">
                  	<div class="col-3 table-responsive">
					<h4  style="background-color: #E6E6E6">Ultima compra</h4>
					<?php  if (!empty($ultcompra->nombre)) {?>
						<label>Proveedor:</label> {{$ultcompra->nombre}}</br>
						<label>Documento: </label> {{$ultcompra->num_comprobante}}</br>
						<label>Fecha: </label> <?php echo date("d-m-Y",strtotime($ultcompra->fecha_hora)); ?></br>
						<label>Cantidad: </label> {{$ultcompra->cantidad}}</br>
						<label>Precio: </label> <?php echo number_format($ultcompra->precio_compra, 2,',','.'); ?> $.</br>
						<label>Desde: </label> <?php  echo dias_transcurridos($fserver,$fecha_a)." Dias."; ?>
					<?php } ?>	
                    </div>
					<div class="col-3 table-responsive">
					<h4  style="background-color: #E6E6E6">Ultima Venta</h4>
					<?php  if (!empty($ultventa->nombre)) {?>
						<label>Cliente:</label> {{$ultventa->nombre}}</br>
						<label>Documento:</label> {{$ultventa->tipo_comprobante}}-{{$ultventa->num_comprobante}}</br>
						<label>Fecha:</label> <?php echo date("d-m-Y",strtotime($ultventa->fecha_emi)); ?></br>
						<label>Cantidad:</label> {{$ultventa->cantidad}}</br>
						<label>Precio:</label> <?php echo number_format($ultventa->precio_venta, 2,',','.'); ?> $.</br>
						<label>Desde:</label> <?php  echo dias_transcurridos($fserver,$fechaventa)." Dias."; ?>
					<?php } ?>
                    </div>
				<div class="col-3 table-responsive">
					<h4  style="background-color: #E6E6E6">Ajustes Ralizados</h4>
					<table width="100%">
					<thead>			
					<th>Tipo ajuste</th>
					<th>Cantidad</th>					
					</thead>
						@foreach($ajustes as $aj)
					<tr>
					<td>{{ $aj->tipo_ajuste}}</td>
					<td><?php echo number_format($aj->cantidad, 2,',','.'); ?></td>					
					</tr>
						@endforeach
						</table>	
                    </div>
				<div class="col-3 table-responsive">
					<h4  style="background-color: #E6E6E6">Datos de Interes</h4>
						<small><label>Ventas en Ultimos 30 dias: </label><?php echo number_format(($analisisventa->cantidad), 2,',','.'); ?> Unds  </small></br>
						<small><label>Prom. Semanal de Venta: </label> <?php echo number_format(($analisisventa->cantidad/7), 2,',','.'); ?> Unds</small>
						<small><label>Compras en Ultimos 30 dias: </label> <?php echo number_format(($analisiscompra->cantidad), 2,',','.'); ?> Unds</br></small>
						<small><label>Prom. Semanal de Compras: </label> <?php echo number_format(($analisiscompra->cantidad/7), 2,',','	 
				.'); ?> Unds </br></small>
				<label>Utilidad Neta Generada:</label> <?php echo number_format(($util->precio-$util->costo), 2,',','	 
				.'); ?> $.
                    </div>
		
                </div> 
				<div class="row">
					<div class="col-6 table-responsive">
					<table width="100%">
				<thead><td colspan="4" align="center"  style="background-color: #E6E6E6"><strong>Resumen Compras</strong></td></thead>
				<thead>			
					<th>Total Comprado</th>
					<th>Precio Promedio</th>					
					<th>Total Compras</th>					
					<th>Devoluciones</th>					
					</thead>
				<tr>
					<?php  if (!empty($compras->cantidad)) {?>
					<td><?php echo number_format($compras->cantidad,2,',','.');?> Unds.</td>
					<td><?php echo number_format(($compras->precio/$compras->compra), 2,',','.'); ?> $</td>
					<td>{{$compras->compra}}</td>					
					<td><?php echo number_format($devcompras->devocompras,2,',','.');?> Unds.</td>	
					<?php } ?>					
				</tr>
				</table></div>
				
				<div class="col-6 table-responsive">
				<table width="100%">
				<thead><td colspan="4" align="center"  style="background-color: #E6E6E6"><strong>Resumen Ventas</strong></td></thead>
				<thead>			
					<th>Total Vendido</th>
					<th>Precio  venta Promedio</th>					
					<th>Total ventas</th>					
					<th>Devoluciones</th>					
					</thead>
				<tr>
				 <?php if (!empty($ventas->cantidad)){?>
					<td><?php echo number_format( $ventas->cantidad,2,',','.');?> Unds.</td>
					<td><?php echo number_format(($ventas->precio/$ventas->venta), 2,',','.'); ?> $</td>
					<td>{{$ventas->venta}}</td>					
					<td><?php echo number_format($deventas->devoventas,2,',','.');?> Unds.</td>	
				 <?php } ?>					
				</tr>
				</table></div>
	</div> 
		               
                </div>		
				<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
					<button type="button" id="regresarpg" class="btn btn-danger btn-sm" data-dismiss="modal">Regresar</button>
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button> 
                    </div>
                </div> 

@endsection
@push ('scripts')
<script>

$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
    document.getElementById('regresarpg').style.display="none";
  window.print(); 
  window.location="{{route('articulos')}}";
    });
	$('#regresarpg').on("click",function(){
		window.location="{{route('articulos')}}";
		});
});

</script>

@endpush