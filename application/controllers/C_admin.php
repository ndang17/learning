<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin extends MY_Controller {

//    function __construct()
//    {
//        if($this->session->userdata('')){
//
//        } else {
//            redirect(base_url());
//        }
//    }


    public function index()
    {
        $content = $this->load->view('admin/login','',true);
        parent::template($content);
    }

    public function menu_admin($page)
    {
        $data['page']=$page;
        $content = $this->load->view('admin/menu_admin',$data,true);
        parent::template($content);
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

        $page = $this->load->view('admin/guru','',true);
        $this->menu_admin($page);
    }

    public function murid(){

        $page = $this->load->view('admin/murid','',true);
        $this->menu_admin($page);
    }


}
