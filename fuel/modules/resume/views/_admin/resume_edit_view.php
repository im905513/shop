<?php echo css($this->config->item('resume_css'), 'resume')?> 

<section class="wrapper" style="margin:0px">
	<div class="row" style="margin:10px 10px">
	    <div class="col-md-2 sheader"><h4>編輯履歷</h4></div>
	    <div class="col-md-10 sheader"></div>
	</div>

	<div class="row" style="margin:10px 10px">
		<div class="span12">
			<ul class="breadcrumb">
			  <li>位置：<a href="<?php echo $module_uri?>">履歷列表</a></li>
			  <li class="active"><?php echo $view_name?></li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					編輯履歷
				</header>
				<div class="panel-body">
					<div class="form-horizontal tasi-form">
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">帳號</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="account" value="<?php echo  $result->account; ?>" disabled /> 
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">密碼</label>
							<div class="col-sm-4">
								<input type="password" class="form-control" name="password" > 
							</div>
						</div>	 
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">姓名</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="name" value="<?php echo  $result->name; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">生日</label>
							<div class="col-sm-4">
								<input type="text" class="form-control birth" name="birth" value="<?php echo  $result->birth; ?>" /> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">電話</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="contact_tel" value="<?php echo  $result->contact_tel; ?>" /> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">EMAIL</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="contact_mail" value="<?php echo  $result->contact_mail; ?>" /> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">性別</label>
							<div class="col-sm-4">
								 <select name="sex"> 
						        	<option value="0" <?php echo $result->sex == "0"?"selected":""; ?> >女</option>
						        	<option value="1" <?php echo $result->sex == "1"?"selected":""; ?> >男</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">地址</label>
							<div class="col-sm-4">
								<!-- <input type="text" class="col-sm-4" name="address_zip" placeholder="郵遞區號" value="<?php echo  $result->address_zip; ?>" /> 
								<select name="address_city" id="address_city" class="col-sm-4">
									<option value='-1'>請選擇</option>
									<?php
										if(isset($city))
										{
											foreach ($city as $key => $row) 
											{
									?>
												<option value="<?php echo $row->code_id?>" <?php if ($row->code_id==$result->address_city): ?>
													selected
												<?php endif ?> ><?php echo $row->code_name?></option>
									<?php
											}
										}
									?>
								</select>
								<select name="address_area" id="address_area" class="col-sm-4"> 
								</select>
								<input type="text" class="form-control" name="address" value="<?php echo  $result->address; ?>">  -->
								<?php echo "[$result->address_zip] $result->address_city $result->address_area $result->address" ?>
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">就業狀態</label>
							<div class="col-sm-4">
							 
								<select name="job_status" id="job_status" class="form-control">
									<?php
										if(isset($job_state))
										{
											foreach ($job_state as $key => $row) 
											{
									?>
												<option value="<?php echo $row->code_id?>" <?php if ($row->code_id==$result->job_status): ?>
													selected
												<?php endif ?> ><?php echo $row->code_name?></option>
									<?php
											}
										}
									?>
								</select>
							 
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">關於自己</label>
							<div class="col-sm-4">
							 
								 <textarea class="form-control" rows="3" name="about_self"><?php echo  $result->about_self; ?></textarea>
							 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">管理備註</label>
							<div class="col-sm-4">
							 
								 <textarea class="form-control" rows="3" name="note"><?php echo  $result->note; ?></textarea>
							 
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">尋找工作</label>
							<div class="col-sm-4">
								 <?php 

								 	if($result->find_job_kind == "0"){
		                                echo "我目前在找打工";
		                            }elseif($result->find_job_kind == "1"){
		                                echo "我目前在找全職工作";
		                            }
								  ?>
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">不想就業的類別</label>
							<div class="col-sm-4">
							 
								 <?php
										if(isset($job_cate))
										{
											foreach ($job_cate as $key => $row) 
											{
									?> 
												<label class="checkbox-inline">
												  	<input type="checkbox" name="exclude_cate[]" value="<?php echo $row->code_id?>"
												  	<?php if (strpos($result->exclude_cate,$row->code_id) !== false): ?>
													  			checked
													  		<?php endif ?>> <?php echo $row->code_name?>
												</label>
									<?php
											}
										}
									?>
							 
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">地點</label>
							<div class="col-sm-4">
							 
								  	 <?php
										if(isset($place))
										{
											foreach ($place as $key => $row) 
											{
									?> 	
												 
	  													<?php if ($row->parent_id == "-1"): ?>
													  		<?php echo "<hr /> ";?>
													  	<?php endif ?>
													  	<label class="checkbox-inline">
													  		<input type="checkbox" class="place" name="place[]" 
													  		data-parentid="<?php echo $row->parent_id?>" 
													  		value="<?php echo $row->code_id?>" <?php if (strpos($result->job_location,$row->code_id) !== false): ?>
													  			checked
													  		<?php endif ?> > <?php echo $row->code_name?>
													  	</label>
													  	<?php if ($row->parent_id == "-1"): ?>
													  		<?php echo "<hr /> ";?>
													  	<?php endif ?>
													  	
													 
									<?php
											}
										}
									?>	
							 
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">facebook帳號</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="fb_account" value="<?php echo $result->fb_account?>"> 
							</div>
						</div>	
						<div class="bs-example bs-example-tabs">
						    <ul id="myTab" class="nav nav-tabs" role="tablist">
						      <li class="active"><a href="#skill" role="tab" data-toggle="tab">工作技能</a></li>
						      <li class=""><a href="#exp" role="tab" data-toggle="tab">工作經驗</a></li>
						      <li class=""><a href="#school" role="tab" data-toggle="tab">學歷</a></li>
						    </ul>
						    <div id="myTabContent" class="tab-content">
						      <div class="tab-pane active" id="skill"> 
									  <table class="table">
									    	 <?php
										if(isset($skill))
										{
											foreach ($skill as $key => $row) 
											{
										?> 	
													  
												<tr><td><?php echo $row->code_name?></td></tr>		  	
														 
										<?php
											}
										}
									?>	
									  </table> 
						      </div>
						      <div class="tab-pane fade in" id="exp">
						      	 <table class="table">
									    	 <?php
										if(isset($exp))
										{
											foreach ($exp as $key => $row) 
											{
										?> 	
													  
												<tr>
													<td><?php echo $row->company_name?></td>
													<td><?php echo $row->job_title?></td>
													<td><?php echo $row->job_start_date?></td>
													<td><?php echo $row->job_end_date?></td>
												</tr>		 		  	
														 
										<?php
											}
										}
									?>	
									  </table> 
						      </div>
						      <div class="tab-pane fade in" id="school">
						      	 <table class="table">
									    	 <?php
										if(isset($school))
										{
											foreach ($school as $key => $row) 
											{
										?> 	
													  
												<tr>
													<td><?php echo $row->code_name?></td>
													<td><?php echo $row->attend_date?></td>
													<td><?php echo $row->grad_date?></td>
													<td>
														<?php if ($row->is_grad == "1"): ?>
															畢業
														<?php else: ?>
														 	<?php if ($row->is_attend == "1"): ?>
														 		在學
														 	<?php endif ?>
														<?php endif ?>
													</td>
												</tr>		  	
														 
										<?php
											}
										}
									?>	
									  </table> 
						      </div>
						    </div>
						  </div>
						<div class="form-group">
							<div class="col-sm-12" style="text-align:center">
								<button type="submit" class="btn btn-info">更新</button>
								<button type="button" class="btn btn-danger" onClick="aHover('<?php echo $module_uri?>')">取消</button>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>

