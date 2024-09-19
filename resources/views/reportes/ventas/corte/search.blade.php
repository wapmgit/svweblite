
<div class="card">
        <div class="card-header">
          <h3 class="card-title">Indique la fecha para la consulta</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>	<form action="{{route('cortecaja')}}" method="GET" enctype="multipart/form-data" >         
			{{csrf_field()}}
        <div class="card-body p-0"></br>
		<div class="row">
		
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
				<div class="form-group">
				<div class="input-group">
					<input type="date" class="form-control" name="searchText"  value="{{$searchText}}">
				</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
				<div class="form-group">
				<div class="input-group">
					<input type="date" class="form-control" name="searchText2" value="{{$searchText2}}">
				</div>
				</div>	
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
				<div class="form-group">
				<div class="input-group">
					<select name="usuario" class="form-control selectpicker" data-live-search="true">
                            <option value="0">Seleccione..</option> 
						   @foreach ($usuario as $per)
                           <option value="{{$per -> name}}">{{$per -> name}}</option> 
                           @endforeach
					</select>
				</div>
				</div>		
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
				<div class="form-group">
				<div class="input-group">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-primary btn-sm">consultar</button>
					</span>
				</div>
				</div>
			</div>
	</div>
	</div>
		</form>
	</div>