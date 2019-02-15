<?php

class localController extends Controller {

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
            $this->_view->setJs(array('local_01'));
            $this->_view->renderizar('local_01');
        } else {
            $this->_view->renderizar('index', 'index');
        }
    }
    
    
     public function registro() {
             
            $model = $this->loadModel('transporte');            
//            $director = FALSE;
            $this->_view->estado = '0';
        
            
//            $cod_sede = isset($_GET['psede']) ? $_GET['psede']: '' ;
            
//            var_dump($_GET);
//            echo "========";
//            var_dump($_POST);
            
            
            
            $cod_sede = "";
            
            //$fdata = $this->_request->get('frmdirector');
//            var_dump($fdata);

            //---------------------------------PARA MOSTRAR EN EL TEXBOX
             //$model = $this->loadModel('transporte');
             //$this->_view->reporte = FALSE;
            
            
//            if($cod_sede != ""){
//                $model->guardado($chofer,$placa,$inei);                
//            }                   
        
//            $fdata = $this->_request->get('frmdirector_id'); //Trae el GET
            //var_dump($fdata);
              
            if(isset($_GET['psede'])){
                     
                if(isset($_GET['exito']) ){
                    $exito = $_GET['exito'];
                    if($exito == '1'){
                        $this->_view->mensaje = 'Se guardo correctamente...';
                    }
                }
                
                $cod_sede = $_GET['psede'];
                //var_dump($fdata);
                
                if( isset($_GET['chofer']) && isset($_GET['placa']) && isset($_GET['representanteINEI']) ){
                    $chofer = $_GET['chofer'];
                    $placa = $_GET['placa'];
                    $representanteINEI = $_GET['representanteINEI'];

                    
                    if($cod_sede != "" && $chofer != "" && $placa != "" && $representanteINEI != ""){ // actualizamos la informacion 
                         $model->guardado($cod_sede,$chofer,$placa,$representanteINEI);
                         
                                    
                         $this->_view->redireccionar('local/registro?psede='.$cod_sede.'&exito=1');
                    }
                }
                
                
                
            }

            
                   
             $this->_view->transporte  = $model->obtenet_Datos_Transporte($cod_sede);
             $this->_view->sedes = $model->obtener_sedes();
            
             
             $this->_view->form = Model::createForm(array('model' => 'transporte'));
             
             //var_dump(  $this->_view->transporte );             exit();
             
            //---------------------------------------------
            
//            $this->_view->form = Model::createForm(array('model' => 'transporte'));

            $this->_view->setJs(array('registro'));
                       //var_dump(array('registro'));exit();
            $this->_view->renderizar('registro');
      
    }
    

    public function local_01() {
        if ($this->_request->session('sede') != '') {
            $this->_view->titulo = 'SCAI::ING. LOCAL';

//            $exist = FALSE; //Si existe el código de barra{valores FALSE y TRUE}
//            $leido = FALSE; //El código ya fue leído antes
//            $match = TRUE; //Si hizo match con la caja 2
//            $traeGet = FALSE; //Hay get
//            $firstSecond = FALSE; //INtenta primero ingresar el lado 20

            $this->_view->estado = '0';
            
            $modelCoBarras = $this->loadModel('tcobarra'); //Modelo de codigo de barras::Contiene lo que necesito
            $fdata = $this->_request->get('frmtcobarra'); //Trae el GET

            $this->_view->form = Model::createForm(array('model' => 'tcobarra'));

            // Verificar que no exista pendientes
                        
            //$caja_pendiente = $modelCoBarras->get(array("ESCANEO_PAREJA"=>1));
            
            
            /*
            $codBarraCajaPendiente = "";
            if(count($caja_pendiente) > 0){ // si existe pendiente
                switch ($caja_pendiente->PREFIJO_LADO){
                    case '10': 
                        $codBarraCajaPendiente = $caja_pendiente->CODIGO_SIN_LADO .'20';
                        break;
                    
                    case '20':
                        $codBarraCajaPendiente = $caja_pendiente->CODIGO_SIN_LADO .'10';
                        break;
                }                 
            }
              */  
           
            if ($fdata) {                                                
                //Si hay valor en el GET, procedemos
                $dataLeida = $modelCoBarras->get($fdata); //DataResultado
                                
                if (count($dataLeida) > 0) {
                    //si hay data
                    $this->_view->director = $dataLeida;                                         
                        // Si no ha sido leido  
                        if($dataLeida->ESTADO < 1){
                            switch ($dataLeida->PREFIJO_LADO) {
                                case '99':
                                    //Solo 1 vez
                                    //Actualizo el estado de leído
                                    $modelCoBarras->updateSuccessSinPareja($dataLeida->CODIGO_BARRA);
                                    $this->_view->estado = '3'; // exito
                                    break;
                                case '10':
                                     //Solo 1 vez
                                    //Actualizo el estado de leído
                                    $modelCoBarras->updateSuccessSinPareja($dataLeida->CODIGO_BARRA);
                                    $this->_view->estado = '3'; // exito
                                    break;
                                case '20':
                                    // Se pistoleo el lado 2 
                                    //Actualizo el estado de leído
                                    $this->_view->estado = '6'; // Mensaje de que fue escaneado el lado 2 
                                    break;
                            }                                                
                                                        
                        }else{// ha sido leido anteriormente
                            $this->_view->estado = '4'; // Ya fue escaneado
                        }                            
                }else{
                     $this->_view->estado = '5'; // No existe el codigo
                }
            } 
            

            //$this->_view->codBarraCajaPendiente = $codBarraCajaPendiente;
            
            $this->_view->setJs(array('local_01'));
            $this->_view->renderizar('lector');
        } else {
            $this->_view->renderizar('index', 'index');
        }
    }

    public function ex_local_01() {
        if ($this->_request->session('sede') != '') {
            $this->_view->titulo = 'SCAI::ING. LOCAL';
            $this->_view->director = FALSE; //porlas
            $this->_view->estado = FALSE; //porlas
            $model = $this->loadModel('director'); //porlas
            $fdata = $this->_request->get('frmdirector');
            $director = FALSE; //porlas
            $this->_view->estado = '0'; //porlas


            if ($fdata) {
                $director = $model->get($fdata);  // select * from postulantes2014 where ins_numdoc = '00000252'
                //var_dump($director);exit;
                if ($director) {
                    if ($director->estatus >= 0 && $director->estatus <= 1) {
                        if ($director->tipo !== '2') {
                            //normal
                            //if (( $this->_request->session('nro_local') === $director->nro_local)) {
                            $this->_view->director = $director;
                            //$model->actualizafecha($director->codigo, $this->_request->session('nro_local'));
                            // actualiza campo 'status'
                            $status = (int) $director->estatus + 1;
                            $model->exito($director->codigo, $this->_request->session('nro_local'), 'estatus', $status, 'fecha_registro');
                            $this->_view->estado = '1';
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

            $this->_view->setJs(array('local_01'));
            $this->_view->renderizar('local_01');
        } else {
            $this->_view->renderizar(
                    'index', 'index');
        }
    }

    public function local_02() {
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
                    if ($director->estatus2 == 0) {
                        if ($director->tipo !== '2') {
//normal
                            if (($this->_request->session('nro_local') === $director->nro_local)) {
                                $this->_view->director = $director;
//$model->actualizafecha($director->codigo, $this->_request->session('nro_local'));
// actualiza campo 'status'                                
                                $status = (int) $director->estatus2 + 1;


                                $model->exito($director->codigo, $this->_request->session('nro_local'), 'estatus2', $status, 'fecha_registro2');

                                $this->_view->estado = '1';
                            } else {
// Otro Local
                                $this->_view->director = $director;
                                $this->_view->estado = '3';
                            }
                        } else {

// Otro Local
                            $this->_view->director = $director;

                            $this->_view->estado = '3';
//                            }
                        }
                    } else {
// Ya tiene Asistencia

                        if ($director->tipo !== '2') {
                            $this->_view->director = $director;
                            $this->_view->estado = '2';
                        } else {
//                            $director1 = $model->director_local($director->ins_numdoc, $this->_request->session('nro_local'));
                            $this->_view->director = $director;
                            $this->_view->estado = '2';
                        }
                    }
                } else {
// No se encuentra en el padron
                    $this->_view->estado = '4';
                }
            }

            $this->_view->form = Model::createForm(array('model' => 'director'));

            $this->_view->setJs(array('local_02'));
            $this->_view->renderizar('local_02');
        } else {

            $this->_view->renderizar(
                    'index', 'index');
        }
    }

    public function local_03() {
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
                    if ($director->estatus3 == 0) {
                        if ($director->tipo !== '2') {
//normal
                            if (($this->_request->session('nro_local') === $director->nro_local)) {
                                $this->_view->director = $director;
//$model->actualizafecha($director->codigo, $this->_request->session('nro_local'));
// actualiza campo 'status'                                
                                $status = (int) $director->estatus3 + 1;


                                $model->exito($director->codigo, $this->_request->session('nro_local'), 'estatus3', $status, 'fecha_registro3');

                                $this->_view->estado = '1';
                            } else {
// Otro Local
                                $this->_view->director = $director;
                                $this->_view->estado = '3';
                            }
                        } else {

// Otro Local
                            $this->_view->director = $director;

                            $this->_view->estado = '3';
//                            }
                        }
                    } else {
// Ya tiene Asistencia

                        if ($director->tipo !== '2') {
                            $this->_view->director = $director;
                            $this->_view->estado = '2';
                        } else {
//                            $director1 = $model->director_local($director->ins_numdoc, $this->_request->session('nro_local'));
                            $this->_view->director = $director;
                            $this->_view->estado = '2';
                        }
                    }
                } else {
// No se encuentra en el padron
                    $this->_view->estado = '4';
                }
            }

            $this->_view->form = Model::createForm(array('model' => 'director'));

            $this->_view->setJs(array('local_03'));
            $this->_view->renderizar('local_03');
        } else {

            $this->_view->renderizar(
                    'index', 'index');
        }
    }

    public function local_04() {
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
                    if ($director->estatus4 == 0) {
                        if ($director->tipo !== '2') {
//normal
                            if (($this->_request->session('nro_local') === $director->nro_local)) {
                                $this->_view->director = $director;
//$model->actualizafecha($director->codigo, $this->_request->session('nro_local'));
// actualiza campo 'status'                                
                                $status = (int) $director->estatus4 + 1;


                                $model->exito($director->codigo, $this->_request->session('nro_local'), 'estatus4', $status, 'fecha_registro4');

                                $this->_view->estado = '1';
                            } else {
// Otro Local
                                $this->_view->director = $director;
                                $this->_view->estado = '3';
                            }
                        } else {

// Otro Local
                            $this->_view->director = $director;

                            $this->_view->estado = '3';
//                            }
                        }
                    } else {
// Ya tiene Asistencia

                        if ($director->tipo !== '2') {
                            $this->_view->director = $director;
                            $this->_view->estado = '2';
                        } else {
//                            $director1 = $model->director_local($director->ins_numdoc, $this->_request->session('nro_local'));
                            $this->_view->director = $director;
                            $this->_view->estado = '2';
                        }
                    }
                } else {
// No se encuentra en el padron
                    $this->_view->estado = '4';
                }
            }

            $this->_view->form = Model::createForm(array('model' => 'director'));

            $this->_view->setJs(array('local_04'));
            $this->_view->renderizar('local_04');
        } else {

            $this->_view->renderizar(
                    'index', 'index');
        }
    }

    private function getRemoteHost() {
        $model = $this->loadModel('usuario');
        $config = $model->getConfigwifi();

        return ($config->valor === '1' ? TRANSFER_HOST_LOCAL : TRANSFER_HOST);
    }

    public function transfer() {
        $_data = $this->_request->post();
        $data = json_encode($_data);

        $ch = curl_init($this->getRemoteHost());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, "data=$data");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($ch);

        $error = curl_error($ch);

        curl_close($ch);
        if (!$error) {
            if ($respuesta) {
                $model = $this->loadModel('director');
                $model->enviado($_data['ins_numdoc'], $this->_request->session('nro_local'));
                $json = json_decode($respuesta);
                $this->_view->json = $json;
                $this->_view->renderizarJson();
            }
        } else {
            $model = $this->loadModel('director');
            $model->trunco($_data['ins_numdoc']);
        }
    }

}
