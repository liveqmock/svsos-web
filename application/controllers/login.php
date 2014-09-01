<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->session->userdata('is_login') AND redirect();
    }

    public function index()
    {
        
        $data['captcha'] = $this->Base_model->captcha(true);
        $this->load->view('login',$data);
    }

    public function findPwd($step = 1)
    {
        if( $step == 1)
        {
            $this->load->view('findPwd');
        }
        else
        {
            $data['email'] = $_GET['email'];
            $this->load->view('findPwd2',$data);
        }

    }
    
    public function auth($provider=''){
        $this->config->load('oauth2');
        $allowed_providers = $this->config->item('oauth2');
        if ( ! $provider OR ! isset($allowed_providers[$provider]))
        {
            $this->session->set_flashdata('info', '暂不支持'.$provider.'方式登录.');
            redirect();
            return;
        }
        $this->load->library('oauth2');
        $provider = $this->oauth2->provider($provider, $allowed_providers[$provider]);
        $args = $this->input->get();
        if ($args AND !isset($args['code']))
        {
            $this->session->set_flashdata('info', '授权失败了,可能由于应用设置问题或者用户拒绝授权.<br />具体原因:<br />'.json_encode($args));
            redirect();
            return;
        }
        $code = $this->input->get('code', TRUE);
        if ( ! $code)
        {
          try
          {
                $provider->authorize();
          }
          catch (OAuth2_Exception $e)
          {
                $this->session->set_flashdata('info', '操作失败<pre>'.$e.'</pre>');
          }
        }
        else
        {
            try
            {
                $token = $provider->access($code);
                $sns_user = $provider->get_user_info($token);
               
                if (is_array($sns_user))
                {
                    $open_id = $sns_user['uid'];
                    $this->load->model('User_model');
                    $userSns = $this->User_model->getUserSnsByOpenId($open_id);
                    $user = null;
                    if(!$userSns){
                        $user = $this->User_model->saveUserBySns($sns_user);
                    } else {
                        $this->User_model->updateUserSns($sns_user);
                        $user = $this->User_model->getUserByOpenId($open_id);
                    }
                    $this->session->set_flashdata('info', '登录成功');
                    $this->session->set_userdata('userInfo', $user);
                    $this->session->set_userdata('is_login', TRUE);
                }
                else
                {
                    $this->session->set_flashdata('info', '获取用户信息失败');
                }
            }
            catch (OAuth2_Exception $e)
            {
                    $this->session->set_flashdata('info', '操作失败<pre>'.$e.'</pre>');
            }
        }
        redirect(); 
        
    }



}