@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar datos de: {{ $datos->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($datos,['method'=>'PATCH','route'=>['bancos.terceros.update',$datos->id_persona],'files'=>'true'])!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" class="form-control" value="{{$datos->nombre}}" placeholder="Nombre...">
            </div>
            <div class="form-group">
            	<label for="cedula">Cedula</label>
            	<input type="text" name="cedula" class="form-control" value="{{$datos->rif}}" placeholder="cedula...">
            </div>
             <div class="form-group">
            	<label for="telefono">Telefono</label>
            	<input type="text" name="telefono" class="form-control" value="{{$datos->telefono}}" placeholder="telefono...">
            </div>
              <div class="form-group">
            <label for="telefono">Direccion</label>
                <input type="text" name="direccion" class="form-control" value="{{$datos->direccion}}" placeholder="direccion...">
           </div>

            <div class="form-group">
			     <input type="hidden" name="id_persona" class="form-control" value="{{$datos->id_persona}}" >
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection