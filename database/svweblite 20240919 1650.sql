-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.7.33


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema svweblite
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ svweblite;
USE svweblite;

--
-- Table structure for table `svweblite`.`ajustes`
--

DROP TABLE IF EXISTS `ajustes`;
CREATE TABLE `ajustes` (
  `idempresa` int(3) DEFAULT NULL,
  `idajuste` int(8) NOT NULL AUTO_INCREMENT,
  `controlajuste` int(11) DEFAULT NULL,
  `concepto` varchar(80) NOT NULL,
  `responsable` varchar(30) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `monto` float(11,2) NOT NULL,
  PRIMARY KEY (`idajuste`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`ajustes`
--

/*!40000 ALTER TABLE `ajustes` DISABLE KEYS */;
INSERT INTO `ajustes` (`idempresa`,`idajuste`,`controlajuste`,`concepto`,`responsable`,`fecha_hora`,`monto`) VALUES 
 (2,1,1,'fgsdfgsdf','gsdfgdfg','2024-09-10 15:07:43',15.00),
 (1,2,1,'ajuste otra','nks','2024-09-10 15:39:30',5.90),
 (1,3,2,'ajuste','nks','2024-09-10 15:41:49',10.59),
 (4,4,1,'ajuste','kelyy','2024-09-12 18:36:38',135.00),
 (3,5,1,'ajuset','chato','2024-09-12 18:40:50',116.50);
/*!40000 ALTER TABLE `ajustes` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`articulos`
--

DROP TABLE IF EXISTS `articulos`;
CREATE TABLE `articulos` (
  `idempresa` int(3) DEFAULT NULL,
  `idarticulo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcategoria` int(5) NOT NULL,
  `codigo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` double(9,3) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unidad` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volumen` float(9,3) DEFAULT '0.000',
  `grados` float(9,3) DEFAULT '0.000',
  `imagen` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ninguna.jpg',
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `utilidad` double(9,2) NOT NULL,
  `precio1` double(9,2) NOT NULL,
  `precio2` double(9,2) NOT NULL DEFAULT '0.00',
  `precio_t` double(9,3) NOT NULL DEFAULT '0.000',
  `util2` double(9,3) NOT NULL DEFAULT '0.000',
  `costo` double(9,3) NOT NULL,
  `costo_t` double(9,3) NOT NULL DEFAULT '0.000',
  `iva` int(2) NOT NULL,
  `serial` int(1) DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idarticulo`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `svweblite`.`articulos`
--

/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` (`idempresa`,`idarticulo`,`idcategoria`,`codigo`,`nombre`,`stock`,`descripcion`,`unidad`,`volumen`,`grados`,`imagen`,`estado`,`utilidad`,`precio1`,`precio2`,`precio_t`,`util2`,`costo`,`costo_t`,`iva`,`serial`,`remember_token`,`created_at`,`updated_at`) VALUES 
 (2,1,1,'0010000001','CAFE SANTA MARTA',106.000,NULL,'und',0.000,0.000,'ninguna.jpg','Activo',25.00,17.40,13.92,623.094,0.000,12.000,429.720,16,0,NULL,'2024-09-10 10:43:05','2024-09-10 10:50:35'),
 (1,2,2,'0020000001','ARROZ SANTANA',11.000,NULL,'und',0.000,0.000,'ninguna.jpg','Activo',25.00,1.88,0.00,67.150,0.000,1.500,53.720,0,0,NULL,'2024-09-10 11:00:54',NULL),
 (2,3,1,'0010000002','CHIMO',7.000,NULL,NULL,0.000,0.000,'ninguna.jpg','Activo',16.00,1.16,0.00,41.540,0.000,1.000,35.810,0,0,NULL,NULL,NULL),
 (2,4,1,'0010000004','HARINA DE MAIZ',8.000,NULL,NULL,0.000,0.000,'ninguna.jpg','Activo',20.00,1.80,0.00,0.000,0.000,1.500,0.000,0,0,NULL,NULL,NULL),
 (1,5,2,'0020000003','TABACO',10.000,NULL,NULL,0.000,0.000,'ninguna.jpg','Activo',20.00,0.71,0.00,0.000,0.000,0.590,0.000,0,0,NULL,NULL,NULL),
 (1,6,2,'0020000006','GALLETA MARIA',9.000,NULL,NULL,0.000,0.000,'ninguna.jpg','Activo',20.00,1.20,0.00,0.000,0.000,1.000,0.000,0,0,NULL,NULL,NULL);
INSERT INTO `articulos` (`idempresa`,`idarticulo`,`idcategoria`,`codigo`,`nombre`,`stock`,`descripcion`,`unidad`,`volumen`,`grados`,`imagen`,`estado`,`utilidad`,`precio1`,`precio2`,`precio_t`,`util2`,`costo`,`costo_t`,`iva`,`serial`,`remember_token`,`created_at`,`updated_at`) VALUES 
 (4,7,4,'0040000001','CATATUMBO',10.000,NULL,'und',0.000,0.000,'ninguna.jpg','Activo',20.00,3.00,0.00,0.000,0.000,2.500,0.000,0,0,NULL,'2024-09-12 18:01:51',NULL),
 (3,8,3,'0030000001','SARDINAS',30.000,NULL,'und',0.000,0.000,'ninguna.jpg','Activo',16.00,1.74,0.00,0.000,0.000,1.500,0.000,0,0,NULL,'2024-09-12 18:35:08',NULL),
 (4,9,4,'0040000008','CAFE',49.000,NULL,NULL,0.000,0.000,'ninguna.jpg','Activo',20.00,2.64,0.00,0.000,0.000,2.200,0.000,0,0,NULL,NULL,NULL),
 (3,10,3,'0030000009','HARINA PAN 1KG',15.000,NULL,NULL,0.000,0.000,'ninguna.jpg','Activo',20.00,1.32,0.00,0.000,0.000,1.100,0.000,0,0,NULL,NULL,NULL),
 (3,11,3,'0030000010','CAFE DON PANCHO',22.000,NULL,NULL,0.000,0.000,'ninguna.jpg','Activo',25.00,3.62,0.00,0.000,0.000,2.500,0.000,16,0,NULL,NULL,NULL),
 (5,12,5,'0164348463784','PASTA',13.000,NULL,'Bulto',0.000,0.000,'17264394033917798044266691859053.jpg','Activo',3.00,38.93,0.00,1497.402,0.000,36.000,1384.560,5,0,NULL,'2024-09-15 23:01:37',NULL);
INSERT INTO `articulos` (`idempresa`,`idarticulo`,`idcategoria`,`codigo`,`nombre`,`stock`,`descripcion`,`unidad`,`volumen`,`grados`,`imagen`,`estado`,`utilidad`,`precio1`,`precio2`,`precio_t`,`util2`,`costo`,`costo_t`,`iva`,`serial`,`remember_token`,`created_at`,`updated_at`) VALUES 
 (5,13,5,'84375484','ARROZ',54.000,NULL,NULL,0.000,0.000,'ninguna.jpg','Activo',3.00,12.98,0.00,499.134,0.000,12.000,461.520,5,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`bancos`
--

DROP TABLE IF EXISTS `bancos`;
CREATE TABLE `bancos` (
  `idbanco` int(5) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `cuentaban` varchar(25) DEFAULT NULL,
  `tipocta` varchar(20) DEFAULT NULL,
  `titular` varchar(50) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idbanco`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`bancos`
--

/*!40000 ALTER TABLE `bancos` DISABLE KEYS */;
/*!40000 ALTER TABLE `bancos` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `idempresa` int(3) DEFAULT NULL,
  `idcategoria` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `condicion` int(2) NOT NULL,
  `licor` int(2) DEFAULT '0',
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`categoria`
--

/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`idempresa`,`idcategoria`,`nombre`,`descripcion`,`condicion`,`licor`) VALUES 
 (2,1,'COSMETICOS','cosmeticos',1,0),
 (1,2,'VIVERES','viveres',1,0),
 (4,3,'VIVERES','viveres chato',1,0),
 (4,4,'GENERAL','todos',1,0),
 (5,5,'HOLA','Gente',1,0);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `idempresa` int(2) DEFAULT NULL,
  `id_cliente` int(8) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `rif` varchar(20) DEFAULT NULL,
  `telefono` varchar(30) NOT NULL,
  `licencia` varchar(10) DEFAULT NULL,
  `status` varchar(3) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `tipo_cliente` int(1) NOT NULL,
  `diascredito` int(3) DEFAULT '0',
  `tipo_precio` int(1) NOT NULL,
  `retencion` int(3) DEFAULT '0',
  `vendedor` int(5) DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `lastfact` date DEFAULT NULL,
  `tipo` varchar(2) DEFAULT 'C',
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`clientes`
--

/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`idempresa`,`id_cliente`,`nombre`,`cedula`,`rif`,`telefono`,`licencia`,`status`,`direccion`,`tipo_cliente`,`diascredito`,`tipo_precio`,`retencion`,`vendedor`,`creado`,`lastfact`,`tipo`) VALUES 
 (2,1,'LUIS ANTONIO CASADIEGO','V546465','V546465654','(654) 135-4313',NULL,'A','roemro lkjlk',1,NULL,1,0,1,'2024-09-09','2024-09-10','C'),
 (1,2,'JAZMIN PEREZ','V5465456','V5465456','(656) 465-4535',NULL,'A','merida',1,NULL,1,0,3,'2024-09-10','2024-09-10','C'),
 (2,3,'JOSE ARMANDO MOLINA','V8745783','V8745783-9','(685) 465-4686',NULL,'A','san juuabn',1,NULL,1,0,1,'2024-09-10','2024-09-10','C'),
 (2,4,'MARIA PUERTA','V645161','V645161','(463) 131-3213',NULL,'A','merisda',0,5,1,0,1,'2024-09-10','2024-09-10','C'),
 (2,5,'YOSSIER','V64131','V64131','(165) 431-3535',NULL,'A','merdia',0,5,1,0,4,'2024-09-10','2024-09-10','C'),
 (1,6,'JUAN MOLINA','V16604674','V16604674','(023) 153-2154',NULL,'A','santa cruz de mora',0,5,1,0,3,'2024-09-11','2024-09-11','C'),
 (4,7,'SDFG','V13215465','V13215465','(213) 213-2132',NULL,'A','sdfgsdfg',0,0,1,0,5,'2024-09-12','2024-09-12','C'),
 (5,8,'LUZ CABELLOS','19834486','222222222','(042) 616-9645',NULL,'A','Paiva',1,NULL,1,0,7,'2024-09-15','2024-09-15','C');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`comisiones`
--

DROP TABLE IF EXISTS `comisiones`;
CREATE TABLE `comisiones` (
  `id_comision` int(5) NOT NULL AUTO_INCREMENT,
  `id_vendedor` int(5) DEFAULT NULL,
  `montoventas` float(9,3) DEFAULT NULL,
  `montocomision` float(9,3) DEFAULT NULL,
  `pendiente` float(9,3) DEFAULT '0.000',
  `fecha` date DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_comision`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`comisiones`
--

/*!40000 ALTER TABLE `comisiones` DISABLE KEYS */;
/*!40000 ALTER TABLE `comisiones` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`compras`
--

DROP TABLE IF EXISTS `compras`;
CREATE TABLE `compras` (
  `idempresa` int(3) DEFAULT NULL,
  `idcompra` int(8) NOT NULL AUTO_INCREMENT,
  `controlcompra` int(11) DEFAULT NULL,
  `idproveedor` int(8) NOT NULL,
  `tipo_comprobante` varchar(20) NOT NULL,
  `serie_comprobante` varchar(20) NOT NULL,
  `num_comprobante` varchar(20) NOT NULL,
  `fecha_hora` date NOT NULL,
  `emision` date DEFAULT NULL,
  `impuesto` int(2) NOT NULL,
  `total` float(11,2) NOT NULL,
  `base` float(9,3) DEFAULT NULL,
  `miva` float(9,3) DEFAULT NULL,
  `exento` float(9,3) DEFAULT NULL,
  `saldo` float(11,2) NOT NULL,
  `retenido` float(9,3) DEFAULT '0.000',
  `condicion` varchar(15) NOT NULL,
  `estatus` varchar(15) NOT NULL DEFAULT '0',
  `tasa` float(9,3) DEFAULT NULL,
  `user` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idcompra`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`compras`
--

/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` (`idempresa`,`idcompra`,`controlcompra`,`idproveedor`,`tipo_comprobante`,`serie_comprobante`,`num_comprobante`,`fecha_hora`,`emision`,`impuesto`,`total`,`base`,`miva`,`exento`,`saldo`,`retenido`,`condicion`,`estatus`,`tasa`,`user`) VALUES 
 (2,1,1,1,'FAC','3645','3456','2024-09-10','2024-09-10',16,1392.00,1200.000,192.000,0.000,0.00,0.000,'Contado','0',35.810,'Nks'),
 (2,2,2,2,'FAC','34654','3456','2024-09-10','2024-09-10',16,139.20,120.000,19.200,0.000,16.70,0.000,'Credito','0',35.810,'Nks'),
 (1,3,1,3,'FAC','3563546','3456','2024-09-10','2024-09-10',16,18.00,0.000,0.000,18.000,0.00,0.000,'Contado','0',35.810,'Administracion'),
 (2,4,3,5,'FAC','87987','65468','2024-09-10','2024-09-10',16,10.00,0.000,0.000,10.000,0.00,0.000,'Credito','0',35.810,'Nks'),
 (5,5,1,6,'FAC','857648455','45813438346','2024-09-15','2024-09-15',16,1267.35,1207.000,60.350,0.000,0.00,0.000,'Contado','0',38.460,'chiki');
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`comprobante`
--

DROP TABLE IF EXISTS `comprobante`;
CREATE TABLE `comprobante` (
  `idrecibo` int(8) NOT NULL AUTO_INCREMENT,
  `idcompra` int(8) NOT NULL DEFAULT '0',
  `idgasto` int(5) DEFAULT '0',
  `idnota` int(5) DEFAULT '0',
  `monto` float(11,2) NOT NULL,
  `idpago` int(3) NOT NULL,
  `idbanco` varchar(20) NOT NULL,
  `id_banco` int(5) DEFAULT '0',
  `recibido` float(12,3) NOT NULL,
  `tasab` float(11,2) NOT NULL,
  `tasap` float(9,3) NOT NULL,
  `referencia` varchar(20) DEFAULT NULL,
  `aux` varchar(15) DEFAULT NULL,
  `fecha_comp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idrecibo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`comprobante`
--

/*!40000 ALTER TABLE `comprobante` DISABLE KEYS */;
INSERT INTO `comprobante` (`idrecibo`,`idcompra`,`idgasto`,`idnota`,`monto`,`idpago`,`idbanco`,`id_banco`,`recibido`,`tasab`,`tasap`,`referencia`,`aux`,`fecha_comp`) VALUES 
 (1,1,0,0,1392.00,1,'Dolares',0,1392.000,35.81,6000.000,NULL,'0.00','2024-09-10 11:15:28'),
 (2,3,0,0,18.00,8,'Pto Movistar',0,432.000,35.81,6000.000,'Tc: 24','0.00','2024-09-10 11:59:16'),
 (3,2,0,0,100.00,1,'Dolares',0,100.000,35.81,6000.000,NULL,'39.20','2024-09-10 16:42:52'),
 (4,2,0,0,22.50,12,'EURO',0,15.000,35.81,6000.000,'Tc: 1.5','16.70','2024-09-10 16:43:23'),
 (5,4,0,0,10.00,1,'Dolares',0,10.000,0.00,0.000,'','0','2024-09-10 16:56:03'),
 (6,5,0,0,1267.35,19,'Bs efectivo',0,48742.281,38.46,4000.000,'Tc: 38.46','0.00','2024-09-15 23:15:37');
/*!40000 ALTER TABLE `comprobante` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`ctascon`
--

DROP TABLE IF EXISTS `ctascon`;
CREATE TABLE `ctascon` (
  `idcod` int(5) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) CHARACTER SET utf8 NOT NULL,
  `descrip` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tipo` double(2,0) NOT NULL DEFAULT '0',
  `inactiva` double(1,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `idcod` (`idcod`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`ctascon`
--

/*!40000 ALTER TABLE `ctascon` DISABLE KEYS */;
INSERT INTO `ctascon` (`idcod`,`codigo`,`descrip`,`tipo`,`inactiva`) VALUES 
 (1,'0001000100','Ingreso Ventas ',1,0),
 (2,'0001002122','Ingreso Cobranza',1,0),
 (6,'001-165456-4545','PRESTAMO CLIENTES',2,0),
 (3,'00120121020','Pago a Proveedores',2,0),
 (8,'00200010002','Pago Comisiones',2,0),
 (10,'00213','NOTA ADMINISTRATIVA(C/D)',2,0),
 (4,'00213452124','EGRESO GASTOS',2,0),
 (7,'0021355','EGRESO PAGO COMPRAS',2,0),
 (9,'00213556','INGRESO NOTA ADMINISTRATIVA',1,0),
 (11,'00256687','OTROS INGRESOS',1,0),
 (5,'01525451','Transferencias Bancos',3,0);
/*!40000 ALTER TABLE `ctascon` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`datacsv`
--

DROP TABLE IF EXISTS `datacsv`;
CREATE TABLE `datacsv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idarticulo` int(5) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `costo` float(9,3) DEFAULT NULL,
  `cantidad` float(9,3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`datacsv`
--

/*!40000 ALTER TABLE `datacsv` DISABLE KEYS */;
/*!40000 ALTER TABLE `datacsv` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`detalle_ajustes`
--

DROP TABLE IF EXISTS `detalle_ajustes`;
CREATE TABLE `detalle_ajustes` (
  `iddetalle_ajuste` int(5) NOT NULL AUTO_INCREMENT,
  `idajuste` int(8) NOT NULL,
  `idarticulo` int(8) NOT NULL,
  `tipo_ajuste` varchar(15) NOT NULL,
  `cantidad` float(9,3) NOT NULL,
  `costo` float(11,2) NOT NULL,
  `valorizado` float(11,2) NOT NULL,
  PRIMARY KEY (`iddetalle_ajuste`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`detalle_ajustes`
--

/*!40000 ALTER TABLE `detalle_ajustes` DISABLE KEYS */;
INSERT INTO `detalle_ajustes` (`iddetalle_ajuste`,`idajuste`,`idarticulo`,`tipo_ajuste`,`cantidad`,`costo`,`valorizado`) VALUES 
 (1,1,4,'Cargo',10.000,1.50,15.00),
 (2,2,5,'Cargo',10.000,0.59,5.90),
 (3,3,5,'Cargo',1.000,0.59,0.59),
 (4,3,6,'Cargo',10.000,1.00,10.00),
 (5,4,7,'Cargo',10.000,2.50,25.00),
 (6,4,9,'Cargo',50.000,2.20,110.00),
 (7,5,8,'Cargo',30.000,1.50,45.00),
 (8,5,10,'Cargo',15.000,1.10,16.50),
 (9,5,11,'Cargo',22.000,2.50,55.00);
/*!40000 ALTER TABLE `detalle_ajustes` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`detalle_compras`
--

DROP TABLE IF EXISTS `detalle_compras`;
CREATE TABLE `detalle_compras` (
  `iddetalle_compra` int(8) NOT NULL AUTO_INCREMENT,
  `idcompra` int(8) NOT NULL,
  `idarticulo` int(8) NOT NULL,
  `cantidad` float(11,2) NOT NULL,
  `precio_compra` float(11,2) NOT NULL,
  `precio_tasa` float(9,3) DEFAULT NULL,
  `precio_venta` float(11,2) DEFAULT NULL,
  `subtotal` float(9,3) DEFAULT '0.000',
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`iddetalle_compra`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`detalle_compras`
--

/*!40000 ALTER TABLE `detalle_compras` DISABLE KEYS */;
INSERT INTO `detalle_compras` (`iddetalle_compra`,`idcompra`,`idarticulo`,`cantidad`,`precio_compra`,`precio_tasa`,`precio_venta`,`subtotal`,`fecha`) VALUES 
 (1,1,1,100.00,12.00,429.720,0.00,1392.000,'2024-09-10'),
 (2,2,1,10.00,12.00,429.720,0.00,139.200,'2024-09-10'),
 (3,3,2,12.00,1.50,53.720,0.00,18.000,'2024-09-10'),
 (4,4,3,10.00,1.00,35.810,0.00,10.000,'2024-09-10'),
 (5,5,12,15.00,36.00,1384.560,2.00,564.900,'2024-09-15'),
 (6,5,13,56.00,12.00,461.520,3.00,702.450,'2024-09-15');
/*!40000 ALTER TABLE `detalle_compras` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`detalle_devolucion`
--

DROP TABLE IF EXISTS `detalle_devolucion`;
CREATE TABLE `detalle_devolucion` (
  `iddetalle_devolucion` int(8) NOT NULL AUTO_INCREMENT,
  `iddevolucion` int(8) NOT NULL,
  `idarticulo` int(8) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `precio_venta` float(11,2) NOT NULL,
  `descuento` float(11,2) NOT NULL,
  PRIMARY KEY (`iddetalle_devolucion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`detalle_devolucion`
--

/*!40000 ALTER TABLE `detalle_devolucion` DISABLE KEYS */;
INSERT INTO `detalle_devolucion` (`iddetalle_devolucion`,`iddevolucion`,`idarticulo`,`cantidad`,`precio_venta`,`descuento`) VALUES 
 (1,1,1,1,17.40,0.00),
 (2,1,3,1,1.16,0.00);
/*!40000 ALTER TABLE `detalle_devolucion` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`detalle_devolucioncompras`
--

DROP TABLE IF EXISTS `detalle_devolucioncompras`;
CREATE TABLE `detalle_devolucioncompras` (
  `iddetalle` int(5) NOT NULL AUTO_INCREMENT,
  `iddevolucion` int(5) NOT NULL,
  `codarticulo` int(5) DEFAULT NULL,
  `cantidad` float(9,3) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`iddetalle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`detalle_devolucioncompras`
--

/*!40000 ALTER TABLE `detalle_devolucioncompras` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_devolucioncompras` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`detalle_pedido`
--

DROP TABLE IF EXISTS `detalle_pedido`;
CREATE TABLE `detalle_pedido` (
  `iddetalle_pedido` int(8) NOT NULL AUTO_INCREMENT,
  `idpedido` int(8) NOT NULL,
  `idarticulo` int(5) NOT NULL,
  `costoarticulo` float(9,3) DEFAULT NULL,
  `cantidad` float(7,2) NOT NULL,
  `precio_venta` float(11,2) NOT NULL,
  `descuento` float(7,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_emi` date DEFAULT NULL,
  PRIMARY KEY (`iddetalle_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`detalle_pedido`
--

/*!40000 ALTER TABLE `detalle_pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_pedido` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`detalle_venta`
--

DROP TABLE IF EXISTS `detalle_venta`;
CREATE TABLE `detalle_venta` (
  `iddetalle_venta` int(8) NOT NULL AUTO_INCREMENT,
  `idventa` int(8) NOT NULL,
  `idarticulo` int(5) NOT NULL,
  `costoarticulo` float(9,3) DEFAULT NULL,
  `cantidad` float(7,2) NOT NULL,
  `precio_venta` float(11,3) NOT NULL,
  `descuento` float(7,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_emi` date DEFAULT NULL,
  PRIMARY KEY (`iddetalle_venta`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`detalle_venta`
--

/*!40000 ALTER TABLE `detalle_venta` DISABLE KEYS */;
INSERT INTO `detalle_venta` (`iddetalle_venta`,`idventa`,`idarticulo`,`costoarticulo`,`cantidad`,`precio_venta`,`descuento`,`fecha`,`fecha_emi`) VALUES 
 (1,1,1,12.000,1.00,17.400,0.00,'2024-09-10 13:27:33','2024-09-10'),
 (2,2,3,1.000,1.00,1.160,0.00,'2024-09-10 14:24:44','2024-09-10'),
 (3,3,1,12.000,1.00,17.400,0.00,'2024-09-10 14:34:17','2024-09-10'),
 (4,3,3,1.000,1.00,1.160,0.00,'2024-09-10 14:34:17','2024-09-10'),
 (5,4,2,1.500,1.00,1.880,0.00,'2024-09-10 14:38:03','2024-09-10'),
 (6,5,1,12.000,1.00,17.400,0.00,'2024-09-10 15:15:11','2024-09-10'),
 (7,6,3,1.000,1.00,1.160,0.00,'2024-09-10 15:16:12','2024-09-10'),
 (8,6,1,12.000,1.00,17.400,0.00,'2024-09-10 15:16:12','2024-09-10'),
 (9,7,1,12.000,1.00,17.400,0.00,'2024-09-10 15:26:10','2024-09-10'),
 (10,7,3,1.000,1.00,1.160,0.00,'2024-09-10 15:26:10','2024-09-10'),
 (11,7,4,1.500,1.00,1.800,0.00,'2024-09-10 15:26:10','2024-09-10'),
 (12,8,4,1.500,1.00,1.800,0.00,'2024-09-10 15:46:05','2024-09-10'),
 (13,9,5,0.590,1.00,0.710,0.00,'2024-09-11 18:30:03','2024-09-11'),
 (14,9,6,1.000,1.00,1.200,0.00,'2024-09-11 18:30:03','2024-09-11');
INSERT INTO `detalle_venta` (`iddetalle_venta`,`idventa`,`idarticulo`,`costoarticulo`,`cantidad`,`precio_venta`,`descuento`,`fecha`,`fecha_emi`) VALUES 
 (15,10,9,2.200,1.00,2.640,0.00,'2024-09-12 18:30:36','2024-09-12'),
 (16,11,13,12.000,2.00,12.980,0.00,'2024-09-15 22:47:55','2024-09-15'),
 (17,11,12,36.000,2.00,38.930,0.00,'2024-09-15 22:47:55','2024-09-15');
/*!40000 ALTER TABLE `detalle_venta` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`devolucion`
--

DROP TABLE IF EXISTS `devolucion`;
CREATE TABLE `devolucion` (
  `idempresa` int(3) DEFAULT NULL,
  `iddevolucion` int(8) NOT NULL AUTO_INCREMENT,
  `idventa` int(8) NOT NULL,
  `comprobante` varchar(15) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(20) NOT NULL,
  PRIMARY KEY (`iddevolucion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`devolucion`
--

/*!40000 ALTER TABLE `devolucion` DISABLE KEYS */;
INSERT INTO `devolucion` (`idempresa`,`iddevolucion`,`idventa`,`comprobante`,`fecha_hora`,`user`) VALUES 
 (2,1,3,'3','2024-09-10 14:20:25','Nks');
/*!40000 ALTER TABLE `devolucion` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`devolucioncompras`
--

DROP TABLE IF EXISTS `devolucioncompras`;
CREATE TABLE `devolucioncompras` (
  `iddevolucion` int(5) NOT NULL AUTO_INCREMENT,
  `idcompra` int(5) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`iddevolucion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`devolucioncompras`
--

/*!40000 ALTER TABLE `devolucioncompras` DISABLE KEYS */;
/*!40000 ALTER TABLE `devolucioncompras` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
  `idempresa` int(1) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(50) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `rif` varchar(20) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fechasistema` date DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `corre_iva` int(11) DEFAULT '0',
  `corre_islr` int(11) DEFAULT '0',
  `tc` double(15,2) DEFAULT NULL,
  `peso` double(9,2) DEFAULT NULL,
  `tasaespecial` float(9,3) DEFAULT '0.000',
  `tasa_banco` double(15,3) DEFAULT NULL,
  `usaserie` int(2) DEFAULT '0',
  `serie` text,
  `logo` varchar(50) DEFAULT 'logoempresa.png',
  `actcosto` int(1) DEFAULT '0',
  `fl` int(1) DEFAULT '0',
  `tespecial` int(1) DEFAULT '0',
  `web` int(11) DEFAULT '0',
  `tikect` int(1) DEFAULT '0',
  PRIMARY KEY (`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`empresa`
--

/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` (`idempresa`,`uuid`,`codigo`,`nombre`,`direccion`,`rif`,`telefono`,`fechasistema`,`inicio`,`corre_iva`,`corre_islr`,`tc`,`peso`,`tasaespecial`,`tasa_banco`,`usaserie`,`serie`,`logo`,`actcosto`,`fl`,`tespecial`,`web`,`tikect`) VALUES 
 (1,NULL,NULL,'FRESITAS SHOP','santa cruz ede mora','v9086785','0414254','2024-09-09','2024-09-09',0,0,35.81,6000.00,NULL,4.160,0,'A','nks_color9.jpg',0,0,0,0,0),
 (2,NULL,200,'CORPORACION DE SISTEMAS NKS','SANTAC RUZ DE MORA','V8887524','045612125','2024-09-09','2024-09-09',0,0,35.96,4000.00,0.000,4.160,0,'A\r\n','logoempresa.png',0,0,0,0,0),
 (3,'9879879',NULL,'BODEGA CHATO','santa cruz de mora','v4654645','90709087','2024-01-01','2024-01-01',0,0,40.00,3899.00,0.000,NULL,0,NULL,'logoempresa.png',0,0,0,0,0),
 (4,'381313857',NULL,'FRESITAS','santa cruz ede mora','v9086785','0414254','2024-09-01','2024-09-01',0,0,10.00,10.00,0.000,NULL,0,NULL,'logoempresa.png',0,0,0,0,0),
 (5,'31231513531',NULL,'CHIKI STUDO','santa cruz de mnora','v313541332','046513531','2024-09-01','2024-09-01',0,0,38.46,4000.00,0.000,NULL,0,'A','logoempresa.png',0,0,0,0,0);
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `svweblite`.`failed_jobs`
--

/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`formalibre`
--

DROP TABLE IF EXISTS `formalibre`;
CREATE TABLE `formalibre` (
  `idforma` int(11) NOT NULL AUTO_INCREMENT,
  `idventa` int(11) DEFAULT NULL,
  `nrocontrol` int(11) DEFAULT NULL,
  `anulado` int(1) DEFAULT '0',
  PRIMARY KEY (`idforma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`formalibre`
--

/*!40000 ALTER TABLE `formalibre` DISABLE KEYS */;
/*!40000 ALTER TABLE `formalibre` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`gastos`
--

DROP TABLE IF EXISTS `gastos`;
CREATE TABLE `gastos` (
  `idgasto` int(5) NOT NULL AUTO_INCREMENT,
  `idpersona` int(5) DEFAULT NULL,
  `documento` varchar(20) DEFAULT NULL,
  `control` varchar(20) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `base` float(9,3) DEFAULT '0.000',
  `iva` float(9,3) DEFAULT '0.000',
  `exento` float(9,3) DEFAULT '0.000',
  `monto` float(9,3) DEFAULT NULL,
  `saldo` float(9,3) DEFAULT NULL,
  `retenido` float(9,3) DEFAULT '0.000',
  `tasa` float(9,3) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `estatus` int(2) DEFAULT '0',
  PRIMARY KEY (`idgasto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`gastos`
--

/*!40000 ALTER TABLE `gastos` DISABLE KEYS */;
/*!40000 ALTER TABLE `gastos` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`kardex`
--

DROP TABLE IF EXISTS `kardex`;
CREATE TABLE `kardex` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `documento` varchar(20) DEFAULT NULL,
  `idarticulo` int(5) DEFAULT NULL,
  `cantidad` float(9,3) DEFAULT NULL,
  `costo` float(9,3) DEFAULT NULL,
  `user` varchar(20) DEFAULT NULL,
  `tipo` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`kardex`
--

/*!40000 ALTER TABLE `kardex` DISABLE KEYS */;
INSERT INTO `kardex` (`id`,`fecha`,`documento`,`idarticulo`,`cantidad`,`costo`,`user`,`tipo`) VALUES 
 (1,'2024-09-10 11:15:28','COMP-3456',1,100.000,12.000,'Nks',1),
 (2,'2024-09-10 11:58:21','COMP-3456',1,10.000,12.000,'Nks',1),
 (3,'2024-09-10 11:59:16','COMP-3456',2,12.000,1.500,'Administracion',1),
 (4,'2024-09-10 12:35:22','COMP-65468',3,10.000,1.000,'Nks',1),
 (5,'2024-09-10 13:57:33','VENT-1',1,1.000,12.000,'Nks',2),
 (6,'2024-09-10 14:54:44','VENT-2',3,1.000,1.000,'Nks',2),
 (7,'2024-09-10 15:04:17','VENT-3',1,1.000,12.000,'Nks',2),
 (8,'2024-09-10 15:04:17','VENT-3',3,1.000,1.000,'Nks',2),
 (9,'2024-09-10 15:08:03','VENT-1',2,1.000,1.500,'Administracion',2),
 (10,'2024-09-10 14:20:25','DEV:V-3',1,1.000,17.400,'Nks',1),
 (11,'2024-09-10 14:20:25','DEV:V-3',3,1.000,1.160,'Nks',1),
 (12,'2024-09-10 15:32:45','AJUS-1',4,10.000,1.500,'Nks',1),
 (13,'2024-09-10 15:39:30','AJUS-2',5,10.000,0.590,'Administracion',1),
 (14,'2024-09-10 15:41:49','AJUS-3',5,1.000,0.590,'Administracion',1),
 (15,'2024-09-10 15:41:49','AJUS-3',6,10.000,1.000,'Administracion',1);
INSERT INTO `kardex` (`id`,`fecha`,`documento`,`idarticulo`,`cantidad`,`costo`,`user`,`tipo`) VALUES 
 (16,'2024-09-10 15:45:11','VENT-4',1,1.000,12.000,'Nks',2),
 (17,'2024-09-10 15:46:12','VENT-5',3,1.000,1.000,'Nks',2),
 (18,'2024-09-10 15:46:12','VENT-5',1,1.000,12.000,'Nks',2),
 (19,'2024-09-10 15:56:10','VENT-6',1,1.000,12.000,'Nks',2),
 (20,'2024-09-10 15:56:10','VENT-6',3,1.000,1.000,'Nks',2),
 (21,'2024-09-10 15:56:10','VENT-6',4,1.000,1.500,'Nks',2),
 (22,'2024-09-10 16:16:05','VENT-7',4,1.000,1.500,'Nks',2),
 (23,'2024-09-11 19:00:03','VENT-2',5,1.000,0.590,'Administracion',2),
 (24,'2024-09-11 19:00:03','VENT-2',6,1.000,1.000,'Administracion',2),
 (25,'2024-09-12 18:36:38','AJUS-4',7,10.000,2.500,'admfresita',1),
 (26,'2024-09-12 18:36:38','AJUS-4',9,50.000,2.200,'admfresita',1),
 (27,'2024-09-12 18:40:50','AJUS-5',8,30.000,1.500,'admchato',1),
 (28,'2024-09-12 18:40:50','AJUS-5',10,15.000,1.100,'admchato',1),
 (29,'2024-09-12 18:40:50','AJUS-5',11,22.000,2.500,'admchato',1),
 (30,'2024-09-12 19:00:36','VENT-1',9,1.000,2.200,'admfresita',2);
INSERT INTO `kardex` (`id`,`fecha`,`documento`,`idarticulo`,`cantidad`,`costo`,`user`,`tipo`) VALUES 
 (31,'2024-09-15 23:15:37','COMP-45813438346',12,15.000,36.000,'chiki',1),
 (32,'2024-09-15 23:15:38','COMP-45813438346',13,56.000,12.000,'chiki',1),
 (33,'2024-09-15 23:17:55','VENT-1',13,2.000,12.000,'chiki',2),
 (34,'2024-09-15 23:17:55','VENT-1',12,2.000,36.000,'chiki',2);
/*!40000 ALTER TABLE `kardex` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `svweblite`.`migrations`
--

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`,`migration`,`batch`) VALUES 
 (1,'2014_10_12_000000_create_users_table',1),
 (2,'2014_10_12_100000_create_password_resets_table',1),
 (3,'2019_08_19_000000_create_failed_jobs_table',1),
 (4,'2019_12_14_000001_create_personal_access_tokens_table',1),
 (5,'2023_03_13_175600_articulos',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`monedas`
--

DROP TABLE IF EXISTS `monedas`;
CREATE TABLE `monedas` (
  `idempresa` int(3) DEFAULT NULL,
  `idmoneda` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  `tipo` int(2) DEFAULT NULL,
  `simbolo` char(3) DEFAULT 'sm',
  `valor` float(9,3) DEFAULT '0.000',
  `reftasa` int(1) DEFAULT '0',
  `idbanco` int(2) DEFAULT '0',
  PRIMARY KEY (`idmoneda`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`monedas`
--

/*!40000 ALTER TABLE `monedas` DISABLE KEYS */;
INSERT INTO `monedas` (`idempresa`,`idmoneda`,`nombre`,`tipo`,`simbolo`,`valor`,`reftasa`,`idbanco`) VALUES 
 (2,1,'Dolares',0,'$',1.000,0,3),
 (1,2,'Dolares Transf.',0,'$',1.000,0,2),
 (2,3,'Pesos',1,'Ps',6000.000,0,0),
 (1,4,'Bolivares Efect.',1,'Bs',35.810,0,0),
 (1,5,'Bolivares Transf.',1,'Bs',25.000,0,0),
 (1,6,'Pto Venta',1,'Bs',28.000,0,0),
 (1,7,'Pto Sofitasa',1,'Bs',24.000,0,1),
 (1,8,'Pto Movistar',1,'Bs',24.000,0,1),
 (1,9,'Pto Provincial',1,'Bs',24.120,0,1),
 (1,10,'Gastos',0,'$',1.000,0,0),
 (2,11,'Desc. Fact.',0,'$',1.000,0,0),
 (2,12,'EURO',2,'E',1.200,0,0),
 (2,13,'YEN',2,'Yn',1.450,0,0),
 (2,14,'Bs Efectivo',1,'Bs',35.960,1,0),
 (4,15,'Dolares',1,'$',1.000,0,0),
 (4,16,'pesos',1,'PS',4000.000,0,0),
 (2,17,'pesos n',1,'psc',4000.000,2,0),
 (2,18,'pesos n',1,'psc',4000.000,2,0),
 (5,19,'Bs efectivo',1,'Bs',38.460,1,0),
 (5,20,'Pesos',1,'Ps',4000.000,2,0),
 (3,21,'Bolivares',1,'Bs',40.000,1,0),
 (3,22,'Pesos',1,'Ps',3899.000,2,0);
/*!40000 ALTER TABLE `monedas` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`mov_ban`
--

DROP TABLE IF EXISTS `mov_ban`;
CREATE TABLE `mov_ban` (
  `id_mov` int(8) NOT NULL AUTO_INCREMENT,
  `idbanco` int(5) DEFAULT NULL,
  `clasificador` int(3) DEFAULT NULL,
  `tipodoc` char(4) DEFAULT '0',
  `docrelacion` int(5) DEFAULT '0',
  `iddocumento` int(5) DEFAULT '0',
  `tipo_mov` text,
  `numero` varchar(20) DEFAULT NULL,
  `concepto` varchar(40) DEFAULT NULL,
  `tipo_per` char(2) DEFAULT NULL,
  `idbeneficiario` int(5) DEFAULT '0',
  `identificacion` varchar(100) DEFAULT NULL,
  `ced` varchar(30) DEFAULT NULL,
  `monto` double(15,3) DEFAULT NULL,
  `tasadolar` double(15,3) DEFAULT NULL,
  `fecha_mov` datetime DEFAULT NULL,
  `estatus` int(3) DEFAULT '0',
  `user` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_mov`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`mov_ban`
--

/*!40000 ALTER TABLE `mov_ban` DISABLE KEYS */;
INSERT INTO `mov_ban` (`id_mov`,`idbanco`,`clasificador`,`tipodoc`,`docrelacion`,`iddocumento`,`tipo_mov`,`numero`,`concepto`,`tipo_per`,`idbeneficiario`,`identificacion`,`ced`,`monto`,`tasadolar`,`fecha_mov`,`estatus`,`user`) VALUES 
 (1,3,3,'COMP',1,1,'N/D','COMP-1 Rec-1','Compras','P',1,'','',1392.000,35.810,'2024-09-10 11:15:28',0,'Nks'),
 (2,3,7,'COMP',2,3,'N/D','COMP-2 Rec-3','Pago COMP','P',2,'','',100.000,35.810,'2024-09-10 16:42:52',0,'Nks'),
 (3,3,7,'COMP',4,5,'N/D','COMP-4 Rec-5','Pago Compras','P',5,'','',10.000,0.000,'2024-09-10 16:56:03',0,'Nks');
/*!40000 ALTER TABLE `mov_ban` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`mov_notas`
--

DROP TABLE IF EXISTS `mov_notas`;
CREATE TABLE `mov_notas` (
  `id_mov` int(5) NOT NULL AUTO_INCREMENT,
  `tipodoc` varchar(5) DEFAULT NULL,
  `iddoc` int(5) DEFAULT NULL,
  `monto` float(9,3) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `referencia` varchar(20) DEFAULT NULL,
  `user` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_mov`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`mov_notas`
--

/*!40000 ALTER TABLE `mov_notas` DISABLE KEYS */;
/*!40000 ALTER TABLE `mov_notas` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`mov_notasp`
--

DROP TABLE IF EXISTS `mov_notasp`;
CREATE TABLE `mov_notasp` (
  `id_mov` int(5) NOT NULL AUTO_INCREMENT,
  `tipodoc` varchar(5) DEFAULT NULL,
  `iddoc` int(5) DEFAULT NULL,
  `monto` float(9,3) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `referencia` varchar(20) DEFAULT NULL,
  `user` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_mov`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`mov_notasp`
--

/*!40000 ALTER TABLE `mov_notasp` DISABLE KEYS */;
/*!40000 ALTER TABLE `mov_notasp` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`notasadm`
--

DROP TABLE IF EXISTS `notasadm`;
CREATE TABLE `notasadm` (
  `idnota` int(5) NOT NULL AUTO_INCREMENT,
  `tipo` int(2) DEFAULT NULL,
  `ndocumento` int(5) DEFAULT '0',
  `idcliente` int(5) DEFAULT NULL,
  `descripcion` varchar(20) DEFAULT NULL,
  `referencia` varchar(20) NOT NULL,
  `monto` float(9,3) NOT NULL,
  `fecha` date DEFAULT NULL,
  `pendiente` float(9,3) NOT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `pordevolucion` int(2) DEFAULT '0',
  PRIMARY KEY (`idnota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`notasadm`
--

/*!40000 ALTER TABLE `notasadm` DISABLE KEYS */;
/*!40000 ALTER TABLE `notasadm` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`notasadmp`
--

DROP TABLE IF EXISTS `notasadmp`;
CREATE TABLE `notasadmp` (
  `idnota` int(5) NOT NULL AUTO_INCREMENT,
  `tipo` int(2) DEFAULT NULL,
  `ndocumento` int(5) DEFAULT '0',
  `idproveedor` int(5) DEFAULT NULL,
  `descripcion` varchar(30) DEFAULT NULL,
  `referencia` varchar(20) NOT NULL,
  `monto` float(9,3) NOT NULL,
  `fecha` date DEFAULT NULL,
  `pendiente` float(9,3) NOT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idnota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`notasadmp`
--

/*!40000 ALTER TABLE `notasadmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `notasadmp` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `svweblite`.`password_resets`
--

/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `idpedido` int(8) NOT NULL AUTO_INCREMENT,
  `idcliente` int(8) NOT NULL,
  `idvendedor` int(3) DEFAULT NULL,
  `tipo_comprobante` varchar(10) NOT NULL,
  `serie_comprobante` varchar(15) NOT NULL,
  `num_comprobante` int(10) NOT NULL,
  `total_venta` float(11,2) NOT NULL,
  `descuento` double(15,3) DEFAULT '0.000',
  `total_pagar` float(9,3) DEFAULT '0.000',
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_emi` date DEFAULT NULL,
  `impuesto` int(2) NOT NULL,
  `saldo` float(11,2) NOT NULL,
  `diascre` int(5) DEFAULT NULL,
  `estado` varchar(10) NOT NULL,
  `devolu` int(2) NOT NULL,
  `comision` double(8,3) DEFAULT '0.000',
  `montocomision` float(9,3) DEFAULT NULL,
  `idcomision` int(5) DEFAULT '0',
  `pweb` int(2) DEFAULT '0',
  `user` varchar(15) NOT NULL,
  `impor` int(1) DEFAULT '0',
  PRIMARY KEY (`idpedido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`pedidos`
--

/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `svweblite`.`personal_access_tokens`
--

/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE `proveedores` (
  `idempresa` int(2) DEFAULT NULL,
  `idproveedor` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `rif` varchar(15) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `contacto` varchar(80) DEFAULT NULL,
  `estatus` varchar(1) NOT NULL,
  `tpersona` int(2) DEFAULT '1',
  `creado` date DEFAULT NULL,
  `tipo` varchar(2) DEFAULT 'P',
  PRIMARY KEY (`idproveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`proveedores`
--

/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` (`idempresa`,`idproveedor`,`nombre`,`rif`,`direccion`,`telefono`,`contacto`,`estatus`,`tpersona`,`creado`,`tipo`) VALUES 
 (2,1,'SINFOROSO','V6545321','jgjhgjh','(313) 323-2133','4234','A',1,'2024-09-10','P'),
 (2,2,'EL CANEY','V56165465','merida','(654) 654-5313','jose luis','A',1,'2024-09-10','P'),
 (1,3,'MOTO G REPU','V465465','merida','(654) 654-6546','mariela gomez','A',1,'2024-09-10','P'),
 (1,4,'CSK MOTOS','v564654','merdai','(546) 546-5465','JULIO','A',NULL,NULL,'P'),
 (2,5,'CHARCUTERIA JOANAM','cv6846465','merdia','(231) 654-1331','MARIELA FOEM','A',NULL,NULL,'P'),
 (5,6,'LOS JUANES DEL POZO','8164376486','Bailadores','(042) 616-9645','Carlos Martinez','A',1,'2024-09-15','P');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`recibos`
--

DROP TABLE IF EXISTS `recibos`;
CREATE TABLE `recibos` (
  `idrecibo` int(10) NOT NULL AUTO_INCREMENT,
  `idventa` int(10) NOT NULL,
  `idnota` int(5) DEFAULT '0',
  `tiporecibo` char(2) DEFAULT 'P',
  `monto` float(11,2) NOT NULL,
  `idpago` int(3) NOT NULL,
  `id_banco` int(5) DEFAULT NULL,
  `idbanco` varchar(18) DEFAULT NULL,
  `recibido` float(11,2) NOT NULL,
  `tasab` float(11,2) DEFAULT NULL,
  `tasap` float(11,2) DEFAULT NULL,
  `referencia` varchar(20) DEFAULT NULL,
  `aux` varchar(10) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idrecibo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`recibos`
--

/*!40000 ALTER TABLE `recibos` DISABLE KEYS */;
INSERT INTO `recibos` (`idrecibo`,`idventa`,`idnota`,`tiporecibo`,`monto`,`idpago`,`id_banco`,`idbanco`,`recibido`,`tasab`,`tasap`,`referencia`,`aux`,`fecha`,`usuario`) VALUES 
 (1,1,0,'P',17.40,1,0,'Dolares',17.40,35.81,6000.00,NULL,'0.00','2024-09-10 13:57:33','Nks'),
 (2,2,0,'P',1.16,1,0,'Dolares',1.16,35.81,6000.00,NULL,'0.00','2024-09-10 14:54:44','Nks'),
 (3,3,0,'P',0.00,3,0,'Pesos',0.00,35.81,6000.00,'Anulado ->18.56','0.00','2024-09-10 14:50:25','Nks'),
 (4,4,0,'P',1.88,2,0,'Dolares Transf.',1.88,35.81,6000.00,NULL,'0.00','2024-09-10 15:08:03','Administracion'),
 (5,5,0,'P',17.40,3,0,'Pesos',104400.00,35.81,6000.00,'Tc: 6000','0.00','2024-09-10 15:45:11','Nks'),
 (6,6,0,'A',5.00,1,0,'Dolares',5.00,35.81,6000.00,NULL,'13.56','2024-09-10 16:06:39','Nks'),
 (7,10,0,'P',2.64,15,0,'Dolares',2.64,10.00,10.00,'Tc: 1','0.00','2024-09-12 19:00:36','admfresita'),
 (8,11,0,'P',103.82,20,0,'Pesos',415280.00,38.46,4000.00,'Tc: 4000','0.00','2024-09-15 23:17:55','chiki');
/*!40000 ALTER TABLE `recibos` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`reciboscomision`
--

DROP TABLE IF EXISTS `reciboscomision`;
CREATE TABLE `reciboscomision` (
  `id_recibo` int(5) NOT NULL AUTO_INCREMENT,
  `id_comision` int(5) DEFAULT NULL,
  `monto` float(9,3) DEFAULT NULL,
  `observacion` varchar(80) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `user` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_recibo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`reciboscomision`
--

/*!40000 ALTER TABLE `reciboscomision` DISABLE KEYS */;
/*!40000 ALTER TABLE `reciboscomision` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`relacionnc`
--

DROP TABLE IF EXISTS `relacionnc`;
CREATE TABLE `relacionnc` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `idmov` int(5) DEFAULT NULL,
  `idnota` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`relacionnc`
--

/*!40000 ALTER TABLE `relacionnc` DISABLE KEYS */;
/*!40000 ALTER TABLE `relacionnc` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`relacionncp`
--

DROP TABLE IF EXISTS `relacionncp`;
CREATE TABLE `relacionncp` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `idmov` int(5) DEFAULT NULL,
  `idnota` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`relacionncp`
--

/*!40000 ALTER TABLE `relacionncp` DISABLE KEYS */;
/*!40000 ALTER TABLE `relacionncp` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`retenc`
--

DROP TABLE IF EXISTS `retenc`;
CREATE TABLE `retenc` (
  `codigo` int(3) NOT NULL AUTO_INCREMENT,
  `codtrib` varchar(20) DEFAULT '',
  `descrip` varchar(80) DEFAULT '',
  `beneficiar` double(2,0) NOT NULL DEFAULT '0',
  `base` double(20,7) NOT NULL DEFAULT '0.0000000',
  `ret` double(20,7) NOT NULL DEFAULT '0.0000000',
  `sustraend` double(20,7) NOT NULL DEFAULT '0.0000000',
  `superior` double(20,7) NOT NULL DEFAULT '0.0000000',
  `afiva` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `svweblite`.`retenc`
--

/*!40000 ALTER TABLE `retenc` DISABLE KEYS */;
INSERT INTO `retenc` (`codigo`,`codtrib`,`descrip`,`beneficiar`,`base`,`ret`,`sustraend`,`superior`,`afiva`) VALUES 
 (1,'001','HONORARIOS, SUELDOS Y SALARIOS',3,100.0000000,3.0000000,2125.0000000,70833.3300000,1),
 (2,'002','(PNR)-Honorarios Profesionales No Mercantiles',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),
 (3,'003','(PNNR)-Honorarios Profesionales No Mercantiles',4,90.0000000,34.0000000,0.0000000,0.0000000,0),
 (4,'004','(PJD)-Honorarios Profesionales No Mercantiles',1,100.0000000,5.0000000,0.0000000,25.0000000,0),
 (5,'005','(PJND)-Honorarios Profesionales No Mercantiles',2,90.0000000,15.0000000,0.0000000,0.0100000,0),
 (6,'006','(PNR)-Honorarios Profesionales Mancomunados No Mercantiles',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),
 (7,'007','(PNNR)-Honorarios Profesionales Mancomunados No Mercantiles',4,100.0000000,34.0000000,0.0000000,0.0000000,0),
 (8,'008','(PJD)-Honorarios Profesionales Mancomunados No Mercantiles',1,100.0000000,5.0000000,0.0000000,25.0000000,0),
 (9,'055','(PJND)-Honorarios Profesionales Mancomunados No Mercantiles',2,100.0000000,15.0000000,0.0000000,0.0100000,0);
INSERT INTO `retenc` (`codigo`,`codtrib`,`descrip`,`beneficiar`,`base`,`ret`,`sustraend`,`superior`,`afiva`) VALUES 
 (10,'010','(PNR)-Honorarios Profesionales pagados a Jinetes, Veterinarios, Preparadores o E',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),
 (11,'011','(PNNR)-Honorarios Profesionales pagados a Jinetes, Veterinarios, Preparadores o',4,100.0000000,34.0000000,0.0000000,0.0000000,0),
 (12,'012','(PNR)-Honorarios Profesionales pagados por Clínicas, Hospitales, Centros de Salu',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),
 (13,'013','(PNNR)-Honorarios Profesionales pagados por Clínicas, Hospitales, Centros de Sal',4,100.0000000,34.0000000,0.0000000,0.0000000,0),
 (14,'014','(PNR)-Comisiones pagadas por la venta de bienes inmuebles',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),
 (15,'015','(PNNR)-Comisiones pagadas por la venta de bienes inmuebles',4,100.0000000,34.0000000,0.0000000,0.0000000,0),
 (16,'016','(PJD)-Comisiones pagadas por la venta de bienes inmuebles',1,100.0000000,5.0000000,0.0000000,25.0000000,0),
 (17,'017','(PJND)Comisiones pagadas por la venta de bienes inmuebles',2,100.0000000,5.0000000,0.0000000,0.0100000,0);
INSERT INTO `retenc` (`codigo`,`codtrib`,`descrip`,`beneficiar`,`base`,`ret`,`sustraend`,`superior`,`afiva`) VALUES 
 (18,'018','(PNR)-Cualquier otra Comisión distintas a Remuneraciones accesorias de los sueld',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),
 (19,'019','(PNNR)-Cualquier otra Comisión distintas a Remuneraciones accesorias de los suel',4,100.0000000,34.0000000,0.0000000,0.0000000,0),
 (20,'020','(PJD)-Cualquier otra Comisión distintas a Remuneraciones accesorias de los sueld',1,100.0000000,5.0000000,0.0000000,25.0000000,0),
 (21,'021','(PJND)-Cualquier otra Comisión distintas a Remuneraciones accesorias de los suel',2,100.0000000,5.0000000,0.0000000,0.0100000,0),
 (22,'022','(PNNR)-Intereses de Capitales tomados en préstamo e invertidos en la producción',4,100.0000000,34.0000000,0.0000000,0.0000000,0),
 (23,'023','(PJND)-Intereses de Capitales tomados en préstamo e invertidos en la producción',2,100.0000000,15.0000000,0.0000000,0.0100000,0),
 (24,'024','(PJND)-Intereses provenientes de prestamos y otros creditos pagaderos a instituc',2,100.0000000,4.9500000,0.0000000,0.0100000,0),
 (25,'025','(PNR)-Intereses pagados por las personas jurídicas o comunidades a cualquier otr',4,100.0000000,3.0000000,0.0000000,0.0000000,0);
INSERT INTO `retenc` (`codigo`,`codtrib`,`descrip`,`beneficiar`,`base`,`ret`,`sustraend`,`superior`,`afiva`) VALUES 
 (26,'026','(PNNR)-Intereses pagados por las personas jurídicas o comunidades a cualquier ot',4,100.0000000,34.0000000,0.0000000,0.0000000,0),
 (27,'027','(PJD)-Intereses pagados por las personas jurídicas o comunidades a cualquier otr',1,100.0000000,5.0000000,0.0000000,25.0000000,0),
 (28,'028','(PJND)-Intereses pagados por las personas jurídicas o comunidades a cualquier ot',4,100.0000000,15.0000000,0.0000000,0.0000000,0),
 (29,'029','(PJND)-Enriquecimientos Netos de las Agencias Internacionales cuando el pagador',2,100.0000000,15.0000000,0.0000000,0.0100000,0),
 (30,'030','(PNNR)-Enriquecimientos Netos de Gastos de Transporte conformados por fletes pag',4,100.0000000,15.0000000,0.0000000,0.0000000,0),
 (31,'031','(PJND)-Enriquecimientos Netos de Gastos de Transporte conformados por fletes pag',2,100.0000000,15.0000000,0.0000000,0.0100000,0),
 (32,'032','(PNNR)-Enriquecimientos Netos de Exhibición de Películas, Cine o la Televisión',4,100.0000000,34.0000000,0.0000000,0.0000000,0),
 (33,'033','(PJND)-Enriquecimientos Netos de Exhibición de Películas, Cine o la Televisión',2,100.0000000,15.0000000,0.0000000,0.0100000,0);
INSERT INTO `retenc` (`codigo`,`codtrib`,`descrip`,`beneficiar`,`base`,`ret`,`sustraend`,`superior`,`afiva`) VALUES 
 (34,'034','(PNNR)-Enriquecimientos obtenidos por concepto de regalías y demás participacion',4,100.0000000,34.0000000,0.0000000,0.0000000,0),
 (35,'035','(PJND)-Enriquecimientos obtenidos por concepto de regalías y demás participacion',4,100.0000000,15.0000000,0.0000000,0.0000000,0),
 (36,'036','(PNNR)-Enriquecimientos obtenidos por las Remuneraciones, Honorarios y pagos aná',4,100.0000000,34.0000000,0.0000000,0.0000000,0),
 (37,'037','(PJND)-Enriquecimientos obtenidos por las Remuneraciones, Honorarios y pagos aná',2,100.0000000,15.0000000,0.0000000,0.0100000,0),
 (38,'038','(PNNR)-Enriquecimientos obtenidos por Servicios Tecnológicos utilizados en el pa',4,100.0000000,34.0000000,0.0000000,0.0000000,0),
 (39,'039','(PJND)-Enriquecimientos obtenidos por Servicios Tecnológicos utilizados en el pa',2,100.0000000,15.0000000,0.0000000,0.0100000,0),
 (40,'040','(PJND)-Enriquecimientos Netos derivados de las Primas de Seguros y Reaseguros',2,100.0000000,10.0000000,0.0000000,0.0100000,0),
 (41,'041','(PNR)-Ganancias Obtenidas por Juegos y Apuestas',3,100.0000000,34.0000000,2125.0000000,70833.3300000,0);
INSERT INTO `retenc` (`codigo`,`codtrib`,`descrip`,`beneficiar`,`base`,`ret`,`sustraend`,`superior`,`afiva`) VALUES 
 (42,'042','(PNNR)-Ganancias Obtenidas por Juegos y Apuestas',4,100.0000000,34.0000000,0.0000000,0.0000000,0),
 (43,'043','(PJD)-Ganancias Obtenidas por Juegos y Apuestas',1,100.0000000,34.0000000,0.0000000,25.0000000,0),
 (44,'044','(PJND)-Ganancias Obtenidas por Juegos y Apuestas',2,100.0000000,34.0000000,0.0000000,0.0100000,0),
 (45,'045','(PNR)-Ganancias Obtenidas por Premios de Loterías y de Hipódromos',3,100.0000000,16.0000000,2125.0000000,70833.3300000,0),
 (46,'046','(PNNR)-Ganancias Obtenidas por Premios de Loterías y de Hipódromos',4,100.0000000,16.0000000,0.0000000,0.0000000,0),
 (47,'047','(PJD)-Ganancias Obtenidas por Premios de Loterías y de Hipódromos',1,100.0000000,16.0000000,0.0000000,25.0000000,0),
 (48,'048','(PJND)-Ganancias Obtenidas por Premios de Loterías y de Hipódromos',2,100.0000000,16.0000000,0.0000000,0.0100000,0),
 (49,'049','(PNR)-Pagos a Propietarios de Animales de Carrera por concepto de Premios',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),
 (50,'050','(PNNR)-Pagos a Propietarios de Animales de Carrera por concepto de Premios',4,100.0000000,34.0000000,0.0000000,0.0000000,0);
INSERT INTO `retenc` (`codigo`,`codtrib`,`descrip`,`beneficiar`,`base`,`ret`,`sustraend`,`superior`,`afiva`) VALUES 
 (51,'051','(PJD)-Pagos a Propietarios de Animales de Carrera por concepto de Premios',1,100.0000000,5.0000000,0.0000000,25.0000000,0),
 (52,'052','(PJND)-Pagos a Propietarios de Animales de Carrera por concepto de Premios',2,100.0000000,5.0000000,0.0000000,0.0100000,0),
 (53,'053','(PNR)-Pagos a Empresas Contratistas o Subcontratistas domiciliadas o no en el pa',3,100.0000000,1.0000000,2125.0000000,70833.3300000,0),
 (54,'054','(PNNR)-Pagos a Empresas Contratistas o Subcontratistas domiciliadas o no en el p',4,100.0000000,34.0000000,0.0000000,0.0000000,0),
 (55,'055','(PJD)-Pagos a Empresas Contratistas o Subcontratistas domiciliadas o no en el pa',1,100.0000000,2.0000000,0.0000000,25.0000000,0),
 (56,'056','(PJND)-Pagos a Empresas Contratistas o Subcontratistas domiciliadas o no en el p',2,100.0000000,15.0000000,0.0000000,0.0100000,0),
 (57,'057','(PNR)-Pagos de los Arrendadores de bienes inmuebles situados en el pais',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),
 (58,'058','(PNNR)-Pagos de los Arrendadores de bienes inmuebles situados en el pais',4,90.0000000,34.0000000,0.0000000,0.0000000,0);
INSERT INTO `retenc` (`codigo`,`codtrib`,`descrip`,`beneficiar`,`base`,`ret`,`sustraend`,`superior`,`afiva`) VALUES 
 (59,'059','(PJD)-Pagos de los Arrendadores de bienes inmuebles situados en el pais',1,100.0000000,5.0000000,0.0000000,25.0000000,0),
 (60,'060','(PJND)-Pagos de los Arrendadores de bienes inmuebles situados en el pais',2,90.0000000,15.0000000,0.0000000,0.0100000,0),
 (61,'061','(PNR)-Cánones de Arrendamientos de Bienes Muebles situados en el país',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),
 (62,'062','(PNNR)-Cánones de Arrendamientos de Bienes Muebles situados en el país',4,100.0000000,34.0000000,0.0000000,0.0000000,0),
 (63,'063','(PJD)-Cánones de Arrendamientos de Bienes Muebles situados en el país',1,100.0000000,5.0000000,0.0000000,25.0000000,0),
 (64,'064','(PJND)-Cánones de Arrendamientos de Bienes Muebles situados en el país',2,100.0000000,5.0000000,0.0000000,0.0100000,0),
 (65,'065','(PNR)-Pagos de las Empresas Emisoras de Tarjetas de Crédito o Consumo por la Ven',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),
 (66,'066','(PNNR)-Pagos de las Empresas Emisoras de Tarjetas de Crédito o Consumo por la Ve',4,100.0000000,34.0000000,0.0000000,0.0000000,0);
INSERT INTO `retenc` (`codigo`,`codtrib`,`descrip`,`beneficiar`,`base`,`ret`,`sustraend`,`superior`,`afiva`) VALUES 
 (67,'067','(PJD)-Pagos de las Empresas Emisoras de Tarjetas de Crédito o Consumo por la Ven',1,100.0000000,5.0000000,0.0000000,25.0000000,0),
 (68,'068','(PJND)-Pagos de las Empresas Emisoras de Tarjetas de Crédito o Consumo por la Ve',2,100.0000000,5.0000000,0.0000000,0.0100000,0),
 (69,'069','(PNR)-Pagos de las Empresas Emisoras de Tarjetas de Crédito por la venta de gaso',3,100.0000000,1.0000000,2125.0000000,70833.3300000,0),
 (70,'070','(PJD)-Pagos de las Empresas Emisoras de Tarjetas de Crédito por la venta de gaso',1,100.0000000,1.0000000,0.0000000,25.0000000,0),
 (71,'071','(PNR)-Pagos por Gastos de Transporte conformados por Fletes',3,100.0000000,1.0000000,708.3300000,70833.3300000,0),
 (72,'072','(PJD)-Pagos por Gastos de Transporte conformados por Fletes',1,100.0000000,3.0000000,0.0000000,25.0000000,0),
 (73,'073','(PNR)-Pagos de las Empresas de Seguro, las Sociedades de Corretaje de Seguros y',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),
 (74,'074','(PJD)-Pagos de las Empresas de Seguro, las Sociedades de Corretaje de Seguros y',1,100.0000000,5.0000000,0.0000000,25.0000000,0);
INSERT INTO `retenc` (`codigo`,`codtrib`,`descrip`,`beneficiar`,`base`,`ret`,`sustraend`,`superior`,`afiva`) VALUES 
 (75,'075','(PNR)-Pagos de las Empresas de Seguro a sus Contratistas por la Reparación de Da',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),
 (76,'076','(PJD)-Pagos de las Empresas de Seguro a sus Contratistas por la Reparación de Da',1,100.0000000,5.0000000,0.0000000,25.0000000,0),
 (77,'077','(PNR)-Pagos de las Empresas de Seguros a Clínicas, Hospitales y/o Centros de Sal',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),
 (78,'078','(PJD)-Pagos de las Empresas de Seguros a Clínicas, Hospitales y/o Centros de Sal',1,100.0000000,5.0000000,0.0000000,25.0000000,0),
 (79,'079','(PNR)-Cantidades que se paguen por adquisición de Fondos de Comercio situados en',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),
 (80,'080','(PNNR)-Cantidades que se paguen por adquisición de Fondos de Comercio situados e',4,100.0000000,34.0000000,0.0000000,0.0000000,0),
 (81,'081','(PJD)-Cantidades que se paguen por adquisición de Fondos de Comercio situados en',1,100.0000000,5.0000000,0.0000000,25.0000000,0),
 (82,'082','(PJND)-Cantidades que se paguen por adquisición de Fondos de Comercio situados e',2,100.0000000,5.0000000,0.0000000,0.0100000,0);
INSERT INTO `retenc` (`codigo`,`codtrib`,`descrip`,`beneficiar`,`base`,`ret`,`sustraend`,`superior`,`afiva`) VALUES 
 (83,'083','(PNR)-Pagos por Servicios de Publicidad y Propaganda y la Cesión de la Venta de',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),
 (84,'084','(PJD)-Pagos por Servicios de Publicidad y Propaganda y la Cesión de la Venta de',1,100.0000000,5.0000000,0.0000000,25.0000000,0),
 (85,'085','(PJND)-Pagos por Servicios de Publicidad y Propaganda y la Cesión de la Venta de',2,100.0000000,5.0000000,0.0000000,0.0100000,0),
 (86,'086','(PJD)-Pagos por Servicios de Publicidad y Propaganda y la Cesión de la Venta de',1,100.0000000,3.0000000,0.0000000,25.0000000,0),
 (87,'','RETENCION 100% DEL IVA A PROVEEDORES',1,100.0000000,100.0000000,0.0000000,0.0000000,1),
 (88,'','RETENCION 75% DEL IVA A PROVEEDORES',1,100.0000000,75.0000000,0.0000000,0.0000000,1),
 (89,'','PRESTACION DE SERVICIO ALCALDIA',1,100.0000000,1.0000000,0.0000000,0.0000000,0);
/*!40000 ALTER TABLE `retenc` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`retenciones`
--

DROP TABLE IF EXISTS `retenciones`;
CREATE TABLE `retenciones` (
  `idretencion` int(5) NOT NULL AUTO_INCREMENT,
  `idcompra` int(5) DEFAULT '0',
  `idgasto` int(5) DEFAULT '0',
  `idproveedor` int(11) DEFAULT NULL,
  `documento` varchar(20) DEFAULT NULL,
  `correlativo` int(11) DEFAULT '0',
  `retenc` int(5) DEFAULT NULL,
  `mfac` float(9,3) DEFAULT NULL,
  `mbase` float(9,3) DEFAULT NULL,
  `miva` float(9,3) DEFAULT NULL,
  `mexento` float(9,3) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `mret` float(9,3) DEFAULT NULL,
  `mretd` float(9,3) DEFAULT NULL,
  `anulada` int(1) DEFAULT '0',
  PRIMARY KEY (`idretencion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`retenciones`
--

/*!40000 ALTER TABLE `retenciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `retenciones` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`retencionventas`
--

DROP TABLE IF EXISTS `retencionventas`;
CREATE TABLE `retencionventas` (
  `idret` int(5) NOT NULL AUTO_INCREMENT,
  `idfactura` int(11) DEFAULT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `comprobante` varchar(20) DEFAULT NULL,
  `pretencion` int(3) DEFAULT NULL,
  `impuesto` float(9,3) DEFAULT NULL,
  `mretbs` float(9,3) DEFAULT NULL,
  `mretd` float(9,3) DEFAULT NULL,
  `mfactura` double(15,3) DEFAULT NULL,
  `tasa` float(9,3) DEFAULT NULL,
  `fecharegistro` date DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `periodo` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idret`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`retencionventas`
--

/*!40000 ALTER TABLE `retencionventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `retencionventas` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `idrol` int(5) NOT NULL AUTO_INCREMENT,
  `iduser` int(5) DEFAULT NULL,
  `newproveedor` int(1) DEFAULT '0',
  `editproveedor` int(1) DEFAULT '0',
  `edoctaproveedor` int(1) DEFAULT '0',
  `newvendedor` int(1) DEFAULT '0',
  `editvendedor` int(1) DEFAULT '0',
  `newcliente` int(1) DEFAULT '0',
  `editcliente` int(1) DEFAULT '0',
  `edoctacliente` int(1) DEFAULT '0',
  `newarticulo` int(1) DEFAULT '0',
  `editarticulo` int(1) DEFAULT '0',
  `crearcompra` int(1) DEFAULT '0',
  `anularcompra` int(1) DEFAULT '0',
  `crearventa` int(1) DEFAULT '0',
  `anularventa` int(1) DEFAULT '0',
  `crearpedido` int(1) DEFAULT '0',
  `editpedido` int(1) DEFAULT '0',
  `anularpedido` int(1) DEFAULT '0',
  `importarpedido` int(1) DEFAULT '0',
  `crearajuste` int(1) DEFAULT '0',
  `abonarcxc` int(1) DEFAULT '0',
  `creargasto` int(1) DEFAULT '0',
  `anulargasto` int(1) DEFAULT '0',
  `abonarcxp` int(1) DEFAULT '0',
  `abonargasto` int(1) DEFAULT '0',
  `comisiones` int(1) DEFAULT '0',
  `newmoneda` int(1) DEFAULT '0',
  `editmoneda` int(1) DEFAULT '0',
  `acttasa` int(1) DEFAULT '0',
  `actroles` int(1) DEFAULT '1',
  `rventas` int(1) DEFAULT '0',
  `ccaja` int(1) DEFAULT '0',
  `rdetallei` int(1) DEFAULT '0',
  `rcxc` int(1) DEFAULT '0',
  `rcompras` int(1) DEFAULT '0',
  `rdetallec` int(1) DEFAULT '0',
  `rcxp` int(1) DEFAULT '0',
  `rarti` int(1) DEFAULT '0',
  `rlistap` int(1) DEFAULT '0',
  `rgerencial` int(1) DEFAULT '0',
  `ranalisisc` int(1) DEFAULT '0',
  `rutilventa` int(1) DEFAULT '0',
  `rventasarti` int(1) DEFAULT '0',
  `rgastos` int(1) DEFAULT '0',
  `retenciones` int(1) DEFAULT '0',
  `editret` int(1) DEFAULT '0',
  `anularret` int(1) DEFAULT '0',
  `rcompraarti` int(1) DEFAULT '0',
  `web` int(1) DEFAULT '0',
  `updatepass` int(2) DEFAULT '1',
  `newbanco` int(1) DEFAULT '0',
  `editbanco` int(1) DEFAULT '0',
  `accesobanco` int(1) DEFAULT '0',
  `newndbanco` int(1) DEFAULT '0',
  `newncbanco` int(1) DEFAULT '0',
  `transferenciabanco` int(1) DEFAULT '0',
  `anularopbanco` int(1) DEFAULT '0',
  `resumenbanco` int(1) DEFAULT '0',
  `rlcompras` int(1) DEFAULT '0',
  `rlventas` int(1) DEFAULT '0',
  `rlvalorizado` int(1) DEFAULT '0',
  `rcorrelativo` int(1) DEFAULT '0',
  `newempresa` int(1) DEFAULT '0',
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`roles`
--

/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`idrol`,`iduser`,`newproveedor`,`editproveedor`,`edoctaproveedor`,`newvendedor`,`editvendedor`,`newcliente`,`editcliente`,`edoctacliente`,`newarticulo`,`editarticulo`,`crearcompra`,`anularcompra`,`crearventa`,`anularventa`,`crearpedido`,`editpedido`,`anularpedido`,`importarpedido`,`crearajuste`,`abonarcxc`,`creargasto`,`anulargasto`,`abonarcxp`,`abonargasto`,`comisiones`,`newmoneda`,`editmoneda`,`acttasa`,`actroles`,`rventas`,`ccaja`,`rdetallei`,`rcxc`,`rcompras`,`rdetallec`,`rcxp`,`rarti`,`rlistap`,`rgerencial`,`ranalisisc`,`rutilventa`,`rventasarti`,`rgastos`,`retenciones`,`editret`,`anularret`,`rcompraarti`,`web`,`updatepass`,`newbanco`,`editbanco`,`accesobanco`,`newndbanco`,`newncbanco`,`transferenciabanco`,`anularopbanco`,`resumenbanco`,`rlcompras`,`rlventas`,`rlvalorizado`,`rcorrelativo`,`newempresa`) VALUES 
 (1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,1),
 (2,2,1,1,0,1,1,1,1,0,1,1,1,1,1,1,0,0,0,0,1,1,1,1,1,1,1,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
 (3,3,1,1,0,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0);
INSERT INTO `roles` (`idrol`,`iduser`,`newproveedor`,`editproveedor`,`edoctaproveedor`,`newvendedor`,`editvendedor`,`newcliente`,`editcliente`,`edoctacliente`,`newarticulo`,`editarticulo`,`crearcompra`,`anularcompra`,`crearventa`,`anularventa`,`crearpedido`,`editpedido`,`anularpedido`,`importarpedido`,`crearajuste`,`abonarcxc`,`creargasto`,`anulargasto`,`abonarcxp`,`abonargasto`,`comisiones`,`newmoneda`,`editmoneda`,`acttasa`,`actroles`,`rventas`,`ccaja`,`rdetallei`,`rcxc`,`rcompras`,`rdetallec`,`rcxp`,`rarti`,`rlistap`,`rgerencial`,`ranalisisc`,`rutilventa`,`rventasarti`,`rgastos`,`retenciones`,`editret`,`anularret`,`rcompraarti`,`web`,`updatepass`,`newbanco`,`editbanco`,`accesobanco`,`newndbanco`,`newncbanco`,`transferenciabanco`,`anularopbanco`,`resumenbanco`,`rlcompras`,`rlventas`,`rlvalorizado`,`rcorrelativo`,`newempresa`) VALUES 
 (4,4,0,0,0,1,0,1,0,0,0,1,0,1,1,0,0,0,0,0,0,1,0,0,0,1,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
 (5,5,0,0,0,0,0,1,0,0,1,1,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
 (6,6,0,0,0,0,0,1,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
INSERT INTO `roles` (`idrol`,`iduser`,`newproveedor`,`editproveedor`,`edoctaproveedor`,`newvendedor`,`editvendedor`,`newcliente`,`editcliente`,`edoctacliente`,`newarticulo`,`editarticulo`,`crearcompra`,`anularcompra`,`crearventa`,`anularventa`,`crearpedido`,`editpedido`,`anularpedido`,`importarpedido`,`crearajuste`,`abonarcxc`,`creargasto`,`anulargasto`,`abonarcxp`,`abonargasto`,`comisiones`,`newmoneda`,`editmoneda`,`acttasa`,`actroles`,`rventas`,`ccaja`,`rdetallei`,`rcxc`,`rcompras`,`rdetallec`,`rcxp`,`rarti`,`rlistap`,`rgerencial`,`ranalisisc`,`rutilventa`,`rventasarti`,`rgastos`,`retenciones`,`editret`,`anularret`,`rcompraarti`,`web`,`updatepass`,`newbanco`,`editbanco`,`accesobanco`,`newndbanco`,`newncbanco`,`transferenciabanco`,`anularopbanco`,`resumenbanco`,`rlcompras`,`rlventas`,`rlvalorizado`,`rcorrelativo`,`newempresa`) VALUES 
 (7,7,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,1,1,0,0,1,0,0,1,1,1,1,1,1,0,1,1,0,1,1,1,0,0,1,1,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0),
 (8,8,0,0,0,0,0,1,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
 (9,9,0,0,0,0,0,1,1,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
INSERT INTO `roles` (`idrol`,`iduser`,`newproveedor`,`editproveedor`,`edoctaproveedor`,`newvendedor`,`editvendedor`,`newcliente`,`editcliente`,`edoctacliente`,`newarticulo`,`editarticulo`,`crearcompra`,`anularcompra`,`crearventa`,`anularventa`,`crearpedido`,`editpedido`,`anularpedido`,`importarpedido`,`crearajuste`,`abonarcxc`,`creargasto`,`anulargasto`,`abonarcxp`,`abonargasto`,`comisiones`,`newmoneda`,`editmoneda`,`acttasa`,`actroles`,`rventas`,`ccaja`,`rdetallei`,`rcxc`,`rcompras`,`rdetallec`,`rcxp`,`rarti`,`rlistap`,`rgerencial`,`ranalisisc`,`rutilventa`,`rventasarti`,`rgastos`,`retenciones`,`editret`,`anularret`,`rcompraarti`,`web`,`updatepass`,`newbanco`,`editbanco`,`accesobanco`,`newndbanco`,`newncbanco`,`transferenciabanco`,`anularopbanco`,`resumenbanco`,`rlcompras`,`rlventas`,`rlvalorizado`,`rcorrelativo`,`newempresa`) VALUES 
 (10,10,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,1,1,0,0,1,0,0,1,1,1,1,1,1,0,1,1,0,1,1,1,0,0,1,1,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0),
 (11,11,0,0,0,0,0,1,1,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
 (12,12,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0);
INSERT INTO `roles` (`idrol`,`iduser`,`newproveedor`,`editproveedor`,`edoctaproveedor`,`newvendedor`,`editvendedor`,`newcliente`,`editcliente`,`edoctacliente`,`newarticulo`,`editarticulo`,`crearcompra`,`anularcompra`,`crearventa`,`anularventa`,`crearpedido`,`editpedido`,`anularpedido`,`importarpedido`,`crearajuste`,`abonarcxc`,`creargasto`,`anulargasto`,`abonarcxp`,`abonargasto`,`comisiones`,`newmoneda`,`editmoneda`,`acttasa`,`actroles`,`rventas`,`ccaja`,`rdetallei`,`rcxc`,`rcompras`,`rdetallec`,`rcxp`,`rarti`,`rlistap`,`rgerencial`,`ranalisisc`,`rutilventa`,`rventasarti`,`rgastos`,`retenciones`,`editret`,`anularret`,`rcompraarti`,`web`,`updatepass`,`newbanco`,`editbanco`,`accesobanco`,`newndbanco`,`newncbanco`,`transferenciabanco`,`anularopbanco`,`resumenbanco`,`rlcompras`,`rlventas`,`rlvalorizado`,`rcorrelativo`,`newempresa`) VALUES 
 (13,14,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,1,1,0,0,1,0,0,1,1,1,1,1,1,0,1,1,0,1,1,1,0,0,1,1,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0),
 (14,15,0,0,0,1,0,1,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
 (15,16,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`seriales`
--

DROP TABLE IF EXISTS `seriales`;
CREATE TABLE `seriales` (
  `idserial` int(7) NOT NULL AUTO_INCREMENT,
  `idcompra` int(11) DEFAULT '0',
  `idarticulo` int(8) DEFAULT NULL,
  `chasis` varchar(40) DEFAULT NULL,
  `motor` varchar(40) DEFAULT NULL,
  `placa` varchar(8) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `año` varchar(4) DEFAULT NULL,
  `estatus` int(2) DEFAULT '0',
  `idventa` int(11) DEFAULT '0',
  `iddetalleventa` int(11) DEFAULT '0',
  PRIMARY KEY (`idserial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`seriales`
--

/*!40000 ALTER TABLE `seriales` DISABLE KEYS */;
/*!40000 ALTER TABLE `seriales` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`sistema`
--

DROP TABLE IF EXISTS `sistema`;
CREATE TABLE `sistema` (
  `idempresa` int(1) DEFAULT NULL,
  `fechainicio` date DEFAULT NULL,
  `fechavence` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`sistema`
--

/*!40000 ALTER TABLE `sistema` DISABLE KEYS */;
INSERT INTO `sistema` (`idempresa`,`fechainicio`,`fechavence`) VALUES 
 (1,'2024-09-09','2025-09-09'),
 (2,'2024-09-09','2025-09-09'),
 (3,'2024-09-12','2024-09-12'),
 (4,'2024-09-01','2025-09-01'),
 (5,'2024-09-01','2025-09-01');
/*!40000 ALTER TABLE `sistema` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nivel` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT 'L',
  `img` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'avatar5.png',
  `idempresa` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `svweblite`.`users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`nivel`,`img`,`idempresa`) VALUES 
 (1,'Nks','Nks@gmail.com',NULL,'$2y$10$mnhllx62RCScWrHnJSacbe8AVrRHlWbbyMXMI7CC2p8o2L6Uvt9aC',NULL,'2023-03-11 13:04:38','2023-03-11 13:04:38','A','puerta.jpg',2),
 (2,'Mrjuancho','mrjuancho@gmail.com',NULL,'$2y$10$osdPnkipS.9GNI9kB6LipOYtVu8eh/bPas4b/z.DZEL05shJYacC2',NULL,'2023-03-31 04:11:50','2024-01-25 19:56:25','A','avatar.png',1),
 (3,'Administracion','Administracion@gmail.com',NULL,'$2y$10$hBno6ZTHbGhmZ4MFSeQ3GONmAXB4xc6zQW1gY1g36vMxIP7bdbkPm',NULL,'2023-04-24 22:09:31','2023-04-24 22:09:31','A','avatar5.png',1),
 (4,'caja3','caja3@gmail.com',NULL,'$2y$10$RwLfyxIUk8GJ7XowCc8dh.fi6HoY8kRJwtNyRIZekIJ3d87.LUGcu',NULL,'2023-04-24 22:23:40','2023-04-24 22:23:40','L','avatar5.png',1),
 (5,'caja2','caja2@gmail.com',NULL,'$2y$10$nug8TJoG3o.f35ahugyHx.GhhDFlf2trUuP8qtSST15OjIQntNaPe',NULL,'2023-04-05 04:42:24','2023-04-05 04:42:24','L','avatar3.png',1),
 (6,'caja','caja@gmail.com',NULL,'$2y$10$tp8YUmfOzMCuQVa3XevQ9e3ikW9Jf5HybrX8XAMhSFVMXsFmWE57S',NULL,'2023-04-05 04:21:34','2024-04-15 13:25:06','L','avatar2.png',1);
INSERT INTO `users` (`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`nivel`,`img`,`idempresa`) VALUES 
 (7,'admchato','admchato@nks.com',NULL,'$2y$10$EdI2qbA4XJpaukWc0V/i4O5ZcdSdQXeujeb2W1ULFzwLDtXQWjmES',NULL,'2024-09-12 16:35:40','2024-09-12 16:35:40','A','avatar5.png',3),
 (8,'marleny','marleny@nks.com',NULL,'$2y$10$rzybi3Da8XdlQp0qWT1EJ.WKCGpxEFwadFkVbsrk2kKR4CZRWCKJu',NULL,'2024-09-12 16:35:41','2024-09-12 18:09:23','L','avatar5.png',3),
 (9,'karina','karina@nks.com',NULL,'$2y$10$YBNUqnLicXSREAmp1K5mU.ek1C58migvhs9QKVtTtDLCVZNfLU/ga',NULL,'2024-09-12 16:35:41','2024-09-12 17:06:09','L','avatar5.png',3),
 (10,'admfresita','admfresita@nks.com',NULL,'$2y$10$ENxwCufSTWVpQHTwjosD1OwtSXZLpjaC3rKMaabaqzAhYSvLajvvy',NULL,'2024-09-12 17:52:33','2024-09-12 17:52:33','A','avatar5.png',4),
 (11,'kelly','kelly@nks.com',NULL,'$2y$10$xI2KZjsWaiIhsRDhSlsrYuB4kBFrhegSL4YMWJKG6g8bqlu0dHziG',NULL,'2024-09-12 17:52:33','2024-09-12 17:57:38','L','avatar5.png',4),
 (12,'humberto','humberto@nks.com',NULL,'$2y$10$61FzNPLozv7ndU77K2HBZ.xU0QcZ8RtXrQznd2ASnaIQv3ouduLJ6',NULL,'2024-09-12 17:52:34','2024-09-12 17:52:34','A','avatar5.png',4);
INSERT INTO `users` (`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`nivel`,`img`,`idempresa`) VALUES 
 (13,'Wuilmaira','wuilmairayorleipuerta@gmail.com',NULL,'$2y$10$ggDUH5VoDjcxIl4sQPbpE.RnEhzgXE4hGTnyz4cPTxNGaEaWlSANS',NULL,'2024-09-15 22:35:47','2024-09-15 22:35:47','L','avatar5.png',NULL),
 (14,'chiki','chiki@nks.com',NULL,'$2y$10$kABgJvaVmB64wlYlUns4Qe0cuFdeZMA9zqiFZVU.DJzfwqQDYZQwW',NULL,'2024-09-15 22:36:54','2024-09-15 22:36:54','A','avatar5.png',5),
 (15,'admchiki','admchiki@gmail.com',NULL,'$2y$10$o8jCSEeGpaqhV9V6X8YMTe9zRISCA4DpRGG/MZpcaOVAR.d82Kqzy',NULL,'2024-09-15 22:36:54','2024-09-15 22:39:18','L','avatar5.png',5),
 (16,'gerenciachiki','gerencchiki@nks.com',NULL,'$2y$10$U4xCJigyUtGjB0I5LD9rVOurNPQSUwtaQ4BJXlsGCnHb/OSRbJ3UG',NULL,'2024-09-15 22:36:55','2024-09-15 22:36:55','A','avatar5.png',5);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
CREATE TABLE `vendedores` (
  `idempresa` int(2) DEFAULT NULL,
  `id_vendedor` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `comision` int(3) DEFAULT '0',
  `cedula` varchar(20) DEFAULT NULL,
  `tipo` varchar(2) DEFAULT 'V',
  PRIMARY KEY (`id_vendedor`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`vendedores`
--

/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` (`idempresa`,`id_vendedor`,`nombre`,`telefono`,`direccion`,`comision`,`cedula`,`tipo`) VALUES 
 (2,1,'DIRECTO','(414) 231-5233','merida`',0,'v000000','V'),
 (2,2,'Contado','(412) 125-2452','Sta Cruz',0,'v00000','V'),
 (1,3,'directo unio',NULL,'merdia',0,'v56465456','V'),
 (2,4,'MARIA','(654) 684-6516','mamamm',2,'v6468751','V'),
 (4,5,'ALEXANDER','(567) 675-6777','mesa bolivar',0,'v474754','V'),
 (3,6,'DIRECTO CHATO','(132) 132-1323','romero',0,'v5461312','V'),
 (5,7,'MARÍA LÓPEZ','(042) 616-9645','Rossi',0,'19834486','V');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;


--
-- Table structure for table `svweblite`.`venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE `venta` (
  `idempresa` int(3) DEFAULT NULL,
  `idventa` int(8) NOT NULL AUTO_INCREMENT,
  `controlventa` int(11) DEFAULT NULL,
  `idcliente` int(8) NOT NULL,
  `idvendedor` int(3) DEFAULT NULL,
  `tipo_comprobante` varchar(10) NOT NULL,
  `serie_comprobante` varchar(15) NOT NULL,
  `num_comprobante` int(10) NOT NULL,
  `flibre` int(22) DEFAULT '0',
  `control` varchar(10) DEFAULT NULL,
  `tasa` float(9,3) DEFAULT '0.000',
  `total_venta` float(11,2) NOT NULL,
  `base` float(9,3) DEFAULT '0.000',
  `total_iva` float(9,3) DEFAULT '0.000',
  `texe` float(9,3) DEFAULT '0.000',
  `descuento` double(15,3) DEFAULT '0.000',
  `total_pagar` float(9,3) DEFAULT '0.000',
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_emi` date DEFAULT NULL,
  `impuesto` int(2) NOT NULL,
  `saldo` float(11,2) NOT NULL,
  `mret` float(9,3) DEFAULT '0.000',
  `estado` varchar(10) NOT NULL,
  `devolu` int(2) NOT NULL,
  `comision` double(8,3) DEFAULT '0.000',
  `montocomision` float(9,3) DEFAULT NULL,
  `idcomision` int(5) DEFAULT '0',
  `user` varchar(15) NOT NULL,
  PRIMARY KEY (`idventa`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `svweblite`.`venta`
--

/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` (`idempresa`,`idventa`,`controlventa`,`idcliente`,`idvendedor`,`tipo_comprobante`,`serie_comprobante`,`num_comprobante`,`flibre`,`control`,`tasa`,`total_venta`,`base`,`total_iva`,`texe`,`descuento`,`total_pagar`,`fecha_hora`,`fecha_emi`,`impuesto`,`saldo`,`mret`,`estado`,`devolu`,`comision`,`montocomision`,`idcomision`,`user`) VALUES 
 (2,1,1,3,1,'FAC','A',1,0,'00-',35.810,17.40,537.150,85.940,0.000,0.000,0.000,'2024-09-10 13:57:33','2024-09-10',16,0.00,0.000,'Contado',0,0.000,0.000,0,'Nks'),
 (2,2,2,1,1,'FAC','A',2,0,'00-',35.810,1.16,0.000,0.000,41.530,0.000,0.000,'2024-09-10 14:54:44','2024-09-10',16,0.00,0.000,'Contado',0,0.000,0.000,0,'Nks'),
 (2,3,3,3,1,'FAC','A',3,0,'00-',35.810,18.56,537.150,85.940,41.530,0.000,0.000,'2024-09-10 15:04:17','2024-09-10',16,0.00,0.000,'Contado',1,0.000,0.000,0,'Nks'),
 (1,4,1,2,3,'FAC','A',1,0,'00-',35.810,1.88,0.000,0.000,67.320,0.000,0.000,'2024-09-10 15:08:03','2024-09-10',16,0.00,0.000,'Contado',0,0.000,0.000,0,'Administracion'),
 (2,5,4,1,1,'FAC','A',4,0,'00-',35.810,17.40,537.150,85.940,0.000,0.000,0.000,'2024-09-10 15:45:11','2024-09-10',16,0.00,0.000,'Contado',0,0.000,0.000,0,'Nks');
INSERT INTO `venta` (`idempresa`,`idventa`,`controlventa`,`idcliente`,`idvendedor`,`tipo_comprobante`,`serie_comprobante`,`num_comprobante`,`flibre`,`control`,`tasa`,`total_venta`,`base`,`total_iva`,`texe`,`descuento`,`total_pagar`,`fecha_hora`,`fecha_emi`,`impuesto`,`saldo`,`mret`,`estado`,`devolu`,`comision`,`montocomision`,`idcomision`,`user`) VALUES 
 (2,6,5,4,1,'FAC','A',5,0,'00-',35.810,18.56,537.150,85.940,41.530,0.000,0.000,'2024-09-10 15:46:12','2024-09-10',16,13.56,0.000,'Credito',0,0.000,0.000,0,'Nks'),
 (2,7,6,5,4,'FAC','A',6,0,'00-',35.810,20.36,537.150,85.940,105.980,0.000,0.000,'2024-09-10 15:56:10','2024-09-10',16,20.36,0.000,'Credito',0,2.000,0.407,0,'Nks'),
 (2,8,7,4,1,'FAC','A',7,0,'00-',35.810,1.80,0.000,0.000,64.450,0.000,0.000,'2024-09-10 16:16:05','2024-09-10',16,1.80,0.000,'Credito',0,0.000,0.000,0,'Nks'),
 (1,9,2,6,3,'FAC','A\r\nA',2,0,'00-',35.810,1.91,0.000,0.000,68.390,0.000,0.000,'2024-09-11 19:00:03','2024-09-11',16,1.91,0.000,'Credito',0,0.000,0.000,0,'Administracion'),
 (4,10,1,7,5,'FAC','A',1,0,'00-',10.000,2.64,0.000,0.000,26.400,0.000,0.000,'2024-09-12 19:00:36','2024-09-12',16,0.00,0.000,'Contado',0,0.000,0.000,0,'admfresita');
INSERT INTO `venta` (`idempresa`,`idventa`,`controlventa`,`idcliente`,`idvendedor`,`tipo_comprobante`,`serie_comprobante`,`num_comprobante`,`flibre`,`control`,`tasa`,`total_venta`,`base`,`total_iva`,`texe`,`descuento`,`total_pagar`,`fecha_hora`,`fecha_emi`,`impuesto`,`saldo`,`mret`,`estado`,`devolu`,`comision`,`montocomision`,`idcomision`,`user`) VALUES 
 (5,11,1,8,7,'FAC','A',1,0,'00-',38.460,103.82,3802.140,190.100,0.000,0.000,0.000,'2024-09-15 23:17:55','2024-09-15',16,0.00,0.000,'Contado',0,0.000,0.000,0,'chiki');
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
