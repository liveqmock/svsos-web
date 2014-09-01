<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Money extends MY_Controller
{
    private $data;
    private $pre;

    public function __construct()
    {
        parent::__construct();
        if( !iShow('e') )
        {
            redirect(site_url());
        }
        $this->pre = 20;
        $this->data['menu'] = 'money';
    }

    public function index($page = 1)
    {
        $page = (int)$page - 1;
        $this->data['total_items'] = $this->Base_model->count('service_order_point');
        $this->data['maxPage'] = ceil($this->data['total_items']/$this->pre);
        if( $page >= $this->data['maxPage'] ) $page = $this->data['maxPage']-1;
        if($page < 0) $page = 0;
        $this->data['url'] = site_url('admin/money/index').'/';
        $this->data['current_page'] = $page;
        $this->data['items_per_page'] = $this->pre;

        $this->load->model('Service_order_point_model');
        $this->data['lists'] = $this->Service_order_point_model->getLists($this->pre,$page*$this->pre);

        $this->load->view('admin/money/list',$this->data);
    }

    public function search()
    {
        $status = intval($this->input->get('status'));
        $page = intval($this->input->get('page'));
        $page = (int)$page - 1;
        if( $status == 0 ) redirect(site_url('admin/money'));

        $this->load->model('Service_order_point_model');
        $this->data['total_items'] = $this->Service_order_point_model->getSearchNum($status);
        $this->data['maxPage'] = ceil($this->data['total_items']/$this->pre);
        if( $page >= $this->data['maxPage'] ) $page = $this->data['maxPage']-1;
        if($page < 0) $page = 0;
        $this->data['url'] = site_url('admin/money/search?status=').$status.'&page=';
        $this->data['current_page'] = $page;
        $this->data['items_per_page'] = $this->pre;

        $this->data['lists'] = $this->Service_order_point_model->getLists($this->pre,$page*$this->pre,array('service_order.pay_status'=>$status));

        $this->data['status'] = $status;

        $this->load->view('admin/money/list',$this->data);
    }

    public function address($id)
    {
        $id = intval($id);
        if( empty($id) ) redirect(site_url('admin/money'));

        $this->load->model('Service_order_point_model');
        $this->data['info'] = $this->Service_order_point_model->getPayAddress($id);
        if(empty($this->data['info'])) redirect(site_url('admin/money'));

        $this->data['address'] = '';
        if(!empty($this->data['info']['province_id']))
        {
            $this->load->model('Base_area_model');
            $this->data['address'] = $this->Base_area_model->getName($this->data['info']['province_id'],$this->data['info']['city_id'],$this->data['info']['district_id']);
        }

        $this->load->view('admin/money/address',$this->data);

    }
}
