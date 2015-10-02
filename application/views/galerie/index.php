<h2>Galerie - Codeigniter 3</h2>

<div class="form">
<fieldset>

    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fileupload/jquery.fileupload.css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/fileupload/jquery.fileupload.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/fileupload/fileupload_init.js"></script>
    
    <form action="#" method="post" enctype="multipart/form-data">
        <div id="fileupload">
            <div id="fileupload_loader"></div>
            <span class="message">Glissez vos photos ici (ou cliquez) <br /><small> 1mo 1024x1024px</small></span>
            <center><input class="file-upload" type="file" name="fileup" /></center>
        </div>
    </form>
    
</fieldset>
<div class="clearfix"></div>
</div>

<div id='pictures'>
	<div class="row">
    <?php if(isset($pictures)): ?>    
        <?php include('_pictures.php'); ?>
    <?php endif; ?>
    </div>
</div>