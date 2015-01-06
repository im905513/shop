<?php
$this->load->model('code_model');
$account = $this->code_model->get_logged_in_account();
$recommended_id = $this->input->get("recid");
if($recommended_id != null && $recommended_id  != ""){
    $this->load->helper('cookie');
    $this->input->set_cookie("ytalent_recommended_id","", time()-3600);
    $this->input->set_cookie("ytalent_recommended_id",$recommended_id, time()+3600);
}

//echo $title;

//echo $this->input->cookie("ytalent_recommended_id");

?>

<div id="headerbox">
    <a class="logo" href="<?php echo site_url()?>"></a>
    <ul class="menu">
       <!-- <li><a href="<?php echo site_url()?>home/campusevents/">校園活動</a></li>
        <li><a href="<?php echo site_url()?>home/aboutus/">關於我們</a></li>    -->    
             
    </ul>


    <?php if(1==1){ ?>

    <?php if($account != null && $account != ""){?>
    <a href="<?php echo site_url()?>user/myinfo" alt="檢視我的檔案"><div id="myinfobox" ></div></a>
    <a href="<?php echo site_url()?>user/logout" alt="登出"><div id="logout" ></div></a>
    <?php }else{ ?>
    <div id="loginbox">登入</div>
    <?php } ?>
    <div id="logdata"></div>
    
    
    
    <!--<div class="fb"></div>-->
    <?php }?>
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52531873-1', 'auto');
  ga('send', 'pageview');

</script>
