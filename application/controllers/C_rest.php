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

}
