<?php echo css($this->config->item('contact_css'), 'contact')?> 

<section class="wrapper" style="margin:0px">
	<div class="row" style="margin:10px 10px">
	    <div class="col-md-2 sheader"><h4>聯絡資訊</h4></div>
	    <div class="col-md-10 sheader"></div>
	</div>

	<div class="row" style="margin:10px 10px">
		<div class="span12">
			<ul class="breadcrumb">
			  <li>位置：<a href="<?php echo $module_uri?>">聯絡列表</a></li>
			  <li class="active"><?php echo $view_name?></li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					聯絡資訊
				</header>
				<div class="panel-body">
					<div class="form-horizontal tasi-form">
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">稱呼</label>
							<div class="col-sm-4">
								<?php echo $contact->name ?>
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">EMAIL</label>
							<div class="col-sm-4">
								<?php echo $contact->email ?>
							</div>
						</div>	 
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">聯絡電話</label>
							<div class="col-sm-4">
								<?php echo $contact->contact_tel ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">聯絡事項</label>
							<div class="col-sm-4">
								<?php if ($contact->contact_type == 0): ?>
									問題回報
								<?php elseif ($contact->contact_type == 1): ?>
									合作提案
								<?php else: ?>
									職缺登錄
								<?php endif ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">聯絡處理</label>
							<div class="col-sm-4">
								<?php if ($contact->contact_status == 0): ?>								
									<button type="button" class="btn btn-xs btn-danger">尚未處理</button>
								<?php elseif ($contact->contact_status == 1): ?>									 
									<button type="button" class="btn btn-xs btn-primary">已處理</button>
								<?php else: ?> 
									<button type="button" class="btn btn-xs btn-default">不處理</button>
								<?php endif ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">聯絡內容</label>
							<div class="col-sm-4">
								<?php echo $contact->content ?>
							</div>
						</div>
					 
						<?php if (isset($job)): ?>
							
							
							<div class="bs-example bs-example-tabs">
							    <ul id="myTab" class="nav nav-tabs" role="tablist">
							      <li class="active"><a href="#info" role="tab" data-toggle="tab">公司資訊</a></li>
							      <li class=""><a href="#skill_1" role="tab" data-toggle="tab">可以學到的工作技能</a></li>
							      <li class=""><a href="#skill_0" role="tab" data-toggle="tab">需具備的工作技能</a></li>
							    </ul>
							    <div id="myTabContent" class="tab-content">
							      <div class="tab-pane active" id="info"> 									 
										  <div class="panel-body">
											<div class="form-horizontal tasi-form">
												<div class="form-group">
													<label class="col-sm-2 col-sm-2 control-label">公司名稱</label>
													<div class="col-sm-4">
														<?php echo $job->company_name ?>
													</div>
												</div>	
												<div class="form-group">
													<label class="col-sm-2 col-sm-2 control-label">工作地點</label>
													<div class="col-sm-4">
														<?php echo $job->job_address ?>
													</div>
												</div>	
												<div class="form-group">
													<label class="col-sm-2 col-sm-2 control-label">薪水[時薪]</label>
													<div class="col-sm-4">
														<?php echo $job->salary_hour ?>
													</div>
												</div>	
												<div class="form-group">
													<label class="col-sm-2 col-sm-2 control-label">薪水[時薪]</label>
													<div class="col-sm-4">
														<?php echo $job->salary_week ?>
													</div>
												</div>	
												<div class="form-group">
													<label class="col-sm-2 col-sm-2 control-label">薪水[時薪]</label>
													<div class="col-sm-4">
														<?php echo $job->salary_month ?>
													</div>
												</div>	
											</div> 
							    		  </div>
							      </div>
							      <div class="tab-pane fade in" id="skill_1">
							      	 
								    	 <?php
											if(isset($skill_1))
											{
												foreach ($skill_1 as $key => $row) 
												{
											?> 	 	  
													<div class="row">
												    	<div class="col-md-8"></div>	
												    </div>	
												    <div class="row">
												    	<div class="col-md-8"></div>	
												    </div>		
													<div class="row">
													    <div class="col-md-8">
													    	<button class="btn btn-primary" type="button">
													      		<?php echo $row->code_name ?>  
													    	</button>  
														</div> 
												    </div>	
												    <div class="row">
												    	<div class="col-md-8"></div>	
												    </div>	
												    <div class="row">
												    	<div class="col-md-8"></div>	
												    </div>	
											<?php
												}
											}
										?>	
										  
							      </div>
							      <div class="tab-pane fade in" id="skill_0">
							      	 <div class="container-fluid">
								    	 <?php
											if(isset($skill_0))
											{
												foreach ($skill_0 as $key => $row) 
												{
											?> 	
												<div class="row">
											    	<div class="col-md-8"></div>	
											    </div>	
											    <div class="row">
											    	<div class="col-md-8"></div>	
											    </div>		
												<div class="row">
												    <div class="col-md-8">
												    	<button class="btn btn-primary" type="button">
												      		<?php echo $row->code_name ?>  
												    	</button>  
													</div> 
											    </div>	
											    <div class="row">
											    	<div class="col-md-8"></div>	
											    </div>	
											    <div class="row">
											    	<div class="col-md-8"></div>	
											    </div>	
											<?php
												}
											}
										?>	
									</div>	 
							      </div>
							    </div>
							  </div>
						<?php endif ?>
						<div class="form-group">
							<div class="col-sm-12" style="text-align:center"> 
								<button type="button" class="btn btn-primary" onClick="aHover('<?php echo $module_uri?>')">返回</button>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>

</section>
<!-- Tab panes -->

<?php echo js($this->config->item('contact_javascript'), 'contact')?>
 
<script>
	function aHover(url)
	{
		location.href = url;
	}

	jQuery(document).ready(function($) {
	 
		  

	});
</script>