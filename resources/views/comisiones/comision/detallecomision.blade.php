@extends ('layouts.master')
@section ('contenido')
<?php $acum=0; $acum2=0;$cont=0;?>
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
				<div class="col-sm-8 invoice-col">
				{{$empresa->nombre}}
                  <address>
                    <strong>{{$empresa->rif}}</strong><br>
                   {{$empresa->direccion}}<br>
                     Tel: {{$empresa->telefono}}<br>
                  </address>
				</div>
                <!-- /.col -->
					<div class="col-sm-4 invoice-col">

				  <h4>Detalle de Documentos Incluidos en Comision </h4>
             
				</div>
              </div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<table width="100%"><tr><td width="30%"><strong>Vendedor</strong></td><td width="20%"><strong>Telefono</strong></td><td width="30%"><strong> Comision</strong></td><td width="20%"><strong>Monto Comision</strong></td>
			</tr>
			<tr><td>{{$vendedor->cedula}} -> {{$vendedor->nombre}}</td><td>{{$vendedor->telefono}}</td><td>{{$vendedor->id_comision}}</td><td>{{$vendedor->montocomision}} $</td>
			</tr>
		</table></br>
	</div>

</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
		
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
					<td><?php echo number_format($cat->total_venta, 2,',','.'); ?> </td>
					<td>{{ $cat->comision}}</td>
					<td><?php echo number_format($cat->montocomision, 2,',','.'); ?> </td>		
				</tr>
				@endforeach
				<tr>
				<td><?php echo $cont." Documentos"; ?></td><td colspan="3"></td><td><strong>TOTAL:</strong></td><td style="background-color: #A9D0F5"><?php echo number_format($acum2, 3,',','.'); ?> </td><td></td><td style="background-color: #A9D0F5"><?php echo number_format($acum, 2,',','.'); ?> </td>
				</tr>
			</table>

		</div>
		
	</div>
	<label> Fecha: <?php echo date("d-m-Y",strtotime($vendedor->fecha)); ?> </label>
	  <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button>
                    </div>
                </div>
</div>
</div>
@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  document.getElementById('pagar').style.display="none";
  document.getElementById('enlace').style.display="none";
  window.print(); 
  document.getElementById('enlace').style.display="";
  document.getElementById('pagar').style.display="";
    });

});

</script>

@endpush

@endsection