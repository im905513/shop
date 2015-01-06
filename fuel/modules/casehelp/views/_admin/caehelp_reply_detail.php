<?php echo css($this->config->item('case_help_css'), 'casehelp')?>

 
<section class="main-content">
	<section class="wrapper">
		<div class="row" style="">
		    <div class="col-md-2 sheader"><h4>回覆案件內容</h4></div>
		    <div class="col-md-10 sheader">
				
		    </div>
		</div> 

		<div class="row">
			<section class="panel">
				<table class="table table-striped table-advance table-hover">

				</table>
			</section>
		</div>
	</section>
</section>
<?php echo js($this->config->item('case_help_javascript'), 'casehelp')?>
<script>
	function aHover(url)
	{
		location.href = url;
	}
</script>