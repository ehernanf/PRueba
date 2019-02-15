<?php

class taskController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->session_start();
        $this->getHelper('form_helper');
        $this->getHelper('string_helper');
    }

    public function index() {
        $this->_view->titulo = 'Envio Masivo';
        $this->_view->setJs(array('index'));
        $this->_view->renderizar('index');
    }

    private function getRemoteHost() {
        $model = $this->loadModel('usuario');
        $config = $model->getConfigwifi();

        return ($config->valor === '1' ? TRANSFER_HOST_MASIVO_LOCAL : TRANSFER_HOST_MASIVO);
    }
      
    private function getRemoteHost2() {
        $model = $this->loadModel('usuario');
        $config = $model->getConfigwifi();

        return ($config->valor === '1' ? TRANSFER_HOST_MASIVO_LOCAL2 : TRANSFER_HOST_MASIVO2);
    }
    
//    public function transfer($event) {//1_01
//        $model = $this->loadModel('director');
//        $_data = array();
//        $mass = $this->_request->get('mass');
//        $_data['directores'] = $model->getDataEnvioMasivo($event, $mass);
//        $_data['event'] = $event;
//        
//        
//        var_dump($_data['directores']);
//        
//        $model->closeConnection();
//        
//        if (count($_data['directores']) > 0) {
//            //$model->_db->trans_begin();
//            //var_dump($_data);
//            $data = json_encode($_data);
//            //var_dump($_data);
//            //$ch = curl_init('http://190.223.32.196/beca18/WSEna/mssql.php');
//            $ch = curl_init($this->getRemoteHost());
//            //especificamos el POST (tambien podemos hacer peticiones enviando datos por GET
//            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
//            //le decimos que parametros enviamos (pares nombre/valor, tambien acepta un array)
//            curl_setopt($ch, CURLOPT_POSTFIELDS, "data=$data");
//            //timeout
//            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 2000);
//            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 20000); //timeout in seconds
//            //debug
//            curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
//            curl_setopt($ch, CURLOPT_STDERR, fopen(ROOT . 'curl.txt', 'w+'));
//            //le decimos que queremos recoger una respuesta (si no esperas respuesta, ponlo a false)
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            //recogemos la respuesta
//            $respuesta = curl_exec($ch);
//            //o el error, por si falla
//            $error = curl_error($ch);
//            //y finalmente cerramos curl
//            
//            var_dump($respuesta);
//            //curl_close($ch);
//            if (!$error) {
//                if ($respuesta) {
//                    //$model->_db->trans_commit();
//                    $eventsKCol = array('codigo', 'codigo', 'codFicha', 'codCartilla');
//                    $rData = json_decode($respuesta);
//                    //var_dump($respuesta);exit;
//                    $model->openConnection();
//                    $model->setEstadoEnvioMasivo($rData, $eventsKCol[0]); //, $this->_request->session('nro_local')
//                    $model->closeConnection();
//                    $json = array('success' => TRUE, 'count' => count($rData), 'total' => 1000, 'message' => 'Se proceso correctamente');
//                    $this->_view->json = $json;
//                    $this->_view->renderizarJson(FALSE);
//                }
//            }else {
//                //$model->_db->trans_rollback();
//            }
//        } else {
//            //$model->_db->trans_rollback();
//            $this->_view->json = array('sin_datos_actualizar');
//            $this->_view->renderizarJson(FALSE);
//        }
//        //$model->closeConnection();
//    }

    
    
