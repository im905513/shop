<?php //echo js($this->config->item('order_javascript'), 'order')?>
<?php echo css($this->config->item('case_css'), 'case')?>
<style>


</style>
<section class="wrapper">
	<div class="row" style="margin:10px 10px">
	    <div class="col-md-2 sheader"><h4>外包案件管理</h4></div>
	    <div class="col-md-10 sheader"></div>
	</div>

	<div class="row" style="margin:10px 10px">
		<div class="span12">
			<ul class="breadcrumb">
			  <li><a href="<?php echo $module_uri?>">外包案件管理</a></li>
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
							<label class="col-sm-2 col-sm-2 control-label">案件標題</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="cd_title" value="<?php echo trim($case_result->cd_title)?>">
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

</section>

<?php echo js($this->config->item('case_javascript'), 'case')?>
<?php echo js($this->config->item('bootstrap_datepicker'), 'case')?>
<script>
	function aHover(url)
	{
		location.href = url;
	}

	jQuery(document).ready(function($) {

	});
</script>