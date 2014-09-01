<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filehandle
{
    private $ci;
    private $filename;
    private $upload;
    private $newname;

    public function __construct()
    {
        $this->ci = &get_instance();
    }


    public function upload_file($filename)
    {
        $this->filename = $filename;
        $this->newname = uuid(FALSE);
        $ret = $this->do_upload_file();
        return $ret;
    }

    public function do_upload_file()
    {
        $filePath = $this->getFilePath();
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'jpg|png|gif|jpeg';
        $config['max_size'] = '10240';
        $config['file_name'] = $this->newname;
        $this->ci->load->library( 'upload', $config );
        if ( $this->ci->upload->do_upload($this->filename) )
        {
            $updata = $this->ci->upload->data();
            if ( !empty($updata) )
            {
                $ret['client_name'] = $updata['client_name'];
                $ret['path'] = $filePath.$updata['orig_name'];
                return $ret;
            }
            else
            {
                return '图片处理异常';
            }
        }
        else
        {
            return $this->ci->upload->display_errors();
        }
    }

    public function getFilePath()
    {
        $firstFolder = substr($this->newname,0,1);
        $secondFolder = substr($this->newname,1,2);
        $lastFolder = substr($this->newname,3,2);
        $path = 'upload/' . $firstFolder . '/' . $secondFolder . '/' . $lastFolder. '/';

        if ( !file_exists($path) )
        {
            mkdir($path,0755,true);
        }
        return $path;
    }

}