public function transfer($event) {//1_01
        $model = $this->loadModel('paquete');
        $_data = array();
        $mass = $this->_request->get('mass');
        $_data['paquetes'] = $model->getDataEnvioMasivo($event, $mass);
        $_data['event'] = $event;
        
//         var_dump($_data);
        
        $model->closeConnection();
        
        if (count($_data['paquetes']) > 0) {
            //$model->_db->trans_begin();
            //var_dump($_data);
            $data = json_encode($_data);
            //var_dump($data);
//            var_dump(json_decode($data));
            //$ch = curl_init('http://190.223.32.196/beca18/WSEna/mssql.php');
//            echo $this->getRemoteHost() . '<br>';
            $ch = curl_init($this->getRemoteHost());
            //especificamos el POST (tambien podemos hacer peticiones enviando datos por GET
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            //le decimos que parametros enviamos (pares nombre/valor, tambien acepta un array)
            curl_setopt($ch, CURLOPT_POSTFIELDS, "data=$data");
            //timeout
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 2000);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 20000); //timeout in seconds
            //debug
            curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
            curl_setopt($ch, CURLOPT_STDERR, fopen(ROOT . 'curl.txt', 'w+'));
            //le decimos que queremos recoger una respuesta (si no esperas respuesta, ponlo a false)
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //recogemos la respuesta
            $respuesta = curl_exec($ch);
            //o el error, por si falla
            $error = curl_error($ch);
            //y finalmente cerramos curl
            
            //var_dump($respuesta);
            //var_dump($error);
            curl_close($ch);
            
            
            
         /*
            if (!$error) {
                if ($respuesta) {
                    $eventsKCol = array('codigo', 'codigo', 'codFicha', 'codCartilla');
                    $rData = json_decode($respuesta);
                    $model->setEstadoEnvioMasivo($rData, $eventsKCol[$event - 1]);
                    $json = array('success' => TRUE);
                    $this->_view->json = $json;
                    $this->_view->renderizarJson();
                }
            }
           */ 
            
            if (!$error) {
                if ($respuesta) {
                    //var_dump($respuesta);
                    //$model->_db->trans_commit();
                    $eventsKCol = array('cod_paquete', 'cod_paquete', 'codFicha', 'codCartilla');
                    //$respuesta = stripslashes($respuesta);
                    $rData = json_decode($respuesta);
                    
                   // var_dump($rData);
                    
                    /*

 object(stdClass)[59]
      public 'estado' => string '7' (length=1)
      public 'fecha' => string '2017-07-13 10:26:17' (length=19)
      public 'cod_paquete' => string '0802007' (length=7)
                                           */
                    
                     
                    $model->openConnection();
                    $model->setEstadoEnvioMasivo($rData, $eventsKCol[$event-1]); //, $this->_request->session('nro_local')
                    $model->closeConnection();
                    $json = array('success' => TRUE, 'count' => count($rData), 'total' => 1000, 'message' => 'Se proceso correctamente');
                    $this->_view->json = $json;
                    $this->_view->renderizarJson(FALSE);
                     
                     
                     
                }
            } else {
                //$model->_db->trans_rollback();
            }
        } else {
            //$model->_db->trans_rollback();
            $this->_view->json = array('sin_datos_actualizar' => TRUE);
            $this->_view->renderizarJson(FALSE);
        }
        //$model->closeConnection();
    }   

    

