<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-4">
                <h1>接案內容</h1>
            </div>
            <div class="col-lg-8 col-sm-8">
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo site_url();?>">首頁</a></li>
                    <li><a href="<?php echo site_url();?>case">找案子</a></li>
                    <li class="active"><?php echo $case_detail->cd_title?></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-3 col-sm-3">
            <div class="row">
                <div class="date-wrap" style="width:165px;">
                    <span class="date"><?php echo $date_d;?></span>
                    <span class="month"><?php echo $date_m;?></span>
                </div>
            </div>
            <div class="row">
                <?php if(!empty($relation_case)):?>
                    <h4>您可能感興趣的案子：</h4>
                <?php foreach($relation_case as $row):?>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo site_url().'case/detail/'.$row->cd_id?>"><?php echo $row->cd_title;?></a></li>
                    </ul>
                <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
        <div class="col-lg-9 col-sm-9">
            <h1><?php echo $case_detail->cd_title?></h1>
            目標來源：<a href="<?php echo $case_detail->cd_url?>" target="_blank"><?php echo $case_detail->cd_url?></a><br />
            <?php
                echo nl2br($case_detail->cd_content);
            ?>
        </div>
    </div>
    <div class="row" style="text-align:center; margin:20px 0 0 0;">
        
    </div>
    <div class="row" style="text-align:center; margin:20px 0 0 0;">
        <div class="col-lg-3 col-sm-3"></div>
        <div class="col-lg-9 col-sm-9">
            <div class="fb-comments" data-href="http://9icase.com/case/detail/<?php echo $case_detail->cd_id?>" data-width="877" data-numposts="5" data-colorscheme="light"></div>
        </div>
    </div>
</div>