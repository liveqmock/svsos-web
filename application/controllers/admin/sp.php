<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sp extends MY_Controller
{
    private $data;
    private $pre;

    public function __construct()
    {
        parent::__construct();
        if( !iShow('c') )
        {
            redirect(site_url());
        }
        $this->pre = 20;
        $this->data['menu'] = 'sp';
    }

    public function index($page = 1)
    {
        $page = (int)$page - 1;
        $this->data['total_items'] = $this->Base_model->count('sales_service_point');
        $this->data['maxPage'] = ceil($this->data['total_items']/$this->pre);
        if( $page >= $this->data['maxPage'] ) $page = $this->data['maxPage']-1;
        if($page < 0) $page = 0;
        $this->data['url'] = site_url('admin/sp/index').'/';
        $this->data['current_page'] = $page;
        $this->data['items_per_page'] = $this->pre;

        $this->load->model('Service_point_model');
        $this->data['lists'] = $this->Service_point_model->getAdminLists($this->pre,$page*$this->pre);

        $this->load->view('admin/sp/list',$this->data);
    }

    public function search()
    {
        $search = $this->input->get('search');
        $bind = intval($this->input->get('bind'));
        $status = intval($this->input->get('status'));
        $verify = intval($this->input->get('verify'));

        $where = array();
        if($bind==1)
            $where = array('user_id ='=>'');
        elseif($bind==2)
            $where = array('user_id !='=>'');

        if($status)
            $where['status'] = $status;
        if($verify)
            $where['verify'] = $verify;

        $page = intval($this->input->get('page'));
        $page = (int)$page - 1;
        if( empty($search) && empty($where) ) redirect(site_url('admin/sp'));

        $this->load->model('Service_point_model');
        $this->data['total_items'] = $this->Service_point_model->getAdminSearchNum(array('sp_name'=>$search,'address'=>$search));
        $this->data['maxPage'] = ceil($this->data['total_items']/$this->pre);
        if( $page >= $this->data['maxPage'] ) $page = $this->data['maxPage']-1;
        if($page < 0) $page = 0;
        $this->data['url'] = site_url('admin/sp/search?search=').$search.'&bind='.$bind.'&status='.$status.'&verify='.$verify.'&page=';
        $this->data['current_page'] = $page;
        $this->data['items_per_page'] = $this->pre;

        $this->load->model('Service_point_model');
        $this->data['lists'] = $this->Service_point_model->getAdminLists($this->pre,$page*$this->pre,$where,array('sp_name'=>$search,'address'=>$search));

        $this->data['search'] = $search;
        $this->data['bind'] = $bind;
        $this->data['status'] = $status;
        $this->data['verify'] = $verify;

        $this->load->view('admin/sp/list',$this->data);
    }

    public function edit($id)
    {
        $id = intval($id);
        if( empty($id) ) redirect(site_url('admin/user'));

        $this->load->model('Service_point_model');
        $this->data['info'] = $this->Service_point_model->getInfoById($id);
        if( empty($this->data['info']) ) redirect(site_url('admin/sp'));

        $this->load->model('Base_product_category_model');
        $cates = $this->Base_product_category_model->getLists();
        $this->data['productCategory'] = '[';
        foreach($cates as $v)
        {
            $this->data['productCategory'] .= "'".$v['name']."',";
        }
        $this->data['productCategory'] = chop($this->data['productCategory'],',');
        $this->data['productCategory'] .= ']';

        $this->data['oldCategory'] = $this->data['info']['product'] ? $this->Base_product_category_model->getNamesByIdArr($this->data['info']['product'],true): '[]';

        $this->load->view('admin/sp/edit',$this->data);
    }

    public function add()
    {
        $this->load->model('Base_product_category_model');
        $cates = $this->Base_product_category_model->getLists();
        $this->data['productCategory'] = '[';
        foreach($cates as $v)
        {
            $this->data['productCategory'] .= "'".$v['name']."',";
        }
        $this->data['productCategory'] = chop($this->data['productCategory'],',');
        $this->data['productCategory'] .= ']';

        $this->load->view('admin/sp/add',$this->data);
    }
}