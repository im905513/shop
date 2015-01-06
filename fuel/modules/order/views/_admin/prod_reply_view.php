<?php echo css($this->config->item('product_css'), 'product')?> 
<style>
    h1{margin-top: 6px;}
</style>
<section class="wrapper" style="margin:0px">
    <div class="row" style="margin:10px 10px">
        <div class="col-md-2 sheader"><h4>回覆留言</h4></div>
        <div class="col-md-10 sheader"></div>
    </div>

    <div class="row" style="margin:10px 10px">
        <div class="span12">
            <ul class="breadcrumb">
              <li>位置：<a href="<?php echo $module_uri?>">產品列表</a></li>
              <li class="active"><?php echo $view_name?></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <span style="color:#d9534f">* 為必填欄位</span>
                </header>
                <div class="panel-body">
                    <div class="form-horizontal tasi-form">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">留言時間</label>
                            <div class="col-sm-6">
                                <label class="col-sm-6 col-sm-6 control-label text-primary" style="text-align:left">
                                    <?php echo $result->modi_time?>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">留言類型</label>
                            <div class="col-sm-6">
                                <label class="col-sm-6 col-sm-6 control-label text-primary" style="text-align:left">
                                    <?php if($result->reply_type == 0):?>
                                        提問
                                    <?php else:?>
                                        評論
                                    <?php endif;?>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">商品</label>
                            <div class="col-sm-6">
                                <label class="col-sm-6 col-sm-6 control-label text-primary" style="text-align:left">
                                    <?php echo $result->pro_name?>
                                    <input type="hidden" name="pro_id" value="<?php echo $result->product_id?>">
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">留言者</label>
                            <div class="col-sm-6">
                                <label class="col-sm-6 col-sm-6 control-label text-primary" style="text-align:left">
                                    <?php echo $result->member_name?>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">留言內容</label>
                            <div class="col-sm-7">
                                <div class="bs-callout bs-callout-info">
                                    <p>
                                        <?php echo $result->reply_content?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">回覆</label>
                            <div class="col-sm-4">
                                 <textarea class="form-control" rows="3" name="admin_reply_content" id="AdminReply"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12" style="text-align:center">
                                <button type="submit" class="btn btn-info">確認</button>
                                <button type="button" class="btn btn-danger" onClick="aHover('<?php echo $module_uri?>')">取消</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</section>

<?php echo js($this->config->item('product_javascript'), 'product')?>
 
<script>
    var $j = jQuery.noConflict(true);
    function aHover(url)
    {
        location.href = url;
    }

    $j(document).ready(function($) {
        $j("#event_charge").numeric();
        $j("#regi_limit_num").numeric();
        CKEDITOR.replace( 'AdminReply', {
            height: 150,
            width: 650,
            toolbar: [
                ['Font', 'FontSize'],['Bold', 'Italic', 'Underline'],
                ['Link', 'Unlink'], ['Undo', 'Redo'], [ 'TextColor', 'BGColor',]
                ]
        });
         
    });
</script>