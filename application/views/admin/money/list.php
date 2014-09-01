<?php $this->load->view('admin/header');?>
<div id="content">
    <?php $this->load->view('admin/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">金额明细</strong></h2>
            </div>
            <!--/ title-->
            <div class="cont mh400 pa15">
                <div class="mb15">
                    <form action="<?php echo site_url('admin/money/search');?>">
                        <select name="status" style="height: 31px;width: 100px;padding: 5px 0px 0px 5px;">
                            <option value="0">全部</option>
                            <option value="1" <?php echo (isset($status) && ($status == 1)) ? 'selected' : '';?>>未结算</option>
                            <option value="2" <?php echo (isset($status) && ($status == 2)) ? 'selected' : '';?>>已结算</option>
                        </select>
                        <input type="submit" value="查 询" class="sub_4">
                    </form>
                </div>
                <!--/ m_tips-->
                <table class="table_data">
                    <tbody>
                    <tr>
                        <th>工单号</th>
                        <th>受理网点</th>
                        <th>派单员</th>
                        <th>工单费用(元)</th>
                        <th>结算状态</th>
                        <th>工单时间</th>
                        <th>工单操作</th>
                    </tr>
                    <?php
                    if(!empty($lists)):
                        $i = 0;
                        foreach($lists as $v):
                            $class = ($i%2 == 0) ? '' : 'class="bg"';
                            $pay = ($v['pay_status'] == 1) ? '未结算' : '已结算';
                    ?>
                            <tr <?php echo $class;?>>
                                <td class="tl"><?php echo $v['order_id'];?></td>
                                <td class="tl"><?php echo $v['sp_name'];?></td>
                                <td><?php echo $v['nickname'];?></td>
                                <td><?php echo $v['money'];?></td>
                                <td><?php echo $pay;?></td>
                                <td><?php echo date('Y-m-d',$v['create_time']);?></td>
                                <td>
                                    <a target="_blank" href="<?php echo site_url("admin/main/show/{$v['id']}");?>" title="查看"><img alt="查看" src="<?php echo site_url('assets/images/view.png');?>"/></a>
                                    <a href="<?php echo site_url("admin/money/address/{$v['id']}");?>" title="付款地址"><img alt="付款地址" src="<?php echo site_url('assets/images/address.png');?>"/></a>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        endforeach;
                    else:
                        echo '<td colspan="9">暂无记录</td>';
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