<div class="w190 fl mr">
    <div class="ui_box4">
        <div class="title">
            <h2 class="tith"><strong class="i2">菜单列表</strong></h2>
        </div>
        <!--/ title-->
        <div class="cont menu_manage">
            <ul>
                <?php if(iShow('a')):?>
                <li <?php echo ($menu == 'main') ? 'class="hover"' : '';?>>
                    <div class="bt"><a href="<?php echo site_url('admin/main');?>" class="blue">工单列表</a></div>
                </li>
                <?php endif;?>
                <?php if(iShow('b')):?>
                <li <?php echo ($menu == 'brand') ? 'class="hover"' : '';?>>
                    <div class="bt"><a href="<?php echo site_url('admin/brand');?>" class="blue">品牌服务</a></div>
                </li>
                <?php endif;?>
                <?php if(iShow('c')):?>
                <li <?php echo ($menu == 'sp') ? 'class="hover"' : '';?>>
                    <div class="bt"><a href="<?php echo site_url('admin/sp');?>" class="blue">服务网点</a></div>
                </li>
                <?php endif;?>
                <?php if(iShow('d')):?>
                <li <?php echo ($menu == 'user') ? 'class="hover"' : '';?>>
                    <div class="bt"><a href="<?php echo site_url('admin/user');?>" class="blue">用户列表</a></div>
                </li>
                <?php endif;?>
                <?php if(iShow('e')):?>
                    <li <?php echo ($menu == 'money') ? 'class="hover"' : '';?>>
                        <div class="bt"><a href="<?php echo site_url('admin/money');?>" class="blue">工单金额</a></div>
                    </li>
                <?php endif;?>
                <li>
                    <div class="bt"><a href="<?php echo site_url('service/order');?>" class="blue">我的服务</a></div>
                </li>
            </ul>
        </div>
    </div>
</div>