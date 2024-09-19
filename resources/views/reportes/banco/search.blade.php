<div class="card">
        <div class="card-header">
          <h3 class="card-title">Seleccione Fecha Para Consulta</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>	<form action="{{route('movimientos')}}" method="POST" enctype="multipart/form-data" >         
			{{csrf_field()}}
        <div class="card-body p-0"></br>
		<div class="row">
		
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="form-group">
	<div class="input-group">
		<label>Desde: </label><input type="date" class="form-control" name="searchText"  value="">
	</div>
</div>
</div>

	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="form-group">
	<div class="input-group">
<label>Hasta:</label>	 <input type="date" class="form-control" name="searchText2" value="">
	</div>
	</div>	
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<input type="hidden" name="id" value="<?php echo $ban; ?>" >
	<div class="form-group">
	<div class="input-group"></br>
	
		<label><button type="submit" class="btn btn-primary">consultar</button></label>
	
		</div>
	</div>
	</div>
	</div>
	</div>
		</form>
	</div>