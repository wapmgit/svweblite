
@extends ('layouts.admin')
@section ('contenido') 
<div class="row">
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
    {!!Form::open(array('url'=>'/bancos/editclasificacion','method'=>'POST','autocomplete'=>'off','id'=>'formulariocliente','files'=>'true'))!!}
 {{Form::token()}}

        <button type="button" class="close" data-dismiss="modal" 
        aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h5 class="">Editar Cuenta de Clasificacion  </h5>
      </div>
    </div>

        <div class="row">
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
             <div class="form-group">
                  <label for="nombre">Codigo</label>
              <input type="text" name="codigo" id="codcta" required value="{{ $cla->codigo}}" class="form-control" placeholder="codigo...">
            </div>
          </div> 
            <div class="col-lg-16col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
            <label for="saco">Tipo</label>
                             <select name="tipo" id="ptipo" class ="form-control">
                               <option value="{{$cla->tipo}}">Seleccione</option>
                              <option value="1">Ingreso</option> 
                              <option value="2">Egreso</option> 
                              <option value="3">Ambos</option> 
                              </select>
           
            </div>
        </div>

          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
             <div class="form-group">
                  <label for="nombre">Descripcion</label>
              <input type="text" name="direccion" id="direccion" required value="{{ $cla->descrip}}" class="form-control" placeholder="Direcion...">
              <input type="hidden" name="id"  value="{{ $cla->idcod}}" class="form-control" >
            </div>
          </div>                
        </div>  <!-- del row -->

  
 
      <div class="modal-success">
      <div class="modal-footer">
       <div class="form-group">
       <a href="/bancos/cuentasclasificacion"> <button type="button" class="btn btn-default btn-outline pull-left" data-dismiss="modal">Cerrar</button></a>
        <button type="submit" id="btn_ncliente" class="btn btn-primary btn-outline pull-right">Confirmar</button>
        </div>
      </div>

{!!Form::close()!!} 
      

</div>

@endsection