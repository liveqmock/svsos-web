<?php $this->load->view('admin/header');?>
<div id="content">
    <?php $this->load->view('admin/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">工单列表</strong></h2>
            </div>
            <!--/ title-->
            <div class="cont mh400 pa15">
                <div class="mb15">
                    <form action="<?php echo site_url('admin/main/search');?>">
                        <select name="orderStatus" style="height: 31px;width: 100px;padding: 5px 0px 0px 5px;">
                            <option value="0">全部</option>
                            <option value="1" <?php echo (isset($status) && ($status == 1)) ? 'selected' : '';?>>服务申请</option>
                            <option value="2" <?php echo (isset($status) && ($status == 2)) ? 'selected' : '';?>>服务委派中</option>
                            <option value="3" <?php echo (isset($status) && ($status == 3)) ? 'selected' : '';?>>服务结束</option>
                        </select>
                        <?php if(!empty($lists)):?>
                        <a href="<?php echo site_url('admin/main_action/export');?>" class="sub_4 fr" style="margin-bottom: 10px;">导出Excel</a>
                        <?php endif;?>
                        <input type="submit" value="查 询" class="sub_4">
                    </form>
                </div>
                <!--/ m_tips-->
                <table class="table_data">
                    <tbody>
                    <tr>
                        <th>工单号</th>
                        <th>品牌</th>
                        <th>型号</th>
                        <th>序列号</th>
                        <th>服务类型</th>
                        <th>产品类型</th>
                        <th>服务状态</th>
                        <th>提交时间</th>
                        <th>工单操作</th>
                    </tr>
                    <?php
                    if(!empty($lists)):
                        $i = 0;
                        foreach($lists as $v):
                            $class = ($i%2 == 0) ? '' : 'class="bg"';
                    ?>
                            <tr <?php echo $class;?>>
                                <td class="tl"><a href="<?php echo site_url("admin/main/show/{$v['id']}");?>" title="查看"><?php echo $v['order_id'];?></a></td>
                                <td><?php echo $v['product_brand'];?></td>
                                <td><?php echo $v['product_model'];?></td>
                                <td><?php echo $v['product_sn'];?></td>
                                <td><?php echo $v['service_name'];?></td>
                                <td><?php echo $v['product_name'];?></td>
                                <td><?php echo getOrderStatus($v['status']);?></td>
                                <td><?php echo date('Y-m-d',$v['create_time']);?></td>
                                <td>
                                    <?php if($v['status'] == 1):?>
                                    <a href="<?php echo site_url("admin/main/edit/{$v['id']}");?>" title="修改"><img alt="修改" src="<?php echo site_url('assets/images/edit.png');?>"/></a>&nbsp;
                                    <a href="<?php echo site_url("admin/main/add/{$v['id']}");?>" title="添加服务网点"><img alt="添加服务网点" src="<?php echo site_url('assets/images/tool.png');?>"/></a>&nbsp;
                                    <a style="cursor: pointer;" onclick="del('<?php echo $v['id'];?>')" title="删除"><img src="<?php echo site_url('assets/images/delete.png');?>"/></a>
                                    <?php elseif($v['status'] < 3):?>
                                    <a href="<?php echo site_url("admin/main/show/{$v['id']}");?>" title="修改"><img alt="修改" src="<?php echo site_url('assets/images/edit.png');?>"/></a>
                                    <?php else:?>
                                    <a href="<?php echo site_url("admin/main/show/{$v['id']}");?>" title="查看"><img alt="查看" src="<?php echo site_url('assets/images/view.png');?>"/></a>&nbsp;
                                    <?php endif;?>
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
<script type="text/javascript">
    function del(id)
    {
        if(confirm("请确认是否删除？")){
            $.post('<?php echo site_url('admin/main_action/del');?>',
                {id:id},
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
                        setTimeout("window.location.reload()",1000);
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
        }
    }
</script>