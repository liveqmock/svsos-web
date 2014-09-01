<?php

if ( !defined('BASEPATH') )
    exit('No direct script access allowed');

class Service_order_model extends Base_model
{
    public function getLists($where, $limit = 0, $offset = 0)
    {
        $this->db->select('ss_service_order.id,ss_service_order.order_id,ss_service_order.product_brand,ss_service_order.product_model,ss_service_order.product_sn,ss_service_order.status,ss_service_order.create_time,base_product_category.name as product_name,base_service_category.name as service_name');
        $this->db->join('base_product_category','ss_service_order.product_category = base_product_category.id','left');
        $this->db->join('base_service_category','ss_service_order.service_type = base_service_category.id','left');
        if( !empty($where) ) $this->db->where($where);
        if( $limit )
        {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('ss_service_order.create_time','desc');
        $query = $this->db->get('ss_service_order');
        if ($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    public function getInfoById($id)
    {
        $this->db->select("ss_service_order.*,user1.nickname,user2.nickname as send_nickname,ss_service_order_point.money,sales_service_point.sp_name,sales_service_point.address as sp_address,sales_service_point.phone as sp_tel,sales_service_point.uid as sp_userId,base_product_category.name as product_name,base_service_category.name as service_name");
        $this->db->join('sys_user as user1','ss_service_order.uid=user1.uid','left');
        $this->db->join('ss_service_order_point','ss_service_order.id=ss_service_order_point.order_id','left');
        $this->db->join('sales_service_point','ss_service_order_point.sp_id=sales_service_point.sp_id','left');
        $this->db->join('sys_user as user2','ss_service_order_point.uid=user2.uid','left');
        $this->db->join('base_product_category','ss_service_order.product_category = base_product_category.id','left');
        $this->db->join('base_service_category','ss_service_order.service_type = base_service_category.id','left');
        $this->db->where('ss_service_order.id',$id);
        $query = $this->db->get('ss_service_order');
        if ($query->num_rows()>0)
        {
            return $query->row_array();
        }
        else
        {
            return null;
        }
    }

    public function getExportLists($userId = '')
    {
        $this->db->select("ss_service_order.*,user1.nickname,user2.nickname as send_nickname,ss_service_order_point.money,sales_service_point.sp_name,sales_service_point.address as sp_address,sales_service_point.phone as sp_tel,sales_service_point.uid as sp_userId,base_product_category.name as product_name,base_service_category.name as service_name");
        $this->db->join('sys_user as user1','ss_service_order.uid=user1.uid','left');
        $this->db->join('ss_service_order_point','ss_service_order.id=ss_service_order_point.order_id','left');
        $this->db->join('sales_service_point','ss_service_order_point.sp_id=sales_service_point.sp_id','left');
        $this->db->join('sys_user as user2','ss_service_order_point.uid=user2.uid','left');
        $this->db->join('base_product_category','ss_service_order.product_category = base_product_category.id','left');
        $this->db->join('base_service_category','ss_service_order.service_type = base_service_category.id','left');
        if(!empty($userId))
            $this->db->where('ss_service_order.uid',$userId);
        $query = $this->db->get('ss_service_order');
        if ($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    public function isPoint($id)
    {
        $this->db->select("ss_service_order.*,ss_service_order_point.sp_id");
        $this->db->join('ss_service_order_point','ss_service_order.id=ss_service_order_point.order_id','left');
        $this->db->where('ss_service_order.id',$id);
        $query = $this->db->get('ss_service_order');
        if ($query->num_rows()>0)
        {
            return $query->row_array();
        }
        else
        {
            return null;
        }
    }
}