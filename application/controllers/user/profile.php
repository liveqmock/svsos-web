

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Profile extends MY_Controller
{
    
    private $data;
    private $userInfo;
    
    public function __construct() {
        parent::__construct();
        $this->data['menu'] = 'user';
        $this->data['sMenu'] = 'profile';
        $this->userInfo = $this->Base_model->check_valid(true);
    }
    
    public function index(){
        $this->data['cur'] = 'index';
        $this->data['userInfo'] = $this->Base_model->is_existed('sys_user',array('uid'=>$this->userInfo['id']));
        $this->load->view('user/userinfo_view',$this->data);
    }
    
}

