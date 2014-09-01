<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_action extends MY_Controller
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

    public function pwd()
    {
        $oPwd = $this->input->post('oPwd',true);
        $nPwd = $this->input->post('nPwd',true);
        $cPwd = $this->input->post('cPwd',true);

        if( empty($oPwd) )
        {
            echo json_encode(array('error'=>99,'msg'=>'旧密码不能为空'));
            exit;
        }

        if( empty($nPwd) || ($nPwd != $cPwd) )
        {
            echo json_encode(array('error'=>99,'msg'=>'新密码不能为空或不一致'));
            exit;
        }

        $info = $this->Base_model->is_existed('sys_user',array('uid'=>$this->userInfo['id']));
        if( $info['password'] != md5(md5($oPwd)) )
        {
            echo json_encode(array('error'=>99,'msg'=>'旧密码不正确'));
            exit;
        }

        $ret = $this->Base_model->update('sys_user',array('uid'=>$this->userInfo['id']),array('password'=>md5(md5($nPwd))));
        if( $ret )
        {
            $this->session->unset_userdata('userInfo');
            echo json_encode(array('error'=>0,'url'=>site_url('login')));
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'密码一致，无需修改'));
        }
    }

    public function account()
    {
        $account = $this->input->post('account',true);
        if( !check_email($account) )
        {
            echo json_encode(array('error'=>99,'msg'=>'邮箱格式不正确'));
            exit;
        }

        if( $account == $this->userInfo['account'] )
        {
            echo json_encode(array('error'=>99,'msg'=>'没有修改'));
            exit;
        }

        $ret = $this->Base_model->is_existed('sys_user',array('account'=>$account,'status'=>1));
        if( $ret )
        {
            echo json_encode(array('error'=>99,'msg'=>'此邮箱已存在，请重现更换一个邮箱'));
        }
        else
        {
            $re = $this->Base_model->update('sys_user',array('uid'=>$this->userInfo['id']),array('account'=>$account));
            if( $re )
            {
                $this->session->unset_userdata('userInfo');
                echo json_encode(array('error'=>0,'url'=>site_url('login')));
            }
            else
            {
                echo json_encode(array('error'=>99,'msg'=>'修改失败'));
            }
        }
    }

    public function address()
    {
        //province:province,city:city,hometown:hometown,bankName:bankName,name:name,no:no,remark:remark
        $province = intval($this->input->post('province',true));
        $city = intval($this->input->post('city',true));
        $hometown = intval($this->input->post('hometown',true));
        $bankName = $this->input->post('bankName',true);
        $name = $this->input->post('name',true);
        $no = $this->input->post('no',true);
        $remark = $this->input->post('remark',true);

        if(empty($province) || empty($city) || empty($hometown))
        {
            echo json_encode(array('error'=>99,'msg'=>'地址信息不完整'));
            exit;
        }

        if(empty($bankName))
        {
            echo json_encode(array('error'=>99,'msg'=>'开户行不能为空'));
            exit;
        }

        if(empty($name))
        {
            echo json_encode(array('error'=>99,'msg'=>'用户名不能为空'));
            exit;
        }

        if(empty($no))
        {
            echo json_encode(array('error'=>99,'msg'=>'帐号不能为空'));
            exit;
        }

        $info = $this->Base_model->is_existed('user_address',array('uid'=>$this->userInfo['id']));
        $data = array(
            'province_id'   =>  $province,
            'city_id'       =>  $city,
            'district_id'   =>  $hometown,
            'bank_name'     =>  $bankName,
            'name'          =>  $name,
            'no'            =>  $no,
            'remark'        =>  $remark,
        );
        if( $info )
        {
            $ret = $this->Base_model->update('user_address',array('uid'=>$this->userInfo['id']),$data);
            if( $ret )
            {
                echo json_encode(array('error'=>0));
            }
            else
            {
                echo json_encode(array('error'=>99,'msg'=>'数据无修改'));
            }
        }
        else
        {
            $data['uid'] = $this->userInfo['id'];
            $data['create_time'] = date('Y-m-d H:i:s',time());
            $ret = $this->Base_model->create('user_address',$data);
            if( $ret )
            {
                echo json_encode(array('error'=>0));
            }
            else
            {
                echo json_encode(array('error'=>99,'msg'=>'更新失败'));
            }
        }
    }

    public function detailInfo()
    {
        $name = $this->input->post('name',true);
        $sex = intval($this->input->post('sex',true));
        $phone = $this->input->post('phone',true);
        $tel = $this->input->post('tel',true);
        $email = $this->input->post('email',true);
        $companyName = $this->input->post('companyName',true);
        $address = $this->input->post('address',true);
        $code = $this->input->post('code',true);

        $upData = array(
            'nickname' => $name,
            'sex' => $sex,
            'phone' => $phone,
            'tel' => $tel,
            'email' => $email,
            'company_name' => $companyName,
            'address' => $address,
            'code' => $code
        );
        $ret = $this->Base_model->update('sys_user',array('uid'=>$this->userInfo['id']),$upData);
        if( $ret )
        {
            $this->userInfo['name'] = $name;
            $this->session->set_userdata('userInfo', $this->userInfo);
            echo json_encode(array('error' => 0));
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'无修改'));
        }
    }
}