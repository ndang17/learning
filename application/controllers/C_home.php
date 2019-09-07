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

            // Cek apakah sudah ada hasil atau belum, jika belum maka wajib hitung score
            if($dataT[0]['Score']==null || $dataT[0]['Score']==''){

                // Get jumlah soal
                $dataTotalSoal = $this->db->query('SELECT count(*) AS TotalSoal 
                                                        FROM testing_details
                                                        WHERE IDTest = "'.$dataT[0]['ID'].'" ')->result_array();
                // Get jumlah soal benar
                $dataSoalBenar = $this->db->query('SELECT count(*) AS TotalJawaban
                                                        FROM testing_details
                                                        WHERE IDTest = "'.$dataT[0]['ID'].'" AND IDKategori = 1 ')->result_array();
                $Score = 0.00;
                if($dataSoalBenar[0]['TotalJawaban']>0){

                    $Score_ = ($dataSoalBenar[0]['TotalJawaban'] / $dataTotalSoal[0]['TotalSoal']) * 100;
                    $Score = $Score_;

                }


                // Update Score
                $this->db->set('Score', $Score);
                $this->db->where('ID', $IDTest);
                $this->db->update('testing');
                $this->db->reset_query();

                $dataT[0]['Score'] = $Score;
            }


            $dataTest = $this->db->get_where('testing',array('Token'=>$dataT[0]['Token']))->result_array();

            // Get hasil
            $dataH = $this->db->query('SELECT td.ID AS IDTD, td.IDKategori,k.Keterangan, s.Pembahasan, i.Indikator, s.IDIndikator   
                                                    FROM testing_details td
                                                    LEFT JOIN kategori k ON (k.ID = td.IDKategori)
                                                    LEFT JOIN soal s ON (s.ID = td.IDSoal)
                                                    LEFT JOIN indikator i ON (i.ID = s.IDIndikator)
                                                    WHERE td.IDTest = "'.$IDTest.'"
                                                     ORDER BY td.ID ASC')->result_array();

            if(count($dataH)>0){
                foreach ($dataH AS $ith){
                    if($ith['IDKategori']==null || $ith['IDKategori']==''){
                        $this->db->set('IDKategori', 2);
                        $this->db->where('ID', $ith['IDTD']);
                        $this->db->update('testing_details');
                    }
                }

                $dataH = $this->db->query('SELECT td.ID AS IDTD, td.IDKategori,k.Keterangan, s.Pembahasan, i.Indikator, s.IDIndikator   
                                                    FROM testing_details td
                                                    LEFT JOIN kategori k ON (k.ID = td.IDKategori)
                                                    LEFT JOIN soal s ON (s.ID = td.IDSoal)
                                                    LEFT JOIN indikator i ON (i.ID = s.IDIndikator)
                                                    WHERE td.IDTest = "'.$IDTest.'"
                                                     ORDER BY td.ID ASC')->result_array();
            }

            // Cek button hasil
            $btnHasil = $this->db->get_where('setting',array(
                'IDST' => 3
            ))->result_array();

            $data['dataHasil'] = $dataH;
            $data['dataTest'] = $dataTest;
            $data['dataScore'] = $dataT;
            $data['buttonRemidial'] = ($btnHasil[0]['Nilai']==1 || $btnHasil[0]['Nilai']=='1') ? '1' : '0';
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

    public function listpembahasan($IDIndikator){
        if($this->checkSessions('guru')){
            $data['header'] = $this->header();

            $data['IDIndikator'] = $IDIndikator;
            $data['dataIndikator'] = $this->db->get_where('indikator',array('ID'=>$IDIndikator))->result_array();

            $content = $this->load->view('page/listpembahasan',$data,true);
            parent::template($content);
        } else {
            $this->index();
        }
    }

    public function analisis_1($UserID){
        if($this->checkSessions('guru')){

            // Get soal type 1
            $dataTesting = $this->db->query('SELECT t.*, u.Nama, u.Kelas, s.Name AS Sekolah_Nama 
                                                FROM testing t 
                                                LEFT JOIN user u ON (u.ID = t.IDUser)
                                                LEFT JOIN sekolah s ON (s.ID = u.Sekolah) 
                                                WHERE t.IDUser = "'.$UserID.'" ')
                ->result_array();

//            print_r($dataTesting);
//            exit;

            if(count($dataTesting)>0){

                for($i=0;$i<count($dataTesting);$i++){

                    $d = $dataTesting[$i];

                    $dataTesting[$i]['Soal'] = $this->db->query('SELECT td.*, s.Soal AS Soal_Isi, s.Jawaban AS Soal_Kunci,
                                                    s.JawabanAlasan AS Soal_KunciAlasan, 
                                                    sp.Keterangan AS Soal_Kunci_1, sp1.Keterangan AS Usr_Jawaban,
                                                    sa.Keterangan AS Soal_Alasan_1, sa1.Keterangan AS Usr_Alasan,
                                                    k.Keterangan AS Identifikasi
                                                    FROM testing_details td
                                                    LEFT JOIN soal s ON (s.ID = td.IDSoal)
                                                    LEFT JOIN soal_pilihan sp ON (sp.IDSoal = s.ID 
                                                                                AND sp.Urutan = s.Jawaban)
                                                    LEFT JOIN soal_alasan sa ON (sa.IDSoal = s.ID 
                                                                                AND sa.Urutan = s.JawabanAlasan)
                                                    LEFT JOIN soal_pilihan sp1 ON (sp1.IDSoal = s.ID
                                                                                AND sp1.Urutan = td.Jawaban)
                                                    LEFT JOIN soal_alasan sa1 ON (sa1.IDSoal = s.ID 
                                                                                AND sa1.Urutan = td.Alasan)
                                                    LEFT JOIN kategori k ON (k.ID = td.IDKategori)
                                                    WHERE IDTest = "'.$d['ID'].'" ')->result_array();

                }


            }



            $data['soal'] = $dataTesting;

            $page = $this->load->view('page/guru_analisis_1',$data,true);
            $this->menu_guru($page);
        } else {
            $this->index();
        }
    }

    public function analisis_2(){

        $page = $this->load->view('page/guru_analisis_2','',true);
        $this->menu_guru($page);
        //guru_analisis_2
    }

    public function analisis_3($Type){

        // Get All soal

        $data['dataSoal'] = $this->db->query('SELECT s.* FROM soal s 
                                                    WHERE s.TypeSoal = "'.$Type.'" 
                                                    ORDER BY s.IDIndikator, s.ID ASC')->result_array();

        $page = $this->load->view('page/guru_analisis_3',$data,true);
        $this->menu_guru($page);
        //guru_analisis_2
    }

    public function analisis_4(){

        $data['dataSoal'] = '';

        $page = $this->load->view('page/guru_analisis_4',$data,true);
        $this->menu_guru($page);
    }
    public function analisis_5(){

        $data['dataSoal'] = '';

        $page = $this->load->view('page/guru_analisis_5',$data,true);
        $this->menu_guru($page);
    }
    public function analisis_6(){

        $data['dataSoal'] = '';

        $page = $this->load->view('page/guru_analisis_6',$data,true);
        $this->menu_guru($page);
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


    public function upload_files2(){

        $fileName = $this->input->get('name');
        $id = $this->input->get('id');

        $config['upload_path']          = './uploads/pembahasan/';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 5000; // 5 mb
        $config['file_name']            = $fileName;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('userfile')){
            $error = array('error' => $this->upload->display_errors(),'Status' => 0);

            // Remove DB
            $this->db->where('ID', $id);
            $this->db->delete('pembahasan');

            return print_r(json_encode($error));
        }
        else {

            $success = array('success' => $this->upload->data());
            $success['success']['formGrade'] = 0;

            $this->db->set('File', $fileName);
            $this->db->where('ID', $id);
            $this->db->update('pembahasan');

//            return print_r(json_encode($success));
            return print_r(json_encode(array(
                'Upload' => 'Success','Status' => 1
            )));
        }



    }


}
