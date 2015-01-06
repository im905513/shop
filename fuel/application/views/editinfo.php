<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">
    <title>Young Talent - 編輯履歷</title>    
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/reset.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/editinfo.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/css/jquery.autocomplete.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-ui-1.11.0.custom/jquery-ui.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/mysite.css" type="text/css" media="all" >
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-ui-1.11.0.custom/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/editinfo.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/js/jquery.autocomplete.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/lib/jquery.twzipcode.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/index.js"></script>
</head>

<body>
    <div id="maincontain">
        <div id="contentbox">
            <?php $this->load->view('_blocks/_header')?>
            <div id="editbox">
                <form action="<?php echo site_url()?>/user/do_edit/" method="POST" enctype="multipart/form-data" >  
                <div class="left">
                    <?php if($data[0]->avatar=="" && $data[0]->fb_account == ""){ ?>
                        <div class="head"></div>
                    <?php }elseif($data[0]->avatar!=""){ ?>
                        <div class="head" style="background:url(<?php echo site_url()."/assets/avatar/".$data[0]->avatar.")" ?>" ></div>
                     <?php }elseif($data[0]->fb_account!=""){ ?>
                     <img class="head" data-src="holder.js/140x140" alt="140x140" src="https://graph.facebook.com/<?php echo $data[0]->fb_account  ?>/picture?type=large" style="width: 140px; height: 140px;">
                       
                    <?php } ?>
                    <br /><span style="font-size:12px;">限制140x140以內，PNG的圖片</span>
                    <input type="file" name="avatar" id="avatar">
                   
                </div>
                <div class="reight">
                                  
                        <input type="hidden" name="account" value="<?php echo $account ?>" />
                        <input type="hidden" name="token" value="<?php //echo $token ?>" />
                        <div class="nameinfo">
                            <div class="left">
                                <p>姓名</p>
                            </div>
                            <div class="reight">
                                <ul>
                                    <li class="l1"><input type="text" name="name" id="name" value="<?php echo $data[0]->name?>"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sexinfo">
                            <div class="left">
                                <p>性別</p>
                            </div>
                            <div class="reight">
                                <ul>
                                    <li class="l1">
                                        <input type="radio" name="sex" value="1" <?php echo $data[0]->sex==1?"checked":""; ?> ><span>&nbsp;&nbsp;男</span>
                                        <input type="radio" name="sex" value="0" <?php echo $data[0]->sex==0?"checked":""; ?> ><span>&nbsp;&nbsp;女</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- *** -->
                        <div class="birthdayinfo">
                            <div class="left">
                                <p>生日</p>
                            </div>
                            <div class="reight">
                                <ul>
                                    <li class="l1"><input type="text" name="birth" id="birth" value="<?php echo $data[0]->birth?>" placeholder="yyyy-MM-dd" /></li>
                                </ul>
                            </div>
                        </div>
                        <!-- *** -->
                        <div class="phoneinfo">
                            <div class="left">
                                <p>聯絡電話</p>
                            </div>
                            <div class="reight">
                                <ul>
                                    <li class="l1"><input type="text" name="contact_tel" id="contact_tel" value="<?php echo $data[0]->contact_tel?>"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="addressinfo">
                            <div class="left">
                                <p>聯絡地址</p>
                            </div>
                            <div class="reight">
                                <ul>
                                    <li class="l1">
                                        <div id="twzipcode"></div>
                                        <input type="text" name="address" id="address" placeholder="地址" value="<?php echo $data[0]->address?> ">
                                    </li>
                                </ul>
                                
                            </div>
                        </div>
                        <!-- *** -->
                        <div class="schoolinfo">
                            <div class="left">
                                <p>學校</p>
                            </div>
                            <div class="reight">
                                <ul class="schoollist">


                                 <?php  
                                    $count = 1;
                                    if(isset($data["schools"]))
                                    foreach ($data["schools"] as $key => $value) {
                                    // print_r($value);
                                ?>   
                                    <li class="l<?php echo $count ?>">
                                        <input type="text" class="school" name="school_id_<?php echo $count ?>" value="<?php echo $value->school_name ?>"><br>
                                        <div class="box">

                                            <input type="radio" class="schoolstate" name="school_state_<?php echo $count ?>" value="G" <?php echo $value->is_attend==0?"checked":""; ?> >
                                            <span>畢業</span>
                                            <input type="radio" class="schoolstate" name="school_state_<?php echo $count ?>" value="A" <?php echo $value->is_attend==1?"checked":""; ?> >
                                            <span>在學</span>
                                        </div>
                                    </li>

                                 <?php
                                      $count++;  
                                    }
                                ?>       
                                </ul>
                                <div id="addschool">新增一筆學校</div>
                            </div>
                        </div>                        
                        <!-- *** -->
                        <div class="jobinfo">
                            <div class="left">
                                <p>工作經驗</p>
                            </div>
                            <div class="reight">
                                <ul class="joblist">
                                    

                                <?php  
                                    $count = 1;
                                    
                                    if(isset($data["exp"]))
                                    foreach ($data["exp"] as $key => $value) {
                                    
                                ?>    
                                    <li class="l<?php echo $count ?>">
                                        <input type="text" name="job_company_name_<?php echo $count ?>" value="<?php echo $value->company_name ?>" placeholder="公司" /><br>
                                        <input type="text" name="job_title_<?php echo $count ?>" value="<?php echo $value->job_title ?>" placeholder="職稱" /><br>
                                        <input type="text" class="datestart datepicker<?php echo $count ?>" name="job_start_date_<?php echo $count ?>" placeholder='西元年-月-日' value="<?php echo $value->job_start_date ?>">
                                        &nbsp;&nbsp;&nbsp;~&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="dateend datepicker<?php echo $count ?>" name="job_end_date_<?php echo $count ?>" placeholder='西元年-月-日' value="<?php echo $value->job_end_date ?>"><br>
                                        <b>在職中，離職日期請留空</b>
                                    </li>
                                <?php
                                    $count++;  
                                    }
                                ?>           
                                       
                                </ul>

                                <div id="addjob">新增一筆經驗</div>
                            </div>
                        </div>
                        <!-- *** -->
                        <div class="skillinfo">
                            <div class="left">
                                <p>工作技能</p>
                            </div>
                            <div class="reight">
                                <table >
                                    <tr>
                                        <td > 
                                           <select multiple="multiple" id='lstBox1'>
                                               <?php
                                                    if(isset($skill_list))
                                                    {
                                                        foreach ($skill_list as $key => $row) 
                                                        {
                                                ?>
                                                            <option value   ="<?php echo $row->code_id?>" ><?php echo $row->code_name?></option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    <td  >
                                        <input type='button' id='btnRight' value ='  >  '/>
                                        <br/> <br/><input type='button' id='btnLeft' value ='  <  '/>
                                    </td>
                                    <td >
                                        <select multiple="multiple" id='lstBox2' name="skill[]" >
                                         <?php
                                                    if(isset($user_skill_list))
                                                    {
                                                        foreach ($user_skill_list as $key => $row) 
                                                        {
                                                ?>
                                                            <option value="<?php echo $row->code_id?>" selected="selected"><?php echo $row->code_name?></option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                        </select>
                                    </td>
                                </tr>
                                </table>
                            </div>
                        </div>
                        <!-- *** -->
                        <div class="employmentstatusinfo">
                            <div class="left">
                                <p>就業狀態</p>
                            </div>
                            <div class="reight">
                                <ul>
                                    <li class="l1">
                                        <input type="radio" name="now_status" value="0" <?php echo $data[0]->job_status==0?"checked":""; ?> ><span>&nbsp;&nbsp;在職</span>
                                        <input type="radio" name="now_status" value="1" <?php echo $data[0]->job_status==1?"checked":""; ?> ><span>&nbsp;&nbsp;在學</span>
                                        <input type="radio" name="now_status" value="2" <?php echo $data[0]->job_status==2?"checked":""; ?> ><span>&nbsp;&nbsp;待業</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- *** -->
                        <!-- *** -->
                        <div class="employmentstatusinfo">
                            <div class="left">
                                <p>尋找工作</p>
                            </div>
                            <div class="reight">
                                <ul>
                                    <li class="l1">
                                        <input type="radio" name="find_kind" value="0" <?php echo $data[0]->find_job_kind==0?"checked":""; ?> ><span style="width:auto;">&nbsp;&nbsp;我目前在找打工&nbsp;&nbsp;</span>
                                        <input type="radio" name="find_kind" value="1" <?php echo $data[0]->find_job_kind==1?"checked":""; ?> ><span style="width:auto;">&nbsp;&nbsp;我目前在找全職工作</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- *** -->
                        <?php if($data[0]->recommended == null || $data[0]->recommended == ""){ ?>
                        <div class="recommendedinfo">
                            <div class="left">
                                <p>推薦人</p>
                            </div>
                            <div class="reight">
                                <ul>
                                    <li class="l1"><input type="text" name="recommended" value="<?php echo $recommended_id ?>"></li>
                                </ul>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="aboutmeinfo">
                            <div class="left">
                                <p>關於自己</p>
                            </div>
                            <div class="reight">
                                <ul>
                                    <li class="l1"> 
                                        <textarea name="about_self" id="about_self" placeholder="介紹一下你自已吧" rows="3" cols="40" maxlength="100"><?php echo $data[0]->about_self ?></textarea>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php if($data[0]->fb_account == null || $data[0]->fb_account == ""){ ?>
                    <div class="aboutmeinfo">
                            <div class="left">
                                <p>與Facebook連結</p>
                            </div>
                            <div class="reight">
                                <ul>
                                    <li class="l1"> 
                                        <a href="<?php echo $fb_data['login_url'] ?>" ><img src="<?php echo site_url()?>assets/templates/images/icon/facebook-connect.png" /></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="submitbox">
                            <span class="msg"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="submit" class="submit" value="送出">
                        </div>


                    </form>
                </div>
            </div>
            <div id="fbbox">
                <?php $this->load->view('_blocks/_facebook')?>
            </div>
        </div>
        <?php $this->load->view('_blocks/_footer')?>
    </div>
    <script type="text/javascript">
           

           jQuery(document).ready(function($) {
             
                $('#twzipcode').twzipcode({
                    countyName: 'address_city',
                    districtName: 'address_area',
                    zipcodeName: 'address_zip',
                    countySel: '<?php echo $data[0]->address_city?>',
                    districtSel: '<?php echo $data[0]->address_area?>',
                    zipcodeSel: '<?php echo $data[0]->address_zip?>',
                    
                    'css': [
                                'addr-county', //縣市
                                'addr-distrcit',  // 鄉鎮市區
                                'addr-zip' // 郵遞區號
                            ]
                });
                var school_data;

                $.ajax({
                url: '<?php echo site_url(); ?>register/school' ,
                cache: false
                }).done(function (data) { 
                    school_data = $.parseJSON(data); 
                    // alert(school_data);
                    // $("#school_id_1").autocomplete(school_data, {matchContains: true});  
                    // alert(school_data);
                    $(".school").autocomplete(school_data, {matchContains: true}); 
                });

                DATA.dom.addschool=$("#addschool");
                DATA.dom.schoollist=$("ul.schoollist");


                DATA.dom.addjob=$("#addjob");
                DATA.dom.joblist=$("ul.joblist");


                DATA.dom.addschool.click(function(){
                   num=DATA.dom.schoollist.children("li").size()+1;  
                   schoolItem = "<li class='l"+num+"'><input type='text' class='school' name='school_id_"+num+"' id='school_id_"+num+"' value=''><br><div class='box'><input type='radio' class='schoolstate' name='school_state_"+num+"' value='' checked><span>畢業</span><input type='radio' class='schoolstate'  name='school_state_"+num+"' value=''><span>在學</span></div></li>";  
                   DATA.dom.schoollist.append(schoolItem); 

                   // $("#school_id_"+num).autocomplete(school_data, {matchContains: true});
                   $(".school").autocomplete(school_data, {matchContains: true});   
                });

                DATA.dom.addjob.click(function(){
                   num=DATA.dom.joblist.children("li").size()+1; 
                   jobItem ="<li class='l"+num+"'><input type='text' name='job_company_name_"+num+"' value='' placeholder='公司' /><br><input type='text' name='job_title_"+num+"' value='' placeholder='職稱' /><br><input type='text' class='datestart datepicker"+num+"' name='job_start_date_"+num+"' placeholder='西元年-月-日' value=''>&nbsp;&nbsp;&nbsp;~&nbsp;&nbsp;&nbsp;<input type='text' class='dateend datepicker"+num+"' name='job_end_date_"+num+"' placeholder='西元年-月-日' value=''><br><b>在職中，離職日期請留空</b></li>";
                   DATA.dom.joblist.append(jobItem);
                   $( ".datepicker"+num ).datepicker({ dateFormat: 'yy-mm-dd' });
                });

                $('#btnRight').click(function(e) {
                    var selectedOpts = $('#lstBox1 option:selected');
                    if (selectedOpts.length == 0) {
                        // alert("Nothing to move.");
                        e.preventDefault();
                    } 
                    
                    $('#lstBox2').append($(selectedOpts).clone());
                    $(selectedOpts).remove();
                    // $("#lstBox1 option").prop("selected", "selected");
                    $("#lstBox2 option" ).each(function() {
                        // console.log($(this));
                        $(this).attr('selected', true);
                       // $(this).prop("selected", "selected");
                    });
                    e.preventDefault();
                });

                $('#btnLeft').click(function(e) {
                    var selectedOpts = $('#lstBox2 option:selected');
                    if (selectedOpts.length == 0) {
                        // alert("Nothing to move.");
                        e.preventDefault();
                    }

                    $('#lstBox1').append($(selectedOpts).clone());
                    $(selectedOpts).remove();
                    e.preventDefault();
                });

            });
           

    </script>
</body>
</html>

