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

    public function selectOption(){
        $d = $this->getPost();

        if($d['action']=='SO_sekolah'){
            $data = $this->db->order_by('Name','ASC')->get('sekolah')->result_array();

            return print_r(json_encode($data));
        }
        else if($d['action']=='SO_gelombang'){
            $data = $this->db->order_by('ID','ASC')->get('setting_gelombang')->result_array();
            return print_r(json_encode($data));
        }
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

        }
        else if ($d['action']=='checkLogin') {
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
//            $data = $this->db->get_where('testing',array(
//                'IDUser' => $this->session->userdata('ID')
//            ))->result_array();

            $data = $this->db->query('SELECT Token, DateTime FROM testing WHERE 
                                              IDUser = "'.$this->session->userdata('ID').'" 
                                              GROUP BY Token
                                              ORDER BY ID ASC
                                               ')->result_array();

            if(count($data)>0){
                for($i=0;$i<count($data);$i++){
                    $dataDetail = $this->db->query('SELECT t.*, tm.Time FROM testing t 
                                                            LEFT JOIN timer tm ON (t.ID = tm.IDTest)
                                                            WHERE t.Token = "'.$data[$i]['Token'].'" 
                                                            ORDER BY t.ID ASC')->result_array();

                    $data[$i]['Details'] = $dataDetail;

                }
            }

            return print_r(json_encode($data));
        }

        else if($d['action']=='mulaiTest'){

            // Insert Ke ID Test
            $arrInset = array(
                'IDUser' => $this->session->userdata('ID'),
                'DateTime' => $this->getDateTimeNow(),
                'Token' => md5($d['Token'].'_'.$this->session->userdata('ID'))
            );
            $this->db->insert('testing',$arrInset);
            $IDTest = $this->db->insert_id();

            // Inserting ke timer
            $startTime = '00:00:00';
            $settingTime = $this->db->get_where('setting',array('IDST'=>2))->result_array();
            $cenvertedTime = date('H:i:s',strtotime('+'.$settingTime[0]['Nilai'].' minutes',strtotime($startTime)));

            $insTm = array(
                'IDTest' => $IDTest,
                'Time' => $cenvertedTime
            );

            $this->db->insert('timer',$insTm);



            // Get Setting
            $setting = $this->db->get_where('setting_gelombang',array('Status'=>'1'))->result_array();

            $jumlahSoal = $setting[0]['Nilai'];

            // Random Soal
            $dataSoal = $this->db->query('SELECT ID FROM soal WHERE TypeSoal = "1" ORDER BY IDIndikator ASC LIMIT '.$jumlahSoal)->result_array();

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

        else if($d['action']=='mulaiTest2'){

            $IDTestLama = $d['ID'];

            // Get ID Soal yang IDKategorinya selain 1
            $dataS = $this->db->get_where('testing_details',
                array('IDTest' => $IDTestLama, 'IDKategori !=' => '1'))->result_array();

            if(count($dataS)>0){

                // Insert Ke ID Test
                $arrInset = array(
                    'IDUser' => $this->session->userdata('ID'),
                    'DateTime' => $this->getDateTimeNow(),
                    'Token' => $d['Token'],
                    'Type' => '2'
                );
                $this->db->insert('testing',$arrInset);
                $IDTest = $this->db->insert_id();

                $startTime = '00:00:00';
                $settingTime = $this->db->get_where('setting',array('IDST'=>2))->result_array();
                $cenvertedTime = date('H:i:s',strtotime('+'.$settingTime[0]['Nilai'].' minutes',strtotime($startTime)));

                $insTm = array(
                    'IDTest' => $IDTest,
                    'Time' => $cenvertedTime
                );

                $this->db->insert('timer',$insTm);


                foreach ($dataS AS $item){

                    // Get data soal
                    $dataSoal = $this->db->get_where('soal',array(
                        'ID' => $item['IDSoal']
                    ))->result_array();

                    $IDIndikator = $dataSoal[0]['IDIndikator'];

                    // Select Soal 2
                    $dataSoal2 = $this->db->get_where('soal',array(
                        'IDIndikator' => $IDIndikator,
                        'TypeSoal' => '2'
                    ))->result_array();


                    $newAr = array(
                        'IDTest' => $IDTest,
                        'IDSoal' => $item['IDSoal']
                    );

                    if(count($dataSoal2)>0){
                        $newAr['IDSoal'] = $dataSoal2[0]['ID'];
                    }

                    $this->db->insert('testing_details',$newAr);
                }

                return print_r(json_encode(array('IDTest' => $IDTest)));
            } else {
                return print_r(json_encode(array('IDTest' => 0)));
            }



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

            //Load All ID
            $ArrAllID = [];
            $dataIDAll = $this->db->select('ID')->order_by('ID','ASC')->get_where('testing_details',array('IDTest' => $IDTest))->result_array();
            if(count($dataIDAll)>0){
                foreach ($dataIDAll AS $item){
                   array_push($ArrAllID,$item['ID']);
                }
            }

            $result = array(
                'Soal' => $dataSoal[0],
                'Terjawab' => $arrSudahJawab,
                'No' => $noActive,
                'Total' => $totalNo,
                'IDActive' => $IDTD,
                'IDNext' => $IDSoalNext,
                'AllIDTD' => $ArrAllID

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

    public function crudPembahasan(){
        $d = $this->getPost();

        if($d['action']=='insertPembahasan'){

            $dataInsert = (array) $d['dataInsert'];

            $this->db->insert('pembahasan', $dataInsert);
            $insert_id = $this->db->insert_id();

            return print_r(json_encode(
                array('insert_id' => $insert_id)
            ));

        }
        else if($d['action']=='showPembahasan'){

            $data = $this->db->get_where('pembahasan'
                ,array('IDIndikator'=>$d['IDIndikator']))->result_array();

            return print_r(json_encode($data));

        }
        else if($d['action']=='removePembahasan'){

            if($d['Type']=='1' || $d['Type']==1 || $d['Type']=='3'
                || $d['Type']==3){
                $this->db->where('ID', $d['ID']);
                $this->db->delete('pembahasan');

                return print_r(1);
            }
            else {
                $data = $this->db->get_where('pembahasan'
                    ,array('ID'=>$d['ID']))->result_array();
            }

        }
        else if($d['action']=='seePembahasan'){

            // Type pembahasan
            $dataPembahasanType = $this->db->get('pembahasan_type')->result_array();

            for($i=0;$i<count($dataPembahasanType);$i++){

                $dataPembahasan = $this->db->query('SELECT p.* FROM pembahasan p 
                                                        WHERE p.IDIndikator = "'.$d['IDIndikator'].'" 
                                                        AND p.Type = "'.$dataPembahasanType[$i]['ID'].'" ')
                    ->result_array();

                $dataPembahasanType[$i]['Pembahasan'] = $dataPembahasan;
            }



            return print_r(json_encode($dataPembahasanType));

        }

    }

    public function crudMenuAdmin(){
        $d = $this->getPost();

        if($d['action']=='biodata'){
            // Cek apakah sudah ada atau blm
            $dataBio = $this->db->limit(1)->get('biodata')->result_array();

            if(count($dataBio)>0){
                $this->db->set('Biodata', $d['Biodata']);
                $this->db->where('ID', $dataBio[0]['ID']);
                $this->db->update('biodata');
            } else {
                $this->db->insert('biodata', array('Biodata'=>$d['Biodata']));
            }

            return print_r(1);
        }
        else if($d['action']=='readBiodata'){
            $data = $this->db->limit(1)->get('biodata')->result_array();

            return print_r(json_encode($data));
        }
        else if($d['action']=='loginAdmin'){
            $Username = $d['Username'];
            $Password = md5($d['Password']);

            $check = $this->db->get_where('admin',array(
                'Username' => $Username,
                'Password' => $Password
            ))->result_array();

            if(count($check)>0){

                // Set Sessions
                $check[0]['LoginAdmin'] = true;
                $this->session->set_userdata($check[0]);

                $result = array(
                    'Status' => 1
                );
            } else {
                $result = array(
                    'Status' => 0
                );
            }

            return print_r(json_encode($result));

        }
        else if($d['action']=='setting'){
            // Waktu
            // Soal

            $this->db->set('Nilai', $d['Soal']);
            $this->db->where('ID', 1);
            $this->db->update('setting');
            $this->db->reset_query();

            $this->db->set('Nilai', $d['Waktu']);
            $this->db->where('ID', 2);
            $this->db->update('setting');
            $this->db->reset_query();

            $this->db->set('Nilai', $d['Btn']);
            $this->db->where('ID', 3);
            $this->db->update('setting');
            $this->db->reset_query();

            return print_r(1);
        }
        else if($d['action']=='readSekolah'){

            $data = $this->db->order_by('Name', 'ASC')
                ->get('sekolah')->result_array();

            return print_r(json_encode($data));

        }
        else if($d['action']=='showStudentBySekolah'){

            $SekolahID = $d['SekolahID'];

            $w_sekolah = ($SekolahID=='all') ? '' : ' AND u.Sekolah = "'.$SekolahID.'" ';
            $dataScho = $this->db->query('SELECT u.*, s.Name AS Sekolah_Nama, s.Alamat AS Sekolah_Alamat FROM user u 
                                                LEFT JOIN sekolah s ON (s.ID = u.Sekolah)
                                                WHERE u.Sebagai = "siswa" '.$w_sekolah.' ORDER BY u.ID ASC ')
                ->result_array();

            return print_r(json_encode($dataScho));

        }
        else if($d['action']=='addDataSekolah'){

            $dataInsert = (array) $d['dataInsert'];

            $this->db->insert('sekolah',$dataInsert);

            return print_r(1);

        }
        else if($d['action']=='delDataSekolah'){

            $this->db->where('ID', $d['ID']);
            $this->db->delete('sekolah');
            $this->db->reset_query();

            return print_r(1);

        }
        else if($d['action']=='gelombangRead'){
            $data = $this->db->get('setting_gelombang')->result_array();
            return print_r(json_encode($data));
        }
        else if($d['action']=='gelombangUpdate'){
            $formD = (array) $d['formD'];
            $this->db->where('ID', $d['ID']);
            $this->db->update('setting_gelombang',$formD);

            return print_r(1);
        }
        else if($d['action']=='gelombangInsert'){
            $formD = (array) $d['formD'];
            $this->db->insert('setting_gelombang',$formD);
            return print_r(1);
        }
        else if($d['action']=='updateNewPassword'){
            $ID = $d['ID'];
            $Password = md5($d['Password']);

            $this->db->set('Password', $Password);
            $this->db->where('ID', $ID);
            $this->db->update('user');

            return print_r(1);



        }
        else if($d['action']=='removeStudent'){

            $ID = $d['ID'];

            //Get User ID
            $dataTest = $this->db->get_where('testing',array(
                'IDUser' => $ID
            ))->result_array();

            if(count($dataTest)>0){
                foreach ($dataTest AS $item){
                    $this->db->where('IDTest', $item['ID']);
                    $this->db->delete('testing_details');
                    $this->db->reset_query();

                }


                $this->db->where('IDUser', $ID);
                $this->db->delete('testing');
                $this->db->reset_query();
            }

            $this->db->where('ID', $ID);
            $this->db->delete('user');
            $this->db->reset_query();

            return print_r(1);

        }
        else if($d['action']=='removeGuru'){
            $ID = $d['ID'];

            $dataSoal = $this->db->get_where('soal',array(
                'CreatedBy' => $ID
            ))->result_array();

            if(count($dataSoal)>0){

                foreach ($dataSoal AS $item){
                    $this->db->where('IDSoal', $item['ID']);
                    $this->db->delete(array(
                        'soal_alasan' , 'soal_pilihan', 'testing_details'
                    ));
                    $this->db->reset_query();
                }

            }

            $this->db->where('CreatedBy', $ID);
            $this->db->delete(array('soal','indikator'));
            $this->db->reset_query();

            $this->db->where('ID', $ID);
            $this->db->delete('user');
            $this->db->reset_query();

            return print_r(1);

        }

    }

    public function crudTimer(){

        $d = $this->getPost();

        if($d['action']=='updateTimer'){
            // Cek apakah sudah ada IDnya
            // jika ada maka update
            // jika tidak maka insert

            $IDTest = $d['IDTest'];
            $Time = $d['Time'];

            $dataTime = $this->db->get_where('timer',array(
                'IDTest' => $IDTest
            ))->result_array();

            if(count($dataTime)>0){
                // Update

                $arrUpdt = array(
                    'Time' => $Time
                );

                if($Time=='00:00:00'){
                    $arrUpdt['Status'] = '1';
                }

                $this->db->where('IDTest', $IDTest);
                $this->db->update('timer',$arrUpdt);

            } else {
                // Insert
                $dataIns = array(
                    'IDTest' => $IDTest,
                    'Time' => $Time
                );
                $this->db->insert('timer',$dataIns);
            }
        } else if ($d['action']=='getTimerNow') {

            $data = $this->db->get_where('timer',array(
                'IDTest' => $d['IDTest']
            ))->result_array();

            $tm = ($data[0]['Status']=='0' || $data[0]['Status']==0)
                ? $data[0]['Time'] : '00:00:00';
            $result = array('EndSessions'=>$tm);

            return print_r(json_encode($result));

        }



    }

    public function getAnalisis2($IDSekolah){

        $data = $this->db->query('SELECT * FROM user u 
                                            WHERE u.Sebagai = "siswa" AND u.Sekolah = "'.$IDSekolah.'" ')->result_array();

        if(count($data)>0){
            for($i=0;$i<count($data);$i++){
                $d = $data[$i];

                // Cek berapa kali tes
                $dataTest = $this->db->query('SELECT * FROM  testing t
                                                        WHERE t.IDUser = "'.$d['ID'].'" AND t.Status = "1" ')->result_array();

                if(count($dataTest)>0){
                    for ($t=0;$t<count($dataTest);$t++){
                        $dataTest[$t]['Detail'] = $this->db->query('SELECT * FROM testing_details td 
                                                                            WHERE td.IDTest = "'.$dataTest[$t]['ID'].'" ')
                                                                ->result_array();
                    }
                }

                $data[$i]['Test'] = $dataTest;


            }
        }

        return print_r(json_encode($data));

    }

    public function getAnalisis3($IDSoal){

        // Get All soal
//        $dataSoal = $this->db->select('IDKategori')->get_where('testing_details',array(
//            'IDSoal' => $IDSoal
//        ))->result_array();

        $dataSoal = $this->db->query('SELECT td.IDKategori FROM testing_details td 
                                                LEFT JOIN testing t ON (t.ID = td.IDTest)
                                                WHERE td.IDSoal = "'.$IDSoal.'" AND t.Status = "1" ')->result_array();

        // ID kategori : 1 = Paham, 2 = Tidak Paham, 3 = Miskonsepsi
        $result = array(
            'P' => 0,
            'TP' => 0,
            'M' => 0
        );

        if(count($dataSoal)>0){
            $totalP = count($dataSoal);
            $T_P = 0;
            $T_TP = 0;
            $T_M = 0;
            foreach ($dataSoal AS $item){

                if($item['IDKategori']=='1' || $item['IDKategori']==1){
                    $T_P = $T_P+1;
                } else if($item['IDKategori']=='2' || $item['IDKategori']==2){
                    $T_TP = $T_TP+1;
                } else if($item['IDKategori']=='3' || $item['IDKategori']==3){
                    $T_M = $T_M+1;
                } else {
                    // Tidak menjawab maka di hitung tidak paham
                    $T_TP = $T_TP+1;
                }
            }

            // Hitung persentase
            $P = ($T_P>0)? ($T_P/$totalP) * 100 : 0;
            $TP = ($T_TP>0)? ($T_TP/$totalP) * 100 : 0;
            $M = ($T_M>0)? ($T_M/$totalP) * 100 : 0;

            $result = array(
                'P' => round($P,2),
                'TP' => round($TP,2),
                'M' => round($M,2)
            );

        }

        return print_r(json_encode($result));

    }

    public function getAnalisis4(){

        $sch = $this->input->get('sch');
        $g = $this->input->get('g');

        // Get total student
        $where = '';
        if($sch!='-'){
            $where = ' AND Sekolah = "'.$sch.'" ';
        }

        // Jumlah soal
        $q = 'SELECT t.ID FROM testing t  LEFT JOIN user u ON (u.ID = t.IDUser) WHERE u.Sebagai = "siswa" AND t.Status="1" AND t.Type = "1"  AND t.IDGelombang = "'.$g.'" '.$where;

        $dataSoal = $this->db->query('SELECT t.* FROM testing t 
                                            LEFT JOIN user u ON (u.ID = t.IDUser)
                                            WHERE u.Sebagai = "siswa" AND t.Status="1" 
                                            AND t.Type = "1" AND t.IDGelombang = "'.$g.'" '.$where)->result_array();

        $JumlahSiswa = count($dataSoal);
        $JumlahSoal = 0;

        // Query Detail
        $result = [];
        // MEnadaptkan jumlah soal
        if($JumlahSiswa>0){


            $IDGelombang = $dataSoal[0]['IDGelombang'];
            $dataJumlahSoal = $this->db->get_where('setting_gelombang',array(
                'ID' => $IDGelombang
            ))->result_array();

            $JumlahSoal = $dataJumlahSoal[0]['Nilai'];

            // Get sample ID Soal
            $dataIDSoal = $this->db->query('SELECT IDSoal FROM testing_details 
                                                            WHERE IDTest = "'.$dataSoal[0]['ID'].'"')
                ->result_array();


            if(count($dataIDSoal)>0){

                foreach ($dataIDSoal AS $item){
                    $IDSoal = $item['IDSoal'];
                    $q_p = 'SELECT td.* FROM testing_details td WHERE td.IDTest IN ('.$q.') AND td.IDSoal = "'.$IDSoal.'" AND td.IDKategori = "1" ';
                    $data_p = $this->db->query($q_p)->result_array();

                    $q_tp = 'SELECT td.* FROM testing_details td WHERE td.IDTest IN ('.$q.') AND td.IDSoal = "'.$IDSoal.'" AND (td.IDKategori = "2" OR IDKombinasi IS NULL OR td.IDKombinasi = "")';
                    $data_tp = $this->db->query($q_tp)->result_array();

                    $q_m = 'SELECT td.* FROM testing_details td WHERE td.IDTest IN ('.$q.') AND td.IDSoal = "'.$IDSoal.'" AND td.IDKategori = "3"';
                    $data_m = $this->db->query($q_m)->result_array();

                    $res = array(
                        'IDSoal' => $IDSoal,
                        'q_p' => $q_p,
                        'q_tp' => $q_tp,
                        'q_m' => $q_m,
                        'P' => count($data_p),
                        'TP' => count($data_tp),
                        'M' => count($data_m)
                    );

                    array_push($result,$res);
                }

            }


        }

        // Jumlah Keseluruhan
        $JumlahKeseluruhan = $JumlahSiswa * $JumlahSoal;

        $r = array(
            '_JumlahSiswa' => $JumlahSiswa,
            '_JumlahSoal' => $JumlahSoal,
            'JumlahKeseluruhan' => $JumlahKeseluruhan,
            'Details' => $result
        );

        return print_r(json_encode($r));

    }


}
