<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-4">
                <h1>會員中心</h1>
            </div>
            <div class="col-lg-8 col-sm-8">
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo site_url();?>">首頁</a></li>
                    <li>會員中心</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<style>
    table.table-bordered tr > th{background-color: #E3E3E3;vertical-align: middle;line-height: 25px;}
</style>
<link href="<?php echo site_url()?>assets/admin_css/style.css" rel="stylesheet">
<div class="container">

<div class="row">
    <aside class="profile-nav col-lg-3">
      <section class="panel">
          <div class="user-heading round">
              <a href="javascript:;" id="ProfileLogo">
                <?php if(isset($cli_result->cli_logo)):?>
                    <img src="<?php echo $upload_path.$cli_result->cli_logo?>" alt="">
                <?php else:?>
                    <img src="<?php echo $upload_path?>no_image.png" alt="">
                <?php endif;?>
              </a>
              <h1><?php echo $cli_result->cli_title;?></h1>
              <p><?php echo $cli_result->cli_email;?></p>
          </div>
          <ul class="nav nav-pills nav-stacked">
            <li <?php if($views == "member_center_view"):?>class="active"<?php endif;?>><a href="<?php echo site_url().'member'?>"> <i class="icon-user"></i> Profile</a></li>
          </ul>
      </section>
    </aside>
    <aside class="profile-info col-lg-9">
      <section class="panel">
          <div class="bio-graph-heading">
              <h1> Profile Info</h1>
          </div>
          <div class="panel-body bio-graph-info">
              
                <form role="form" action="<?php echo site_url().'member/update'?>" method="POST" enctype="multipart/form-data" id="MemberForm">
                    <table class="table table-bordered">
                        <tr>
                            <th>接案者名稱:</th>
                            <td>
                                <div class="col-xs-10">
                                    <input type="text" class="form-control" name="cli_title" value="<?php echo $cli_result->cli_title;?>" id="cli_title" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>接案者Email:</th>
                            <td>
                                <div class="col-xs-10">
                                    <input type="email" class="form-control" name="cli_email" value="<?php echo $cli_result->cli_email?>" id="cli_email" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span style="color:red">上傳注意事項：照片請上傳500K以下之112*112像素jpg, jpeg, png檔</span>
                            </td>
                        </tr>
                        <tr>
                            <th>接案者Logo:</th>
                            <td>
                                <div class="col-xs-2">
                                    <span class="btn btn-default btn-file btn-sm">
                                        <i class="icon-cloud-upload"></i>
                                        新增相片 <input type="file" name="pic" id="uploadpic" uploadPath="<?php echo site_url().'user/update/photo'?>">
                                    </span>
                                </div>
                                <div class="col-xs-2">
                                    <div id="ClientLogo" style="width:50px; height: 50px; background-size:cover; background-reapt:none; <?php if(isset($cli_result->cli_logo)):?>background-image: url('<?php echo $upload_path.$cli_result->cli_logo?>')<?php endif;?>"></div>
                                </div>
                                <div class="col-xs-5">
                                    <div id="ErrorMsg" style="width:150px; height: 30px; background-color:rgba(255, 0, 0, 0.5); color:#fff; padding-top: 5px; text-align:center; display:none;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>接案者手機:</th>
                            <td>
                                <div class="col-xs-10">
                                    <input type="text" class="form-control" name="cli_mobile" value="<?php echo $cli_result->cli_mobile?>" id="cli_mobile" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>接案者身份:</th>
                            <td>
                                <div class="col-xs-10">
                                    <select name="cli_kind" id="cli_kind" class="selectpicker" data-style="btn-info">
                                        <?php 
                                            if(isset($cli_role)):
                                                foreach($cli_role as $row):
                                        ?> 
                                                    <option value="<?php echo $row->code_value1?>" <?php if($row->code_value1 == $cli_result->cli_kind):?> SELECTED <?php endif;?>><?php echo $row->code_name?></option>
                                        <?php
                                                endforeach;
                                            endif;
                                        ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>接案者自介1:</th>
                            <td>
                                <div class="col-xs-10">
                                    (最少50個字，若自介為廢文，一律不幫忙提案)
                                    <textarea name="cli_intro1" id="cli_intro1" class="form-control" rows="5" required><?php echo htmlspecialchars_decode($cli_result->cli_intro1)?></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>接案者自介2:</th>
                            <td>
                                <div class="col-xs-10">
                                    (最少50個字)
                                    <textarea name="cli_intro2" id="cli_intro2" class="form-control" rows="5"><?php echo htmlspecialchars_decode($cli_result->cli_intro2)?></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>接案者自介3:</th>
                            <td>
                                <div class="col-xs-10">
                                    (最少50個字)
                                    <textarea name="cli_intro3" id="cli_intro3" class="form-control" rows="5"><?php echo htmlspecialchars_decode($cli_result->cli_intro3)?></textarea><br />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>電子報訂閱</th>
                            <td>
                                <div class="radio">
                                <label>
                                    <input type="radio" name="agree_edm" id="agree_edm" value="1" <?php if($cli_result->agree_edm == 1):?>checked<?php endif;?>>
                                    是
                                </label>
                                </div>
                                <div class="radio">
                                <label>
                                    <input type="radio" name="agree_edm" id="agree_edm" value="0" <?php if($cli_result->agree_edm == 0):?>checked<?php endif;?>>
                                    否
                                </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center">
                                <button type="submit" class="btn btn-success btn-sm">儲存</button>
                            </td>
                        </tr>
                    </table>
                </form>
          </div>
      </section>
</div>
</div>
