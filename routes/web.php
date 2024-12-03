<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\VendedoresController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\GastosController;
use App\Http\Controllers\AjustesController;
use App\Http\Controllers\CxcobrarController;
use App\Http\Controllers\CxpagarController;
use App\Http\Controllers\ReportesventasController;
use App\Http\Controllers\ReportescomprasController;
use App\Http\Controllers\ReportesarticulosController;
use App\Http\Controllers\ComisionesController;
use App\Http\Controllers\SistemaController;
use App\Http\Controllers\BancoController;
use App\Http\Controllers\CtasconController;
use App\Http\Controllers\MonedasController;
use App\Http\Controllers\EmpresasController;


Route::get('/', function () {
    return view('auth/login');
});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//empresas
Route::get('iempresas', [EmpresasController::class, 'index'])->name('iempresas');
Route::get('newempresa', [EmpresasController::class, 'create'])->name('newempresa');
Route::post('saveempresa', [EmpresasController::class, 'store'])->name('saveempresa');
//categorias
Route::get('icategoria', [CategoriaController::class, 'index'])->name('icategoria');
Route::get('newcategoria', [CategoriaController::class, 'create'])->name('newcategoria');
Route::post('guardarcategoria', [CategoriaController::class, 'store'])->name('guardarcategoria');
Route::get('editcategoria/{id}', [CategoriaController::class, 'edit'])->name('editcategoria');
Route::post('updatecategoria', [CategoriaController::class, 'update'])->name('updatecategoria');
Route::post('recalcularcategoria', [CategoriaController::class, 'recalcular'])->name('recalcularcategoria');
Route::get('showcategoria/{id}', [CategoriaController::class, 'show'])->name('showcategoria');
//articulos
Route::get('articulos', [ArticulosController::class, 'index'])->name('articulos');
Route::get('newarticulo', [ArticulosController::class, 'create'])->name('newarticulo');
Route::post('guardararticulo', [ArticulosController::class, 'store'])->name('guardararticulo');
Route::post('altaarticulo', [ArticulosController::class, 'destroy'])->name('altaarticulo');
Route::get('editarticulo/{id}', [ArticulosController::class, 'edit'])->name('editarticulo');
Route::get('kardexarticulo/{id}', [ArticulosController::class, 'kardex'])->name('kardexarticulo');
Route::get('showarticulo/{id}', [ArticulosController::class, 'show'])->name('showarticulo');
Route::post('updatearticulo', [ArticulosController::class, 'update'])->name('updatearticulo');
Route::post('validart', [ArticulosController::class, 'validar'])->name('validart');
//clientes
Route::get('clientes', [ClientesController::class, 'index'])->name('clientes');
Route::get('newcliente', [ClientesController::class, 'create'])->name('newcliente');
Route::post('guardarcliente', [ClientesController::class, 'store'])->name('guardarcliente');
Route::get('editcliente/{id}', [ClientesController::class, 'edit'])->name('editcliente');
Route::post('updatecliente', [ClientesController::class, 'update'])->name('updatecliente');
Route::get('notasadm', [ClientesController::class, 'notas'])->name('notasadm');
Route::get('edocuenta/{id}', [ClientesController::class, 'show'])->name('edocuenta');
 Route::get('aclientes', [ClientesController::class, 'reporteclientes'])->name('aclientes');
 Route::post('validarcliente', [ClientesController::class, 'validar'])->name('validarcliente');
 Route::post('recibodocumento', [ClientesController::class, 'detallerecibos'])->name('recibodocumento');
 Route::post('detallenc', [ClientesController::class, 'detallenc'])->name('detallenc');
 Route::post('loadclientescsv', [ClientesController::class, 'loadcsv'])->name('loadclientescsv');
  Route::get('repclientes', [ClientesController::class, 'repclientes'])->name('repclientes');
