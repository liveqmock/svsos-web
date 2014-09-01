<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb">
        <span class="icon">当前位置：</span>
        <a href="<?php echo site_url();?>">首页</a> &gt;
        <a href="<?php echo site_url('service/order');?>">我的服务</a> &gt;
        金额查看
    </div>
    <!--/ search_box-->
    <?php $this->load->view('service/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">金额查看</strong></h2>
            </div>
            <div class="cont mh400 pa15">
                <table class="table_data">
                    <tbody>
                    <tr class="bg">
                        <td class="tl td_bt">总计工单 ：</td>
                        <td class="tl td_cont"><?php echo $sumOrder;?></td>
                    </tr>
                    <tr>
                        <td class="tl td_bt">总计金额 ：</td>
                        <td class="tl td_cont"><?php echo $sumMoney;?>元</td>
                    </tr>
                    <tr class="bg">
                        <td class="tl td_bt">已支付金额：</td>
                        <td class="tl td_cont"><?php echo $payMoney;?>元</td>
                    </tr>
                    <tr>
                        <td class="tl td_bt">未支付金额：</td>
                        <td class="tl td_cont"><?php echo $noPayMoney;?>元</td>
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
<?php $this->load->view('footer');?>
