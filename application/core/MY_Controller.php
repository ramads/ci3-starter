<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

    protected $data = array();

    public function __construct() {
        parent::__construct();

        $this->load->database();

    }

    /**
     * 
     */
    private function load_layout($view = "", $view_data = [], $layout = "", $return = FALSE) {

        // set view data
        $data = empty($view_data) ? $this->data : $view_data;

        // if not use master layout
        if (empty($layout)) {
            $this->load->view($view, $data, $return);
        } else {
            $content = $this->load->view($view, $data, TRUE);
            $layout_data['content'] = trim($content);

            $this->load->view($layout, $layout_data, $return);
        }
    }

    /*
     * load master layout
     */
    protected function render($view = "", $view_data = "", $return = FALSE, $layout = "layouts/master") {
        $this->load_layout($view, $view_data, $layout, $return);
    }
}
