@extends ('layouts.master')
@section ('contenido')
 <div class="row"><h2 class="page-header">Ayuda</h2></div>
<div>
    <section class="content">
        <div class="row">
            <div class="col-12" id="accordion">
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <div class="card-header">
                            <h4 class="card-title w-100">
								Registrar Cliente
                            </h4>
                        </div>
                    </a>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
							Desde este modulo se registraran los Clientes del sistema. 1) menu principal Archivo. 2) submenu clientes. 3) Boton nuevo.<div>
							<img src="{{asset('sistema/cliente.png')}}" alt="First slide"></div>
							Se debe indicar los datos que exige el formulario, si se tiene vendedores se debe seleccionar el vendedor para quien estara asignada dicho cliente.<div>
							<img src="{{asset('sistema/ncliente.png')}}" alt="First slide"></div>
							Luego se preciona click en el boton Guardar.
                        </div>
                    </div>
                </div>
				<div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                        <div class="card-header">
                            <h4 class="card-title w-100">
								Registrar Proveedor
                            </h4>
                        </div>
                    </a>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                              Desde este modulo se registraran los Proveedores del sistema. 1) menu principal Archivo. 2) submenu Proveedores. 3) Boton nuevo.<div>
							<img src="{{asset('sistema/proveedor.png')}}" alt="First slide"></div>
							Se debe indicar los datos que exige el formulario.<div>
							<img src="{{asset('sistema/nproveedor.png')}}" alt="First slide"></div>
							Luego se preciona click en el boton Guardar.
                        </div>
                    </div>
                </div>
				<div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapse3">
                        <div class="card-header">
                            <h4 class="card-title w-100">
								 Registrar Vendedor
                            </h4>
                        </div>
                    </a>
                    <div id="collapse3" class="collapse" data-parent="#accordion">
                        <div class="card-body">
							Desde este modulo se registraran los Vendedores del sistema. 1) menu principal Archivo. 2) submenu Vendedores. 3) Boton nuevo.<div>
							<img src="{{asset('sistema/vendedor.png')}}" alt="First slide"></div>
							Se debe indicar los datos que exige el formulario. el porcentaje de Comision aplica para las facturas emitidas por los clientes del vendedor y que estas esten cobradas en su totalidad, el calculo de la comision se basa en el monto total de la venta.<div>
							<img src="{{asset('sistema/nvendedor.png')}}" alt="First slide"></div>
							Luego se preciona click en el boton Guardar.
                        </div>
                    </div>
                </div>
				<div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapse4">
                        <div class="card-header">
                            <h4 class="card-title w-100">
								 Registrar Articulo
                            </h4>
                        </div>
                    </a>
                    <div id="collapse4" class="collapse" data-parent="#accordion">
                        <div class="card-body">
							Desde este modulo se registraran los articulo del inventario en el sistema. 1) menu principal Archivo. 2) submenu Articulos. 3) Boton nuevo.<div>
							<img src="{{asset('sistema/articulo.png')}}" alt="First slide"></div>
							Se debe indicar los datos que exige el formulario. el sistema valida que no exista el codigo indicado, si se posee imagen del articulo se debe indicar la ruta donde se encuentra. si el articulo no aplica para impuesto se debe indicar "cero" 0,el calculo para el precio se defino como precio=Costo+(costo*Impuesto)+utilidad. <div>
							<img src="{{asset('sistema/narticulo.png')}}" alt="First slide"></div>
							Luego se preciona click en el boton Guardar.
                        </div>
                    </div>
                </div>
				<div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapse5">
                        <div class="card-header">
                            <h4 class="card-title w-100">
								Registrar Compra
                            </h4>
                        </div>
                    </a>
                    <div id="collapse5" class="collapse" data-parent="#accordion">
                        <div class="card-body">
							Desde este modulo se registraran las Compras del sistema. 1) menu principal Ingresos y Egresos. 2) submenu Compras. 3) Boton nuevo.<div>
							<img src="{{asset('sistema/compra.png')}}" alt="First slide"></div>
							Se deben ingresar los datos que exige el formulario. primero se debe indicar el proveedor a quien se le va a procesar la compra,asi como el numero de documento y numero de control para identificar la compra en el sistema. luego empezamos a registrar los articulos incluidos en la factura de compra, desde el select que muestra la linea de articulos presente en el stock se selecciona el articulo, indicamos la cantidad y el precio de compra luego click en el boton " + " y procedemos a seleccionar el siguiente articulo. <div>
							<img src="{{asset('sistema/compra1.png')}}" alt="First slide"></div>
							Una vez registrados todos los articulos pasamos al desglose de pago de la factura.
							<img src="{{asset('sistema/compra2.png')}}" alt="First slide">
                        </div>
                    </div>
                </div>
				<div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapse6">
                        <div class="card-header">
                            <h4 class="card-title w-100">
								Registrar venta
                            </h4>
                        </div>
                    </a>
                    <div id="collapse6" class="collapse" data-parent="#accordion">
                        <div class="card-body">
							Desde este modulo se registraran las ventas en el sistema. 1) menu principal Ingresos y Egresos. 2) submenu Ventas. 3) Boton nuevo.<div>
							<img src="{{asset('sistema/venta.png')}}" alt="First slide"></div>
							Se deben ingresar los datos que exige el formulario. primero se debe indicar el cliente a quien se le va a procesar la venta. luego empezamos a registrar los articulos incluidos en la factura de Venta, desde el select que muestra la linea de articulos presente en el stock se selecciona el articulo, indicamos la cantidad y el precio de venta luego click en el boton " + " y procedemos a seleccionar el siguiente articulo. <div>
							<img src="{{asset('sistema/venta1.png')}}" alt="First slide"></div>
							Una vez registrados todos los articulos pasamos al desglose de pago de la factura.
							<img src="{{asset('sistema/venta2.png')}}" alt="First slide">
                        </div>
                    </div>
                </div>
				<div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapse7">
                        <div class="card-header">
                            <h4 class="card-title w-100">
								Registrar Ajuste de Inventario
                            </h4>
                        </div>
                    </a>
                    <div id="collapse7" class="collapse" data-parent="#accordion">
                        <div class="card-body">
							Desde este modulo se registraran las ventas en el sistema. 1) menu principal Ingresos y Egresos. 2) submenu Ajuste de Inventario. 3) Boton nuevo.<div>
							<img src="{{asset('sistema/ajuste.png')}}" alt="First slide"></div>
							Se deben ingresar los datos que exige el formulario. primero se debe indicar el concepto del ajuste y el responsable, luego empezamos a registrar los articulos afectados en el ejuste desde el select que muestra la linea de articulos, indicamos el tipo de ajuste cargo para incluir, descargo para excluir y luego  la cantidad. click en el boton agregar y procedemos a seleccionar el siguiente articulo. <div>
							<img src="{{asset('sistema/ajuste1.png')}}" alt="First slide"></div>
							Una vez registrados todos los articulos realizamos click en el boton guardar.
                        </div>
                    </div>
                </div>
			</div>
		</div>
</div>

@endsection