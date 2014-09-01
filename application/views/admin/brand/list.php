<?php $this->load->view('admin/header');?>
<div id="content">
    <?php $this->load->view('admin/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">品牌服务</strong></h2>
            </div>
            <!--/ title-->
            <div class="cont mh400 pa15">
                <div class="mb15">
                    <form action="<?php echo site_url('admin/brand/search');?>" class="fl">
                        名称/地址：<input type="text" value="<?php echo isset($search) ? $search : '' ;?>" name="search" style="height: 25px;width: 150px;padding: 0px 0px 0px 7px;"/>
                        <input type="submit" value="查 询" class="sub_4">
                    </form>
                    <div class="fr">
                        <a href="<?php echo site_url('admin/brand/add');?>" class="sub_4">添 加</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!--/ m_tips-->
                <table class="table_data">
                    <tbody>
                    <tr>
                        <th>品牌名称</th>
                        <th>品牌网址</th>
                        <th>品牌电话</th>
                        <th>加入时间</th>
                        <th>验证状态</th>
                        <th>工单操作</th>
                    </tr>
                    <?php
                    if(!empty($lists)):
                        $i = 0;
                        foreach($lists as $v):
                            $class = ($i%2 == 0) ? '' : 'class="bg"';
                            $verify = ($v['verify'] == 1) ? '未验证' : '已验证';
                    ?>
                    <tr <?php echo $class;?>>
                        <td class="tl"><?php echo $v['name'];?></td>
                        <td class="tl"><?php echo $v['website'];?></td>
                        <td class="tl"><?php echo $v['tel'];?></td>
                        <td class="tl"><?php echo $v['create_time'];?></td>
                        <td class="tl"><?php echo $verify;?></td>
                        <td>
                            <a href="<?php echo site_url("admin/brand/edit/{$v['id']}");?>" title="修改"><img alt="修改" src="<?php echo site_url('assets/images/edit.png');?>"/></a>
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