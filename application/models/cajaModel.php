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
class cajaModel extends Model {

    public function getFields() {
        $devuelve = array(
            array('codigo', 'type' => 'INTEGER', 'primary_key' => TRUE, 'render' => TRUE),
            array('tipo', 'nro_local', 'naula', 'type' => 'INTEGER', 'render' => TRUE),
            array('nombre', 'type' => 'TEXT', 'render' => TRUE),
        );
        return $devuelve;
    }

    public function getRules() {
        $data = array(
            array('naula', 'required' => TRUE)
        );
        return $data;
    }
    


    public function tableName() {
        return 'caja';
    }

    
    
    
    function  get_caja_faltante($cod_sede,$type = 'object'){
        
        $this->_db->where('cod_sede',$cod_sede);
        $this->_db->where('ESTADO','0');
        $this->_db->order_by('NUM_CAJA', 'ASC');
        $this->_db->limit(1);
        
        $q = $this->_db->get($this->tableName());
        $result = $q->result($type);
        return $result;
    }
    
    function get_caja($cod_caja,$type = 'object'){
        
        $this->_db->where('COD_CAJA', $cod_caja);
        $q = $this->_db->get($this->tableName());
        $result = $q->row_object();
        return $result;
    }
    
    
    public function cerrar_caja($cod_caja,$peso) {        
        ini_set('date.timezone', 'America/Lima');
                 
        
        $where = array('cod_caja' => $cod_caja);
        $data = array(
            'FECHA' => date('Y-m-d H:i:s'),
            'ESTADO' => '1',
            'PESO' => $peso,
        );
        $this->_db->update($this->tableName(), $data, $where);
        return $this->_db->affected_rows();
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
            $this->_db->update('paquete', $data, $where2);
            $this->_db->delete('caja', $where);
        
    }
    public function agregar_caja($cod_so, $sede_operativa)
    {   
        $this->_db->select('COD_SEDE');
        $this->_db->from('caja');
        $this->_db->where('COD_SEDE',$cod_so);
        
        $count = $this->_db->count_all_results()+1;
        if ($count<=9)
        {
            $count='0'.$count;
        }
        $data = array(
            'COD_SEDE'=>$cod_so,
            'SEDE'=>$sede_operativa,
            'COD_NIVEL'=>'03',
            'NIVEL'=>'NIVEL3',
            'NUM_CAJA'=>$count,
            'COD_CAJA'=>$cod_so.'03'.$count,
            'ESTADO'=>'0',
        );
        $this->_db->insert('caja', $data);
        echo $data['COD_CAJA'];
    }
    function limpiar() {
        $sql = "
DELETE FROM caja
 ";
   
      //  $sql = 'DELETE FROM postulantes2014';
        $query = $this->_db->query($sql);
    }

}
