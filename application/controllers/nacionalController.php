<?php

class nacionalController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->session_start();
        $this->getHelper('form_helper');
        $this->getHelper('string_helper');
        $this->getLibrary('Pagination');
    }

    public function index() {

        if ($this->_request->session('sede') != '') {
            $this->_view->titulo = 'CONSULTA A NIVEL NACIONAL';
            $this->_view->director = FALSE;
            $this->_view->estado = FALSE;
            $local = $this->_request->session('nro_local');
            $fdata = $this->_request->get();
            $postulante = array('ins_numdoc' => $fdata['frmnacional']['ins_numdoc']);
            $model = $this->loadModel('nacional');

            $this->_view->estado = '0';
            if ($fdata) {
                $director = $model->get($postulante);

                if ($director) {
                    if (( $this->_request->session('nro_local') === $director->nro_local)) {

                        $this->_view->director = $director;
                        $this->_view->estado = '1';
                    } else {
                        // Otro Local
                        $this->_view->director = $director;
                        $this->_view->estado = '2';
                    }
                } else {

                    $this->_view->director = $director;
                    $this->_view->estado = '4';
                }
            }
            $this->_view->form = Model::createForm(array('model' => 'nacional'));
            $this->_view->setJs(array('nacional'));
            $this->_view->renderizar('nacional');
        } else {

            $this->_view->renderizar('index', 'index');
        }
    }

}
