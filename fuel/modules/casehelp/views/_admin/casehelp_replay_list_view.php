<?php echo css($this->config->item('case_help_css'), 'casehelp')?>

 
<section class="main-content">
<section class="wrapper">
	 <div id="dialog-confirm" title="確認批次處理?">
	  <p></p>
	</div>
	<div class="row" style="">
	    <div class="col-md-2 sheader"><h4>回覆案件列表</h4></div>
	    <div class="col-md-10 sheader">
			
	    </div>
	</div> 
	<div class="row">
		<section class="panel" style="height: 60px;">
			<button class="btn btn-info btn-sm" style="margin: 15px 0 0 5px;" type="button" onClick="aHover('<?php echo $casehelp_url?>')">未回覆列表</button>
		</section>
	</div> 
	<div class="row">
		<section class="panel">
			<table class="table table-striped table-advance table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>觀看回覆內容</th>
						<th>提案人</th>
						
						<th>提案人Email</th>
						
						<th>案件URL</th>
						<th>提案時間</th> 
						<th>完成時間</th> 
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
						<td><?php echo $key+1?></td>
						<td><a href="<?php echo $cml_url.$rows->cml_id?>">回覆內容</a></td>
						<td><a href="<?php echo $client_url.$rows->cli_id?>" target="_blank"><?php echo $rows->cli_title?></a></td>
						
						<td><?php echo $rows->cli_email?></td> 
						
						<td><a href="<?php echo $rows->case_url?>" target="_blank"><?php echo $rows->case_url?></a></td>
						<td><?php echo $rows->modi_time?></td> 
						<td><?php echo $rows->ch_done_time?></td> 
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
		countUp($("h1.count").attr("value"));
		countUp2($("h1.count2").attr("value"));
		
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