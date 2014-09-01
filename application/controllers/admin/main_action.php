<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_action extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if( !iShow('a') )
        {
            echo json_encode(array('error'=>99,'msg'=>'无操作权限'));
            exit;
        }
    }

    public function edit()
    {
        $id = intval($this->input->post('id',true));
        $sTime = $this->input->post('sTime',true);
        $eTime = $this->input->post('eTime',true);
        $client = $this->input->post('client',true);
        $service = intval($this->input->post('service',true));
        $brand = $this->input->post('brand',true);
        $pCate = intval($this->input->post('pCate',true));
        $pModel = $this->input->post('pModel',true);
        $pSN = $this->input->post('pSN',true);
        $name = $this->input->post('name',true);
        $tel = $this->input->post('tel',true);
        $address = $this->input->post('address',true);
        $lat = $this->input->post('lat',true);
        $lng = $this->input->post('lng',true);
        $remark = $this->input->post('remark',true);

        if( empty($id) )
        {
            echo json_encode(array('error'=>99,'msg'=>'非法操作'));
            exit;
        }

        if(empty($sTime))
        {
            echo json_encode(array('error'=>99,'msg'=>'报单日期不能为空'));
            exit;
        }

        if(empty($brand))
        {
            echo json_encode(array('error'=>99,'msg'=>'产品品牌不能为空'));
            exit;
        }

        if(empty($pSN))
        {
            echo json_encode(array('error'=>99,'msg'=>'产品型号不能为空'));
            exit;
        }

        if(empty($name))
        {
            echo json_encode(array('error'=>99,'msg'=>'用户姓名不能为空'));
            exit;
        }

        if(empty($tel))
        {
            echo json_encode(array('error'=>99,'msg'=>'联系电话不能为空'));
            exit;
        }

        if(empty($address))
        {
            echo json_encode(array('error'=>99,'msg'=>'联系地址不能为空'));
            exit;
        }

        if(empty($lat) || empty($lng))
        {
            echo json_encode(array('error'=>99,'msg'=>'联系地址坐标不能为空，请先获取坐标'));
            exit;
        }

        $info = $this->Base_model->is_existed('service_order',array('id'=>$id));
        if( empty($info) )
        {
            echo json_encode(array('error'=>99,'msg'=>'非法操作'));
            exit;
        }

        $upData = array(
            'start_time'        =>  $sTime,
            'end_time'          =>  $eTime,
            'client'            =>  $client,
            'service_type'      =>  $service,
            'product_brand'     =>  $brand,
            'product_category'  =>  $pCate,
            'product_model'     =>  $pModel,
            'product_sn'        =>  $pSN,
            'name'              =>  $name,
            'tel'               =>  $tel,
            'address'           =>  $address,
            'lat'               =>  $lat,
            'lng'               =>  $lng,
            'remark'            =>  $remark,
        );

        $ret = $this->Base_model->update('service_order',array('id'=>$id),$upData);
        if( $ret )
        {
            echo json_encode(array('error'=>0,'url'=>site_url('admin/main')));
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'没有修改'));
        }
    }

    public function add()
    {
        $userInfo = $this->Base_model->check_valid();
        $sp_id = intval($this->input->post('sp_id',true));
        $order_id = intval($this->input->post('order_id',true));
        $money = $this->input->post('money',true);
        $data = array(
            'order_id'      =>  $order_id,
            'sp_id'         =>  $sp_id,
            'money'         =>  $money,
            'uid'       =>  $userInfo['id'],
            'create_time'   =>  time(),
        );

        $spInfo = $this->Base_model->is_existed('sales_service_point',array('sp_id'=>$sp_id));
        if(empty($spInfo))
        {
            echo json_encode(array('error'=>99,'msg'=>'服务网点不存在'));
            exit;
        }

        $orderInfo = $this->Base_model->is_existed('service_order',array('id'=>$order_id));
        if(empty($orderInfo))
        {
            echo json_encode(array('error'=>99,'msg'=>'服务订单不存在'));
            exit;
        }

        $ret = $this->Base_model->create('service_order_point',$data);
        if( $ret )
        {
            $this->Base_model->update('service_order',array('id'=>$order_id),array('status'=>2));

            $crete_time = date('Y-m-d H:i:s',time());
            $this->Base_model->create('notice',array('uid'=>$orderInfo['uid'],'content'=>'您的服务订单已被受理，现在正在派单中。','create_time'=>$crete_time));
            if($spInfo['uid'])
            {
                $this->Base_model->create('notice',array('uid'=>$spInfo['uid'],'content'=>'您有新的服务订单，请尽快受理。','create_time'=>$crete_time));
            }

            echo json_encode(array('error'=>0,'url'=>site_url('admin/main')));
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'指定服务网点失败，请重试'));
        }
    }

    public function show()
    {
        $order_id = intval($this->input->post('order_id',true));
        $status = intval($this->input->post('status',true));
        $payStatus = intval($this->input->post('payStatus',true));

        $orderInfo = $this->Base_model->is_existed('service_order',array('id'=>$order_id));
        if(empty($orderInfo))
        {
            echo json_encode(array('error'=>99,'msg'=>'服务订单不存在'));
            exit;
        }

        $upDate = array(
            'status'        =>  $status,
            'pay_status'    =>  $payStatus,
        );

        $ret = $this->Base_model->update('service_order',array('id'=>$order_id),$upDate);
        if( $ret )
        {
            if($status == 3)
                $this->Base_model->create('notice',array('uid'=>$orderInfo['uid'],'content'=>'您的服务工单已派遣结束。感谢您的使用。','create_time'=>date('Y-m-d H:i:s',time())));            
        }
        
        echo json_encode(array('error'=>0,'url'=>site_url('admin/main')));
    }

    public function del()
    {
        $id = intval($this->input->post('id'));
        if( empty($id) )
        {
            echo json_encode(array('error'=>99,'msg'=>'非法操作'));
            exit;
        }

        $info = $this->Base_model->is_existed('service_order',array('id'=>$id));
        if( empty($info) )
        {
            echo json_encode(array('error'=>99,'msg'=>'非法操作'));
            exit;
        }

        $ret = $this->Base_model->del('service_order',array('id'=>$id));
        if( $ret )
        {
            echo json_encode(array('error'=>0));
        }
        else
        {
            echo json_encode(array('error'=>99,'msg'=>'删除失败'));
        }
    }

    public function export()
    {
        $this->load->model('Service_order_model');
        $lists = $this->Service_order_model->getExportLists();

        $this->load->library('PHPExcel');
        $this->phpexcel->getProperties()->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");

        $this->phpexcel->setActiveSheetIndex(0);
        $this->phpexcel->getActiveSheet()->setCellValue('A1', "序号")
            ->setCellValue('B1', "工单号")
            ->setCellValue('C1', "报单日期")
            ->setCellValue('D1', "要求日期")
            ->setCellValue('E1', "报单客户")
            ->setCellValue('F1', "报单员")
            ->setCellValue('G1', "产品品牌")
            ->setCellValue('H1', "产品类型")
            ->setCellValue('I1', "产品型号")
            ->setCellValue('J1', "序列号")
            ->setCellValue('K1', "服务类型")
            ->setCellValue('L1', "备注")
            ->setCellValue('M1', "客户姓名")
            ->setCellValue('N1', "联系电话")
            ->setCellValue('O1', "客户地址")
            ->setCellValue('P1', "服务网点")
            ->setCellValue('Q1', "网点电话")
            ->setCellValue('R1', "服务费用")
            ->setCellValue('S1', "网点地址")
            ->setCellValue('T1', "工单状态")
            ->setCellValue('U1', "派单员");

        $i = 1;
        foreach($lists as $v)
        {
            $status = getOrderStatus($v['status']);
            $i++;
            $this->phpexcel->getActiveSheet()->setCellValue('A' . $i, $i-1);
            $this->phpexcel->getActiveSheet()->setCellValue('B' . $i, "{$v['order_id']}");
            $this->phpexcel->getActiveSheet()->setCellValue('C' . $i, "{$v['start_time']}");
            $this->phpexcel->getActiveSheet()->setCellValue('D' . $i, "{$v['end_time']}");
            $this->phpexcel->getActiveSheet()->setCellValue('E' . $i, "{$v['client']}");
            $this->phpexcel->getActiveSheet()->setCellValue('F' . $i, "{$v['nickname']}");
            $this->phpexcel->getActiveSheet()->setCellValue('G' . $i, "{$v['product_brand']}");
            $this->phpexcel->getActiveSheet()->setCellValue('H' . $i, "{$v['product_name']}");
            $this->phpexcel->getActiveSheet()->setCellValue('I' . $i, "{$v['product_model']}");
            $this->phpexcel->getActiveSheet()->setCellValue('J' . $i, "{$v['product_sn']}");
            $this->phpexcel->getActiveSheet()->setCellValue('K' . $i, "{$v['service_name']}");
            $this->phpexcel->getActiveSheet()->setCellValue('L' . $i, "{$v['remark']}");
            $this->phpexcel->getActiveSheet()->setCellValue('M' . $i, "{$v['name']}");
            $this->phpexcel->getActiveSheet()->setCellValue('N' . $i, "{$v['tel']}");
            $this->phpexcel->getActiveSheet()->setCellValue('O' . $i, "{$v['address']}");
            $this->phpexcel->getActiveSheet()->setCellValue('P' . $i, "{$v['sp_name']}");
            $this->phpexcel->getActiveSheet()->setCellValue('Q' . $i, "{$v['sp_tel']}");
            $this->phpexcel->getActiveSheet()->setCellValue('R' . $i, "{$v['money']}");
            $this->phpexcel->getActiveSheet()->setCellValue('S' . $i, "{$v['sp_address']}");
            $this->phpexcel->getActiveSheet()->setCellValue('T' . $i, "{$status}");
            $this->phpexcel->getActiveSheet()->setCellValue('U' . $i, "{$v['send_nickname']}");

            if ($i % 10 == 0) {
                $this->phpexcel->getActiveSheet()->setBreak( 'A' . $i, PHPExcel_Worksheet::BREAK_ROW );
            }
        }
        $this->phpexcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
        $file = '/tmp/'.uuid(false).'.xlsx';
        $objWriter->save($file);

        $filename = '工单.xlsx';

        header("Content-type: application/vnd.ms-excel");

        //处理中文文件名
        $ua = $_SERVER["HTTP_USER_AGENT"];
        $encoded_filename = rawurlencode($filename);
        if (preg_match("/MSIE/", $ua)) {
            header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
        } else if (preg_match("/Firefox/", $ua)) {
            header("Content-Disposition: attachment; filename*=\"utf8''" . $filename . '"');
        } else {
            header('Content-Disposition: attachment; filename="' . $filename . '"');
        }

        header("Content-Length: ". filesize($file));
        readfile($file);
    }
}