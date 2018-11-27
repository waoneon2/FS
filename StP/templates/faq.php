<?php
/**
 * Template Name: FAQ
 */
?>
<?php get_header(); ?>
	<div id="content" class="content-padding">
		<div class="section-30">
			<div class="main-container">
				<?php if ( have_posts() ) { ?>
					<?php while ( have_posts() ) { the_post(); ?>
						<h2><?php the_title(); ?></h2>
							<dl class="qa-list">
							<?php $fields = CFS()->get('block'); ?>
							<?php foreach ($fields as $field) { ?>
								<dt><?php echo $field['question']; ?></dt>
								<dd><?php echo $field['answer']; ?></dd>		
							<?php } ?>							
					<?php } ?>
				<?php } ?>
			</div>
		</div>				
	</div>
<?php get_footer(); ?>
