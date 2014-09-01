<?php

if ( !defined('BASEPATH') )
    exit('No direct script access allowed');

class Base_model extends CI_Model
{

    public function is_existed( $table, $where )
    {
        $query = $this->db->get_where($table, $where, 1);
        if ( $query->num_rows() == 1 )
        {
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function whereIn( $table, $where, $filed = 'name')
    {
        $this->db->select('id,name');
        $this->db->where_in($filed, $where);
        $query = $this->db->get($table);
        if ( $query->num_rows() > 0 )
        {
            $row = $query->result_array();
            foreach($row as $v)
            {
                $rows['name'][$v['name']] = $v['id'];
                $rows['id'][$v['id']] = $v['name'];
            }
            return $rows;
        }
        else
        {
            return false;
        }
    }

    public function create( $table, $data )
    {
        $this->db->insert($table, $data);
        if ( $this->db->affected_rows() == 1 )
        {
            $id = $this->db->insert_id();
            if ( $id )
            {
                return $id;
            }
            else
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }

    public function del( $table, $where )
    {
        $this->db->delete($table, $where);
        if ( $this->db->affected_rows() > 0 )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function batchDel($table, $wherein)
    {
        $this->db->where_in('id',$wherein);
        $this->db->delete($table);

        if ( $this->db->affected_rows() > 0 )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function update( $table, $where, $data )
    {
        $this->db->where($where);
        $this->db->update($table, $data);
        if ( $this->db->affected_rows() == 1 )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function update_count( $table, $where, $filed = 'count', $add = '+1' )
    {
        $this->db->where($where);
        $this->db->set("$filed", "$filed$add", false);
        $this->db->update($table);
        if ( $this->db->affected_rows() == 1 )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function count( $table, $filed = 'id' )
    {
        return $this->db->count_all($table, $filed);
    }

    public function where_count($table,$where)
    {
        $this->db->select('count(id) as num');
        $query = $this->db->get_where($table,$where);
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

    public function execute( $sql )
    {
        $this->db->query($sql);
        if ( $this->db->affected_rows() == 1 )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function check_valid( $redirectIndex = FALSE )
    {
        $userInfo = $this->session->userdata('userInfo');
        if( !empty($userInfo) )
        {
            return $userInfo;
        }
        else
        {
            return $redirectIndex ? redirect(site_url('login')) : '';
        }
    }

    public function captcha($return = false)
    {
        $this->load->helper ( 'captcha' );
        $vals = array (
            'word' => random_string('numeric', 4),
            'font_path' => './assets/msyh.ttf',
            'img_path' => './captcha/',
            'img_url' => site_url('captcha').'/',
            'img_width' => 100,
            'img_height' => 32,
            'expiration' => 3600
        );
        $cap = create_captcha( $vals );
        $this->session->set_userdata ( 'captcha', $cap['word'] );

        if( $return )
        {
            return $cap['image'];
        }
        else
        {
            echo json_encode(array('captcha'=>$cap['image']));
        }

    }

}
