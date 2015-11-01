<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asigcatedras_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function selprofe() {
        $query = $this->db->query("SELECT idusuario,usu_nombre FROM usuarios where idperfil='2';");
        return $query->result();
    }

    public function selcate() {
        $query = $this->db->query('SELECT idcatedra,cat_denominacion FROM catedras');
        return $query->result();
    }

    public function verlascatedras($id) {
        $query = $this->db->query("select usu.idcatedra,usu.cat_denominacion from usu_cate as cate right join catedras as usu on
usu.idcatedra=cate.idcatedra where cate.idusuario is NULL;");

        return $query->result();
    }

    public function lista() {
        $query = $this->db->query("select ca.cat_denominacion,usu.usu_nombre from catedras as ca join usu_cate as usca
on ca.idcatedra=usca.idcatedra join usuarios as usu on usca.idusuario=usu.idusuario
where usu.idperfil='2';");
        return $query->result();
    }

    public function inserasignacion($a, $b) {

        $data = array(
            'idusuario' => $a,
            'idcatedra' => $b,
        );
        return $this->db->insert('usu_cate', $data);
    }

    public function ediasigcatedra($a, $b, $c) {

        $data = array(
            'idcatedra' => $c,
        );

        $this->db->where('idcatedra', $b);
        $this->db->where('idusuario', $a);
        $this->db->update('usu_cate', $data);
    }

    public function elimiasigcatedra($a, $b) {

        $this->db->where('idcatedra', $b);
        $this->db->where('idusuario', $a);
        $this->db->delete('usu_cate');
    }

}