//proveedores
Route::get('proveedores', [ProveedoresController::class, 'index'])->name('proveedores');
Route::get('newproveedor', [ProveedoresController::class, 'create'])->name('newproveedor');
Route::post('guardarproveedor', [ProveedoresController::class, 'store'])->name('guardarproveedor');
Route::get('notasadmp', [ProveedoresController::class, 'notas'])->name('notasadmp');
Route::get('editproveedor/{id}', [ProveedoresController::class, 'edit'])->name('editproveedor');
Route::get('historico/{id}', [ProveedoresController::class, 'historico'])->name('historico');
Route::get('repproveedores', [ProveedoresController::class, 'repproveedores'])->name('repproveedores');
Route::post('updateproveedor', [ProveedoresController::class, 'update'])->name('updateproveedor');
Route::post('validarif', [ProveedoresController::class, 'validar'])->name('validarif');
//vendedores
Route::get('updatevendedor', [VendedoresController::class, 'update'])->name('updatevendedor');
Route::get('vendedores', [VendedoresController::class, 'index'])->name('vendedores');
Route::get('newvendedor', [VendedoresController::class, 'create'])->name('newvendedor');
Route::post('guardarvendedor', [VendedoresController::class, 'store'])->name('guardarvendedor');
Route::get('editarvendedor/{id}', [VendedoresController::class, 'edit'])->name('editarvendedor');
Route::get('clientesvendedor/{id}', [VendedoresController::class, 'show'])->name('clientesvendedor');

//compras 
Route::get('compras', [ComprasController::class, 'index'])->name('compras');
Route::get('newcompra', [ComprasController::class, 'create'])->name('newcompra');
Route::post('guardarcompra', [ComprasController::class, 'store'])->name('guardarcompra');
Route::get('showcompra/{id}', [ComprasController::class, 'show'])->name('showcompra');
Route::get('faccompra/{id}', [ComprasController::class, 'facturar'])->name('faccompra');
Route::get('etiquetascompra/{id}', [ComprasController::class, 'etiquetas'])->name('etiquetascompra');
Route::post('anularcompra', [ComprasController::class, 'destroy'])->name('anularcompra');
Route::post('almacenaproveedor', [ComprasController::class, 'almacena'])->name('almacenaproveedor');
Route::post('almacenaarticulo', [ComprasController::class, 'almacenaart'])->name('almacenaarticulo');
Route::post('validarif', [ComprasController::class, 'validar'])->name('validarif');
Route::post('validarcodigo', [ComprasController::class, 'validarcod'])->name('validarcodigo');
Route::post('anulareciboc', [ComprasController::class, 'anular'])->name('anulareciboc');
//ventas
Route::get('ventas', [VentasController::class, 'index'])->name('ventas');
Route::get('newventa', [VentasController::class, 'create'])->name('newventa');
Route::post('guardarventa', [VentasController::class, 'store'])->name('guardarventa');
Route::post('almacenacliente', [VentasController::class, 'almacena'])->name('almacenacliente');
Route::get('showdevolucion/{id}', [VentasController::class, 'showdevolucion'])->name('showdevolucion');
Route::post('devoluparcial', [VentasController::class, 'devoluparcial'])->name('devoluparcial');
Route::get('facventa/{id}', [VentasController::class, 'facturar'])->name('facventa');
Route::post('devolucion', [VentasController::class, 'devolucion'])->name('devolucion');
Route::post('refrescar', [VentasController::class, 'refrescar'])->name('refrescar');
Route::get('recibo/{id}', [ventasController::class, 'recibo'])->name('recibo');
Route::get('tcarta/{id}', [ventasController::class, 'show'])->name('tcarta');
Route::get('fbs/{id}', [ventasController::class, 'fbs'])->name('fbs');
Route::post('anulforma', [ventasController::class, 'anulforma'])->name('anulforma');
Route::post('anularecibo', [ventasController::class, 'anular'])->name('anularecibo');
Route::post('validarcventa', [ventasController::class, 'validar'])->name('validarcventa');
Route::post('ventacxc', [ventasController::class, 'vcxc'])->name('ventacxc');
Route::post('deletearticulo', [ventasController::class, 'deletearticulo'])->name('deletearticulo');
Route::post('addarticuloventa', [ventasController::class, 'addarticuloventa'])->name('addarticuloventa');
//gastos
Route::get('gastos', [GastosController::class, 'index'])->name('gastos');
Route::get('newgasto', [GastosController::class, 'create'])->name('newgasto');
Route::post('guardargasto', [GastosController::class, 'store'])->name('guardargasto');
Route::post('anulargasto/{id}', [GastosController::class, 'destroy'])->name('anulargasto');
Route::get('showgasto/{id}', [GastosController::class, 'show'])->name('showgasto');

