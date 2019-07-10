<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin extends MY_Controller {


    public function index()
    {
        $content = $this->load->view('admin/login','',true);
        parent::template($content);
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function menu_admin($page)
    {
        if($this->session->userdata('LoginAdmin')==1 || $this->session->userdata('LoginAdmin')=='1'){
            $data['page']=$page;
            $content = $this->load->view('admin/menu_admin',$data,true);
            parent::template($content);
        } else {
            redirect(base_url());
        }


    }

    public function biodata(){

        $data['DataBio'] = $this->db->limit(1)->get('biodata')->result_array();
        $page = $this->load->view('admin/biodata',$data,true);
        $this->menu_admin($page);
    }

    public function pengaturan(){

        $data['DataSeting'] = $this->db->get_where('setting')->result_array();
        $page = $this->load->view('admin/pengaturan',$data,true);
        $this->menu_admin($page);
    }

    public function mastersekolah(){

        $data['DataSeting'] = $this->db->get_where('setting')->result_array();
        $page = $this->load->view('admin/mastersekolah',$data,true);
        $this->menu_admin($page);
    }

    public function guru(){

        $data['dataGuru'] = $this->db->get_where('user',array(
            'Sebagai' => 'guru'
        ))->result_array();
        $page = $this->load->view('admin/guru',$data,true);
        $this->menu_admin($page);
    }

    public function murid(){

        $data['dataMurid'] = $this->db->get_where('user',array(
            'Sebagai' => 'siswa'
        ))->result_array();
        $page = $this->load->view('admin/murid',$data,true);
        $this->menu_admin($page);
    }


}
