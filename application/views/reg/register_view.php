<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb"><span class="icon">当前位置：</span><a href="<?php echo site_url();?>">首页</a> &gt; <a href="javascript:void(0);">会员注册</a></div>
    <!--/ crumbs_nav-->

<!--    <div class="search_box mb">
        <div class="boxcont">
            <div class="tp">服务中心，目前仅针对企业客户和服务维修站开放，个人用户敬请期待</div>
        </div>
        / boxcont
    </div>-->
    <!--/ search_box-->
    <div class="gui_box_border">
        <div class="reg_box">
            <div class="regcont clearfix">

                <form class="reg_form" action="<?php echo site_url('reg_action/baseInfo');?>" method="post">
                    <input type="hidden" id="step" name="step" value="1">
                    <input type="hidden" id="reg_type" name="reg_type" value="<?php echo $reg_type;?>">  
                    <div class="rtitle mb20">
                        <h3 class="tith">会员注册步骤</h3>
                    </div>
                    <!--end rtitle-->

                    <div class="flow-steps">
                        <ol class="num4">
                            <li class="current"><span class="first">1 填写基本信息</span></li>
                            <li><span>2 验证邮箱</span></li>
                            <li class="last"><span>3 注册成功</span></li>
                        </ol>
                    </div>
                    <!--end flow-steps-->

                    <ul class="nav nav-pills">
                    <li  <?php if(!$reg_type || $reg_type == 3):?>class="active"<?php endif;?> >
                      <a href="<?php echo site_url('reg/user');?>" data-type="3">个人注册</a>
                    </li>
                    <li <?php if($reg_type == 2):?>class="active"<?php endif;?>><a href="<?php echo site_url('reg/company');?>" data-type="2">维修企业注册</a></li>
                    <li <?php if($reg_type == 1):?>class="active"<?php endif;?>><a href="<?php echo site_url('reg/brand');?>" data-type="1">品牌企业注册</a></li>
                   </ul>
                    
                    <?php if($reg_type == 1):?>
                    <!--品牌用户--> 
                    <ul class="reg_ul">
                         <li class="clearfix">
                            <label>用户名：</label>
                            <div class="nr">
                                <input type="text" name="account" class="input-large" id="account">
                            </div>
                            <span id="account_tip"></span>
                        </li>

                        <li class="clearfix">
                            <label>登陆密码：</label>
                            <div class="nr">
                                <input type="password" name="pwd" class="input-large" id="pwd">
                            </div>
                            <span id="pwd_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label>确认密码：</label>
                            <div class="nr">
                                <input type="password" name="confirmPwd" class="input-large" id="confirmPwd">
                            </div>
                            <span id="confirmPwd_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label>邮箱地址：</label>
                            <div class="nr">
                                <input type="text" name="email" class="input-large" id="email">
                            </div>
                            <span id="email_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label>手机号码：</label>
                            <div class="nr">
                                <input type="text" name="phone" class="input-large" id="phone" placeholder="可选填">
                            </div>
                            <span id="phone_tip"></span>
                        </li>
