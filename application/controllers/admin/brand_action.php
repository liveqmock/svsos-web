<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand_action extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if( !iShow('b') )
        {
            echo json_encode(array('error'=>99,'msg'=>'无操作权限'));
            exit;
        }
    }

    public function edit()
    {
        $id = intval($this->input->post('id',true));
        $name = $this->input->post('name',true);
        $website = $this->input->post('website',true);
        $tel = $this->input->post('tel',true);
        $icon = $this->input->post('icon',true);
        $verify = intval($this->input->post('verify',true));
        $sort = intval($this->input->post('sort',true));

        if( empty($id) )
        {
            echo json_encode(array('error'=>99,'msg'=>'非法操作'));
            exit;
        }

        if(empty($name))
        {
            echo json_encode(array('error'=>99,'msg'=>'品牌名称不能为空'));
            exit;
        }

        if(empty($tel))
        {
            echo json_encode(array('error'=>99,'msg'=>'品牌电话不能为空'));
            exit;
        }

        $info = $this->Base_model->is_existed('brand',array('id'=>$id));
        if( empty($info) )
        {
            echo json_encode(array('error'=>99,'msg'=>'非法操作'));
            exit;
        }

        $upData = array(
            'name'          =>  $name,
            'tel'           =>  $tel,
            'website'       =>  $website,
            'icon'          =>  $icon,
            'verify'        =>  $verify,
            'sort'          =>  $sort,
        );

        $ret = $this->Base_model->update('brand',array('id'=>$id),$upData);
        if( $ret )
        {
            echo json_encode(array('error'=>0,'url'=>site_url('admin/brand')));
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'没有修改'));
        }
    }

    public function add()
    {
        $name = $this->input->post('name',true);
        $tel = $this->input->post('tel',true);
        $website = $this->input->post('website',true);
        $icon = $this->input->post('icon',true);
        $verify = intval($this->input->post('verify',true));

        if(empty($name))
        {
            echo json_encode(array('error'=>99,'msg'=>'品牌名称不能为空'));
            exit;
        }

        if(empty($tel))
        {
            echo json_encode(array('error'=>99,'msg'=>'品牌电话不能为空'));
            exit;
        }

        $data = array(
            'name'          =>  $name,
            'tel'           =>  $tel,
            'website'       =>  $website,
            'icon'          =>  $icon,
            'verify'        =>  $verify,
            'sort'          =>  $sort,
            'create_time'   =>  date('Y-m-d H:i:s',time()),
        );

        $ret = $this->Base_model->create('brand',$data);
        if( $ret )
        {
            echo json_encode(array('error'=>0,'url'=>site_url('admin/brand')));
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'添加品牌失败'));
        }
    }
}