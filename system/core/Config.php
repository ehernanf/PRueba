<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Microinei
 *
 * Mini framework para encuestas
 *
 * @package		Microinei
 * @author		holivares
 * @copyright	Copyright (c) 2008 - 2011, inei.
 * @license		http://example.com/license.html
 * @since		Version 0.1
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * View Class
 * Representa una vista dentro del patron mvc. establece los recursos estaticos
 * a utlizarse al renderizar la vista para ser mostrada en el browser.
 *
 * @package		Microinei
 * @subpackage	core
 * @category	Core
 * @author		farellan
 */

define('BASE_URL', 'http://localhost/inventario/');
//define('BASE_URL', 'http://localhost:8080/evaluacion_inv_paquetes_nivel_iii/');
//define('BASE_URL', 'http://localhost:8084/evaluacion_inv_paquetes_nivel_iii/');
//define('BASE_URL', 'http://localhost:8081/inventario2016/');
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_LAYOUT', 'default');

define('DB_HOST', '172.18.1.102');
define('DB_USER', 'us_pronabec18_des');
define('DB_PASS', '6H4@da^QXZrW');
//define('DB_NAME', BASEPATH . 'db'. DIRECTORY_SEPARATOR . 'mydatabase.sqlite');
define('DB_NAME', 'PRONABEC2018_MONITOREO');
define('DB_ENGINE','sqlsrv');
define('DB_CHAR', 'utf8');
define('APP_NAME', 'Inventario v 1.0');
//define('APP_TITULO', 'APLICACI&Oacute;N Y CAPTURA DE DATOS DE LOS INSTRUMENTOS DE EVALUACI&Oacute;N PARA LOS CONCURSOS P&Uacute;BLICOS DE ACCESO A CARGOS DE DIRECTOR Y SUBDIRECTOR DE INSTITUCIONES EDUCATIVAS P&Uacute;BLICAS Y DE ESPECIALISTA EN EDUCACION DE UNIDADES DE GESTI&Oacute;N EDUCATIVA LOCAL Y DIRECCIONES REGIONALES DE EDUCACI&Oacute;N, DE EDUCACION B&Aacute;SICA REGULAR 2016');
//define('APP_TITULO', 'APLICACI&Oacute;N Y CAPTURA DE DATOS DE LOS INSTRUMENTOS DE EVALUACI&Oacute;N PARA LOS CONCURSOS P&Uacute;BLICOS DE INGRESO A LA CARRERA P&Uacute;BLICA MAGISTERIAL Y DE CONTRATACI&Oacute;N DOCENTE EN INSTITUCIONES EDUCATIVAS P&Uacute;BLICAS DE EDUCACI&Oacute;N B&Aacute;SICA - 2017');
define('APP_TITULO', '  APLICACIÓN Y CAPTURA DE DATOS DE LOS INSTRUMENTOS DE EVALUACIÓN DEL CONCURSO PÚBLICO PARA EL ASCENSO DE ESCALA DE LOS PROFESORES DE EDUCACIÓN BÁSICA EN LA CARRERA PÚBLICA MAGISTERIAL 2018 Y DEL CONCURSO PÚBLICO DE ACCESO A CARGOS DIRECTIVOS DE INSTITUCIÓN EDUCATIVA Y A CARGOS DE ESPECIALISTA EN EDUCACIÓN DE UGEL Y DRE, DE EDUCACIÓN BÁSICA 2018');
define('APP_TITULO_CORTO', 'Inventario v 1.0');

// CONEXION PRODUCCION
define('TRANSFER_HOST', 'http://191.98.163.157/WSDirectores/USP_EDA2018_PAQUETES_NIVEL3-ANEXO.PHP');
define('TRANSFER_HOST_MASIVO', 'http://191.98.163.157/WSDirectores/USP_EDA2018_PAQUETES_NIVEL3-ANEXO.PHP');
// NUEVA IP PUBLICA

define('TRANSFER_HOST_LOCAL', 'http://172.15.10.16:8082/WSDirectores/USP_EDA2018_PAQUETES_N3.PHP');
define('TRANSFER_HOST_MASIVO_LOCAL', 'http://172.15.10.16:8082/WSDirectores/USP_EDA2018_PAQUETES_N3.PHP');


/*
define('TRANSFER_HOST2', 'http://190.116.43.230/WSDirectores/USP_EDNOM2017_CAJAS_POLISISTEMAS_CHOFER.php');
define('TRANSFER_HOST_MASIVO2', 'http://190.116.43.230/WSDirectores/USP_EDNOM2017_CAJAS_POLISISTEMAS_CHOFER.php');

define('TRANSFER_HOST_LOCAL2', 'http://172.16.100.252/WSDirectores/USP_EDNOM2017_CAJAS_POLISISTEMAS_CHOFER.php');
define('TRANSFER_HOST_MASIVO_LOCAL2', 'http://172.16.100.252/WSDirectores/USP_EDNOM2017_CAJAS_POLISISTEMAS_CHOFER.php');

 */

// CONEXION DESARROLLO
// NUEVA IP PUBLICA
//define('TRANSFER_HOST', 'http://190.116.43.230/WSDirectores/WSEdnom2016_II_Inv_mo1_masivo_des.php');
//define('TRANSFER_HOST_MASIVO', 'http://190.116.43.230/WSDirectores/WSEdnom2016_II_Inv_mo1_masivo_des.php');
//// NUEVA IP PRIVADA
//define('TRANSFER_HOST_LOCAL', 'http://192.168.221.5/WSDirectores/WSEdnom2016_II_Inv_mo1_masivo_des.php');
//define('TRANSFER_HOST_MASIVO_LOCAL',    'http://192.168.221.5/WSDirectores/WSEdnom2016_II_Inv_mo1_masivo_des.php');


////WSDirectoresMasivo_2
//WSDirectoresMasivo_2_recep.php
//WSDirectoresMasivo_2_retorno.php
//WSDirectoresMasivo_2_procesa.php
?>

