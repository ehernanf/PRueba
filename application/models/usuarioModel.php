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
class usuarioModel extends Model {

    public function getFields() {
        $devuelve = array(
            array('id', 'type' => 'INTEGER', 'primary_key' => TRUE, 'render' => TRUE),
            array('status', 'created_by', 'update_by', 'delete_by', 'type' => 'INTEGER', 'render' => TRUE),
            array('nombre', 'email', 'password', 'remember_token','user', 'type' => 'TEXT', 'render' => TRUE)
        );
        return $devuelve;
    }

    public function getRules() {
        $data = array(
            array('password', 'required' => TRUE)
        );
        return $data;
    }

    public function tableName() {
        return 'T_GNRL_USUARIOS';
    }

    /**
     * Crea una tabla independiente con los registros del local asignado al 
     * usuario que ha iniciado sesión. Esto se hace una sola vez y no esta
     * preparado para soportar varios logins de distintos locales.
     * @param string $nrolocal
     * @return int
     */
    function preCargaPadronLocal() {
        //$sql = "CREATE TABLE IF NOT EXISTS postulantes2014 AS SELECT * FROM nacional WHERE nro_local = $nrolocal";
        //$result = $this->_db->query($sql);
        /*
         * buscar el padron del usuario que se logueo en la tabla independiente
         * Si no hay datos se cargaran, esto se hara por cada usuario.
         */

        $sql = "SELECT * FROM T_GNRL_USUARIOS";
        $result = $this->_db->query($sql);


/*

        if ($nrolocal === 0) {
            $this->_db->where(array('1' => 1));
            $countLocal = $this->_db->count_all_results('postulantes2014');
        }  else {
            $this->_db->where(array('nro_local' => $nrolocal));
            $countLocal = $this->_db->count_all_results('postulantes2014');
        }
        
        //var_dump($countLocal);
        //exit();

        if ($countLocal === 0) {
            if ($nrolocal === 0) {
                $sql = "INSERT INTO postulantes2014 SELECT * FROM nacional";
                $result = $this->_db->query($sql);
                
                $sql = "update postulantes2014 set nro_local=0";
                $result = $this->_db->query($sql);
            }else{
                $sql = "INSERT INTO postulantes2014 SELECT * FROM nacional WHERE nro_local = $nrolocal";
                $result = $this->_db->query($sql);
            }
        }
        */
        return $result;
    }

    public function configwifi($codigo) {
        $where = array('id' => 1);
        $data = array('valor' => $codigo);
        $this->_db->update('config', $data, $where);
        return $this->_db->affected_rows();
    }

    public function getConfigwifi() {
        $where = array('id' => 1);
        $this->_db->where($where);
        $q = $this->_db->get('config');
        return $q->row();
    }
}
