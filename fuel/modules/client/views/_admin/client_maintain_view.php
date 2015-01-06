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
		  <li><a href="<?php echo $back_url?>">接案者管理</a></li>
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
							<label class="col-sm-2 col-sm-2 control-label">接案身分</label>
							<div class="col-sm-10">
								<select name="cli_kind">
									<?php
										if(isset($cli_kind_result)):
									?>	
									<?php   foreach($cli_kind_result as $key=>$rows):?>
												<option value="<?php echo $rows->code_id ?>" <?php if($rows->code_id==$client_row->cli_kind) echo "selected" ?> ><?php echo $rows->code_name ?></option>
										<?php endforeach;?>
									<?php endif;?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">FB ID</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="cli_fbid" value="<?php echo $client_row->cli_fbid?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">接案暱稱</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="cli_title" value="<?php echo $client_row->cli_title?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">居住地</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="cli_live_city" value="<?php echo $client_row->cli_live_city?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">行動電話</label>
							<div class="col-md-4">
								<input size="16" type="text" name="cli_mobile" value="<?php echo $client_row->cli_mobile?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">聯絡電話(日)</label>
							<div class="col-md-4">
								<input size="16" type="text" name="cli_phone_day" value="<?php echo $client_row->cli_phone_day?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">聯絡電話(夜)</label>
							<div class="col-sm-10">
								<input size="16" type="text" name="cli_phone_night" value="<?php echo $client_row->cli_phone_night?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">電子郵件</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="cli_email" value="<?php echo $client_row->cli_email?>">
							</div>
						</div>
					</div>
				</div>
			</section>
		</div> 
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					自我介紹
				</header>
				<div class="panel-body">
					<div class="form-horizontal tasi-form"> 
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">自介1</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="cli_intro1" rows="20"><?php echo $client_row->cli_intro1?></textarea>
							</div>
						</div>  
					</div>
				</div>
				<div class="panel-body">
					<div class="form-horizontal tasi-form"> 
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">自介2</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="cli_intro2" rows="20"><?php echo $client_row->cli_intro2?></textarea>
							</div>
						</div>  
					</div>
				</div>
				<div class="panel-body">
					<div class="form-horizontal tasi-form"> 
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">自介3</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="cli_intro3" rows="20"><?php echo $client_row->cli_intro3?></textarea>
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