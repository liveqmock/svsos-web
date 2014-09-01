<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Password extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        
       $this->data['cur'] = 'pwd';
       $this->load->view('user/pwd_view',$this->data);
        
    }
    
}