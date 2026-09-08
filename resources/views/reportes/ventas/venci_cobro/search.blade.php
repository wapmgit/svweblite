
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
        </div>	<form action="{{route('reportecxcvencida')}}" method="GET" enctype="multipart/form-data" >         
			{{csrf_field()}}
        <div class="card-body p-0"></br>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	<div class="form-group">
           <div class="form-group">
		<select name="opcion" id="filtro" class="form-control">
                            <option value="0">Filtrar por:</option> 
                            <option value="1">Vendedor</option> 
                            <option value="2">Cliente</option> 
                        </select>
           </div>

	</div>	
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="divopt">
		<div id="divend" style="display:none">
			<div class="form-group">
				<div class="input-group">
				<label>Vendedor: </label>
					<select name="vendedor" class="form-control selectpicker" data-live-search="true">
						   @foreach ($vendedores as $per)
                           <option value="{{$per -> id_vendedor}}">{{$per -> nombre}}</option> 
                           @endforeach
					</select>
				</div>
			</div>	
		</div>
		<div id="divcli" style="display:none">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-btn">
						<select name="cliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
                            <option value="0">Seleccione..</option> 
						   @foreach ($clientes as $cli)
                           <option value="{{$cli -> id_cliente}}">{{$cli -> nombre}}</option> 
                           @endforeach
                        </select>
					</span>
				</div>
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