</section>
<!-- Tab panes -->

<?php echo js($this->config->item('resume_javascript'), 'resume')?>
 
<script>
	function aHover(url)
	{
		location.href = url;
	}

	jQuery(document).ready(function($) {
	 
		$('.birth').datepicker({dateFormat: 'yy-mm-dd'});
		 
		// $("#address_city").trigger('onchange');
		$("#address_city").change(function() {
			// alert('<?php echo site_url(); ?>' + 'fuel/resume/area/' + $(this).val() );
  		   $('#address_area').find('option').remove().end();
		   $.ajax({
                url: '<?php echo site_url(); ?>' + 'fuel/resume/area/' + $(this).val() ,
                cache: false
		        }).done(function (data) {
                   // alert(data);
                 
                    var obj = $.parseJSON(data);
   					for (var i = 0 ;i<obj.length;i++) {
   						console.log(obj[i].code_name);

	   					$('#address_area').append(
					        $("<option></option>").text(obj[i].code_name).val(obj[i].code_name)
					   );
   					};
				});
             
            

		});

		$("#address_city").val(<?php echo $result->address_city?>);
		$("#address_city").trigger('change');
		$("#address_area").val(<?php echo $result->address_area?>);

		 $(".place").click(function() { 
 			 if ($(this).data("parentid")==-1) { 
 			 	var parentid = $(this).val(); 
 			 	var selected = "input[data-parentid='"+parentid+"']";  
		 		$(selected).prop('checked', this.checked);
 			 };
		    

		});

	});
</script>