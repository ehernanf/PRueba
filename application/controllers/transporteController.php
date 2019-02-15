<?php

class transporteController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->session_start();
        $this->getHelper('form_helper');
        $this->getHelper('string_helper');
        $this->getLibrary('Pagination');
    }
    
   
    public function index() {
        $this->_view->titulo = 'Home';
        $this->_view->setJs(array('lista'));
         if ($this->_request->session('sede') != '') {
           

            $this->_view->setJs(array('registro'));
            $this->_view->renderizar('registro');
        } else {
            $this->_view->renderizar('registro', 'registro');
        }
    }
           public function registro() {
  
            $this->_view->titulo = 'ECE - 2016';
            $this->_view->director = FALSE;
            $this->_view->estado = FALSE;
            $this->_view->ruta = FALSE;
            
            $model = $this->loadModel('director');
            $fdata = $this->_request->get('frmdirector');
           
             $mod = $this->loadModel('ruta');
             $this->_view->lista_rutas  = $mod->rutas();
             
             
             var_dump($this->_view->lista_rutas);exit();
            
            
            $director = FALSE;
            $this->_view->estado = '0';
        
            
    $this->_view->form = Model::createForm(array('model' => 'director'));

            $this->_view->setJs(array('registro'));
                       //var_dump(array('registro'));exit();
            $this->_view->renderizar('registro');
      
    }


}
