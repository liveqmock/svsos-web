<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8,IE=EmulateIE9" />
    <meta name="author" content="www.svsos.com" />
    <meta name="Keywords" content="家电" />
    <meta name="Description" content="" />
    <meta property="qc:admins" content="30752705476363736375" />
    <meta property="wb:webmaster" content="cea438a03b94b2b8" />
    <title>随售网</title>
    <link rel="shortcut icon" href="<?php echo site_url('assets/images/favicon.ico');?>" type="image/x-icon" />
    <link href="<?php echo site_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url('assets/css/layout.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url('assets/css/assist.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url('assets/css/easydialog.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url('assets/css/validform.css');?>" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript" src="<?php echo site_url('assets/js/jquery-1.11.1.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/main.js');?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/easydialog.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/verify.js');?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/validform.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
    <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
        <script src="<?php echo site_url('assets/bootstrap/js/respond.min.js');?>" type="text/javascript"></script>
    <![endif]-->
</head>

<body>
<?php
    $islogin = $this->session->userdata('is_login');
    $userInfoSession = $this->session->userdata('userInfo');
?>
<div class="toolbar">
    <div class="tool">
        <div class="site_l fl"><span class="mr5">您好，欢迎光临随售网！</span>
            <?php if(!$islogin):?>
            <a href="<?php echo site_url('login');?>">用户登录</a><span class="line">|</span>
            <a href="<?php echo site_url('reg');?>">免费注册</a>
            <?php endif;?>
        </div>
        <div class="site_r fr">
            <a onclick="setHomepage()" style="cursor:pointer">设为首页</a>
            <span class="line">|</span>
            <a onclick="addFavorite()" style="cursor:pointer">加入收藏</a></div>
        </div>
</div>
<!--/ toolbar-->

<div id="header" class="mb">
  <div class="headtop clearfix">
      <div class="logo"><a href="<?php echo base_url();?>"><img src="<?php echo site_url("assets/images/logo.png");?>"></img></a></div>
      <!--/ logo-->
      <div class="slogan">做中国最好的售后服务平台 </div>
      <!--/ slogan-->
      <!--search box-->
      <div class="ss_search_box">
        <form class="ss_search_form" action=""  method="get">
            <div class="ss_search_panel">
                <div class="ss_search_input_wrap">
                    <input type="text" class="ss_search_input" placeholder="请输入搜索关键字">
                </div>
                <input type="submit" value="搜 索" class="ss_search_button">
            </div>
        </form>
       </div>
    <!--/search box-->
    </div>
    <!--/ headtop-->

    <div id="nav">
        <div class="nav_box">
            <ul class="select_main fl clearfix">
                <li <?php echo (isset($menu) && ($menu == 'search')) ? 'class="hover"' : '';?>><a href="<?php echo base_url();?>"><span>找网点</span></a></li>
                <li class="line"></li>
                <li <?php echo (isset($menu) && ($menu == 'service')) ? 'class="hover"' : '';?>><a href="<?php echo base_url('service/order');?>"><span>我的服务</span></a></li>
                <li class="line"></li>
                <li <?php echo (isset($menu) && ($menu == 'brand')) ? 'class="hover"' : '';?>><a href="<?php echo base_url('brand');?>"><span>品牌服务热线</span></a></li>
                <li class="line"></li>
                <li <?php echo (isset($menu) && ($menu == 'about')) ? 'class="hover"' : '';?>><a href="<?php echo site_url('about/us');?>"><span>关于我们</span></a></li>
            </ul>
            <div class="select_other clearfix">
                <?php if(!$islogin):?>
                    <button type="button" class="btn"><i class="icon-user"></i><a href="<?php echo site_url('login');?>">登陆</a></button>
                    
                <?php else:?>
                 <ul>
                    <li id="fat-menu" class="dropdown">
                         <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> <?php echo $userInfoSession['nickname'] ;?>
                            <span class="caret"></span>
                         </button>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="<?php echo site_url('user/profile');?>">个人设置</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="<?php echo site_url('reg/logout');?>">退出登录</a></li>
                        </ul>
                    </li>
                  </ul>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<!--/ header-->