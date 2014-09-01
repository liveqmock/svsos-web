<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msg_action extends MY_Controller
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

    public function del()
    {
        $id = intval($this->input->post('id'));

        if( empty($id) )
        {
            echo json_encode(array('error'=>99,'msg'=>'非法操作'));
            exit;
        }

        $info = $this->Base_model->is_existed('notice',array('id'=>$id));
        if( empty($info) || ($info['user_id'] != $this->userInfo['id']) )
        {
            echo json_encode(array('error'=>99,'msg'=>'非法操作'));
            exit;
        }

        $ret = $this->Base_model->del('notice',array('id'=>$id));
        if( $ret )
        {
            echo json_encode(array('error'=>0));
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'删除失败'));
        }

    }
}