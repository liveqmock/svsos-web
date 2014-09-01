<?php $this->load->view('admin/header');?>
<div id="content">
    <?php $this->load->view('admin/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">用户详情</strong></h2>
            </div>
            <div class="cont mh400 pa15">
                <table class="table_data">
                    <tbody>
                    <tr class="bg">
                        <td class="tl td_bt">用户账号：</td>
                        <td class="tl td_cont"><?php echo $info['account'];?></td>
                        <td class="tl td_bt">用户名称：</td>
                        <td class="tl td_cont"><?php echo $info['nickname'];?></td>
                    </tr>
                    <tr>
                        <td class="tl td_bt">用户性别：</td>
                        <td class="tl td_cont"><?php echo ($info['sex'] == 1) ? '男' : '女';?></td>
                        <td class="tl td_bt">联系邮箱：</td>
                        <td class="tl td_cont"><?php echo $info['email'];?></td>
                    </tr>
                    <tr class="bg">
                        <td class="tl td_bt">联系电话：</td>
                        <td class="tl td_cont"><?php echo $info['phone'];?></td>
                        <td class="tl td_bt">固定电话：</td>
                        <td class="tl td_cont"><?php echo $info['tel'];?></td>
                    </tr>
                    <tr>
                        <td class="tl td_bt">公司名称：</td>
                        <td class="tl td_cont"><?php echo $info['company_name'];?></td>
                        <td class="tl td_bt">联系地址：</td>
                        <td class="tl td_cont"><?php echo $info['address'];?></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <input type="button" value="重置密码" name="loginsubmit" class="sub_4 reset">&nbsp;&nbsp;
                            <a href="<?php echo site_url('admin/user');?>" class="sub_4">返   回</a>
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
<script type="text/javascript">
    $(document).ready(function(){
        $(".reset").click(function(){

            $.post('<?php echo site_url('admin/user_action/resetPwd');?>',
                {id:'<?php echo $info['user_id'];?>'},
                function(data)
                {
                    if(data.error == 0)
                    {
                        easyDialog.open({
                            container : {
                                content : data.msg
                            },
                            autoClose : 5000
                        });
                        setTimeout("window.location.reload()",3000);
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
