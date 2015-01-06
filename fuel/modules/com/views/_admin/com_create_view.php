<?php //echo js($this->config->item('order_javascript'), 'order')?>
<?php echo css($this->config->item('client_css'), 'client')?>
<style>


</style>
<div id="main_content">
	<div class="row" style="margin:10px 10px">
	    <div class="span2 sheader"><h1>接案者管理</h1></div>
	    <div class="span11 sheader">
	    </div>
	</div>

<div class="row" style="margin:10px 10px">
	<div class="span12">
		<ul class="breadcrumb">
		  <li><a href="#">接案者管理</a></li>
		  <li class="active"><?php echo $view_name?></li>
		</ul>
	</div>
</div>
<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					外包案件修改
				</header>
				<div class="panel-body">
					<div class="form-horizontal tasi-form">
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">接案身分</label>
							<div class="col-sm-10">
								<select name="cli_kind">
									<?php
										if(isset($cli_kind_result)):
									?>	
									<?php   foreach($cli_kind_result as $key=>$rows):?>
												<option value="<?php echo $rows->code_id ?>"><?php echo $rows->code_title ?></option>
										<?php endforeach;?>
									<?php endif;?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">接案暱稱</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="cli_title" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">案件內容</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="cd_content" rows="20"><?php echo $case_result->cd_content?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">執行時間</label>
							<div class="col-md-4">
								<input size="16" type="text" value="<?php echo $case_result->run_date?>" readonly class="form_datetime form-control" name="run_date">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">PO文時間</label>
							<div class="col-md-4">
								<input size="16" type="text" value="<?php echo $case_result->post_date?>" readonly class="form_datetime form-control" name="post_date">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">分類</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="board" value="<?php echo $case_result->board?>">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12" style="text-align:center">
								<button type="submit" class="btn btn-info" disabled>修改</button>
								<button type="button" class="btn btn-danger" onClick="aHover('<?php echo $module_uri?>')">取消</button>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
<script>
	function aHover(url)
	{
		location.href = url;
	}

	jQuery(document).ready(function($) {
		var elem = $(".same_order");
		$(".same_order").click(function(){
			if($(this).is( ":checked" ))
			{
				$("#oa_name").val($("#order_name").val());
				$("#oa_mobile").val($("#order_mobile").val());
				$("#oa_addr").val($("#order_addr").val());
			}
			else
			{
				$("#oa_name").val("");
				$("#oa_mobile").val("");
				$("#oa_addr").val("");
			}
		});
	});
</script>