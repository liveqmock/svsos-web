<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb"><span class="icon">当前位置：</span><a href="<?php echo site_url();?>">首页</a> &gt; <a href="javascript:void(0);">会员注册</a></div>
    <!--/ crumbs_nav-->

<!--    <div class="search_box mb">
        <div class="boxcont">
            <div class="tp">服务中心，目前仅针对企业客户和服务维修站开放，个人用户敬请期待</div>
        </div>                                         
    </div>-->
        <!--/ boxcont-->
    <!--/ search_box-->

    <div class="gui_box_border">
        <div class="reg_box">
            <div class="regcont clearfix">
                <form class="reg_form" action="<?php echo site_url('reg_action/verifyEmail');?>">
                    <div class="rtitle mb20">
                        <h3 class="tith">会员注册步骤</h3>
                    </div>
                    <div class="flow-steps">
                        <ol class="num4">
                            <li><span>1 填写基本信息</span></li>
                            <li class="current"><span class="first">2 注册验证</span></li>
                            <li class="last"><span>3 注册成功</span></li>
                        </ol>
                    </div>
                    <div class="stitle mb40">输入验证码，并进行邮箱验证：</div>
                    <div class="step_box mb30">
                        <h3 class="step_bt">第一步：查看您的电子邮箱</h3>
                        <div class="step_nr mb40">我们给您发送了验证邮件，邮件地址为：<a href="javascript:void(0);" class="blue"><?php echo $userInfo['email'];?></a>，
                            请登录您的邮箱收信。如没收到请点击<a href="javascript:void(0);" class="sendAgain blue">重新发送</a><br />
                            注：验证邮件可能被您的邮箱提供商认定为垃圾邮件或广告邮件，如果找不到邮件，请查看您的垃圾邮件箱和广告邮件箱。</div>
                        <h3 class="step_bt">第二步：输入您收到邮件中的验证码</h3>
                        <div class="step_nr">输入您收到邮件中的验证码：
                            <input type="text" name="verifyCode" class="login-input6 vm mr" id="verifyCode" datatype="*6-6" nullmsg="请输入验证码！" errormsg="验证码长度为32位！">
                        </div>
                    </div>
                    <div class="reg_btn3">
                        <input type="submit" id="verifyBtn" value="验证" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer');?>
<script type="text/javascript">
    $(document).ready(function(){

        $(".reg_form").Validform({
            tiptype:4,
            showAllError:true,
            postonce:true,
            ajaxPost:true,
            callback:function(data){
                if(data.error == 0)
                {
                    window.location.href = data.url;
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
            }
        });

        $(".submit").click(function(){
            var verifyCode = $("#verifyCode").val();
            alert(verifyCode);

            $.post('<?php echo site_url('reg_action/verifyEmail');?>',
                {verifyCode:verifyCode},
                function(data)
                {
                    if(data.error == 0)
                    {
                        window.location.href = data.url;
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
        });

        $(".sendAgain").click(function(){
            $.post('<?php echo site_url('reg_action/sendVerifyCode/1');?>',
                {},
                function(data)
                {
                    if(data.error == 0)
                    {
                        easyDialog.open({
                            container : {
                                content : '发送成功！如还未收到，可能由于邮件延迟，请稍等片刻。'
                            },
                            autoClose : 2000
                        });
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
        });
    })
</script>