//     public function transfer($event) {
//        $model = $this->loadModel('director');
//        $_data = array();
//        $mass = $this->_request->get('mass');
//        $_data['directores'] = $model->getDataEnvioMasivo($event, $mass);
//        $_data['event'] = $event;
//        //var_dump($_data);
//        
//        $model->closeConnection();
//        
////        if (count($_data['directores']) > 0) {
//            //$model->_db->trans_begin();
//            //var_dump($_data);
//            $data = json_encode($_data);
//            //var_dump($_data);
//            //$ch = curl_init('http://190.223.32.196/beca18/WSEna/mssql.php');
////            $ch = curl_init($this->getRemoteHost());
//            $url = "http://edunegociosperu.com/reniec-ws/?dni=" + $dni;
//            $ch = curl_init($url);
//            
//            
//            //especificamos el POST (tambien podemos hacer peticiones enviando datos por GET
//            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
//            //le decimos que parametros enviamos (pares nombre/valor, tambien acepta un array)
////            curl_setopt($ch, CURLOPT_POSTFIELDS, "data=$data");
//            //timeout
//            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 2000);
//            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 20000); //timeout in seconds
//            //debug
//            curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
//            curl_setopt($ch, CURLOPT_STDERR, fopen(ROOT . 'curl.txt', 'w+'));
//            //le decimos que queremos recoger una respuesta (si no esperas respuesta, ponlo a false)
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            //recogemos la respuesta
//            $respuesta = curl_exec($ch);
//            //o el error, por si falla
//            $error = curl_error($ch);
//            //y finalmente cerramos curl
//            
//            //var_dump($respuesta);
//            //curl_close($ch);
//            if (!$error) {
//                if ($respuesta) {
//                    
//                    var_dump($respuesta);
//                    exit();
//                    //$model->_db->trans_commit();
//                    $eventsKCol = array('codigo', 'codigo', 'codFicha', 'codCartilla');
//                    $rData = json_decode($respuesta);
//                    //var_dump($respuesta);exit;
//                    $model->openConnection();
//                    $model->setEstadoEnvioMasivo($rData, $eventsKCol[0]); //, $this->_request->session('nro_local')
//                    $model->closeConnection();
//                    $json = array('success' => TRUE, 'count' => count($rData), 'total' => 1000, 'message' => 'Se proceso correctamente');
//                    $this->_view->json = $json;
//                    $this->_view->renderizarJson(FALSE);
//                }
//            } else {
//                //$model->_db->trans_rollback();
//            }
////        } else {
////            //$model->_db->trans_rollback();
////            $this->_view->json = array('sin_datos_actualizar');
////            $this->_view->renderizarJson(FALSE);
////        }
//        //$model->closeConnection();
//    }
    
    
    public function transfer_u() {
        $dat = $this->_request->get();
        $model = $this->loadModel('director');
        $trama = $model->getDataEnvio($dat['evento'], $dat['key']);

        if ($trama) {
            $event = $dat['evento'];

            $_data = array();
            $_data['directores'] = $trama;
            $_data['event'] = $event;
            $data = json_encode($_data);
            $ch = curl_init($this->getRemoteHost());
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            //le decimos qu� param�etros enviamos (pares nombre/valor, tambi�n acepta un array)
            curl_setopt($ch, CURLOPT_POSTFIELDS, "data=$data");
            // echo $data;
            //le decimos que queremos recoger una respuesta (si no esperas respuesta, ponlo a false)
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //recogemos la respuesta
            $respuesta = curl_exec($ch);
            //o el error, por si falla
            $error = curl_error($ch);
            //y finalmente cerramos curl
            curl_close($ch);
            if (!$error) {
                if ($respuesta) {
                    $eventsKCol = array('codigo', 'codigo', 'codFicha', 'codCartilla');
                    $rData = json_decode($respuesta);
                    $model->setEstadoEnvioMasivo($rData, $eventsKCol[$event - 1]);
                    $json = array('success' => TRUE);
                    $this->_view->json = $json;
                    $this->_view->renderizarJson();
                }
            }
        }
    }

    

    
      public function transfer_u2() {
        $dat = $this->_request->get();
        
        $model = $this->loadModel('transporte');
        $trama = $model->getDataEnvio($dat['cod_sede']);        
       
        if ($trama) {            

            $_data = array();
            $_data['transporteruta'] = $trama; 
//            var_dump($_data);
        $data = json_encode($_data);   

            $ch = curl_init($this->getRemoteHost2());
           
     
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, "data=$data");            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $respuesta = curl_exec($ch);
            $error = curl_error($ch);
            curl_close($ch);

            if (!$error) {
                if ($respuesta) {     
//                    var_dump($respuesta);
                    $rData = json_decode($respuesta);                    
//                    var_dump($rData);
                    $model->setEstadoEnvioMasivo($rData);
                    $json = array('success' => TRUE);
                    $this->_view->json = $json;
                    $this->_view->renderizarJson();
                }
            }
            
        }
    }

    
    public function wifi() {
        $model = $this->loadModel('usuario');
        $config = $model->getConfigwifi();
        $this->_view->config = $config;
        $this->_view->titulo = 'Configuración de WIFI';
        $this->_view->setJs(array('wifi'));
        $this->_view->renderizar('configWIFI');
    }

    public function configwifi($tipo) {
        $model = $this->loadModel('usuario');
        $rpta = $model->configwifi($tipo);
        $json = array('success' => $rpta > 0);
        $this->_view->json = $json;
        $this->_view->renderizarJson();
    }

}
