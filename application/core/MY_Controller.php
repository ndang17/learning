<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {



    public function template($content)
    {
        $data['content'] = $content;
        $this->load->view('template/template',$data);
    }
}
