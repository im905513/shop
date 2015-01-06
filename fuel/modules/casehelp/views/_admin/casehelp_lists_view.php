<?php echo css($this->config->item('case_help_css'), 'casehelp')?>

 
<section class="main-content">
<section class="wrapper">
	 <div id="dialog-confirm" title="確認批次處理?">
	  <p></p>
	</div>
	<div class="row" style="">
	    <div class="col-md-2 sheader"><h4>提案案件列表</h4></div>
	    <div class="col-md-10 sheader">
			<div class="form-inline">
				<div class="form-group">
					<select class="form-control input-sm" name="act">
						<option value="by_title" <?php if($act == "by_title") echo "selected" ?>>依提案者</option>
						<option value="by_content" <?php if($act == "by_content") echo "selected" ?>>依案件內容</option>
					</select>
				</div>
				<div class="form-group">
					<input type="checkbox" name="done" <?php echo $done ?> /> 已完成
				</div>
				<div class="form-group">
					<input type="text" class="form-control input-sm" placeholder="Search..." name="search_item" value="<?php echo $search_item; ?>"/>
				</div>
				<button type="submit" class="btn btn-info btn-sm">Search</button>
				<button type="button" id="donebatch" class="btn btn-info btn-sm">批次處理</button>
			</div>
			
	    </div>
	</div>
 
	<div class="row state-overview">
		<div class="col-lg-3 col-sm-6">
			<section class="panel">
				<div class="symbol terques">
					<i class="icon-bar-chart"></i>
				</div>
				<div class="value">
					<h1 class="count" value="<?php echo $today_count?>"><?php echo $today_count?></h1>
					<p>今日提案數</p>
				</div>
			</section>
		</div>
		<div class="col-lg-3 col-sm-6">
			<section class="panel">
				<div class="symbol blue">
					<i class="icon-bar-chart"></i>
				</div>
				<div class="value">
					<h1 class="count2" value="<?php echo $total_rows?>"><?php echo $total_rows?></h1>
					<p>全部提案數</p>
				</div>
			</section>
		</div>
	</div> 
	<div class="row">
		<section class="panel" style="height: 60px;">
			<button class="btn btn-info btn-sm" style="margin: 15px 0 0 5px;" type="button" onClick="aHover('<?php echo $replyed_url?>')">已完成列表</button>
		</section>
	</div> 
	<div class="row">
		<section class="panel">
			<table class="table table-striped table-advance table-hover">
				<thead>
					<tr> 
						<th>
							<label class="label_check c_on" for="checkbox-01">
								<input type="checkbox" id="select-all"/>
							</label>
						</th>
						<!--<th>案件標題</th>-->
						<th>提案人</th>
						<th>提案FB</th>
						<th>提案人Email</th>
						<th>提案人手機</th>
						<th>案件URL</th>
						<th>提案時間</th> 
						<th>完成時間</th> 
						<th>回覆</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(isset($case_results))
					{
						foreach($case_results as $key=>$rows)
						{

					?>
					<tr> 
						<td>
							<label class="label_check c_on" for="checkbox-01">
								<input type="checkbox" name="ch_id[]" ch_id="<?php echo $rows->ch_id?>"/>
							</label>
						</td>
						<!--<td><a href="<?php echo $case_url.$rows->ch_id?>"><?php echo $rows->cd_title?></a></td>-->
						<td><a href="<?php echo $client_url.$rows->cli_id?>" target="_blank"><?php echo $rows->cli_title?></a></td>
						<td><a target="_blank" href="<?php echo "http://www.facebook.com/".$rows->cli_fbid?>"><?php echo $rows->cli_fbid?></a></td>
						<td><?php echo $rows->cli_email?></td> 
						<td><?php echo $rows->cli_mobile?></td> 
						<td><a href="<?php echo $rows->case_url?>" target="_blank"><?php echo $rows->case_url?></a></td>
						<td><?php echo $rows->modi_time?></td> 
						<td><?php echo $rows->ch_done_time?></td> 
						<td><a href="<?php echo $replay_url.$rows->ch_id?>">回覆</a></td>
					</tr>
					<?php
						}
					}
					else
					{
					?>
						<tr>
							<td colspan="10">No results.</td>
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
<?php echo js($this->config->item('case_help_javascript'), 'casehelp')?>
<script>

	var $j = jQuery.noConflict(true);

	function aHover(url)
	{
		location.href = url;
	}

	$j("document").ready(function($) {
		//countUp($("h1.count").attr("value"));
		//countUp2($("h1.count2").attr("value"));
		
		$j("#select-all").click(function() {
			console.log('hiiii');
		   if($j("#select-all").prop("checked"))
		   {
				$j("input[name='ch_id[]']").each(function() {
					$j(this).prop("checked", true);
				});
		   }
		   else
		   {
				$j("input[name='ch_id[]']").each(function() {
					$j(this).prop("checked", false);
				});     
		   }
		});

		$j("#donebatch").click(function(){
			console.log('hiiii');
			var ch_ids = [];
			var j = 0;
			var postData = {};
			var api_url = '<?php echo $multi_done_url?>';
			$j("input[name='ch_id[]']").each(function(i){
				if($j(this).prop("checked"))
				{
					ch_ids[j] = $j(this).attr('ch_id');
					j++;
				}
			});

			postData = {'ch_ids': ch_ids};
			$j( "#dialog-confirm p" ).text('您確定批次處理？');
			$j( "#dialog-confirm" ).dialog({
			  resizable: false,
			  height:150,
			  modal: true,
			  buttons: {
			    "執行": function() {
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
								$j(".notify").find("span").text('處理完成');
								$j(".notify").fadeIn(100).fadeOut(1000);
								setTimeout("update_page()", 500);
							}
							else
							{
								$j(".notify").find(".alert").addClass('alert-error');
								$j(".notify").find(".alert").addClass('alert-block');
								$j(".notify").find("span").text('處理失敗');
								$j(".notify").slideDown(500).delay(1000).fadeOut(200);
							}

						},
					});
			    },
			    "取消": function() {
			      $j( this ).dialog( "close" );
			    }
			  }
			});
		});

		 
	}); 

	function update_page()
	{
		location.reload();
	}
	  
</script>