<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tcobarraModel
 * Tabla que contiene los registros de los códigos de barra
 * @author Aquino
 */
class tcobarraModel extends Model {

    public function getFields() {
        return array(
            array('CODIGO_BARRA', 'type' => 'TEXT', 'primary_key' => TRUE, 'render' => TRUE),
            array('CODIGO_SIN_LADO','FORMATO_CODIGOBARRA', 'COD_SEDE', 'SEDE', 'COD_LOCAL', 'NOMBRE_LOCAL',
                'PREFIJO_CAJA', 'ORDEN_CAJA', 'LADO_ETIQUETA', 'PREFIJO_LADO', 'FECHA',
                'type' => 'TEXT', 'render' => TRUE),
            array('ESTADO,ESCANEO_PAREJA', 'type' => 'INTEGER', 'render' => TRUE),
        );
    }

    public function getRules() {
        return array(
            array('CODIGO_SIN_LADO','ESCANEO_PAREJA','FORMATO_CODIGOBARRA', 'COD_SEDE', 'SEDE', 'COD_LOCAL', 'NOMBRE_LOCAL',
                'PREFIJO_CAJA', 'ORDEN_CAJA', 'LADO_ETIQUETA', 'PREFIJO_LADO', 'FECHA',
                'required' => TRUE),
            array('CODIGO_BARRA', 'required' => TRUE, 'minlength' => 7, 'maxlength' => 11),
            array('ESTADO', 'required' => TRUE),
        );
    }

    public function tableName() {
        return 'T_COBARRA';
    }

    //Registro leído
    public function updateSuccess($codigoBarra) {
        ini_set('date.timezone', 'America/Lima');
        $where = array('CODIGO_BARRA' => $codigoBarra);
        $data = array('FECHA' => date('Y-m-d H:i:s'), 'ESTADO' => 1,'ESCANEO_PAREJA' => 1 );
        $this->_db->update($this->tableName(), $data, $where);
        return $this->_db->affected_rows();
    }

    
    public function updateEscaneoPareja($codigoSinLado) {
        ini_set('date.timezone', 'America/Lima');
        $where = array('CODIGO_SIN_LADO' => $codigoSinLado);
        $data = array('ESCANEO_PAREJA' => 2 );
        $this->_db->update($this->tableName(), $data, $where);
        return $this->_db->affected_rows();
    }
    
    
    
    
    //Registro leído
    public function updateSuccessSinPareja($codigoBarra) {
        ini_set('date.timezone', 'America/Lima');
        $where = array('CODIGO_BARRA' => $codigoBarra);
        $data = array('FECHA' => date('Y-m-d H:i:s'), 'ESTADO' => 1);
        $this->_db->update($this->tableName(), $data, $where);
        return $this->_db->affected_rows();
    }    
    
    //Registros pistoleados y leídos
    public function count_RegistrosLeidos() {
        
         $sql = "select CODIGO_BARRA,sede,ORDEN_CAJA as ORDEN_CAJA,fecha,estado
 
from T_COBARRA
WHERE prefijo_lado in ('10','99') and estado > 0

";
        
         
        $q = $this->_db->query($sql);
        $result = $q->result('array');
        return $result;
    }

    public function count_CajasInventariadasCompletas() {
        
         $sql = "select CODIGO_BARRA,sede,ORDEN_CAJA as ORDEN_CAJA,fecha,estado
 
from T_COBARRA
WHERE prefijo_lado in ('10','99') and estado >=2;";
        
         
        $q = $this->_db->query($sql);
        $result = $q->result('array');
        return $result;
    }    
    
    public function existePendientes($type = 'object'){
        $sql = "select count(*) AS nro_pendientes from T_COBARRA where ESCANEO_PAREJA = 1 ";
        $q = $this->_db->query($sql);
        
        $result = $q->result($type);
        return $result;
    }
    
    public function filtro_input($count = NULL, $start = NULL, $type = 'object') {        
        $sql = "
		select CODIGO_BARRA,sede,ORDEN_CAJA as ORDEN_CAJA,fecha,estado
 
from T_COBARRA
WHERE prefijo_lado in ('10','99') and estado > 0
order by estado,sede asc
                LIMIT %s OFFSET %s " ;
        
        
        
        
    
        
        $q = $this->_db->query(sprintf($sql, $count, $start));
        $result = $q->result($type);
        return $result;
    }

