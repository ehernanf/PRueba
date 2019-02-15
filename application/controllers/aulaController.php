<?php

class aulaController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->session_start();
        $this->getHelper('form_helper');
        $this->getHelper('string_helper');
        $this->getLibrary('Pagination');
    }

    function get_aulas_contingencia($result) {
        $_result = array();
        foreach ($result as $value) {
            if ($value->tipo === '0') {
                $_result[] = "" . $value->naula;
            }
        }
        return $_result;
    }

    public function index() {
        if ($this->_request->session('sede') != '') {

            $this->_view->titulo = 'ASISTENCIA AL AULA';
            $this->_view->director = FALSE;
            $this->_view->estado = FALSE;
            $local = $this->_request->session('nro_local');
            $model = $this->loadModel('aula');
            $this->_view->aulas = $model->get_aula($local);

            $fdata = $this->_request->get();
            //$model = $this->loadModel('director');
            $this->_view->estado = '0';

            if ($fdata) {

                $director = $model->get_postulante_aula($fdata['ins_numdoc']);
                $aulas_contigencia = $this->get_aulas_contingencia($this->_view->aulas);
                ////$model->get_contingencia_aulas($this->_request->session('nro_local'));
//                var_dump($aulas_contigencia);exit;
                //$_aula = $modelA->get_selaula($fdata['paulas'], $local);
                //$aula = $_aula[0];
                if ($director) {
                    if ($director->ptipo !== '2') {
                        if ($director->nro_local == $this->_request->session('nro_local')) {

//                            if(in_array($fdata['paulas'], $aulas_contigencia)) {
//                                
//                            }

                            if ($director->s_aula == 0) {
                                if ($director->atipo == 0 && in_array($fdata['paulas'], $aulas_contigencia)) {
                                    $this->_view->director = $director;
                                    $model->aula($director->codigo, $local, $fdata['paulas']);
                                    $this->_view->estado = '1';
                                } else {
                                    if ($fdata['paulas'] == $director->aula || in_array($fdata['paulas'], $aulas_contigencia)) {
                                        $this->_view->director = $director;
                                        $model->aula($director->codigo, $local, $fdata['paulas']);
                                        $this->_view->estado = '1';
                                    } else {
                                        $this->_view->director = $director;
                                        $this->_view->estado = '2';
                                    }
                                }
                            } else {
                                $this->_view->director = $director;
                                $this->_view->estado = '3';
                            }
                        } else {

                            $this->_view->director = $director;
                            $this->_view->estado = '6';
                        }
                    } else {
                        ///*****//////


                        if ($director->s_aula == 0) {
                            if (($director->nro_local === 18 || $director->nro_local === 12) && ($this->_request->session('nro_local') === 18 || $this->_request->session('nro_local') === 12)) {
                                $director1 = $model->director_local($director->ins_numdoc, $this->_request->session('nro_local'));
                                if ($fdata['paulas'] == $director->aula) {
                                    $this->_view->director = $director;
                                    $model->aula($director1->codigo, $local, $fdata['paulas']);
                                    $this->_view->estado = '1';
                                } else {
                                    $this->_view->director = $director;
                                    $this->_view->estado = '2';
                                }
                            } else {
                                $this->_view->director = $director;
                                $this->_view->estado = '6';
                            }
                        } else {
                            $this->_view->director = $director;
                            $this->_view->estado = '3';
                        }
                        /////
                    }
                } else {

                    //  $this->_view->director = $director;  
                    $this->_view->estado = '4';
                }
            }
            $this->_view->setJs(array('aula'));
            $this->_view->renderizar('asistencia');
        } else {

            $this->_view->renderizar('index', 'index');
        }
    }

}
