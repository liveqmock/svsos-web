<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller
{
    private $data;
    private $userInfo;
    private $pre;

    public function __construct()
    {
        parent::__construct();
        $this->userInfo = $this->Base_model->check_valid(true);
        $this->data['menu'] = 'service';
        $this->data['sMenu'] = 'order';
        $this->pre = 20;
    }

    public function index($page = 1)
    {
        if( $this->userInfo['type'] == 2 )
        {
            $info = $this->Base_model->is_existed('sys_user',array('uid'=>$this->userInfo['id']));

            $page = (int)$page - 1;
            $this->data['total_items'] = $this->Base_model->where_count('ss_service_order_point',array('sp_id'=>$info['sp_id']));
            $this->data['maxPage'] = ceil($this->data['total_items']/$this->pre);
            if( $page >= $this->data['maxPage'] ) $page = $this->data['maxPage']-1;
            if($page < 0) $page = 0;
            $this->data['url'] = site_url('service/order/index').'/';
            $this->data['current_page'] = $page;
            $this->data['items_per_page'] = $this->pre;

            $this->load->model('Service_order_point_model');
            $this->data['lists'] = $this->Service_order_point_model->getMineLists($info['sp_id'],$this->pre,$page*$this->pre);

            $this->load->view('service/order/mine/list',$this->data);
        }
        else
        {
            $page = (int)$page - 1;
            $this->data['total_items'] = $this->Base_model->where_count('ss_service_order',array('uid'=>$this->userInfo['id']));
            $this->data['maxPage'] = ceil($this->data['total_items']/$this->pre);
            if( $page >= $this->data['maxPage'] ) $page = $this->data['maxPage']-1;
            if($page < 0) $page = 0;
            $this->data['url'] = site_url('service/order/index').'/';
            $this->data['current_page'] = $page;
            $this->data['items_per_page'] = $this->pre;

            $this->load->model('Service_order_model');
            $this->data['lists'] = $this->Service_order_model->getLists(array('ss_service_order.uid'=>$this->userInfo['id']),$this->pre,$page*$this->pre);

            $this->load->view('service/order/list',$this->data);
        }


    }

    public function search()
    {
        $status = intval($this->input->get('orderStatus'));
        $page = intval($this->input->get('page'));
        $page = (int)$page - 1;
        if( $status == 0 ) redirect(site_url('service/order'));

        $this->data['total_items'] = $this->Base_model->where_count('service_order',array('uid'=>$this->userInfo['id'],'status'=>$status));
        $this->data['maxPage'] = ceil($this->data['total_items']/$this->pre);
        if( $page >= $this->data['maxPage'] ) $page = $this->data['maxPage']-1;
        if($page < 0) $page = 0;
        $this->data['url'] = site_url('service/order/search?orderStatus=').$status.'&page=';
        $this->data['current_page'] = $page;
        $this->data['items_per_page'] = $this->pre;

        $this->load->model('Service_order_model');
        $this->data['lists'] = $this->Service_order_model->getLists(array('service_order.uid'=>$this->userInfo['id'],'service_order.status'=>$status),$this->pre,$page*$this->pre);

        $this->data['status'] = $status;

        $this->load->view('service/order/list',$this->data);
    }

    public function edit($id)
    {
        $id = intval($id);
        if( empty($id) ) redirect(site_url('service/order'));

        $this->load->model('Service_order_model');
        $this->data['info'] = $this->Service_order_model->getInfoById($id);
        if( empty($this->data['info']) || ($this->data['info']['uid'] != $this->userInfo['id']) || !empty($this->data['info']['sp_name'])) redirect(site_url('service/order'));

        $this->load->model('Base_service_category_model');
        $this->data['serviceCategory'] = $this->Base_service_category_model->getLists();
        $this->load->model('Base_product_category_model');
        $this->data['productCategory'] = $this->Base_product_category_model->getLists();

        $this->load->view('service/order/edit',$this->data);
    }

    public function show($id)
    {
        $id = intval($id);
        if( empty($id) ) redirect(site_url('service/order'));

        $this->load->model('Service_order_model');
        $this->data['info'] = $this->Service_order_model->getInfoById($id);

        if( $this->userInfo['type'] == 2 )
        {
            if( empty($this->data['info']) || ($this->data['info']['sp_userId'] != $this->userInfo['id']) ) redirect(site_url('service/order'));
            $this->load->view('service/order/mine/show',$this->data);
        }
        else
        {
            if( empty($this->data['info']) || ($this->data['info']['uid'] != $this->userInfo['id']) ) redirect(site_url('service/order'));
            $this->load->view('service/order/show',$this->data);
        }

    }
}