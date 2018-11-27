<?php get_header(); ?>
	<div id="content" class="content-padding">
		<div class="section-28">
			<div class="main-container">
				<?php if ( have_posts() ) { ?>
					<?php while ( have_posts() ) { the_post(); ?>
						<h2><?php the_title(); ?></h2>
						<?php the_content(); ?>
					<?php } ?>
				<?php } ?>	
			</div>
		</div>		
	</div>
<?php get_footer(); ?>
