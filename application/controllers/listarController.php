<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of listarController
 *
 * @author cdelgadoc
 */
class listarController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->session_start();
        $this->getHelper('form_helper');
        $this->getHelper('string_helper');
        $this->getLibrary('Pagination');
    }

    public function index() {
        
    }

//    public function listar_01() {
//        $count = 5;
//        $model = $this->loadModel('tcobarra');
//        $pageGet = $this->_request->get('per_page');
//        $query_string_segment = 'per_page';
//        $page = is_numeric($pageGet) ? $pageGet : 0;
//        $this->pagination = new Pagination();
//        $num_rows = count($model->count_RegistrosLeidos());
//        $numnoenv_rows = count($model->count_CajasInventariadasCompletas());
//        $this->_view->titulo = 'LISTA DE CAJAS CONSULTADAS CON C&Oacute;DIGO DE BARRA <br>Total de [' . $numnoenv_rows . '] cajas completas inventariadas';
//
//        $query_string = $this->_request->server('QUERY_STRING');
//        $query_string = preg_replace("/&$query_string_segment=(\d+){0,6}/i", '', $query_string);
//        $config = array();
//        $config["base_url"] = BASE_URL . 'index.php/listar/listar_01?' . $query_string;
//        $config["total_rows"] = $num_rows;
//        $config["per_page"] = $count;
//        $config["page_query_string"] = TRUE;
//        $config["cur_page"] = $page;
//        $config["query_string_segment"] = $query_string_segment;
//        $this->pagination->initialize($config);
//        $this->_view->paginator = $this->pagination->create_links();
//        $this->_view->directores = $model->filtro_input($count, $page);
//        $this->_view->setJs(array('task'));
//        $this->_view->renderizar('lista_01');
//    }
    
    
    public function listar_01() {
        $count = 10;
        $model = $this->loadModel('paquete');
        $pageGet = $this->_request->get('per_page');
        $query_string_segment = 'per_page';
        $page = is_numeric($pageGet) ? $pageGet : 0;
        $this->pagination = new Pagination();
        $num_rows = count($model->count_RegistrosLeidos());
        $numnoenv_rows = count($model->count_CajasInventariadasCompletas());
        $this->_view->titulo = 'LISTA DE PAQUETES INVENTARIADOS CON C&Oacute;DIGO DE BARRA <br>Total de [' . $numnoenv_rows . '] PAQUETES';

        $query_string = $this->_request->server('QUERY_STRING');
        $query_string = preg_replace("/&$query_string_segment=(\d+){0,6}/i", '', $query_string);
        $config = array();
        $config["base_url"] = BASE_URL . 'index.php/listar/listar_01?' . $query_string;
        $config["total_rows"] = $num_rows;
        $config["per_page"] = $count;
        $config["page_query_string"] = TRUE;
        $config["cur_page"] = $page;
        $config["query_string_segment"] = $query_string_segment;
        $this->pagination->initialize($config);
        $this->_view->paginator = $this->pagination->create_links();
        $this->_view->directores = $model->filtro_input($count, $page);
        $this->_view->setJs(array('task'));
        $this->_view->renderizar('lista_01');
    }

    public function listar_02() {
        $count = 5;

        $model = $this->loadModel('director');

        $page = $this->_request->get('per_page');
        $query_string_segment = 'per_page';
        $page = is_numeric($page) ? $page : 0;
        $this->pagination = new Pagination();
        $num_rows = $model->count_input2();
        $numnoenv_rows = $model->count_noenv_input2();
        $this->_view->titulo = 'LISTA DE CAJAS CONSULTADAS CON C&Oacute;DIGO DE BARRA <br>Total de [' . $num_rows . '] cajas ingresadas - Total de [' . $numnoenv_rows . '] cajas registradas no enviados ';

        $query_string = $this->_request->server('QUERY_STRING');
        $query_string = preg_replace("/&$query_string_segment=(\d+){0,6}/i", '', $query_string);
        $config = array();
        $config["base_url"] = BASE_URL . 'index.php/listar/listar_02?' . $query_string;
        $config["total_rows"] = $num_rows;
        $config["per_page"] = $count;
        $config["page_query_string"] = TRUE;
        $config["cur_page"] = $page;
        $config["query_string_segment"] = $query_string_segment;
        $this->pagination->initialize($config);
        $this->_view->paginator = $this->pagination->create_links();
        $this->_view->directores = $model->filtro_input2($count, $page);
        $this->_view->setJs(array('task'));
        $this->_view->renderizar('lista_02');
    }

    public function listar_03() {
        $count = 5;

        $model = $this->loadModel('director');

        $page = $this->_request->get('per_page');
        $query_string_segment = 'per_page';
        $page = is_numeric($page) ? $page : 0;
        $this->pagination = new Pagination();
        $num_rows = $model->count_input3();
        $numnoenv_rows = $model->count_noenv_input3();
        $this->_view->titulo = 'LISTA DE CAJAS CONSULTADAS CON C&Oacute;DIGO DE BARRA <br>Total de [' . $num_rows . '] cajas ingresadas - Total de [' . $numnoenv_rows . '] cajas registradas no enviados ';

        $query_string = $this->_request->server('QUERY_STRING');
        $query_string = preg_replace("/&$query_string_segment=(\d+){0,6}/i", '', $query_string);
        $config = array();
        $config["base_url"] = BASE_URL . 'index.php/listar/listar_03?' . $query_string;
        $config["total_rows"] = $num_rows;
        $config["per_page"] = $count;
        $config["page_query_string"] = TRUE;
        $config["cur_page"] = $page;
        $config["query_string_segment"] = $query_string_segment;
        $this->pagination->initialize($config);
        $this->_view->paginator = $this->pagination->create_links();
        $this->_view->directores = $model->filtro_input3($count, $page);
        $this->_view->setJs(array('task'));
        $this->_view->renderizar('lista_03');
    }

    public function listar_04() {
        $count = 5;

        $model = $this->loadModel('director');

        $page = $this->_request->get('per_page');
        $query_string_segment = 'per_page';
        $page = is_numeric($page) ? $page : 0;
        $this->pagination = new Pagination();
        $num_rows = $model->count_input4();
        $numnoenv_rows = $model->count_noenv_input4();
        $this->_view->titulo = 'LISTA DE CAJAS CONSULTADAS CON C&Oacute;DIGO DE BARRA <br>Total de [' . $num_rows . '] cajas ingresadas - Total de [' . $numnoenv_rows . '] cajas registradas no enviados ';

        $query_string = $this->_request->server('QUERY_STRING');
        $query_string = preg_replace("/&$query_string_segment=(\d+){0,6}/i", '', $query_string);
        $config = array();
        $config["base_url"] = BASE_URL . 'index.php/listar/listar_04?' . $query_string;
        $config["total_rows"] = $num_rows;
        $config["per_page"] = $count;
        $config["page_query_string"] = TRUE;
        $config["cur_page"] = $page;
        $config["query_string_segment"] = $query_string_segment;
        $this->pagination->initialize($config);
        $this->_view->paginator = $this->pagination->create_links();
        $this->_view->directores = $model->filtro_input4($count, $page);
        $this->_view->setJs(array('task'));
        $this->_view->renderizar('lista_04');
    }

    public function ficha() {
        $model = $this->loadModel('director');
        $this->_view->directores = FALSE;
        $local = $this->_request->session('nro_local');
        $modelA = $this->loadModel('aula');
        $this->_view->aulas = $modelA->get_aula($local);
        $form = $this->_request->get();
        if ($form['paulas'] === NULL) {
            $num_rows = $model->count_input_ficha('');
            $numnoenv_rows = $model->count_noenv_ficha('');
        } else {
            $num_rows = $model->count_input_ficha($form['paulas']);
            $numnoenv_rows = $model->count_noenv_ficha($form['paulas']);
            $this->_view->directores = $model->filtro_input_ficha($form['paulas']);
        }
        $this->_view->titulo = 'LISTADO DE REGISTRO DE FICHA <br>Total de [' . $num_rows . '] fichas registradas  - Total de [' . $numnoenv_rows . '] fichas registradas no enviadas ';

        $this->_view->setJs(array('ficha'));
        $this->_view->setJs(array('task'));
        $this->_view->renderizar('listaficha');
    }

    public function cartilla() {
        $model = $this->loadModel('director');
        $this->_view->directores = FALSE;
        $local = $this->_request->session('nro_local');
        $modelA = $this->loadModel('aula');
        $this->_view->aulas = $modelA->get_aula($local);
        $form = $this->_request->get();
        if ($form['paulas'] === NULL) {
            $num_rows = $model->count_input_cartilla('');
            $numnoenv_rows = $model->count_noenv_cartilla('');
        } else {
            $num_rows = $model->count_input_cartilla($form['paulas']);
            $numnoenv_rows = $model->count_noenv_cartilla($form['paulas']);
            $this->_view->directores = $model->filtro_input_cartilla($form['paulas']);
        }
        $this->_view->titulo = 'LISTADO DE REGISTRO DE CUADERNILLOS <br>Total de [' . $num_rows . '] cuadernillos registrados  - Total de [' . $numnoenv_rows . '] cuadernillos registrados no enviados ';
       // $this->_view->setJs(array('cartilla'));
        $this->_view->setJs(array('task'));
        $this->_view->renderizar('listacartilla');
    }

    public function aula() {
        $model = $this->loadModel('director');
        $this->_view->directores = FALSE;
        $local = $this->_request->session('nro_local');
        $modelA = $this->loadModel('aula');
        $this->_view->aulas = $modelA->get_aula($local);
        $form = $this->_request->get();

        if ($form['paulas'] === NULL) {

            $num_rows = $model->count_input_aula('');
            $numnoenv_rows = $model->count_noenv_aula('');
        } else {

            $num_rows = $model->count_input_aula($form['paulas']);
            $numnoenv_rows = $model->count_noenv_aula($form['paulas']);
            $this->_view->directores = $model->filtro_input_aula($form['paulas']);
        }
        $this->_view->titulo = 'LISTADO DE REGISTRO DE ASISTENCIA POR AULA <br>Total de [' . $num_rows . '] postulantes registrados  - Total de [' . $numnoenv_rows . '] postulantes registrados no enviados ';


        $this->_view->setJs(array('aula'));
        $this->_view->setJs(array('task'));
        $this->_view->renderizar('listaaula');
    }

    public function reporte() {
//        $model = $this->loadModel('director');
//        $this->_view->reporte = FALSE;
//        $local = $this->_request->session('nro_local');
//        $this->_view->titulo = 'RESUMEN DE CONTROL DE INVENTARIO DE CAJAS E INSTRUMENTOS';
//        $this->_view->reporte = $model->getResumenTotal($local);
//        $this->_view->renderizar('listareporte');
    }

    public function reporte_01() {
        $model = $this->loadModel('tcobarra');
        $this->_view->reporte = FALSE;
        //$local = $this->_request->session('nro_local');
        $this->_view->titulo = 'RESUMEN DE CONTROL DE INVENTARIO DE CAJAS E INSTRUMENTOS';
        $this->_view->reporte = $model->getResumenTotal_01();
        $this->_view->setJs(array('listarcajasfaltantes'));
        $this->_view->renderizar('listareporte_01');
    }

    public function reporte_02() {
        $model = $this->loadModel('paquete');
        
        if(isset($_GET['psede'])){                
                $cod_sede = $_GET['psede'];     
                
                $this->_view->reporte = $model->getPorCodigo($cod_sede);
                
                //$this->_view->reporte = $model->getResumenTotal_02($cod_sede);
        }
        
        $model2 = $this->loadModel('sede');           
        $this->_view->sedes = $model2->get_sedes();
            
        $this->_view->titulo = 'RESUMEN DE CONTROL DE INVENTARIO DE CAJAS E INSTRUMENTOS';        
        $this->_view->setJs(array('reporte_02','listarcajasfaltantes'));
        $this->_view->renderizar('listareporte_02');
    }
    


    public function reporte_03() {
        $model = $this->loadModel('director');
        $this->_view->reporte = FALSE;
        $local = $this->_request->session('nro_local');
        $this->_view->titulo = 'RESUMEN DE CONTROL DE INVENTARIO DE CAJAS E INSTRUMENTOS';
        $this->_view->reporte = $model->getResumenTotal_03($local);
        $this->_view->renderizar('listareporte_03');
    }

    public function reporte_04() {
        $model = $this->loadModel('director');
        $this->_view->reporte = FALSE;
        $local = $this->_request->session('nro_local');
        $this->_view->titulo = 'RESUMEN DE CONTROL DE INVENTARIO DE CAJAS E INSTRUMENTOS';
        $this->_view->reporte = $model->getResumenTotal_04($local);
        $this->_view->renderizar('listareporte_04');
    }

    public function reporteinventario() {
        $model = $this->loadModel('director');
        $this->_view->reporte = FALSE;
        $local = $this->_request->session('nro_local');
        $this->_view->titulo = 'RESUMEN DE CONTROL DE INVENTARIO';
        $this->_view->reporte = $model->getResumenInventario($local);
        $this->_view->renderizar('listareporteInv');
    }    
    
    public function reporte_cajas_faltantes($tipo) {        
        $model = $this->loadModel('tcobarra');
        $this->_view->reporte = FALSE;
        //$local = $this->_request->session('nro_local');
        $valores = $model->getCajasFaltantes($tipo);
        
        $rData = json_encode($valores);  
        
        echo $rData;        
    }
    public function reporte_cajas_faltantes_local($cod_local) {        
        $model = $this->loadModel('tcobarra');
        $this->_view->reporte = FALSE;
        //$local = $this->_request->session('nro_local');
        $valores = $model->getCajasLocal($cod_local);
        
        $rData = json_encode($valores);  
        
        echo $rData;        
    }

}
