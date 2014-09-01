<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Money_action extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if( !iShow('e') )
        {
            echo json_encode(array('error'=>99,'msg'=>'无操作权限'));
            exit;
        }
    }

    public function payStatus()
    {
        $order_id = intval($this->input->post('order_id',true));
        $payStatus = intval($this->input->post('payStatus',true));

        $orderInfo = $this->Base_model->is_existed('service_order',array('id'=>$order_id));
        if(empty($orderInfo))
        {
            echo json_encode(array('error'=>99,'msg'=>'服务订单不存在'));
            exit;
        }

        $upDate = array(
            'pay_status'    =>  $payStatus,
        );

        $ret = $this->Base_model->update('service_order',array('id'=>$order_id),$upDate);
        if( $ret )
        {
            echo json_encode(array('error'=>0,'url'=>site_url('admin/money')));
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'无修改'));
        }
    }
}
