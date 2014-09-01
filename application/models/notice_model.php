<?php

if ( !defined('BASEPATH') )
    exit('No direct script access allowed');

class Notice_model extends Base_model
{
    public function getLists($userId, $limit = 0, $offset = 0)
    {
        if( $limit )
            $this->db->limit($limit, $offset);
        $this->db->where('user_id',$userId);
        $this->db->order_by('status asc,create_time desc');
        $query = $this->db->get('notice');
        if ($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    public function getNum($userId)
    {
        $this->db->select('count(id) as num');
        $this->db->where(array('user_id'=>$userId,'status'=>0));
        $query = $this->db->get('notice');
        if ( $query->num_rows() > 0 )
        {
            $row = $query->row_array();
            return $row['num'];
        }
        else
        {
            return 0;
        }
    }
}