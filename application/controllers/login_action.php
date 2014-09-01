<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_action extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $account = $this->input->post('account',true);
        $pwd = $this->input->post('pwd',true);
        $captcha = $this->input->post('captcha',true);

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
        elseif( $ret['status'] != 1 )
        {
            echo json_encode(array('error' => 99, 'msg' => '账号未激活!'));
        }
        else
        {
            if($ret['password'] != md5(md5($pwd)))
            {
                echo json_encode(array('error' => 99, 'msg' => '密码不正确'));
            }
            else
            {
                $this->session->set_userdata('is_login',true);
                $this->session->set_userdata('userInfo', array('id'=>$ret['uid'],'account'=>$account,'nickname'=> isset($ret['nickname']) ? $ret['nickname'] : $account,'role'=>$ret['role'],'type'=>$ret['user_type'],'sp_id'=>$ret['sp_id']));
                if( ($ret['user_type'] == 2) && empty($ret['sp_id']) )
                {
                    echo json_encode(array('error'=>0,'url'=>site_url('join')));
                }
                else
                {
                    echo json_encode(array('error'=>0,'url'=>site_url()));
                }
            }
        }
    }

    public function fastLogin()
    {
        $account = $this->input->post('name',true);
        $pwd = $this->input->post('pwd',true);

        if ( !check_email($account) )
        {
            echo json_encode(array('error' => 99, 'msg' => '帐号不正确'));
            exit;
        }

        $ret = $this->Base_model->is_existed('sys_user',array('account'=>$account));
        if( empty($ret) )
        {
            echo json_encode(array('error' => 99, 'msg' => '帐号不存在'));
        }
        elseif( $ret['status'] != 1 )
        {
            echo json_encode(array('error' => 99, 'msg' => '账号未激活!'));
        }
        else
        {
            if($ret['password'] != md5(md5($pwd)))
            {
                echo json_encode(array('error' => 99, 'msg' => '密码不正确'));
            }
            else
            {
                $this->session->set_userdata('userInfo', array('id'=>$ret['user_id'],'account'=>$account,'name'=>$ret['nickname'],'role'=>$ret['role'],'type'=>$ret['user_type'],'sp_id'=>$ret['sp_id']));
                if( ($ret['user_type'] == 2) && empty($ret['sp_id']) )
                {
                    echo json_encode(array('error'=>0,'url'=>site_url('join')));
                }
                else
                {
                    echo json_encode(array('error'=>0,'url'=>site_url()));
                }
            }
        }
    }

    public function findPwd()
    {
        $account = $this->input->post('email',true);
        $ret = $this->Base_model->is_existed('sys_user',array('account'=>$account));
        if( empty($ret) )
        {
            echo json_encode(array('error' => 99, 'msg' => '邮箱不存在'));
        }
        elseif( $ret['status'] != 1 )
        {
            echo json_encode(array('error' => 99, 'msg' => '账号未激活!'));
        }
        else
        {
            $pwd = random_string('alnum', 6);
            $re = $this->Base_model->update('sys_user',array('user_id'=>$ret['user_id']),array('password'=>md5(md5($pwd))));
            if( $re )
            {
                $this->load->library('email');
                $this->email->from($this->config->item('smtp_from'), '随售网');
                $this->email->to($account);
                $this->email->subject('随售网密码找回邮件');
                $content = "<html><body><strong>尊敬的用户：</strong><br>&nbsp;<br>您好！您于".date('Y年m月d日 H:i')."提交找回密码请求，您的新密码重置为：{$pwd}<br>&nbsp;<br>
        为了保证您帐号的安全性，请立即登陆随售网修改密码!<br>&nbsp;<br>如果您误收到此电子邮件，
        则可能是其他用户在尝试激活邮箱时的误操作。由此给您带来的不便请谅解。
        <br>&nbsp;<br>感谢您使用随售网！<br>&nbsp;<br>随售网账户中心</body></html>";
                $this->email->message($content);
                $this->email->send();

                echo json_encode(array('error'=>0,'url'=>site_url("login/findPwd/2?email={$account}")));
            }
            else
            {
                echo json_encode(array('error'=>99,'msg'=>'密码重置失败'));
            }


        }

    }
}