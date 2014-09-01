<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_action extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if( !iShow('d') )
        {
            echo json_encode(array('error'=>99,'msg'=>'无操作权限'));
            exit;
        }
    }

    public function resetPwd()
    {
        $id = intval($this->input->post('id',true));
        if( empty($id) )
        {
            echo json_encode(array('error'=>99,'msg'=>'非法参数'));
            exit;
        }

        $pwd = random_string('numeric', 6);
        $ret = $this->Base_model->update('sys_user',array('uid'=>$id),array('password'=>md5(md5($pwd))));
        if( $ret )
        {
            echo json_encode(array('error'=>0,'msg'=>"重置密码成功，密码更改为：{$pwd}"));
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'密码重置失败'));
        }
    }

    public function role()
    {
        $role = $this->input->post('role');
        $id = intval($this->input->post('id'));
        $ed = intval($this->input->post('ed'));

        $ret = $this->Base_model->update('sys_user',array('uid'=>$id),array('role'=>$role,'ed'=>$ed));
        if( $ret )
        {
            echo json_encode(array('error'=>0,'url'=>site_url('admin/user')));
        }
        else
        {
            echo json_encode(array('error'=>1,'msg'=>'内容一致，无需修改！'));
        }
    }
}