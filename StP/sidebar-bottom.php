<?php 
	$args = array(   
		'post_type' => 'academics',		
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'order' => 'ASC'
	);
	$academics = query_posts($args);		
?>	

<div class="top-footer">
	<div class="main-container">
		<div class="table-box clearfix">
			<?php $count = 0; 
            foreach($academics as $academic) { the_post(); ?>
                <?php if ($count == 1) { ?>
                    <div class="cell-box equal-height-1">
                    <?php echo CFS()->get('contact_info') ?>
                </div>
                <hr class="tablet-line">
                <?php } elseif ( $count == 3 ) { ?>
                    <div class="cell-box equal-height-1">
                        <?php echo CFS()->get('contact_info') ?>
                    </div>
                <?php } else { ?>
                    <div class="cell-box equal-height-1">
                        <?php echo CFS()->get('contact_info') ?>
                    </div>
                    <hr class="mobile-line">
                <?php }
                $count++; ?>
                
                	
			<?php } ?>
		</div>		
	</div>
</div>
