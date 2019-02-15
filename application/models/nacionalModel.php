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
class nacionalModel extends Model {

    public function getFields() {
        $devuelve = array(
            array('codigo', 'type' => 'INTEGER', 'primary_key' => TRUE, 'render' => TRUE),
            array('estatus', 'ins_numdoc', 's_cartilla', 's_aula', 's_ficha', 'cant_ficha', 'type' => 'INTEGER', 'render' => TRUE),
            array('sede', 'aula', 'local_aplicacion', 'apepat', 'apemat', 'nombres', 'nro_local', 'direccion', 'type' => 'TEXT', 'render' => TRUE),
            array('f_aula', 'discapacidad', 'f_cartilla', 'f_ficha', 'codFicha', 'codCartilla', 'new_aula', 'new_local', 'tipo', 'type' => 'TEXT', 'render' => TRUE),
        );
        return $devuelve;
    }

    public function getRules() {
        return array(
            array('ins_numdoc', 'required' => TRUE, 'minlength' => 8, 'maxlength' => 11),
        );
    }

    public function tableName() {
        return 'nacional';
    }

    public function actualizafecha($codigo, $local) {
        ini_set('date.timezone', 'America/Lima');
        $where = array('codigo' => $codigo,
            'nro_local' => $local);
        $data = array('fecha_registro' => date('Y-m-d H:i:s'));
        $this->_db->update($this->tableName(), $data, $where);
        return $this->_db->affected_rows();
    }

    function limpiar() {
        $sql = "update postulantes2014 SET
aula_ficha=NULL,
aula_cartilla=NULL,
s_aula='0',
f_aula=NULL,
sf_aula=NULL,
s_ficha='0',
f_ficha=NULL,
sf_ficha=NULL,
s_cartilla='0',
f_cartilla=NULL,
sf_cartilla=NULL,
new_aula='0',
new_local='0',
estatus='0',
cant_ficha='0',
fecha_registro=NULL,
sfecha_registro=NULL ";
        $query = $this->_db->query($sql);
    }

}
