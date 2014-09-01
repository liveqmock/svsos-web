<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $userInfo = $this->Base_model->check_valid();
        if( $userInfo ) redirect('admin/main');
    }

    public function index()
    {
        $data['captcha'] = $this->Base_model->captcha(true);
        $this->load->view('admin/login',$data);
    }
}
