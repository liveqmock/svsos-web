<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb">
        <span class="icon">当前位置：</span>
        <a href="<?php echo site_url();?>">首页</a> &gt;
        <a href="<?php echo site_url('service/order');?>">我的服务</a> &gt;
        委派我的工单
    </div>
    <!--/ search_box-->
    <?php $this->load->view('service/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">工单列表</strong></h2>
            </div>
            <!--/ title-->

            <div class="cont mh400 pa15">
                <?php if(!empty($lists)):?>
                <div class="mb15">
                    <a href="<?php echo site_url('service/order_action/export');?>" class="sub_4 fr" style="margin-bottom: 10px;">导出Excel</a>
                </div>
                <?php endif;?>
                <!--/ m_tips-->
                <table class="table_data">
                    <tbody>
                    <tr>
                        <th class="tl">工单号</th>
                        <th>品牌</th>
                        <th>型号</th>
                        <th>序列号</th>
                        <th>服务类型</th>
                        <th>产品类型</th>
                        <th>工单操作</th>
                    </tr>
                    <?php
                    if(!empty($lists)):
                        $i = 0;
                        foreach($lists as $v):
                            $class = ($i%2 == 0) ? '' : 'class="bg"';
                            ?>
                            <tr <?php echo $class;?>>
                                <td class="tl"><a href="<?php echo site_url("service/order/show/{$v['id']}");?>" title="查看"><?php echo $v['order_id'];?></a></td>
                                <td><?php echo $v['product_brand'];?></td>
                                <td><?php echo $v['product_model'];?></td>
                                <td><?php echo $v['product_sn'];?></td>
                                <td><?php echo $v['service_name'];?></td>
                                <td><?php echo $v['product_name'];?></td>
                                <td>
                                    <a href="<?php echo site_url("service/order/show/{$v['id']}");?>" title="查看"><img alt="查看" src="<?php echo site_url('assets/images/view.png');?>"/></a>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        endforeach;
                    else:
                        echo '<td colspan="8">抱歉，您的维修点暂未收到工单。</td>';
                    endif;
                    ?>
                    </tbody>
                </table>
                <div class="page mt20 tr">
                    <?php echo $this->load->view('pagination');?>
                </div>
                <!--/ page-->
            </div>
            <!--/ cont-->
        </div>
        <!--/ ui_box2-->
    </div>
    <!--/ w800-->
    <div class="clear"></div>
</div>
<?php $this->load->view('footer');?>