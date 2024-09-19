@extends ('layouts.master')
<?php $mostrar=0; ?>
@section ('contenido')
<?php $mostrar=1; ?>
<div class="row" >
	@include('reportes.compras.comprasarticulo.search')
</div>

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
			@include('reportes.compras.comprasarticulo.empresa')
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
			   <div class="col-12 table-responsive">
				<table width="100%">
				<thead >			   
				  <th>Nombre </th>
				  <th>Grupo</th>
				  <th>P. compra Promedio</th>
				  <th>Cantidad</th>
				  <th>Monto</th>     
				</thead>
				<?php $ctra= 0; $acumventas=0; $smonto=0;$cche=0; $cdeb=0; $credito=0; $contado=0;$real=0; $count=0;$tventa=0;?>
               @foreach ($datos as $q)
				<?php $tventa=$tventa +($q->vendido*$q->vpromedio); ?>
				<tr>         
					<td>{{ $q->nombre}}</td>
					<td>{{ $q->grupo}} </td>
					<td><?php 
					$vp=number_format(($q->vpromedio), 2,',','.');
					$pv=number_format(($q->vpromedio), 2,',','.');
					if ($vp == $pv) {$real=$q->vpromedio; echo number_format($real, 2,',','.'); }
					else { $real=($q->subtotal/$q->vendido); echo number_format(($real), 2,',','.');}
					?></td>
					<td>{{ $q->vendido}}</td>
					<td><?php
					$smonto=($q->vendido*$real);
					echo number_format(($smonto), 2,',','.'); $acumventas=$acumventas+$smonto;?></td>       
				</tr>
				@endforeach
				<tr><td colspan="3" ><td align="left"> Total Compras:</td><td><strong><?php echo number_format(($acumventas), 2,',','.'); ?></strong></td></tr>
				</table>
			</div>

		</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 		       
					<label>Usuario: </label>  {{ Auth::user()->name }}  
					<div class="form-group" align="center">
					<button type="button" id="imprimir" class="btn btn-primary bnt-sm" data-dismiss="modal">Imprimir</button> 
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
window.location="{{route('comprasarticulo')}}";
    });

});

</script>

@endpush
@endsection