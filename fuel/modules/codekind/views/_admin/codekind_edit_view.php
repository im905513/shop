<?php //echo js($this->config->item('order_javascript'), 'order')?>
<?php echo css($this->config->item('codekind_css'), 'codekind')?>
<style>


</style>
<section class="wrapper">
	<div class="row" style="margin:10px 10px">
	    <div class="col-md-2 sheader"><h4>分類管理</h4></div>
	    <div class="col-md-10 sheader"></div>
	</div>

	<div class="row" style="margin:10px 10px">
		<div class="span12">
			<ul class="breadcrumb">
			  <li>位置：<a href="<?php echo $module_uri?>">分類管理</a></li>
			  <li class="active"><?php echo $view_name?></li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					新增分類
				</header>
				<div class="panel-body">
					<div class="form-horizontal tasi-form">
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">分類名稱</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="codekind_name" value="<?php echo $ck_result->codekind_name?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">分類描述</label>
							<div class="col-sm-4">
								<textarea class="form-control" name="codekind_desc" rows="3"><?php echo $ck_result->codekind_desc?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Codekind Key</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="codekind_key" value="<?php echo $ck_result->codekind_key?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Codekind Value1</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="codekind_value1" value="<?php echo $ck_result->codekind_value1?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Codekind Value2</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="codekind_value2" value="<?php echo $ck_result->codekind_value2?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Codekind Value3</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="codekind_value3" value="<?php echo $ck_result->codekind_value3?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">語言</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="lang_code" value="<?php echo $ck_result->lang_code?>">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12" style="text-align:center">
								<button type="submit" class="btn btn-info">修改</button>
								<button type="button" class="btn btn-danger" onClick="aHover('<?php echo $module_uri?>')">取消</button>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>

</section>

<?php echo js($this->config->item('codekind_javascript'), 'codekind')?>
<script>
	function aHover(url)
	{
		location.href = url;
	}

	jQuery(document).ready(function($) {

	});
</script>