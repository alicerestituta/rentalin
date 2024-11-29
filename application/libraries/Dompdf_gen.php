<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;

class Dompdf_gen {
    public function __construct() {
        $this->dompdf = new Dompdf();
    }

    public function loadHtml($html) {
        $this->dompdf->loadHtml($html);
    }

    public function setPaper($size, $orientation = 'portrait') {
        $this->dompdf->setPaper($size, $orientation);
    }

    public function render() {
        $this->dompdf->render();
    }

    public function stream($filename, $options = array()) {
        $this->dompdf->stream($filename, $options);
    }
}
