<?php get_header(); ?>
    <!-- Content -->
	<div id="content" class="content-padding">
		<div class="section-28">
			<div class="main-container">
				<h2><?php printf( __( 'Search Results for: %s', 'theme' ), get_search_query() ); ?></h2>
				 <?php if ( have_posts() ) { ?>
					<?php while ( have_posts() ) { the_post(); ?>		
						<div class="loop">
							<div class="post-box clearfix">
								<div class="wrap-box">							
									<div class="text-box" style="width: 100%;">
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<div class="info-box">
											<strong><?php echo get_the_author(); ?></strong>
											<span><?php echo get_the_date('F j, Y');?></span>
										</div>
										<?php the_excerpt();  ?>											
									</div>
								</div>
							</div>
							<hr class="transform-line transform-line-left">
						</div>
					<?php } ?>
				<?php } else { ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php } ?>
			</div>
		</div>				
	</div>
<?php get_footer(); ?>
