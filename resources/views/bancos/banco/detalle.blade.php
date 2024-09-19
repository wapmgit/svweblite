@extends ('layouts.master')
@section ('contenido')
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3 align="center">DETALLE DE MOVIMIENTOS BANCARIOS {{$banco->nombre}}</h3> 

      <table id="ing" class="table table-striped table-bordered table-condensed table-hover">
        <thead >
        <th width="3%">#Mov</th>
        <th width="10%">Fecha</th>
		<th width="8%">N&uacute;mero</th>
        <th>Clasificador</th>
		<th>Concepto</th>
		<th width="25%">Beneficiario</th>
        <th>Tipo</th>
        <th>Monto</th>
		<?Php echo "<th align='center'> Ref $</th>";  ?>
        <th>Usuario</th>
		</thead>
        <TBODY>
        <?php $tcompras=0; ?>
               @foreach ($movimiento as $q)
               <?php  $tcompras=($tcompras+$q->monto);?>
				<tr> 
	       <td><small>{{ $q->id_mov}}</small></td> 
          <td><small><?php  echo $fecha=date_format(date_create($q->fecha_mov),'d-m-Y h:i:s');?></small></td>
          <td> <small> <a href="{{route('showrecibo',['id'=>$q->id_mov])}}"> <strong>{{ $q->numero}}</strong></a></small></td>

          <td><small>{{ $q->descrip}}</small></td>
		  <td><small>{{ $q->concepto}}</small></td>
		  <td><small>{{ $q->identificacion}}</small></td>
          <td><small>{{ $q->tipo_mov}}</small></td>
          <td><small><?php
			echo number_format(($q->monto),'2','.',','); ?></small></td>	
	<td align="center"><small> <?php
		echo number_format(($q->tasadolar),'2','.',','); ?> </small></td> 
          <td><small>{{  $q->user}}</small></td>
				</tr> @endforeach
 
			</TBODY>
      <TFOOT>
           <th>#Mov</th>
         <th>Fecha</th>
          <th>N&uacute;mero</th>
          <th>Clasificador</th>
          <th>Concepto</th>
          <th>Beneficiario</th>
            <th>Tipo</th>
          <th>Monto</th>
		<?Php	 echo "<th align='center'>Ref $</th>"; ?>
          <th>Usuario</th>
      </TFOOT>
			</table>

  </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
    <a ><button class="btn btn-primary btn-sm   pull-right" id="imprimir">Imprimir</button></a>
          <a href="{{route('showbanco',['id'=>$banco->idbanco])}}"  id="regresar"><button  class="btn btn-danger btn-sm btn-pull-left" >Regresar</button></a> 
                
	</div>
 

                  
   
@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  window.print(); 
  window.location="{{route('showbanco',['id'=>$banco->idbanco])}}";
    });

});

</script>

@endpush
@endsection