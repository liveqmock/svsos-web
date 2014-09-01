<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends MY_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->data['menu'] = 'service';
        $this->data['sMenu'] = 'service';
        $this->data['userInfo'] = $this->Base_model->check_valid(true);
        if($this->data['userInfo']['type'] == 2) redirect(site_url());
    }

    public function index()
    {
        $this->load->model('Base_service_category_model');
        $this->data['serviceCategory'] = $this->Base_service_category_model->getLists();
        $this->load->model('Base_product_category_model');
        $this->data['productCategory'] = $this->Base_product_category_model->getLists();
        $this->load->view('service/service',$this->data);
    }

}