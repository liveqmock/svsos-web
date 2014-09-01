<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends MY_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->data['menu'] = 'about';
    }

    public function us()
    {
        $this->data['aboutMenu'] = 'us';
        $this->load->view('about/us',$this->data);
    }

    public function client()
    {
        $this->data['aboutMenu'] = 'client';
        $this->load->view('about/client',$this->data);
    }

    public function cooperation()
    {
        $this->data['aboutMenu'] = 'cooperation';
        $this->load->view('about/cooperation',$this->data);
    }

    public function join()
    {
        $this->data['ip'] = $this->input->ip_address();
        $this->data['ipAddress'] = '未知';
        if( $this->data['ip'] != '127.0.0.1' )
        {
            $info = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip={$this->data['ip']}");
            $info = @json_decode($info);
            if( !empty($info) && ($info->ret != -1) )
            {
                $province = $info->province;
                $city = $info->city;
                $this->data['ipAddress'] = ($province == $city) ? $city.'市' : $province.'省'.$city.'市';
            }
        }

        $this->data['aboutMenu'] = 'join';
        $this->load->view('about/join',$this->data);
    }

    public function info()
    {
        $this->data['aboutMenu'] = 'info';
        $this->load->view('about/info',$this->data);
    }

    public function plan()
    {
        $this->data['aboutMenu'] = 'plan';
        $this->load->view('about/plan',$this->data);
    }

    public function news()
    {
        $this->data['aboutMenu'] = 'news';
        $this->load->view('about/news',$this->data);
    }

    public function contact()
    {
        $this->data['aboutMenu'] = 'contact';
        $this->load->view('about/contact',$this->data);
    }
}