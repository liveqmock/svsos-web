<?php $this->load->view('header');?>

<div id="content">
    <div class="crumbs_nav mb"><span class="icon">当前位置：</span><a href="<?php echo site_url();?>">首页</a> &gt; <a href="javascript:void(0);">会员登录</a></div>
<!--    <div class="search_box mb">
        <div class="boxcont">
            <div class="tp">服务中心，目前仅针对企业客户和服务维修站开放，个人用户敬请期待</div>
        </div>
    </div>-->
    <div class="gui_box_border">
        <div class="reg_box">
            <div class="regcont login_pad clearfix">
                <form class="reg_form w510 fl mr50" action="<?php echo site_url('login_action');?>">
                    <div class="rtitle mb30">
                        <h3 class="tith orange">用户登录</h3>
                    </div>
                    <table style="table-layout:fixed;">
                        <tr>
                            <td style="width:70px;text-align:right">用户名：</td>
                            <td><input type="text" name="account" class="login-input" placeholder="您注册账号/邮箱/手机号码"  datatype="*" nullmsg="请输入账号！"/></td>
                        </tr>
                        <tr style="height: 75px;">
                            <td style="width:70px;text-align: right ">密&nbsp;&nbsp;&nbsp;码：</td>
                            <td><input type="password" value="" name="pwd" class="login-input" datatype="*6-16" nullmsg="请输入密码！" errormsg="密码范围在6~16位之间！"/></td>
                        </tr>
                        <tr>
                            <td style="width:70px;text-align: right ">验证码：</td>
                            <td>
                                <input type="text" value="" name="captcha" class="login-input2" datatype="n4-4" nullmsg="请输入验证码！" errormsg="验证码必须是4位数字！"/>
                                <a href="javascript:void(0);" class="captcha"><?php echo $captcha;?></a>
                                <a class="blue refreshCaptcha" href="javascript:void(0);">看不清换一个</a>
                            </td>
                        </tr>
                    </table>
                    <div class="reg_btn5" style="margin-top:15px;">
                        <input type="submit" value="登 录" name="loginsubmit" class="btn btn-primary">
                        <a href="<?php echo site_url('login/findPwd');?>" class="blue gt bk">忘记密码？</a>
                    </div>
                </form>
                <div class="fr_dl fl">
                    <div class="fr_title mb">没有会员账号！&nbsp;<a class="blue" href="<?php echo site_url('reg');?>">新用户注册&gt;&gt;</a></div>

                    <div class="mb">新用户请注册新帐户立刻享受</div>
                    <ul>
                        <li>专业化的服务平台</li>
                        <li>覆盖全国的维修站点</li>
                        <li>最以客户为中心的服务，更好的服务体验</li>
                    </ul>
                    <p>
                    <div class="fr_title mb">其他账号登陆</div>
                         <a href="<?php echo site_url('login/auth/qq');?>"><img src="<?php echo site_url('assets/images/qq_login.png');?>"></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer');?>
<script type="text/javascript">
    
    function changeCaptcha()
    {
        $.ajax({
            url : '<?php echo site_url('/reg/captcha');?>',
            type : "post",
            dataType : "text",
            success : function(data){
                data = eval("("+data+")");
                $('.captcha').html(data.captcha);
            }
        });
    }

    $(document).ready(function(){

        $(".refreshCaptcha").click(function(){
            changeCaptcha();
        });

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
    });
</script>