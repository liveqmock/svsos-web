<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reg_action extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function baseInfo()
    {
        $step = intval($this->input->post('step',true));
        $type = intval($this->input->post('reg_type',true));
        $account = $this->input->post('account',true);
        $province = intval($this->input->post('province',true));
        $city = intval($this->input->post('city',true));
        $district = intval($this->input->post('district',true));
        $contact = $this->input->post('contact',true);
        $compName = $this->input->post('compName',true);
        $email = $this->input->post('email',true);
        $phone = $this->input->post('phone',true);
        $pwd = $this->input->post('pwd',true);
        $rePwd = $this->input->post('comfirmPwd',true);
        $captcha = $this->input->post('captcha',true);
        $agree = intval($this->input->post('agree',true));

        if ( !check_email($email) )
        {
            echo json_encode(array('error' => 99, 'msg' => '请输入正确的邮箱地址'));
            exit;
        }

        if( !$pwd && ($pwd != $rePwd) )
        {
            echo json_encode(array('error' => 99, 'msg' => '两次输入密码不正确'));
            exit;
        }

        if( !$agree )
        {
            echo json_encode(array('error' => 99, 'msg' => '请先同意协议'));
            exit;
        }

        $sessionCaptcha = $this->session->userdata('captcha');
        if ($sessionCaptcha != $captcha)
        {
            echo json_encode(array('error' => 99, 'msg' => '验证码错误'));
            exit;
        }
       
        $ret = $this->Base_model->is_existed('sys_user',array('email'=>$email));
        if( !empty($ret) )
        {
            echo json_encode(array('error' => 99, 'msg' => '该邮箱账号已被注册'));
            exit;
        }
        try {
     
            $data = array(
                'account'       =>  $account,
                'email'         =>  $email,
                'contact'       =>  $contact,
                'phone'         =>  $phone,
                'company_name'  =>  $compName,
                'password'      =>  md5(md5($pwd)),
                'province_id'   =>  $province,
                'city_id'       =>  $city,
                'district_id'   =>  $district,
                'user_type'     =>  $type,
                'create_time'   =>  date('Y-m-d H:i:s',time()),
            );
            $this->load->model('User_model');
            $uid = $this->User_model->saveUser($data);
            if($uid){
                $this->session->unset_userdata('join');
                $this->session->set_userdata('tmpUserInfo', array('id'=>$uid,'account'=>$account,'email'=>$email,'nickname'=>$account));
                if($step == 1)
                {
                    $this->sendVerifyCode();
                    $this->session->set_userdata('isVerifying',true);
                    echo json_encode(array('error' => 0, 'url' => site_url('reg/verify')));
                }
            }
            else
            {
                echo json_encode(array('error' => 99, 'msg' => '注册失败,请重试!'));
            }
               
        } catch (Exception $exc) {
            echo json_encode(array('error' => 00, 'msg' => $exc->getTraceAsString()));
        }
    }

    public function verifyEmail()
    {
        $tmpUserInfo = $this->session->userdata('tmpUserInfo');
        if( empty($tmpUserInfo) )
        {
            echo json_encode(array('error'=>99,'msg'=>'非法操作'));
            exit;
        }

        $verifyCode = $this->input->post('verifyCode',true);
        if( !empty($verifyCode))
        {
            $result = $this->Base_model->is_existed('sys_user_identify',array('uid'=>$tmpUserInfo['id'],'code'=>$verifyCode,'status'=>0));
            if( !empty($result) && ($result['send_time'] > strtotime('-1 day')) )
            {
                $this->session->unset_userdata('tmpUserInfo');
                $ret = $this->Base_model->is_existed('sys_user',array('uid'=>$tmpUserInfo['id']));
                $this->session->set_userdata('userInfo', array('id'=>$ret['uid'],'account'=>$ret['account'],'email'=>$ret['email'],'name'=>$ret['nickname'],'role'=>$ret['role'],'type'=>$ret['user_type']));
                $this->Base_model->update('sys_user_identify',array('id'=>$result['id']),array('status'=>1));
                $this->Base_model->update('sys_user',array('uid'=>$ret['uid']),array('status'=>1));
                if($ret['user_type']==2)
                {
                    echo json_encode(array('error'=>0,'url'=>site_url('join')));
                }
                else
                {
                    echo json_encode(array('error'=>0,'url'=>site_url('reg/done')));
                }
            }
            else
            {
                echo json_encode(array('error'=>99,'msg'=>'验证码无效或失效，请重新发送验证邮件进行验证'));
            }
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'验证码不能为空'));
            
        }
    }
    
    public function sendVerifyCode($isJson = false)
    {
        $tmpUserInfo = $this->session->userdata('tmpUserInfo');
        if(empty($tmpUserInfo)){ redirect(site_url('reg'));};
        $this->load->library('email');
        $this->email->from($this->config->item('smtp_from'), '随售网');
        $this->email->to($tmpUserInfo['email']);
        $this->email->subject('随售网邮箱验证确认信');
        $uuid = create_guid_section(6);
        $content = vsprintf($this->config->item('send_content'), array($uuid));
        if( $isJson )
        {
            $this->email->message($content);
            $ret = $this->email->send();
            if( $ret )
            {
                $data = array(
                    'uid'   =>  $tmpUserInfo['id'],
                    'value'     =>  $tmpUserInfo['email'],
                    'code'      =>  $uuid,
                    'send_time' =>  time(),

                );
                $this->Base_model->create('sys_user_identify',$data);
                echo json_encode(array('error'=>0));
            }
            else
            {
                echo json_encode(array('error'=>99,'msg'=>'邮件发送失败'));
            }
        }
        else
        {
            $data = array(
                'uid'   =>  $tmpUserInfo['id'],
                'value'     =>  $tmpUserInfo['account'],
                'code'      =>  $uuid,
                'send_time' =>  time(),

            );
            $this->Base_model->create('sys_user_identify',$data);
        }
    }

}