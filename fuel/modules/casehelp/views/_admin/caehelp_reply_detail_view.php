<?php echo css($this->config->item('case_help_css'), 'casehelp')?>

<section class="wrapper">
	<div class="row" style="">
	    <div class="col-md-2 sheader"><h4>回覆案件內容</h4></div>
	    <div class="col-md-10 sheader">
			
	    </div>
	</div> 

	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					回覆案件內容
				</header>
				<div class="panel-body">
					<div class="form-horizontal tasi-form">
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">回覆主旨</label>
							<div class="col-sm-6">
								<?php echo $reply_detail->cml_title;?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">回覆Email</label>
							<div class="col-sm-6">
								<?php echo $reply_detail->cli_email;?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">回覆時間</label>
							<div class="col-sm-6">
								<?php echo $reply_detail->modi_time;?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">提案網址</label>
							<div class="col-sm-6">
								<a href="<?php echo $reply_detail->case_url?>" target="_blank"><?php echo $reply_detail->case_url?></a>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">內容</label>
							<div class="col-sm-6">
								<?php echo nl2br(htmlspecialchars_decode($reply_detail->cml_content));?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12" style="text-align:center">
								<button type="button" class="btn btn-danger" onClick="aHover('<?php echo $cml_list_url?>')">返回</button>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</section>
<?php echo js($this->config->item('case_help_javascript'), 'casehelp')?>
<script>
	function aHover(url)
	{
		location.href = url;
	}
</script>