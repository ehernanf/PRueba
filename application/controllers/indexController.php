<?php

class indexController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->session_start();
        $this->getHelper('form_helper');
        $this->getHelper('string_helper');
    }

    public function index() {
        $this->_view->titulo = 'EVALUACION';
        $this->_view->usuario = FALSE;

        $this->_view->setJs(array('index'));
        $fecha_sistema = date('d/m/Y');
        $fecha_comparativa = $fecha_sistema;
        $filename = ROOT . 'ednom.version';
        $version = '1.0.0';
        if (file_exists($filename)) {
            $version = file_get_contents($filename);
        }
        
        $mensaje = "<div style='background: #E26356;border: 1px solid #c0392b;color:#ffffff;text-align:center;'><h2>No puede Ingresar al Sistema de Evaluación, estamos en una fecha fuera de rango. </h2></div><br>" . $fecha_sistema . " -- " . $fecha_comparativa;
        if ($fecha_sistema != $fecha_comparativa) {
            echo $mensaje;
        } elseif ($fecha_sistema > $fecha_comparativa) {
            echo $mensaje;
        } elseif ($fecha_sistema == $fecha_comparativa) {
            //var_dump("entra");
            $this->_view->evento = 'INVENTARIO DE CAJAS E INSTRUMENTOS - NIVEL III';
            $this->_view->version = $version;
            $this->_view->renderizar('index','index');
        }
    }

    public function local_p() {       
            $this->_view->renderizar('index_1');       
    }
    
    
    
    
    public function local___() {
        if ($this->_request->session('sede') != '') {
            $this->_view->titulo = 'SCAI::ING. LOCAL';
            $this->_view->director = FALSE;
            $this->_view->estado = FALSE;
            $model = $this->loadModel('director');
            $fdata = $this->_request->get('frmdirector');
            
            $director = FALSE;
            $this->_view->estado = '0';
            if ($fdata) {
                $director = $model->get($fdata);  // select * from postulantes2014 where ins_numdoc = '00000252'
               
                if ($director) {
                    if ($director->estatus >= 0 && $director->estatus <= 1) {
                        if ($director->tipo !== '2') {
                            //normal
//                            if (( $this->_request->session('nro_local') === $director->nro_local)) {
                                $this->_view->director = $director;
                                $model->actualizafecha($director->codigo, $this->_request->session('nro_local'));
                                // actualiza campo 'status'
                                
                                $status = (int)$director->estatus + 1;
                                
                                $model->exito($director->codigo, $this->_request->session('nro_local'), $status);
                                
                                $this->_view->estado = '1';
//                            } else {
//                                // Otro Local
//                                $this->_view->director = $director;
//                                $this->_view->estado = '3';
//                            }
                        } else {
                            //doble
//                            if (($director->nro_local === 18 || $director->nro_local === 12) && ($this->_request->session('nro_local') === 18 || $this->_request->session('nro_local') === 12)) {
//
////                                $director1 = $model->director_local($director->ins_numdoc, $this->_request->session('nro_local'));
//                                $this->_view->director = $director;
//                                $model->fecha($director->codigo);
//                                $model->exito($director->codigo, $this->_request->session('nro_local'));
//                                $this->_view->estado = '1';
//                            } else {
                                // Otro Local
                                $this->_view->director = $director;

                                $this->_view->estado = '3';
//                            }
                        }
                    } else {
                        // Ya tiene Asistencia

                        if ($director->tipo !== '2') {
                            $this->_view->director = $director;
                            $this->_view->estado = '4';
                        } else {
//                            $director1 = $model->director_local($director->ins_numdoc, $this->_request->session('nro_local'));
                            $this->_view->director = $director;
                            $this->_view->estado = '4';
                        }
                    }
                } else {
                    // No se encuentra en el padron
                    $this->_view->estado = '2';
                }
            }

            $this->_view->form = Model::createForm(array('model' => 'director'));

            $this->_view->setJs(array('lista'));
            $this->_view->renderizar('local');
        } else {

            $this->_view->renderizar('index', 'index');
        }
    }
    
    public function local_01() {
        if ($this->_request->session('sede') != '') {
            $this->_view->titulo = 'SCAI::ING. LOCAL';
            $this->_view->director = FALSE;
            $this->_view->estado = FALSE;
            $model = $this->loadModel('director');
            $fdata = $this->_request->get('frmdirector');
            
            $director = FALSE;
            $this->_view->estado = '0';
            if ($fdata) {
                $director = $model->get($fdata);  // select * from postulantes2014 where ins_numdoc = '00000252'
                //var_dump($director);exit;
                if ($director) {
                    if ($director->estatus >= 0 && $director->estatus <= 1) {
                        if ($director->tipo !== '2') {
                            //normal
//                            if (( $this->_request->session('nro_local') === $director->nro_local)) {
                                $this->_view->director = $director;
                                $model->actualizafecha($director->codigo, $this->_request->session('nro_local'));
                                // actualiza campo 'status'
                                
                                $status = (int)$director->estatus + 1;
                                
                                $model->exito($director->codigo, $this->_request->session('nro_local'), $status);
                                
                                $this->_view->estado = '1';
//                         
                        } else {
                                                     
                            // Otro Local
                            $this->_view->director = $director;

                            $this->_view->estado = '3';

                        }
                    } else {
                        // Ya tiene Asistencia

                        if ($director->tipo !== '2') {
                            $this->_view->director = $director;
                            $this->_view->estado = '4';
                        } else {
//                            $director1 = $model->director_local($director->ins_numdoc, $this->_request->session('nro_local'));
                            $this->_view->director = $director;
                            $this->_view->estado = '4';
                        }
                    }
                } else {
                    // No se encuentra en el padron
                    $this->_view->estado = '2';
                }
            }

            $this->_view->form = Model::createForm(array('model' => 'director'));

            $this->_view->setJs(array('lista'));
            $this->_view->renderizar('local_01');
        } else {

            $this->_view->renderizar('index', 'index');
        }
    }

    public function descargaractualizacion() {

        $this->_view->titulo = 'SCAI:.Descarga de Actualizacion';
        $this->_view->renderizar("actualizar");
    }

    public function resetBD() {

        $model = $this->loadModel('tcobarra');
        $model->limpiar();
 
        $model2 = $this->loadModel('transporte');
        $model2->limpiar();
        $json = array('success' => TRUE);
        $this->_view->json = $json;
        $this->_view->renderizarJson();
    }

    
      public function  sedes(){
        $this->_view->titulo = 'SELECCION SEDE';
        $this->_view->usuario = FALSE;
        $this->_view->setJs(array('index'));
        
        
        $model = $this->loadModel('sede'); 
        $sedes = $model->get_sedes();
        
        
        $this->_view->setJs(array('index'));
        $this->_view->sedes = $sedes;        
        $this->_view->renderizar('sedes');
        
        
    }

}
