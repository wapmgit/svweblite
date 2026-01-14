@extends ('layouts.master')
<?php $mostrar=0; ?>
@section ('contenido')
<?php $mostrar=1; ?>
<?php $acum=0;$efe=0;$deb=0;$che=0;$tra=0;
$cefe=0;?>
<!-- Main content -->
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
			@include('reportes.compras.pagar.empresa')
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
			   <div class="col-12 table-responsive">
				<table width="100%">
							<thead style="background-color: #E6E6E6">
								<th>Proveedor</th>
								<th>Contacto</th>
								<th>Cedula</th>
								<th>Telefono</th>
								<th>Direccion</th>
								<th>Monto</th>
								
							</thead>
							<?php $total=0; $count2=$count=0; ?>
						   @foreach ($compras as $cat)						
							<tr>
								<td>{{ $cat->nombre}} *Compras*</td>
								<td>{{ $cat->contacto}}</td>
								<td>{{ $cat->rif}}</td>
								<td>{{ $cat->telefono}}</td>
								<td>{{ $cat->direccion}}</td>
								<td><?php $count++; $total=$total+$cat->acumulado; echo number_format( $cat->acumulado, 2,',','.')." $"; ?></td>
							</tr>
							@endforeach
							 @foreach ($gastos as $cat)						
							<tr>
								<td>{{ $cat->nombre}} *Gasto*</td>
								<td>{{ $cat->contacto}}</td>
								<td>{{ $cat->rif}}</td>
								<td>{{ $cat->telefono}}</td>
								<td>{{ $cat->direccion}}</td>
								<td><?php $count++; $total=$total+$cat->acumulado; echo number_format( $cat->acumulado, 2,',','.')." $"; ?></td>
							</tr>
							@endforeach
							<tr><td>Documentos: <?php echo $count+$count2; ?></td>
							<td colspan="3"></td><td><strong>Total:</strong></td><td><strong><?php echo number_format( $total, 2,',','.')." $"; ?></strong></td>
							</tr>
						</table>
		         <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
					   <label>Usuario: </label>  {{ Auth::user()->name }}  
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button> 
                    </div>
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
  window.print(); 
  window.location="{{route('resumengastos')}}";
    });

});

</script>

@endpush
@endsection