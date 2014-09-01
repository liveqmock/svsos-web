<?php

if ( !defined('BASEPATH') )
    exit('No direct script access allowed');

class Service_point_model extends Base_model
{
    public function getLists($where, $like = null, $limit = 0, $offset = 0)
    {
        if( !empty($where) ) $this->db->where($where);
        if( !empty($like) ) $this->db->or_like($like);
        if( $limit )
        {
            $this->db->limit($limit, $offset);
        }
        $this->db->where('status',2);
        $query = $this->db->get('ss_service_point');
        if ($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    public function getSearchNum($where,$like)
    {
        $this->db->select('count(sp_id) as num');
        if( !empty($where) )
            $this->db->where($where);
        if ( !empty($like) )
            $this->db->or_like($like);
        $this->db->where('status',2);
        $query = $this->db->get('ss_service_point');
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

    public function getCityId($province = null,$city = null,$hometown = null)
    {
        $this->db->select('id,cid');
        if(!empty($province)) $this->db->or_where('name',$province);
        if(!empty($city)) $this->db->or_where('name',$city);
        if(!empty($hometown)) $this->db->or_where('name',$hometown);
        $query = $this->db->get('base_area');
        if ($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    public function getDistance($lat, $lng)
    {
        $squares = returnSquarePoint($lng, $lat);
        $sql = "select *,((ACOS(SIN($lat * PI() / 180) * SIN(`lat_baidu` * PI() / 180) + COS($lat * PI() / 180) * COS(`lat_baidu` * PI() / 180) * COS(($lng-`lng_baidu`) * PI() / 180)) * 180 / PI()) * 111.18957696) AS distance from `ss_service_point` where lat_baidu<>0 and lat_baidu>{$squares['right-bottom']['lat']} and lat_baidu<{$squares['left-top']['lat']} and lng_baidu>{$squares['left-top']['lng']} and lng_baidu<{$squares['right-bottom']['lng']} and status = 2 order by distance asc limit 10";
        $query = $this->db->query($sql);
        if ($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    public function getAdminLists($limit = 0, $offset = 0, $where = null,$like = null)
    {
        if( !empty($where) ) $this->db->where($where);
        if( !empty($like) ) $this->db->or_like($like);
        if( $limit )
        {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('createtime','desc');
        $query = $this->db->get('ss_service_point');
        if ($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    public function getAdminSearchNum($like)
    {
        $this->db->select('count(sp_id) as num');
        if ( !empty($like) )
            $this->db->or_like($like);
        $query = $this->db->get('ss_service_point');
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

    public function getInfoById($id)
    {
        $this->db->select('ss_service_point.*,sys_user.account,sys_user.nickname,sys_user.phone as tel');
        $this->db->join('sys_user','ss_service_point.user_id = sys_user.user_id','left');
        $query = $this->db->get_where('ss_service_point', array('ss_service_point.sp_id'=>$id), 1);
        if ( $query->num_rows() == 1 )
        {
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }
}