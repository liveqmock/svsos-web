<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    
   public function __construct()
    {
        parent::__construct();
        $this->validate();
    }
    
    
    public function validate(){
        $isVerifying = $this->session->userdata('isVerifying'); //账号验证中
        $userInfo = $this->session->userdata('userInfo'); 
      
        if(self::isBelongToFilterUrl()){
            //判断是否登陆
            if(empty($userInfo) && $isVerifying){
                //注册验证中状态页面跳转
                redirect(site_url("reg/verify"));
            }
        }
        return TRUE;
    }
    
    
    public function getCurrentUri(){
       $this->load->helper("url");
       $url = uri_string(); 
       return $url;
    }
    
    
    public function isBelongToFilterUrl(){
        $uri = self::getCurrentUri();
        if($uri == null){
            return FALSE;
        }
        $filter_urls = $this->config->item('filter_urls');
        return (strpos($filter_urls,$uri) !== false);
    }
    
    
}