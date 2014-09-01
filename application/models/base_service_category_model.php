<?php

if ( !defined('BASEPATH') )
    exit('No direct script access allowed');

class Base_service_category_model extends Base_model
{
    public function getLists($id = null)
    {
        $query = $this->db->get('base_service_category');
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