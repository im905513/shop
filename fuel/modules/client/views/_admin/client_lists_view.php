<?php echo css($this->config->item('client_css'), 'client')?>

<section class="main-content">
<section class="wrapper">
	<div id="dialog-confirm" title="刪除確認?">
	  <p></p>
	</div>
	<div class="row" style="">
	    <div class="col-md-2 sheader"><h3>接案者管理</h3></div>
	    <div class="col-md-10 sheader">
			<div class="form-inline">
				<div class="form-group">
					<select class="form-control input-sm" name="act">
						<option value="by_name" <?php if($act == "by_name") echo "selected" ?>>依接案暱稱</option>
						<option value="by_email" <?php if($act == "by_email") echo "selected" ?>>email</option>
					</select>
				</div>
				<div class="form-group">
					<input type="text" class="form-control input-sm" placeholder="Search..." name="search_item" value="<?php echo $search_item; ?>"/>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-info btn-sm">Search</button>
					
				</div>
			</div>
	    </div>
	</div>

	<div class="row state-overview">
		<div class="col-lg-3 col-sm-6">
			<section class="panel">
				<div class="symbol terques">
					<i class="icon-user"></i>
				</div>
				<div class="value">
					<h1 class="count" value="<?php echo $new_count ?>"><?php echo $new_count ?></h1>
					<p>今日註冊接案者數</p>
				</div>
			</section>
		</div>
		<div class="col-lg-3 col-sm-6">
			<section class="panel">
				<div class="symbol blue">
					<i class="icon-user"></i>
				</div>
				<div class="value">
					<h1 class="count2" value="<?php echo $total_count ?>"><?php echo $total_count ?></h1>
					<p>所有接案者數</p>
				</div>
			</section>
		</div>
		<div class="col-lg-3 col-sm-6">
			<section class="panel">
				<div class="symbol blue">
					<i class="icon-user"></i>
				</div>
				<div class="value">
					<h1 class="count3" value="<?php echo $search_count ?>"><?php echo $search_count ?></h1>
					<p>搜尋結果數</p>
				</div>
			</section>
		</div>
		
	    <div class="span3"> 
	    	<button class="btn btn-sm btn-info" type="button" onclick="aHover('<?php echo $create_url?>')">新增會員</button>
	    </div>
	    <div class="span10"></div>
	</div>
	<div class="row notify" style="margin:10px 10px; font-size: 12px; display:none">
		<div class="bs-docs-example">
		  <div class="alert fade in">
		    <button type="button" class="close" data-dismiss="alert">×</button>
		    <span>刪除失敗</span>
		  </div>
		</div>
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
						<th>接案暱稱</th>
						<th>FB ID</th>
						<th>行動電話</th>
						<th>電子郵件</th>
						<th>註冊日期</th>
						<th>刪除</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(isset($client_results))
					{
						foreach($client_results as $key=>$rows)
						{

					?>
					<tr>
						<td>
							<label class="label_check c_on" for="checkbox-01">
								<input type="checkbox" name="cli_id[]" cli_id="<?php echo $rows->cli_id?>"/>
							</label>
						</td>
						<td><a href="<?php echo $edit_url.$rows->cli_id?>"><?php echo $rows->cli_title?></a></td>
						<td><a target="_blank" href="<?php echo "http://www.facebook.com/".$rows->cli_fbid?>"><?php echo $rows->cli_fbid?></a></td>
						<td><?php echo $rows->cli_mobile?></td>
						<td><?php echo $rows->cli_email?></td>
						<td><?php echo $rows->create_time?></td>
						<td>
							<button class="btn btn-xs btn-danger del" type="button" onclick="dialog_chk(<?php echo $rows->cli_id?>)">刪除</button>
						</td>
					</tr>
					<?php
						}
					}
					else
					{
					?>
						<tr>
							<td colspan="7">No results.</td>
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
<?php echo js($this->config->item('client_javascript'), 'client')?>
<script>
 
	var $j = jQuery.noConflict(true);
 

	function aHover(url)
	{
		location.href = url;
	}

	$j("document").ready(function($) {
		//countUp($("h1.count").attr("value"));
		//countUp2($("h1.count2").attr("value"));
		//countUp3($("h1.count3").attr("value"));
		$j("#select-all").click(function() {

		   if($j("#select-all").prop("checked"))
		   {
				$j("input[name='cli_id[]']").each(function() {
					$j(this).prop("checked", true);
				});
		   }
		   else
		   {
				$j("input[name='cli_id[]']").each(function() {
					$j(this).prop("checked", false);
				});     
		   }
		});

		$j("button.delall").click(function(){
			var cli_ids = [];
			var j = 0;
			var postData = {};
			var api_url = '<?php echo $multi_del_url?>';
			$j("input[name='cli_id[]']").each(function(i){
				if($j(this).prop("checked"))
				{
					cli_ids[j] = $j(this).attr('cli_id');
					j++;
				}
			});

			postData = {'cli_ids': cli_ids};
			$j( "#dialog-confirm p" ).text('您確定要刪除嗎？');
			$j( "#dialog-confirm" ).dialog({
			  resizable: false,
			  height:150,
			  modal: true,
			  buttons: {
			    "Delete": function() {
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
								$j(".notify").find("span").text('刪除成功');
								$j(".notify").fadeIn(100).fadeOut(1000);
								setTimeout("update_page()", 500);
							}
							else
							{
								$j(".notify").find(".alert").addClass('alert-error');
								$j(".notify").find(".alert").addClass('alert-block');
								$j(".notify").find("span").text('刪除失敗');
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
		});
	});

	function del_client(cli_id)
	{
		var	 api_url = '<?php echo $del_url?>' + cli_id;
	   
		$j.ajax({
			url: api_url,
			type: 'POST',
			async: true,
			crossDomain: false,
			cache: false,
			success: function(data, textStatus, jqXHR){
				var data_json=jQuery.parseJSON(data);
				console.log(data_json);
				$j( "#dialog-confirm" ).dialog( "close" );
				if(data_json.status == 1)
				{
					$j("#notification span").text('刪除成功');
					$j("#notify").fadeIn(100).fadeOut(1000);
					setTimeout("update_page()", 500);
				}

			},
		});
	}
	function dialog_chk(cli_id)
	{
		$j( "#dialog-confirm p" ).text('您確定要刪除嗎？');
		$j( "#dialog-confirm" ).dialog({
		  resizable: false,
		  height:150,
		  modal: true,
		  buttons: {
		    "Delete": function() {
				del_client(cli_id);
		    },
		    Cancel: function() {
		      $j( this ).dialog( "close" );
		    }
		  }
		});
	}
	function update_page()
	{
		location.reload();
	}
</script>