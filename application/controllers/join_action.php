<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Join_action extends MY_Controller
{
    private $userInfo;

    public function __construct()
    {
        parent::__construct();
        $this->userInfo = $this->Base_model->check_valid();
        if( empty($this->userInfo) )
        {
            echo json_encode(array('error'=>99,'msg'=>'请先登录'));
            exit;
        }
    }

    public function index()
    {
        $name = $this->input->post('name',true);
        $tel = $this->input->post('tel',true);
        $address = $this->input->post('address',true);
        $lat = $this->input->post('lat',true);
        $lng = $this->input->post('lng',true);
        $province = $this->input->post('province',true);
        $city = $this->input->post('city',true);
        $hometown = $this->input->post('hometown',true);
        $qq = intval($this->input->post('qq',true));
        $product = $_POST['product'];

        if( empty($name) )
        {
            echo json_encode(array('error'=>99,'msg'=>'名称不能为空'));
            exit;
        }

        if( empty($tel) )
        {
            echo json_encode(array('error'=>99,'msg'=>'联系电话不能为空'));
            exit;
        }

        if( empty($address) )
        {
            echo json_encode(array('error'=>99,'msg'=>'地址不能为空'));
            exit;
        }

        if( empty($product) )
        {
            echo json_encode(array('error'=>99,'msg'=>'产品不能为空'));
            exit;
        }

        if( !validLatLng($lat,$lng) )
        {
            echo json_encode(array('error'=>99,'msg'=>'坐标不正确，请重新获取坐标'));
            exit;
        }

        $this->load->model('Base_product_category_model');
        $product = $this->Base_product_category_model->getIdsByNameArr($product);

        $this->load->model('Service_point_model');
        $res = $this->Service_point_model->getCityId($province,$city,$hometown);
        if( !empty($res) )
        {
            foreach($res as $v)
            {
                switch($v['cid'])
                {
                    case 0:
                        $provinceId = $v['id'];
                        break;
                    case 1:
                        $cityId = $v['id'];
                        break;
                    case 2:
                        $districtId = $v['id'];
                        break;
                }
            }
        }

        $data = array(
            'sp_name'       =>  $name,
            'province_id'   =>  $provinceId,
            'city_id'       =>  $cityId,
            'district_id'   =>  $districtId,
            'phone'         =>  $tel,
            'address'       =>  $address,
            'lng_baidu'     =>  $lng,
            'lat_baidu'     =>  $lat,
            'createtime'    =>  date('Y-m-d H:i:s',time()),
            'qq'            =>  $qq,
            'status'        =>  1,
            'verify'        =>  1,
            'product'       =>  $product,
            'user_id'       =>  $this->userInfo['id'],
        );
        $spId = $this->Base_model->create('sales_service_point',$data);
        if( $spId )
        {
            $this->Base_model->update('sys_user',array('user_id'=>$this->userInfo['id']),array('sp_id'=>$spId,'user_type'=>2));
            $this->userInfo['sp_id'] = $spId;
            $this->session->set_userdata('userInfo', $this->userInfo);
            echo json_encode(array('error'=>0,'url'=>site_url()));
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'加盟失败，请重试！'));
        }
    }
}