//pedidos
Route::get('pedidos', [PedidosController::class, 'index'])->name('pedidos');
Route::get('newpedido', [PedidosController::class, 'create'])->name('newpedido');
Route::post('guardarpedido', [PedidosController::class, 'store'])->name('guardarpedido');
Route::get('showpedido/{id}', [PedidosController::class, 'show'])->name('showpedido');
Route::get('ajustepv/{id}', [PedidosController::class, 'ajustepv'])->name('ajustepv');
Route::get('ajustepedido', [PedidosController::class, 'ajuste'])->name('ajustepedido');
Route::post('facpedido', [PedidosController::class, 'facturar'])->name('facpedido');
Route::post('anularpedido', [PedidosController::class, 'destroy'])->name('anularpedido');
Route::get('reportepedido', [PedidosController::class, 'reporte'])->name('reportepedido');
Route::post('devolucionpedido', [PedidosController::class, 'devolucionpedido'])->name('devolucionpedido');
Route::post('addarticulo', [PedidosController::class, 'addart'])->name('addarticulo');
Route::get('pdescargados', [PedidosController::class, 'descargados'])->name('pdescargados');
Route::get('bajarpedido/{id}', [PedidosController::class, 'bajarpedido'])->name('bajarpedido');

//ajuste
Route::get('ajustes', [AjustesController::class, 'index'])->name('ajustes');
Route::get('newajuste', [AjustesController::class, 'create'])->name('newajuste');
Route::post('guardaajuste', [AjustesController::class, 'store'])->name('guardaajuste');
Route::get('showajuste/{id}', [AjustesController::class, 'show'])->name('showajuste');
Route::post('loadcsv', [AjustesController::class, 'loadcsv'])->name('loadcsv');
Route::get('etiquetasajuste/{id}', [AjustesController::class, 'etiquetas'])->name('etiquetasajuste');
//cxc
Route::get('cxc', [CxcobrarController::class, 'index'])->name('cxc');
Route::get('showcxc/{id}', [CxcobrarController::class, 'show'])->name('showcxc');
Route::get('shownd/{id}', [CxcobrarController::class, 'shownd'])->name('shownd');
Route::get('showret/{id}', [CxcobrarController::class, 'showret'])->name('showret');
Route::get('showdetalle/{id}', [CxcobrarController::class, 'detalle'])->name('showdetalle');
Route::post('abonarcxc', [CxcobrarController::class, 'store'])->name('abonarcxc');
Route::post('abonarnc', [CxcobrarController::class, 'aplicanc'])->name('abonarnc');
Route::get('pagocxc', [CxcobrarController::class, 'pagocxc'])->name('pagocxc');
Route::get('pagocxcnd', [CxcobrarController::class, 'pagond'])->name('pagocxcnd');
Route::get('pasarfl', [CxcobrarController::class, 'pasarfl'])->name('pasarfl');
Route::get('apliret', [CxcobrarController::class, 'apliret'])->name('apliret');
Route::get('multiplecxc', [CxcobrarController::class, 'multiple'])->name('multiplecxc');
//cxp
Route::get('cxp', [CxpagarController::class, 'index'])->name('cxp');
Route::get('showcxp/{id}', [CxpagarController::class, 'show'])->name('showcxp');
Route::get('shownota/{id}', [CxpagarController::class, 'shownota'])->name('shownota');
Route::post('abonarncp', [CxpagarController::class, 'aplicanc'])->name('abonarncp');
Route::get('showdetallecompra/{id}', [CxpagarController::class, 'detalle'])->name('showdetallecompra');
Route::post('abonarcxp', [CxpagarController::class, 'store'])->name('abonarcxp');
Route::get('retcompra', [CxpagarController::class, 'retencion'])->name('retcompra');
Route::get('retgasto', [CxpagarController::class, 'retenciongasto'])->name('retgasto');
Route::get('pagocxp', [CxpagarController::class, 'pago'])->name('pagocxp');
//informes de ventas
Route::get('resumenventas', [ReportesventasController::class, 'ventas'])->name('resumenventas');
Route::get('cortecaja', [ReportesventasController::class, 'corte'])->name('cortecaja');
Route::get('detalleingresos', [ReportesventasController::class, 'cobranza'])->name('detalleingresos');
Route::get('reportecxc', [ReportesventasController::class, 'cuentascobrar'])->name('reportecxc');
Route::get('reportecxcv', [ReportesventasController::class, 'cuentascobrarv'])->name('reportecxcv');
Route::get('utilidadventas', [ReportesventasController::class, 'utilidad'])->name('utilidadventas');
Route::get('ventasarticulo', [ReportesventasController::class, 'ventasarticulo'])->name('ventasarticulo');
Route::get('cajaventas', [ReportesventasController::class, 'cajaventas'])->name('cajaventas');
Route::get('ventacaja', [ReportesventasController::class, 'ventacaja'])->name('ventacaja');
Route::get('libroventas', [ReportesventasController::class, 'librov'])->name('libroventas');
Route::get('correlativof', [ReportesventasController::class, 'correlativo'])->name('correlativof');
//informes compras
Route::get('resumencompras', [ReportescomprasController::class, 'compras'])->name('resumencompras');
Route::get('resumengastos', [ReportescomprasController::class, 'gastos'])->name('resumengastos');
Route::get('retenciones', [ReportescomprasController::class, 'listaretenciones'])->name('retenciones');
Route::post('editretencion', [ReportescomprasController::class, 'ajustecorre'])->name('editretencion');
Route::post('anularetencion', [ReportescomprasController::class, 'destroyretencion'])->name('anularetencion');
Route::get('printretencion/{id}', [ReportescomprasController::class, 'verretencion'])->name('printretencion');
Route::get('reportecxp', [ReportescomprasController::class, 'cuentaspagar'])->name('reportecxp');
Route::get('detallegresos', [ReportescomprasController::class, 'pagos'])->name('detallegresos');
Route::get('comprasarticulo', [ReportescomprasController::class, 'comprasarticulo'])->name('comprasarticulo');
Route::get('librocompras', [ReportescomprasController::class, 'libroc'])->name('librocompras');
// informes articulos
Route::get('reportearticulos', [ReportesarticulosController::class, 'articulos'])->name('reportearticulos');
Route::get('valorizado', [ReportesarticulosController::class, 'valorizado'])->name('valorizado');
Route::get('listaprecios', [ReportesarticulosController::class, 'listaprecio'])->name('listaprecios');
Route::get('stockcero', [ReportesarticulosController::class, 'cero'])->name('stockcero');
Route::get('catalogo', [ReportesarticulosController::class, 'catalogo'])->name('catalogo');
Route::get('resumen', [ReportesarticulosController::class, 'resumen'])->name('resumen');
//banco
Route::get('bancos', [BancoController::class, 'index'])->name('bancos');
Route::get('editbanco/{id}', [BancoController::class, 'edit'])->name('editbanco');
Route::get('updatebanco', [BancoController::class, 'update'])->name('updatebanco');
Route::post('almacenarbanco', [BancoController::class, 'store'])->name('almacenarbanco');
Route::post('adddebito', [BancoController::class, 'adddebito'])->name('adddebito');
Route::post('addcredito', [BancoController::class, 'addcredito'])->name('addcredito');
Route::post('addtraspaso', [BancoController::class, 'addtraspaso'])->name('addtraspaso');
Route::post('movimientos', [BancoController::class, 'movimientos'])->name('movimientos');
Route::post('movcuentas', [BancoController::class, 'cuentas'])->name('movcuentas');
Route::get('showbanco/{id}', [BancoController::class, 'show'])->name('showbanco');
Route::get('detallebanco/{id}', [BancoController::class, 'detalle'])->name('detallebanco');
Route::get('consultaban/{id}', [BancoController::class, 'consulta'])->name('consultaban');
Route::get('showrecibo/{id}', [BancoController::class, 'recibo'])->name('showrecibo');
Route::post('delmov', [BancoController::class, 'delete'])->name('delmov');
Route::get('resumenbancos', [BancoController::class, 'resumen'])->name('resumenbancos');

