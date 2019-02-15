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
class rolModel extends Model {

    public function getFields() {
        $devuelve = array(
            array('ID', 'type' => 'INTEGER', 'primary_key' => TRUE, 'render' => TRUE),
            array('NOMBRE','MENUS_ID', 'type' => 'TEXT', 'render' => TRUE),
        );
       // 'FILA','ID', 'NOMBRE', 'URL', 'IMAGEN_ID', 'ID_PADRE','FAMILIA','IMAGEN'
        //ID, NOMBRE, ORDEN, URL, IMAGEN_ID, ID_PADRE, USUCRE, FECCRE, USUREG, FECREG
        return $devuelve;
    }

    public function getRules() {
        $data = array(
            array('ID', 'required' => TRUE)
        );
        return $data;
    }

    public function tableName() {
        return 'T_ROLES';
    }

    function getRol($rol, $type = 'object') {
       // var_dump("ewrw");
        //exit();
        $this->_db->where('ID', $rol);
        $this->_db->order_by('ID', 'asc');
        $q = $this->_db->get($this->tableName());
        $result = $q->result($type);
        return $result;
    }
    
    function getRolin($rolmenu) {
       // var_dump("ewrw");
        //exit();
        $sql = "SELECT * FROM "+$this->tableName()+" WHERE ID_PADRE IN ("+$rolmenu+")";
        $result = $this->_db->query($sql);
        //$result = $q->result($type);
        return $result;
    }
    
    
    
}