<!--                        <li class="clearfix">
                            <label>所在区域：</label>
                            <div class="nr">
                                <select name="" class="vm" id="province">
                                </select>
                                <select name="" class="vm" id="city">
                                </select>
                                <select name="" class="vm" id="district">
                                </select>
                            </div>
                         </li>-->
                            <!--<span class="tips_yes">服务合作伙伴此处必填。</span></li>-->
                        <li class="clearfix">
                            <label>验证码：</label>
                            <div class="nr">
                                <input type="text" name="captcha" class="login-medium" id="captcha" errormsg="验证码必须是4位数字！">
                                <a href="javascript:void(0);" class="captcha"><?php echo $captcha;?></a> <a class="orange refreshCaptcha" href="javascript:void(0);">看不清换一个</a>
                            </div>
                            <span id="captcha_tip"></span>
                        </li>
                        <li class="yd clearfix">
                            <div class="nr">
                                <input name="agree" type="checkbox" value="1" class="mr5 vm" checked id="agree"/>我已阅读并同意
                                <a href="<?php echo site_url('reg/agreement');?>" target="_blank" class="blue">《点击阅读协议》</a>
                            </div>
                            <span id="agree_tip"></span>
                        </li>
                    </ul>
                    
                    <?php elseif($reg_type == 2): ?>
                        <!--维修企业用户--> 
                        <ul class="reg_ul">
                        <li class="clearfix">
                            <label>用户名：</label>
                            <div class="nr">
                                <input type="text" name="account" class="input-large" id="account">
                            </div>
                            <span id="account_tip"></span>
                        </li>

                        <li class="clearfix">
                            <label>登陆密码：</label>
                            <div class="nr">
                                <input type="password" name="pwd" class="input-large" id="pwd">
                            </div>
                            <span id="pwd_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label>确认密码：</label>
                            <div class="nr">
                                <input type="password" name="confirmPwd" class="input-large" id="confirmPwd">
                            </div>
                            <span id="confirmPwd_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label>邮箱地址：</label>
                            <div class="nr">
                                <input type="text" name="email" class="input-large" id="email">
                            </div>
                            <span id="email_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label><strong>企业信息</strong></label>
                        </li>
                        <li class="clearfix">
                            <label>企业名称：</label>
                            <div class="nr">
                              <input type="text" name="compName" class="input-large" id="compName">
                            </div>
                         </li>
                         <li class="clearfix">
                            <label>所在地区：</label>
                            <div class="nr">
                                <select name="province" class="vm" id="province">
                                </select>
                                <select name="city" class="vm" id="city">
                                </select>
                                <select name="district" class="vm" id="district">
                                </select>
                            </div>
                         </li>
                         <li class="clearfix">
                            <label><strong>联系人信息</strong></label>
                        </li>
                        <li class="clearfix">
                            <label>姓名：</label>
                            <div class="nr">
                                <input type="text" name="contact" class="input-large" id="contact">
                            </div>
                            <span id="phone_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label>电话：</label>
                            <div class="nr">
                                <input type="text" name="phone" class="input-large" id="phone">
                            </div>
                            <span id="phone_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label>验证码：</label>
                            <div class="nr">
                                <input type="text" name="captcha" class="input-large2" id="captcha" errormsg="验证码必须是4位数字！">
                                <a href="javascript:void(0);" class="captcha"><?php echo $captcha;?></a> <a class="orange refreshCaptcha" href="javascript:void(0);">看不清换一个</a>
                            </div>
                            <span id="captcha_tip"></span>
                        </li>
                        <li class="yd clearfix">
                            <div class="nr">
                                <input name="agree" type="checkbox" value="1" class="mr5 vm" checked id="agree"/>我已阅读并同意
                                <a href="<?php echo site_url('reg/agreement');?>" target="_blank" class="blue">《点击阅读协议》</a>
                            </div>
                            <span id="agree_tip"></span>
                        </li>
                    </ul>
                    <?php else:?>
                    <!--品牌企业用户--> 
                    <ul class="reg_ul">
                         <li class="clearfix">
                            <label>用户名：</label>
                            <div class="nr">
                                <input type="text" name="account" class="input-large" id="account">
                            </div>
                            <span id="account_tip"></span>
                        </li>

                        <li class="clearfix">
                            <label>登陆密码：</label>
                            <div class="nr">
                                <input type="password" name="pwd" class="input-large" id="pwd">
                            </div>
                        </li>
                        <li class="clearfix">
                            <label>确认密码：</label>
                            <div class="nr">
                                <input type="password" name="confirmPwd" class="input-large" id="confirmPwd">
                            </div>
                            <span id="confirmPwd_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label>邮箱地址：</label>
                            <div class="nr">
                                <input type="text" name="email" class="input-large" id="email">
                            </div>
                            <span id="email_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label>手机号码：</label>
                            <div class="nr">
                                <input type="text" name="phone" class="input-large" id="phone" placeholder="可选填">
                            </div>
                            <span id="phone_tip"></span>
                        </li>
                         <li class="clearfix">
                            <label>所在区域：</label>
                            <div class="nr">
                                <select name="province" class="vm" id="province">
                                </select>
                                <select name="city" class="vm" id="city">
                                </select>
                                <select name="district" class="vm" id="district">
                                </select>
                            </div>
                            <!--<span class="tips_yes">服务合作伙伴此处必填。</span></li>-->
                        <li class="clearfix">
                            <label>验证码：</label>
                            <div class="nr">
                                <input type="text" name="captcha" class="input-medium" id="captcha" errormsg="验证码必须是4位数字！">
                                <a href="javascript:void(0);" class="captcha"><?php echo $captcha;?></a> <a class="orange refreshCaptcha" href="javascript:void(0);">看不清换一个</a>
                            </div>
                            <span id="captcha_tip"></span>
                        </li>
                        <li class="yd clearfix">
                            <div class="nr">
                                <input name="agree" type="checkbox" value="1" class="mr5 vm" checked id="agree"/>我已阅读并同意
                                <a href="<?php echo site_url('reg/agreement');?>" target="_blank" class="blue">《点击阅读协议》</a>
                            </div>
                            <span id="agree_tip"></span>
                        </li>
                    </ul>
                     <?php endif;?>
                    <div class="reg_btn ">
                        <input type="submit" value="注册" name="loginsubmit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <!--reg_box-->
    </div>
    <!--gui_box_border end-->
</div>
<?php $this->load->view('footer');?>
<script type="text/javascript" src="<?php echo site_url('assets/js/city.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/citydata.js');?>"></script>
<script type="text/javascript">
    function changeCaptcha()
    {
        $.ajax({
            url : '<?php echo site_url('/reg/captcha');?>',
            type : "get",
            dataType : "text",
            success : function(data){
                data = eval("("+data+")");
                $('.captcha').html(data.captcha);
            }
        });
    }

    $(document).ready(function(){
        AddressInit("province",'',"city",'',"district",'');

        $(".refreshCaptcha").click(function(){
            changeCaptcha();
        });

        var validObj=$(".reg_form").Validform({
            tiptype : 4,
            showAllError : true,
            postonce : true,
            ajaxPost : true,
            callback : function(data){
                if(data.error === 0)
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

        validObj.addRule([
            {
                ele:"#account",
                nullmsg:"请输入用户名！",
                datatype:"*6-20",
                errormsg: "6-20个字符，允许中文，英文字母、数字和符号.-_。"
            },
            {
                ele:"#pwd",
                datatype:"*6-15"
            },
            {
                ele:"#confirmPwd",
                datatype:"*6-15",
                recheck : "pwd"
            },
            {
                ele:"#province",
                datatype:"*"
            },
             {
                ele:"#city",
                datatype:"*"
            },
            {
                ele:"#district",
                datatype:"*"
            },
            {
                ele:"#compName",
                nullmsg:"请输入企业名称！",
                datatype:"*"
            },
            {
                ele:"#contact",
                datatype:"*",
                nullmsg:"请输入联系人姓名！"
            },
            {
                ele:"#phone",
                datatype:"*",
                nullmsg:"请输入联系人电话！"
            },
            {
                ele:"#email",
                datatype:"e"
            },
            {
                ele:"#captcha",
                datatype:"n"
            },
            {
                ele:"#agree",
                datatype:"*"
            }
        ]);
    });
</script>