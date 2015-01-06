<?php echo css($this->config->item('case_help_css'), 'casehelp')?>

 <div id="main_content">
	<div class="row" style="margin:10px 10px">
	    <div class="span2 sheader"><h1>提案完成回覆</h1></div>
	    <div class="span11 sheader">
	    </div>
	</div>
 <div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					自我介紹
				</header>
				<div class="panel-body">
					<div class="form-horizontal tasi-form"> 
						<div class="form-group">
							<div class="col-sm-10">
								<textarea class="form-control" rows="20"><?php echo $casehelp_row->cli_intro ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					提案完成回覆
				</header>
				<div class="panel-body">
					<div class="form-horizontal tasi-form"> 
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">回覆標題</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="cml_title" value="協助提案回覆" >
								<input type="hidden" name="ch_id" value="<?php echo $ch_id ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">回覆內容</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="cml_content" rows="20">
已經幫您取得案主資料，請主動、積極的與案主聯繫

專案網址：<?php echo $casehelp_row->case_url ?>

案主姓名：
案主電話：
案主信箱：

註：如果覺得我們不錯，記得要幫我們推薦一下唷！聯絡時請著名是518外包網的會員！


								</textarea>
							</div>
						</div> 
						<div class="form-group">
							<div class="col-sm-12" style="text-align:center">
								<button type="submit" class="btn btn-info" >發送</button> 
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>