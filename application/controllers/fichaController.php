<?php

class fichaController extends Controller {

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
        $this->_view->titulo = 'SCAI::UDRA - FICHA';
        $this->_view->director = FALSE;
        $this->_view->estado = FALSE;
        $local = $this->_request->session('nro_local');
        $model = $this->loadModel('aula');
        $this->_view->aulas = $model->get_aula($local);
        $fdata = $this->_request->get();
//        $model = $this->loadModel('director');        
        $this->_view->estado = '0';
        if ($fdata) {
//            $director = $model->verificar_aula_ficha($fdata['ins_numdoc']);
            $director = $model->get_ficha_aula($fdata['ins_numdoc']);
            $aulas_contigencia = $this->get_aulas_contingencia($this->_view->aulas);
            if ($director) {
                if ($director->cant_ficha < 1) {

                    if ($director->ins_numdoc !== NULL) {
                        if ($director->ptipo !== '2') {
                            if ($director->nro_local == $local) {
                                if (!$director->aula) {
                                    $this->_view->director = $director;
                                    $model->ficha($fdata['ins_numdoc'], $director->cant_ficha, $fdata['paulas']);
                                    $this->_view->estado = '1';
                                } else {
                                    if ($director->aula === $fdata['paulas']) {

                                        $this->_view->director = $director;
                                        $model->ficha($fdata['ins_numdoc'], $director->cant_ficha, $fdata['paulas']);
                                        $this->_view->estado = '1';
                                    } else {

                                        if ($director->aula === '0') {

                                            $this->_view->director = $director;
                                            $this->_view->estado = '5';
                                        } else {
                                            $detaula = $model->get_selaula($fdata['paulas'], $local);
                                            //echo $model->_db->last_query();
                                            //var_dump($detaula);
                                            if ($detaula[0]->tipo === '0' && (
                                                    ($detaula[0]->naula === 999 & in_array($director->aula, $aulas_contigencia)) ||
                                                    ($detaula[0]->naula !== 999)
                                                    )) {
                                                //($detaula[0]->naula === 999 & in_array($director->aula, $aulas_contigencia))
                                                //exit;
                                                $this->_view->director = $director;
                                                $model->ficha($fdata['ins_numdoc'], $director->cant_ficha, $fdata['paulas']);
                                                $this->_view->estado = '1';
                                            } else {
                                                $this->_view->director = $director;
                                                $this->_view->estado = '2';
                                            }
                                        }
                                    }
                                }
                            } else {



                                $this->_view->director = $director;
                                $this->_view->estado = '6';
                            }
                        } else {

                            $director2 = $model->director_local($director->ins_numdoc, $this->_request->session('nro_local'));


                            if ($director->nro_local === 18 || $director->nro_local === 12) {
                                if ($director2->aula === $fdata['paulas']) {
                                    $this->_view->director = $director2;
                                    $model->ficha($fdata['ins_numdoc'], $director->cant_ficha, $fdata['paulas']);
                                    $this->_view->estado = '1';
                                } else {
                                    
                                }
                            } else {

                                $this->_view->director = $director;
                                $this->_view->estado = '5';
                            }
                        }
                    } else {

                        $this->_view->director = $director;
                        $model->ficha_aula($fdata['ins_numdoc'], $fdata['paulas'], $local, $director->cant_ficha);
                        $this->_view->estado = '7';
                    }
                } else {
                    $this->_view->director = $director;
                    $this->_view->estado = '3';
                }
            } else {
                $this->_view->estado = '4';
            }
        }
        $this->_view->setJs(array('ficha'));
        $this->_view->renderizar('uficha');
    }

}
