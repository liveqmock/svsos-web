<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb"><span class="icon">当前位置：</span><a href="<?php echo site_url();?>">首页</a> &gt; <a href="javascript:void(0);">联系我们</a></div>
    <!--/ crumbs_nav-->
    <?php $this->load->view('about/menu');?>
    <!--/ w190-->
    <div class="w800 fl">
        <div class="ui_box2">
            <div class="title">
                <h2 class="tith"><strong class="i2">联系我们</strong></h2>
            </div>
            <!--/ title-->
            <div class="cont about_box mh400">

                <div class="about_cont">
                    公司地址：<br />
                    公司服务热线：<br />
                    公司电话：<br />
                    公司邮箱：<br />
                    网站管理员：
                </div>
                <!--/ about_cont-->
            </div>
            <!--/ cont-->
        </div>
        <!--/ ui_box2-->
    </div>
    <!--/ w800-->
    <div class="clear"></div>
</div>
<?php $this->load->view('footer');?>