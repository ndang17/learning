<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_home extends MY_Controller {

    private function checkSessions($Sebagai){
        $ID = $this->session->userdata('ID');
        $Ses_Sebagai = $this->session->userdata('Sebagai');
        $res = false;
        if(isset($ID) &&
            $ID!='' &&
            $ID!=null &&
        isset($Ses_Sebagai) &&
            $Ses_Sebagai!='' &&
            $Ses_Sebagai !=null &&
            $Ses_Sebagai == $Sebagai ){

            $res = true;
        }

        return $res;
    }

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

        if($this->checkSessions('siswa')){
            $content = $this->load->view('page/siswa','',true);
            parent::template($content);
        } else {
            $this->index();
        }

    }

    public function guru(){
        if($this->checkSessions('guru')){
            $content = $this->load->view('page/guru','',true);
            parent::template($content);
        } else {
            $this->index();
        }

    }
}
