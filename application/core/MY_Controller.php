<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{



    public function template($content)
    {
        $data['content'] = $content;
        $this->load->view('template/template', $data);
    }

    public function template_2($content)
    {
        $data['content'] = $content;
        $this->load->view('template/template_2', $data);
    }
}
