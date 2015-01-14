<?php echo css($this->config->item('order_css'), 'order')?> 
<style>
	h1{margin-top: 6px;}
	table th{background-color: #f0f0f0; width:130px;}
	table .title{text-align:center; background-color:#707070; color:#fff;}
</style>
<section class="wrapper" style="margin:0px">
	<div class="row" style="margin:10px 10px">
	    <div class="col-md-2 sheader"><h4>訂單資訊</h4></div>
	    <div class="col-md-10 sheader"></div>
	</div>

	<div class="row" style="margin:10px 10px">
		<div class="span12">
			<ul class="breadcrumb">
			  <li>位置：<a href="<?php echo $module_uri?>">訂單列表</a></li>
			  <li class="active"><?php echo $view_name?></li>
			</ul>
		</div>
		<div class="row notify" style="display:none">
			<div class="alert alert-success" role="alert">
				<span>刪除成功</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<div class="panel-body">
					<div class="form-horizontal tasi-form">
						<div class="table-responsive">
							<table class="table table-bordered">
							<?php if(isset($content_result)):?>
								<tr>
									<td colspan="6" class="title" style="border:1px solid #707070;">訂購人資訊</td>
								</tr>
								<tr>
									<th>訂單編號</th>
									<td><?php echo $content_result->id;?></td>
									<th>訂購人</th>
									<td><?php echo $content_result->member_name;?></td>
									<th>訂購日期</th>
									<td><?php echo $content_result->order_time;?></td>
								</tr>
								<tr>
									<th>統編</th>
									<td><?php echo $content_result->order_vat_number?></td>
									<th>發票抬頭</th>
									<td colspan="3"><?php echo $content_result->order_invoice_title?></td>
								</tr>
								<tr>
									<td colspan="6" class="title" style="border:1px solid #707070;">收件資訊</td>
								</tr>
								<tr>
									<th>收件人</th>
									<td><?php echo $content_result->order_addressee_name?></td>
									<th>收件人電話</th>
									<td colspan="3"><?php echo $content_result->order_addressee_mobile?></td>
								</tr>
								<tr>
									<th>收件地址</th>
									<td colspan="5"><?php echo $content_result->order_addressee_addr?></td>
								</tr>
								<tr>
									<td colspan="6" class="title" style="border:1px solid #707070;">狀態</td>
								</tr>
								<tr>
									<th>訂單狀態</th>
									<td>
										<?php if($content_result->order_status == 0):?>
											未處理
										<?php elseif($content_result->order_status == 1):?>
											已處理
										<?php endif;?>
									</td>
									<th>運送狀態</th>
									<td>
										<?php if($content_result->order_ship_status == 0):?>
											未運送
										<?php elseif($content_result->order_ship_status == 1):?>
											已運送
										<?php endif;?>
									</td>
									<th>發票狀態</th>
									<td>
										<?php if($content_result->order_inv_status == 0):?>
											未開立
										<?php elseif($content_result->order_inv_status == 1):?>
											已開立
										<?php endif;?>
									</td>
								</tr>
								<tr>
									<th>備註</th>
									<td colspan="5"><?php echo $content_result->order_note;?></td>
								</tr>
							</table>
						</div>
						<?php endif;?>
						<div class="table-responsive">
							<table class="table table-striped table-advance table-hover">
								<thead>
									<tr>
										<td colspan="8" class="title" style="border:1px solid #707070;">訂購商品明細</td>
									</tr>
									<tr>
										<th>
											#
										</th>
										<th>訂購商品</th>
										<th>size</th>
										<th>顏色</th>
										<th>方案</th>
										<th>數量</th>
										<th>小計</th>
										<th>刪除</th>
									</tr>
								</thead>
								<tbody>
									<?php if(isset($detail_result)):?>
										<?php foreach($detail_result as $key=>$row):?>
											<tr id="did_<?php echo $row->id?>">
												<td><?php echo $key+1?></td>
												<td><?php echo $row->pro_name?></td>
												<td><?php echo $row->pro_size?></td>
												<td><?php echo $row->pro_color?></td>
												<td><?php echo $row->promo_name?></td>
												<td><?php echo $row->product_num?></td>
												<td><?php echo $row->product_price?></td>
												<td>
													<button type="button" class="btn btn-danger btn-xs del" style="height: 18px;" did="<?php echo $row->id?>"><i class="glyphicon glyphicon-remove"></i></button>
												</td>
											</tr>
										<?php endforeach;?>
									<?php else:?>
											<tr>
												<td colspan="8">No result.</td>
											</tr>
									<?php endif;?>
								</tbody>
								<tfoot>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>總計</td>
										<td>0</td>
										<td></td>
									</tr>
								</tfoot>
							</table>
						</div>
						<div class="form-group">
							<div class="col-sm-12" style="text-align:center">
								<button type="button" class="btn btn-success" onclick="aHover('<?php echo $set_order_status_url?>' + '<?php echo $content_result->id?>/1')">已處理</button>
								<button type="button" class="btn btn-info" onclick="aHover('<?php echo $edit_url?>')">修改模式</button>
								<button type="button" class="btn btn-danger" onClick="aHover('<?php echo $module_uri?>')">取消</button>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>

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

	$j(document).ready(function($) {
		$j("#event_charge").numeric();
		$j("#regi_limit_num").numeric();

		$j(".del").on("click", function(){
			$j(".do-del").show();
			$j(".do-del-all").hide();
			$j(".do-del").attr("did", $(this).attr("did"));
			$j('#myModal').modal('toggle');
		});

		$j(".do-del").on("click", function(){
			var api_url = '<?php echo $del_detail_url?>' + $(this).attr('did');
			var did = $(this).attr('did');
		   
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
						$j("#did_" + did ).fadeOut(1000, function(){$(this).remove();});

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
		 
	});
</script>