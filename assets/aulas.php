<?php

$a = $this->session->userdata('id');

$query = $this->db->query("select catedras.idcatedra,catedras.cat_denominacion
from catedras  
join cate_plan on catedras.idcatedra=cate_plan.idcatedra
join plan_estudios on cate_plan.idplan=plan_estudios.idplan join aulas on plan_estudios.idplan=aulas.idplan join usu_cate on catedras.idcatedra=usu_cate.idcatedra join
usuarios on usu_cate.idusuario=usuarios.idusuario
 where  usuarios.idusuario='$a';");
 echo json_decode($query);
