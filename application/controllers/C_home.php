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


    // Log Out
    public function logOut(){
        $this->session->sess_destroy();
        $content = $this->load->view('page/home','',true);
        parent::template($content);
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
            $data['header'] = $this->header();
            $content = $this->load->view('page/siswa',$data,true);
            parent::template($content);
        } else {
            $this->index();
        }
    }

    public function menu_guru($page){
        if($this->checkSessions('guru')){
            $data['header'] = $this->header();
            $data['page'] = $page;
            $content = $this->load->view('page/menu_guru',$data,true);
            parent::template($content);
        } else {
            $this->index();
        }
    }


    public function listSoal(){
        $page = $this->load->view('page/guru_listsoal','',true);
        $this->menu_guru($page);
    }

    public function listSiswa(){
        $page = $this->load->view('page/guru_listsiswa','',true);
        $this->menu_guru($page);
    }

    public function buatsoal(){
        if($this->checkSessions('guru')){
            $data['header'] = $this->header();
            $content = $this->load->view('page/buatsoal',$data,true);
            parent::template($content);
        } else {
            $this->index();
        }

    }

    private function header(){
        return $this->load->view('page/header','',true);
    }


}
