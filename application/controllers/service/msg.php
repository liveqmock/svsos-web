<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msg extends MY_Controller
{
    private $data;
    private $pre;

    public function __construct()
    {
        parent::__construct();
        $this->data['menu'] = 'service';
        $this->data['sMenu'] = 'msg';
        $this->pre = 20;
        $this->data['userInfo'] = $this->Base_model->check_valid(true);
    }

    public function index($page = 1)
    {
        $page = (int)$page - 1;
        $this->data['total_items'] = $this->Base_model->where_count('notice',array('user_id'=>$this->data['userInfo']['id']));
        $this->data['maxPage'] = ceil($this->data['total_items']/$this->pre);
        if( $page >= $this->data['maxPage'] ) $page = $this->data['maxPage']-1;
        if($page < 0) $page = 0;
        $this->data['url'] = site_url('service/msg').'/';
        $this->data['current_page'] = $page;
        $this->data['items_per_page'] = $this->pre;

        $this->load->model('Notice_model');
        $this->data['lists'] = $this->Notice_model->getLists($this->data['userInfo']['id'],$this->pre,$page*$this->pre);

        $this->load->view('service/msg/list',$this->data);
    }

    public function info($id)
    {
        $id = intval($id);
        if( empty($id) ) redirect(site_url('service/msg'));

        $this->data['info'] = $this->Base_model->is_existed('notice',array('id'=>$id));
        if( empty($this->data['info']) || ($this->data['info']['user_id'] != $this->data['userInfo']['id']) )
        {
            redirect(site_url('service/msg'));
        }

        $this->Base_model->update('notice',array('id'=>$id),array('status'=>1));

        $this->load->view('service/msg/show',$this->data);
    }

}