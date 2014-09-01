<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller
{
    private $data;
    private $pre;

    public function __construct()
    {
        parent::__construct();
        if( !iShow('a') )
        {
            redirect(site_url());
        }
        $this->pre = 20;
        $this->data['menu'] = 'main';
    }

    public function index($page = 1)
    {
        $page = (int)$page - 1;
        $this->data['total_items'] = $this->Base_model->count('service_order');
        $this->data['maxPage'] = ceil($this->data['total_items']/$this->pre);
        if( $page >= $this->data['maxPage'] ) $page = $this->data['maxPage']-1;
        if($page < 0) $page = 0;
        $this->data['url'] = site_url('admin/main/index').'/';
        $this->data['current_page'] = $page;
        $this->data['items_per_page'] = $this->pre;

        $this->load->model('Service_order_model');
        $this->data['lists'] = $this->Service_order_model->getLists(null,$this->pre,$page*$this->pre);

        $this->load->view('admin/order/list',$this->data);
    }

    public function search()
    {
        $status = intval($this->input->get('orderStatus'));
        $page = intval($this->input->get('page'));
        $page = (int)$page - 1;
        if( $status == 0 ) redirect(site_url('admin/main'));

        $this->data['total_items'] = $this->Base_model->where_count('service_order',array('status'=>$status));
        $this->data['maxPage'] = ceil($this->data['total_items']/$this->pre);
        if( $page >= $this->data['maxPage'] ) $page = $this->data['maxPage']-1;
        if($page < 0) $page = 0;
        $this->data['url'] = site_url('admin/main/search?orderStatus=').$status.'&page=';
        $this->data['current_page'] = $page;
        $this->data['items_per_page'] = $this->pre;

        $this->load->model('Service_order_model');
        $this->data['lists'] = $this->Service_order_model->getLists(array('service_order.status'=>$status),$this->pre,$page*$this->pre);

        $this->data['status'] = $status;

        $this->load->view('admin/order/list',$this->data);
    }

    public function edit($id)
    {
        $id = intval($id);
        if( empty($id) ) redirect(site_url('admin/main'));

        $this->load->model('Service_order_model');
        $this->data['info'] = $this->Service_order_model->getInfoById($id);
        if( empty($this->data['info']) || !empty($this->data['info']['sp_name']) ) redirect(site_url('admin/main'));

        $this->load->model('Base_service_category_model');
        $this->data['serviceCategory'] = $this->Base_service_category_model->getLists();
        $this->load->model('Base_product_category_model');
        $this->data['productCategory'] = $this->Base_product_category_model->getLists();

        $this->load->view('admin/order/edit',$this->data);
    }

    public function add($id)
    {
        $id = intval($id);
        if( empty($id) ) redirect(site_url('admin/main'));

        $this->load->model('Service_order_model');
        $this->data['info'] = $this->Service_order_model->getInfoById($id);
        if( empty($this->data['info']) || !empty($this->data['info']['sp_name'])) redirect(site_url('admin/main'));

        $this->load->model('Service_point_model');
        $this->data['lists'] = $this->Service_point_model->getDistance($this->data['info']['lat'],$this->data['info']['lng']);

        $this->load->view('admin/order/add',$this->data);
    }

    public function show($id)
    {
        $id = intval($id);
        if( empty($id) ) redirect(site_url('admin/main'));

        $this->load->model('Service_order_model');
        $this->data['info'] = $this->Service_order_model->getInfoById($id);
        if( empty($this->data['info']) ) redirect(site_url('admin/main'));

        $this->load->view('admin/order/show',$this->data);
    }
}
