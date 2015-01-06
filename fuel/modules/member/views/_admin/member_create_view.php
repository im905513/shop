<?php //echo js($this->config->item('order_javascript'), 'order')?>
<?php echo css($this->config->item('member_css'), 'member')?>
<style>


</style>
<div id="main_content">
	<div class="row" style="margin:10px 10px">
	    <div class="span2 sheader"><h1>會員管理</h1></div>
	    <div class="span11 sheader">
	    </div>
	</div>

<div class="row" style="margin:10px 10px">
	<div class="span12">
		<ul class="breadcrumb">
		  <li><a href="#">會員管理</a></li>
		  <li class="active"><?php echo $view_name?></li>
		</ul>
	</div>
</div>
<div class="row" style="margin:10px 10px">
	<div class="span12">
		<form method="post" action="<?php echo $submit_url?>" enctype="multipart/form-data" id="addForm">
			<table class="table table-bordered">
				<thead>
					<tr>
						<td colspan="2"><?php echo $view_name?></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>會員帳號</td>
						<td>
							<div class="col-xs-5">
								<input id="member_account" name="member_account" type="text" class="form-control input-sm" value="" required/>
							</div>
						</td>
					</tr>
					<tr>
						<td>會員密碼</td>
						<td>
							<div class="col-xs-5">
								<input id="member_pass" name="member_pass" type="password" class="form-control input-sm" value="" required/>
							</div>
						</td>
					</tr>
					<tr>
						<td>確認密碼</td>
						<td>
							<div class="col-xs-5">
								<input id="member_chk_pass" name="member_chk_pass" type="password" class="form-control input-sm" value="" required/>
							</div>
						</td>
					</tr>
					<tr>
						<td>會員姓名</td>
						<td>
							<div class="col-xs-5">
								<input id="member_name" name="member_name" type="text" class="form-control input-sm" value="" required/>
							</div>
						</td>
					</tr>
					<tr>
						<td>會員電話</td>
						<td>
							<div class="col-xs-5">
								<input id="member_mobile" name="member_mobile" class="form-control input-sm" value="" />
							</div>
						</td>
					</tr>
					<tr>
						<td>會員地址</td>
						<td>
							<div class="col-xs-5">
								<input id="member_addr" name="member_addr" type="text" class="form-control input-sm" value="" required/>
							</div>
						</td>
					</tr>
					<tr>
						<td>統一編號</td>
						<td>
							<div class="col-xs-5">
								<input id="vat_num" name="vat_num" type="text" class="form-control input-sm" value=""/>
							</div>
						</td>
					</tr>
					<tr>
						<td>發票抬頭</td>
						<td>
							<div class="col-xs-5">
								<input id="inv_title" name="inv_title" type="text" class="form-control input-sm" value=""/>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:right">
							<button class="btn btn-small btn-primary" type="submit">新增</button>
							<button class="btn btn-small btn-warning" type="button" onclick="aHover('<?php echo $back_url?>')">取消</button>
						</td>
					</tr>
				</tobdy>
			</table>
		</form>
	</div>
</div>
<script>
	function aHover(url)
	{
		location.href = url;
	}

	jQuery(document).ready(function($) {
		var elem = $(".same_order");
		$(".same_order").click(function(){
			if($(this).is( ":checked" ))
			{
				$("#oa_name").val($("#order_name").val());
				$("#oa_mobile").val($("#order_mobile").val());
				$("#oa_addr").val($("#order_addr").val());
			}
			else
			{
				$("#oa_name").val("");
				$("#oa_mobile").val("");
				$("#oa_addr").val("");
			}
		});
	});
</script>