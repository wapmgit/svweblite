     <form action="{{route('articulos')}}" method="GET" enctype="multipart/form-data" >         
        {{csrf_field()}}
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control  form-control-sm" name="searchText" placeholder="Indique Nombre del articulo..." value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-info btn-sm">Buscar</button>
		</span>
	</div>
</div>

</form>