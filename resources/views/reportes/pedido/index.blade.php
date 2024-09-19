@extends ('layouts.master')
@section ('contenido')
<div class="row" id="divsearch">
		@include('reportes.pedido.search')
</div>
<?php $acum=0;$tcobranza=0;$deb=0;$che=0;$tra=$tventas=$tingnd=0;$acumnc=0; $mostrar=0; 
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
			  @include('reportes.pedido.empresa')
              </div>
                
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  
    <span ><strong>Vendedor -></strong> <?php echo $searchText; $acump=0;?>    </span>
  </div>
  
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    <table width="100%">
      <thead style="background-color: #E6E6E6" >
	 <?php  if($valida==1){?>  <th class="ocultar">Edit.</th><?php }?>
	  <th id="campo">Articulo</th>
	  <th>Cantidad Pedido</th>
		<th>Stock</th>

		</thead>
         @foreach ($ventas as $cob)	 <?php $acump=$acump+$cob->cantidad; ?>	 
        <tr>
		<?php  if($valida==1){?><td class="ocultar"> 
		@if($rol->editpedido==1)
		<a href="{{route('ajustepv',['id'=>$cob->idarticulo.'_'.$cob->vendedor])}}" class="ocultar"><i class="fa fa-fw fa-edit"></i></a>@else <i class="fa fa-fw fa-lock"></i> @endif	</td><?php } ?>
		
		<td>{{$cob->articulo}}</td>
		<td>{{$cob->cantidad}}</td>
	
		<td>{{$cob->stock}}</td>
        </tr>
		@endforeach  
		<tr style="background-color: #E6E6E6">
		<?php  if($valida==1){?> <td class="ocultar"></td> <?php } ?>
		<td>Total Unidades </td><td><?php echo $acump; ?></td><td></td></tr> 		
		   </table>
	  </div>       
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 		       
                     <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
					   <label>Usuario: </label>  {{ Auth::user()->name }}  
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button> 
                    </div>
                </div>                  
</div><!-- /.box-body -->
</div><!-- /.box -->
             
</div>
@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
$(".ocultar").remove();
  document.getElementById('imprimir').style.display="none";
  document.getElementById('divsearch').style.display="none";
  window.print(); 
  window.location="{{route('reportepedido')}}";
    });

});

</script>

@endpush
@endsection