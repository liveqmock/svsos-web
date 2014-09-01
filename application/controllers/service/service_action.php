<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_action extends MY_Controller
{
    private $userInfo;

    public function __construct()
    {
        parent::__construct();
        $this->userInfo = $this->Base_model->check_valid();
        if( empty($this->userInfo) )
        {
            echo json_encode(array('error'=>99,'msg'=>'请先登录'));
            exit;
        }
    }

    public function index()
    {
        $sTime = $this->input->post('sTime',true);
        $eTime = $this->input->post('eTime',true);
        $client = $this->input->post('client',true);
        $service = intval($this->input->post('service',true));
        $brand = $this->input->post('brand',true);
        $pCate = intval($this->input->post('pCate',true));
        $pModel = $this->input->post('pModel',true);
        $pSN = $this->input->post('pSN',true);
        $name = $this->input->post('name',true);
        $tel = $this->input->post('tel',true);
        $address = $this->input->post('address',true);
        $lat = $this->input->post('lat',true);
        $lng = $this->input->post('lng',true);
        $remark = $this->input->post('remark',true);

        if(empty($sTime))
        {
            echo json_encode(array('error'=>99,'msg'=>'报单日期不能为空'));
            exit;
        }

        if(empty($brand))
        {
            echo json_encode(array('error'=>99,'msg'=>'产品品牌不能为空'));
            exit;
        }

        if(empty($name))
        {
            echo json_encode(array('error'=>99,'msg'=>'用户姓名不能为空'));
            exit;
        }

        if(empty($tel))
        {
            echo json_encode(array('error'=>99,'msg'=>'联系电话不能为空'));
            exit;
        }

        if(empty($address))
        {
            echo json_encode(array('error'=>99,'msg'=>'联系地址不能为空'));
            exit;
        }

        if(empty($lat) || empty($lng))
        {
            echo json_encode(array('error'=>99,'msg'=>'联系地址坐标不能为空，请先获取坐标'));
            exit;
        }


        $time = time();
        $id = $this->Base_model->create('get_order_id',array('create_time'=>date('Y-m-d H:i:s',$time)));
        if( !$id )
        {
            echo json_encode(array('error'=>99,'msg'=>'工单号生成失败，请重试'));
            exit;
        }
        $id = str_pad($id,8,"0",STR_PAD_LEFT);
        $order_id = 'No'.date('Ymd',$time).$id;
        $data = array(
            'order_id'          =>  $order_id,
            'start_time'        =>  $sTime,
            'end_time'          =>  $eTime,
            'client'            =>  $client,
            'service_type'      =>  $service,
            'product_brand'     =>  $brand,
            'product_category'  =>  $pCate,
            'product_model'     =>  $pModel,
            'product_sn'        =>  $pSN,
            'name'              =>  $name,
            'tel'               =>  $tel,
            'address'           =>  $address,
            'lat'               =>  $lat,
            'lng'               =>  $lng,
            'remark'            =>  $remark,
            'create_time'       =>  $time,
            'uid'           =>  $this->userInfo['id'],
        );

        $ret = $this->Base_model->create('ss_service_order',$data);
        if( $ret )
        {
            echo json_encode(array('error'=>0,'url'=>site_url('service/order')));
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'创建工单失败，请重试'));
        }
    }
}