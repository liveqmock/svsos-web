<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb"><span class="icon">当前位置：</span><a href="<?php echo site_url();?>">首页</a> &gt; <a href="javascript:void(0);">会员注册</a></div>
    <!--/ crumbs_nav-->

    <div class="gui_box_border">
        <div class="reg_box">
            <div class="regcont clearfix">
                <form class="reg_form" action="#">
                    <div class="rtitle mb20">
                        <h3 class="tith">会员注册步骤</h3>
                    </div>
                    <!--end rtitle-->

                    <div class="flow-steps">
                        <ol class="num4">
                            <li class="done"><span class="first">1. 填写基本信息</span></li>
                            <li class="done current-prev"><span>2. 注册验证</span></li>
                            <li class="last-current"><span>3. 注册成功</span></li>
                        </ol>
                    </div>
                    <!--end flow-steps-->

                    <div class="stitle mb40">注册成功：</div>
                    <div class="step_box2 mb30">
                        <h3 class="step_bt"><?php echo (isset($userInfo['name']) && !empty($userInfo['name'])) ? $userInfo['name'] : $userInfo['account'] ;?>，欢迎加入SVSOS网站</h3>
                        <div class="step_nr mb20">请牢记您的登录邮件地址：<a href="javascript:void(0);" class="blue"><?php echo $userInfo['account'];?></a></div>
                        <h3 class="step_bt">您现在可以：</h3>
                        <div class="step_nr">
                            进入“我的帐户”查看并管理您的个人信息  <a href="<?php echo site_url('service/setting');?>" class="blue mr15">编辑您的个人档案</a><br />
                            往下面看，看一下随售网为您推荐了什么

                        </div>
                    </div>
                    <!--end step_box-->

                    <div class="reg_btn4">
                        <a href="<?php echo site_url();?>" class="sub_2 mr">去看看&gt;&gt;</a>
                        <a href="<?php echo site_url('service/setting');?>" class="sub_3">进入我的帐户&gt;&gt;</a>
                    </div>
                </form>
                <!--end reg_form-->

            </div>
        </div>
        <!--reg_box-->
    </div>
    <!--gui_box_border end-->
</div>
<?php $this->load->view('footer');?>
