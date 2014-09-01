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
            <div class="cont mh400 pa15 web_news">
                <ul>
                    <li class="clearfix">
                        <div class="bt">标题：</div>
                        <div class="nr">系统通知</div>
                    </li>
                    <li class="clearfix">
                        <div class="bt">发件人：</div>
                        <div class="nr"><?php echo $info['who'] ? '服务网点' : '系统管理员';?></div>
                    </li>
                    <li class="clearfix">
                        <div class="bt">发送时间：</div>
                        <div class="nr"><?php echo $info['create_time'];?></div>
                    </li>
                    <li class="clearfix">
                        <div class="bt">内容：</div>
                        <div class="nr"><?php echo $info['content'];?></div>
                    </li>
                </ul>
                <div class="reg_btn mt20">
                    <a href="<?php echo site_url('service/msg');?>" class="sub_4">返 回</a>
                </div>
            </div>
            <!--/ cont-->
        </div>
        <!--/ ui_box2-->
    </div>
    <!--/ w800-->
    <div class="clear"></div>
</div>
<?php $this->load->view('footer');?>