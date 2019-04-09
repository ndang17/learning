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

    public function loadSoal($IDTest){
        if($this->checkSessions('siswa')){
            $data['IDTest'] = $IDTest;
            $content = $this->load->view('page/soal',$data,true);
            parent::template($content);
        } else {
            $this->index();
        }

    }

    public function loadHasil($IDTest){
        if($this->checkSessions('siswa')){
            $data['IDTest'] = $IDTest;

            // Update Status User Test
            $this->db->set('Status', '1');
            $this->db->where('ID', $IDTest);
            $this->db->update('testing');
            $this->db->reset_query();

            // Get Testing
            $dataT = $this->db->limit(1)->get_where('testing',array('ID'=>$IDTest))->result_array();
            $dataTest = $this->db->get_where('testing',array('Token'=>$dataT[0]['Token']))->result_array();

            // Get hasil
            $dataH = $this->db->query('SELECT td.IDKategori,k.Keterangan, s.Pembahasan, i.Indikator FROM testing_details td 
                                                    LEFT JOIN kategori k ON (k.ID = td.IDKategori)
                                                    LEFT JOIN soal s ON (s.ID = td.IDSoal)
                                                    LEFT JOIN indikator i ON (i.ID = s.IDIndikator)
                                                    WHERE td.IDTest = "'.$IDTest.'"
                                                     ORDER BY td.ID ASC')->result_array();

            $data['dataHasil'] = $dataH;
            $data['dataTest'] = $dataTest;
            $content = $this->load->view('page/hasil',$data,true);
            parent::template($content);
        } else {
            $this->index();
        }

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

    public function buatsoal($IDIndikator,$TypeSoal){
        if($this->checkSessions('guru')){
            $data['header'] = $this->header();
            $data['TypeSoal'] = $TypeSoal;
            $data['IDIndikator'] = $IDIndikator;
            $data['dataIndikator'] = $this->db->get_where('indikator',array('ID'=>$IDIndikator))->result_array();
            $content = $this->load->view('page/buatsoal',$data,true);
            parent::template($content);
        } else {
            $this->index();
        }

    }

    public function editsoal($IDIndikator,$TypeSoal){
        if($this->checkSessions('guru')){
            $data['header'] = $this->header();
            $data['TypeSoal'] = $TypeSoal;
            $data['IDIndikator'] = $IDIndikator;
            $data['dataIndikator'] = $this->db->get_where('indikator',array('ID'=>$IDIndikator))->result_array();

            // Load Soal
            $dataSoal = $this->db->get_where('soal',array(
                'IDIndikator' => $IDIndikator,
                'TypeSoal' => ''.$TypeSoal
            ))->result_array();

            if(count($dataSoal)>0){

                // Load Pilihan jawaban
                $IDSoal = $dataSoal[0]['ID'];
                $dataJawaban = $this->db->get_where('soal_pilihan',array('IDSoal'=>$IDSoal))->result_array();

                $dataAlasan = $this->db->get_where('soal_alasan',array('IDSoal'=>$IDSoal))->result_array();

                $dataSoal[0]['PilihanJawaban'] = $dataJawaban;
                $dataSoal[0]['PilihanAlasan'] = $dataAlasan;

            }

            $data['dataSoal'] = $dataSoal;

            $content = $this->load->view('page/editsoal',$data,true);
            parent::template($content);
        } else {
            $this->index();
        }

    }

    private function header(){
        return $this->load->view('page/header','',true);
    }


    // ====
    public function upload_files(){

        $fileName = $this->input->get('fileName');

        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 8000; // 8 mb
//        $config['file_name']            = $fileName;

//        if(is_file('./uploads/'.$fileName)){
//            unlink('./uploads/'.$fileName);
//        }

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('userfile')){
            $error = array('error' => $this->upload->display_errors());
            return print_r(json_encode($error));
        }
        else {

            $success = array('success' => $this->upload->data());
            $success['success']['formGrade'] = 0;

            return print_r(json_encode($success));
        }



    }


}
