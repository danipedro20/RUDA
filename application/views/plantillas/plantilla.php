<?php

$this->load->view('plantillas/front_end/header');

// $this->load->view('plantillas/front_end/sidebar');

$this->load->view('plantillas/front_end/sidebar');
$this->load->view('front_end/'. $contenido);
$this->load->view('plantillas/front_end/footer');
