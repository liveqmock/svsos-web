<?php $this->load->view('admin/header');?>
<div id="content">
    <?php $this->load->view('admin/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">品牌详情</strong></h2>
            </div>
            <div class="cont mh400 pa15">
                <table class="table_data">
                    <tbody class="reg_form">
                    <tr class="bg">
                        <td class="tl td_bt">名称：</td>
                        <td class="tl td_cont"><input type="text" value="<?php echo $info['name'];?>" id="name" class="login-input6" /></td>
                    </tr>
                    <tr>
                        <td class="tl td_bt">电话：</td>
                        <td class="tl td_cont"><input type="text" value="<?php echo $info['tel'];?>" id="tel" class="login-input6" /></td>
                    </tr>
                    <tr class="bg">
                        <td class="tl td_bt">网址：</td>
                        <td class="tl td_cont" colspan="3"><input type="text" value="<?php echo $info['website'];?>" id="website" class="login-input6"  /></td>
                    </tr>
                    <tr>
                        <td class="tl td_bt">验证：</td>
                        <td class="tl td_cont" colspan="3">
                            <select class="login-input6" id="verify" style="padding-top: 5px;">
                                <option value="1" <?php echo ($info['verify']==1)?'selected':'';?>>未验证</option>
                                <option value="2" <?php echo ($info['verify']==2)?'selected':'';?>>已验证</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="bg">
                        <td class="tl td_bt">排序：</td>
                        <td class="tl td_cont"><input type="text" value="<?php echo $info['sort'];?>" id="sort" class="login-input6"  /><span style="color:#999;"> 数字越大排序越靠前</span></td>
                    </tr>
                    <tr>
                        <td class="tl td_bt">Logo：</td>
                        <td class="tl td_cont">
                            <div class="browser">
                                <input type="file" class="uplodfile" id="upload" name="userfile" accept="image/jpeg,image/png,image/gif,image/jpg" style="filter:alpha(opacity=0);opacity:0;cursor:pointer;width:210px;height:30px;overflow:hidden;" /> （宽:206px，高:78px）
                                <input type="hidden" value="<?php echo $info['icon'] ? $info['icon'] : '';?>" id="uploadPath" />
                            </div>
                        </td>
                    </tr>
                    <tr class="bg">
                        <td class="tl td_bt">预览图：</td>
                        <td class="tl td_cont">
                            <div class="showarea" style="width: 206px;height: 78px;text-align:center;">
                                <img src="<?php  echo $info['icon'] ? site_url($info['icon']) : '';?>" style="width: 206px;height: 78px;" class="showimg" id="showUpload"/>
                                <img src="<?php  echo site_url('assets/images/upload.gif');?>" id="showUpload1" style="display:none;margin-top:52px;" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <input type="button" value="确认提交" name="loginsubmit" class="sub_4 submit">&nbsp;&nbsp;
                            <a href="<?php echo site_url('admin/brand');?>" class="sub_4">返   回</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ ui_box2-->
    </div>
    <!--/ w800-->
    <div class="clear"></div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/upload.js');?>"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $("#upload").ajaxfileupload({
            'action': '<?php echo site_url('up/upload');?>',
            'onComplete': function(response) {
                if(response.error == 0)
                {
                    var url = '<?php echo site_url();?>'+response.url;
                    $('#uploadPath').val(response.url);
                    $('#showUpload').attr('src', url).show();
                }
                else
                {
                    easyDialog.open({
                        container : {
                            content : response.msg
                        },
                        autoClose : 2000
                    });
                }
                $("#showUpload1").hide();
            },
            'onStart': function() {
                $('#uploadPath').val("");
                $("#showUpload1").show();
                $("#showUpload").hide();
            }
        });

        $(".submit").click(function(){
            var id = '<?php echo $info['id'];?>';
            var name = $("#name").val();
            var tel = $("#tel").val();
            var website = $("#website").val();
            var icon = $("#uploadPath").val();
            var verify = $("#verify").val();
            var sort = $("#sort").val();

            if($.isEmpty(name))
            {
                easyDialog.open({
                    container : {
                        content : '品牌名称不能为空'
                    },
                    autoClose : 2000
                });
                return false;
            }

            if($.isEmpty(tel))
            {
                easyDialog.open({
                    container : {
                        content : '电话不能为空'
                    },
                    autoClose : 2000
                });
                return false;
            }

            $.post('<?php echo site_url('admin/brand_action/edit');?>',
                {id:id,name:name,tel:tel,website:website,icon:icon,verify:verify,sort:sort},
                function(data)
                {
                    if(data.error == 0)
                    {
                        easyDialog.open({
                            container : {
                                content : '品牌修改成功。'
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
                },'json'
            );
        });
    })
</script>

