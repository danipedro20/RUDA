<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Catedras_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insecatedra($a, $b) {
        $data = array(
            'cat_denominacion' => $a,
            'cat_diascatedra' => $b,
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
        $tablas = array('usu_cate', 'tareas', 'cate_plan', 'catedra');
        $this->db->where('idcatedra', $a);
        $this->db->delete($tablas);
    }

    public function edicatedra($a, $c, $d) {
        $data = array(
            'cat_denominacion' => $a,
            'cat_diascatedra' => $c,
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
        $consulta = $this->db->query("select ca.idcatedra,ca.cat_denominacion,ca.cat_diascatedra,usu.idusuario,usu.usu_nombre from catedras as ca join
usu_cate as usca on  usca.idcatedra=ca.idcatedra join usuarios as usu  on usca.idusuario=usu.idusuario;");
        return $consulta->result();
    }
    
    public function lista_catedras() {
        $consulta = $this->db->query("select * from catedras;");
        return $consulta->result();
    }

    public function catedra_profesor($idca, $idusu) {
        $consulta = $this->db->query("select ca.idcatedra,ca.cat_denominacion,ca.cat_diascatedra,usu.idusuario,usu.usu_nombre from catedras as ca join
usu_cate as usca on  usca.idcatedra=ca.idcatedra join usuarios as usu  on usca.idusuario=usu.idusuario where ca.idcatedra='$idca' and usu.idusuario='$idusu'");
        return $consulta->row();
    }
      public function catedra($id) {
        $consulta = $this->db->query("select *from catedras where idcatedra='$id';");
        return $consulta->row();
    }

    public function profesores() {
        $consulta = $this->db->query("select idusuario,usu_nombre from usuarios where idperfil=2;");
        return $consulta->result();
    }

}
