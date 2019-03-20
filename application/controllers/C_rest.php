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

    private function getDateTimeNow(){
        return date('Y-m-d H:i:s');
    }

    private function getDateNow(){
        return date('Y-m-d');
    }

    private function getTimeNow(){
        return date('H:i:s');
    }

    public function crudUser(){

        $d = $this->getPost();

        if($d['action']=='insertNewUser'){

            $dataInsert = (array) $d['dataInsert'];
            $dataInsertTemp = (array) $d['dataInsert'];

            $dataInsert['Password'] = md5($dataInsertTemp['Password']);
            $dataInsert['CreatedAt'] = $this->getDateTimeNow();

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


        else if($d['action']=='loadListTest'){
            $data = $this->db->get_where('testing',array(
                'IDUser' => $this->session->userdata('ID')
            ))->result_array();

            return print_r(json_encode($data));
        }

        else if($d['action']=='mulaiTest'){

            // Insert Ke ID Test
            $arrInset = array(
                'IDUser' => $this->session->userdata('ID'),
                'DateTime' => $this->getDateTimeNow()
            );
            $this->db->insert('testing',$arrInset);
            $IDTest = $this->db->insert_id();


            // Get Setting
            $setting = $this->db->get_where('setting',array('IDST'=>1))->result_array();

            $jumlahSoal = $setting[0]['Nilai'];

            // Random Soal
            $dataSoal = $this->db->query('SELECT ID FROM soal ORDER BY RAND() LIMIT '.$jumlahSoal)->result_array();

            // Insert Ke tabel testing details
            if(count($dataSoal)>0){
                for ($i=0;$i<count($dataSoal);$i++){
                    $d = $dataSoal[$i];
                    $arrIn = array(
                        'IDTest' => $IDTest,
                        'IDSoal' => $d['ID']
                    );

                    $this->db->insert('testing_details',$arrIn);
                }
            }

            return print_r(1);

        }
        else if($d['action']=='testOnline'){

            $IDTest = $d['IDTest'];

            $dataIDtest = $this->db->query('SELECT td.*,s.Soal FROM testing_details td 
                                                      LEFT JOIN soal s ON (s.ID = td.IDSoal)
                                                      WHERE td.IDTest = "'.$IDTest.'" ')->result_array();



            $soal = [];
            $arrSudahJawab = [];
            $noActive = 1;
            $totalNo = count($dataIDtest);

            // Get Detail Pilihan Ganda dan Alasan
            if(count($dataIDtest)>0){
                for($i=0;$i<count($dataIDtest);$i++){
                    $dataPG = $this->db->order_by('ID', 'RANDOM')->get_where('soal_pilihan'
                        ,array('IDSoal'=>$dataIDtest[$i]['IDSoal']))->result_array();
                    $dataIDtest[$i]['PilihanGanda'] = $dataPG;

                    $dataAPJ = $this->db->order_by('ID', 'RANDOM')->get_where('soal_alasan'
                        ,array('IDSoal'=>$dataIDtest[$i]['IDSoal']))->result_array();
                    $dataIDtest[$i]['AlasanJawaban'] = $dataAPJ;

                    if($dataIDtest[$i]['Status']==0 || $dataIDtest[$i]['Status']=='0'){
                        $soal = $dataIDtest[$i];
                        break;
                    } else {
                        array_push($arrSudahJawab,$dataIDtest[$i]['ID']);
                    }
                    $noActive+=1;
                }
            }

            $result = array(
                'Soal' => $soal,
                'Terjawab' => $arrSudahJawab,
                'No' => $noActive,
                'Total' => $totalNo
            );

            return print_r(json_encode($result));

            exit;


            $data = $this->db->query('SELECT * FROM soal ORDER BY RAND() LIMIT 1')->result_array();
            $dataPG= [];
            $dataAPJ= [];
            if(count($data)>0){

                $d = $data[0];
                // Get Pilihan Ganda
                $dataPG = $this->db->order_by('ID', 'RANDOM')->get_where('soal_pilihan',array('IDSoal'=>$d['ID']))->result_array();

                $dataAPJ = $this->db->order_by('ID', 'RANDOM')->get_where('soal_alasan',array('IDSoal'=>$d['ID']))->result_array();

            }

            $result = array(
                'Soal' => $data,
                'PilihanGanda' => $dataPG,
                'AlasanJawaban' => $dataAPJ
            );

            return print_r(json_encode($result));

        }
    }

}
