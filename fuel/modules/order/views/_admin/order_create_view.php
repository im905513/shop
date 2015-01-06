<?php echo css($this->config->item('product_css'), 'product')?> 
<style>
	h1{margin-top: 6px;}
</style>
<section class="wrapper" style="margin:0px">
	<div class="row" style="margin:10px 10px">
	    <div class="col-md-2 sheader"><h4>新增產品</h4></div>
	    <div class="col-md-10 sheader"></div>
	</div>

	<div class="row" style="margin:10px 10px">
		<div class="span12">
			<ul class="breadcrumb">
			  <li>位置：<a href="<?php echo $module_uri?>">產品列表</a></li>
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
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>商品貨號</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="pro_item_no" value="" id="pro_item_no"> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>商品類別</label>
							<div class="col-sm-3">
								<select name="pro_cate" id="pro_cate" class="form-control">
									<option value="0">無</option>
									<?php if(isset($pro_cate_result)):?>
										<?php foreach($pro_cate_result as $cate_row):?>
											<option value="<?php echo $cate_row->code_id?>"><?php echo $cate_row->code_name?></option>
										<?php endforeach;?>
									<?php endif;?>
								</select>
							</div>
							<div class="col-sm-3">
								<select name="pro_cate_child" id="pro_cate_child" class="form-control" style="display:none">
									
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>商品名稱</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="pro_name" value="" id="pro_name"> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>商品標語</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="pro_slogan" value="" id="pro_slogan"> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>商品顏色</label>
							<div class="col-sm-5">
								<?php if(isset($pro_color_result)):?>
								<?php foreach($pro_color_result as $color_row):?>
									<label class="checkbox-inline">
										<input type="checkbox" id="pro_color" name="pro_color[]" value="<?php echo $color_row->code_id?>"> <?php echo $color_row->code_name;?>
									</label>
								<?php endforeach;?>
							<?php endif;?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>商品Size</label>
							<div class="col-sm-5">
								<?php if(isset($pro_size_result)):?>
									<?php foreach($pro_size_result as $size_row):?>
										<label class="checkbox-inline">
											<input type="checkbox" id="pro_size" name="pro_size[]" value="<?php echo $size_row->code_id?>"> <?php echo $size_row->code_name;?>
										</label>
									<?php endforeach;?>
								<?php endif;?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>商品數量</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="pro_num" value="" id="pro_num"> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>商品原價</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="pro_original_price" value="" id="pro_original_price"> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>商品批發價</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="pro_wholesale_price" value="" id="pro_wholesale_price"> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>商品VIP價格</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="pro_vip_price" value="" id="pro_vip_price"> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>商品上架日期</label>
							<div class="col-sm-4">
								<div class="input-group date pro_stime">
								  <input type="text" class="form-control" readonly="" size="16" name="pro_stime" id="pro_stime">
								    <span class="input-group-btn">
								    <button type="button" class="btn btn-info date-set" style="height:34px;"><i class="icon-calendar"></i></button>
								    </span>
								</div>
							</div>
						</div>	 
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>商品下架日期</label>
							<div class="col-sm-4">
								<div class="input-group date pro_etime">
								  <input type="text" class="form-control" readonly="" size="16" name="pro_etime" id="pro_etime">
								    <span class="input-group-btn">
								    <button type="button" class="btn btn-danger date-set" style="height:34px;"><i class="icon-calendar"></i></button>
								    </span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>商品排序</label>
							<div class="col-sm-4">
								<input type="number" class="form-control" name="pro_order" value="" id="pro_order"> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label"><span style="color:#d9534f">*</span>商品狀態</label>
							<div class="col-sm-3">
								<select name="pro_status" id="pro_status" class="form-control">
									<option value="0">無</option>
									<?php if(isset($pro_status_result)):?>
										<?php foreach($pro_status_result as $status_row):?>
											<option value="<?php echo $status_row->code_id?>"><?php echo $status_row->code_name?></option>
										<?php endforeach;?>
									<?php endif;?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">商品說明</label>
							<div class="col-sm-4">
								 <textarea class="form-control" rows="3" name="pro_desc" id="ProDesc"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">商品信息1</label>
							<div class="col-sm-4">
								 <textarea class="form-control" rows="3" name="pro_format_1" id="ProFormat1"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">商品信息2</label>
							<div class="col-sm-4">
								 <textarea class="form-control" rows="3" name="pro_format_2" id="ProFormat2"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">商品信息3</label>
							<div class="col-sm-4">
								 <textarea class="form-control" rows="3" name="pro_format_3" id="ProFormat3"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">商品購物需知</label>
							<div class="col-sm-4">
								 <textarea class="form-control" rows="3" name="pro_ship_note" id="ProShipNote"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">SEO Title</label>
							<div class="col-sm-4">
								 <textarea class="form-control" rows="3" name="seo_title"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">SEO Key word</label>
							<div class="col-sm-4">
								 <textarea class="form-control" rows="3" name="seo_kw"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">SEO description</label>
							<div class="col-sm-4">
								 <textarea class="form-control" rows="3" name="seo_desc"></textarea>
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

