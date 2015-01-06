<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">
    <title></title>    
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/reset.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/campusevents.css" type="text/css" media="all" >
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/campusevents.js"></script>
</head>

<body>
    <div id="maincontain">
        <div id="contentbox">
            <?php $this->load->view('_blocks/_header')?>
            <div id="bodybox01">
                <img src="<?php echo site_url()?>assets/templates/images/pic/pic9.png">
            </div>
            <div id="bodybox02">
                <p class="title">紮根青春，成就夢想</p>
                <p class="content">
                    許多工作其實都不用工作經驗，也用不到履歷表。填寫履歷就成了一個多餘又麻煩的事情，那何不把它省略呢？因此，我們只需要您的基本資料, 就可以幫您找到許多打工機會以及初階工作，而且這一切都是免費的!好工作，不找嗎?許多工作其實都不用工作經驗，也用不到履歷表。填寫履歷就成了一個多餘又麻煩的事情，那何不把它省略呢!因此，我們只需要您的基本資料，就可以幫您找到許多打工機會以及初階工作，而且這一切都是免費的!好工作，不找嗎?
                </p>
                <div id="logdata"></div>
            </div>
            <div id="bodybox03">
                <img src="<?php echo site_url()?>assets/templates/images/pic/pic10.png">
            </div>
            <?php echo fuel_block("campusevents") ?>
            <div id="bodybox05">
                <?php $this->load->view('_blocks/_facebook')?>
            </div>

        </div>
        <?php $this->load->view('_blocks/_footer')?>
    </div>
    <!-- *** -->
    <div id="wall"></div>
</body>
</html>

