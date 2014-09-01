<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb"><span class="icon">当前位置：</span><a href="<?php echo site_url();?>">首页</a> &gt; <a href="javascript:void(0);">客户至上</a></div>
    <!--/ crumbs_nav-->
    <?php $this->load->view('about/menu');?>
    <!--/ w190-->
    <div class="w800 fl">
        <div class="ui_box2">
            <div class="title">
                <h2 class="tith"><strong class="i2">客户至上</strong></h2>
            </div>
            <!--/ title-->
            <div class="cont about_box mh400">
                <div class="about_title mb15">我们的客户列表</div>
                <!--/ about_title-->
                <div class="about_news_list">
                    <ul class="mb20">
                        <li><a href="#" class="link mr15">客户名称1</a></li>
                        <li><a href="#" class="link mr15">客户名称1</a></li>
                        <li><a href="#" class="link mr15">客户名称1</a></li>
                        <li><a href="#" class="link mr15">客户名称1</a></li>
                        <li><a href="#" class="link mr15">客户名称1</a></li>
                    </ul>

                    <?php $this->load->view('pagination');?>
                    <!--/ page-->

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