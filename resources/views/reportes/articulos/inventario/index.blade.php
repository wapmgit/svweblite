@extends ('layouts.master')
@section ('contenido')
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

				  <h4>Articulos de Inventario</h4>
             
				</div>
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
					<table width="100%">
					 <thead style="background-color: #E6E6E6">

					<th>Codigo</th>
					<th>Nombre</th>
					<th>Existencia</th>
					<th>Costo</th>
					<th>Iva</th>
					<th>Utilidad</th>
					<th>Precio</th>

					
				</thead><?php $count=0; $costo=0;$costoacum=0; $precioacum=0;?>
               @foreach ($lista as $q)
				<tr> <?php $count++; 
					$costoacum=$q->stock+$costoacum;
					$costo=$costo+($q->costo*$q->stock);
					$precioacum=$q->stock*$q->precio1+$precioacum;
					?> 

					<td>{{ $q->codigo}}</td>
					<td>{{ $q->nombre}}</td>
					<td>{{ $q->stock}}</td>
					<td><?php echo number_format( $q->costo, 2,',','.'); ?></td>
					<td>{{ $q->iva}}</td>
					<td>{{$q->utilidad}} %</td>
					<td><?php echo number_format( $q->precio1, 2,',','.'); ?></td>	
				</tr>

				@endforeach
				<tr style="background-color: #E6E6E6" >
				  <td colspan="2"><?php echo "<strong>Articulos: ".$count."</strong>"; ?></td>
				  <td><?php echo "<strong>existencias : ".$costoacum."</strong>"; ?></td>
				  <td ><?php echo"<strong>  V. Costo: ".$costo." $</strong>"; ?></td>
				  <td></td>
				  <td></td>
				  <td><?php echo "<strong> V. Precio: ".$precioacum." $</strong>"; ?></td>
				 </tr>
					</table>
                </div>
				
				<div class="row no-print">
					<div class="col-12">
						<label>Usuario: {{ Auth::user()->name }}</label>  
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary bn-sm" data-dismiss="modal">Imprimir</button>
                    </div>
                </div>
              </div>
			</div>
@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
	document.getElementById('imprimir').style.display="none";
	window.print(); 
	window.location="{{route('reportearticulos')}}";
    });
});
</script>
@endpush       
@endsection