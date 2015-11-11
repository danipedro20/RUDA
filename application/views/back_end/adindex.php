<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
date_default_timezone_set('America/Asuncion');
?>
<?php if ($this->session->userdata('nombre')) {
    ?>
    <section class="contenido">
        <script src="<?php echo base_url() ?>/assets/noti/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>/assets/noti/miniNotification.js"></script>
        <script>
            $(function() {
                $('#mini-notification').miniNotification({closeButton: true, closeButtonText: '[Cerrar]', time: 2500, effect: 'fade'
                });
            });
        </script>
        <style type="text/css">
            #mini-notification {
                display: none;
                position: fixed;
                cursor: pointer;
                width: 25%;
                background: #f80;
                text-align: center;
                border-top: 2px solid #FFF;
                z-index:9999;
            }
        </style>

        <fieldset>
            <?php
            $z = $this->session->userdata('id');
            $hoy = date('d-m-Y');
            $fechahoy = date("Y-m-d", strtotime($hoy));
            $sql = $this->db->query("select aulas.idaula from aulas join usu_au on
aulas.idaula=usu_au.idaula join usuarios on 
usu_au.idusuario=usuarios.idusuario and usuarios.idusuario='$z'");
            $query = $sql->row();
            $query2 = $this->db->query("select evento,idaula from tcalendario where (fecha='" . $fechahoy . "' and idusuario='" . $z . "' and idaula='" . $query->idaula . "' and prioridad=1)  or ( fecha='" . $fechahoy . "' and prioridad=2 and idaula='" . $query->idaula . "' or ( fecha='" . $fechahoy . "' and idaula= 1 ) )");
            $row = $query2->row();
            if ($query->idaula === 1) {
                $query3 = $db->query("select  distinct ca.evento from 
usuarios as profe join tcalendario as ca on profe.idusuario=ca.idusuario join usu_cate as cate
on profe.idusuario=cate.idusuario join catedras as cat on cate.idcatedra=cat.idcatedra join  cate_plan as capa 
on cat.idcatedra=capa.idcatedra join plan_estudios as pla on capa.idplan=pla.idplan join aulas as au on pla.idplan=au.idplan join usu_au as usuau on
au.idaula=usuau.idaula join usuarios as alum on usuau.idusuario=alum.idusuario where alum.idusuario='" . $z . "' ");
                $sql = $this->db->query("select catedras.idcatedra,aulas.idaula
from aulas as au left join carreras on au.id_carrera=carreras.id_carrera
 join cate_plan on au.idplan=cate_plan.idplan
join catedras on cate_plan.idcatedra=catedras.idcatedra  join usu_au on
usu_au.idaula=au.idaula join aulas on usu_au.idaula=aulas.idaula  where idusuario='$z'");
                $cont1 = 0;
                $cont2 = 0;
                if ($sql->num_rows() > 0 and $query3->num_rows() > 0) {
                    foreach ($query3->result() as $que) {
                        $cont2 = $cont2 + 1;
                    }
                    foreach ($sql->result() as $fila) {
                        $g = $fila->idcatedra;
                        $p = $fila->idaula;
                        $this->db->where('idcatedra', $g)
                                ->where('idaula', $p)
                                ->from('tareas');
                        $query = $this->db->get();

                        if ($query3->num_rows() > 0) {
                            foreach ($query->result() as $que) {
                                if ($que->tar_fechaentrega >= $fechahoy and $que->tar_fechaasignacion <= $fechahoy) {

                                    $cont1 = $cont1 + 1;
                                    ?>

                                    <?php
                                }
                            }
                        }
                    }
                } elseif ($sql->num_rows() == 0 and $query3->num_rows() > 0) {
                    foreach ($query3->result() as $que) {
                        $cont2 = $cont2 + 1;
                    }
                } elseif ($query3->num_rows() == 0 and $sql->num_rows() > 0) {
                    foreach ($sql->result() as $fila) {
                        $g = $fila->idcatedra;
                        $p = $fila->idaula;
                        $this->db->where('idcatedra', $g)
                                ->where('idaula', $p)
                                ->from('tareas');
                        $query = $this->db->get();

                        if ($query->num_rows() > 0) {
                            foreach ($query->result() as $que) {
                                if ($que->tar_fechaentrega >= $fechahoy and $que->tar_fechaasignacion <= $fechahoy) {

                                    $cont1 = $cont1 + 1;
                                    ?>

                                    <?php
                                }
                            }
                        }
                    }
                }
            } else
                $sql = $this->db->query("select catedras.idcatedra,aulas.idaula
from aulas as au left join carreras on au.id_carrera=carreras.id_carrera
 join cate_plan on au.idplan=cate_plan.idplan
join catedras on cate_plan.idcatedra=catedras.idcatedra  join usu_au on
usu_au.idaula=au.idaula join aulas on usu_au.idaula=aulas.idaula  where idusuario='$z'");
            $cont1 = 0;
            $cont2 = 0;
            if ($sql->num_rows() > 0 and $query2->num_rows() > 0) {
                foreach ($query2->result() as $que) {
                    $cont2 = $cont2 + 1;
                }
                foreach ($sql->result() as $fila) {
                    $g = $fila->idcatedra;
                    $p = $fila->idaula;
                    $this->db->where('idcatedra', $g)
                            ->where('idaula', $p)
                            ->from('tareas');
                    $query = $this->db->get();

                    if ($query2->num_rows() > 0) {
                        foreach ($query->result() as $que) {
                            if ($que->tar_fechaentrega >= $fechahoy and $que->tar_fechaasignacion <= $fechahoy) {

                                $cont1 = $cont1 + 1;
                                ?>

                                <?php
                            }
                        }
                    }
                }
            } elseif ($sql->num_rows() == 0 and $query2->num_rows() > 0) {
                foreach ($query2->result() as $que) {
                    $cont2 = $cont2 + 1;
                }
            } elseif ($query2->num_rows() == 0 and $sql->num_rows() > 0) {
                foreach ($sql->result() as $fila) {
                    $g = $fila->idcatedra;
                    $p = $fila->idaula;
                    $this->db->where('idcatedra', $g)
                            ->where('idaula', $p)
                            ->from('tareas');
                    $query = $this->db->get();

                    if ($query->num_rows() > 0) {
                        foreach ($query->result() as $que) {
                            if ($que->tar_fechaentrega >= $fechahoy and $que->tar_fechaasignacion <= $fechahoy) {

                                $cont1 = $cont1 + 1;
                                ?>

                                <?php
                            }
                        }
                    }
                }
            }
            ?>
            <h1> Sección en Construcción </h1>
            <h3 ALIGN = CENTER > Bienvenido:  <?php echo $this->session->userdata('nombre'); ?> </h3>
            <h3 ALIGN = CENTER > Perfil:  <?php echo $this->session->userdata('perfil'); ?> </h3>
            <h3 ALIGN = CENTER > id:  <?php echo $z; ?> </h3>

            <?php
            if ($cont1 > 0 and $cont2 > 0) {
                ?>
                <div id="mini-notification">


                    <p><?php echo 'Tienes' . "" . $cont1 . " " . 'tarea/as y ' . "" . $cont2 . " " . 'actividad/es en tu agenda ' ?></p>

                </div>
                <?php
            } elseif ($cont1 == 0 and $cont2 > 0) {
                ?>
                <div id="mini-notification">


                    <p><?php echo 'Tienes ' . "" . $cont2 . " " . 'actividad/es en tu agenda ' ?></p>

                </div>
                <?php
            } elseif ($cont1 > 0 and $cont2 == 0) {
                ?>
                <div id="mini-notification">

////
                    <p><?php echo 'Tienes ' . "" . $cont1 . " " . ' tarea/s pediente/s' ?></p>

                </div>
                <?php
            }
            ?>





        </fieldset>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>



