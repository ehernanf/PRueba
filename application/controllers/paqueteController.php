<?php

class paqueteController extends Controller {

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

    
    public function resetBD() {

        // limpiar paquete 
        $model = $this->loadModel('paquete');        
        $model->limpiar();
        // limpiar caja
        $model_caja = $this->loadModel('caja');
        $model_caja->limpiar();
        // limpiar sede
        $model_sede = $this->loadModel('sede');
        $model_sede-> limpiar();
        
        $json = array('success' => TRUE);
        $this->_view->json = $json;
        $this->_view->renderizarJson();
    }
    public function listar_sede(){ 
        $model = $this->loadModel('paquete');
        $model->lista_sede();
        
    }
    public function borrar_caja(){
        $cod_caja = $this->_request->get('cod_caja');
        $model_paquete = $this->loadModel('caja');   
        $model_paquete->borrar_caja($cod_caja);     
    }
     
    public function agregar_caja(){
        $sede_operativa=$this->_request->get('sede_operativa');
        $cod_so=$this->_request->get('cod_so');
        $model=$this->loadModel('caja');
        $model->agregar_caja($cod_so, $sede_operativa);
    }


    public function cerrar_caja() {           
        $cod_sede = $this->_request->get('cod_sede');
        $cod_caja = $this->_request->get('cod_caja');
        $peso = $this->_request->get('peso');
         
        $model = $this->loadModel('caja');        
        // cerrar la caja
        $rows = $model->cerrar_caja($cod_caja,$peso);
        $respuesta['exito'] = '0';
        
        //var_dump($rows);
        if($rows > 0){ // verificar si todas las cajas de la sede estan cerradas
            $respuesta['exito'] = '1';            
            $model_paquete = $this->loadModel('paquete');        
            // nro de paquetes de la sede            
            $nro_paquetes  = $model_paquete->get_nro_paquetes($cod_sede);            
            // nro de paquetes que asignados a cajas 
            $nro_paquetes_inv = $model_paquete->get_nro_paquetes_con_caja($cod_sede);
            
            // para cerrar la sede            
            if($nro_paquetes <= $nro_paquetes_inv){                
                $model_sede = $this->loadModel('sede');
                $model_sede->cerrar_sede($cod_sede);                                        
                // redireccionar el proyecto
                //$this->_session->set_flashdata('cod_sede',$cod_sede);
              //  redirect('paquete?txtSede='.$cod_sede);
                
                
                //BASE_URL . 'index.php/listar/
               // header("Location: ". BASE_URL .'index.php/paquete?txtSede='.$cod_sede);
                //die();
                $respuesta['exito'] = '2';            
            }
            
        }
        
        
        
        
        $this->_view->reporte = FALSE;
        //$local = $this->_request->session('nro_local');
        //$valores = $model->getCajasFaltantes($tipo);
        
        $rData = json_encode($respuesta);  
        
        echo $rData;        
    }
    
    

    
    
