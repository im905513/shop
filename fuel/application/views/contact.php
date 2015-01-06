<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">
    <title>Young Talent - 聯絡我們</title>    
    <meta property="og:title" content="Young Talent - 聯絡我們" />
    <meta property="og:description" content="年輕，就是你的優勢！我們是專屬於學生的工作職缺網站！累積工作經驗，從現在開始。我們有經過認證的工作職缺，把關的安全工作環境讓你的起步就是比別人快！" />
    <meta property="og:url" content="<?php echo site_url()?>" />
    <meta property="og:image" content="<?php echo site_url()?>assets/templates/images/pic/og_image.jpg" />   
    
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/reset.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/contact.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/mysite.css" type="text/css" media="all" >
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/js/jquery-migrate-1.2.1.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/js/jquery.autocomplete.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/contact.js"></script>
</head>

<body>
    <div id="maincontain">
        <div id="contentbox">
            <?php $this->load->view('_blocks/_header')?>
            <div id="bodybox01">
                <img src="<?php echo site_url()?>assets/templates/images/pic/pic8.png">
            </div>
            <div id="bodybox02" style="height:auto">
                <form name="contact_form" id="contact_form" action="<?php echo site_url()?>/home/do_contact/" method="POST">
                <p class="title">聯絡我們</p>
                <p class="desc">如果您有任何聯絡事項，歡迎使用下列表單聯絡我們。</p>
                    <div class="item">
                        <div class="ll">稱呼</div>
                        <div class="rr"><input type="text" name="name" class="name"></div>
                    </div>
                    <div class="item">
                        <div class="ll">EMAIL</div>
                        <div class="rr"><input type="text" name="mail" class="mail"></div>
                    </div>
                    <div class="item">
                        <div class="ll">聯絡電話</div>
                        <div class="rr"><input type="text" name="phone" class="phone"></div>
                    </div>
                   <div class="item">
                        <div class="ll">聯絡事項</div>
                        <div class="rr">
                             <ul>
                                <li class="l1">
                                    <input style="width:auto;" type="radio" name="contact_type" value="0" checked="checked"><span style="width:auto;">&nbsp;問題回報&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <input style="width:auto;" type="radio" name="contact_type" value="1" ><span style="width:auto;">&nbsp;合作提案&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <input style="width:auto;" type="radio" name="contact_type" value="2" ><span style="width:auto;">&nbsp;職缺登錄&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="job_div" style="display:none">                
                   <div class="item">
                        <div class="ll">公司名稱</div>
                        <div class="rr"><input type="text" name="job_company_name" class="phone"></div>
                    </div>
                   <div class="item">
                        <div class="ll">工作地點</div>
                        <div class="rr"><input type="text" name="job_address" class="phone"></div>
                    </div>
                    <div class="item" style="height:110px;">
                        <div class="ll">薪水</div>
                        <div class="rr">

                                    <span style="width:auto;">&nbsp;時薪&nbsp;<input style="width:auto;"type="text" name="job_salary_hour" class="phone"></span><br />
                                    <span style="width:auto;">&nbsp;週薪&nbsp;<input style="width:auto;" type="text" name="job_salary_week" class="phone"></span><br />
                                    <span style="width:auto;">&nbsp;月薪&nbsp;<input style="width:auto;" type="text" name="job_salary_month" class="phone"></span><br />

                        </div>
                    </div>

                      <div class="item" style="height:200px;">
                            <div class="ll">
                                可以學到的工作技能
                            </div>
                            <div class="rr">
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
                                        <input type='button' id='btnRight1' value ='  >  '/>
                                        <br/> <br/><input type='button' id='btnLeft1' value ='  <  '/>
                                    </td>
                                    <td >
                                        <select multiple="multiple" id='lstBox2' name="learn_skill[]" >
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
                        <div class="item" style="height:200px;">
                            <div class="ll">
                                需具備的工作技能
                            </div>
                            <div class="rr">
                                <table >
                                    <tr>
                                        <td > 
                                           <select multiple="multiple" id='lstBox3'>
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
                                        <input type='button' id='btnRight2' value ='  >  '/>
                                        <br/> <br/><input type='button' id='btnLeft2' value ='  <  '/>
                                    </td>
                                    <td >
                                        <select multiple="multiple" id='lstBox4' name="require_skill[]" >
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
                    </div>
                    <div class="item" style="height:200px">
                        <div class="ll">聯絡內容</div>
                        <div class="rr" ><textarea style="height:200px" name="content" id="content" placeholder="聯絡內容填打" rows="3" cols="10" maxlength="50"></textarea></div>
                    </div>
                    <div class="item">
                        <?php 

                            $num1 = rand(0, 9);
                            $num2 = rand(0, 9);
                            $num = $num1 + $num2;
                         ?>
                        <div class="ll">驗證碼</div>
                        <div class="rr"><input type="text" name="captchaImage" style="width:auto" size="6" value="<?php echo $num1 ?> + <?php echo $num2 ?>" disabled="disabled" />&nbsp;&nbsp;<input type="text" name="verificationcode" id="verificationcode" class="verificationcode" placeholder="請輸入左邊的答案"/></div>
                    </div>
                    <div class="item">
                        <div class="ll">&nbsp;</div>
                        <div class="rr"><input type="submit" name="submit" class="submit"></div>
                    </div>
                    </form>
            </div>
            <div id="bodybox03">
                <?php $this->load->view('_blocks/_facebook')?>
            </div>
        </div>
        <?php $this->load->view('_blocks/_footer')?>
    </div>
    <!-- *** -->
    <div id="wall"></div>
     <script type="text/javascript">
           $.validator.methods.equal = function(value, element, param) {
                return value == param;
            };


           jQuery(document).ready(function($) {
                $('input:radio[name="contact_type"]').change(
                    function(){

                        if ($(this).is(':checked') && $(this).val() == '2') {

                            
                            $( "#job_div" ).show();
                        }else{
                            //alert($(this).val());
                            $( "#job_div" ).hide();
                        }
                });
                $('#btnRight1').click(function(e) {
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

                $('#btnLeft1').click(function(e) {
                    var selectedOpts = $('#lstBox2 option:selected');
                    if (selectedOpts.length == 0) {
                        // alert("Nothing to move.");
                        e.preventDefault();
                    }

                    $('#lstBox1').append($(selectedOpts).clone());
                    $(selectedOpts).remove();
                    e.preventDefault();
                });


                $('#btnRight2').click(function(e) {
                    var selectedOpts = $('#lstBox3 option:selected');
                    if (selectedOpts.length == 0) {
                        // alert("Nothing to move.");
                        e.preventDefault();
                    } 
                    
                    $('#lstBox4').append($(selectedOpts).clone());
                    $(selectedOpts).remove();
                    // $("#lstBox1 option").prop("selected", "selected");
                    $("#lstBox4 option" ).each(function() {
                        // console.log($(this));
                        $(this).attr('selected', true);
                       // $(this).prop("selected", "selected");
                    });
                    e.preventDefault();
                });

                $('#btnLeft2').click(function(e) {
                    var selectedOpts = $('#lstBox4 option:selected');
                    if (selectedOpts.length == 0) {
                        // alert("Nothing to move.");
                        e.preventDefault();
                    }

                    $('#lstBox3').append($(selectedOpts).clone());
                    $(selectedOpts).remove();
                    e.preventDefault();
                });

                $("#contact_form").validate({
                        rules: {
                            name: "required",
                            mail: "required",
                            phone: "required",
                            verificationcode: {
                                equal: <?php echo $num ?>   
                            }
                        },
                        messages: {
                            lastName: "Your last name is required",
                            verificationcode: " 錯誤"
                        }
                    });


            });
           

    </script>
</body>
</html>

