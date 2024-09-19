@extends ('layouts.master')
<?php $mostrar=0; ?>
@section ('contenido')
<?php $mostrar=1; ?>
<div class="row">
		@include('reportes.ventas.ventasarticulo.search')
</div>
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
			@include('reportes.ventas.ventasarticulo.empresa')
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
			   <div class="col-12 table-responsive">
				<table width="100%">
					<thead style="background-color: #E6E6E6" >    
					  <th>Nombre/ Pv Promedio</th>
					  <th>Grupo</th>
					  <th>Precio Venta</th>
					  <th>Cantidad</th>
					  <th>Monto</th>     
					</thead>
						<?php $ctra= 0; $cche=0; $cdeb=0; $credito=0; $contado=0;$real=0; $count=0;$tventa=0; $auxp=$auxpv=0;?>
					@foreach ($datos as $q)
					<?php $tventa=$tventa +($q->vendido*$q->pventa); 
					$auxp=number_format($q->vpromedio, 2,',','.'); $auxpv=number_format($q->pventa, 2,',','.');
						?>
					<tr>        
					  <td>{{ $q->nombre}} - <?php echo number_format($q->vpromedio, 2,',','.');?></td>
					  <td>{{ $q->grupo}}</td>
					  <td><?php if ($auxp==$auxpv) {$real=$q->pventa; echo number_format($real, 2,',','.'); }
					  else { $real=($q->pventa); echo number_format(($real), 2,',','.');}
					  ?></td>
					   <td><?php echo number_format(($q->vendido), 2,',','.'); ?></td>
					   <td><?php echo number_format(($q->vendido*$real), 2,',','.'); ?></td>       
					</tr>
					@endforeach
					<tr><td colspan="3" ><td align="left"><strong> Total Venta:</strong></td><td><strong><?php echo number_format(($tventa), 2,',','.')." $"; ?></strong></td></tr>
				</table>
			</div>
			</div>
                  	</div><!-- /.row -->
                     <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary" data-dismiss="modal">Imprimir</button>
                    </div>
                </div>
                   
                </div><!-- /.box-body -->
              </div><!-- /.box -->

@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  window.print(); 
  window.location="{{route('ventasarticulo')}}";
    });
	$("#filtro").on("change",function(){
		var variable=$("#filtro").val();							
		if( variable==1){
			document.getElementById('divend').style.display=""; 
			document.getElementById('divcli').style.display="none"; 
			$("#idcliente").val(0);
		}
		if( variable==2){
			document.getElementById('divend').style.display="none"; 
			document.getElementById('divcli').style.display=""; 
			$("#idvendedor").val(0);
		}
	});
});

</script>

@endpush
@endsection