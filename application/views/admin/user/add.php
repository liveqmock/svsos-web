<?php $this->load->view('admin/header');?>
<div id="content">
    <?php $this->load->view('admin/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">用户权限</strong></h2>
            </div>
            <div class="cont mh400 pa15">
                <table class="table_data">
                    <tbody>
                    <tr>
                        <td class="tl td_bt">用户账号：</td>
                        <td class="tl td_cont"><?php echo $info['account'];?></td>
                    </tr>
                    <tr class="bg">
                        <td class="tl td_bt">用户名称：</td>
                        <td class="tl td_cont"><?php echo $info['nickname'];?></td>
                    </tr>
                    <tr>
                        <td class="tl td_bt">用户状态：</td>
                        <td class="tl td_cont"><label class="default-label"><input type="checkbox" <?php echo ($info['ed'] == 2) ? 'checked="checked"' : '';?> value="2" class="ed"> 禁用</label></td>
                    </tr>
                    <tr class="bg">
                        <td class="tl td_bt">用户权限：</td>
                        <td class="tl td_cont">
                            <div class="author">
                                <label class="default-label"><input type="checkbox" <?php echo stristr($info['role'],'a') ? 'checked="checked"' : '';?> value="a" class="checkbox"> 工单列表</label>
                                <label class="default-label"><input type="checkbox" <?php echo stristr($info['role'],'b') ? 'checked="checked"' : '';?> value="b" class="checkbox"> 品牌服务</label>
                                <label class="default-label"><input type="checkbox" <?php echo stristr($info['role'],'c') ? 'checked="checked"' : '';?> value="c" class="checkbox"> 服务网点</label>
                                <label class="default-label"><input type="checkbox" <?php echo stristr($info['role'],'d') ? 'checked="checked"' : '';?> value="d" class="checkbox"> 用户列表</label>
                                <label class="default-label"><input type="checkbox" <?php echo stristr($info['role'],'e') ? 'checked="checked"' : '';?> value="e" class="checkbox"> 工单金额</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <input type="button" value="提 交" name="loginsubmit" class="sub_4 submit">&nbsp;&nbsp;
                            <a href="<?php echo site_url('admin/user');?>" class="sub_4">返 回</a>
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
        $(".submit").click(function(){
            var id = <?php echo $info['user_id'];?>;
            var ed = $(".ed:checked").val();
            if(ed == undefined)
            {
                ed = 1;
            }

            var role = '';
            $(".checkbox:checked").each(function(){
                role += $(this).val() + ',';
            });
            if( role != '' )
            {
                role = role.substring(0,role.length-1);
            }

            $.post('<?php echo site_url('admin/user_action/role');?>',{ed:ed,role:role,id:id},function(data)
            {
                if(data.error == 0)
                {
                    easyDialog.open({
                        container : {
                            content : '操作成功'
                        },
                        autoClose:2000
                    });
                    setTimeout("window.location.href = '"+data.url+"'",1000);
                    //setTimeout("window.location.reload()",1000);
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

    });
</script>
