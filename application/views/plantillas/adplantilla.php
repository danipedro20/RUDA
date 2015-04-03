<?php

$this->load->view('plantillas/back_end/back_header');
$this->load->view('plantillas/back_end/back_sidebar');
$this->load->view('back_end/'. $contenido);
$this->load->view('plantillas/back_end/back_footer');

