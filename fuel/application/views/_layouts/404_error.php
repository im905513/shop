<?php $this->load->view('_blocks/header')?>
	
	<div id="main_inner">
		<div id="error_404">
			<h1><?php //echo fuel_var('heading'); ?></h1>
			<?php //echo fuel_var('body', ''); ?>
		</div>
	</div>

	<?php 
		if(isset($views)){
			$this->load->view($views);
		}
		else
		{
			echo fuel_var('body', '');
		}
	?>
	
<?php $this->load->view('_blocks/footer')?>
