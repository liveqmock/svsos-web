<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Up extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function upload()
    {
        $this->load->library('Filehandle');
        $ret = $this->filehandle->upload_file('userfile');
        if ( is_array($ret) )
        {
            echo json_encode(array('error' => 0, 'url' => $ret['path']));
        }
        else
        {
            echo json_encode(array('error' => 1, 'msg' => strip_tags($ret)));
            exit;
        }
    }

}