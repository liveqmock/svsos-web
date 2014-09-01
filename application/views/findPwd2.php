<?php $this->load->view('header');?>
<div id="content">

    <div class="crumbs_nav mb"><span class="icon">当前位置：</span><a href="<?php echo site_url();?>">首页</a> &gt; <a href="javascript:void(0);">找回密码</a></div>
    <!--/ crumbs_nav-->

    <div class="search_box mb">
        <div class="boxcont">
            <div class="tp">服务中心，目前仅针对企业客户和服务维修站开放，个人用户敬请期待</div>
        </div>
    </div>


    <div class="gui_box_border">
        <div class="reg_box">
            <div class="regcont login_pad clearfix">

                <div class="rtitle mb20">
                    <h3 class="tith orange">找回密码</h3>
                </div>
                <!--end rtitle-->

                <div class="step_box2 mb30">
                    <h3 class="step_bt">您现在可以：</h3>
                    <div class="step_nr mb30">
                        系统已重新生成6位随机密码，并发送到：<a href="javascript:void(0);" class="blue"><?php echo $email;?></a> 邮箱，请查收。<br />
                        并即时登录网站作密码更改！
                    </div>
                    <!--end step_nr-->
                    <div class="reg_btn6">
                        <a href="<?php echo site_url();?>" class="sub_2 mr">返回首页&gt;&gt;</a>
                    </div>
                    <!--end reg_btn4-->
                </div>
                <!--end step_box-->
            </div>
        </div>
        <!--reg_box-->
    </div>
    <!--gui_box_border end-->
</div>
<?php $this->load->view('footer');?>