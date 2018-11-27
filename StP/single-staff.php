<?php get_header(); ?>
    <!-- Content -->
	<div id="content" class="content-padding">
	 	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>				
		<div class="section-11">
			<div class="main-container">
				<div class="inside-small-container">
					<div class="person-section clearfix">
						<div class="wrap-img">
							<?php if ( has_post_thumbnail() ) {
								$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');							
								echo '<img style="width: 100%; height: auto;" src="' . $large_image_url[0] . '" alt="' . get_the_title() . '" />';
							} ?>
						</div>
						<?php 
							$phone = CFS()->get('phone');
							$email = CFS()->get('email');
							$education = CFS()->get('education');						
						?>
						<div class="info-box">

							<div class="title-box">
								<h5><?php the_title(); ?></h5>
								<p><?php echo CFS()->get('grade'); ?></p>
							</div>	
					
							<?php if(!empty($phone)) { ?>
								<a href="tel:<?php echo $phone; ?>"  class="phone"><span><?php echo $phone; ?></span></a>
							<?php } ?>

							<?php if(!empty($email)) { ?>
								<a href="mailto:<?php echo $email; ?>" class="email"><span><?php echo $email; ?></span></a>
							<?php } ?>

							<?php if(!empty($education)) { ?>
								<p><strong>Education:</strong> <?php echo $education; ?></p>
							<?php } ?>

						</div>
					</div>

					<div class="text-box-container">
						<?php the_content(); ?>
					</div>
					<div class="wrap-button-section"><a href="<?php bloginfo('url'); ?>/about/">BACK TO ABOUT</a></div>
				</div>
			</div>
			<hr class="transform-line transform-line-left">
		</div>
		<!-- Explore more Teachers -->
		<div class="section-12">
			<div class="main-container">
				<h3>Explore more Teachers</h3>
				<?php 
					$args = array(   
						'post_type' => 'staff',				
						'post_status' => 'publish',
						'post__not_in' => array(get_the_ID()),
						'posts_per_page' => -1,
						'orderby' => 'rand',
						'tax_query' => array(
                            array(
                                'taxonomy' => 'education-staff',
                                'field' => 'slug',
                                'terms' => 'teachers',
                            )
                        )
					);
					$staffs = get_posts($args);
				?>
				<div class="carousel-section">
					<?php foreach($staffs as $staff) { ?>
						<div>
							<div class="box">
								<a href="<?php echo get_the_permalink($staff->ID); ?>">
									<?php if ( has_post_thumbnail() ) {
										$teacher = wp_get_attachment_image_src(get_post_thumbnail_id($staff->ID), 'full'); 					
										echo '<img style="width: 100%; height: auto;" src="' . $teacher[0] . '" alt="' . get_the_title($staff->ID) . '" />';
									} ?>
									<?php echo get_the_title($staff->ID); ?>
								</a>
								<p><?php echo CFS()->get('grade', $staff->ID); ?></p>
							</div>	
						</div>	
					<?php } ?>				
				</div>
			</div>
		</div>
		<?php endwhile; endif; ?>
	</div>
<?php get_footer(); ?>
