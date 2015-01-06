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
            <li id="default-title-1" class="current-step">
                <div>步驟二</div><span> </span>
            </li>
            <li id="default-title-2" class="">
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
                    <span style="color:red">註：請確認您的email與填妥您的手機，方便我們幫您接案後，可與您聯絡，謝謝</span>
                </td>
            </tr>
            <tr>
                <td>聯絡Email:</td>
                <td>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="cli_email" value="<?php if(isset($user_data->cli_email)){echo $user_data->cli_email;}?>" id="cli_email">
                    </div>
                </td>
            </tr>
            <tr>
                <td>聯絡手機:</td>
                <td>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" placeholder="09xxxxxxxx" name="cli_mobile" value="<?php if(isset($user_data->cli_mobile)){echo $user_data->cli_mobile;}?>" id="cli_mobile">
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center">
                    <button type="button" class="btn btn-success btn-sm UpdateUserBtn">送出</button>
                </td>
            </tr>
        </table>
    </section>
</div>
<?php $t = date("YmdHis")?>
<script type="text/javascript" src="<?php echo site_url()?>assets/js/user.js?t=<?=$t?>"></script>