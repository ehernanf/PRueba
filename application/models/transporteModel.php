<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of directorModel
 *
 * @author cdelgadoc
 */
class transporteModel extends Model {

    public function getFields() {
        $devuelve = array(
            array('cod_sede', 'type' => 'TEXT', 'primary_key' => TRUE, 'render' => TRUE),
            array('sede','chofer', 'placa', 'reprentanteINEI','fecha', 'type' => 'TEXT', 'render' => TRUE),
             array('estado', 'type' => 'INTEGER', 'render' => TRUE)
        );
        return $devuelve;
    }

    public function getRules() {
        $data = array(
            array('clave', 'required' => TRUE)
        );
        return $data;
    }

    public function tableName() {
        return 'T_TRANSPORTE';
    }

    /**
     * Crea una tabla independiente con los registros del local asignado al 
     * usuario que ha iniciado sesión. Esto se hace una sola vez y no esta
     * preparado para soportar varios logins de distintos locales.
     * @param string $nrolocal
     * @return int
     */
 
        
    public function guardado($cod_sede,$chofer=NULL,$placa=NULL,$representanteINEI=NULL) {
        //print($idfuncion.$check.$obs.$usuario);
//        var_dump("controller");
//        EXIT();
//        
       // $sql = "insert into Transporte(ruta,chofer,placa,reprentanteINEI) values (".$_SESSION['nro_local'].",'".$chofer."','".$placa."','".$inei."')";
   
        
        $sql = "UPDATE " . $this->tableName(). 
" SET chofer = '".$chofer."', placa ='".$placa."', representanteINEI = '".$representanteINEI."',fecha = datetime(),estado='1'
WHERE cod_sede=".$cod_sede."";
        
//        var_dump($sql);       
//        exit;
        $q = $this->_db->query($sql);          
        //$result = $q->result($type);       
        return $this->_db->affected_rows();
        
    }
    
      function obtenet_Datos_Transporte($cod_sede,$type = 'object'){

        $sql="Select *  from ".$this->tableName()." WHERE cod_sede='".$cod_sede."' and chofer <> ''";
        $q = $this->_db->query($sql);
        $result = $q->result($type);
        return $result;
     }
     
     function obtener_sedes($type = 'object'){
         $sql="Select cod_sede,sede  from ".$this->tableName()." ";
        $q = $this->_db->query($sql);
        $result = $q->result($type);
        return $result;
     }
       public function getDataEnvio($cod_sede) {
        $data = array();       
        $data = $this->getDataEnvioEvento1($cod_sede);
        //var_dump($data);
        //exit();
        return $data;
    }
    
    function getDataEnvioEvento1($cod_sede) {        
       //var_dump($id_incidencia);
//         var_dump($id_funcion);
      //  exit();
        $this->_db->select('cod_sede, chofer,placa,representanteINEI');
        $this->_db->where('cod_sede', $cod_sede);
        $q = $this->_db->get($this->tableName());
        //var_dump($q);
        return $q->result('array');
        //var_dump($q->result('array'));exit();
    }
    
     function limpiar() {
        $sql = 'UPDATE '.$this->tableName() .' SET chofer = NULL, placa = NULL,representanteINEI =NULL,fecha=NULL,estado=0';
        $query = $this->_db->query($sql);
    }
    
    
    function setEstadoEnvioMasivo($data) {                   
            $where = array('cod_sede' => $data[0]->cod_sede );            
            $data = array('estado'=>$data[0]->estado,'fecha' => $data[0]->fecha); 
            $this->_db->update($this->tableName(), $data, $where);
            return $this->_db->affected_rows();        
    }
}
