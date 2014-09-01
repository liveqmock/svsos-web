<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sp_action extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if( !iShow('c') )
        {
            echo json_encode(array('error'=>99,'msg'=>'无操作权限'));
            exit;
        }
    }

    public function edit()
    {
        $sp_id = intval($this->input->post('id',true));
        $sp_name = $this->input->post('sp_name',true);
        $phone = $this->input->post('phone',true);
        $status = intval($this->input->post('status',true));
        $verify = intval($this->input->post('verify',true));
        $product = isset($_POST['product']) ? $_POST['product'] : '';
        $intro = $this->input->post('intro',true);
        $address = $this->input->post('address',true);
        $lat = $this->input->post('lat',true);
        $lng = $this->input->post('lng',true);
        $province = $this->input->post('province',true);
        $city = $this->input->post('city',true);
        $district = $this->input->post('district',true);
        $cover = $this->input->post('cover',true);
        if( empty($sp_id) )
        {
            echo json_encode(array('error'=>99,'msg'=>'非法操作'));
            exit;
        }

        if(empty($sp_name))
        {
            echo json_encode(array('error'=>99,'msg'=>'网点名称不能为空'));
            exit;
        }

        if(empty($phone))
        {
            echo json_encode(array('error'=>99,'msg'=>'网点电话不能为空'));
            exit;
        }

        if(empty($address))
        {
            echo json_encode(array('error'=>99,'msg'=>'网点地址不能为空'));
            exit;
        }

        if(empty($lat) || empty($lng))
        {
            echo json_encode(array('error'=>99,'msg'=>'网点地址坐标不能为空，请先获取坐标'));
            exit;
        }

        if($product)
        {
            $this->load->model('Base_product_category_model');
            $product = $this->Base_product_category_model->getIdsByNameArr($product);
        }

        $info = $this->Base_model->is_existed('sales_service_point',array('sp_id'=>$sp_id));
        if( empty($info) )
        {
            echo json_encode(array('error'=>99,'msg'=>'非法操作'));
            exit;
        }

        if(!is_numeric($province) && !is_numeric($city) && !is_numeric($district))
        {
            $info = $this->Base_model->whereIn('base_area',array($province,$city,$district));
            $province = $info['name'][$province];
            $city = $info['name'][$city];
            $district = $info['name'][$district];
        }

        $upData = array(
            'sp_name'           =>  $sp_name,
            'phone'             =>  $phone,
            'intro'             =>  $intro,
            'lng_baidu'         =>  $lng,
            'lat_baidu'         =>  $lat,
            'product'           =>  $product,
            'status'            =>  $status,
            'verify'            =>  $verify,
            'province_id'       =>  $province,
            'city_id'           =>  $city,
            'district_id'       =>  $district,
            'address'           =>  $address,
            'cover'             =>  $cover,
        );

        $ret = $this->Base_model->update('sales_service_point',array('sp_id'=>$sp_id),$upData);
        if( $ret )
        {
            echo json_encode(array('error'=>0,'url'=>site_url('admin/sp')));
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'没有修改'));
        }
    }

    public function add()
    {
        $sp_name = $this->input->post('sp_name',true);
        $phone = $this->input->post('phone',true);
        $status = intval($this->input->post('status',true));
        $verify = intval($this->input->post('verify',true));
        $product = isset($_POST['product']) ? $_POST['product'] : '';
        $intro = $this->input->post('intro',true);
        $address = $this->input->post('address',true);
        $lat = $this->input->post('lat',true);
        $lng = $this->input->post('lng',true);
        $province = $this->input->post('province',true);
        $city = $this->input->post('city',true);
        $district = $this->input->post('district',true);
        $cover = $this->input->post('cover',true);

        if(empty($sp_name))
        {
            echo json_encode(array('error'=>99,'msg'=>'网点名称不能为空'));
            exit;
        }

        if(empty($phone))
        {
            echo json_encode(array('error'=>99,'msg'=>'网点电话不能为空'));
            exit;
        }

        if(empty($address))
        {
            echo json_encode(array('error'=>99,'msg'=>'网点地址不能为空'));
            exit;
        }

        if(empty($lat) || empty($lng))
        {
            echo json_encode(array('error'=>99,'msg'=>'网点地址坐标不能为空，请先获取坐标'));
            exit;
        }

        if($product)
        {
            $this->load->model('Base_product_category_model');
            $product = $this->Base_product_category_model->getIdsByNameArr($product);
        }

        $info = $this->Base_model->whereIn('base_area',array($province,$city,$district));
        $province = $info['name'][$province];
        $city = $info['name'][$city];
        $district = $info['name'][$district];

        $data = array(
            'sp_name'           =>  $sp_name,
            'phone'             =>  $phone,
            'intro'             =>  $intro,
            'lng_baidu'         =>  $lng,
            'lat_baidu'         =>  $lat,
            'product'           =>  $product,
            'status'            =>  $status,
            'verify'            =>  $verify,
            'province_id'       =>  $province,
            'city_id'           =>  $city,
            'district_id'       =>  $district,
            'address'           =>  $address,
            'cover'             =>  $cover,
            'createtime'        =>  date('Y-m-d H:i:s',time())
        );

        $ret = $this->Base_model->create('sales_service_point',$data);
        if( $ret )
        {
            echo json_encode(array('error'=>0,'url'=>site_url('admin/sp')));
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'添加网点失败'));
        }
    }

    public function del()
    {
        $id = intval($this->input->post('id',true));
        $info = $this->Base_model->is_existed('sales_service_point',array('sp_id'=>$id));
        if( empty($info) )
        {
            echo json_encode(array('error'=>99,'msg'=>'服务网点不存在'));
            exit;
        }

        if($info['user_id'])
        {
            $this->Base_model->update('sys_user',array('user_id'=>$info['user_id']),array('sp_id'=>'','user_type'=>1));
        }

        $ret = $this->Base_model->del('sales_service_point',array('sp_id'=>$id));
        if( $ret )
        {
            echo json_encode(array('error'=>0));
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'删除服务网点失败'));
        }
    }

    public function bind()
    {
        $id = intval($this->input->post('id',true));

        $create_time = date('Y-m-d H:i:s',time());
        $randId = $this->Base_model->create('get_rand_email',array('create_time'=>$create_time));
        if( empty($id) )
        {
            echo json_encode(array('error'=>99,'msg'=>'随机生成用户帐号失败'));
            exit;
        }
        $account = 'svsos'.$randId.'@svsos.com';
        $pwd = random_string('numeric', 6);
        $newUser = array(
            'account'   =>  $account,
            'password'  =>  md5(md5($pwd)),
            'nickname'  =>  '随售网',
            'sp_id'     =>  $id,
            'user_type' =>  2,
            'status'    =>  1,
            'create_time'   =>  $create_time,
        );
        $userId = $this->Base_model->create('sys_user',$newUser);
        if( $userId )
        {
            $this->Base_model->update('sales_service_point',array('sp_id'=>$id),array('user_id'=>$userId));
            $content = '服务网点已成功绑定用户！登录帐号：'.$account.' 密码：'.$pwd;
            echo json_encode(array('error'=>0,'msg'=>$content));
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'创建随机用户失败'));
        }
    }
}