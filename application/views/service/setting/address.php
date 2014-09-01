<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb">
        <span class="icon">当前位置：</span>
        <a href="<?php echo site_url();?>">首页</a> &gt;
        <a href="<?php echo site_url('service/order');?>">我的服务</a> &gt;
        个人设置 &gt; 收货地址设置
    </div>
    <!--/ search_box-->
    <?php $this->load->view('service/menu');?>
    <!--/ w190-->
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">收货地址设置</strong></h2>
            </div>
            <!--/ title-->
            <div class="cont mh400 pa15 reg_box">
                <form class="reg_form" action="<?php echo site_url('service/setting_action/address');?>">
                    <ul class="reg_ul">
                        <li class="clearfix">
                            <label style="width: 77px;"><span class="red">*号为必填项</span></label>
                            <div class="nr"></div>
                        </li>
                        <li class="clearfix">
                            <label class="w1"><span class="red">*</span> 地&nbsp;&nbsp;址：</label>
                            <div class="nr">
                                <select name="province" class="vm" id="province" datatype="*" nullmsg="请选择所在省份！"></select>
                                <span>省/直辖市</span>
                                <select name="city" class="vm" id="city" datatype="*" nullmsg="请选择所在城市！"></select>
                                <span>市/县</span>
                                <select name="hometown" class="vm" id="hometown" datatype="*" nullmsg="请选择所在地区！"></select>
                                <span>区/镇</span>
                            </div>
                        </li>
                        <li class="clearfix">
                            <label class="w1"><span class="red">*</span> 开户行：</label>
                            <div class="nr">
                                <input type="text" class="login-input6" name="bankName" value="<?php echo isset($info['bank_name']) ? $info['bank_name'] : '';?>" id="bankName">
                            </div>
                        </li>
                        <li class="clearfix">
                            <label class="w1"><span class="red">*</span> 用户名：</label>
                            <div class="nr">
                                <input type="text" class="login-input6" name="name" value="<?php echo isset($info['name']) ? $info['name'] : '';?>" id="name">
                            </div>
                        </li>
                        <li class="clearfix">
                            <label class="w1"><span class="red">*</span> 帐&nbsp;&nbsp;号：</label>
                            <div class="nr">
                                <input type="text" class="login-input6" name="no" value="<?php echo isset($info['no']) ? $info['no'] : '';?>" placeholder="银行帐号或支付宝帐号" id="no">
                            </div>
                        </li>
                        <li style="height: 80px;">
                            <label class="w1">备&nbsp;&nbsp;注：</label>
                            <div class="nr">
                                <textarea class="login-input6" name="remark" id="remark" style="width: 510px;height: 80px;"><?php echo isset($info['remark']) ? $info['remark'] : '';?></textarea>
                            </div>
                        </li>
                    </ul>
                    <div class="reg_btn5 clearfix">
                        <input type="submit" name="" value="修改" class="sub_4 mr20">
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
<script type="text/javascript" src="<?php echo site_url('assets/js/city.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/citydata.js');?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var province = "<?php echo isset($info['province_id']) ? $info['province_id'] : '';?>";
        var city = "<?php echo isset($info['city_id']) ? $info['city_id'] : '';?>";
        var hometown = "<?php echo isset($info['district_id']) ? $info['district_id'] : '';?>";
        AddressInit("province",province,"city",city,"hometown",hometown);

        var demo=$(".reg_form").Validform({
            tiptype:4,
            postonce:true,
            dragonfly:true,
            showAllError:true,
            datatype:{
                "zh1-6":/^[\u4E00-\u9FA5\uf900-\ufa2d]{1,6}$/
            },
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
                    ele:"#province",
                    datatype:"*"
                },
                {
                    ele:"#city",
                    datatype:"*"
                },
                {
                    ele:"#hometown",
                    datatype:"*"
                },
                {
                    ele:".login-input6:eq(0)",
                    datatype:"zh2-8"
                },
                {
                    ele:".login-input6:eq(1)",
                    datatype:"zh2-5"
                },
                {
                    ele:".login-input6:eq(2)",
                    datatype:"n15-25"
                }
            ]
        );

        $(".submit").click(function(){

            $.post('<?php echo site_url('service/setting_action/address');?>',
                {province:province,city:city,hometown:hometown,bankName:bankName,name:name,no:no,remark:remark},
                function(data)
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
                },'json');
        });
    })
</script>