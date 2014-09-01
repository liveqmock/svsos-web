<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb">
        <span class="icon">当前位置：</span>
        <a href="<?php echo site_url();?>">首页</a> &gt;
        <a href="<?php echo site_url('service/order');?>">我的服务</a> &gt;
        个人设置 &gt; 修改密码
    </div>
    <?php $this->load->view('service/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">修改密码</strong></h2>
            </div>
            <div class="cont mh400 pa15 reg_box">
                <form class="reg_form" action="<?php echo site_url('service/setting_action/pwd');?>">
                    <ul class="reg_ul">
                        <li>
                            <label>请输入旧密码：</label>
                            <input type="password" class="login-input" name="oPwd" value="" id="oPwd"/>
                            <span id="oPwd_tip"></span>
                        </li>
                        <li>
                            <label>请输入新密码：</label>
                            <input type="password" class="login-input" name="nPwd" value="" id="nPwd"/>
                            <span id="oPwd_tip"></span>
                        </li>
                        <li>
                            <label>确认新密码：</label>
                            <input type="password" class="login-input" name="cPwd" value="" id="cPwd"/>
                            <span id="oPwd_tip"></span>
                        </li>
                    </ul>
                    <div class="reg_btn2">
                        <input type="submit" name="" value="修改" class="sub_4 mr20">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<?php $this->load->view('footer');?>
<script type="text/javascript">
    $(document).ready(function(){

        var demo=$(".reg_form").Validform({
            tiptype:4,
            showAllError:true,
            postonce:true,
            ajaxPost:true,
            callback:function(data){
                if(data.error == 0)
                {
                    easyDialog.open({
                        container : {
                            content : '修改成功'
                        },
                        autoClose : 2000
                    });
                    setTimeout("window.location.href='"+data.url+"'",1000);
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

        demo.addRule(
        [
            {
                ele:".login-input:eq(0)",
                datatype:"*6-16"
            },
            {
                ele:".login-input:eq(1)",
                datatype:"*6-16"
            },
            {
                ele:".login-input:eq(2)",
                datatype:"*6-16",
                recheck:"nPwd"
            }
        ]);
    })
</script>