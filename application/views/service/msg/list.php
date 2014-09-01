<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb">
        <span class="icon">当前位置：</span>
        <a href="<?php echo site_url();?>">首页</a> &gt;
        <a href="<?php echo site_url('service/order');?>">我的服务</a> &gt;
        站内信息
    </div>
    <!--/ search_box-->
    <?php $this->load->view('service/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">站内信息</strong></h2>
            </div>
            <!--/ title-->
            <div class="cont mh400 pa15">
                <table class="table_data">
                    <tbody>
                    <tr>
                        <th>标题</th>
                        <th>发送人</th>
                        <th>发送日期</th>
                        <th>状态</th>
                        <th width="100">操作</th>
                    </tr>
                    <?php
                    if(!empty($lists)):
                        $i = 0;
                        foreach($lists as $v):
                            $class = ($i%2 == 0) ? '' : 'class="bg"';
                            $status = ($v['status']) ? '<span class="green">已读</span>' : '<span class="red">未读</span>';
                            $who = $v['who'] ? '服务网点' : '系统管理员';
                    ?>
                    <tr>
                        <td><a href="<?php echo site_url("service/msg/info/{$v['id']}");?>" class="blue">系统通知</a></td>
                        <td><?php echo $who;?></td>
                        <td><?php echo $v['create_time'];?></td>
                        <td><?php echo $status;?></td>
                        <td><a style="cursor: pointer;" onclick="del('<?php echo $v['id'];?>')" title="删除"><img src="<?php echo site_url('assets/images/delete.png');?>"/></a></td>
                    </tr>
                    <?php
                            $i++;
                        endforeach;
                    else:
                        echo '<td colspan="5">暂无通知</td>';
                    endif;
                    ?>
                    </tbody
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
            $.post('<?php echo site_url('service/msg_action/del');?>',
                {id:id},
                function(data)
                {
                    if(data.error == 0)
                    {
                        easyDialog.open({
                            container : {
                                content : '删除成功。'
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