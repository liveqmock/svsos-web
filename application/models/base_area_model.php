<?php

if ( !defined('BASEPATH') )
    exit('No direct script access allowed');

class Base_area_model extends Base_model
{
    public function getName($proviceId,$cityId,$districtId)
    {
        $this->db->select('name');
        $this->db->where_in('id',array($proviceId,$cityId,$districtId));
        $this->db->order_by('cid','asc');
        $query = $this->db->get('base_area');
        if ($query->num_rows()>0)
        {
            $row = $query->result_array();
            $address = '';
            if( $row[0]['name'] == $row[1]['name'] )
            {
                $address = $row[1]['name'].'市'.$row[2]['name'];
            }
            else
            {
                $address = $row[0]['name'].'省'.$row[1]['name'].'市'.$row[2]['name'];
            }
            return $address;
        }
        else
        {
            return null;
        }
    }
}