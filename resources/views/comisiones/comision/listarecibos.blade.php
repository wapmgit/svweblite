@extends ('layouts.master')
@section ('contenido')
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

				  <h4>Reporte de Recibos Emitidos </h4>
             
				</div>
              </div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
      <table width="100%">
        <thead style="background-color: #A9D0F5">
					<th>#Recibo</th>
					<th>Vendedor</th>
					<th># Comision</th>
					<th>Fecha Comi.</th>
					<th>Monto Comision</th>
					<th>Monto Recibo</th>
					<th>Observacion</th>
          <th>Fecha Rec.</th>
          <th>Usuario</th>					
				</thead><?php $count=0; $acum=0; ?>
               @foreach ($lista as $q)
				<tr> <?php $count++; $acum=$acum+$q->monto;
         ?> 
					<td>{{ $q->id_recibo}}</td>
					<td>{{ $q->nombre}}</td>
					<td>{{ $q->id_comision}}</td>
					<td>{{ $q->fechacomision}}</td>
					<td><?php echo number_format( $q->montocomision, 3,',','.'); ?></td>
					<td><?php echo number_format( $q->monto, 3,',','.'); ?></td>
					<td>{{ $q->observacion}}</td>
					<td><?php echo date("d-m-Y",strtotime($q->fecha)); ?></td>
					<td>{{$q->user}}</td>
				</tr>

				@endforeach
        <tr style="background-color: #A9D0F5"><td><?php echo "<strong>Total:".$count."</strong>"; ?></td><td></td><td></td><td></td><td></td><td><?php echo "<strong>".number_format( $acum, 3,',','.')." $</strong>";  ?></td><td></td><td></td><td></td></tr>
			</table>
      
		</div>
  
  </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button>
					<input type="hidden" id="enlace" value="<?php echo $link; ?>"/>
					 <button type="button" id="regresar" class="btn btn-danger btn-sm" data-dismiss="modal">Regresar</button>
                    </div>
                </div>

  </div>
  </div>


      @push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').on("click",function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  document.getElementById('regresar').style.display="none";
  window.print(); 
  window.location="{{route('comisionxp')}}";
    });
$('#regresar').on("click",function(){
	var enlace=$("#enlace").val();
	if(enlace=="B"){
window.location="{{route('comisionespagadas')}}";
	}else{
  window.location="{{route('comisionxp')}}";		
	}
});
});
</script>

@endpush   
@endsection