    public function index() {
        
        
        if ($this->_request->session('sede') != '') {
            
            
            $this->_view->titulo = 'INVENTARIO';
            $this->_view->director = FALSE;
            $this->_view->estado = FALSE;
            $local = $this->_request->session('nro_local');
            $fdata = $this->_request->get();
            
            
            
          //  $this->_view->estado = '0';

            if (isset($fdata['txtCaja']) && $fdata['txtCaja'] != "") {
                     $model_paquete = $this->loadModel('paquete');
                // validar si existe caja pendiente para cerrar 
                $cajas_pendientes = $model_paquete->cajas_pendientes();                                
                $model_caja = $this->loadModel('caja');
                $pendiente_caja = false;
                if(count($cajas_pendientes) > 0 && $cajas_pendientes->COD_CAJA != $fdata['txtCaja']) {
                    $pendiente_caja = true;
                    $this->_view->estado = 5;  // caja pendiente
                    $caja_ingresada = $cajas_pendientes;
                }else{
                    $caja_ingresada = $model_caja->get_caja($fdata['txtCaja']);
                }
                    
                    
                    

                    if(count($caja_ingresada) > 0){
                        
                        // validar si la caja esta cerrada
                        if($caja_ingresada->ESTADO == '1'){
                            $this->_view->estado = '7'; // Si la caja esta cerrada 
                        }
                        
                        $this->_view->caja = $caja_ingresada;
                        $cod_sede = $caja_ingresada->COD_SEDE;
                        
                        $this->_view->cod_sede = $cod_sede;

                        // Verificamos que la sede haya finalizado 
                        $model_sede = $this->loadModel('sede');

                        // verificamos que la sede esta cerrada(todos sus paquetes han sido inventariados)                
                        $sede = $model_sede->get_sede($cod_sede);
                        $sede = $sede[0];
                        if ($sede->ESTADO == '1') {
                            $this->_view->estado = '8';
                        }


                        //$cod_sede = $fdata['txtSede'];
                        $model_paquete = $this->loadModel('paquete');



                        // varificamos si se ingreso  un codigo de paquete 
                        if (isset($fdata['txtCodPaquete']) && $fdata['txtCodPaquete'] != "") {

                            // recuperar los datos del paquete 
                            $paquete = $model_paquete->get_paquete($fdata['txtCodPaquete']);
                            //var_dump($paquete);
                            // verificar si esta inventariado 
                            if (count($paquete) > 0) { // si existe el paquete                        
                                $this->_view->paquete = $paquete;
                                // validar que pertenesca a la sede                         
                                if ($paquete->COD_SEDE == $cod_sede) {
                                    // validar si esta inventariado o no 

                                    if ($paquete->ESTADO > 0) { // el paquete esta inventariado 
                                        $this->_view->estado = '3'; // El paquete esta inventariado
                                    } else {// inventariar 
                                        $nro_filas = $model_paquete->actualizarEstado($cod_sede, $fdata['txtCodPaquete'],$fdata['txtCaja']);

                                        if ($nro_filas > 0) { // Paquete inventariado correctamente
                                            $this->_view->estado = '1'; // Paquete inventariado
                                        } else {
                                            // No se pudo inventariar
                                        }
                                    }
                                }else{
                                    $this->_view->estado = '4'; // Paquete no pertenece a la sede
                                }                        
                            } else { // is no existe el paquete 
                                $this->_view->estado = '2'; // No existe el paquete 
                            }                        
                        }
                         // paquetes inventariados de la caja
                        $this->_view->paquetes_de_caja = $model_paquete->get_paquetes_por_caja($caja_ingresada->COD_CAJA);
                        // paquetes que faltan inventariar de la sede
                       // if(!$pendiente_caja){
                        if($this->_view->estado <> '7' ){// si la caja no esta cerrada
                            $this->_view->paquetes_sin_inventariar = $model_paquete->get_paquetes($cod_sede); 
                        }
                        //}

                    }else{ // El codigo de caja no existe
                        $this->_view->estado = '6'; 
                    }                
//                }else{
                    // existen cajas pendientes de cerrar 
                    //echo  $cajas_pendientes[0]['COD_CAJA'];
//                    $this->_view->caja = $cajas_pendientes;
                    //exit;
//                }
                                             
                /*
                
                //recuperamos el numero menor de caja que falta inventariar
                $model_caja = $this->loadModel('caja');
                $caja = $model_caja->get_caja_faltante($cod_sede);
                
                if (count($caja) <= 0) {
                    // redireccionamos por que no existe faltante                    
                } else {
                    $caja = $caja[0];
                    //exit;
                    $this->_view->caja = $caja;
                    
                }

                
                // numero de caja y paquete enviado del formulario                
                if (isset($fdata['txtCaja']) && isset($fdata['txtCodPaquete'])) { // actualizar estado del paquete 
                    
                    
                    // recuperar los datos del paquete 
                    $paquete = $model_paquete->get_paquete($fdata['txtCodPaquete']);
                    //var_dump($paquete);
                    // verificar si esta inventariado 
                    if (count($paquete) > 0) { // si existe el paquete                        
                        $this->_view->paquete = $paquete;
                        // validar que pertenesca a la sede                         
                        if ($paquete->COD_SEDE == $cod_sede) {
                            // validar si esta inventariado o no 
                            
                            if ($paquete->ESTADO > 0) { // el paquete esta inventariado 
                                $this->_view->estado = '3'; // El paquete esta inventariado
                            } else {// inventariar 
                                $nro_filas = $model_paquete->actualizarEstado($cod_sede, $fdata['txtCodPaquete'],$fdata['txtCaja']);
                                
                                if ($nro_filas > 0) { // Paquete inventariado correctamente
                                    $this->_view->estado = '1'; // Paquete inventariado
                                } else {
                                    // No se pudo inventariar
                                }
                            }
                        }else{
                            $this->_view->estado = '4'; // Paquete no pertenece a la sede
                        }                        
                    } else { // is no existe el paquete 
                        $this->_view->estado = '2'; // No existe el paquete 
                    }
                    
                }

                  


                

                // paquetes inventariados de la caja
                    $this->_view->paquetes_de_caja = $model_paquete->get_paquetes_por_caja($caja->COD_CAJA);


                // recuperamos todos los paquetes de la sede que faltan inventariar                              
                $this->_view->txtSede = $cod_sede;
                //$this->_view->setJs('index');
                 $this->_view->setJs(array('index'));
                 */
                    $this->_view->setJs(array('index','teclado'));
                $this->_view->renderizar('index');
                
                
            } else {
                $this->_view->setJs(array('index'));
                $this->_view->renderizar('index');                
            }
        }else{
            $this->_view->renderizar('index', 'index');
        }
    }
    
}
