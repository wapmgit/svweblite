@extends ('layouts.master')
@section ('contenido')
<div class="row">
@include('almacen.articulo.empresa')
</div>
<div class="row" id="principal">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3> Articulos
		@if($rol->newarticulo==1)<a href="{{route('newarticulo')}}"><button class="btn btn-primary btn-sm">Nuevo</button></a>@endif</h3>
		@include('almacen.articulo.search')
	</div>
</div>
<div class="row"  id="imgcarga"  style="display:none">
<div  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">  
<img src="{{asset('dist/img/loading.gif')}}"  width="120"></div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="articulostable" class="table table-striped table-bordered table-condensed table-hover">
				<thead>			
					<th>Codigo</th>
					<th>Nombre</th>					
					<th>Grupo</th>
					<th>stock</th>
					<th>Imagen</th>
					<th>Precio $</th>
					<th>P. BS.</th>
					<th>Opciones</th>
				</thead>
               @foreach ($articulos as $cat)
				<tr>
					
					<td><small>{{ $cat->codigo}}</small></td>
					<td><a href="{{route('showarticulo',['id'=>$cat->idarticulo])}}"><i class="fa fa-fw fa-line-chart"></i> 
					</a><small>{{$cat->nombre}}</small></td>					
					<td><small><small>{{ $cat->categoria}}</small></small></td>
					<td><small>{{ $cat->stock}}</small></td>
						<td  > <?php if ($cat->imagen==""){?> <img src="{{ asset('/img/articulos/ninguna.jpg')}}" alt="{{$cat->nombre}}" height="20px" width="20px" class="img-thumbnail"><?php }else{ ?><img src="{{ asset('/img/articulos/'.$cat->imagen)}}" alt="{{$cat->nombre}}" height="15px" width="30px" class="img-thumbnail"><?php } ?> </td>
					<td><small><?php echo number_format($cat->precio1, 3,',','.'); ?></small></td>
					<td><small><?php echo number_format(($cat->precio1*$empresa->tc), 3,',','.'); ?></small></td>
					<td>
						
					@if($rol->editarticulo==1)	<a href="{{route('editarticulo',['id'=>$cat->idarticulo])}}"><button class="btn btn-warning btn-xs">Editar</button></a>@endif
						<a href="" data-target="#modal-delete-{{$cat->idarticulo}}" data-toggle="modal"><button class="btn btn-danger btn-xs">Alta</button></a>
						      <a href="{{route('kardexarticulo',['id'=>$cat->idarticulo])}}"><button class="btn btn-success btn-xs"> kardex</button></a>                                          
					</td>
				</tr>
				@include('almacen.articulo.modal')
				@endforeach
			</table>
		</div>
				{!!$articulos->links() !!}
	</div>
</div>
@push ('scripts')
<script>
$(document).ready(function(){
	const cuerpoDelDocumento = document.body;
	cuerpoDelDocumento.onload = miFuncion;
	function miFuncion() {
		// alert('La página terminó de cargar');
  	document.getElementById('imgcarga').style.display="none"; 
	document.getElementById('principal').style.display=""; 
	} 

	$("#btn").click(function(){
		document.getElementById('imgcarga').style.display=""; 
		document.getElementById('principal').style.display="none"; 
	})
	
	$(function () {
    $("#articulostable").DataTable({
		"searching": true,
		"bPaginate": false,
		"bInfo":false,
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#articulostable_wrapper .col-md-6:eq(0)');

  });
});
</script>
@endpush
@endsection