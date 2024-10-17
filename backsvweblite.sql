-- MySQL dump 10.13  Distrib 5.7.33, for Win64 (x86_64)
--
-- Host: localhost    Database: svweblite
-- ------------------------------------------------------
-- Server version	5.7.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ajustes`
--

DROP TABLE IF EXISTS `ajustes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ajustes` (
  `idempresa` int(3) DEFAULT NULL,
  `idajuste` int(8) NOT NULL AUTO_INCREMENT,
  `controlajuste` int(11) DEFAULT NULL,
  `concepto` varchar(80) NOT NULL,
  `responsable` varchar(30) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `monto` float(11,2) NOT NULL,
  PRIMARY KEY (`idajuste`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ajustes`
--

LOCK TABLES `ajustes` WRITE;
/*!40000 ALTER TABLE `ajustes` DISABLE KEYS */;
INSERT INTO `ajustes` VALUES (1,1,1,'nks','ajuste','2024-09-23 01:40:50',180.00),(2,2,1,'cargo cafe','nks','2024-10-05 23:10:10',62.50),(1,3,2,'cargo','nks','2024-10-17 18:39:07',225.00);
/*!40000 ALTER TABLE `ajustes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS `articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` VALUES (1,1,1,'0010000001','CAFE',6.000,NULL,'und',0.000,0.000,'ninguna.jpg','Activo',20.00,45.00,0.00,0.000,0.000,30.000,0.000,0,0,NULL,'2024-09-23 01:40:23','2024-10-17 04:28:17'),(2,2,2,'0010000001','CAFE',22.000,NULL,'und',0.000,0.000,'ninguna.jpg','Activo',50.00,3.75,3.75,0.000,50.000,2.500,0.000,0,0,NULL,'2024-10-05 23:07:15',NULL),(1,3,1,'0010000002','CACAO IMPERIAL',10.000,NULL,'und',0.000,0.000,'ninguna.jpg','Activo',25.00,3.13,0.00,0.000,0.000,2.500,0.000,0,0,NULL,'2024-10-17 03:12:47',NULL),(1,4,1,'0010000004','LECHE CONDENSADA',10.000,NULL,'und',0.000,0.000,'ninguna.jpg','Activo',20.00,27.84,0.00,0.000,0.000,20.000,0.000,16,0,NULL,'2024-10-17 18:38:34',NULL);
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bancos`
--

DROP TABLE IF EXISTS `bancos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancos`
--

LOCK TABLES `bancos` WRITE;
/*!40000 ALTER TABLE `bancos` DISABLE KEYS */;
/*!40000 ALTER TABLE `bancos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `idempresa` int(3) DEFAULT NULL,
  `idcategoria` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `condicion` int(2) NOT NULL,
  `licor` int(2) DEFAULT '0',
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,1,'VIVERES','viveres',1,0),(2,2,'VIVERES','viveres',1,0);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,1,'JUAN ANTONIO','V4654654','V46546549','(654) 646-5465',NULL,'A','merida',0,5,1,0,1,'2024-09-22','2024-10-05','C'),(2,2,'JLUIS GUILLEN','V566465','V566465','(645) 454-5455',NULL,'A','romero',1,0,1,0,2,'2024-10-05','2024-10-05','C'),(2,3,'MARIA LUISA','V568741845','V568741845','(414) 656-5666',NULL,'A','santa cruz',0,15,1,0,2,'2024-10-05','2024-10-05','C'),(1,4,'MARCO MOLINA','V87468575','V87468575','(546) 546-5468',NULL,'A','merida',0,0,1,0,1,'2024-10-05','2024-10-05','C'),(1,5,'CARLOS ANDRADE','V5687418','V5687418','(654) 646-5466',NULL,'A','merida',1,NULL,1,0,1,'2024-10-05','2024-10-05','C'),(1,6,'MARIA LUISA','V568741845','V568741845','(465) 465-4656',NULL,'A','merdia',1,NULL,1,0,1,'2024-10-05',NULL,'C'),(1,7,'FERNANDO USECHE','V8800754','V8800754','(424) 152-1254',NULL,'A','romero',1,NULL,1,0,1,'2024-10-16',NULL,'C'),(1,8,'WUILMER PUERTA','V16604674','V166046749','(424) 716-3726',NULL,'A','roemro',1,NULL,1,0,1,'2024-10-16',NULL,'C');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comisiones`
--

DROP TABLE IF EXISTS `comisiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comisiones`
--

LOCK TABLES `comisiones` WRITE;
/*!40000 ALTER TABLE `comisiones` DISABLE KEYS */;
/*!40000 ALTER TABLE `comisiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comprobante`
--

DROP TABLE IF EXISTS `comprobante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comprobante`
--

LOCK TABLES `comprobante` WRITE;
/*!40000 ALTER TABLE `comprobante` DISABLE KEYS */;
/*!40000 ALTER TABLE `comprobante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ctascon`
--

DROP TABLE IF EXISTS `ctascon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ctascon` (
  `idcod` int(5) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) CHARACTER SET utf8 NOT NULL,
  `descrip` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tipo` double(2,0) NOT NULL DEFAULT '0',
  `inactiva` double(1,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `idcod` (`idcod`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ctascon`
--

LOCK TABLES `ctascon` WRITE;
/*!40000 ALTER TABLE `ctascon` DISABLE KEYS */;
INSERT INTO `ctascon` VALUES (1,'0001000100','Ingreso Ventas ',1,0),(2,'0001002122','Ingreso Cobranza',1,0),(6,'001-165456-4545','PRESTAMO CLIENTES',2,0),(3,'00120121020','Pago a Proveedores',2,0),(8,'00200010002','Pago Comisiones',2,0),(10,'00213','NOTA ADMINISTRATIVA(C/D)',2,0),(4,'00213452124','EGRESO GASTOS',2,0),(7,'0021355','EGRESO PAGO COMPRAS',2,0),(9,'00213556','INGRESO NOTA ADMINISTRATIVA',1,0),(11,'00256687','OTROS INGRESOS',1,0),(5,'01525451','Transferencias Bancos',3,0);
/*!40000 ALTER TABLE `ctascon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datacsv`
--

DROP TABLE IF EXISTS `datacsv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datacsv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idarticulo` int(5) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `costo` float(9,3) DEFAULT NULL,
  `cantidad` float(9,3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datacsv`
--

LOCK TABLES `datacsv` WRITE;
/*!40000 ALTER TABLE `datacsv` DISABLE KEYS */;
/*!40000 ALTER TABLE `datacsv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_ajustes`
--

DROP TABLE IF EXISTS `detalle_ajustes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_ajustes` (
  `iddetalle_ajuste` int(5) NOT NULL AUTO_INCREMENT,
  `idajuste` int(8) NOT NULL,
  `idarticulo` int(8) NOT NULL,
  `tipo_ajuste` varchar(15) NOT NULL,
  `cantidad` float(9,3) NOT NULL,
  `costo` float(11,2) NOT NULL,
  `valorizado` float(11,2) NOT NULL,
  PRIMARY KEY (`iddetalle_ajuste`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_ajustes`
--

LOCK TABLES `detalle_ajustes` WRITE;
/*!40000 ALTER TABLE `detalle_ajustes` DISABLE KEYS */;
INSERT INTO `detalle_ajustes` VALUES (1,1,1,'Cargo',10.000,18.00,180.00),(2,2,2,'Cargo',25.000,2.50,62.50),(3,3,3,'Cargo',10.000,2.50,25.00),(4,3,4,'Cargo',10.000,20.00,200.00);
/*!40000 ALTER TABLE `detalle_ajustes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_compras`
--

DROP TABLE IF EXISTS `detalle_compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_compras`
--

LOCK TABLES `detalle_compras` WRITE;
/*!40000 ALTER TABLE `detalle_compras` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_devolucion`
--

DROP TABLE IF EXISTS `detalle_devolucion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_devolucion` (
  `iddetalle_devolucion` int(8) NOT NULL AUTO_INCREMENT,
  `iddevolucion` int(8) NOT NULL,
  `idarticulo` int(8) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `precio_venta` float(11,2) NOT NULL,
  `descuento` float(11,2) NOT NULL,
  PRIMARY KEY (`iddetalle_devolucion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_devolucion`
--

LOCK TABLES `detalle_devolucion` WRITE;
/*!40000 ALTER TABLE `detalle_devolucion` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_devolucion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_devolucioncompras`
--

DROP TABLE IF EXISTS `detalle_devolucioncompras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_devolucioncompras` (
  `iddetalle` int(5) NOT NULL AUTO_INCREMENT,
  `iddevolucion` int(5) NOT NULL,
  `codarticulo` int(5) DEFAULT NULL,
  `cantidad` float(9,3) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`iddetalle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_devolucioncompras`
--

LOCK TABLES `detalle_devolucioncompras` WRITE;
/*!40000 ALTER TABLE `detalle_devolucioncompras` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_devolucioncompras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_pedido`
--

DROP TABLE IF EXISTS `detalle_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedido`
--

LOCK TABLES `detalle_pedido` WRITE;
/*!40000 ALTER TABLE `detalle_pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_venta`
--

DROP TABLE IF EXISTS `detalle_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_venta`
--

LOCK TABLES `detalle_venta` WRITE;
/*!40000 ALTER TABLE `detalle_venta` DISABLE KEYS */;
INSERT INTO `detalle_venta` VALUES (1,1,1,18.000,2.00,21.600,0.00,'2024-10-05 22:43:17','2024-10-05'),(2,2,2,2.500,1.00,3.750,0.00,'2024-10-05 22:46:43','2024-10-05'),(3,3,2,2.500,1.00,5.000,0.00,'2024-10-05 22:53:27','2024-10-05'),(4,4,1,18.000,1.00,18.000,0.00,'2024-10-05 22:55:11','2024-10-05'),(5,5,2,2.500,1.00,3.750,0.00,'2024-10-05 23:09:45','2024-10-05'),(6,6,1,18.000,1.00,21.600,0.00,'2024-10-05 23:11:57','2024-10-05');
/*!40000 ALTER TABLE `detalle_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devolucion`
--

DROP TABLE IF EXISTS `devolucion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devolucion` (
  `idempresa` int(3) DEFAULT NULL,
  `iddevolucion` int(8) NOT NULL AUTO_INCREMENT,
  `idventa` int(8) NOT NULL,
  `comprobante` varchar(15) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(20) NOT NULL,
  PRIMARY KEY (`iddevolucion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devolucion`
--

LOCK TABLES `devolucion` WRITE;
/*!40000 ALTER TABLE `devolucion` DISABLE KEYS */;
/*!40000 ALTER TABLE `devolucion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devolucioncompras`
--

DROP TABLE IF EXISTS `devolucioncompras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devolucioncompras` (
  `iddevolucion` int(5) NOT NULL AUTO_INCREMENT,
  `idcompra` int(5) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`iddevolucion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devolucioncompras`
--

LOCK TABLES `devolucioncompras` WRITE;
/*!40000 ALTER TABLE `devolucioncompras` DISABLE KEYS */;
/*!40000 ALTER TABLE `devolucioncompras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES (1,'3e17fb7b-40ea-4787-0644-df3bb20a97f5',100,'CORPORACION DE SISTEMAS NKS','SANTAC RUZ DE MORA','V8887524','045612125','2024-09-09','2024-09-09',0,0,40.90,3700.00,NULL,4.160,0,'A','nks_color9.jpg',0,0,0,0,1),(2,'64687641684',NULL,'FRESITA','santa cruz de mora','v654654','13135435','2024-10-01','2024-10-01',0,0,39.66,3700.00,NULL,NULL,0,'A','logoempresa.png',0,0,0,0,0);
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formalibre`
--

DROP TABLE IF EXISTS `formalibre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formalibre` (
  `idforma` int(11) NOT NULL AUTO_INCREMENT,
  `idventa` int(11) DEFAULT NULL,
  `nrocontrol` int(11) DEFAULT NULL,
  `anulado` int(1) DEFAULT '0',
  PRIMARY KEY (`idforma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formalibre`
--

LOCK TABLES `formalibre` WRITE;
/*!40000 ALTER TABLE `formalibre` DISABLE KEYS */;
/*!40000 ALTER TABLE `formalibre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gastos`
--

DROP TABLE IF EXISTS `gastos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastos`
--

LOCK TABLES `gastos` WRITE;
/*!40000 ALTER TABLE `gastos` DISABLE KEYS */;
/*!40000 ALTER TABLE `gastos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kardex`
--

DROP TABLE IF EXISTS `kardex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kardex`
--

LOCK TABLES `kardex` WRITE;
/*!40000 ALTER TABLE `kardex` DISABLE KEYS */;
INSERT INTO `kardex` VALUES (1,'2024-09-22 21:10:50','AJUS-1',1,10.000,18.000,'Nks',1),(2,'2024-10-05 18:40:10','AJUS-2',2,25.000,2.500,'admfresita',1),(3,'2024-10-05 18:43:17','VENT-1',1,2.000,18.000,'Nks',2),(4,'2024-10-05 18:46:43','VENT-1',2,1.000,2.500,'admfresita',2),(5,'2024-10-05 18:53:27','VENT-2',2,1.000,2.500,'admfresita',2),(6,'2024-10-05 18:55:11','VENT-2',1,1.000,18.000,'Nks',2),(7,'2024-10-05 19:09:45','VENT-3',2,1.000,2.500,'admfresita',2),(8,'2024-10-05 19:11:56','VENT-3',1,1.000,18.000,'Nks',2),(9,'2024-10-17 14:09:07','AJUS-3',3,10.000,2.500,'Nks',1),(10,'2024-10-17 14:09:07','AJUS-3',4,10.000,20.000,'Nks',1);
/*!40000 ALTER TABLE `kardex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_03_13_175600_articulos',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monedas`
--

DROP TABLE IF EXISTS `monedas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monedas`
--

LOCK TABLES `monedas` WRITE;
/*!40000 ALTER TABLE `monedas` DISABLE KEYS */;
INSERT INTO `monedas` VALUES (1,1,'Dolares Transf.',0,'$',1.000,0,2),(1,2,'Bolivares',1,'Bs',40.900,1,0),(1,3,'pesos',1,'Ps',3700.000,2,0),(2,4,'bolivares',1,'bs',39.660,1,0),(2,5,'pesos',1,'ps',3700.000,2,0),(2,6,'Dolares efectivo',0,'$',1.000,0,0),(1,7,'Zelle',0,'$',1.000,0,0);
/*!40000 ALTER TABLE `monedas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mov_ban`
--

DROP TABLE IF EXISTS `mov_ban`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mov_ban`
--

LOCK TABLES `mov_ban` WRITE;
/*!40000 ALTER TABLE `mov_ban` DISABLE KEYS */;
/*!40000 ALTER TABLE `mov_ban` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mov_notas`
--

DROP TABLE IF EXISTS `mov_notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mov_notas`
--

LOCK TABLES `mov_notas` WRITE;
/*!40000 ALTER TABLE `mov_notas` DISABLE KEYS */;
/*!40000 ALTER TABLE `mov_notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mov_notasp`
--

DROP TABLE IF EXISTS `mov_notasp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mov_notasp`
--

LOCK TABLES `mov_notasp` WRITE;
/*!40000 ALTER TABLE `mov_notasp` DISABLE KEYS */;
/*!40000 ALTER TABLE `mov_notasp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notasadm`
--

DROP TABLE IF EXISTS `notasadm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notasadm`
--

LOCK TABLES `notasadm` WRITE;
/*!40000 ALTER TABLE `notasadm` DISABLE KEYS */;
/*!40000 ALTER TABLE `notasadm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notasadmp`
--

DROP TABLE IF EXISTS `notasadmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notasadmp`
--

LOCK TABLES `notasadmp` WRITE;
/*!40000 ALTER TABLE `notasadmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `notasadmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recibos`
--

DROP TABLE IF EXISTS `recibos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recibos`
--

LOCK TABLES `recibos` WRITE;
/*!40000 ALTER TABLE `recibos` DISABLE KEYS */;
INSERT INTO `recibos` VALUES (1,1,0,'P',43.20,1,0,'Dolares Transf.',43.20,40.90,3700.00,NULL,'0.00','2024-10-05 23:13:17','Nks'),(2,2,0,'P',3.75,5,0,'pesos',13875.00,39.66,3700.00,'Tc: 3700','0.00','2024-10-05 23:16:43','admfresita'),(3,4,0,'A',12.22,2,0,'Bolivares',500.00,40.90,3700.00,'Tc: 40.9','5.78','2024-10-05 23:25:58','Nks'),(4,3,0,'A',2.52,4,0,'bolivares',100.00,39.66,3700.00,'Tc: 39.66','2.48','2024-10-05 23:29:10','admfresita'),(5,5,0,'P',3.75,6,0,'Dolares efectivo',3.75,39.66,3700.00,NULL,'0.00','2024-10-05 23:39:45','admfresita'),(6,6,0,'P',21.60,7,0,'Zelle',21.60,40.90,3700.00,NULL,'0.00','2024-10-05 23:41:56','Nks'),(7,4,0,'A',5.78,1,0,'Dolares Transf.',5.78,40.90,3700.00,NULL,'0.00','2024-10-12 03:30:54','Nks');
/*!40000 ALTER TABLE `recibos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reciboscomision`
--

DROP TABLE IF EXISTS `reciboscomision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reciboscomision` (
  `id_recibo` int(5) NOT NULL AUTO_INCREMENT,
  `id_comision` int(5) DEFAULT NULL,
  `monto` float(9,3) DEFAULT NULL,
  `observacion` varchar(80) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `user` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_recibo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reciboscomision`
--

LOCK TABLES `reciboscomision` WRITE;
/*!40000 ALTER TABLE `reciboscomision` DISABLE KEYS */;
/*!40000 ALTER TABLE `reciboscomision` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relacionnc`
--

DROP TABLE IF EXISTS `relacionnc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relacionnc` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `idmov` int(5) DEFAULT NULL,
  `idnota` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relacionnc`
--

LOCK TABLES `relacionnc` WRITE;
/*!40000 ALTER TABLE `relacionnc` DISABLE KEYS */;
/*!40000 ALTER TABLE `relacionnc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relacionncp`
--

DROP TABLE IF EXISTS `relacionncp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relacionncp` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `idmov` int(5) DEFAULT NULL,
  `idnota` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relacionncp`
--

LOCK TABLES `relacionncp` WRITE;
/*!40000 ALTER TABLE `relacionncp` DISABLE KEYS */;
/*!40000 ALTER TABLE `relacionncp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retenc`
--

DROP TABLE IF EXISTS `retenc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retenc`
--

LOCK TABLES `retenc` WRITE;
/*!40000 ALTER TABLE `retenc` DISABLE KEYS */;
INSERT INTO `retenc` VALUES (1,'001','HONORARIOS, SUELDOS Y SALARIOS',3,100.0000000,3.0000000,2125.0000000,70833.3300000,1),(2,'002','(PNR)-Honorarios Profesionales No Mercantiles',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),(3,'003','(PNNR)-Honorarios Profesionales No Mercantiles',4,90.0000000,34.0000000,0.0000000,0.0000000,0),(4,'004','(PJD)-Honorarios Profesionales No Mercantiles',1,100.0000000,5.0000000,0.0000000,25.0000000,0),(5,'005','(PJND)-Honorarios Profesionales No Mercantiles',2,90.0000000,15.0000000,0.0000000,0.0100000,0),(6,'006','(PNR)-Honorarios Profesionales Mancomunados No Mercantiles',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),(7,'007','(PNNR)-Honorarios Profesionales Mancomunados No Mercantiles',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(8,'008','(PJD)-Honorarios Profesionales Mancomunados No Mercantiles',1,100.0000000,5.0000000,0.0000000,25.0000000,0),(9,'055','(PJND)-Honorarios Profesionales Mancomunados No Mercantiles',2,100.0000000,15.0000000,0.0000000,0.0100000,0),(10,'010','(PNR)-Honorarios Profesionales pagados a Jinetes, Veterinarios, Preparadores o E',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),(11,'011','(PNNR)-Honorarios Profesionales pagados a Jinetes, Veterinarios, Preparadores o',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(12,'012','(PNR)-Honorarios Profesionales pagados por Clínicas, Hospitales, Centros de Salu',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),(13,'013','(PNNR)-Honorarios Profesionales pagados por Clínicas, Hospitales, Centros de Sal',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(14,'014','(PNR)-Comisiones pagadas por la venta de bienes inmuebles',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),(15,'015','(PNNR)-Comisiones pagadas por la venta de bienes inmuebles',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(16,'016','(PJD)-Comisiones pagadas por la venta de bienes inmuebles',1,100.0000000,5.0000000,0.0000000,25.0000000,0),(17,'017','(PJND)Comisiones pagadas por la venta de bienes inmuebles',2,100.0000000,5.0000000,0.0000000,0.0100000,0),(18,'018','(PNR)-Cualquier otra Comisión distintas a Remuneraciones accesorias de los sueld',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),(19,'019','(PNNR)-Cualquier otra Comisión distintas a Remuneraciones accesorias de los suel',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(20,'020','(PJD)-Cualquier otra Comisión distintas a Remuneraciones accesorias de los sueld',1,100.0000000,5.0000000,0.0000000,25.0000000,0),(21,'021','(PJND)-Cualquier otra Comisión distintas a Remuneraciones accesorias de los suel',2,100.0000000,5.0000000,0.0000000,0.0100000,0),(22,'022','(PNNR)-Intereses de Capitales tomados en préstamo e invertidos en la producción',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(23,'023','(PJND)-Intereses de Capitales tomados en préstamo e invertidos en la producción',2,100.0000000,15.0000000,0.0000000,0.0100000,0),(24,'024','(PJND)-Intereses provenientes de prestamos y otros creditos pagaderos a instituc',2,100.0000000,4.9500000,0.0000000,0.0100000,0),(25,'025','(PNR)-Intereses pagados por las personas jurídicas o comunidades a cualquier otr',4,100.0000000,3.0000000,0.0000000,0.0000000,0),(26,'026','(PNNR)-Intereses pagados por las personas jurídicas o comunidades a cualquier ot',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(27,'027','(PJD)-Intereses pagados por las personas jurídicas o comunidades a cualquier otr',1,100.0000000,5.0000000,0.0000000,25.0000000,0),(28,'028','(PJND)-Intereses pagados por las personas jurídicas o comunidades a cualquier ot',4,100.0000000,15.0000000,0.0000000,0.0000000,0),(29,'029','(PJND)-Enriquecimientos Netos de las Agencias Internacionales cuando el pagador',2,100.0000000,15.0000000,0.0000000,0.0100000,0),(30,'030','(PNNR)-Enriquecimientos Netos de Gastos de Transporte conformados por fletes pag',4,100.0000000,15.0000000,0.0000000,0.0000000,0),(31,'031','(PJND)-Enriquecimientos Netos de Gastos de Transporte conformados por fletes pag',2,100.0000000,15.0000000,0.0000000,0.0100000,0),(32,'032','(PNNR)-Enriquecimientos Netos de Exhibición de Películas, Cine o la Televisión',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(33,'033','(PJND)-Enriquecimientos Netos de Exhibición de Películas, Cine o la Televisión',2,100.0000000,15.0000000,0.0000000,0.0100000,0),(34,'034','(PNNR)-Enriquecimientos obtenidos por concepto de regalías y demás participacion',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(35,'035','(PJND)-Enriquecimientos obtenidos por concepto de regalías y demás participacion',4,100.0000000,15.0000000,0.0000000,0.0000000,0),(36,'036','(PNNR)-Enriquecimientos obtenidos por las Remuneraciones, Honorarios y pagos aná',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(37,'037','(PJND)-Enriquecimientos obtenidos por las Remuneraciones, Honorarios y pagos aná',2,100.0000000,15.0000000,0.0000000,0.0100000,0),(38,'038','(PNNR)-Enriquecimientos obtenidos por Servicios Tecnológicos utilizados en el pa',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(39,'039','(PJND)-Enriquecimientos obtenidos por Servicios Tecnológicos utilizados en el pa',2,100.0000000,15.0000000,0.0000000,0.0100000,0),(40,'040','(PJND)-Enriquecimientos Netos derivados de las Primas de Seguros y Reaseguros',2,100.0000000,10.0000000,0.0000000,0.0100000,0),(41,'041','(PNR)-Ganancias Obtenidas por Juegos y Apuestas',3,100.0000000,34.0000000,2125.0000000,70833.3300000,0),(42,'042','(PNNR)-Ganancias Obtenidas por Juegos y Apuestas',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(43,'043','(PJD)-Ganancias Obtenidas por Juegos y Apuestas',1,100.0000000,34.0000000,0.0000000,25.0000000,0),(44,'044','(PJND)-Ganancias Obtenidas por Juegos y Apuestas',2,100.0000000,34.0000000,0.0000000,0.0100000,0),(45,'045','(PNR)-Ganancias Obtenidas por Premios de Loterías y de Hipódromos',3,100.0000000,16.0000000,2125.0000000,70833.3300000,0),(46,'046','(PNNR)-Ganancias Obtenidas por Premios de Loterías y de Hipódromos',4,100.0000000,16.0000000,0.0000000,0.0000000,0),(47,'047','(PJD)-Ganancias Obtenidas por Premios de Loterías y de Hipódromos',1,100.0000000,16.0000000,0.0000000,25.0000000,0),(48,'048','(PJND)-Ganancias Obtenidas por Premios de Loterías y de Hipódromos',2,100.0000000,16.0000000,0.0000000,0.0100000,0),(49,'049','(PNR)-Pagos a Propietarios de Animales de Carrera por concepto de Premios',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),(50,'050','(PNNR)-Pagos a Propietarios de Animales de Carrera por concepto de Premios',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(51,'051','(PJD)-Pagos a Propietarios de Animales de Carrera por concepto de Premios',1,100.0000000,5.0000000,0.0000000,25.0000000,0),(52,'052','(PJND)-Pagos a Propietarios de Animales de Carrera por concepto de Premios',2,100.0000000,5.0000000,0.0000000,0.0100000,0),(53,'053','(PNR)-Pagos a Empresas Contratistas o Subcontratistas domiciliadas o no en el pa',3,100.0000000,1.0000000,2125.0000000,70833.3300000,0),(54,'054','(PNNR)-Pagos a Empresas Contratistas o Subcontratistas domiciliadas o no en el p',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(55,'055','(PJD)-Pagos a Empresas Contratistas o Subcontratistas domiciliadas o no en el pa',1,100.0000000,2.0000000,0.0000000,25.0000000,0),(56,'056','(PJND)-Pagos a Empresas Contratistas o Subcontratistas domiciliadas o no en el p',2,100.0000000,15.0000000,0.0000000,0.0100000,0),(57,'057','(PNR)-Pagos de los Arrendadores de bienes inmuebles situados en el pais',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),(58,'058','(PNNR)-Pagos de los Arrendadores de bienes inmuebles situados en el pais',4,90.0000000,34.0000000,0.0000000,0.0000000,0),(59,'059','(PJD)-Pagos de los Arrendadores de bienes inmuebles situados en el pais',1,100.0000000,5.0000000,0.0000000,25.0000000,0),(60,'060','(PJND)-Pagos de los Arrendadores de bienes inmuebles situados en el pais',2,90.0000000,15.0000000,0.0000000,0.0100000,0),(61,'061','(PNR)-Cánones de Arrendamientos de Bienes Muebles situados en el país',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),(62,'062','(PNNR)-Cánones de Arrendamientos de Bienes Muebles situados en el país',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(63,'063','(PJD)-Cánones de Arrendamientos de Bienes Muebles situados en el país',1,100.0000000,5.0000000,0.0000000,25.0000000,0),(64,'064','(PJND)-Cánones de Arrendamientos de Bienes Muebles situados en el país',2,100.0000000,5.0000000,0.0000000,0.0100000,0),(65,'065','(PNR)-Pagos de las Empresas Emisoras de Tarjetas de Crédito o Consumo por la Ven',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),(66,'066','(PNNR)-Pagos de las Empresas Emisoras de Tarjetas de Crédito o Consumo por la Ve',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(67,'067','(PJD)-Pagos de las Empresas Emisoras de Tarjetas de Crédito o Consumo por la Ven',1,100.0000000,5.0000000,0.0000000,25.0000000,0),(68,'068','(PJND)-Pagos de las Empresas Emisoras de Tarjetas de Crédito o Consumo por la Ve',2,100.0000000,5.0000000,0.0000000,0.0100000,0),(69,'069','(PNR)-Pagos de las Empresas Emisoras de Tarjetas de Crédito por la venta de gaso',3,100.0000000,1.0000000,2125.0000000,70833.3300000,0),(70,'070','(PJD)-Pagos de las Empresas Emisoras de Tarjetas de Crédito por la venta de gaso',1,100.0000000,1.0000000,0.0000000,25.0000000,0),(71,'071','(PNR)-Pagos por Gastos de Transporte conformados por Fletes',3,100.0000000,1.0000000,708.3300000,70833.3300000,0),(72,'072','(PJD)-Pagos por Gastos de Transporte conformados por Fletes',1,100.0000000,3.0000000,0.0000000,25.0000000,0),(73,'073','(PNR)-Pagos de las Empresas de Seguro, las Sociedades de Corretaje de Seguros y',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),(74,'074','(PJD)-Pagos de las Empresas de Seguro, las Sociedades de Corretaje de Seguros y',1,100.0000000,5.0000000,0.0000000,25.0000000,0),(75,'075','(PNR)-Pagos de las Empresas de Seguro a sus Contratistas por la Reparación de Da',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),(76,'076','(PJD)-Pagos de las Empresas de Seguro a sus Contratistas por la Reparación de Da',1,100.0000000,5.0000000,0.0000000,25.0000000,0),(77,'077','(PNR)-Pagos de las Empresas de Seguros a Clínicas, Hospitales y/o Centros de Sal',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),(78,'078','(PJD)-Pagos de las Empresas de Seguros a Clínicas, Hospitales y/o Centros de Sal',1,100.0000000,5.0000000,0.0000000,25.0000000,0),(79,'079','(PNR)-Cantidades que se paguen por adquisición de Fondos de Comercio situados en',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),(80,'080','(PNNR)-Cantidades que se paguen por adquisición de Fondos de Comercio situados e',4,100.0000000,34.0000000,0.0000000,0.0000000,0),(81,'081','(PJD)-Cantidades que se paguen por adquisición de Fondos de Comercio situados en',1,100.0000000,5.0000000,0.0000000,25.0000000,0),(82,'082','(PJND)-Cantidades que se paguen por adquisición de Fondos de Comercio situados e',2,100.0000000,5.0000000,0.0000000,0.0100000,0),(83,'083','(PNR)-Pagos por Servicios de Publicidad y Propaganda y la Cesión de la Venta de',3,100.0000000,3.0000000,2125.0000000,70833.3300000,0),(84,'084','(PJD)-Pagos por Servicios de Publicidad y Propaganda y la Cesión de la Venta de',1,100.0000000,5.0000000,0.0000000,25.0000000,0),(85,'085','(PJND)-Pagos por Servicios de Publicidad y Propaganda y la Cesión de la Venta de',2,100.0000000,5.0000000,0.0000000,0.0100000,0),(86,'086','(PJD)-Pagos por Servicios de Publicidad y Propaganda y la Cesión de la Venta de',1,100.0000000,3.0000000,0.0000000,25.0000000,0),(87,'','RETENCION 100% DEL IVA A PROVEEDORES',1,100.0000000,100.0000000,0.0000000,0.0000000,1),(88,'','RETENCION 75% DEL IVA A PROVEEDORES',1,100.0000000,75.0000000,0.0000000,0.0000000,1),(89,'','PRESTACION DE SERVICIO ALCALDIA',1,100.0000000,1.0000000,0.0000000,0.0000000,0);
/*!40000 ALTER TABLE `retenc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retenciones`
--

DROP TABLE IF EXISTS `retenciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retenciones`
--

LOCK TABLES `retenciones` WRITE;
/*!40000 ALTER TABLE `retenciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `retenciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retencionventas`
--

DROP TABLE IF EXISTS `retencionventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retencionventas`
--

LOCK TABLES `retencionventas` WRITE;
/*!40000 ALTER TABLE `retencionventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `retencionventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,1),(2,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,1,1,0,0,1,0,0,1,1,1,1,1,1,0,1,1,0,1,1,1,0,0,1,1,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0),(3,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0),(4,4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seriales`
--

DROP TABLE IF EXISTS `seriales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seriales`
--

LOCK TABLES `seriales` WRITE;
/*!40000 ALTER TABLE `seriales` DISABLE KEYS */;
/*!40000 ALTER TABLE `seriales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sistema`
--

DROP TABLE IF EXISTS `sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sistema` (
  `idempresa` int(1) DEFAULT NULL,
  `fechainicio` date DEFAULT NULL,
  `fechavence` date DEFAULT NULL,
  `dato` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sistema`
--

LOCK TABLES `sistema` WRITE;
/*!40000 ALTER TABLE `sistema` DISABLE KEYS */;
INSERT INTO `sistema` VALUES (1,'2026-09-09','2027-09-09',365),(2,'2024-10-01','2024-11-01',31);
/*!40000 ALTER TABLE `sistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Nks','Nks@gmail.com',NULL,'$2y$10$mnhllx62RCScWrHnJSacbe8AVrRHlWbbyMXMI7CC2p8o2L6Uvt9aC',NULL,'2023-03-11 17:34:38','2023-03-11 17:34:38','A','puerta.jpg',1),(2,'admfresita','admfresita@nks.com',NULL,'$2y$10$dq7AAMCLjHNBYpr6WELg0eGBu8Ue3eFKxm5ZXGwLNhqDZixrQzLw6',NULL,'2024-10-05 22:54:06','2024-10-05 22:54:07','A','avatar5.png',2),(3,'gerenciafresita','gerenciafresita@nks.com',NULL,'$2y$10$nYfp7tkgzGrsJitaF/IkG.QH2DMORs7Dw3mQqze.ALTBAtZTaHTQq',NULL,'2024-10-05 22:54:07','2024-10-05 22:54:07','A','avatar5.png',2),(4,'userfresita','userfresita@nks.com',NULL,'$2y$10$f6i.KGyMM8q5Xbquw42Rr.Ra45CLULx0bfydnVZFdUdp9WXCewI02',NULL,'2024-10-05 22:54:08','2024-10-05 22:54:08','A','avatar5.png',2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,1,'Directo',NULL,'merdia',0,'v56465456','V'),(2,2,'DIRECTO','(654) 654-6541','santa cruz',0,'v5464','V');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES (1,1,1,1,1,'FAC','A',1,0,'00-',40.900,43.20,0.000,0.000,1766.880,0.000,0.000,'2024-10-05 23:13:17','2024-10-05',16,0.00,0.000,'Contado',0,0.000,0.000,0,'Nks'),(2,2,1,2,2,'FAC','A',1,0,'00-',39.660,3.75,0.000,0.000,148.720,0.000,0.000,'2024-10-05 23:16:43','2024-10-05',16,0.00,0.000,'Contado',0,0.000,0.000,0,'admfresita'),(2,3,2,3,2,'FAC','A',2,0,'00-',39.660,5.00,0.000,0.000,198.290,0.000,0.000,'2024-10-05 23:23:27','2024-10-05',16,2.48,0.000,'Credito',0,0.000,0.000,0,'admfresita'),(1,4,2,4,1,'FAC','A',2,0,'00-',40.900,18.00,0.000,0.000,736.190,0.000,0.000,'2024-10-05 23:25:11','2024-10-05',16,0.00,0.000,'Credito',0,0.000,0.000,0,'Nks'),(2,5,3,3,2,'FAC','A',3,0,'00-',39.660,3.75,0.000,0.000,148.720,0.000,0.000,'2024-10-05 23:39:45','2024-10-05',16,0.00,0.000,'Contado',0,0.000,0.000,0,'admfresita'),(1,6,3,5,1,'FAC','A',3,0,'00-',40.900,21.60,0.000,0.000,883.440,0.000,0.000,'2024-10-05 23:41:56','2024-10-05',16,0.00,0.000,'Contado',0,0.000,0.000,0,'Nks');
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-17 17:42:33
