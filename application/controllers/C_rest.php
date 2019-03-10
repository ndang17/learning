<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_rest extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        date_default_timezone_set("Asia/Jakarta");
    }

    private function getPost(){
        $data = $this->input->post('formData');
        return (array) $data;
    }

    public function crudUser(){

        $d = $this->getPost();

        if($d['action']=='insertNewUser'){

            $dataInsert = (array) $d['dataInsert'];
            $dataInsertTemp = (array) $d['dataInsert'];

            $dataInsert['Password'] = md5($dataInsertTemp['Password']);
            $dataInsert['CreatedAt'] = date('Y-m-d H:i:s');

            $this->db->insert('user',$dataInsert);

            return print_r(1);

        } else if ($d['action']=='checkLogin') {
            $Sebagai = $d['Sebagai'];
            $User = $d['User'];
            $Pass = md5($d['Password']);

            $data = $this->db->query('SELECT u.* FROM user u WHERE 
                                                u.Password = "'.$Pass.'" AND
                                                u.Sebagai = "'.$Sebagai.'" AND
                                                (u.Username LIKE "'.$User.'" OR u.Email LIKE "'.$User.'" )
                                                LIMIT 1')
                ->result_array();

            $ret = 0;
            if(count($data)>0){
                $this->session->set_userdata($data[0]);
                $ret = 1;
            }

            return print_r($ret);

        }

    }

    public function crudSoal(){
        $d = $this->getPost();

        if($d['action']=='addSoal'){

            $dataIns = $d['soal'];

            $this->db->insert('soal',$dataIns);
            $insert_id = $this->db->insert_id();

            // insert ke soal_pilihan
            $arrPilihan = $d['arrPilihan'];
            for($i=0;$i<count($arrPilihan);$i++){
                $arrPilihan[$i]['IDSoal'] = $insert_id;
                $this->db->insert('soal_pilihan',$arrPilihan[$i]);
            }


            // insert ke soal_alasan
            $arrAlasan = $d['arrAlasan'];
            for($i=0;$i<count($arrAlasan);$i++){
                $arrAlasan[$i]['IDSoal'] = $insert_id;
                $this->db->insert('soal_alasan',$arrAlasan[$i]);
            }


            return print_r(1);


        }
        else if($d['action']=='readSoal'){

            $dataSoal = $this->db->get_where('soal',array('CreatedBy'=>$d['ID']))->result_array();

            return print_r(json_encode($dataSoal));
        }
        else if($d['action']=='readDetailsSoal'){
            $dataSoal = $this->db->get_where('soal'
                ,array('ID'=>$d['IDSoal']))->result_array();

            // Detail Soal
            $dataPilihan = $this->db->order_by('Urutan ASC')->get_where('soal_pilihan'
                ,array('IDSoal'=>$d['IDSoal']))->result_array();

            // Detail Alasan
            $dataAlasan = $this->db->order_by('Urutan ASC')->get_where('soal_alasan'
                ,array('IDSoal'=>$d['IDSoal']))->result_array();

            $dataSoal[0]['Details'] = $dataPilihan;
            $dataSoal[0]['DetailsAlasan'] = $dataAlasan;

            return print_r(json_encode($dataSoal[0]));

        }
        else if($d['action']=='deleteSoal'){

            $this->db->where('ID', $d['IDSoal']);
            $this->db->delete('soal');
            $this->db->reset_query();

            $this->db->where('IDSoal', $d['IDSoal']);
            $this->db->delete('soal_pilihan');

            return print_r(1);
        }
    }

}
