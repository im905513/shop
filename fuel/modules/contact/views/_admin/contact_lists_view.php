<?php echo css($this->config->item('contact_css'), 'contact')?> 

<section class="main-content">
<section class="wrapper" style="margin:0px"> 

	<div id="dialog-confirm" title="確定更新?">
	  <p></p>
	</div>

	<div class="row">
		<div class="span12">
			<ul class="breadcrumb">
			  <li>位置：列表</li>
			</ul>
		</div>
	</div>

	<div class="row" style="">
	  
	    <div class="col-md-12 sheader"> 
			<div class="form-inline" style="margin-top:10px">
				<div class="form-group">
					<label class="col-sm-4 control-label" >
						聯絡事項
					</label>
				    <div class="col-sm-8">
	 					 <select id="search_type" name="search_type" >
							 <option value="0" <?php echo $search_type == '0'?"selected":""; ?> >問題回報</option>
							 <option value="1" <?php echo $search_type == '1'?"selected":""; ?> >合作提案</option>
							 <option value="2" <?php echo $search_type == '2'?"selected":""; ?> >職缺登錄</option>
						</select> 
				    </div>
				    <label class="col-sm-4 control-label" >
						聯絡處理
					</label>
				    <div class="col-sm-8">
				         <select id="search_status" name="search_status" >
							 <option value="0" <?php echo $search_status == '0'?"selected":""; ?> >尚未處理</option>
							 <option value="1" <?php echo $search_status == '1'?"selected":""; ?> >已處理</option>
							 <option value="2" <?php echo $search_status == '2'?"selected":""; ?> >不處理</option>
						</select> 
				    </div>
				</div>
			</div>  
			<div class="form-inline" style="margin-top:10px" >
				<div class="form-group">
					<button type="submit" class="btn btn-warning">搜尋</button> 
					<button type="button" id="batch_none" name="donebatch" value="0" class="btn btn-danger">批次更改未處理</button>
					<button type="button" id="batch_done" name="donebatch" value="1" class="btn btn-primary">批次更改已處理</button>
					<button type="button" id="batch_dont" name="donebatch" value="2" class="btn btn-default">批次更改不處理</button>
				</div>
			</div>
	    </div>
	</div> 
 
	<div class="row">
		<section class="panel">
			<header class="panel-heading">
				
			</header>
			<div class="alert alert-success" role="alert">
				<strong>共<?php echo $total_rows;?>筆</strong>
			</div>
			<table class="table table-striped table-advance table-hover">
				<thead>
					<tr> 
						<th>
							<label class="label_check c_on" for="checkbox-01">
								<input type="checkbox" id="select-all"/>
							</label>
						</th>
						<th>編號</th>
						<th>稱呼</th>
						<th>EMAIL</th>
						<th>聯絡事項</th> 
						<th>聯絡處理</th>
						<th></th> 
					</tr>
				</thead>
				<tbody>
					<?php
					if(isset($results))
					{
						foreach($results as $key=>$rows)
						{

					?>
					<tr>  
						<td>
							<label class="label_check c_on" for="checkbox-01">
								<input type="checkbox" name="id[]" contactId="<?php echo $rows->id?>"/>
							</label>
						</td>
						<td><?php echo $rows->id?></td>
						<td><?php echo $rows->name?></td>
						<td><?php echo $rows->email?></td>
						<td> 
							<?php if ($rows->contact_type == 0): ?>
								問題回報
							<?php elseif ($rows->contact_type == 1): ?>
								合作提案
							<?php else: ?>
								職缺登錄
							<?php endif ?>
						</td>
						<td> 
							<?php if ($rows->contact_status == 0): ?>
								
								<button type="button" class="btn btn-xs btn-danger">尚未處理</button>
							<?php elseif ($rows->contact_status == 1): ?>
								 
								<button type="button" class="btn btn-xs btn-primary">已處理</button>
							<?php else: ?> 
								<button type="button" class="btn btn-xs btn-default">不處理</button>
							<?php endif ?>
						</td>
						<td>
							<button class="btn btn-xs btn-primary" type="button" onclick="aHover('<?php echo $detail_url.$rows->id?>')" >詳細</button>
						</td>
					</tr>
					<?php
						}
					}
					else
					{
					?>
						<tr>
							<td colspan="4">No results.</td>
						</tr>
					<?php
					}
					?>
				</tobdy>
			</table>
		</section>
	</div>
	<div style="text-align:center">
	  <ul class="pagination">
		<?php echo $page_jump?>
	  </ul>
	</div>
</section>
</section>
<?php echo js($this->config->item('contact_javascript'), 'contact')?>
<script>
	var $j = jQuery.noConflict(true);

	function aHover(url)
	{
		location.href = url;
	}

	$j("document").ready(function($) {
		$j("#select-all").click(function() {

		   if($j("#select-all").prop("checked"))
		   {
				$j("input[name='id[]']").each(function() {
					$j(this).prop("checked", true);
				});
		   }
		   else
		   {
				$j("input[name='id[]']").each(function() {
					$j(this).prop("checked", false);
				});     
		   }
		}); 

		$j("#batch_none").click(function(){
			update_status($(this).val());
		});

		$j("#batch_done").click(function(){
			
			update_status($(this).val());
		});

		$j("#batch_dont").click(function(){
			
			update_status($(this).val());
		});


		 
	});

	function update_status(contact_status){
		console.log(contact_status);
		var ids = [];
		var j = 0;
		var postData = {};
		var api_url = '<?php echo $batch_url?>';
		$j("input[name='id[]']").each(function(i){
			if($j(this).prop("checked"))
			{
				ids[j] = $j(this).attr('contactId');
				j++;
			}
		});
		console.log(ids);
		if (ids.length > 0) {
			postData = {'ids': ids,'contact_status':contact_status};
			$j( "#dialog-confirm p" ).text('您確定要更新嗎？');
			$j( "#dialog-confirm" ).dialog({
			  resizable: false,
			  height:150,
			  modal: true,
			  buttons: {
			    "Update": function() {
					$j.ajax({
						url: api_url,
						type: 'POST',
						async: true,
						crossDomain: false,
						cache: false,
						data: postData,
						success: function(data, textStatus, jqXHR){
							var data_json=jQuery.parseJSON(data);
							console.log(data_json);
							$j( "#dialog-confirm" ).dialog( "close" );
							if(data_json.status == 1)
							{
								$j(".notify").find("span").text('更新成功');
								$j(".notify").fadeIn(100).fadeOut(1000);
								setTimeout("update_page()", 500);
							}
							else
							{
								$j(".notify").find(".alert").addClass('alert-error');
								$j(".notify").find(".alert").addClass('alert-block');
								$j(".notify").find("span").text('更新失敗');
								$j(".notify").slideDown(500).delay(1000).fadeOut(200);
							}

						},
					});
			    },
			    Cancel: function() {
			      $j( this ).dialog( "close" );
			    }
			  }
			});
		}else{
			alert('請至少選擇一筆');
		}
		
	}

	function update_page()
	{
		location.reload();
	}
 
</script>