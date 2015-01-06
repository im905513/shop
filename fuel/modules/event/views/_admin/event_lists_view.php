<?php echo css($this->config->item('event_css'), 'event')?>
<style>
	.DateStart{color: #4679bd;}
	.DateEnd{color: #d9534f;}
	.EventTitle
	{
		overflow : hidden;
		text-overflow : ellipsis;
		white-space : nowrap;
		width: 340px;
	}
</style>

<section class="main-content">
<section class="wrapper" style="margin:0px">
	<div class="row">
		<div class="span12">
			<ul class="breadcrumb">
			  <li>位置：活動列表</li>
			</ul>
		</div>
	</div>
	<div class="row notify" style="display:none">
		<div class="alert alert-success" role="alert">
			<span>刪除成功</span>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="form-horizontal tasi-form">
				<div class="form-group">
					<div class="col-sm-2">
						<select class="form-control" name="search_type">
							<option value="0">活動名稱</option>
							<option value="1">活動費用</option>
							<option value="2">活動地點</option>
						</select>
					</div>
					<div class="col-sm-4">
						<div class="input-group date event_start_date">
						  <input type="text" class="form-control" size="16" name="search_txt" id="search_txt" placeholder="Search...">
						    <span class="input-group-btn">
						    <button type="button" class="btn btn-warning date-set isearch" style="height:34px;"><i class="glyphicon glyphicon-search"></i></button>
						    </span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
	    <div class="col-md-12 sheader"> 
			<div class="form-inline" style="margin-top:10px" >
				<div class="form-group">
					<button class="btn btn-info" type="button" onClick="aHover('<?php echo $create_url;?>')">新增活動</button>
					<button type="button" class="btn btn-danger del-all" style="height:34px;"><i class="glyphicon glyphicon-trash"></i></button>
				</div>
			</div>
	    </div>
	</div> 

	<div class="row">
		<section class="panel">
			<div class="alert alert-success" role="alert">
				<strong>共 <?php echo $total_rows;?> 筆</strong>
			</div>
			<table class="table table-striped table-advance table-hover">
				<thead>
					<tr>
						<th>
							<label class="label_check c_on" for="checkbox-01">
								<input type="checkbox" id="select-all"/>
							</label>
						</th>
						<th>活動主題</th>
						<th>活動時間</th>
						<th>報名時間</th>
						<th>活動地點</th>
						<th>活動費用</th>
						<th>報名狀態</th>
						<th>刪除</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(isset($results))
					{
						foreach($results as $row)
						{
				?>
					<tr>
						<td>
							<label class="label_check c_on" for="checkbox-01">
								<input type="checkbox" name="event_id[]" eventid="<?php echo $row->event_id?>"/>
							</label>
						</td>
						<td><p class="EventTitle"><a href="<?php echo $edit_url.$row->event_id?>" title="<?php echo $row->event_title?>"><?php echo $row->event_title?></a></p></td>
						<td>
							S:&nbsp;<span class="DateStart"><?php echo mb_substr($row->event_start_date, 0, 16, "utf-8")?></span><br />
							E:&nbsp;<span class="DateEnd"><?php echo mb_substr($row->event_end_date, 0, 16, "utf-8")?></span>
						</td>
						<td>
							S:&nbsp;<span class="DateStart"><?php echo mb_substr($row->regi_start_date, 0, 16, "utf-8")?></span><br />
							E:&nbsp;<span class="DateEnd"><?php echo mb_substr($row->regi_end_date, 0, 16, "utf-8")?></span>
						</td>
						<td>
							<?php echo $row->event_place;?>
						</td>
						<td>
							<?php echo $row->event_charge;?>
						</td>
						<td>
							<button class="btn btn-xs btn-info EventStatus" type="button" onClick="aHover('<?php echo $event_status_url.$row->event_id ?>')">報名狀態</button>
						</td>
						<td>
							<button class="btn btn-xs btn-danger del" type="button" EventID="<?php echo $row->event_id ?>">刪除</button>
						</td>
					</tr>
				<?php
						}
					}
					else
					{
				?>
					<tr>
						<td colspan="8">No results.</td>
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
<!-- Button trigger modal -->
<div class="modal fade bs-example-modal-sm" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">刪除確認</h4>
			</div>
			<div class="modal-body">
				<p>您確定要刪除嗎？</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary do-del">Yes</button>
				<button type="button" class="btn btn-primary do-del-all">Yes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php echo js($this->config->item('event_javascript'), 'event')?>
<script>
	var $j = jQuery.noConflict(true);
	function aHover(url)
	{
		location.href = url;
	}
	function aHoverBlank(url)
	{
		window.open(url);
	}

	$j("document").ready(function($) {

		$j("#event_start_date").datetimepicker({
		    format: "yyyy-m-d hh:ii",
		    autoclose: true
		});

		$j("#event_end_date").datetimepicker({
		    format: "yyyy-m-d hh:ii",
		    autoclose: true
		});

		$j(".isearch").on("click", function(){
			var search_type = $("select[name='search_type']").val();
			var search_txt = $("input[name='search_txt']").val();
			var url = '<?php echo $search_url ?>?search_type=' + search_type + '&search_txt=' + search_txt;

			aHover(url);
		});

		$j(".del").on("click", function(){
			$j(".do-del").show();
			$j(".do-del-all").hide();
			$j(".do-del").attr("EventID", $(this).attr("EventID"));
			$j('#myModal').modal('toggle');
		});

		$j(".do-del").on("click", function(){
			var	 api_url = '<?php echo $del_url ?>' + $(this).attr("EventID");
		   
			$j.ajax({
				url: api_url,
				type: 'POST',
				async: true,
				crossDomain: false,
				cache: false,
				success: function(data, textStatus, jqXHR){
					var data_json=jQuery.parseJSON(data);

					$j('#myModal').modal('hide');
					if(data_json.status == 1)
					{
						$j(".notify .alert span").text('刪除成功');
						$j(".notify .alert").removeClass('alert-danger');
						$j(".notify .alert").addClass('alert-success');
						$j(".notify").fadeIn(100).fadeOut(1000);
						setTimeout("update_page()", 500);
					}
					else
					{
						$j(".notify .alert span").text('刪除失敗');
						$j(".notify .alert").removeClass('alert-success');
						$j(".notify .alert").addClass('alert-danger');
						$j(".notify").fadeIn(100).fadeOut(1000);
					}

				},
			});
		});
		

		$j("#select-all").click(function() {

		   if($j("#select-all").prop("checked"))
		   {
				$j("input[name='event_id[]']").each(function() {
					$j(this).prop("checked", true);
				});
		   }
		   else
		   {
				$j("input[name='event_id[]']").each(function() {
					$j(this).prop("checked", false);
				});     
		   }
		});

		$j("button.del-all").click(function(){
			$j(".do-del").hide();
			$j(".do-del-all").show();
			$j('#myModal').modal('toggle');
		});

		$j(".do-del-all").on("click", function(){

			var eventid = [];
			var j = 0;
			var postData = {};
			var api_url = '<?php echo $multi_del_url?>';
			$j("input[name='event_id[]']").each(function(i){
				if($j(this).prop("checked"))
				{
					eventid[j] = $j(this).attr('eventid');
					j++;
				}
			});

			if(j == 0)
			{
				alert("請選擇您要刪除的項目");
				return false;
			}

			postData = {'eventids': eventid};
			$j.ajax({
				url: api_url,
				type: 'POST',
				async: true,
				crossDomain: false,
				cache: false,
				data: postData,
				success: function(data, textStatus, jqXHR){
					var data_json=jQuery.parseJSON(data);
					$j('#myModal').modal('hide');

					if(data_json.status == 1)
					{
						$j(".notify .alert span").text('刪除成功');
						$j(".notify .alert").removeClass('alert-danger');
						$j(".notify .alert").addClass('alert-success');
						$j(".notify").fadeIn(100).fadeOut(1000);
						setTimeout("update_page()", 500);
					}
					else
					{
						$j(".notify .alert span").text('刪除失敗');
						$j(".notify .alert").removeClass('alert-success');
						$j(".notify .alert").addClass('alert-danger');
						$j(".notify").fadeIn(100).fadeOut(1000);
					}

				},
			});
		});
	});

	function del(account)
	{
		var	 api_url = '' + account;

		console.log(api_url);
	   
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
	function dialog_chk(account)
	{
		$j( "#dialog-confirm p" ).text('您確定要刪除嗎？');
		$j( "#dialog-confirm" ).dialog({
		  resizable: false,
		  height:150,
		  modal: true,
		  buttons: {
		    "Delete": function() {
				del(account);
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