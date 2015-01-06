<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=0.5, maximum-scale=0.5, minimum-scale=0.5 , user-scalable=no"  />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title></title>    
    <link rel="stylesheet" href="<?php echo site_url()?>assets/mobile_template/css/reset.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/mobile_template/css/style.css" type="text/css" media="all" >
    <script type="text/javascript" src="<?php echo site_url()?>assets/mobile_template/Scripts/lib/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/mobile_template/Scripts/index.js"></script>
</head>

<body>
    <div id="maincontain">        
        <div id="banner">
            <a href="<?php echo site_url()?>register/" class="registration">註&nbsp;冊</a>
            <a href="<?php echo site_url()?>home/login/" class="login">或&nbsp;&nbsp;&nbsp;&nbsp;登入帳號</a>
        </div>
    <!--
        <div id="title">
            合作夥伴
        </div>
        <div id="partner">
            <img src="<?php echo site_url()?>assets/mobile_template/images/pic/pic2.jpg">
        </div>
    -->
        <?php $this->load->view('_blocks/_m_footer')?>
    </div>
    <div id="header">
            <div id="logo"></div>
    </div>
    <?php $this->load->view('_blocks/_m_menu')?>
</body>
</html>

