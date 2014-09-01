<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb">
        <span class="icon">当前位置：</span>
        <a href="<?php echo site_url();?>">首页</a> &gt;
        <a href="<?php echo site_url('service/order');?>">我的服务</a> &gt;
        个人设置 &gt; 修改注册email
    </div>
    <?php $this->load->view('service/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">修改注册email</strong></h2>
            </div>
            <div class="cont mh400 pa15 reg_box">
                <form class="reg_form" action="<?php echo site_url('service/setting_action/account');?>">
                    <ul class="reg_ul">
                        <li>
                            <label class="w2">注册邮箱：</label>
                            <input type="text" class="login-input3"  value="<?php echo $account;?>" name="account" id="account"/>
                        </li>
                    </ul>
                    <div class="reg_btn5">
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
                ele:".login-input3:eq(0)",
                datatype:"e"
            }
        ]);
    })
</script>