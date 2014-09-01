<?php $this->load->view('header');?>
<div id="content">

    <div class="crumbs_nav mb"><span class="icon">当前位置：</span><a href="<?php echo site_url();?>">首页</a> &gt; <a href="javascript:void(0);">找回密码</a></div>
    <!--/ crumbs_nav-->

    <div class="search_box mb">
        <div class="boxcont">
            <div class="tp">服务中心，目前仅针对企业客户和服务维修站开放，个人用户敬请期待</div>
        </div>
        <!--/ boxcont-->
    </div>
    <!--/ search_box-->

    <div class="gui_box_border">
        <div class="reg_box">
            <div class="regcont login_pad clearfix">
                <div class="reg_form w510">
                    <div class="rtitle mb20">
                        <h3 class="tith orange">找回密码</h3>
                    </div>
                    <!--end rtitle-->
                    <div class="step_bt">请输入你注册的邮箱:</div>
                    <ul class="reg_ul">
                        <li>
                            <label class="w2">注册邮箱：</label>
                            <input type="text" name="email" id="email" class="login-input3" placeholder="请输入您最初注册网站会员时的电子邮箱">
                            <span id="email_tip"></span>
                        </li>
                    </ul>
                    <div class="reg_btn5">
                        <input type="button" value="找回密码" name="loginsubmit" class="btn btn-primary submit">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer');?>
<script type="text/javascript">

    $(document).ready(function(){

        $(".submit").click(function(){
            var email = $("#email").val();

            if( !$.isEmail(email) )
            {
                $("#email_tip").html('<span class="tips_no">邮箱格式不正确。</span>');
                return false;
            }
            else
            {
                $("#email_tip").html('');
            }

            $.post('<?php echo site_url('login_action/findPwd');?>',
                {email:email},
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
    });
</script>