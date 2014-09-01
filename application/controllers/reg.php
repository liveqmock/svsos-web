<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reg extends MY_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function _remap( $method )
    {
        switch ( $method )
        {
            case 'verify':
                $this->verify();
                break;
            case 'done':
                $this->data['userInfo'] = $this->Base_model->check_valid(true);
                $this->regDone();
                break;
            case 'captcha':
                $this->Base_model->captcha();
                break;
            case 'sendVerifyCode':
                $isJson = $this->uri->segment(3);
                $this->sendVerifyCode($isJson);
                break;
            case 'logout':
                $this->logout();
                break;
            case 'agreement':
                $this->agreement();
                break;
            case 'user':
                $this->init(3);
                break;
            case 'company':
                $this->init(2);
                break; 
            case 'brand':
                $this->init(1);
                break;  
            default:
                $result = $this->Base_model->check_valid();
                if( $result ) redirect(site_url());
                $this->init();
                break;
        }
    }

    public function init($type = 3)
    {
        $this->data['captcha'] = $this->Base_model->captcha(true);
        $this->data['reg_type'] = $type;
        $this->load->view('reg/register_view',$this->data);
    }

    public function verify()
    {
        //$this->sendVerifyCode();
        $isVerifying = $this->session->userdata('isVerifying');
        if(empty($isVerifying)){
            redirect(site_url('reg'));
        }
        $this->data['userInfo'] = $this->session->userdata('tmpUserInfo');
        $this->load->view('reg/register_verify',$this->data);
    }

    public function regDone()
    {
        $this->session->set_userdata('is_login',true);
        $this->load->view('reg/register_done',$this->data);
    }

    public function logout()
    {
        $this->session->unset_userdata('userInfo');
        $this->session->unset_userdata('is_login');
        redirect(site_url());
    }

    public function agreement()
    {
        $this->load->view('reg/agreement');
    }
}