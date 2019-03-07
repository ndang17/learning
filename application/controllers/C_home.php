<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_home extends MY_Controller {

    public function index()
    {
        $content = $this->load->view('page/home','',true);
        parent::template($content);
    }

    public function loadSoal(){
        $content = $this->load->view('page/soal','',true);
        parent::template($content);
    }

    public function siswa(){
        $content = $this->load->view('page/siswa','',true);
        parent::template($content);
    }

    public function guru(){
        $content = $this->load->view('page/guru','',true);
        parent::template($content);
    }
}
