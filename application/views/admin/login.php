<?php $this->load->view('admin/header');?>
<div id="content">
    <div class="gui_box_border">
        <div class="reg_box">
            <div class="regcont login_pad clearfix">
                <div class="reg_form w510 fl mr50">
                    <div class="rtitle mb30">
                        <h3 class="tith orange">管理员登录</h3>
                    </div>
                    <ul class="reg_ul">
                        <li class="clearfix">
                            <label class="w1">用&nbsp;户&nbsp;名：</label>
                            <input type="text" name="name" class="login-input" id="name" placeholder="您注册时的邮箱">
                            <span id="name_tip"></span>
                        </li>
                        <li class="clearfix">
                            <label class="w1">密&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
                            <input type="password" name="username" class="login-input" id="pwd">
                            <span id="pwd_tip"></span>
                        </li>

                        <li class="clearfix"><label class="w1">验&nbsp;证&nbsp;码：</label>
                            <input type="text" name="captcha" class="login-input2" id="captcha">
                            <a href="javascript:void(0);" class="captcha"><?php echo $captcha;?></a>
                            <a class="blue refreshCaptcha" href="javascript:void(0);">看不清换一个</a>
                            <span id="captcha_tip"></span>
                        </li>

                        <!--<li class="yd2"><input name="" type="checkbox" value="" class="mr5 vm" />记住我，下次访问时直接登录</li>-->
                    </ul>
                    <div class="reg_btn5">
                        <input type="button" value="登 录" name="loginsubmit" class="sub_2 submit">
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
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

        $(".submit").click(function(){
            var name = $("#name").val();
            var pwd = $("#pwd").val();
            var captcha = $("#captcha").val();

            if( !$.isEmail(name) )
            {
                $("#name_tip").html('<span class="tips_no">用户名不正确。</span>');
                return false;
            }
            else
            {
                $("#name_tip").html('');
            }

            if( !$.isPwd(pwd) )
            {
                $("#pwd_tip").html('<span class="tips_no">密码不正确。</span>');
                return false;
            }
            else
            {
                $("#pwd_tip").html('');
            }

            if( !$.isInterger(captcha) )
            {
                $("#captcha_tip").html('<span class="tips_no">验证码不正确。</span>');
                return false;
            }
            else
            {
                $("#captcha_tip").html('');
            }

            $.post('<?php echo site_url('admin/login_action');?>',
                {name:name,pwd:pwd,captcha:captcha},
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