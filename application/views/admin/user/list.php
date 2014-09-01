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
                    <form action="<?php echo site_url('admin/user/search');?>">
                        用户类型：
                        <select name="type">
                            <option value="0">全部</option>
                            <option value="1" <?php echo (isset($type) && ($type==1)) ? "selected" : '';?>>品牌用户</option>
                            <option value="2" <?php echo (isset($type) && ($type==2)) ? "selected" : '';?>>维修网点</option>
                            <option value="3" <?php echo (isset($type) && ($type==3)) ? "selected" : '';?>>管理员</option>
                        </select>&nbsp;&nbsp;
                        用户状态：
                        <select name="ed">
                            <option value="0">全部</option>
                            <option value="1" <?php echo (isset($ed) && ($ed==1)) ? "selected" : '';?>>正常</option>
                            <option value="2" <?php echo (isset($ed) && ($ed==2)) ? "selected" : '';?>>禁用</option>
                        </select>&nbsp;&nbsp;
                        帐号/昵称：<input type="text" value="<?php echo isset($search) ? $search : '' ;?>" name="search" style="height: 25px;width: 150px;padding: 0px 0px 0px 7px;"/>&nbsp;&nbsp;
                        <input type="submit" value="查 询" class="sub_4">
                    </form>
                </div>
                <!--/ m_tips-->
                <table class="table_data">
                    <tbody>
                    <tr>
                        <th>用户帐号</th>
                        <th>昵称</th>
                        <th>用户类型</th>
                        <th>电话</th>
                        <th>加入时间</th>
                        <th>工单操作</th>
                    </tr>
                    <?php
                    if(!empty($lists)):
                        $i = 0;
                        foreach($lists as $v):
                            $class = ($i%2 == 0) ? '' : 'class="bg"';
                            if( $v['role'] == 'superAdmin')
                            {
                                continue;
                            }
                            else if( !empty($v['role']) )
                            {
                                $type = '普通管理员';
                            }
                            else if( $v['user_type'] == 1)
                            {
                                $type = '品牌用户';
                            }
                            else
                            {
                                $type = '维修网点';
                            }
                    ?>
                            <tr <?php echo $class;?>>
                                <td class="tl"><?php echo $v['account'];?></td>
                                <td><?php echo $v['nickname'];?></td>
                                <td><?php echo $type;?></td>
                                <td><?php echo $v['phone'];?></td>
                                <td><?php echo $v['create_time'];?></td>
                                <td>
                                    <a href="<?php echo site_url("admin/user/show/{$v['user_id']}");?>" title="查看"><img alt="查看" src="<?php echo site_url('assets/images/view.png');?>"/></a>&nbsp;
                                    <a href="<?php echo site_url("admin/user/add/{$v['user_id']}");?>" title="赋权限"><img alt="赋权限" src="<?php echo site_url('assets/images/tool.png');?>"/></a>
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