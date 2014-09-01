<?php

if ( !defined('BASEPATH') )
    exit('No direct script access allowed');

class Base_product_category_model extends Base_model
{
    public function getLists()
    {
        $query = $this->db->get('base_product_category');
        if ($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    public function getNamesByIdArr($ids,$json = false)
    {
        $idArr = explode(',',$ids);
        $this->db->select('name');
        $this->db->where_in('id',$idArr);
        $query = $this->db->get('base_product_category');
        if ($query->num_rows()>0)
        {
            if( $json )
            {
                $names = '[';
                foreach($query->result_array() as $v)
                {
                    $names .= "'".$v['name']."',";
                }
                $names = chop($names,',');
                $names .= ']';
                return $names;
            }
            else
            {
                $names = '';
                foreach($query->result_array() as $v)
                {
                    $names .= $v['name'].'、';
                }
                $names = chop($names,'、');
                return $names;
            }
        }
        else
        {
            return null;
        }
    }

    public function getIdsByNameArr($nameArr)
    {
        $this->db->select('id');
        $this->db->where_in('name',$nameArr);
        $query = $this->db->get('base_product_category');
        if ($query->num_rows()>0)
        {
            $ids = '';
            foreach($query->result_array() as $v)
            {
                $ids .= $v['id'].',';
            }
            $ids = chop($ids,',');
            return $ids;
        }
        else
        {
            return null;
        }
    }
}