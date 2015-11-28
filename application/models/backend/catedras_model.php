<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Catedras_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insecatedra($a) {
        $data = array(
            'cat_denominacion' => $a,
         
        );
        return $this->db->insert('catedras', $data);
    }

    function catedra_check($catedra) {
        $this->db->where('cat_denominacion', $catedra);
        $query = $this->db->get('catedras');

        if ($query->num_rows() > 0) {
            return TRUE;
        }
    }

    public function eliminar_asignacion($a, $b) {
        $this->db->where('idcatedra', $a);
        $this->db->where('idusuario', $b);
        $this->db->delete('usu_cate');
    }

    public function elimicatedra($a) {
          $this->db->where('idcatedra', $a);
        $this->db->delete('catedras');
        if ($this->db->_error_message()) {
            return $data = 'Atencion!!! Nose puede borrar esta Catedra';
        }
    }

    public function edicatedra($a,$d) {
        $data = array(
            'cat_denominacion' => $a,
        
        );

        $this->db->where('idcatedra', $d);
        $this->db->update('catedras', $data);
    }

    public function editar_catedraprofesor($d, $b) {

        $data = array(
            'idusuario' => $d,
        );

        $this->db->where('idcatedra', $b);
        $this->db->update('usu_cate', $data);
    }

    public function lista() {
        $consulta = $this->db->query("select capa.diascatedra,ca.idcatedra,ca.cat_denominacion,usu.idusuario,usu.usu_nombre from catedras as ca join
usu_cate as usca on  usca.idcatedra=ca.idcatedra join usuarios as usu  on usca.idusuario=usu.idusuario
join cate_plan as capa on ca.idcatedra=capa.idcatedra;");
        return $consulta->result();
    }
    
    public function lista_catedras() {
        $consulta = $this->db->query("select * from catedras");
        return $consulta->result();
    }

    public function catedra_profesor($idca, $idusu) {
        $consulta = $this->db->query("select ca.idcatedra,ca.cat_denominacion,usu.idusuario,usu.usu_nombre from catedras as ca join
usu_cate as usca on  usca.idcatedra=ca.idcatedra join usuarios as usu  on usca.idusuario=usu.idusuario where ca.idcatedra='$idca' and usu.idusuario='$idusu'");
        return $consulta->row();
    }
      public function catedra($id) {
        $consulta = $this->db->query("select * from catedras where idcatedra='$id';");
        return $consulta->row();
    }

    public function profesores() {
        $consulta = $this->db->query("select idusuario,usu_nombre from usuarios where idperfil=2;");
        return $consulta->result();
    }

}