    function getResumenTotal_01($local = NULL, $type = 'object') {

        $sql = "select * from (
select 1 as orden,'' as cod_sede, 'TOTAL' as sede,count(*) as total_cajas, sum(case WHEN ifnull(estado,0) > 0 then 1 else 0 end) as total_leidas,
sum(case WHEN ifnull(estado,0) = 7 then 1 else 0 end) as total_transf,
sum(case WHEN ifnull(estado,0) = 1 then 1 else 0 end) as total_transf_sin
from T_COBARRA
where prefijo_lado in ('10','99')

UNION
select 2 as orden, cod_sede,sede,count(*) as total_cajas, sum(case WHEN ifnull(estado,0) > 0 then 1 else 0 end) as total_leidas,
sum(case WHEN ifnull(estado,0) = 7 then 1 else 0 end) as total_transf,
sum(case WHEN ifnull(estado,0) = 1 then 1 else 0 end) as total_transf_sin
from T_COBARRA
where prefijo_lado in ('10','99')
group by sede
) T
ORDER BY orden, sede ";
        
        $q = $this->_db->query($sql);
        $result = $q->result($type);
        return $result;
    }
    function getResumenTotal_02($cod_sede = NULL, $type = 'object') {

        $sql = "select * from (

select  1 as orden,'' as COD_LOCAL,'TOTAL' as NOMBRE_LOCAL,count(*) as total_cajas, sum(case WHEN ifnull(estado,0) > 0 then 1 else 0 end) as total_leidas,
sum(case WHEN ifnull(estado,0) = 7 then 1 else 0 end) as total_transf,
sum(case WHEN ifnull(estado,0) = 1 then 1 else 0 end) as total_transf_sin
from T_COBARRA
where cod_sede = '".$cod_sede."' and prefijo_lado in ('10','99')

UNION

select 2 as orden, COD_LOCAL,NOMBRE_LOCAL,count(*) as total_cajas, sum(case WHEN ifnull(estado,0) > 0 then 1 else 0 end) as total_leidas,
sum(case WHEN ifnull(estado,0) = 7 then 1 else 0 end) as total_transf,
sum(case WHEN ifnull(estado,0) = 1 then 1 else 0 end) as total_transf_sin
from T_COBARRA
where cod_sede = '".$cod_sede."' and prefijo_lado in ('10','99')
group by nombre_local
) T
ORDER BY orden, Nombre_local";
        
        $q = $this->_db->query($sql);
        $result = $q->result($type);
        return $result;
    }

    
    
    function limpiar() {
        $sql = 'UPDATE T_COBARRA SET ESTADO = 0, FECHA = NULL,ESCANEO_PAREJA=0';
        $query = $this->_db->query($sql);
    }
    
    
    function getDataEnvioMasivo($event,$mass) {
        $this->_db->select('codigo_barra as llave,codigo_barra,cod_sede,fecha');
        $this->_db->where('estado', '1');        
        if ($mass) {
            $q = $this->_db->get($this->tableName());
        } else {
            $q = $this->_db->get($this->tableName(), 5, 0);
        }
        $result = $q->result('array');
        $q->free_result();
        return $result;
    }
    
    
    function setEstadoEnvioMasivo($data, $key) {
        $this->_db->update_batch($this->tableName(), $data, $key);
    }
    
    
    function getCajasFaltantes($cod_sede, $type = 'object') {                
                
        $sql = "select codigo_barra,sede,nombre_local,orden_caja,case orden_caja when '90' then 'ADICIONAL' 
when '99' then 'CANDADO'
when '98' then 'APLICACION'
end as tipo
from T_COBARRA
where prefijo_lado in ('10','99') and  cod_sede = '".$cod_sede."' and  ifnull(estado,0) <= 0
order by orden_caja ";
        $q = $this->_db->query($sql);
        $result = $q->result($type);
        
        return $result;
    }
    
    function getCajasLocal($cod_local, $type = 'object') {                
                
        $sql = "select codigo_barra,orden_caja,case orden_caja when '90' then 'ADICIONAL' 
when '99' then 'CANDADO'
when '98' then 'APLICACION'
end as tipo, estado
from T_COBARRA
where prefijo_lado in ('10','99') and  cod_local = '".$cod_local."' 
order by tipo ";
        $q = $this->_db->query($sql);
        $result = $q->result($type);
        
        return $result;
    }

}
