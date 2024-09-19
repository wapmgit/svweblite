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
		<div class="col-sm-4 invoice-col">

                <?php echo date("d-m-Y",strtotime($searchText)); ?>
			
	</div>
              </div>
              <!-- /.row -->
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
        <h3 align="center">REPORTE RESUMEN DE MOVIMIENTOS BANCARIOS</h3>
   <table width="95%">
          @foreach ($banco as $b)   
		<thead>
          <th style="background-color: #E6E6E6" colspan="7">Codigo: {{$b->codigo}} -> Codigo: {{$b->codigo}} ->  Nombre: {{$b->nombre}} -> N° : {{$b->cuentaban}}</th>
        </thead>
		<thead>
		<th>Numero</th>
          <th>Concepto</th> 		  
          <th>Tipo</th> 
          <th>Fecha</th>	 
          <th>Monto</th>
          <th>Usuario</th>
       
        </thead>
        <?php $ctra= 0; $cche=0; $sim=""; $cdeb=0; $credito=$acum=0;  $mingreso=$megreso=0;  $contado=0; $count=0; $tcompras=0;?>

               @foreach ($datos as $q)
			   <?php if($b->idbanco == $q->idbanco){
									if ($q->tipo_mov == "DEP"){ $mingreso=$mingreso+$q->monto; $sim="+";}   
                                  if ($q->tipo_mov == "N/C"){ $mingreso=$mingreso+$q->monto; $sim="+";}   
                                 if ($q->tipo_mov == "PAG"){ $megreso=$megreso+$q->monto; $sim="-";}
                                  if ($q->tipo_mov == "RET"){ $megreso=$megreso+$q->monto; $sim="-";}
                                  if ($q->tipo_mov == "N/D"){ $megreso=$megreso+$q->monto; $sim="-";}
                       
				   ?>
        <tr>
			<td> {{$q->numero }}</td>
          <td>{{ $q->concepto }}</td> 
          <td>{{ $q->tipodoc }}</td> 
          <td><?php  echo $fecha=date_format(date_create($q->fecha_mov),'d-m-Y h:i:s');?></td>
		    
          <td><?php $acum=$acum+ $q->monto;  echo $sim." ".number_format($q->monto, 2,',','.'); ?></td> 
          <td>{{ $q->user }}</td>
        </tr>
       <?php } ?>
        @endforeach
		<tr  style="background-color: #E6E6E6"><td><strong>Total</strong></td>
		<td colspan="2" align="center"><strong>Ingresos: </strong><?php echo number_format($mingreso, 2,',','.');?></td>
		<td colspan="2" align="center"><strong>Egresos: </strong><?php echo number_format( ($megreso), 2,',','.');?></td>
		<td colspan="2" align="center"><strong>Saldo: </strong><?php echo number_format( ($mingreso-$megreso), 2,',','.');?></td></tr>
         <tr><td colspan="7"><hr/></td></tr>
 @endforeach
      </table>
      
		</div>
  
  </div>
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
  window.print(); 
  window.location="{{route('bancos')}}";
    });

});
	function conMayusculas(field) {
            field.value = field.value.toUpperCase()
}
</script>

@endpush   
@endsection