<?php echo js($this->config->item('product_javascript'), 'product')?>
 
<script>
	var $j = jQuery.noConflict(true);
	function aHover(url)
	{
		location.href = url;
	}

	$j(document).ready(function($) {
		$j("#event_charge").numeric();
		$j("#regi_limit_num").numeric();
		CKEDITOR.replace( 'ProDesc', {
			height: 380,
			width: 750,
			toolbar: [
				[ 'Styles', 'Format', 'Font', 'FontSize'],['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
				['Bold', 'Italic', 'Underline', '-', 'NumberedList', 'BulletedList'],
				['Link', 'Unlink'], ['Undo', 'Redo'], [ 'TextColor', 'BGColor', '-', 'Image' ], ['Source']
				]
		});

		CKEDITOR.dialog.add( 'testOnly', function( editor ) {
		    return {
		        title:          'Test Dialog',
		        resizable:      CKEDITOR.DIALOG_RESIZE_BOTH,
		        minWidth:       500,
		        minHeight:      400,
		        contents: [
		            {
		                id:         'tab1',
		                label:      'First Tab',
		                title:      'First Tab Title',
		                accessKey:  'Q',
		                elements: [
		                    {
		                        type:           'text',
		                        label:          'Test Text 1',
		                        id:             'testText1',
		                        'default':      'hello world!'
		                    }
		                ]
		            }
		        ]
		    };
		} );
		CKEDITOR.replace( 'ProFormat1', {
			height: 380,
			width: 750,
			toolbar: [
				[ 'Styles', 'Format', 'Font', 'FontSize'],['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
				['Bold', 'Italic', 'Underline', '-', 'NumberedList', 'BulletedList'],
				['Link', 'Unlink'], ['Undo', 'Redo'], [ 'TextColor', 'BGColor', '-', 'Image' ], ['Source']
				]
		});
		CKEDITOR.replace( 'ProFormat2', {
			height: 380,
			width: 750,
			toolbar: [
				[ 'Styles', 'Format', 'Font', 'FontSize'],['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
				['Bold', 'Italic', 'Underline', '-', 'NumberedList', 'BulletedList'],
				['Link', 'Unlink'], ['Undo', 'Redo'], [ 'TextColor', 'BGColor', '-', 'Image' ], ['Source']
				]
		});
		CKEDITOR.replace( 'ProFormat3', {
			height: 380,
			width: 750,
			toolbar: [
				[ 'Styles', 'Format', 'Font', 'FontSize'],['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
				['Bold', 'Italic', 'Underline', '-', 'NumberedList', 'BulletedList'],
				['Link', 'Unlink'], ['Undo', 'Redo'], [ 'TextColor', 'BGColor', '-', 'Image' ], ['Source']
				]
		});
		CKEDITOR.replace( 'ProShipNote', {
			height: 380,
			width: 750,
			toolbar: [
				[ 'Styles', 'Format', 'Font', 'FontSize'],['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
				['Bold', 'Italic', 'Underline', '-', 'NumberedList', 'BulletedList'],
				['Link', 'Unlink'], ['Undo', 'Redo'], [ 'TextColor', 'BGColor', '-', 'Image' ], ['Source']
				]
		});

		$("#pro_cate").change(function(){
			var api_url = '<?php echo $get_cate_child_url ?>' + 'PROCATE/' + $(this).val();
			$j.ajax({
				url: api_url,
				type: 'POST',
				async: true,
				crossDomain: false,
				cache: false,
				success: function(data, textStatus, jqXHR){
					var data_json=jQuery.parseJSON(data);
					if(data_json.result.length > 0)
					{
						$("#pro_cate_child").empty();
						var str = "<option value='0'>無</option>";

						for(i=0; i<data_json.result.length; i++)
						{
							str += "<option value='"+data_json.result[i].code_id+"'>"+data_json.result[i].code_name+"</option>";
						}

						$("#pro_cate_child").append(str);
						$("#pro_cate_child").show();
					}
					else
					{
						$("#pro_cate_child").hide();
					}

				},
			});
			
		});




		$j(".pro_stime").datetimepicker({
		    format: "yyyy-m-d hh:ii",
		    autoclose: true
		}).on('changeDate', function(ev){
			console.log(ev);
		});

		$j(".pro_etime").datetimepicker({
		    format: "yyyy-m-d hh:ii",
		    autoclose: true
		});


		$("#uploadBtn").change(function(){
			$("#uploadFile").val($(this).val());
		});

		$j("form").submit(function(event) {
			$(".msg").remove();
			var pro_start_date 		= $("#pro_stime").val();
			var pro_end_date		= $("#pro_etime").val();


			var esdt = (new Date(pro_start_date).getTime()/1000);
			var eedt = (new Date(pro_end_date).getTime()/1000);
			

			if(eedt < esdt)
			{
				alert("商品結束時間不可小於開賣時間");
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