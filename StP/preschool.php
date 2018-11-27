<?php
/**
 * WP Post Template: Preschool
 */
?>
<?php get_header(); ?>
	<div id="content" class="content-padding">
		<div id="content" class="content-padding">
		<div class="section-13">
			<div class="main-container">
				<div class="column-group clearfix">
					 <?php if ( have_posts() ) { ?>
							<?php while ( have_posts() ) { the_post(); ?>
								<div class="left-column">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="wrap-img">
											<?php the_post_thumbnail(); ?>
										</div>
									<?php } ?>
								</div>
								<div class="right-column">
									<div class="title-box"><h3><?php the_title(); ?></h3></div>
									<?php the_content(); ?>
								</div>
							<?php } ?>
					<?php } ?>
				</div>
			</div>
			<hr class="transform-line transform-line-left">
		</div>
		<!-- Acadenics -->
		<div class="section-14 view-2">
			<div class="main-container">
				<div class="column-group steps-animated clearfix">
					<div class="top-row">
						<div class="text-box">
							<?php echo $cfs->get('text-1');?>
						</div>
						<div class="wrap-img img-size-1 hide-img"><img class="animated step-2" data-animateFunction="fadeIn" src="<?php echo $cfs->get('image1-1');?>" alt="Picture"></div>
					</div>
					<div class="bottom-row clearfix">
						<div class="wrap-img img-size-2">
							<img class="hide-mobile-img animated step-1" data-animateFunction="fadeIn" src="<?php echo $cfs->get('image1-2');?>" alt="Picture">
							<div class="ellipse-label-box animated step-6" data-animateFunction="fadeIn">
								<div class="ellipse-table-box">
									<div class="ellipse-cell-box">
										<?php echo $cfs->get('description-1');?>
									</div>
								</div>
							</div>
						</div>
						<div class="wrap-img img-size-3 hide-img"><img class="animated step-3" data-animateFunction="fadeIn" src="<?php echo $cfs->get('image1-3');?>" alt="Picture"></div>
					</div>
				</div>
			</div>
			<hr class="transform-line transform-line-right">
		</div>
		<!-- Individual Focus -->
		<div class="section-23">
			<div class="main-container">
				<div class="column-group steps-animated clearfix">
					<div class="top-row">
						<div class="text-box">
							<?php echo CFS()->get('text-2'); ?>
						</div>
						<div class="wrap-img hide-img">
							<img class="animated step-2" data-animateFunction="fadeIn" src="<?php echo $cfs->get('image2-1');?>" alt="Picture">
						</div>
					</div>
					<div class="bottom-row">
						<div class="wrap-img">
							<img class="hide-mobile-img animated step-1" data-animateFunction="fadeIn" src="<?php echo $cfs->get('image2-2');?>" alt="Picture">
							<div class="ellipse-label-box animated step-5" data-animateFunction="fadeIn">
								<div class="ellipse-table-box">
									<div class="ellipse-cell-box">
										<?php echo CFS()->get('description-2'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr class="transform-line transform-line-left">
		</div>
		<!-- Open and Tolerant -->
		<div class="section-24">
			<div class="main-container">
				<div class="column-group steps-animated clearfix">
					<div class="top-row">
						<div class="text-box">
							<?php echo CFS()->get('text-3'); ?>
						</div>
						<div class="wrap-img hide-img">
							<img class="animated step-2" data-animateFunction="fadeIn" src="<?php echo CFS()->get('image3-1'); ?>" alt="Picture">
						</div>
					</div>
					<div class="bottom-row">
						<div class="wrap-img">
							<img class="hide-mobile-img animated step-1" data-animateFunction="fadeIn" src="<?php echo CFS()->get('image3-2'); ?>" alt="Picture">
							<div class="ellipse-label-box animated step-5" data-animateFunction="fadeIn">
								<div class="ellipse-table-box">
									<div class="ellipse-cell-box">
										<?php echo CFS()->get('description-3'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr class="transform-line transform-line-left">
		</div>

		<div class="section-17 height-item-2">
			<div class="main-container">
				<div class="column-group steps-animated">
					<div class="top-row clearfix">
						<div class="text-box">
							<?php echo CFS()->get('text-4'); ?>
						</div>
						<div class="wrap-img">
							<div class="hide-mobile-img animated step-1 fadeIn">
								<iframe width="100%" height="315" src="https://www.youtube.com/embed/exGb7MXqUBs?rel=0&amp;controls=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>	
							</div>
							<div class="ellipse-label-box animated step-6" data-animateFunction="fadeIn">
								<div class="ellipse-table-box">
									<div class="ellipse-cell-box">
										<?php echo CFS()->get('description-4'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="bottom-row clearfix">
						<div class="wrap-img img-size-1 hide-img"><img class="animated step-2" data-animateFunction="fadeIn" src="<?php echo CFS()->get('image4-2'); ?>" alt="Picture"></div>
						<div class="wrap-img img-size-2 hide-img"><img class="animated step-3" data-animateFunction="fadeIn" src="<?php echo CFS()->get('image4-3'); ?>" alt="Picture"></div>
					</div>
				</div>
			</div>
			<hr class="transform-line transform-line-left">
		</div>
		<div class="section-18-bottom" style="margin-top:190px;">
			<div class="pricing-title"><?php echo CFS()->get('pricing'); ?></div>
			<img class="hide-mobile-img animated step-1" data-animateFunction="fadeIn" src="<?php echo CFS()->get('pricing-image'); ?>" alt="Picture">
			<hr class="transform-line transform-line-left">
		</div>
		<div class="preschool-schedule section-18-bottom" style="margin-top:190px;">
			<div class="preschool-schedule-title"><?php echo CFS()->get('text-5'); ?></div>
			<img class="hide-mobile-img animated step-1" data-animateFunction="fadeIn" src="<?php echo CFS()->get('preschool-image-pricing-bottom'); ?>" alt="Picture">
			<hr class="transform-line transform-line-left">
		</div>
		<?php get_sidebar('academics'); ?>
	</div>

<?php get_footer(); ?>
