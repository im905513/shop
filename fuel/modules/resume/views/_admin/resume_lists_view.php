<?php echo css($this->config->item('resume_css'), 'resume')?> 

<section class="main-content">
<section class="wrapper" style="margin:0px">
	<div id="dialog-confirm" title="刪除確認?">
	  <p></p>
	</div>

	<div class="row">
		<div class="span12">
			<ul class="breadcrumb">
			  <li>位置：履歷列表</li>
			</ul>
		</div>
	</div>

	<div class="row">
		<label class="col-sm-1 control-label" >
			姓名
		</label>
	    <div class="col-sm-2">
	        <input type="text" class="form-control m-bot15" placeholder="" value="<?php echo $search_name; ?>" name="search_name"/>
	    </div>
	    <label class="col-sm-1 control-label" >
			ID
		</label>
	    <div class="col-sm-2">
	        <input type="text" class="form-control m-bot15" placeholder="" value="<?php echo $search_id; ?>" name="search_id"/>
	    </div>
	</div> 
	<div class="row">
		<label class="col-sm-1 control-label" >
			推薦人
		</label>
	    <div class="col-sm-2">
	        <select name="search_recommended">
	        	<option value="">不拘</option>
				<?php
					if(isset($recommended_ary)):
				?>	
				<?php   foreach($recommended_ary as $key=>$rows):?>
					<option value="<?php echo $rows->code_key ?>" <?php if ($search_recommended == $rows->code_key): ?>
						selected
					<?php endif ?>><?php echo $rows->code_name ?></option>
				<?php endforeach;?>
				<?php endif;?>
			</select>
	    </div>
	</div>
	<div class="row">
		<label class="col-sm-1 control-label" >
			註冊日期
		</label>
	    <div class="col-sm-2">
	        <input type="text" class="form-control m-bot15 col-sm-4" placeholder="" value="<?php echo $create_time_s; ?>" id="create_time_s" name="create_time_s"/>
	       
	    </div>
	    <div class="col-sm-1">
	    	~
	    </div>
	    <div class="col-sm-2"> 
	        <input type="text" class="form-control m-bot15" placeholder="" value="<?php echo $create_time_e; ?>" id="create_time_e" name="create_time_e"/>
	    </div>
	</div>
	<div class="row">
		<label class="col-sm-1 control-label" >
			地區
		</label>
	    <div class="col-sm-2">
	         <!-- <input type="text" class="form-control m-bot15" placeholder="" value="<?php echo $search_location; ?>" name="search_location"/> -->
	         <select name="search_city">
	        	<option value="" <?php echo $search_city == ""?"selected":""; ?>>不拘</option>
				<?php
					if(isset($city_ary)):
				?>	
				<?php   foreach($city_ary as $key=>$rows):?>
					<option value="<?php echo $rows->address_city ?>" <?php if ($search_city == $rows->address_city): ?>
						selected
					<?php endif ?>><?php echo $rows->address_city ?></option>
				<?php endforeach;?>
				<?php endif;?>
			</select>
	    </div> 
	</div>
	<div class="row">		 
		<label class="col-sm-1 control-label" >
			年齡範圍
		</label>
	    <div class="col-sm-2">
	         <input type="text" class="form-control m-bot15" placeholder="" value="<?php echo $search_age_s; ?>" name="search_age_s"/>
	    </div>
	     <div class="col-sm-1">
	    	~
	    </div>
	    <div class="col-sm-2">
	         <input type="text" class="form-control m-bot15" placeholder="" value="<?php echo $search_age_e; ?>" name="search_age_e"/>
	    </div>
	</div>	 
	<div class="row">
		<label class="col-sm-1 control-label" >
			尋找工作狀態
		</label>
	    <div class="col-sm-2">
	         <select name="search_find_job_kind">
	        	<option value=""  <?php echo $search_find_job_kind == ""?"selected":""; ?> >不拘</option>
	        	<option value="0" <?php echo $search_find_job_kind == "0"?"selected":""; ?> >找打工</option>
	        	<option value="1" <?php echo $search_find_job_kind == "1"?"selected":""; ?> >找全職工作</option>
			</select>
	    </div>
		<label class="col-sm-1 control-label" >
			就業狀態
		</label>
	    <div class="col-sm-2">
	        <select name="search_job_state">
	        	<option value=""  <?php echo $search_job_state == ""?"selected":""; ?>>不拘</option>
				<option value="0" <?php echo $search_job_state == "0"?"selected":""; ?>>在職</option>
	        	<option value="1" <?php echo $search_job_state == "1"?"selected":""; ?>>在學</option>
				<option value="2" <?php echo $search_job_state == "2"?"selected":""; ?>>待業</option>
			</select>
	         
	    </div>
	</div>
	 
	<div class="row">
		<label class="col-sm-1 control-label" >
			就讀學校
		</label>
	    <div class="col-sm-2">
	         <select name="search_school">
	        	<option value="" <?php echo $search_school == ""?"selected":""; ?>>不拘</option>
				<?php
					if(isset($school_ary)):
				?>	
				<?php   foreach($school_ary as $key=>$rows):?>
					<option value="<?php echo $rows->code_id ?>" <?php if ($search_school == $rows->code_id): ?>
						selected
					<?php endif ?>><?php echo $rows->code_name ?></option>
				<?php endforeach;?>
				<?php endif;?>
			</select>
	    </div> 
	</div>
 	<div class="row">
		<label class="col-sm-1 control-label" >
			工作技能
		</label>
	    <div class="col-sm-2">
	         <select name="search_skill">
	        	<option value="" <?php echo $search_skill == ""?"selected":""; ?>>不拘</option>
				<?php
					if(isset($skill_ary)):
				?>	
				<?php   foreach($skill_ary as $key=>$rows):?>
					<option value="<?php echo $rows->code_id ?>" <?php if ($search_skill == $rows->code_id): ?>
						selected
					<?php endif ?>><?php echo $rows->code_name ?></option>
				<?php endforeach;?>
				<?php endif;?>
			</select>
	    </div>
	</div>
	<div class="row">
		<label class="col-sm-1 control-label" >
			是否有工作經驗
		</label>
	    <div class="col-sm-2">
	         <select name="search_exp">
	        	<option value=""  <?php echo $search_exp == ""?"selected":""; ?> >不拘</option>
	        	<option value="1" <?php echo $search_exp == "1"?"selected":""; ?> >有</option>
	        	<option value="0" <?php echo $search_exp == "0"?"selected":""; ?> >無</option>
			</select>
	    </div>
	</div>
	<div class="row">
		<label class="col-sm-1 control-label" >
			電子郵件
		</label>
	    <div class="col-sm-2">
	        <input type="text" class="form-control m-bot15" placeholder="" value="<?php echo $search_email; ?>" name="search_email"/>  
	    </div>
	</div>
	<div class="row">
		<label class="col-sm-1 control-label" >
			關於自己
		</label>
	    <div class="col-sm-2">
	        <input type="text" class="form-control m-bot15" placeholder="" value="<?php echo $search_about; ?>" name="search_about"/>  
	    </div>
	</div>
	<div class="row">
		<label class="col-sm-1 control-label" >
			管理者備註
		</label>
	    <div class="col-sm-2">
	        <input type="text" class="form-control m-bot15" placeholder="" value="<?php echo $search_note; ?>" name="search_note"/>  
	    </div>
	</div>

	<div class="row">
		<label class="col-sm-1 control-label" >
			性別
		</label>
	    <div class="col-sm-2">
	         <select name="search_sex">
	        	<option value=""  <?php echo $search_sex == ""?"selected":""; ?> >不拘</option>
	        	<option value="0" <?php echo $search_sex == "0"?"selected":""; ?> >女</option>
	        	<option value="1" <?php echo $search_sex == "1"?"selected":""; ?> >男</option>
			</select>
	    </div>
	</div>

	<div class="row" style="">
 		
	    <div class="col-md-12 sheader"> 
			 
			<div class="form-inline" style="margin-top:10px" >
				<div class="form-group">
					<button type="submit" class="btn btn-warning">搜尋</button>
					<button class="btn btn-info" type="button" onClick="aHover('<?php echo $create_url;?>')">新增履歷</button>
					<button class="btn btn-info" type="button" onClick="aHoverBlank('<?php echo $export_url;?>')">匯出Excel</button>
				</div>
			</div>
	    </div>
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
						<th>ID</th>
						<th>姓名</th>
						<th>性別</th>
						<th>FB ID</th>
						<th>電話</th>
						<th>年齡</th>
						<th>地址</th>
						<th>電子郵件</th>
						<th>註冊日期</th>
						<th>尋找工作</th>
						<th>管理者備註</th>
						<th>刪除</th>
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
								<input type="checkbox" name="account[]" account="<?php echo $rows->account?>"/>
							</label>
						</td>
						<td><?php echo $rows->id; ?></td>
						<td><a href="<?php echo $edit_url.$rows->account?>"><?php echo $rows->name != ""?$rows->name:"未填寫";?></a></td>
						<td>
							<?php if ($rows->sex == "1"): ?>
								男
							<?php elseif ($rows->sex == "0"): ?>
								女
							<?php else: ?>
								未填寫
							<?php endif ?>
						</td>	
						<td><a target="_blank" href="<?php echo "http://www.facebook.com/".$rows->fb_account?>"><?php echo $rows->fb_account?></a></td>
						<td><?php echo $rows->contact_tel?></td>
						<td>
					       <?php 
                             $birthDate = explode("-", $rows->birth);
                              //get age from date or birthdate
                              $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                                ? ((date("Y") - $birthDate[0]) - 1)
                                : (date("Y") - $birthDate[0]));
                            	echo ($age>70 || $age < 16) ? "未正確填寫生日":$age;

                            ?>
						</td>
						<td><?php echo "[$rows->address_zip] $rows->address_city $rows->address_area $rows->address" ?></td>
						<td><?php echo $rows->contact_mail?></td>
						<td><?php echo $rows->create_time?></td>
						<td>
							<?php  
                                if($rows->find_job_kind == "0"){
                                    echo "我目前在找打工";
                                }elseif($rows->find_job_kind == "1"){
                                    echo "我目前在找全職工作";
                                }
                            ?> 
						</td>
						<td><?php echo $rows->note?></td>
						<td>
							<button class="btn btn-xs btn-danger del" type="button" onclick="dialog_chk('<?php echo $rows->account?>')">刪除</button>
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
<?php echo js($this->config->item('codekind_javascript'), 'codekind')?>
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

		$('#create_time_e').datepicker({dateFormat: 'yy-mm-dd'});
		$('#create_time_s').datepicker({dateFormat: 'yy-mm-dd'});

		$j("#select-all").click(function() {

		   if($j("#select-all").prop("checked"))
		   {
				$j("input[name='account[]']").each(function() {
					$j(this).prop("checked", true);
				});
		   }
		   else
		   {
				$j("input[name='account[]']").each(function() {
					$j(this).prop("checked", false);
				});     
		   }
		});

		$j("button.delall").click(function(){
			var accounts = [];
			var j = 0;
			var postData = {};
			var api_url = '<?php echo $multi_del_url?>';
			$j("input[name='account[]']").each(function(i){
				if($j(this).prop("checked"))
				{
					accounts[j] = $j(this).attr('account');
					j++;
				}
			});

			postData = {'accounts': accounts};
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

	function del(account)
	{
		var	 api_url = '<?php echo $del_url."?account="?>' + account;

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