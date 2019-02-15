<?php

class updateAppController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->session_start();
        $this->getHelper('form_helper');
        $this->getHelper('string_helper');
    }

    public function index() {
        $this->_view->titulo = 'Actualización del Sistema (En Línea)';

        $this->_view->setJs(array('updateApp'));
        $this->_view->renderizar('updateApp');
    }

    public function downApp(){

        if(!@copy('http://190.223.32.196/beca18/update/updateEDNOM.zip','update/update.zip'))
        {
            $errors= error_get_last();

            $msg = "COPY ERROR: ".$errors['type']."<br />\n".$errors['message'];

        } else {
            $errors= error_get_last();
            $msg = "Actualización descargada!";
        }

        $this->_view->json=array('mensaje'=>$msg);
        $this->_view->renderizarJson();

    }

    public function updApp(){
        $zip = new ZipArchive;
        $res = $zip->open(ROOT.'update/update.zip');
        if ($res === TRUE) {
            $zip->extractTo("../evaluacion/");
            $zip->close();
            $msg = "Actualización Satisfactoria!";            
        }else{
            switch($res){
            case ZipArchive::ER_NOENT:
                $msg = "No existe el fichero.";
                break;

            case ZipArchive::ER_NOZIP:
                $msg = "No es un archivo zip.";
                break;

            case ZipArchive::ER_OPEN:
                $msg = "No se puede abrir el archivo.";
                break;

            case ZipArchive::ER_READ:
                $msg = "Error de lectura.";
                break;

            default:
                $msg = "Error, code:" . $res;
                break;
            }
        }

        $this->_view->json=array('mensaje'=>$msg);
        $this->_view->renderizarJson();

    }
}

