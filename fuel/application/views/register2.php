<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">
    <title>Young Talent - 註冊步驟2</title>    
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/reset.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/register2.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/css/jquery.autocomplete.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-ui-1.11.0.custom/jquery-ui.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/mysite.css" type="text/css" media="all" >
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-ui-1.11.0.custom/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/register2.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/js/jquery.autocomplete.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/lib/jquery.twzipcode.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/index.js"></script>
</head>
<body>
    <div id="maincontain">
        <div id="contentbox">
            <?php $this->load->view('_blocks/_header')?>
            <div id="editbox">
                <div class="step2"></div>
                <div class="reight">
                    
                    <form action="<?php echo site_url()?>/register/step2_save/" method="POST" >                    
                        <input type="hidden" name="account" value="<?php echo $account ?>" />
                        <input type="hidden" name="token" value="<?php echo $token ?>" />
                        <div class="nameinfo">
                            <div class="left">
                                <p>姓名</p>
                            </div>
                            <div class="reight">
                                <ul>
                                    <li class="l1"><input type="text" name="name" id="name" value=""></li>
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
                                        <input type="radio" name="sex" value="1" checked><span>&nbsp;&nbsp;男</span>
                                        <input type="radio" name="sex" value="0"><span>&nbsp;&nbsp;女</span>
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
                                    <li class="l1"><input type="text" name="birth" id="birth" value="" placeholder="西元年-月-日" /></li>
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
                                    <li class="l1"><input type="text" name="contact_tel" id="contact_tel" value=""></li>
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
                                        <input type="text" name="address" id="address" placeholder="地址" value="">
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
                                    <li class="l1">
                                        <input type="text" class="school" name="school_id_1" id="school_id_1"  value=""><br>
                                        <div class="box">
                                            <input type="radio" class="schoolstate" name="school_state_1" value="G" checked>
                                            <span>畢業</span>
                                            <input type="radio" class="schoolstate" name="school_state_1" value="A">
                                            <span>在學</span>
                                        </div>
                                    </li>
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
                                    <li class="l1">
                                        <input type="text" name="job_company_name_1" value="" placeholder="公司" /><br>
                                        <input type="text" name="job_title_1" value="" placeholder="職稱" /><br>
                                        <input type="text" class="datestart datepicker1" name="job_start_date_1" placeholder="西元年-月-日" value="">
                                        &nbsp;&nbsp;&nbsp;~&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="dateend datepicker1" name="job_end_date_1" placeholder="西元年-月-日" value=""><br>
                                        <b>在職中，離職日期請留空</b>
                                    </li>
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
                                                            <option value="<?php echo $row->code_id?>" ><?php echo $row->code_name?></option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    <td  >
                                        <input type='button' id='btnRight' value ='  >  '/>
                                        <br/><br/><input type='button' id='btnLeft' value ='  <  '/>
                                    </td>
                                    <td >
                                        <select multiple="multiple" id='lstBox2' name="skill[]" >
                                            
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
                                        <input type="radio" name="now_status" value="0" checked><span>&nbsp;&nbsp;在職</span>
                                        <input type="radio" name="now_status" value="0"><span>&nbsp;&nbsp;在學</span>
                                        <input type="radio" name="now_status" value="0"><span>&nbsp;&nbsp;待業</span>
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
                                        <input type="radio" name="find_kind" value="0"  checked><span style="width:auto;">&nbsp;&nbsp;我目前在找打工&nbsp;&nbsp;</span>
                                        <input type="radio" name="find_kind" value="1"  ><span style="width:auto;">&nbsp;&nbsp;我目前在找全職工作</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- *** -->
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
                        <!-- *** -->
                        <div class="aboutmeinfo">
                            <div class="left">
                                <p>關於自己</p>
                            </div>
                            <div class="reight">
                                <ul>
                                    <li class="l1">
 
                                        <textarea name="about_self" id="about_self" placeholder="介紹一下你自已吧" rows="3" cols="40" maxlength="100"></textarea>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- *** -->
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
                    $("#school_id_1").autocomplete(school_data, {matchContains: true});  
                });

                 DATA.dom.addschool=$("#addschool");
                 DATA.dom.schoollist=$("ul.schoollist");

                 DATA.dom.addjob=$("#addjob");
                 DATA.dom.joblist=$("ul.joblist");

                 DATA.dom.addschool.click(function(){
                   num=DATA.dom.schoollist.children("li").size()+1;  
                   schoolItem = "<li class='l"+num+"'><input type='text' class='school' name='school_id_"+num+"' id='school_id_"+num+"' value=''><br><div class='box'><input type='radio' class='schoolstate' name='school_state_"+num+"' value='' checked><span>畢業</span><input type='radio' class='schoolstate'  name='school_state_"+num+"' value=''><span>在學</span></div></li>";  
                   DATA.dom.schoollist.append(schoolItem); 

                   $("#school_id_"+num).autocomplete(school_data, {matchContains: true});  
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

