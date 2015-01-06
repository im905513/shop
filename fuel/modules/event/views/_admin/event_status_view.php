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
			  <li>位置：<a href="<?php echo $module_uri?>">活動列表</a></li>
			  <li class="active"><?php echo $view_name?></li>
			</ul>
		</div>
	</div>
	<div class="row notify" style="display:none">
		<div class="alert alert-success" role="alert">
			<span>刪除成功</span>
		</div>
	</div>
	<div class="modal fade modal-sm" id="myModal">
		<div class="modal-dialog modal-sm" style="width:200px">
		<div class="modal-content">
			<div class="modal-body">
				<h4>處理中...請稍後</h4>
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
						<th>報名單號</th>
						<th>活動主題</th>
						<th>帳號</th>
						<th>名字</th>
						<th>報名時間</th>
						<th>報名狀態</th>
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
								<input type="checkbox" name="regi_id[]" regiid="<?php echo $row->regi_id?>"/>
							</label>
						</td>
						<td>
							<?php echo $row->regi_id;?>
						</td>
						<td>
							<p class="EventTitle"><?php echo $row->event_title;?></p>
						</td>
						<td>
							<?php echo $row->account;?>
						</td>
						<td>
							<?php echo $row->name;?>
						</td>
						<td>
							<?php echo $row->drop_date;?>
						</td>
						<td>
							<?php
								if($row->regi_type == 0)
								{
							?>
									<span class="label label-success">準時出席</span>
							<?php
								}
								else if($row->regi_type == 1)
								{
							?>
									<span class="label label-warning">無法出席</span>
							<?php
								}
								else
								{
							?>
									<span class="label label-danger">資格不符</span>
							<?php
								}
							?>
							
						</td>
					</tr>
				<?
						}
					}
					else
					{
				?>
					<tr>
						<td colspan="6">No results.</td>
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

<?php echo js($this->config->item('event_javascript'), 'event')?>
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

		$j(".batch").on("click", function(){

			var regiid = [];
			var j = 0;
			var postData = {};
			var api_url = '<?php echo $bath_url?>';
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