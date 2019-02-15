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
class paqueteModel extends Model {
    public function lista_sede(){
        $this->_db->order_by('sede', 'asc');        
        $q = $this->_db->get('sede');
        header('Content-Type: application/json');
        echo json_encode($q->result());
    }

    public function getFields() {
        $devuelve = array(
            array('codigo', 'type' => 'INTEGER', 'primary_key' => TRUE, 'render' => TRUE),
            array('tipo', 'nro_local', 'naula', 'type' => 'INTEGER', 'render' => TRUE),
            array('nombre', 'type' => 'TEXT', 'render' => TRUE),
        );
        return $devuelve;
    }
    public function borrar_caja($cod_caja){
        $where = array(
        'COD_CAJA' => $cod_caja,
        );
        $where2 = array(
            'CAJA' => $cod_caja,
            );
        $data = array(
            'ESTADO'=>'0',
            'fecha'=>'',
            'CAJA'=>'',
        );
    $this->_db->delete($this->tableName(), $where);
    $this->_db->replace('paquete', $data, $where2);
    return $this->_db->affected_rows();
}
    public function getRules() {
        $data = array(
            array('naula', 'required' => TRUE)
        );
        return $data;
    }
    


    public function tableName() {
        return 'paquete';
    }

   function setEstadoEnvioMasivo($data, $key) {
        $this->_db->update_batch($this->tableName(), $data, $key);
    }
    
    function getDataEnvioMasivo($event,$mass) {
        $this->_db->from('paquete');
        $this->_db->join('caja', 'paquete.CAJA = caja.COD_CAJA', 'left');
        $this->_db->where('paquete.estado', '1');     
         
        if ($mass) {
            $q = $this->_db->get();
        } else {
            $q = $this->_db->get();
        }
        $result = $q->result('array');
        //var_dump($result);  
        $q->free_result();
        return $result;
    }
    
    function  getPorCodigo($cod_sede,$type = 'object')
    {
        
        //$this->_db->where('ESTADO', '0');
        $this->_db->from('paquete');
        
        $this->_db->join('caja', 'paquete.CAJA = caja.COD_CAJA', 'left');
        $this->_db->where('paquete.cod_sede', $cod_sede);
        $this->_db->order_by('paquete.cod_manual', 'asc');
        
        
        $q = $this->_db->get();
        
        $result = $q->result($type);
       // var_dump($result);
        return $result;
    }
     
    function  get_paquetes($cod_sede,$type = 'object'){
        $this->_db->where('cod_sede', $cod_sede);
        $this->_db->where('ESTADO', '0');
        $this->_db->order_by('cod_manual', 'asc');
        
        $q = $this->_db->get($this->tableName());
        $result = $q->result($type);
        return $result;
    }
       
     function  get_paquetes_por_caja($cod_caja,$type = 'object'){
        $this->_db->where('CAJA', $cod_caja);
        $this->_db->where('ESTADO', '1');
        $this->_db->order_by('cod_manual', 'asc');
        
        $q = $this->_db->get($this->tableName());
        $result = $q->result($type);
        return $result;
    }
       
    
    
    public function actualizarEstado($cod_sede, $cod_paquete,$cod_caja) {

        ini_set('date.timezone', 'America/Lima');
        $where = array('COD_SEDE' => $cod_sede,'COD_PAQUETE' => $cod_paquete);
        $data = array(            
            'FECHA' => date('Y-m-d H:i:s'),
            'CAJA' => $cod_caja ,
            'ESTADO' => '1');
        $this->_db->update($this->tableName(), $data, $where);
        return $this->_db->affected_rows();
    }
    
    
    public function get_paquete($cod_paquete, $type = 'object') {
        //$this->_db->where('COD_SEDE', $cod_sede);
        $this->_db->where('COD_PAQUETE', $cod_paquete);
        $q = $this->_db->get($this->tableName());
        $result = $q->row_object();
        return $result;
    }
    
    public function get_nro_paquetes($cod_sede){
        $this->_db->where('COD_SEDE',$cod_sede);
        return $this->_db->count_all_results($this->tableName());
    }
            
    
    public function get_nro_paquetes_con_caja($cod_sede){
        $this->_db->where('COD_SEDE',$cod_sede);
        $this->_db->where('ESTADO','1');
        $this->_db->where('CAJA IS NOT NULL');
        return $this->_db->count_all_results($this->tableName());
        
    }

    
    public function cajas_pendientes(){
        $sql = " select c.* from caja c inner join paquete p on c.COD_CAJA = p.CAJA where c.estado = 0 limit 1";
        $result= $this->_db->query($sql);
        //$result = $q->result('array');
        return $result->row_object();;
    }
    public function limpiar() {
        $sql = "
update paquete SET
ESTADO = 0,
FECHA = null,
CAJA = null;
 ";   
      //  $sql = 'DELETE FROM postulantes2014';
        $query = $this->_db->query($sql);
    }
    
     //Registros pistoleados y leídos
    public function count_RegistrosLeidos() {
        
         $sql = "
             select COD_PAQUETE,CAJA,SEDE,COD_MANUAL,MANUAL,fecha,estado,caja 
from paquete
WHERE estado = 1 and caja is not null
ORDER BY SEDE, CAJA,COD_PAQUETE
";
        
         
        $q = $this->_db->query($sql);
        $result = $q->result('array');
        return $result;
    }
    
    
     public function count_CajasInventariadasCompletas() {
        
         $sql = "select COD_PAQUETE,CAJA,SEDE,COD_MANUAL,MANUAL,fecha,estado,caja
from paquete
WHERE estado = 1 and caja is not null
ORDER BY SEDE, CAJA, COD_PAQUETE";
        
         
        $q = $this->_db->query($sql);
        $result = $q->result('array');
        return $result;
    }    
 
    
     public function filtro_input($count = NULL, $start = NULL, $type = 'object') {                
        
        
        $sql = "select COD_PAQUETE,CAJA,SEDE,COD_MANUAL,MANUAL,fecha,estado,caja

from paquete
WHERE estado = 1 and caja is not null
ORDER BY SEDE, CAJA,COD_PAQUETE ASC
LIMIT %s OFFSET %s ";
        
    
        
        $q = $this->_db->query(sprintf($sql, $count, $start));
        $result = $q->result($type);
        return $result;
    }







    
}
