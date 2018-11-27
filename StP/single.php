<?php get_header(); ?>
<?php
switch ( get_the_ID() ) {
  case 212: // /calendar/
  case 215: // /school-startfinish-times-2/
    $extra_classes = "wide";
    break;
  default:
    $extra_classes = "";
}

if (function_exists('coauthor_get_the_author')) {
    $coauthor = coauthor_get_the_author();
}

?>
    <!-- Content -->
	<div id="content" class="content-padding">
		<div class="section-29">	
			<?php while ( have_posts() ) : the_post(); ?>	
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="wrap-big-img">
						<?php if (CFS()->get('big_image') != '') { ?>
                            <img src="<?php echo CFS()->get('big_image'); ?>" />
                        <?php } ?>									
					</div>
				<?php } ?>	
				<div class="main-container">
					<div class="text-area <?= $extra_classes ?>">
						<h3><?php the_title(); ?></h3>
						<div class="info-box <?php echo $coauthor['class'] ?>">
							<strong><?php echo get_the_author(); ?></strong>
							<span><?php echo get_the_date('F j, Y');?></span>
							<?php 
							if ($coauthor['status']) {
								echo $coauthor['data'];
							} ?>
						</div>
						<?php if ( function_exists( 'sharing_display' ) && in_category( 'blog' )): ?>
							<div style="margin-bottom: 50px;"><?php echo sharing_display(); ?></div>
						<?php endif; ?>
						<?php the_content();?>
						<?php if(in_category('Blog')) { ?>
							<div class="wrap-btn"><a href="<?php bloginfo('url'); ?>/conversations/" class="back-to-btn"><span>BACK TO CONVERSATIONS</span></a></div>
						<?php } ?>
					</div>
				</div>
			<?php endwhile; ?>	
		</div>				
	</div>
<?php get_footer(); ?>
