<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends MY_Controller {

    private $pre;
    private $data;

    public function __construct() {
        parent::__construct();

        $this->pre = 10;
        $this->data['menu'] = 'search';
    }

    public function index($page = 1) {
        $this->data['ip'] = $this->input->ip_address();
        if ($this->data['ip'] != '127.0.0.1') {
            $info = getLocationByIp($this->data['ip']);
            if (!empty($info) && ($info->ret != -1)) {
                $province = $info->province;
                $city = $info->city;
                $this->load->model('Service_point_model');
                $res = $this->Service_point_model->getCityId($province, $city);
                if (!empty($res)) {
                    foreach ($res as $v) {
                        switch ($v['cid']) {
                            case 0:
                                echo $v['id'];
                                exit;
                                $this->data['province'] = $v['id'];
                                break;
                            case 1:
                                $this->data['city'] = $v['id'];
                                break;
                        }
                    }
                }
            }
        }

        $where = array();
        if (!empty($this->data['province'])) {
            $where['province_id'] = $this->data['province'];
        }
        if (!empty($this->data['city'])) {
            $where['city_id'] = $this->data['city'];
        }

        $page = (int) $page - 1;
        $this->load->model('Service_point_model');
        $this->data['total_items'] = $this->Service_point_model->getSearchNum($where, '');
        $this->data['maxPage'] = ceil($this->data['total_items'] / $this->pre);
        if ($page >= $this->data['maxPage'])
            $page = $this->data['maxPage'] - 1;
        if ($page < 0)
            $page = 0;
        $this->data['url'] = site_url('welcome/index') . '/';
        $this->data['current_page'] = $page;
        $this->data['items_per_page'] = $this->pre;

        $this->load->model('Service_point_model');
        $this->data['lists'] = $this->Service_point_model->getLists($where, '', $this->pre, $page * $this->pre);

        $this->load->view('index', $this->data);
    }

    public function search() {
        $this->data['ip'] = $this->input->ip_address();
        if ($this->data['ip'] != '127.0.0.1') {
            $info = getLocationByIp($this->data['ip']);
            if (!empty($info) && ($info->ret != -1)) {
                $province = $info->province;
                $city = $info->city;
                $district = '';
                $this->load->model('Service_point_model');
                $res = $this->Service_point_model->getCityId($province, $city);
                if (!empty($res)) {
                    foreach ($res as $v) {
                        switch ($v['cid']) {
                            case 0:
                                $this->data['province'] = $v['id'];
                                break;
                            case 1:
                                $this->data['city'] = $v['id'];
                                break;
                        }
                    }
                }
            }
        }

        $sp = $this->input->get('sp', true);
        $province = intval($this->input->get('province'));
        $city = intval($this->input->get('city'));
        $district = intval($this->input->get('district'));

        if (($sp == '') && empty($province) && empty($city) && empty($district)) {
            redirect(site_url());
        }
        $where = array();
        $like = '';
        if ($sp != '') {
            $like = array('address' => $sp, 'sp_name' => $sp);
            //$this->data['province'] = $this->data['city'] = $this->data['district'] = '';
            if (($this->data['province'] == $province) && ( $this->data['city'] == $city) && ($district == '')) {
                $this->data['province'] = $province;
                $this->data['city'] = $city;
                $this->data['district'] = $district;
            } else {
                $this->data['province'] = $where['province_id'] = $province;
                $this->data['city'] = $where['city_id'] = $city;
                $this->data['district'] = $where['district_id'] = $district;
            }
        } else {
            $where = array();
            if (!empty($province))
                $this->data['province'] = $where['province_id'] = $province;
            if (!empty($city))
                $this->data['city'] = $where['city_id'] = $city;
            if (!empty($district))
                $this->data['district'] = $where['district_id'] = $district;
        }

        $page = $this->input->get('page', true);
        $page = (int) $page - 1;

        $this->load->model('Service_point_model');
        $this->data['total_items'] = $this->Service_point_model->getSearchNum($where, $like);
        $this->data['maxPage'] = ceil($this->data['total_items'] / $this->pre);
        if ($page >= $this->data['maxPage'])
            $page = $this->data['maxPage'] - 1;
        if ($page < 0)
            $page = 0;
        $this->data['url'] = site_url('welcome/searchSP') . '?sp=' . $sp . '&province=' . $province . '&city=' . $city . '&district=' . $district . '&page=';
        $this->data['current_page'] = $page;
        $this->data['items_per_page'] = $this->pre;

        $this->load->model('Service_point_model');
        $this->data['lists'] = $this->Service_point_model->getLists($where, $like, $this->pre, $page * $this->pre);
        $this->data['sp'] = $sp;


        $this->load->view('index', $this->data);
    }

    public function info($id) {
        $this->Base_model->check_valid(true);
        $id = intval($id);
        if (empty($id))
            redirect(site_url());

        $this->data['info'] = $this->Base_model->is_existed('sales_service_point', array('sp_id' => $id));
        if (empty($this->data['info']))
            redirect(site_url());

        $this->data['tags'] = '';
        if ($this->data['info']['product']) {
            $this->load->model('Base_product_category_model');
            $this->data['tags'] = $this->Base_product_category_model->getNamesByIdArr($this->data['info']['product']);
        }

        $this->data['history'] = $history = gCookie('history');
        if (empty($this->data['history']) || !in_array($this->data['info']['sp_id'], $history)) {
            $data[$this->data['info']['sp_id']] = array(
                'id' => $this->data['info']['sp_id'],
                'name' => $this->data['info']['sp_name'],
                'phone' => $this->data['info']['phone'],
                'cover' => $this->data['info']['cover'],
            );
            $history = $data + $history;
            if (count($history) > 3)
                array_pop($history);
            sCookie('history', $history);
        }

        $this->data['info']['count'] = $this->data['info']['count'] + 1;
        $this->Base_model->update_count('sales_service_point', array('sp_id' => $id));

        $this->load->view('sp_info', $this->data);
    }

    public function clear() {
        dCookie("history");
    }

}
