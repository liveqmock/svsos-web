<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb">
        <span class="icon">当前位置：</span>
        <a href="<?php echo site_url();?>">首页</a> &gt;
        <a href="<?php echo site_url('service/order');?>">我的服务</a> &gt;
        查看服务工单
    </div>
    <?php $this->load->view('service/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">工单详情</strong></h2>
            </div>
            <div class="cont mh400 pa15">
                <table class="table_data">
                    <tbody>
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
                        <td class="tl td_cont"><?php echo $info['address'];?></td>
                        <td class="tl td_bt">工单状态：</td>
                        <td class="tl td_cont">
                            <?php if($info['status'] == 3):?>
                                派单完成
                            <?php else:?>
                                <select id="status" style="height: 31px; width: 100px; padding: 5px 0px 0px 5px;">
                                    <option value="2" selected="selected">派单中</option>
                                    <option value="3">派单完成</option>
                                </select>
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr class="bg">
                        <td colspan="4">
                            <?php if(($info['status'] != 3) || ($info['pay_status'] != 2)):?>
                                <input type="button" value="确 定" name="loginsubmit" class="sub_4 submit">&nbsp;&nbsp;
                            <?php endif;?>
                            <a href="<?php echo site_url('service/order');?>" class="sub_4">返   回</a>
                        </td>
                    </tr>
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
            var status = $("#status").val();
            var order_id = <?php echo $info['id'];?>;

            $.post('<?php echo site_url('service/order_action/changeStatus');?>',
                {status:status,order_id:order_id},
                function(data)
                {
                    if(data.error == 0)
                    {
                        easyDialog.open({
                            container : {
                                content : '操作成功。'
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
