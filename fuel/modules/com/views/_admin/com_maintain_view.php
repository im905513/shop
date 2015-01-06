<?php //echo js($this->config->item('order_javascript'), 'order')?>
<?php echo css($this->config->item('com_css'), 'com')?>
<style>


</style>
<div id="main_content">
	<div class="row" style="margin:10px 10px">
	    <div class="span2 sheader"><h1>發案者管理</h1></div>
	    <div class="span11 sheader">
	    </div>
	</div>

<div class="row" style="margin:10px 10px">
	<div class="span12">
		<ul class="breadcrumb">
		  <li><a href="<?php echo $back_url?>">發案者管理</a></li>
		  <li class="active"><?php echo $view_name?></li>
		</ul>
	</div>
</div>
<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					基本資料
				</header>
				<div class="panel-body">
					<div class="form-horizontal tasi-form">
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">發案者名稱</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="com_title" value="<?php echo $com_row->com_title?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">電子郵件</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="com_email" value="<?php echo $com_row->com_email?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">行動電話</label>
							<div class="col-md-4">
								<input size="16" type="text" name="com_mobile" value="<?php echo $com_row->com_mobile?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">聯絡電話(日)</label>
							<div class="col-md-4">
								<input size="16" type="text" name="com_phone_day" value="<?php echo $com_row->com_phone_day?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">聯絡電話(夜)</label>
							<div class="col-sm-10">
								<input size="16" type="text" name="com_phone_night" value="<?php echo $com_row->com_phone_night?>" />
							</div>
						</div>
					</div>
				</div>
			</section>
		</div> 
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					接案者
				</header>
				<div class="panel-body">
					<div class="form-horizontal tasi-form"> 
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">自介1</label>
							<div class="col-sm-10">
								
							</div>
						</div>  
					</div>
				</div>
			</section>
		</div>
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					
				</header>
				<div class="panel-body">
					<div class="form-horizontal tasi-form"> 
						<div class="form-group">
							<div class="col-sm-12" style="text-align:center">
								<button type="submit" class="btn btn-info" >儲存</button>
								<button type="button" class="btn btn-danger" onClick="aHover('<?php echo $back_url?>')">取消</button>
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
		 
	});
</script>