<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb">
        <span class="icon">当前位置：</span>
        <a href="<?php echo site_url();?>">首页</a> &gt;
        <a href="<?php echo site_url('service/order');?>">我的服务</a> &gt;
        工单列表
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
                <div class="mb15">
                    <form class="form-search" action="<?php echo site_url('service/order/search');?>">
                        <select name="orderStatus" style="height: 31px;width: 100px;padding: 5px 0px 0px 5px;">
                            <option value="0">全部</option>
                            <option value="1" <?php echo (isset($status) && ($status == 1)) ? 'selected' : '';?>>服务申请</option>
                            <option value="2" <?php echo (isset($status) && ($status == 2)) ? 'selected' : '';?>>服务委派中</option>
                            <option value="3" <?php echo (isset($status) && ($status == 3)) ? 'selected' : '';?>>服务结束</option>
                        </select>
                        <input type="submit" value="查 询" class="btn btn-primary">
                    </form>
                </div>
                <div class="mb15">
                    <a href="<?php echo site_url('service/service');?>" class="btn btn-primary">创建工单</a>
                    <?php if(!empty($lists)):?>
                    <a href="<?php echo site_url('service/order_action/export');?>" class="btn btn-primary">导出Excel</a>
                    <?php endif;?>
                </div>
                <!--/ m_tips-->
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th class="tl">工单号</th>
                        <th>品牌</th>
                        <th>型号</th>
                        <th>序列号</th>
                        <th>服务类型</th>
                        <th>产品类型</th>
                        <th>工单状态</th>
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
                        <td><?php echo getOrderStatus($v['status']);?></td>
                        <td>
                            <?php if($v['status'] == 1):?>
                            <a href="<?php echo site_url("service/order/edit/{$v['id']}");?>" title="修改"><img alt="修改" src="<?php echo site_url('assets/images/edit.png');?>"/></a>&nbsp;
                            <a style="cursor: pointer;" onclick="del('<?php echo $v['id'];?>')" title="删除"><img src="<?php echo site_url('assets/images/delete.png');?>"/></a>
                            <?php else : ?>
                            <a href="<?php echo site_url("service/order/show/{$v['id']}");?>" title="查看"><img alt="查看" src="<?php echo site_url('assets/images/view.png');?>"/></a>
                            <?php endif;?>
                        </td>
                    </tr>
                    <?php
                            $i++;
                        endforeach;
                    else:
                        echo '<td colspan="8">暂无记录</td>';
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
<script type="text/javascript">
    function del(id)
    {
        if(confirm("请确认是否删除？")){
            $.post('<?php echo site_url('service/order_action/del');?>',
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