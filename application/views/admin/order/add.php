<?php $this->load->view('admin/header');?>
<div id="content">
    <?php $this->load->view('admin/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">添加服务网点</strong></h2>
            </div>
            <div class="cont mh400 pa15">
                <table class="table_data">
                    <tbody>
                    <tr>
                        <th colspan="4" class="th_bt">工单详情</th>
                    </tr>
                    <tr>
                        <td class="tl td_bt">工单编号：</td>
                        <td class="tl td_cont" colspan="3"><?php echo $info['order_id'];?></td>
                    </tr>
                    <tr class="bg">
                        <td class="tl td_bt">报单日期：</td>
                        <td class="tl td_cont"><?php echo $info['start_time'];?></td>
                        <td class="tl td_bt">要求日期：</td>
                        <td class="tl td_cont"><?php echo $info['end_time'];?></td>
                    </tr>
                    <tr>
                        <td class="tl td_bt">报单客户：</td>
                        <td class="tl td_cont"><?php echo $info['client'];?></td>
                        <td class="tl td_bt">报 单&nbsp;员 ：</td>
                        <td class="tl td_cont"><?php echo $info['nickname'];?></td>
                    </tr>
                    <tr class="bg">
                        <td class="tl td_bt">产品品牌：</td>
                        <td class="tl td_cont"><?php echo $info['product_brand'];?></td>
                        <td class="tl td_bt">产品类型：</td>
                        <td class="tl td_cont"><?php echo $info['product_name'];?></td>
                    </tr>
                    <tr>
                        <td class="tl td_bt">产品型号：</td>
                        <td class="tl td_cont"><?php echo $info['product_model'];?></td>
                        <td class="tl td_bt">序 列 号 ：</td>
                        <td class="tl td_cont"><?php echo $info['product_sn'];?></td>
                    </tr>
                    <tr class="bg">
                        <td class="tl td_bt">服务类型：</td>
                        <td class="tl td_cont"><?php echo $info['service_name'];?></td>
                        <td class="tl td_bt">备&nbsp; &nbsp; &nbsp;注 ：</td>
                        <td class="tl td_cont"><a title="<?php echo $info['remark'];?>" style="cursor: pointer;"><?php echo mySubStr($info['remark'],25);?></a></td>
                    </tr>
                    <tr>
                        <td class="tl td_bt">客户姓名：</td>
                        <td class="tl td_cont"><?php echo $info['name'];?></td>
                        <td class="tl td_bt">联系电话：</td>
                        <td class="tl td_cont"><?php echo $info['tel'];?></td>
                    </tr>
                    <tr class="bg">
                        <td class="tl td_bt">客户地址：</td>
                        <td class="tl td_cont" colspan="3"><?php echo $info['address'];?></td>
                    </tr>
                    </tbody>
                </table>
                <br /><br />
                <table class="table_data">
                    <tbody>
                    <tr>
                        <th colspan="8" class="th_bt">网点列表</th>
                    </tr>
                    <tr>
                        <th>网点名称</th>
                        <th>网点电话</th>
                        <th>网点地址</th>
                        <th>距离工单</th>
                        <th>合作伙伴</th>
                        <th>审核</th>
                        <th>服务费用(元)</th>
                        <th>选择网点</th>
                    </tr>
                    <?php
                    if(!empty($lists)):
                        $check = 'checked';
                        foreach($lists as $v):
                            $partner = ($v['verify'] == 2) ? '是' : '否';
                            $status = ($v['status'] == 2) ? '已审核' : '未审核';
                            $distance = ($v['distance'] > 1) ? round($v['distance'],1).'公里' : round($v['distance']*1000).'米';
                    ?>
                    <tr>
                        <td class="tl"><?php echo ($v['status'] == 2) ? "<b>{$v['sp_name']}</b>" : $v['sp_name'];?></td>
                        <td class="tl"><?php echo $v['phone'];?></td>
                        <td class="tl"><a title="<?php echo $v['address'];?>" style="cursor: pointer;"><?php echo mySubStr($v['address'],20);?></a></td>
                        <td class="tl"><?php echo '大约'.$distance;?></td>
                        <td class="tl"><?php echo $partner;?></td>
                        <td class="tl"><?php echo $status;?></td>
                        <td><input type="text" value="" name="money" id="<?php echo $v['sp_id'];?>" style="width: 50px;height: 20px;"/></td>
                        <td><input type="radio" value="<?php echo $v['sp_id'];?>" name="sp_id" <?php echo $check;?> class="sp_id"/></td>
                    </tr>
                    <?php
                            $check = '';
                        endforeach;
                    ?>
                    <tr>
                        <td colspan="5">
                            <input type="button" value="确认选择" name="loginsubmit" class="sub_4 submit">&nbsp;&nbsp;
                            <a href="<?php echo site_url('admin/main');?>" class="sub_4">返   回</a>
                        </td>
                    </tr>
                    <?php
                    else:
                        echo '<tr><td colspan="5">抱歉，方圆10公里暂无服务网点</td></tr>';
                    endif;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ ui_box2-->
    </div>
    <!--/ w800-->
    <div class="clear"></div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(".submit").click(function(){
            var sp_id = $(".sp_id:checked").val();
            var order_id = <?php echo $info['id'];?>;
            var money = $("#"+sp_id).val();
            if(!$.validate(money))
            {
                easyDialog.open({
                    container : {
                        content : '当前选择网点的费用未填写或有误'
                    },
                    autoClose : 2000
                });
                return false;
            }

            $.post('<?php echo site_url('admin/main_action/add');?>',
                {sp_id:sp_id,order_id:order_id,money:money},
                function(data)
                {
                    if(data.error == 0)
                    {
                        easyDialog.open({
                            container : {
                                content : '服务网点指定成功。'
                            },
                            autoClose : 2000
                        });
                        setTimeout("window.location.href='"+data.url+"'",1000);
                    }
                    else
                    {
                        easyDialog.open({
                            container : {
                                content : data.msg
                            },
                            autoClose : 2000
                        });
                    }
                },'json'
            );
        });
    })
</script>
