<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">
    <title>Young Talent - 我的履歷</title>    
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/reset.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/myinfo.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/mysite.css" type="text/css" media="all" >
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/myinfo.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/index.js"></script>
</head>

<body>
    <div id="maincontain">
        <div id="contentbox">
            <?php $this->load->view('_blocks/_header')?>
            <div id="bodybox01">
                <?php 
                if($data[0]->avatar == null &&  $data[0]->avatar == ""){
                    if($data[0]->fb_account == null && $data[0]->fb_account == ""){
                        $icon_path = site_url()."assets/templates/images/icon/head.png";
                    }else{
                        $icon_path = "https://graph.facebook.com/".$data[0]->fb_account."/picture?type=large" ;
                    }
                    
                }else{

                    $icon_path = site_url()."assets/avatar/".$data[0]->avatar;
                }

                ?>
                <div class="l"><img src="<?php echo $icon_path ?>" style="width:140px"/> </div>
                <div class="r">
                    <?php //print_r($data); ?>
                    <p class="name"><?php echo $data[0]->name?></p>
                    <p class="text"><?php echo $data[0]->about_self?></p>
                </div>
            </div>
            <div id="bodybox02">
                <a href="<?php echo site_url()."user/editinfo?account=".$account ?>" style="text-decoration:none"  ><div class="editinfo">編輯資料</div></a>
            </div>
            <div id="bodybox03">
                <div class="box">
                    <div class="contactinfo">
                        <div class="left">
                            <p>聯絡資訊</p>
                        </div>
                        <div class="reight">
                            <ul>
                                <li class="l1"><?php echo $data[0]->contact_tel ?></li>
                                <li class="l2"><?php echo $data[0]->contact_mail ?></li>
                                <li class="l3"><?php echo $data[0]->address_city.",".$data[0]->address_area ?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="birthdayinfo">
                        <div class="left">
                            <p>性別</p>
                        </div>
                        <div class="reight">
                            <?php 
                             $birthDate = explode("-", $data[0]->birth);
                              //get age from date or birthdate
                              $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                                ? ((date("Y") - $birthDate[0]) - 1)
                                : (date("Y") - $birthDate[0]));
                            

                            ?>
                            <ul>
                                <li class="l1"><?php echo $data[0]->birth ?> ，<?php echo $age ?>歲</li>                                
                            </ul>
                        </div>
                    </div>

                    <div class="sexinfo">
                        <div class="left">
                            <p>生日年紀</p>
                        </div>
                        <div class="reight">
                            <ul>
                                <li class="l1"><?php echo $data[0]->sex == 0?"女性":"男性"; ?></li>                                
                            </ul>
                        </div>
                    </div>

                    <div class="schoolinfo">
                        <div class="left">
                            <p>就學經歷</p>
                        </div>
                        <div class="reight">
                            <ul>

                                <?php  
                                    if(isset($data["schools"]))
                                    foreach ($data["schools"] as $key => $value) {
                                        echo "<li>".$value->school_name.",".($value->is_attend==1?"在學中":"已畢業")."</li>";
                                    }

                                ?>                    
                            </ul>
                        </div>
                    </div>

                    <div class="jobinfo">
                        <div class="left">
                            <p>工作經歷</p>
                        </div>
                        <div class="reight">
                            <ul>
                                <?php  
                                    if(isset($data["exp"]))
                                    foreach ($data["exp"] as $key => $value) {
                                        echo "<li>".$value->job_title."<br> ".$value->company_name." <span>".$value->job_start_date."~".$value->job_end_date."</span></li>";
                                    }

                                ?>   
                                
                            </ul>
                        </div>
                    </div>

                    <div class="skillinfo">
                        <div class="left">
                            <p>工作技能</p>
                        </div>
                        <div class="reight">
                            <ul>
                                <li>

                                <?php  
                                    if(isset($data["skills"]))
                                    foreach ($data["skills"] as $key => $value) {
                                        echo "<div class='item'>".$value->skill_name."</div>";
                                    }

                                ?>   
                                  
                                </li>                                
                            </ul>
                        </div>
                    </div>

                    <div class="stateinfo">
                        <div class="left">
                            <p>就業狀態</p>
                        </div>
                        <div class="reight">
                            <ul>
                                <li>
                                    <?php  
                                    if($data[0]->job_status == "0"){
                                        echo "在職";
                                    }elseif($data[0]->job_status == "1"){
                                        echo "在學";
                                    }else{
                                        echo "待業";
                                    }

                                ?> 
                                </li>                                
                            </ul>
                        </div>
                    </div>
                    <div class="stateinfo">
                        <div class="left">
                            <p>尋找工作</p>
                        </div>
                        <div class="reight">
                            <ul>
                                <li>
                                    <?php  
                                    if($data[0]->find_job_kind == "0"){
                                        echo "我目前在找打工";
                                    }elseif($data[0]->find_job_kind == "1"){
                                        echo "我目前在找全職工作";
                                    }

                                ?> 
                                </li>                                
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div id="bodybox04">
                <?php $this->load->view('_blocks/_facebook')?>
            </div>
        </div>
        <?php $this->load->view('_blocks/_footer')?>
    </div>
</body>
</html>

