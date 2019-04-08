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
        else if($d['action']=='updateSoal'){


            $IDSoal = $d['IDSoal'];
            $dataIns = $d['soal'];

            $this->db->set($dataIns);
            $this->db->where('ID', $IDSoal);
            $this->db->update('soal');
            $this->db->reset_query();


            // Remove data pilihan ganda dan alasan
            $tables = array('soal_alasan', 'soal_pilihan');
            $this->db->where('IDSoal', $IDSoal);
            $this->db->delete($tables);
            $this->db->reset_query();

            // insert ke soal_pilihan
            $insert_id = $IDSoal;
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
//            $dataSoal = $this->db->query('SELECT ID FROM soal ORDER BY RAND() LIMIT '.$jumlahSoal)->result_array();
            $dataSoal = $this->db->query('SELECT ID FROM soal ORDER BY IDIndikator ASC LIMIT '.$jumlahSoal)->result_array();

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

            return print_r(json_encode(array('IDTest'=>$IDTest)));

        }
        else if($d['action']=='testOnline'){

            $IDTest = $d['IDTest'];

            $dataIDtest = $this->db->query('SELECT td.*,s.Soal FROM testing_details td 
                                                      LEFT JOIN soal s ON (s.ID = td.IDSoal)
                                                      WHERE td.IDTest = "'.$IDTest.'" ')->result_array();

            $soal = 0;
            if(count($dataIDtest)>0){
                for($i=0;$i<count($dataIDtest);$i++){
                    if($dataIDtest[$i]['Status']==0 || $dataIDtest[$i]['Status']=='0'){
                        $soal = $dataIDtest[$i]['ID'];
                        break;
                    }
                }
            }

            return print_r(json_encode($soal));


        }
        else if($d['action']=='getJumpSoalOnline'){

            $IDTest = $d['IDTest'];
            $IDTD = $d['IDTD'];

            // Load Soal

            $dataSoal = $this->db->query('SELECT td.*,s.Soal, s.Jawaban AS Kunci_Jawaban, 
                                                       s.JawabanAlasan AS Kunci_JawabanAlasan
                                                        FROM testing_details td 
                                                      LEFT JOIN soal s ON (s.ID = td.IDSoal)
                                                      WHERE td.ID = "'.$IDTD.'"  
                                                      LIMIT 1')->result_array();


            if(count($dataSoal)>0){
                $IDSoal = $dataSoal[0]['IDSoal'];
                $dataPG = $this->db->order_by('ID', 'RANDOM')->get_where('soal_pilihan'
                    ,array('IDSoal'=>$IDSoal))->result_array();
                $dataSoal[0]['PilihanGanda'] = $dataPG;

                $dataAPJ = $this->db->order_by('ID', 'RANDOM')->get_where('soal_alasan'
                    ,array('IDSoal'=>$IDSoal))->result_array();
                $dataSoal[0]['AlasanJawaban'] = $dataAPJ;
            }


            $dataIDtest = $this->db->query('SELECT td.*,s.Soal 
                                                       FROM testing_details td
                                                      LEFT JOIN soal s ON (s.ID = td.IDSoal)
                                                      WHERE td.IDTest = "'.$IDTest.'" ')->result_array();


            $arrSudahJawab = [];
            $noActive = 1;
            $totalNo = count($dataIDtest);

            $IDSoalNext = 0;

            // Get Detail Pilihan Ganda dan Alasan
            if(count($dataIDtest)>0){
                for($i=0;$i<count($dataIDtest);$i++){
                    $IDSoalNext = $dataIDtest[$i]['ID'];
                    if($dataIDtest[$i]['Status']==1 || $dataIDtest[$i]['Status']=='1'){
                        array_push($arrSudahJawab,$dataIDtest[$i]['ID']);
                    } else if($dataIDtest[$i]['Status']==0 || $dataIDtest[$i]['Status']=='0'){
                        break;
                    }

                }

                for($i=0;$i<count($dataIDtest);$i++){
                    if($dataIDtest[$i]['ID']==$IDTD){
                        break;
                    }
                    $noActive+=1;
                }
            }

            $result = array(
                'Soal' => $dataSoal[0],
                'Terjawab' => $arrSudahJawab,
                'No' => $noActive,
                'Total' => $totalNo,
                'IDActive' => $IDTD,
                'IDNext' => $IDSoalNext

            );

            return print_r(json_encode($result));
        }
        else if($d['action']=='getHasilKombinasi'){

            $Jawaban = $d['Jawaban'];
            $RatingJawaban = $d['RatingJawaban'];
            $Alasan = $d['Alasan'];
            $RatingAlasan = $d['RatingAlasan'];

            $data = $this->db->query('SELECT kat.*, k.ID AS IDKombinasi FROM kombinasi k 
                                              LEFT JOIN kategori kat ON (k.IDKategori = kat.ID)
                                              WHERE k.Jawaban LIKE "'.$Jawaban.'" 
                                              AND k.RatingJawaban LIKE "'.$RatingJawaban.'" 
                                              AND k.Alasan LIKE "'.$Alasan.'" 
                                              AND k.RatingAlasan LIKE "'.$RatingAlasan.'"')->result_array();


            // Update
            $IDTD = $d['IDTD'];
            $dataUpdate = $d['dataUpdate'];

            $dataUpdate['IDKategori'] = $data[0]['ID'];
            $dataUpdate['IDKombinasi'] = $data[0]['IDKombinasi'];

            $this->db->where('ID', $IDTD);
            $this->db->update('testing_details',$dataUpdate);


            $IDTest = $d['IDTest'];

            $dataIDtest = $this->db->query('SELECT td.*,s.Soal 
                                                       FROM testing_details td
                                                      LEFT JOIN soal s ON (s.ID = td.IDSoal)
                                                      WHERE td.IDTest = "'.$IDTest.'" ')->result_array();
            $IDSoalNext = 0;
            if(count($dataIDtest)>0){
                for ($i=0;$i<count($dataIDtest);$i++){
                    $IDSoalNext = $dataIDtest[$i]['ID'];
                    if($dataIDtest[$i]['Status']==0 || $dataIDtest[$i]['Status']=='0'){
                        break;
                    }
                }
            }

            return print_r(json_encode($IDSoalNext));

        }


        else if($d['action']=='listIndikator'){

            $CreatedBy = $d['ID'];

            $data = $this->db->order_by('ID','DESC')->get_where('indikator',array('CreatedBy'=>$CreatedBy))->result_array();

            if(count($data)>0){
                for ($i=0;$i<count($data);$i++){
                    $data[$i]['Soal1'] = $this->db->get_where('soal',
                        array('IDIndikator'=>$data[$i]['ID'], 'TypeSoal' => '1'))->result_array();
                    $data[$i]['Soal2'] = $this->db->get_where('soal',
                        array('IDIndikator'=>$data[$i]['ID'], 'TypeSoal' => '2'))->result_array();
                }
            }

            return print_r(json_encode($data));

        }
        else if($d['action']=='crudIndikator'){

            // Cek apakah insert atau update

            $ID = $d['ID'];

            if($ID!=''){
                $this->db->set('Indikator', $d['Indikator']);
                $this->db->where('ID', $ID);
                $this->db->update('indikator');

            } else {

                $dataIns = array(
                    'Indikator' => $d['Indikator'],
                    'CreatedBy' => $d['CreatedBy']
                );

                $this->db->insert('indikator',$dataIns);
            }

            return print_r(1);

        }
        else if($d['action']=='removeIndikator'){
            $ID = $d['ID'];

            $dataSoal = $this->db->select('ID')->get_where('soal',array(
                'IDIndikator' => $ID
            ))->result_array();

            if(count($dataSoal)>0){
                $IDSoal = $dataSoal[0]['ID'];

                // Hapus detail soal
                $tables = array('soal_pilihan', 'soal_alasan');
                $this->db->where('IDSoal', $IDSoal);
                $this->db->delete($tables);
                $this->db->reset_query();
            }


            // Hapus soal
            $this->db->where('IDIndikator', $ID);
            $this->db->delete('soal');
            $this->db->reset_query();

            $this->db->where('ID', $ID);
            $this->db->delete('indikator');
            $this->db->reset_query();

            return print_r(1);

        }
    }

}
