
<div id="alerts">
		
	<?php if ($this->session->flashdata('success') != ''): ?>
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<!--<strong>{{Lang::get('notifications.title.success')}} </strong>-->
			<strong><?php echo $this->session->flashdata('success'); ?></strong>
		</div>
	<?php endif; ?>
		
	<?php if ($this->session->flashdata('error') != ''): ?>
		<div class="alert alert-danger alert-block">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<!--<strong>{{Lang::get('notifications.title.error')}}</strong>-->
			<strong><?php echo $this->session->flashdata('error'); ?></strong>
		</div>
	<?php endif; ?>
		
</div>
