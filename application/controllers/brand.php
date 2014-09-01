<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand extends MY_Controller
{
    private $pre;
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->pre = 10;
        $this->data['menu'] = 'brand';
    }

    public function index( $page = 1 )
    {
        $page = (int)$page - 1;
        $this->data['total_items'] = $this->Base_model->count('ss_brand_customers');
        $this->data['maxPage'] = ceil($this->data['total_items']/$this->pre);
        if( $page >= $this->data['maxPage'] ) $page = $this->data['maxPage']-1;
        if($page < 0) $page = 0;
        $this->data['url'] = site_url('brand/index').'/';
        $this->data['current_page'] = $page;
        $this->data['items_per_page'] = $this->pre;

        $this->load->model('Brand_model');
        $this->data['lists'] = $this->Brand_model->getLists($this->pre,$page*$this->pre);

        $this->load->view('brand',$this->data);
    }

    public function search()
    {

        $search = $this->input->get('search',true);

        if( ($search == '请输入品牌名称...') || empty($search) ) redirect(site_url('brand'));

        $page = $this->input->get('page',true);
        $page = (int)$page - 1;

        $this->load->model('Brand_model');
        $this->data['total_items'] = $this->Brand_model->getSearchNum(array('name'=>$search));
        $this->data['maxPage'] = ceil($this->data['total_items']/$this->pre);
        if( $page >= $this->data['maxPage'] ) $page = $this->data['maxPage']-1;
        if($page < 0) $page = 0;
        $this->data['url'] = site_url('brand/search').'?search='.$search.'&page=';
        $this->data['current_page'] = $page;
        $this->data['items_per_page'] = $this->pre;

        $this->data['lists'] = $this->Brand_model->getLists($this->pre,$page*$this->pre,array('name'=>$search),true);
        $this->data['search'] = $search;

        $this->load->view('brand',$this->data);
    }
}
