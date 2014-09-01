<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb">
        <span class="icon">当前位置：</span>
        <a href="<?php echo site_url();?>">首页</a> &gt;
        个人设置
    </div>
    <!--/ search_box-->
    <?php $this->load->view('service/menu');?>
    <!--/ w190-->
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">用户信息</strong></h2>
            </div>
            <!--/ title-->
            <div class="cont mh400 pa15 reg_box">
                <form class="reg_form" action="<?php echo site_url('user/profile/save');?>">
                    <ul class="reg_ul">
                        <li class="clearfix">
                            <label class="w1">账号：</label>
                            <div class="nr">
                                <input type="text" class="login-input" name="account" value="<?php echo $userInfo['account'];?>" id="account" disabled="true">
                            </div>
                            <span id="name_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label class="w1">昵称：</label>
                            <div class="nr">
                                <input type="text" class="login-input" name="nickname" value="<?php echo $userInfo['nickname'];?>" id="nickname">
                            </div>
                            <span id="name_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label class="w1">真实姓名：</label>
                            <div class="nr">
                                <input type="text" class="login-input" name="realName" value="<?php echo $userInfo['real_name'];?>" id="realName">
                            </div>
                            <span id="name_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label class="w1">性别：</label>
                            <div class="nr">
                                <?php if($userInfo['sex'] == 1):?>
                                <span class="mr"><input type="radio" value="1" name="sex" checked> 男</span>
                                <input type="radio" value="2" name="sex"> 女
                                <?php else:?>
                                <span class="mr"><input type="radio" value="1" name="sex"> 男</span>
                                <input type="radio" value="2" name="sex" checked> 女
                                <?php endif;?>
                            </div>
                        </li>
                        <li class="clearfix">
                            <label class="w1">手机：</label>
                            <div class="nr">
                                <input type="text" class="login-input" name="phone" value="<?php echo $userInfo['phone'];?>" id="phone" ignore="ignore">
                            </div>
                            <span id="phone_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label class="w1">电话：</label>
                            <div class="nr">
                                <input type="text" class="login-input" name="tel" value="<?php echo $userInfo['tel'];?>" placeholder="格式:020-58497405" id="tel" ignore="ignore">
                            </div>
                            <span id="tel_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label class="w1">E-mail：</label>
                            <div class="nr">
                                <input type="text" class="login-input" name="email" value="<?php echo $userInfo['email'];?>" id="email" ignore="ignore">
                            </div>
                            <span id="email_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label class="w1">公司名称：</label>
                            <div class="nr">
                                <input type="text" class="login-input" name="companyName" value="<?php echo $userInfo['company_name'];?>" id="companyName" ignore="ignore">
                            </div>
                            <span id="companyName_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label class="w1">联系地址：</label>
                            <div class="nr">
                                <input type="text" class="login-input" name="address" value="<?php echo $userInfo['address'];?>" id="address" ignore="ignore">
                            </div>
                            <span id="address_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label class="w1">邮政编码：</label>
                            <div class="nr">
                                <input type="text" class="login-input" name="zipCode" value="<?php echo $userInfo['zip_code'];?>" id="zipCode" ignore="ignore">
                            </div>
                            <span id="code_tip"></span>
                        </li>
                    </ul>
                    <div class="reg_btn5">
                        <input type="submit" name="" value="提交" class="btn btn-primary">
                    </div>
                    <!--end reg_btn-->
                </form>
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
    $(document).ready(function(){

        var demo=$(".reg_form").Validform({
            tiptype:4,
            postonce:true,
            dragonfly:true,
            showAllError:true,
            datatype:{
                "zh1-6":/^[\u4E00-\u9FA5\uf900-\ufa2d]{1,6}$/
            },
            ajaxPost:true,
            callback:function(data)
            {
                if(data.error == 0)
                {
                    easyDialog.open({
                        container : {
                            content : '修改成功'
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
            }
        });

        demo.tipmsg.w["zh1-6"]="请输入1到6个中文字符！";

        demo.addRule(
        [
            {
                ele:"#nickname",
                datatype:"zh2-5"
            },
            {
                ele:"#phone",
                datatype:"m"
            },
            {
                ele:"#email",
                datatype:"e"
            },
            {
                ele:"#company_name",
                datatype:"zh2-40"
            }
        ]);
    })
</script>