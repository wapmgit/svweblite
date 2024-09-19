@extends ('layouts.master')
@section ('contenido')
<?php $acum=0; $acum2=0;$cont=0;?>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Detalle de Documentos activos para Comision</h3>

	</div>
</div>
	
<div class="row">
	  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="form-group">
                      <label for="proveedor">Vendedor</label>
                   <p>{{$vendedor->nombre}}</p>
                    </div>
            </div>
             <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                 <div class="form-group">
                      <label for="proveedor">Cedula</label>
                   <p>{{$vendedor->cedula}}</p>
                    </div>
            </div>
             <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                 <div class="form-group">
                      <label for="proveedor">Telefono</label>
                   <p>{{$vendedor->telefono}}</p>
                    </div>
            </div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
	<form action="{{route('guardarcomision')}}" method="POST" enctype="multipart/form-data" >         
        {{csrf_field()}}
			<table width="100%">
				<thead style="background-color: #A9D0F5">
					<th>Cliente</th>
						<th>Cedula</th>
					<th>N° Comprobante</th>
					<th>Fecha Fac.</th>
					<th>Fecha Emi.</th>
					<th>Monto Factura</th>
					<th>Comision</th>
					<th>Monto Comision</th>
									
				</thead>
               @foreach ($venta as $cat)
               <?php $cont++;
               $acum2=$cat->total_venta+$acum2; 
			       $acum=$acum+$cat->montocomision; 
               ?>
			   
				<tr>   <div class="form-group">
				<input type="hidden" name="idventa[]"  value="{{$cat->idventa}}"></div>
					<td>{{$cat->nombre}}</td>
						<td>{{$cat->cedula}}</td>
					<td>{{$cat->tipo_comprobante}}:{{$cat->serie_comprobante}}-{{$cat->num_comprobante}}</td>
					<td><?php echo date("d-m-Y h:i:s a",strtotime($cat->fecha_hora)); ?></td>
					<td><?php echo date("d-m-Y",strtotime($cat->fecha_emi)); ?></td>
					<td><?php echo number_format($cat->total_venta, 2,',','.')." $"; ?> </td>
					<td>{{ $cat->comision}}</td>
					<td><?php echo number_format($cat->montocomision, 2,',','.')." $"; ?> </td>		
				</tr>
				@endforeach
				<tr>
				<td><?php echo $cont." Documentos"; ?></td><td></td><td></td><td></td><td><strong>TOTAL:</strong></td><td style="background-color: #A9D0F5"><?php echo number_format($acum2, 2,',','.')." $"; ?> </td><td></td><td style="background-color: #A9D0F5"><?php echo number_format($acum, 2,',','.')." $"; ?> </td><td></td>
				</tr>
			</table>
	
		</div>
		
	</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  align="center"></br>
			<div class="form-group">				
				<input type="hidden" name="vendedor"  value="{{$vendedor->id_vendedor}}">
				<input type="hidden" name="mventas"  value="<?php echo $acum2; ?>">
				<input type="hidden" name="mcomision"  value="<?php echo $acum; ?>">
            	<button class="btn btn-primary btn-sm" type="submit">Generar Comision</button>
            	<a href="{{route('comisiones')}}"><button  class="btn btn-danger btn-sm" type="button">Regresar</button></a>
            </div>
		</div>	
		</form>
</div>

@endsection

@push ('scripts')

<script>
</script>
@endpush