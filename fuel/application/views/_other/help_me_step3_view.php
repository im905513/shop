<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-4">
                <h1>幫我提案</h1>
            </div>
            <div class="col-lg-8 col-sm-8">
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo site_url();?>">首頁</a></li>
                    <li>幫我提案</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="stepy-tab">
        <ul id="default-titles" class="stepy-titles clearfix">
            <li id="default-title-0">
                <div>步驟一</div><span> </span>
            </li>
            <li id="default-title-1">
                <div>步驟二</div><span> </span>
            </li>
            <li id="default-title-2" class="current-step">
                <div>步驟三</div><span> </span>
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <section style="width:650px; margin: 0 auto;">
        <table class="table table-bordered">
            <tr>
                <td colspan="2">
                    <span style="color:red">註：請填妥需要我們為您提案的外包案件網址，謝謝</span>
                </td>
            </tr>
            <tr>
                <td>外包案件網址:</td>
                <td>
                    <div class="col-xs-12">
                        <input type="text" class="form-control" name="case_url" value="<?php echo $case_url;?>" id="case_url">
                    </div>
                </td>
            </tr>
            <tr>
                <td>選擇自介:</td>
                <td>
                    <div class="col-xs-12">
                        <?php if(count($cli_intro) > 0):?>
                            <select name="cli_intro" id="cli_intro_select" class="selectpicker" data-style="btn-info">
                                <?php for($i=0; $i<count($cli_intro); $i++):?>
                                    <option value="<?php echo $i+1?>">自介<?php echo $i+1;?>
                                <?php endfor;?>
                            </select>
                                <?php for($i=0; $i<count($cli_intro); $i++):?>
                                    <textarea name="cli_intro<?php echo $i+1?>" style="display:none" class="CliIntro"><?php echo $cli_intro[$i]?></textarea>
                                <?php endfor;?>
                        <?php else:?>
                            <a class="btn btn-danger btn-sm" href="<?php echo site_url().'member'?>">請到會員中心填寫自介</a>
                        <?php endif;?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center">
                    <button type="button" class="btn btn-success btn-sm SendHelpBtn" cdID="<?php echo $cd_id?>" <?php if(count($cli_intro) == 0):?>disabled<?php endif;?>>送出</button>
                </td>
            </tr>
        </table>
    </section>
</div>
<?php $t = date("YmdHis")?>
<script type="text/javascript" src="<?php echo site_url()?>assets/js/user.js?t=<?=$t?>"></script>