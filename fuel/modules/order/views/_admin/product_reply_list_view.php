<?php echo css($this->config->item('product_css'), 'product')?>
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
			  <li>位置：<a href="<?php echo $module_uri?>">商品列表</a></li>
			  <li class="active"><?php echo $view_name?></li>
			</ul>
		</div>
	</div>
	<div class="row notify" style="display:none">
		<div class="alert alert-success" role="alert">
			<span>刪除成功</span>
		</div>
	</div>
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

	<div class="row">
		<section class="panel">
			<div class="row">
				<div class="alert alert-success" role="alert">
					<strong>共 <?php echo $total_rows;?> 筆</strong>
				</div>
			</div>
			<div class="row" style="">
			    <div class="col-md-12 sheader"> 
					<div class="form-inline" style="margin-top:10px" >
						<div class="form-group">
							<button type="button" class="btn btn-default" style="height:34px;" onclick="aHover('<?php echo $module_uri?>')"><i class="glyphicon glyphicon-arrow-left"></i></button>
							<!-- Single button -->
							<div class="btn-group">
								<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									批次處理 <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#" class="batch" RegiType="0">準時出席</a></li>
									<li><a href="#" class="batch" RegiType="1">無法出席</a></li>
									<li><a href="#" class="batch" RegiType="2">資格不符</a></li>
								</ul>
							</div>
						</div>
					</div>
			    </div>
			</div> 
			<table class="table table-striped table-advance table-hover">
				<thead>
					<tr>
						<th>
							<label class="label_check c_on" for="checkbox-01">
								<input type="checkbox" id="select-all"/>
							</label>
						</th>
						<th>#</th>
						<th>留言者</th>
						<th>內容</th>
						<th>時間</th>
						<th>狀態</th>
						<th>回覆</th>
						<th>刪除</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(isset($results))
					{
						foreach($results as $key=>$row)
						{
				?>
					<tr>
						<td>
							<label class="label_check c_on" for="checkbox-01">
								<input type="checkbox" name="r_id[]" regiid="<?php echo $row->id?>"/>
							</label>
						</td>
						<td>
							<?php echo $key;?>
						</td>
						<td>
							<?php echo $row->member_name;?>
						</td>
						<td>
							<?php echo mb_substr($row->reply_content,0, 10, "UTF-8");?>
						</td>
						<td>
							<?php echo $row->modi_time;?>
						</td>
						<td>
							<?php if($row->reply_status == 0):?>
								<span class="label label-warning">未回覆</span>
							<?php else:?>
								<span class="label label-success">已回覆</span>
							<?php endif;?>
						</td>
						<td>
							<button onclick="aHover('<?php echo $reply_url.$row->id?>')" class="btn btn-default btn-xs" type="button">回覆留言</button>
						</td>
						<td>
							<button class="btn btn-xs btn-danger del" type="button" rID="<?php echo $row->id ?>">刪除</button>
						</td>
					</tr>
				<?
						}
					}
					else
					{
				?>
					<tr>
						<td colspan="8">No results.</td>
					</tr>
				<?
					}
				?>

				</tobdy>
			</table>
		</section>
	</div>
</section>
</section>

<?php echo js($this->config->item('product_javascript'), 'product')?>
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
				$j("input[name='regi_id[]']").each(function() {
					$j(this).prop("checked", true);
				});
		   }
		   else
		   {
				$j("input[name='regi_id[]']").each(function() {
					$j(this).prop("checked", false);
				});     
		   }
		});

		$j(".del").on("click", function(){
			$j(".do-del").show();
			$j(".do-del-all").hide();
			$j(".do-del").attr("rID", $(this).attr("rID"));
			$j('#myModal').modal('toggle');
		});

		$j(".do-del").on("click", function(){
			var	 api_url = '<?php echo $del_reply_url ?>' + $(this).attr("rID");
		   
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

		$j(".batch").on("click", function(){

			var regiid = [];
			var j = 0;
			var postData = {};
			var api_url = '';
			$j("input[name='regi_id[]']").each(function(i){
				if($j(this).prop("checked"))
				{
					regiid[j] = $j(this).attr('regiid');
					j++;
				}
			});

			if(j == 0)
			{
				alert("請選擇您要批次處理的項目");
				return false;
			}
			$j('#myModal').modal('toggle');
			postData = {'regiids': regiid, 'regi_type': $(this).attr('RegiType')};
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
						$j(".notify .alert span").text('更新成功');
						$j(".notify .alert").removeClass('alert-danger');
						$j(".notify .alert").addClass('alert-success');
						$j(".notify").fadeIn(100).fadeOut(1000);
						setTimeout("update_page()", 500);
					}
					else
					{
						$j(".notify .alert span").text('更新失敗');
						$j(".notify .alert").removeClass('alert-success');
						$j(".notify .alert").addClass('alert-danger');
						$j(".notify").fadeIn(100).fadeOut(1000);
					}

				},
			});
			
		});
	});

	function update_page()
	{
		location.reload();
	}
</script>