//cuentasclasificaion
Route::get('ctascon', [CtasconController::class, 'index'])->name('ctascon');
Route::get('newcta', [CtasconController::class, 'create'])->name('newcta');
Route::post('addcta', [CtasconController::class, 'store'])->name('addcta');
Route::get('editca/{id}', [CtasconController::class, 'edit'])->name('editca');
Route::post('updatecta', [CtasconController::class, 'update'])->name('updatecta');
 //comisiones
Route::get('comisiones', [ComisionesController::class, 'index'])->name('comisiones');
Route::get('detallecomision/{id}', [ComisionesController::class, 'detalle'])->name('detallecomision');
Route::get('detallecomisionp/{id}', [ComisionesController::class, 'detallepagadas'])->name('detallecomisionp');
Route::get('showcomision/{id}', [ComisionesController::class, 'show'])->name('showcomision');
Route::post('guardarcomision', [ComisionesController::class, 'store'])->name('guardarcomision');
Route::get('comisionxp', [ComisionesController::class, 'comixpagar'])->name('comisionxp');
Route::post('pagarcomision', [ComisionesController::class, 'pagar'])->name('pagarcomision');
Route::get('recibocomision/{id}', [ComisionesController::class, 'recibo'])->name('recibocomision');
Route::get('listarecibos/{id}', [ComisionesController::class, 'lista'])->name('listarecibos');
Route::get('comisionespagadas', [ComisionesController::class, 'pagadas'])->name('comisionespagadas');
// sistema
Route::get('tasas', [SistemaController::class, 'acttasas'])->name('tasas');
Route::post('updatetasas', [SistemaController::class, 'update'])->name('updatetasas');
Route::post('updateuser', [SistemaController::class, 'updtuser'])->name('updateuser');
Route::post('updatepass', [SistemaController::class, 'updatepass'])->name('updatepass');
Route::get('showusuarios', [SistemaController::class, 'usuarios'])->name('showusuarios');
Route::get('ayuda', [SistemaController::class, 'ayuda'])->name('ayuda');
Route::get('calc', [SistemaController::class, 'calculador'])->name('calc');
Route::get('bloc', [SistemaController::class, 'blocn'])->name('bloc');
Route::get('acercade', [SistemaController::class, 'info'])->name('acercade');
Route::get('sininternet', [SistemaController::class, 'sininternet'])->name('sininternet');
Route::get('empresa', [SistemaController::class, 'empresa'])->name('empresa');
Route::post('updatempresa', [SistemaController::class, 'updatempresa'])->name('updatempresa');
// monedas
Route::get('monedas', [MonedasController::class, 'index'])->name('monedas');
Route::get('newmoneda', [MonedasController::class, 'create'])->name('newmoneda');
Route::post('savemoneda', [MonedasController::class, 'store'])->name('savemoneda');
Route::get('editmoneda/{id}', [MonedasController::class, 'edit'])->name('editmoneda');
Route::post('updatemoneda', [MonedasController::class, 'update'])->name('updatemoneda');
