<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_action extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $account = $this->input->post('name',true);
        $pwd = $this->input->post('pwd',true);
        $captcha = $this->input->post('captcha',true);

        if ( !check_email($account) )
        {
            echo json_encode(array('error' => 99, 'msg' => '帐号不正确'));
            exit;
        }

        $sessionCaptcha = $this->session->userdata('captcha');
        if ($sessionCaptcha != $captcha)
        {
            echo json_encode(array('error' => 99, 'msg' => '验证码错误'));
            exit;
        }

        $ret = $this->Base_model->is_existed('sys_user',array('account'=>$account));
        if( empty($ret) )
        {
            echo json_encode(array('error' => 99, 'msg' => '帐号不存在'));
        }
        else
        {
            if($ret['password'] != md5(md5($pwd)))
            {
                echo json_encode(array('error' => 99, 'msg' => '密码不正确'));
            }
            else
            {
                $this->session->set_userdata('userInfo', array('id'=>$ret['user_id'],'account'=>$account,'name'=>$ret['nickname'],'role'=>$ret['role']));
                echo json_encode(array('error'=>0,'url'=>site_url('admin/main')));
            }
        }
    }
}