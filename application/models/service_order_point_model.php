<?php

if ( !defined('BASEPATH') )
    exit('No direct script access allowed');

class Service_order_point_model extends Base_model
{
    public function getLists($limit = 0, $offset = 0, $where = array())
    {
        $this->db->select('ss_service_order_point.money,ss_service_order.id,ss_service_order.order_id,ss_service_order.create_time,ss_service_order.pay_status,sys_user.nickname,ss_service_point.sp_name');
        $this->db->join('ss_service_order','ss_service_order_point.order_id = ss_service_order.id','left');
        $this->db->join('sales_service_point','ss_service_order_point.sp_id = ss_service_point.sp_id','left');
        $this->db->join('sys_user','ss_service_order_point.uid = sys_user.uid','left');
        if( !empty($where) ) $this->db->where($where);
        if( $limit )
        {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('ss_service_order.create_time','desc');
        $query = $this->db->get('ss_service_order_point');
        if ($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    public function getSearchNum($status)
    {
        $this->db->select('count(id) as num');
        $this->db->where(array('status >'=>1,'pay_status'=>$status));
        $query = $this->db->get('ss_service_order');
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

    public function getMineLists($sp_id, $limit = 0, $offset = 0)
    {
        $this->db->select('service_order.id,ss_service_order.order_id,ss_service_order.product_brand,ss_service_order.product_model,ss_service_order.product_sn,ss_service_order.status,ss_service_order.create_time,base_product_category.name as product_name,base_service_category.name as service_name');
        $this->db->join('ss_service_order','ss_service_order_point.order_id = ss_service_order.id','left');
        $this->db->join('base_product_category','ss_service_order.product_category = base_product_category.id','left');
        $this->db->join('base_service_category','ss_service_order.service_type = base_service_category.id','left');
        $this->db->where('ss_service_order_point.sp_id',$sp_id);
        if( $limit )
        {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('ss_service_order_point.create_time','desc');
        $query = $this->db->get('ss_service_order_point');
        if ($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    public function getExportLists($sp_id)
    {
        $this->db->select("ss_service_order.*,user1.nickname,user2.nickname as send_nickname,ss_service_order_point.money,sales_service_point.sp_name,sales_service_point.address as sp_address,sales_service_point.phone as sp_tel,sales_service_point.uid as sp_userId,base_product_category.name as product_name,base_service_category.name as service_name");
        $this->db->join('ss_service_order','ss_service_order.id=ss_service_order_point.order_id','left');
        $this->db->join('sys_user as user1','ss_service_order.uid=user1.uid','left');
        $this->db->join('sales_service_point','ss_service_order_point.sp_id=sales_service_point.sp_id','left');
        $this->db->join('sys_user as user2','ss_service_order_point.uid=user2.uid','left');
        $this->db->join('base_product_category','ss_service_order.product_category = base_product_category.id','left');
        $this->db->join('base_service_category','ss_service_order.service_type = base_service_category.id','left');
        $this->db->where('ss_service_order_point.sp_id',$sp_id);
        $query = $this->db->get('ss_service_order_point');
        if ($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    public function getPayAddress($orderId)
    {
        $this->db->select('ss_service_order_point.money,ss_service_order.order_id,ss_service_order.id as orderId,ss_service_order.pay_status,sales_service_point.sp_name,user_address.*');
        $this->db->join('ss_service_order','ss_service_order_point.order_id=ss_service_order.id','left');
        $this->db->join('sales_service_point','ss_service_order_point.sp_id=sales_service_point.sp_id','left');
        $this->db->join('user_address','sales_service_point.uid=user_address.uid','left');
        $this->db->where('ss_service_order_point.order_id',$orderId);
        $query = $this->db->get('ss_service_order_point');
        if ($query->num_rows()>0)
        {
            return $query->row_array();
        }
        else
        {
            return null;
        }
    }

    public function money($spId)
    {
        $this->db->select('ss_service_order_point.money,ss_service_order.pay_status');
        $this->db->join('ss_service_order','ss_service_order_point.order_id=ss_service_order.id','left');
        $this->db->where('ss_service_order_point.sp_id',$spId);
        $query = $this->db->get('ss_service_order_point');
        if ($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }
}