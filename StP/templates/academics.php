<?php
/**
 * Template Name: Academics
 */
?>
<?php get_header(); ?>
<div id="content" class="content-padding">
	<div class="section-25">
		<div class="main-container">
			<?php if ( have_posts() ) { ?>
				<?php while ( have_posts() ) { the_post(); ?>
					<div class="wrap-box">
						<?php the_content(); ?>		
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>	
	<?php 
		$args = array(   
			'post_type' => 'academics',		
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'order' => 'ASC'
		);
		$academics = query_posts($args);						
	?>
	<?php $a = 0; foreach($academics as $academic) { the_post(); ?>				
		<?php if(($a % 2) == 0) { ?>
			<div class="section-26 left-landing">
				<div class="main-container">
					<div class="column-group steps-animated clearfix">
						<div class="left-column">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="wrap-img">
									<?php the_post_thumbnail(); ?>									
								</div>
							<?php } ?>						
						</div>
						<div class="right-column">
							<div class="title-box animated step-2" data-animateFunction="fadeIn"><h3><?php the_title(); ?></h3></div>
							<?php the_content(); ?>
							<a href="<?php the_permalink(); ?>" class="learn-more-btn animated step-4" data-animateFunction="fadeIn"><span>Learn More</span></a>
						</div>
					</div>
				</div>
				<hr class="transform-line transform-line-left">
			</div>
		<?php } else { ?>
			<div class="section-26 right-landing">
				<div class="main-container">
					<div class="column-group steps-animated clearfix">
						<div class="left-column">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="wrap-img">
									<?php the_post_thumbnail(); ?>									
								</div>
							<?php } ?>	
						</div>
						<div class="right-column">
							<div class="title-box animated step-2" data-animateFunction="fadeIn"><h3><?php the_title(); ?></h3></div>
							<?php the_content(); ?>				
							<a href="<?php the_permalink(); ?>" class="learn-more-btn animated step-4" data-animateFunction="fadeIn"><span>Learn More</span></a>
						</div>
					</div>
				</div>
				<hr class="transform-line transform-line-right">
			</div>		
		<?php } ?>
	<?php  $a++; } ?>
</div>

<?php get_footer(); ?>
