<?php $this->load->view('admin/header');?>
<div id="content">
    <?php $this->load->view('admin/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">服务网点</strong></h2>
            </div>
            <!--/ title-->
            <div class="cont mh400 pa15">
                <div class="mb15">
                    <form action="<?php echo site_url('admin/sp/search');?>" class="fl" method="GET">
                        绑定：
                        <select name="bind">
                            <option value="0">全部</option>
                            <option value="1" <?php echo (isset($bind) && ($bind==1)) ? "selected" : '';?>>否</option>
                            <option value="2" <?php echo (isset($bind) && ($bind==2)) ? "selected" : '';?>>是</option>
                        </select>
                        &nbsp;&nbsp;审核：
                        <select name="status">
                            <option value="0">全部</option>
                            <option value="1" <?php echo (isset($status) && ($status==1)) ? "selected" : '';?>>未审核</option>
                            <option value="2" <?php echo (isset($status) && ($status==2)) ? "selected" : '';?>>已审核</option>
                        </select>
                        &nbsp;&nbsp;
                        合作伙伴：
                        <select name="verify">
                            <option value="0">全部</option>
                            <option value="1" <?php echo (isset($verify) && ($verify==1)) ? "selected" : '';?>>否</option>
                            <option value="2" <?php echo (isset($verify) && ($verify==2)) ? "selected" : '';?>>是</option>
                        </select>
                        &nbsp;&nbsp;
                        名称/地址：<input type="text" value="<?php echo isset($search) ? $search : '' ;?>" name="search" style="height: 23px;width: 130px;padding: 0px 0px 0px 7px;"/>&nbsp;&nbsp;
                        <input type="submit" value="查 询" class="sub_4">
                    </form>
                    <div class="clearfix"></div>
                </div>
                <div class="mb15">
                    <a href="<?php echo site_url('admin/sp/add');?>" class="sub_4">添 加</a>
                </div>
                <!--/ m_tips-->
                <table class="table_data">
                    <tbody>
                    <tr>
                        <th>网点名称</th>
                        <th>联系电话</th>
                        <th>绑定用户</th>
                        <th>审核</th>
                        <th>合作伙伴</th>
                        <th>操作</th>
                    </tr>
                    <?php
                    if(!empty($lists)):
                        $i = 0;
                        foreach($lists as $v):
                            $class = ($i%2 == 0) ? '' : 'class="bg"';
                            $status = ($v['status'] == 2) ? '审核' : '未审核';
                            $verify = ($v['verify'] == 2) ? '是' : '否';
                            $bind = $v['user_id'] ? '是' : '否';
                    ?>
                            <tr <?php echo $class;?>>
                                <td class="tl"><?php echo $v['sp_name'];?></td>
                                <td class="tl"><?php echo $v['phone'];?></td>
                                <td><?php echo $bind;?></td>
                                <td><?php echo $status;?></td>
                                <td><?php echo $verify;?></td>
                                <td>
                                    <a href="<?php echo site_url("admin/sp/edit/{$v['sp_id']}");?>" title="修改"><img alt="修改" src="<?php echo site_url('assets/images/edit.png');?>"/></a>&nbsp;
                                    <a href="javascript:del(<?php echo $v['sp_id'];?>)" title="删除"><img alt="删除" src="<?php echo site_url('assets/images/delete.png');?>"/></a>&nbsp;
                                    <?php if(!$v['user_id']):?>
                                    <a href="javascript:bind(<?php echo $v['sp_id'];?>)" title="绑定用户"><img alt="绑定用户" src="<?php echo site_url('assets/images/bind.png');?>"/></a>
                                    <?php endif;?>
                                </td>
                            </tr>
                    <?php
                            $i++;
                        endforeach;
                    else:
                        echo '<td colspan="6">暂无记录</td>';
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
        if(confirm('您确认删除?'))
        {
            $.post('<?php echo site_url('admin/sp_action/del');?>',{id:id},function(data)
            {
                if(data.error == 0)
                {
                    easyDialog.open({
                        container : {
                            content : '删除服务网点成功'
                        },
                        autoClose:2000
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

            },'json');
        }
    }

    function bind(id)
    {
        if(confirm('您确认要给服务网点绑定用户?'))
        {
            $.post('<?php echo site_url('admin/sp_action/bind');?>',{id:id},function(data)
            {
                if(data.error == 0)
                {
                    easyDialog.open({
                        container : {
                            content : data.msg
                        },
                        autoClose:10000
                    });
                    setTimeout("window.location.reload()",5000);
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

            },'json');
        }
    }
</script>