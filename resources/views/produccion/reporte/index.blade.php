@extends ('layouts.master')
<?php $mostrar=0; ?>

@section ('contenido')
<?php $mostrar=1; ?>
<div class="row">
		@include('produccion.reporte.search')
</div>


<?php $countv=0; $acummv=0; $counta=0; $acumma=0; $acumnd=0; $countnd=0;
$acumpa=0; $countpa=0; $acumga=0; $countga=0; $tcobro=0; $tpagos=0; $countndp=0; $acumndp=0;
?>
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
			@include('produccion.reporte.empresa')
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
			   <div class="col-6 table-responsive">
				<table width="100%">
					<thead style="background-color: #E6E6E6">
						<th colspan="5">Materia Prima</th>							
					</thead>
					<thead style="background-color: #E6E6E6">
						<th>Articulo</th>
						<th>Cantidad</th>
						<th>Valor</th>								
					</thead>
						@foreach ($salida as $q)
						<?php $countv++; $acummv=$acummv+$q->costout; ?>
				<tr>
				<td><small><small>{{$q->nombre}}</small></small></td>
				<td>{{$q->cntout}}</td>
				<td><?php echo number_format( ($q->costout), 2,',','.')." $"; ?></td>

				</tr>
				@endforeach
							<tr>
							<td colspan="2"><strong>Total:</strong></td>
							<td><strong><?php echo number_format( $acummv, 2,',','.')." $"; ?></strong></td>
							</tr>
				</table></br></br>
			</div>
	<div class="col-6 table-responsive">
				<table width="100%">
				<thead style="background-color: #E6E6E6">
						<th colspan="5">Produccion</th>							
					</thead>
					<thead style="background-color: #E6E6E6">
						<th>Articulo</th>
						<th>Cantidad</th>
						<th>Valor</th>								
					</thead>
					@foreach ($entrada as $pa)
						<?php $countpa++; $acumpa=$acumpa+$pa->costout; ?>
				<tr>
				<td><small><small>{{$pa->nombre}}</small></small></td>
				<td>{{$pa->cntout}}</td>
				<td><?php echo number_format( ($pa->costout), 2,',','.')." $"; ?></td>

				</tr>
				@endforeach

							<tr>
							<td colspan="2"><strong>Total:</strong></td>
							<td><strong><?php echo number_format( $acumpa, 2,',','.')." $"; ?></strong></td>
							</tr>
				</table></br>			
				</br>
			</div>
			</div>	

  
			<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
				<label>Usuario: </label>  {{ Auth::user()->name }}  
				<div class="form-group" align="center">
				<button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button> 
				</div>
			</div>
                   
		</div><!-- /.box-body -->
	
            	
@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  window.print(); 
  window.location="{{route('reporteproduccion')}}";
    });

});

</script>

@endpush
@endsection