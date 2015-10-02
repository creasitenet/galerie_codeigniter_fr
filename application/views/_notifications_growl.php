		
	<?php if ($this->session->flashdata('error_growl') != ''): ?>
		<script type="text/javascript">
			$(document).ready(function() {	
				show_notification('error', "<?php echo $this->session->flashdata('error_growl') ?>" );	
			});				
		</script>
	<?php endif; ?>
	
	<?php if ($this->session->flashdata('success_growl') != ''): ?>
		<script type="text/javascript">
			$(document).ready(function() {	
				show_notification('success',"<?php echo $this->session->flashdata('success_growl') ?>");	
			});			
		</script>
	<?php endif; ?>
