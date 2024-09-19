@extends ('layouts.master')
@section ('contenido')
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3 align="center">DETALLE DE {{$detalle}} BANCARIOS:  {{$banco->nombre}}</h3> 

      <table id="ing" class="table table-striped table-bordered table-condensed table-hover">
        <thead >
          <th>Fecha</th>
          <th>N&uacute;mero</th>
          <th>Clasificador</th>
          <th>Concepto</th>
          <th>Beneficiario</th>
          <th>Tipo</th>
          <th>Monto</th>
          <th>Usuario</th>
        </thead>
        <TBODY>
        <?php $tcompras=0; ?>
               @foreach ($movimiento as $q)
               <?php  $tcompras=($tcompras+$q->monto);?>
        <tr> 
          <td><?php  echo $fecha=date_format(date_create($q->fecha_mov),'d-m-Y h:i:s');?></td>
         <td>  <a href="{{route('showrecibo',['id'=>$q->id_mov])}}"> <strong>{{ $q->numero}}</strong></a></td>
          <td>{{ $q->descrip}}</td>
          <td>{{ $q->concepto}}</td>
          <td>{{ $q->nombre}}</td>
          <td>{{ $q->tipo_mov}}</td>
          <td>{{ $q->monto }}</td>  
          <td>{{ $q->user}}</td>
        </tr> @endforeach
 
      </TBODY>
      <TFOOT>
         <th>Fecha</th>
          <th>N&uacute;mero</th>
          <th>Clasificador</th>
          <th>Concepto</th>
          <th>Beneficiario</th>
            <th>Tipo</th>
          <th>Monto</th>
          <th>Usuario</th>
      </TFOOT>
      </table>
	{{$movimiento->render()}}
  </div>
  <label>Usuario: </label><span> {{ Auth::user()->name }}</span>  </br> 
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
    <a ><button class="btn btn-primary btn-sm   pull-right" id="imprimir">Imprimir</button></a>
          <a href="{{route('showbanco',['id'=>$banco->idbanco])}}"  id="regresar"><button  class="btn btn-danger btn-sm btn-pull-left" >Regresar</button></a> 
                
	</div>
	</div>

         
  
 
         @push ('scripts')
<script>
$(document).ready(function(){
	$(function () {
    $("#ing").DataTable({
		"searching": true,
		"bPaginate": false,
		"bInfo":false,
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#ing_wrapper .col-md-6:eq(0)');

  });
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