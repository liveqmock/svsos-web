<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand extends MY_Controller
{
    private $data;
    private $pre;

    public function __construct()
    {
        parent::__construct();
        if( !iShow('b') )
        {
            redirect(site_url());
        }
        $this->pre = 20;
        $this->data['menu'] = 'brand';
    }

    public function index($page = 1)
    {
        $page = (int)$page - 1;
        $this->data['total_items'] = $this->Base_model->count('brand');
        $this->data['maxPage'] = ceil($this->data['total_items']/$this->pre);
        if( $page >= $this->data['maxPage'] ) $page = $this->data['maxPage']-1;
        if($page < 0) $page = 0;
        $this->data['url'] = site_url('admin/brand/index').'/';
        $this->data['current_page'] = $page;
        $this->data['items_per_page'] = $this->pre;

        $this->load->model('Brand_model');
        $this->data['lists'] = $this->Brand_model->getAdminLists($this->pre,$page*$this->pre);

        $this->load->view('admin/brand/list',$this->data);
    }

    public function search()
    {
        $search = $this->input->get('search',true);

        if( empty($search) ) redirect(site_url('admin/brand'));

        $page = $this->input->get('page',true);
        $page = (int)$page - 1;

        $this->load->model('Brand_model');
        $this->data['total_items'] = $this->Brand_model->getSearchNum(array('name'=>$search));
        $this->data['maxPage'] = ceil($this->data['total_items']/$this->pre);
        if( $page >= $this->data['maxPage'] ) $page = $this->data['maxPage']-1;
        if($page < 0) $page = 0;
        $this->data['url'] = site_url('admin/brand/index').'/';
        $this->data['current_page'] = $page;
        $this->data['items_per_page'] = $this->pre;

        $this->load->model('Brand_model');
        $this->data['lists'] = $this->Brand_model->getAdminLists($this->pre,$page*$this->pre,array('name'=>$search));
        $this->data['search'] = $search;

        $this->load->view('admin/brand/list',$this->data);
    }

    public function add()
    {
        $this->load->view('admin/brand/add',$this->data);
    }

    public function edit($id)
    {
        $id = intval($id);
        if( empty($id) ) redirect(site_url('admin/brand'));

        $this->data['info'] = $this->Base_model->is_existed('brand',array('id'=>$id));
        if( empty($this->data['info']) ) redirect(site_url('admin/brand'));

        $this->load->view('admin/brand/edit',$this->data);
    }
}