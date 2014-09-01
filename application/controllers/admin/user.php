<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{
    private $data;
    private $pre;

    public function __construct()
    {
        parent::__construct();
        if( !iShow('d') )
        {
            redirect(site_url());
        }
        $this->pre = 20;
        $this->data['menu'] = 'user';
    }

    public function index($page = 1)
    {
        $page = (int)$page - 1;
        $this->data['total_items'] = $this->Base_model->count('sys_user');
        $this->data['maxPage'] = ceil($this->data['total_items']/$this->pre);
        if( $page >= $this->data['maxPage'] ) $page = $this->data['maxPage']-1;
        if($page < 0) $page = 0;
        $this->data['url'] = site_url('admin/user/index').'/';
        $this->data['current_page'] = $page;
        $this->data['items_per_page'] = $this->pre;

        $this->load->model('User_model');
        $this->data['lists'] = $this->User_model->getLists($this->pre,$page*$this->pre);

        $this->load->view('admin/user/list',$this->data);
    }

    public function search()
    {
        $search = $this->input->get('search');
        $type = intval($this->input->get('type'));
        $ed = intval($this->input->get('ed'));
        $where = '';
        if(($type>0) && ($type<=2))
            $where['user_type'] = $type;
        elseif($type==3)
            $where = array('role !='=>'');
        if(!empty($ed))
            $where['ed'] = $ed;

        $page = intval($this->input->get('page'));
        $page = (int)$page - 1;
        if( empty($search) && empty($where) ) redirect(site_url('admin/user'));

        $this->load->model('User_model');
        $this->data['total_items'] = $this->User_model->getSearchCount(array('nickname'=>$search,'account'=>$search));
        $this->data['maxPage'] = ceil($this->data['total_items']/$this->pre);
        if( $page >= $this->data['maxPage'] ) $page = $this->data['maxPage']-1;
        if($page < 0) $page = 0;
        $this->data['url'] = site_url('admin/user/search?search=').$search.'&type='.$type.'&ed='.$ed.'&page=';
        $this->data['current_page'] = $page;
        $this->data['items_per_page'] = $this->pre;

        $this->data['lists'] = $this->User_model->getLists($this->pre,$page*$this->pre,array('nickname'=>$search,'account'=>$search),$where);

        $this->data['search'] = $search;
        $this->data['type'] = $type;
        $this->data['ed'] = $ed;

        $this->load->view('admin/user/list',$this->data);
    }

    public function show($id)
    {
        $id = intval($id);
        if( empty($id) ) redirect(site_url('admin/user'));

        //$this->load->model('User_model');
        $this->data['info'] = $this->Base_model->is_existed('sys_user',array('uid'=>$id));
        if( empty($this->data['info']) ) redirect(site_url('admin/user'));

        $this->load->view('admin/user/show',$this->data);
    }

    public function add($id)
    {
        $id = intval($id);
        if( empty($id) ) redirect(site_url('admin/user'));

        $this->data['info'] = $this->Base_model->is_existed('sys_user',array('uid'=>$id));
        if( empty($this->data['info']) ) redirect(site_url('admin/user'));

        $this->load->view('admin/user/add',$this->data);
    }

}