

    <!-- Photos -->
    <?php if(isset($pictures)): ?>
    <?php if(!empty($pictures)): ?>
    	
        <?php foreach($pictures as $e): ?>
            <div class="col-sm-3">            
                <div id="picture_<?php echo $e->id; ?>">
                <div class="picture">

                    <!-- Bouton de suppression -->
                    <div class="inpicture">
                        <a href="upload/getDelete/<?php echo $e->id; ?>"><i class="fa fa-times bntsup"></i></a>                       
                    </div>
                    <img src="server/pictures/<?php echo $e->id; ?>-<?php echo $e->slug; ?>" class="image image-responsive" />
                    
                </div>
                </div>   
            </div> 
        <?php endforeach; ?>                     
           
    <?php endif; ?>
    <?php endif; ?>
    <!-- //Photos -->
