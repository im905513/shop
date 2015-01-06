<?php echo css($this->config->item('resume_css'), 'resume')?> 

<section class="wrapper" style="margin:0px">
	<div class="row" style="margin:10px 10px">
	    <div class="col-md-2 sheader"><h4>新增履歷</h4></div>
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
					新增履歷
				</header>
				<div class="panel-body">
					<div class="form-horizontal tasi-form">
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">帳號</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="account" value=""> 
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">密碼</label>
							<div class="col-sm-4">
								<input type="password" class="form-control" name="password" value=""> 
							</div>
						</div>	 
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">姓名</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="name" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">生日</label>
							<div class="col-sm-4">
								<input type="text" class="form-control birth" name="birth" value=""> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">電話</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="contact_tel" value=""> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">EMAIL</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="contact_mail" value=""> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">地址</label>
							<div class="col-sm-4">
								<input type="text" class="col-sm-4" name="address_zip" value="" placeholder="郵遞區號"> 
								<select name="address_city" id="address_city" class="col-sm-4">
									<option value='-1'>請選擇</option>
									<?php
										if(isset($city))
										{
											foreach ($city as $key => $row) 
											{
									?>
												<option value="<?php echo $row->code_id?>" ><?php echo $row->code_name?></option>
									<?php
											}
										}
									?>
								</select>
								<select name="address_area" id="address_area" class="col-sm-4"> 
								</select>
								<input type="text" class="form-control" name="address" value=""> 
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
												<option value="<?php echo $row->code_id?>"  ><?php echo $row->code_name?></option>
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
							 
								 <textarea class="form-control" rows="3" name="about_self"></textarea>
							 
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
												  	<input type="checkbox" name="exclude_cate[]" value="<?php echo $row->code_id?>"> <?php echo $row->code_name?>
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
													  		<input type="checkbox" class="place" name="place[]" data-parentid="<?php echo $row->parent_id?>" value="<?php echo $row->code_id?>"> <?php echo $row->code_name?>
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
								<input type="text" class="form-control" name="fb_account" value=""> 
							</div>
						</div>	
						<div class="form-group">
							<div class="col-sm-12" style="text-align:center">
								<button type="submit" class="btn btn-info">新增</button>
								<button type="button" class="btn btn-danger" onClick="aHover('<?php echo $module_uri?>')">取消</button>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>

</section>

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
   						// console.log(obj[i].code_name);

	   					$('#address_area').append(
					        $("<option></option>").text(obj[i].code_name).val(obj[i].code_id)
					   );
   					};
				});
             
            

		});

		 $(".place").click(function() { 
 			 if ($(this).data("parentid")==-1) { 
 			 	var parentid = $(this).val(); 
 			 	var selected = "input[data-parentid='"+parentid+"']";  
		 		$(selected).prop('checked', this.checked);
 			 };
		    

		});

	});
</script>