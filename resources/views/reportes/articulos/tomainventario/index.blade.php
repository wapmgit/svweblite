@extends ('layouts.master')
<?php $mostrar=0; ?>
@section ('contenido')
<?php $mostrar=1; ?>
<div class="row">
		@include('reportes.articulos.tomainventario.search')
</div>
<?php $acum=0;$i=0;$deb=0;$che=0;$tra=0; $acumcnt=0; $acumcntrec=0;
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
			@include('reportes.articulos.tomainventario.empresa')
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
      <table width="100%">
        <thead style="background-color: #E6E6E6">
          
          <th>Articulo</th>
          <th>Und.</th>
          <th id="stk">Stock <i class="fa fa-fw fa-eye" title="Ocultar" id="ocultarstk"></th>
          <th id="kdx">Kardex <i class="fa fa-fw fa-eye" title="Ocultar" id="ocultarkd"></th>
          <th>Dif</th>
			
        </thead>
  
		<tbody>           
		@foreach ($lista as $q)   <?php $i++; ?>
		<tr <?php if (($i%2)==0){ echo "style='background-color: #D4E6F1 !important'";}?>>
			<td>{{$q->nombre}}</td>
			<td>{{$q->unidad}}</td>
			<td class="filastk">{{$q->stock}}</td>
			<td class="filaskd">
			<?php  if( $q->dif <> $q->stock ){?>
				{{$q->dif}} @php if($rol->crearajuste==1){ @endphp <a href="" data-target="#actstock-{{$q->idarticulo}}" data-toggle="modal"><i class="fa fa-fw fa-refresh"></i> </a>@php } @endphp
				<?php
			} else { echo $q->dif; }?></td>
			<td>_______</td>
        </tR>
		@include('reportes.articulos.tomainventario.modalactstock')  
		@endforeach	 
		</tbody>
		<tfoot>
		<Tfoot>
			
      </table></br>
    </div>


                     <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
					   <label>Usuario: </label>  {{ Auth::user()->name }}  
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button> 
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
  document.getElementById('kdx').style.display="none";
  document.getElementById('stk').style.display="none";
  window.print(); 
window.location="{{route('tomainventario')}}";
    });
	$('#ocultarstk').click(function(){
		document.getElementById('stk').style.display="none";
		document.getElementById('ocultarstk').style.display="none";
		$(".filastk").remove();
    });
	$('#ocultarkd').click(function(){
	document.getElementById('kdx').style.display="none";
	document.getElementById('ocultarkd').style.display="none";
	$(".filaskd").remove();
});


});

</script>

@endpush
@endsection