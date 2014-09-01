<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb"><span class="icon">当前位置：</span><a href="<?php echo site_url();?>">首页</a> &gt; <a href="javascript:void(0);">公司新闻</a></div>
    <!--/ crumbs_nav-->
    <?php $this->load->view('about/menu');?>
    <!--/ w190-->
    <div class="w800 fl">
        <div class="ui_box2">
            <div class="title">
                <h2 class="tith"><strong class="i2">公司新闻</strong></h2>
            </div>
            <!--/ title-->
            <div class="cont about_box mh400">
                <div class="about_title mb15">我们的客户列表</div>
                <!--/ about_title-->
                <div class="about_news_list">
                    <ul class="mb20">
                        <li><span class="time fr">2012年2月2日</span><a href="#" class="link">2013年X月X日，公司注册成立</a></li>
                        <li><span class="time fr">2012年2月2日</span><a href="#" class="link">2013年X月X日，公司网站上线</a></li>
                        <li><span class="time fr">2012年2月2日</span><a href="#" class="link">2013年X月X日，第一个合伙伙伴加入</a></li>
                        <li><span class="time fr">2012年2月2日</span><a href="#" class="link">2013年X月X日，第一个客户签约</a></li>
                        <li><span class="time fr">2012年2月2日</span><a href="#" class="link">2013年X月X日，第一个合伙伙伴加入</a></li>
                    </ul>

                    <?php $this->load->view('pagination');?>

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