<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Money extends MY_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->data['menu'] = 'service';
        $this->data['sMenu'] = 'money';
        $this->data['userInfo'] = $this->Base_model->check_valid(true);
    }

    public function index()
    {
        $info = $this->Base_model->is_existed('sys_user',array('user_id'=>$this->data['userInfo']['id']));

        $this->data['sumOrder'] = 0;
        $this->data['sumMoney'] = 0;
        $this->data['payMoney'] = 0;
        $this->data['noPayMoney'] = 0;
        if( $info['sp_id'] )
        {
            $this->load->model('Service_order_point_model');
            $result = $this->Service_order_point_model->money($info['sp_id']);
            $this->data['sumOrder'] = count($result);
            foreach($result as $v)
            {
                $this->data['sumMoney'] += $v['money'];
                if( $v['pay_status'] == 2 )
                {
                    $this->data['payMoney'] += $v['money'];
                }
                else
                {
                    $this->data['noPayMoney'] += $v['money'];
                }
            }
        }

        $this->load->view('service/money',$this->data);
    }

}