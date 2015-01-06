function update_user_info(user_data)
{
	var uri = base_url + 'user/update/email/mobile';

	show_loading();

	$.ajax({
		url: uri,
		type: 'POST',
		dataType: 'json',
		data: user_data,
	})
	.done(function(data) {

		hide_loading();

		if(data.status == 1)
		{
			location.href = base_url + 'case/help/step3';
		}
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});

	return true;
	
}

function help_require(case_url, cdID, cli_intro)
{
	var uri = base_url + 'case/help/require';
	var postData = {"case_url": case_url, "cd_id": cdID, "cli_intro": cli_intro};

	show_loading();

	$.ajax({
		url: uri,
		type: 'POST',
		dataType: 'json',
		data: postData,
	})
	.done(function(data) {

		hide_loading();
		
		if(data.status == 1)
		{
			alert("收到提案申請囉！由於使用人數蠻多的！請您耐心等等我嘿！");
			location.href = base_url + 'case/help/step3';
		}
		else
		{
			var msg = data.msg;

			alert(msg);
			return;
		}
	})
	.fail(function() {
		//console.log("error");
	})
	.always(function() {
		//console.log("complete");
	});

	return true;
	
}