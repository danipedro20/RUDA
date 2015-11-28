<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Backup_control extends CI_Controller {

    //Se crea siempre un constructor al inicial un controlador
    public function __construct() {
        parent::__construct();
    }

    function hacer_backup() {
        $fecha_hora = date("Ymd_His");
        // Carga la clase de utilidades de base de datos
        $this->load->dbutil();
        $prefs = array(
            'tables' => array(), // Arreglo de tablas para respaldar.
            'ignore' => array(), // Lista de tablas para omitir en la copia de seguridad
            'format' => 'txt', // gzip, zip, txt
            'filename' => 'copia_de_seguridad_' . $fecha_hora . '.sql', // Nombre de archivo - NECESARIO SOLO CON ARCHIVOS ZIP
            'add_drop' => TRUE, // Agregar o no la sentencia DROP TABLE al archivo de respaldo
            'add_insert' => TRUE, // Agregar o no datos de INSERT al archivo de respaldo
            'newline' => "\n"               // Caracter de nueva línea usado en el archivo de respaldo
        );

        $this->dbutil->backup($prefs);

// Crea una copia de seguridad de toda la base de datos y la asigna a una variable
        $copia_de_seguridad = "SET FOREIGN_KEY_CHECKS = 0;\n" . $this->dbutil->backup($prefs);
        // Carga el asistente de archivos y escribe el archivo en su servidor
        $this->load->helper('file');
        write_file('./assets/uploads/backups/copia_de_seguridad_' . $fecha_hora . '.txt', $copia_de_seguridad);


// Carga el asistente de descarga y envía el archivo a su escritorio
        $this->load->helper('download');
        force_download('copia_de_seguridad_' . $fecha_hora . '.txt', $copia_de_seguridad);
    }

}
