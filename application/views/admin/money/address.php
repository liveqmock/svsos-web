<?php $this->load->view('admin/header');?>
<div id="content">
    <?php $this->load->view('admin/menu');?>
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
                        <td class="tl td_cont"><?php echo $info['order_id'];?></td>
                        <td class="tl td_bt">受理网点：</td>
                        <td class="tl td_cont"><?php echo $info['sp_name'];?></td>
                    </tr>
                    <tr class="bg">
                        <td class="tl td_bt">工单费用：</td>
                        <td class="tl td_cont"><?php echo $info['money'];?>元</td>
                        <td class="tl td_bt">结算状态：</td>
                        <td class="tl td_cont">
                            <?php if($info['pay_status'] == 2):?>
                                已结算
                            <?php else:?>
                                <select id="payStatus" style="height: 31px; width: 100px; padding: 5px 0px 0px 5px;">
                                    <option value="1">未结算</option>
                                    <option value="2">已结算</option>
                                </select>
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td class="tl td_bt">开 户 行 ：</td>
                        <td class="tl td_cont"><?php echo $info['bank_name'];?></td>
                        <td class="tl td_bt">开户地点：</td>
                        <td class="tl td_cont"><?php echo $address;?></td>
                    </tr>
                    <tr class="bg">
                        <td class="tl td_bt">开 户 名 ：</td>
                        <td class="tl td_cont"><?php echo $info['name'];?></td>
                        <td class="tl td_bt">帐&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：</td>
                        <td class="tl td_cont"><?php echo $info['no'];?></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <?php if($info['pay_status'] != 2):?>
                                <input type="button" value="确 定" name="loginsubmit" class="sub_4 submit">&nbsp;&nbsp;
                            <?php endif;?>
                            <a href="<?php echo site_url('admin/money');?>" class="sub_4">返   回</a>
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
            var payStatus = $("#payStatus").val();
            var order_id = <?php echo $info['orderId'];?>;

            $.post('<?php echo site_url('admin/money_action/payStatus');?>',
                {order_id:order_id,payStatus:payStatus},
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
