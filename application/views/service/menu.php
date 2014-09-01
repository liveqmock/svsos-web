<?php
    $value = $this->session->userdata('userInfo');
    $ci = &get_instance();
    $ci->load->model('Notice_model');
    $num = $ci->Notice_model->getNum($value['id']);
?>
<div class="w190 fl mr">
    <div class="ui_box4">
        <div class="title">
            <h2 class="tith"><strong class="i2">会员中心</strong></h2>
        </div>
        <!--/ title-->
        <div class="cont menu_manage">
            <ul>
                <?php if($value['type']==1): ?>
                <li <?php echo ($sMenu == 'order') ? 'class="hover"' : '';?>>
                    <div class="bt"><a href="<?php echo site_url('service/order');?>" class="blue">我的工单</a></div>
                </li>
                <?php elseif($value['type']==2): ?>
                <li <?php echo ($sMenu == 'order') ? 'class="hover"' : '';?>>
                    <div class="bt"><a href="<?php echo site_url('service/order');?>" class="blue">委派我的工单</a></div>
                </li>
                <li <?php echo ($sMenu == 'money') ? 'class="hover"' : '';?>>
                    <div class="bt"><a href="<?php echo site_url('service/money');?>" class="blue">金额查看</a></div>
                </li>
                <?php endif;?>
                <li <?php echo ($sMenu == 'msg') ? 'class="hover"' : '';?>>
                    <div class="bt"><a href="<?php echo site_url('service/msg');?>" class="blue">站内信息</a><?php if($num):?><span style="color:red;">(<?php echo $num;?>)<?php endif;?></span></div>
                </li>
                <li class="last icon1">
                    <div class="bt"><a href="javascript:void(0);" <?php echo ($sMenu == 'setting') ? 'class="hover"' : '';?>>个人设置</a></div>
                    <div class="s_list">
                        <a href="<?php echo site_url('user/profile');?>" <?php echo (isset($cur) && ($cur == 'index')) ? 'class="hover"' : '';?>>个人信息</a><br />
                        <a href="<?php echo site_url('user/pwd');?>" <?php echo (isset($cur) && ($cur == 'pwd')) ? 'class="hover"' : '';?>>修改密码</a><br />
                        <a href="<?php echo site_url('user/account');?>" <?php echo (isset($cur) && ($cur == 'account')) ? 'class="hover"' : '';?>>修改注册email</a><br />
                        <?php if($value['type']==2): ?>
                        <a href="<?php echo site_url('service/setting/address');?>" <?php echo (isset($cur) && ($cur == 'address')) ? 'class="hover"' : '';?>>结算地址设置</a> </div>
                        <?php endif;?>
                </li>
                <?php if($value['role']): ?>
                    <li>
                        <div class="bt"><a href="<?php echo site_url('admin/main');?>" class="blue">后台管理</a></div>
                    </li>
                <?php endif;?>
            </ul>
        </div>
        <!--/ cont-->
    </div>
    <!--/ menu_about-->
</div>