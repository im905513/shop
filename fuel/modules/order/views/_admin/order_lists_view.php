<?php echo css($this->config->item('order_css'), 'order');?>
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
			  <li>位置：訂單列表</li>
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
							<option value="1">訂單編號</option>
							<option value="2">訂購人</option>
						</select>
					</div>
					<div class="col-sm-4">
						<div class="input-group date pro_start_date">
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
					<button class="btn btn-info" type="button" onClick="aHover('')">匯出CSV</button>
					<div class="btn-group">
						<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							批次處理 <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#" class="batch" OrderStatus="0">已處理</a></li>
							<li><a href="#" class="batch" OrderStatus="1">未處理</a></li>
						</ul>
					</div>
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
						<th>訂單編號</th>
						<th>訂購人</th>
						<th>訂單狀態</th>
						<th>運送狀態</th>
						<th>訂購日期</th>
						<th>刪除</th>
					</tr>
				</thead>
				<tbody>
				<?php if(isset($results)):?>
					<?php foreach($results as $row):?>
						<tr id="oid_<?php echo $row->id?>">
							<td>
								<label class="label_check c_on" for="checkbox-01">
									<input type="checkbox" name="order_id[]" orderid="<?php echo $row->id?>"/>
								</label>
							</td>
							<td>
								<a href="<?php echo $detail_url.$row->id?>"><?php echo $row->id?></a>
							</td>
							<td>
								<?php echo $row->member_name;?>
							</td>
							<td>
								<?php if($row->order_status == 0):?>
									未處理
								<?php elseif($row->order_status == 1):?>
									已處理
								<?php else:?>
									未知狀態
								<?php endif;?>
							</td>
							<td>
								<?php if($row->order_ship_status == 0):?>
									未運送
								<?php elseif($row->order_ship_status == 1):?>
									已運送
								<?php else:?>
									未知狀態
								<?php endif;?>
							</td>
							<td><?php echo $row->order_time;?></td>
							<td>
								<button class="btn btn-xs btn-danger del" type="button" OrderID="<?php echo $row->id?>">刪除</button>
							</td>
						</tr>
					<?php endforeach;?>
					<?php else:?>
						<tr>
							<td colspan="6">No results.</td>
						</tr>
				<?php endif;?>
				</tobdy>
			</table>
		</section>
	</div>
	<div style="text-align:center">
	  <ul class="pagination">
		<?php //echo $page_jump?>
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
<?php echo js($this->config->item('order_javascript'), 'order')?>
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

		$j("#pro_start_date").datetimepicker({
		    format: "yyyy-m-d hh:ii",
		    autoclose: true
		});

		$j("#pro_end_date").datetimepicker({
		    format: "yyyy-m-d hh:ii",
		    autoclose: true
		});

		$j(".isearch").on("click", function(){
			var search_type = $("select[name='search_type']").val();
			var search_txt = $("input[name='search_txt']").val();
			var url = '<?php echo $search_url?>?search_type=' + search_type + '&search_txt=' + search_txt;

			aHover(url);
		});

		$j(".del").on("click", function(){
			$j(".do-del").show();
			$j(".do-del-all").hide();
			$j(".do-del").attr("OrderID", $(this).attr("OrderID"));
			$j('#myModal').modal('toggle');
		});

		$j(".do-del").on("click", function(){
			var	api_url = '<?php echo $del_url;?>' + $(this).attr("OrderID");
			var oid = $(this).attr("OrderID");
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
						$j("#oid_" + oid ).fadeOut(1000, function(){$(this).remove();});
						//setTimeout("update_page()", 500);
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
				$j("input[name='order_id[]']").each(function() {
					$j(this).prop("checked", true);
				});
		   }
		   else
		   {
				$j("input[name='order_id[]']").each(function() {
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

			var orderid = [];
			var j = 0;
			var postData = {};
			var api_url = '<?php echo $multi_del_url?>';
			$j("input[name='order_id[]']").each(function(i){
				if($j(this).prop("checked"))
				{
					orderid[j] = $j(this).attr('orderid');
					j++;
				}
			});

			if(j == 0)
			{
				alert("請選擇您要刪除的項目");
				return false;
			}

			postData = {'orderids': orderid};
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