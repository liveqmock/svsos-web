<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb">
        <span class="icon">当前位置：</span>
        <a href="<?php echo site_url();?>">搜索</a> &gt;
        <?php echo $info['sp_name'];?>
    </div>
    <!--/ crumbs_nav-->
    <div class="w745 fl mr15">
        <div class="listing_detail clearfix mb15">
            <!--flhouse_info start-->
            <div class="fldetail_info clearfix">
                <div class="title_bar">
                    <h1 class="tith"><?php echo $info['sp_name'];?></h1>
                </div>
                <!--hs_photo_box star-->
                <div class="hs_photo_box fl">
                    <div id="jscityre_imgplaycont" class="img_box">
                        <?php if($info['cover']):?>
                        <img src="<?php echo site_url($info['cover']);?>" width="300px" height="225px"/>
                        <?php else:?>
                        <img src="<?php echo site_url('assets/images/nopic_sp.png');?>"/>
                        <?php endif;?>
                    </div>
                    <!--
                    <div id="jscityre_imgplaypar" class="hs_s_box">
                        <div class="hs_s_img">
                            <ul style="width:1000px;">
                                <li class="active"><span class="img_hidden"><img src="<?php echo site_url('assets/images/default2.jpg');?>" /></span></li>
                            </ul>
                        </div>
                    </div>
                    -->
                </div>
                <div class="hs_ilist fl">
                    <div class="hs_number"><span class="fl">编号：<?php echo $info['sp_id'];?></span><span class="fr c_gray">浏览次数：<?php echo $info['count'];?></span></div>
                    <div class="hf_tel mb5">
                        <div class="f_tel"> <em class="word_wrap"><?php echo $info['phone'] ? $info['phone'] : '暂无电话';?></em>
                            <p class="c_gray">联系时您可以说：您好，我从随售网上看到…</p>
                        </div>
                    </div>
                    <!--hf_tel end-->
                    <ul class="detail_text_b mb">
                        <li><strong>地址：</strong><?php echo $info['address'];?></li>
                        <li><strong>产品：</strong><?php echo $tags;?></li>
                        <li><strong>发布时间：</strong><span class="gray_9"><?php echo $info['createtime'];?></span></li>
                    </ul>
                </div>
                <!--hs_ilist end-->
            </div>
            <!--flhouse_info end-->
        </div>
        <!--listing_detail end-->
        <?php if(!empty($info['intro'])):?>
        <div class="new_fl_detail mb15">
            <h2 class="tith">详细信息</h2>
            <div class="contbox">
                <?php echo $info['intro'];?>
            </div>
            <!--cont end-->
        </div>
        <?php endif;?>
        <!--
        <div class="new_fl_detail">
            <h2 class="tith mb">用户评价</h2>
            <div class="app_detail_list">
                <ul>
                    <li>
                        <div class="user"><span class="time">2009-08-12 10:47 </span><a class="blue" href="#">用户 美丽的冬瓜 的评价</a></div>
                        <div class="cont">发达国家服务业产值占GDP的比例为60%至80%左右，我国仅占40%左右。因此，服务业发展的速度决定经济转型发展的进度。</div>
                    </li>
                    <li>
                        <div class="user"><span class="time">2009-08-12 10:47 </span><a class="blue" href="#">用户 美丽的冬瓜 的评价</a></div>
                        <div class="cont">发达国家服务业产值占GDP的比例为60%至80%左右，我国仅占40%左右。因此，服务业发展的速度决定经济转型发展的进度。</div>
                    </li>
                    <li>
                        <div class="user"><span class="time">2009-08-12 10:47 </span><a class="blue" href="#">用户 美丽的冬瓜 的评价</a></div>
                        <div class="cont">发达国家服务业产值占GDP的比例为60%至80%左右，我国仅占40%左右。因此，服务业发展的速度决定经济转型发展的进度。</div>
                    </li>
                    <li class="last">
                        <div class="user"><span class="time">2009-08-12 10:47 </span><a class="blue" href="#">用户 美丽的冬瓜 的评价</a></div>
                        <div class="cont">发达国家服务业产值占GDP的比例为60%至80%左右，我国仅占40%左右。因此，服务业发展的速度决定经济转型发展的进度。</div>
                    </li>
                </ul>
            </div>
        </div>
        -->
    </div>
    <!--/ w745-->
    <div class="w240 fl">
        <div class="r_map mb">
            <div class="maps"> <img width="230" height="250" src="http://api.map.baidu.com/staticimage?center=<?php echo $info['lng_baidu'].','.$info['lat_baidu'];?>&width=230&height=250&zoom=14&markers=<?php echo $info['lng_baidu'].','.$info['lat_baidu'];?>"></div>
            <div class="address">地址：<?php echo $info['address'];?></div>
        </div>
        <!--/ r_map-->
        <?php if(!empty($history)):?>
        <div class="ui_box1">
            <div class="title">
                <h2 class="tith">浏览过的服务站</h2>
                <a href="javascript:void(0);" class="d_clear">清空</a> </div>
            <!--/ title-->
            <div class="cont pa10">
                <ul class="pro_list1">
                    <?php $i=0;foreach($history as $v):$i++?>
                    <li <?php echo ($i==3)?'class="list_last"':'';?>>
                        <dl>
                            <dt>
                                <a href="<?php echo site_url("welcome/info/{$v['id']}");?>" class="img_box">
                                    <?php if($v['cover']):?>
                                    <img width="120" height="90" src="<?php echo site_url($v['cover']);?>">
                                    <?php else:?>
                                    <img width="120" height="90" src="<?php echo site_url('assets/images/nopic_sp.png');?>">
                                    <?php endif;?>
                                </a>
                            </dt>
                            <dd><a href="<?php echo site_url("welcome/info/{$v['id']}");?>" class="blue mr"><?php echo $v['name'];?></a></dd>
                            <dd><span class="gray_9"><?php echo $v['phone'] ? '电话：'.$v['phone'] : '';?></span></dd>
                        </dl>
                    </li>
                    <?php endforeach;?>
                </ul>
                <!--/ pro_list1 -->
            </div>
            <!--/ cont-->
        </div>
        <?php endif;?>
    </div>
    <!--/ w240-->
    <div class="clear"></div>
</div>
<?php $this->load->view('footer');?>
<script type="text/javascript">
    $(document).ready(function(){
        //imgPlayha("#jscityre_imgplaycont","#jscityre_imgplaypar");
        $(".d_clear").click(function(){
            $.post('<?php echo site_url('welcome/clear');?>',
                {},
                function(data)
                {
                    window.location.reload();
                },'json'
            );
        });
    });
</script>