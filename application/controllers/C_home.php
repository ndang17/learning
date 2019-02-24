<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_home extends MY_Controller {

    public function index()
    {
        $content = $this->load->view('page/home','',true);
        parent::template($content);
    }
}
