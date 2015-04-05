<?php
/* PLANTILLA DATTATBLE DITABLE
 * ESTA PLANTILLA ESTA UBICADA EB C:\xampp\htdocs\Plantillas\DataTableEditable.php *
 * ESTE ARCHIVO NO FUNCIONA SOLO, REQUIERE DE SUS COMPONENETE PREVIOS QUE SON LOS SIGUIENTES *
 * 
 * css/demo_table.css   LE DAFORMA A LA TABLA
 * css/jquery-ui.css    TRABAJA EN CONJUNTO CON JQUERY UI PARA DARLE CIERTO COLOR A LOS COMPONENETE RESULTANTES DE JEQUERY UI
 * 
 * js/jquery.js         LIBRERIA ORIGINAL DE JQUERY
 * js/jquery.dataTables.min.js  LE DA FORMATO Y FUNCIONES A LA TABLA
 * js/jquery-ui-1.8.18.custom.min.js    PROVEE CALENDARIOS,SCROLLBAR Y OTROS COMPONENETES
 * js/jquery.validate.js        VALIDA VALORES INGRESADOS
 * js/jquery.jeditable.js       HACE QUE SE PUEDA EDITAR DESDE JS
 * js/jquery.dataTables.editable.js     HACE QUE SE PUEDA EDITAR DESDE JS EN AYUDA CON jquery.jeditable.js
 */
include('connections/localhost.php');
mysql_select_db($database_localhost, $localhost);
header('Content-type: text/html; charset=iso-8859-1');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <link href="css/jquery.dataTables.css" rel="stylesheet"  type="text/css"/>
        <link href="css/jquery-ui.css" rel="stylesheet"  type="text/css"/>

        <script src="js/jquery.js"></script>
        <script src="js/jquery.dataTables.min_1.js" type="text/javascript"></script>
<!--        <script src="js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>-->
<!--        <script src="js/jquery.validate.js" type="text/javascript"></script>-->
        <script src="js/jquery.jeditable.js" type="text/javascript"></script>
        <script src="js/jquery.dataTables.editable.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
                //DAMOS FORMATO A LA TABLA example Y LA CONVERTIMOS EN PARAMETRO EN oTable
                var oTable = $('#example').dataTable({
                    bJQueryUI: true
                }).makeEditable({
                    /*
                     *LA CONEXION A LA BD SE ENCUENTRA EN  connections/localhost.php
                     *ajax/Mysql.php  UBICACION DL ARCHVO QUE RESIBIRA LOS PARAMETROS A EDITAR EN LA BD
                     *STATEMENT=UPDATE (o DELETE o INSERT)  ES EL TIPO DE QUERY PUEDE SER UPDTE,INSERT, O DELETE (SELECT NOOOO) 
                     *TABLE     ES EL NOMBRE DE LA TABLA
                     *IDNAME    ES EL ID QUE SE VA A ACTUALIZAR O BORRAR (INSERT OVBIO NO LLEVA IDNAME)
                     */
                    sUpdateURL: "ajax/Mysql.php?STATEMENT=UPDATE&TABLE=asistencias&IDNAME=idasistencia",
//                    sDeleteURL: "ajax/Mysql.php?STATEMENT=DELETE&TABLE=catedras&IDNAME=idcatedra",
//                    sAddURL: "ajax/Mysql.php?STATEMENT=INSERT&TABLE=catedras",
                    sDeleteHttpMethod: "GET",
                    sAddHttpMethod: "GET"
                });
                //LLAMAMSO A LOS INPUTS QUE ESTAN EN EL PIE DE LA TABLA
                $("tfoot input").keyup(function() {
                    oTable.fnFilter(this.value, $("tfoot input").index(this));
                });

            });
        </script>
        <title></title>
    </head>
    <body>
        <!-- BOTONES AGREGAR Y BORRAR  -->
        <!--        <button id="btnAddNewRow" class="add_row ui-button-text">Add</button>
                <button id="btnDeleteRow">Delete</button>-->
        <?php
        //LLENAMOS LA BASE DE DATOS

        $sqlSelect = "
       select asistencias.idasistencia, asistencias.asi_estado,catedras.cat_denominacion,usuarios.usu_nombre
        ";
        $sqlFrom = "
        from asistencias inner join catedras on asistencias.idcatedra=catedras.idcatedra
        inner join usuarios on asistencias.idusuario=usuarios.idusuario
        ";
        $sqlWhere = "
        WHERE asistencias.idasistencia > '0'
        ";
        $sqlGroup = "  ";
        //UNIMOS LAS PARETES DE LAS QUERYS
        $sqlQuery = $sqlSelect . $sqlFrom . $sqlWhere . $sqlGroup;
        $table = mysql_query($sqlQuery, $localhost) or die(mysql_error());
        if ($table) {
            ?>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>usu_nombre</th><th>cat_denominacion</th><th>asi_estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //SACAMOS LOS REGISTROS DE LA TABLA
                    while ($row = mysql_fetch_assoc($table)) {
                        ?>
                        <tr id="<?php echo $row["idasistencia"]; ?>">
                            <td><?php echo $row["usu_nombre"]; ?></td>
                            <td><?php echo $row["cat_denominacion"]; ?></td>
                             <td><?php echo $row["asi_estado"]; ?></td>
                        </tr>                
                        <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="text"></th>
                        <th><input type="text"></th>
                        <th><input type="text"></th>
                    </tr>
                </tfoot>                        
            </table>
            <!--        CADA TEXT Y LABEL DEBE DE ESTAR VINCULADO CON CADA COLUMNA DE LA BASE DE DATOS
                    LOS rel="0" DEBEN DE TENER UN ORDEN CONSECUTIVO-->
            <!--            <form id="formAddNewRow" action="#" title="Add new record">        
                            <label for="cat_denominacion">nombre</label><br />
                            <input type="text" name="COLUMN_cat_denominacion" id="cat_denominacion" class="required" rel="2" />
                            <br />
                            <label for="cat_diascatedra">dias</label><br />
                            <input type="text" name="COLUMN_cat_diascatedra" id="cat_diascatedra" rel="3" />
                            <br />
            
                            <br />
                        </form>-->
            <?php
        }
        ?>
    </body>
</html>