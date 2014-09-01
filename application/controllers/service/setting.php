<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends MY_Controller
{
    private $data;
    private $userInfo;

    public function __construct()
    {
        parent::__construct();
        $this->data['menu'] = 'service';
        $this->data['sMenu'] = 'setting';
        $this->userInfo = $this->Base_model->check_valid(true);
    }

    public function index()
    {
        $this->data['cur'] = 'index';
        $this->data['userInfo'] = $this->Base_model->is_existed('sys_user',array('uid'=>$this->userInfo['id']));
        $this->load->view('service/setting/userInfo',$this->data);
    }

    public function pwd()
    {
        $this->data['cur'] = 'pwd';
        $this->load->view('service/setting/pwd',$this->data);
    }

    public function account()
    {
        $this->data['cur'] = 'account';
        $this->data['account'] = $this->userInfo['account'];
        $this->load->view('service/setting/account',$this->data);
    }

    public function address()
    {
        $this->data['cur'] = 'address';
        $this->data['info'] = $this->Base_model->is_existed('user_address',array('uid'=>$this->userInfo['id']));
        $this->load->view('service/setting/address',$this->data);
    }

}