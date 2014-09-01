<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <title>随售网</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link href="<?php echo site_url('assets/css/layout.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url('assets/css/assist.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url('assets/css/easydialog.css');?>" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo site_url('assets/js/jquery-1.4.2.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/main.js');?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/easydialog.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/verify.js');?>"></script>
</head>

<body>
<?php $userInfoSession = $this->session->userdata('userInfo');?>
<!--/ toolbar-->

<div id="header" class="mb">
    <div class="headtop clearfix">
        <div class="logo"><a href="<?php echo base_url();?>">随售网</a></div>
        <!--/ logo-->
        <div class="slogan">做中国最好的售后服务平台 </div>
        <!--/ slogan-->

        <div class="tips_kh clearfix"></div>
        <!--/ tips_kh-->
    </div>
    <!--/ headtop-->

    <div id="nav">
        <div class="nav_box">
            <ul class="select_main fl clearfix">
                <li class="hover"><a href="javascript:void(0);"><span>后台管理</span></a></li>
            </ul>
            <?php if($userInfoSession):?>
            <div class="select_other clearfix">
                <div class="sbox">
                    <a class="icon" href="<?php echo site_url('service/setting');?>">您好,
                        <?php echo (isset($userInfoSession['name']) && !empty($userInfoSession['name'])) ? mySubStr($userInfoSession['name'],8) : mySubStr($userInfoSession['account'],8) ;?>
                    </a>
                    <span class="line">|</span>
                    <a href="<?php echo site_url('reg/logout');?>">退出</a>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>
<!--/ header-->