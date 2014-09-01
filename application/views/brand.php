<?php $this->load->view('header');?>
<div class="index_classify">
    <form class="index_form clearfix" action="<?php echo site_url('brand/search');?>">
        <div class="srbox">
            <input type="text" class="sr" value="<?php echo isset($search) ? $search : '请输入品牌名称...';?>" name="search" onfocus="this.className=' sr'; if(this.value!='请输入品牌名称...'){this.style.color='#404040';}else{this.value='';this.style.color='#404040'}" onblur="if(this.value==''){this.value='请输入品牌名称...';this.style.color='#b6b7b9';this.className='sr';}" onkeydown="this.style.color='#404040'" style="color: rgb(182, 183, 185);">
        </div>
        <input type="submit" value="查 询 " class="sub" name="">
    </form>
    <!--/ index_form-->
</div>
<div id="content">
    <div class="hottel_list mb20">
        <ul class="clearfix">
            <?php
            if(!empty($lists)):
                $i = 0;
                foreach($lists as $v):
                    $class = ($i%2==0)?'mr':'';
            ?>
            <li class="clearfix <?php echo $class;?>">
                <div class="p_logo">
                    <a href="javascript:void(0);" class="img_hidden">
                        <?php if($v['icon']):?>
                        <img src="<?php echo site_url($v['icon']);?>" width="206px" height="78px" />
                        <?php elseif($v['verify']):?>
                            <img src="<?php echo site_url('assets/images/baidu.png');?>" width="206px" height="78px" />
                        <?php else:?>
                            <img src="<?php echo site_url('assets/images/nopic.png');?>" width="206px" height="78px" />
                        <?php endif;?>
                    </a>
                </div>
                <div class="p_info">
                    <p class="bt"><a href="javascript:void(0);" class="blue"><?php echo $v['name'];?></a></p>
                    <p>服务电话：<b><?php echo $v['tel'];?></b><br />
                    <?php if(!empty($v['website'])):?>
                        <a href="http://<?php echo str_replace('http://','',$v['website']);?>" target="_blank">品牌官方网址点击进入</a>
                    <?php endif;?>
                    </p>
                </div>
            </li>
            <?php
                    $i++;
                endforeach;
            endif;
            ?>
        </ul>
    </div>

    <?php $this->load->view('pagination',array('center'=>true));?>
</div>
<?php $this->load->view('footer');?>