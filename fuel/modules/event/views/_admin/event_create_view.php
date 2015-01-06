<?php echo css($this->config->item('event_css'), 'event')?> 
<style>
	h1{margin-top: 6px;}
</style>
<section class="wrapper" style="margin:0px">
	<div class="row" style="margin:10px 10px">
	    <div class="col-md-2 sheader"><h4>新增活動</h4></div>
	    <div class="col-md-10 sheader"></div>
	</div>

	<div class="row" style="margin:10px 10px">
		<div class="span12">
			<ul class="breadcrumb">
			  <li>位置：<a href="<?php echo $module_uri?>">活動列表</a></li>
			  <li class="active"><?php echo $view_name?></li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
		 			<span style="color:#d9534f">* 為必填欄位</span>
				</header>
				<div class="panel-body">
					<div class="form-horizontal tasi-form">
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>活動主題</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="event_title" value="" id="event_title"> 
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>活動開始日期</label>
							<div class="col-sm-4">
								<div class="input-group date event_start_date">
								  <input type="text" class="form-control" readonly="" size="16" name="event_start_date" id="event_start_date">
								    <span class="input-group-btn">
								    <button type="button" class="btn btn-info date-set" style="height:34px;"><i class="icon-calendar"></i></button>
								    </span>
								</div>
							</div>
						</div>	 
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>活動結束日期</label>
							<div class="col-sm-4">
								<div class="input-group date event_end_date">
								  <input type="text" class="form-control" readonly="" size="16" name="event_end_date" id="event_end_date">
								    <span class="input-group-btn">
								    <button type="button" class="btn btn-danger date-set" style="height:34px;"><i class="icon-calendar"></i></button>
								    </span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>報名開始日期</label>
							<div class="col-sm-4">
								<div class="input-group date regi_start_date">
								  <input type="text" class="form-control" readonly="" size="16" name="regi_start_date" id="regi_start_date">
								    <span class="input-group-btn">
								    <button type="button" class="btn btn-info date-set" style="height:34px;"><i class="icon-calendar"></i></button>
								    </span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>報名結束日期</label>
							<div class="col-sm-4">
								<div class="input-group date regi_end_date">
								  <input type="text" class="form-control" readonly="" size="16" name="regi_end_date" id="regi_end_date">
								    <span class="input-group-btn">
								    <button type="button" class="btn btn-danger date-set" style="height:34px;"><i class="icon-calendar"></i></button>
								    </span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>活動費用</label>
							<div class="col-sm-4">
								<input type="number" class="form-control" name="event_charge" value="" id="event_charge"> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>人數限制</label>
							<div class="col-sm-4">
								<input type="number" class="form-control" name="regi_limit_num" value="" id="regi_limit_num"> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>活動地點</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="event_place" value="" id="event_place"> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">活動圖片</label>
							<div class="col-sm-4">
								<div class="input-group date">
								  <input type="text" id="uploadFile" class="form-control" name="event_photo_path" placeholder="Choose File" disabled="disabled" /> 
								    <span class="input-group-btn">
										<button class="fileUpload btn btn-info" type="button" style="margin:0">
											<span>Upload</span>
											<input type="file" class="upload" name="event_photo" id="uploadBtn"/>
										</button>
								    </span>
								</div>
							
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">活動簡介</label>
							<div class="col-sm-4">
								 <textarea class="form-control" rows="3" name="event_detail" id="EventDetail"></textarea>
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

<?php echo js($this->config->item('event_javascript'), 'event')?>
 
<script>
	var $j = jQuery.noConflict(true);
	function aHover(url)
	{
		location.href = url;
	}

	$j(document).ready(function($) {
		$j("#event_charge").numeric();
		$j("#regi_limit_num").numeric();
		CKEDITOR.replace( 'EventDetail', {
			height: 380,
			width: 750,
			toolbar: [
				[ 'Styles', 'Format', 'Font', 'FontSize'],['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
				['Bold', 'Italic', 'Underline', '-', 'NumberedList', 'BulletedList'],
				['Link', 'Unlink'], ['Undo', 'Redo'], [ 'TextColor', 'BGColor', '-', 'Image' ], ['Source']
				]
		});

		$j(".event_start_date").datetimepicker({
		    format: "yyyy-m-d hh:ii",
		    autoclose: true
		}).on('changeDate', function(ev){
			console.log(ev);
		});

		$j(".event_end_date").datetimepicker({
		    format: "yyyy-m-d hh:ii",
		    autoclose: true
		});

		$j(".regi_start_date").datetimepicker({
		    format: "yyyy-m-d hh:ii",
		    autoclose: true
		    
		});

		$(".regi_end_date").datetimepicker({
		    format: "yyyy-m-d hh:ii",
		    autoclose: true
		});

		$("#uploadBtn").change(function(){
			$("#uploadFile").val($(this).val());
		});

		$j("form").submit(function(event) {
			$(".msg").remove();
			var event_start_date 	= $("#event_start_date").val();
			var event_end_date		= $("#event_end_date").val();
			var regi_start_date		= $("#regi_start_date").val();
			var regi_end_date		= $("#regi_end_date").val();


			var esdt = (new Date(event_start_date).getTime()/1000);
			var eedt = (new Date(event_end_date).getTime()/1000);
			var rsdt = (new Date(regi_start_date).getTime()/1000);
			var redt = (new Date(regi_end_date).getTime()/1000);

			if(eedt < esdt)
			{
				alert("活動結束時間不可小於開始時間");
				return false;
			}

			if(redt < rsdt)
			{
				alert("報名結束時間不可小於開始時間");
				return false;
			}

			if(esdt < rsdt)
			{
				alert("活動間不可小於報名時時間");
				return false;
			}

			if($j("#event_title").val() == "")
			{
				$j("#event_title").parent().after("<div class='col-sm-2 msg'><span style='color:red;'>必填</span></div>");

				return false;
			}

			if($j("#event_start_date").val() == "")
			{
				$j("#event_start_date").parents('.col-sm-4').after("<div class='col-sm-2 msg'><span style='color:red;'>必填</span></div>");

				return false;
			}

			if($j("#event_end_date").val() == "")
			{
				$j("#event_end_date").parents('.col-sm-4').after("<div class='col-sm-2 msg'><span style='color:red;'>必填</span></div>");

				return false;
			}

			if($j("#regi_start_date").val() == "")
			{
				$j("#regi_start_date").parents('.col-sm-4').after("<div class='col-sm-2 msg'><span style='color:red;'>必填</span></div>");

				return false;
			}

			if($j("#regi_end_date").val() == "")
			{
				$j("#regi_end_date").parents('.col-sm-4').after("<div class='col-sm-2 msg'><span style='color:red;'>必填</span></div>");

				return false;
			}

			if($j("#event_place").val() == "")
			{
				$j("#event_place").parents('.col-sm-4').after("<div class='col-sm-2 msg'><span style='color:red;'>必填</span></div>");

				return false;
			}			
		});
		 
	});
</script>