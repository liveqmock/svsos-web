<?php

if ( !defined('BASEPATH') )
    exit('No direct script access allowed');

class User_model extends Base_model
{
    public function getLists($limit = 0, $offset = 0, $orLike = null, $where = null)
    {
        if( !empty($where) ) $this->db->where($where);
        if( !empty($orLike) ) $this->db->or_like($orLike);
        if( $limit )
        {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('create_time','desc');
        $query = $this->db->get('sys_user');
        if ($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    public function getSearchCount($orLike = null, $where = null)
    {
        $this->db->select('count(uid) as num');
        if( !empty($where) ) $this->db->where($where);
        if( !empty($orLike) ) $this->db->or_like($orLike);
        $query = $this->db->get('sys_user');
        if ($query->num_rows()>0)
        {
            $row = $query->row_array();
            return $row['num'];
        }
        else
        {
            return null;
        }
    }
    
    public function getUserSnsByOpenId($openId){
        $this->db->where(array('open_id'=>$openId));
        $query = $this->db->get('sys_user_sns');
        if ($query->num_rows()>0)
        {
            return $query->row_array();
        }
        else
        {
            return null;
        }
    }
    
    public function getUserByOpenId($openId){
        $this->db->where(array('open_id'=>$openId));
        $query = $this->db->get('sys_user_sns');
        if ($query->num_rows()>0)
        {
           $row = $query->row_array();
           $uid = $row['uid'];
           $this->db->where(array('uid'=>$uid));
           $query = $this->db->get('sys_user');
           $row = $query->row_array();
           return $row;
        }
        return null;
    }
        
    public function updateUserSns($snsUser){
        $snsType = getSnsType($snsUser['via']);
        $data = array(
               'access_token' => $snsUser['access_token'],
               'expire_at' => $snsUser['expire_at'],
               'refresh_token' => $snsUser['refresh_token'],
               'update_time' => date('Y-m-d H:i:s',time())
            );
        return $this->update('sys_user_sns',array('open_id'=>$snsUser['uid']),$data);
        
    }
    
    public function saveUser($data){
        $this->db->trans_begin();
        $currtime = date('Y-m-d H:i:s',time());
        //插入用户主表信息
        $uid = $this->create('sys_user',$data);
        //插入用户附表信息
        $data = array('uid' =>$uid,
                      'avatar_url' => null,
                      'login_time' => $currtime,
                      'last_login_time' =>$currtime);
        $this->create('sys_user_info',$data);
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }
        return $uid;
    }
    
    public function saveUserBySns($snsUser){
        $this->db->trans_begin();
        $currtime = date('Y-m-d H:i:s',time());
        //插入用户主表信息
        $data = array('nickname' =>$snsUser['screen_name'],
                      'account' =>$snsUser['uid'],
                      'password' => md5($snsUser['uid']),
                      'create_time' => $currtime);
        
        $uid = $this->create('sys_user',$data);
        //插入用户附表信息
        $data = array('uid' =>$uid,
                      'avatar_url' =>$snsUser['image'],
                      'login_time' => $currtime,
                      'last_login_time' =>$currtime);
        $this->create('sys_user_info',$data);
        //插入sns表
        $data = array(
               'uid' => $uid,
               'open_id' =>$snsUser['uid'],
               'sns_type' => getSnsType($snsUser['via']),
               'access_token' => $snsUser['access_token'],
               'expire_at' => $snsUser['expire_at'],
               'refresh_token' => $snsUser['refresh_token'],
               'create_time' => $currtime,
               'update_time' => $currtime
        );
        $this->create('sys_user_sns',$data);
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }
        return array('uid'=>$uid,'account'=>$snsUser['uid'],'nickname'=>$snsUser['screen_name']);
    }

}