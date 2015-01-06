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
                <li <?php if($views == "member_reply_center_view"):?>class="active"<?php endif;?>><a href="<?php echo site_url().'member/reply'?>"> <i class="icon-calendar"></i> 案件回覆 <span class="label label-danger pull-right r-activity"><?php echo $unread_cnt?></span></a></li>
          </ul>
      </section>
    </aside>
    <aside class="profile-info col-lg-9">
      <section class="panel">
          <div class="bio-graph-heading">
              <h1>回覆列表</h1>
          </div>
          <div class="panel-body bio-graph-info">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>回覆主旨</th>
                                <th>提案網址</th>
                                <th>回覆時間</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($reply_list)):?>
                            <?php foreach ($reply_list as $key => $row):?>
                            <tr>
                                <td><?php echo $key+1?></td>
                                <td><a href="<?php echo site_url().'member/reply/detail/'.$row->cml_id?>" <?php if($row->is_read == 1):?>style="color:#f77b6f"<?php endif;?>><?php echo $row->cml_title?></a></td>
                                <td><a href="<?php echo $row->case_url?>" target="_blank"><?php echo $row->case_url?></a></td>
                                <td><?php echo $row->modi_time?></td>
                            </tr>
                            <?php endforeach;?>
                        <?php else:?>
                            <tr>
                                <td colspan="4">No results.</td>
                            </tr>
                        <?php endif;?>
                        </tbody>
                    </table>
          </div>
            <div style="text-align:center">
                <ul class="pagination">
                    <?php echo $page_jump?>
                </ul>
            </div>
      </section>
</div>
</div>
