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
class headerModel extends Model {

    public function getFields() {
        return array(
            array('ID', 'type' => 'INTEGER', 'primary_key' => TRUE, 'render' => TRUE),
            array('ORDEN', 'IMAGEN_ID', 'ID_PADRE', 'FAMILIA', 'FILA', 'type' => 'INTEGER', 'render' => TRUE),
            array('NOMBRE', 'URL', 'USUCRE', 'FECCRE', 'USUREG', 'FECREG', 'IMAGEN', 'type' => 'TEXT', 'render' => TRUE),
        );
        // 'FILA','ID', 'NOMBRE', 'URL', 'IMAGEN_ID', 'ID_PADRE','FAMILIA','IMAGEN'
        //ID, NOMBRE, ORDEN, URL, IMAGEN_ID, ID_PADRE, USUCRE, FECCRE, USUREG, FECREG
    }

    public function getRules() {
        return array(array('ID', 'required' => TRUE));
    }

    public function tableName() {
        return 'V_LISTA_MENU';
    }

    function getHeader_($menusrol, $type = 'object') {
        $this->_db->where('ID_PADRE', array('id' => 1));
        $this->_db->order_by('ID', 'asc');
        $q = $this->_db->get($this->tableName());
        $result = $q->result($type);
        return $result;
    }

    function getHeader($menusrol = 'array', $type = 'object') {
//        $this->_db->where_in('ID_PADRE', array($menusrol))->or_where('ID', array($menusrol));
        $this->_db->where("(ID_PADRE IN(" . $menusrol . ") OR ID IN(" . $menusrol . "))");
        $this->_db->order_by('ID', 'asc');
        $q = $this->_db->get($this->tableName());
        $result = $q->result($type);
        return $result;
    }

    function getHeaderMenu($rolmenu) {
        $sql = "SELECT * FROM " . $this->tableName() . " WHERE ID_PADRE IN (" . $rolmenu . ")";
        $result = $this->_db->query($sql);
        var_dump($result);
        exit();
        return $result;
    }

    /*
      function get_selaula($aula, $nroLocal, $type = 'object') {

      $this->_db->where('nro_local', $nroLocal);
      $this->_db->where('naula', $aula);

      $q = $this->_db->get($this->tableName());
      $result = $q->result($type);
      return $result;
      }

      function get_postulante_aula($ins_numdoc, $type = 'object') {
      $this->_db->where('ins_numdoc', $ins_numdoc);
      $q = $this->_db->get('lv_local_aula');
      $result = $q->row_object();
      return $result;
      }

      function get_ficha_aula($ins_numdoc, $type = 'object') {
      $this->_db->where('codFicha', $ins_numdoc);
      $q = $this->_db->get('lv_local_aula');
      $result = $q->row_object();
      return $result;
      }

      function get_cartilla_aula($ins_numdoc, $type = 'object') {
      $this->_db->where('codCartilla', $ins_numdoc);
      $q = $this->_db->get('lv_local_aula');
      $result = $q->row_object();
      return $result;
      }

      function get_contingencia_aulas($local) {
      $this->_db->select('naula');
      $this->_db->where('nro_local', $local);
      $this->_db->where('tipo', 0);
      $q = $this->_db->get('aulas_local');
      $result = $q->result_array();
      $_result = array();
      foreach ($result as $value) {
      $_result[] = $value['naula'];
      }
      return $_result;
      }

      public function aula($codigo, $local, $aula) {

      ini_set('date.timezone', 'America/Lima');
      $where = array('codigo' => $codigo);
      $data = array(
      'new_local' => $local,
      'new_aula' => $aula,
      'f_aula' => date('Y-m-d H:i:s'),
      's_aula' => '1');
      $this->_db->update('postulantes2014', $data, $where);
      return $this->_db->affected_rows();
      }

      public function ficha($codigo, $cantFicha, $aula) {
      $cantFicha = $cantFicha + 1;
      ini_set('date.timezone', 'America/Lima');
      $where = array('codFicha' => $codigo);
      $data = array(
      'f_ficha' => date('Y-m-d H:i:s'),
      's_ficha' => '1',
      'cant_ficha' => $cantFicha,
      'id_aula' => $aula,
      'new_aula' => $aula,
      'aula' => $aula
      );
      $this->_db->update('postulantes2014', $data, $where);
      return $this->_db->affected_rows();
      }


      public function cartilla($codigo, $aula) {
      ini_set('date.timezone', 'America/Lima');
      $where = array('codCartilla' => $codigo);
      $data = array(
      'f_cartilla' => date('Y-m-d H:i:s'),
      's_cartilla' => '1',
      'id_aula' => $aula,
      'new_aula' => $aula,
      'aula' => $aula
      );
      $this->_db->update('postulantes2014', $data, $where);
      return $this->_db->affected_rows();
      }
     */
}
