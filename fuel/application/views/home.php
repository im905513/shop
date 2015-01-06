 <!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">
    <title>Young Talent - 首頁</title> 
    <meta property="og:title" content="Young Talent - 首頁" />
    <meta property="og:description" content="年輕，就是你的優勢！我們是專屬於學生的工作職缺網站！累積工作經驗，從現在開始。我們有經過認證的工作職缺，把關的安全工作環境讓你的起步就是比別人快！" />
    <meta property="og:url" content="<?php echo site_url()?>" />
    <meta property="og:image" content="<?php echo site_url()?>assets/templates/images/pic/og_image.jpg" />   
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/reset.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/style.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/mysite.css" type="text/css" media="all" >
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&appId=787884584567146&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/index.js"></script>


</head>

<body>
    <div id="maincontain">
        <div id="contentbox">

            <?php  $this->load->view('_blocks/_header')?>

            <div id="bodybox01" >
                <div class="top">
                    <?php echo fuel_block("index_partners_icon") ?>
                </div>
                <div class="bottom" style="display:hidden">
                    <h2>就是你，年輕人</h2>
                    <p>
我們是由資深人力資源團隊及數家國際級人力資源顧問公司共同建置之平台，與年輕的學生團隊聯合執行管理。在Young Talent的團隊中，我們重視年輕人的價值，同時強調創意的執行。我們比其他人懂你們求職的需求以及對未來的期待!
提早加入我們，登錄你的簡歷，提早替你的履歷加分!在Young Talent你可以收到豐富的職缺訊息，職場趨勢。我們不定期舉辦各式活動，讓新鮮人保持新鮮，履歷、經歷、腦袋卻絕不陽春!
                    </p>
                </div>
            </div>
            <div id="bodybox02">
                  <?php echo fuel_block("index_bodybox02") ?>
            </div>
            <div id="bodybox03">
                <img src="<?php echo site_url()?>assets/templates/images/pic/pic2.png">
            </div>
            <?php echo fuel_block("index_text") ?>
            <div id="bodybox06">
                <?php $this->load->view('_blocks/_facebook')?>
            </div>
        </div>
        <?php $this->load->view('_blocks/_footer')?>
        
    </div>
    <!-- *** -->
    <div id="wall"></div>
    

</body>
</html>

