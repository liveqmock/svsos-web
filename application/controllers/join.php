<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Join extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $userInfo = $this->Base_model->check_valid();
        if( $userInfo )
        {
            $info = $this->Base_model->is_existed('sys_user',array('user_id'=>$userInfo['id']));

            $this->load->model('Base_product_category_model');
            $cates = $this->Base_product_category_model->getLists();
            $data['productCategory'] = '[';
            foreach($cates as $v)
            {
                $data['productCategory'] .= "'".$v['name']."',";
            }
            $data['productCategory'] = chop($data['productCategory'],',');
            $data['productCategory'] .= ']';

            $this->load->view('join',$data);
        }
        else
        {
            $this->session->set_userdata('join',1);
            redirect(site_url('login'));
        }
    }
}