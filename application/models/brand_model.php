<?php

if ( !defined('BASEPATH') )
    exit('No direct script access allowed');

class Brand_model extends Base_model
{
    public function getLists($limit = 0, $offset = 0, $like = array())
    {
        if ( !empty($like) )
            $this->db->or_like($like);
        if( $limit )
            $this->db->limit($limit, $offset);
        //if($status) $this->db->where('status',2);
        $this->db->order_by('verify desc,sort desc,create_time desc');
        $query = $this->db->get('ss_brand_customers');
        if ($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    public function getAdminLists($limit = 0, $offset = 0, $like = array())
    {
        if ( !empty($like) )
            $this->db->or_like($like);
        if( $limit )
            $this->db->limit($limit, $offset);
        //if($status) $this->db->where('status',2);
        $this->db->order_by('create_time', 'desc');
        $query = $this->db->get('ss_brand_customers');
        if ($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    public function getSearchNum($like)
    {
        $this->db->select('count(id) as num');
        if ( !empty($like) )
            $this->db->or_like($like);
        //if($status) $this->db->where('status',2);
        $query = $this->db->get('ss_brand_customers');
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
}