<?php
/**
 * Template Name: About
 */
?>
<?php get_header('about'); ?>
	<?php
		$args = array(
			'post_parent' => $post->ID,
			'post_type' => 'page',
			'orderby' => 'menu_order',
			'order' => 'ASC'
		);
		$child_query = new WP_Query( $args );
		$video = CFS()->get('about-video');
	?>
	<script type="text/javascript">
		var video_ID = <?php echo json_encode(stpaulsacademy_get_youtube_id($video)) ?>
	</script>
	<div id="content" class="content-padding">
		<!-- Video  -->
		<div class="section-5" id="vision">
			<div class="main-container">
				<div class="wrap-section clearfix">
					<div class="wrap-box">
						<div class="containervid">
							<div id="player" class="video"></div>
						</div>
					</div>
				</div>
			</div>
			<hr class="transform-line">
		</div>
		<?php while ( $child_query->have_posts() ) : $child_query->the_post();?>
				<!-- Vision -->
				<?php if($post->post_name == 'vision') { ?>
					<div class="section-4" id="vision">
						<div class="main-container">
							<div class="wrap-section clearfix">
								<div class="left-box">
									<?php $fields = CFS()->get('left_images'); ?>
									<?php foreach ($fields as $field) { ?>
										<?php  if(!empty($field)) { ?>
											<div class="wrap-img"><img class="animated" data-animateFunction="fadeIn" src="<?php echo $field['image']; ?>" alt=""></div>
										<?php } ?>
									<?php } ?>
								</div>
								<div class="right-box">
									<?php $fields = CFS()->get('right_images'); ?>
									<?php foreach ($fields as $field) { ?>
										<?php  if(!empty($field)) { ?>
											<div class="wrap-img"><img class="animated" data-animateFunction="fadeIn" src="<?php echo $field['image']; ?>" alt=""></div>
										<?php } ?>
									<?php } ?>
								</div>
								<div class="wrap-ellipse-box">
									<div class="ellipse-box" data-0="background:linear-gradient(45deg, rgba(0,72,128,0.54) 0%, rgba(0,191,255,0.54) 100%);" data-top="background:linear-gradient(45deg, rgba(0,191,255,0.54) 0%, rgba(0,72,128,0.54) 100%);">
										<div class="wrap-box">
											<?php the_content();?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr class="transform-line transform-line-left">
					</div>
				<?php } ?>
				<!-- Core Commitments -->
				<?php if($post->post_name == 'core-commitments') { ?>
					<div class="section-5" id="core-commitments">
						<div class="main-container">
							<h3 class="animated" data-animateFunction="fadeIn"><?php the_title(); ?></h3>
							<div class="wrap-box">
								<?php  $fields = CFS()->get('core-commitments'); ?>
								<?php foreach ($fields as $field) { ?>
									<?php  if(!empty($field)) { ?>
										<div class="box animated" data-animateFunction="fadeIn">
											<?php echo $field['content']; ?>
										</div>
									<?php } ?>
								<?php } ?>
							</div>
						</div>
						<hr class="transform-line transform-line-right">
					</div>
				<?php } ?>
				<!-- mission -->
				<?php if($post->post_name == 'mission') { ?>
					<div class="section-4 section-4-view-1" id="mission">
						<div class="main-container">
							<div class="wrap-section clearfix">
								<div class="left-box">
									<?php $fields = CFS()->get('left_images'); ?>
									<?php foreach ($fields as $field) { ?>
										<?php  if(!empty($field)) { ?>
											<div class="wrap-img"><img class="animated" data-animateFunction="fadeIn" src="<?php echo $field['image']; ?>" alt=""></div>
										<?php } ?>
									<?php } ?>
								</div>
								<div class="right-box">
									<?php $fields = CFS()->get('right_images'); ?>
									<?php foreach ($fields as $field) { ?>
										<?php  if(!empty($field)) { ?>
											<div class="wrap-img"><img class="animated" data-animateFunction="fadeIn" src="<?php echo $field['image']; ?>" alt=""></div>
										<?php } ?>
									<?php } ?>
								</div>
								<div class="wrap-ellipse-box">
									<div class="ellipse-box" data-bottom-center="background:linear-gradient(45deg, rgba(0,72,128,0.54) 0%, rgba(0,191,255,0.54) 100%);" data-top="background:linear-gradient(45deg, rgba(0,191,255,0.54) 0%, rgba(0,72,128,0.54) 100%);">
										<div class="wrap-box">
											<?php the_content(); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr class="transform-line transform-line-left">
					</div>
				<?php } ?>
				<!-- Testimonials -->
				<?php if($post->post_name == 'testimonials') {
					$args = array(
						'post_type' => 'testimonials',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'order' => 'DESC',
					);

					$testimonials = query_posts($args);
					?>
					<div class="section-33" id="testimonials">
						<div class="main-container">
							<h3 class="animated" data-animateFunction="fadeIn">Success Stories from our Parents</h3>
							<?php foreach ($testimonials as $key => $testimonial): ?>
							<div class="testi">
								<div style="width: 210px; height: 210px; display: inline-block; overflow: hidden; border-radius: 50%;">
								<?php if ( has_post_thumbnail($testimonial->ID) ) {
									$image = wp_get_attachment_image_src(get_post_thumbnail_id($testimonial->ID), 'full');
									echo '<div class="wrap-img"><img style="width: 100%; height: auto;" src="' . $image[0] . '" alt="' . get_the_title($testimonial->ID) . '" /></div>';
								} else {
									echo '<img src="'.esc_url(get_template_directory_uri()).'/public/images/stp-default-image.png" alt="Testimonials"></a>';
								} ?>
								</div>
								<div class="titlebox">
									<h4><?php echo get_the_title($testimonial->ID); ?></h4>
									<span><?php echo CFS()->get('title', $testimonial->ID); ?></span>
								</div>
								<div class="content">
									<?php echo apply_filters('the_content', $testimonial->post_content) ?>
								</div>
							</div>
							<?php if (($key + 1) % 3 === 0): ?>
							<div class="clearfix"></div>
							<?php endif; ?>
							<?php endforeach ?>


						</div>
						<hr class="transform-line transform-line-left">
					</div>
				<?php } ?>
				<!-- Staff -->
				<?php if($post->post_name == 'staff') { ?>
					<div class="section-6" id="staff">
						<div class="main-container">
							<h3 class="animated" data-animateFunction="fadeIn">Staff</h3>
							<div class="tabs">
								<ul class="tabs-menu">
									<li><a href="javascript:;" rel="all">ALL</a></li>
									<li><a href="javascript:;" rel="school-staff-executive-leadership" style="width: 310px">SCHOOL STAFF & ADMINISTRATION</a></li>
									<li><a href="javascript:;" rel="teachers">TEACHERS</a></li>
								</ul>
								<div id="tabs-1" class="clearfix">
									<div id="content-tab" class="table-box image-color-change"></div>
								</div>
							</div>
						</div>
						<hr class="transform-line transform-line-right">
					</div>
				<?php } ?>
				<!-- Religion -->
				<!--
				<?php if($post->post_name == 'religion') { ?>
						<div class="section-7" id="religion">
							<div class="main-container">
								<div class="table-box">
									<?php  $fields = CFS()->get('religion'); ?>
									<?php foreach ($fields as $field) { ?>
										<?php  if(!empty($field)) { ?>
											<div class="cell-box">
												<?php echo $field['content']; ?>
											</div>
										<?php } ?>
									<?php } ?>
								</div>
							</div>
							<hr class="transform-line transform-line-left hide-transform-line">
						</div>
				<?php } ?>
				-->
				<!-- History -->
				<?php if($post->post_name == 'history') { ?>
					<div class="section-8" id="history">
						<div class="main-container">
							<h3 class="animated" data-animateFunction="fadeIn"><?php the_title(); ?></h3>
							<div class="slider-section">
								<?php  $fields = CFS()->get('sliders'); ?>
								<?php foreach ($fields as $field) { ?>
									<?php  if(!empty($field)) { ?>
										<div>
											<div class="box clearfix">
												<div class="info-box animated" data-animateFunction="fadeIn">
													<?php echo $field['content']; ?>
												</div>
												<div class="wrap-img">
													<img src="<?php echo $field['image']; ?>" alt="Picture">
												</div>
											</div>
										</div>
									<?php } ?>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>
		<?php endwhile; ?>
	</div>

<?php get_footer(); ?>

<script type="text/javascript">
	(function($) {
		$('.tabs-menu li').first().addClass('ui-tabs-active');
		var templateUrl = '<?php bloginfo("template_url") ?>',
			activeElem = $('.tabs-menu li.ui-tabs-active a').attr('rel');

		$.post(templateUrl+'/ajax/staff.php?staff='+ activeElem, function(data) {
			//console.log(data);
			$('#content-tab').html(data);
		});

		$('.tabs-menu li a').click(function() {
			var rel = $(this).attr('rel');

			$('.tabs-menu li').removeClass('ui-tabs-active');
			$(this).parents('li').addClass('ui-tabs-active');

			$.post(templateUrl+'/ajax/staff.php?staff='+rel, function(data) {
				$('#content-tab').html(data);
			});

			return false;
		});
	})(jQuery);

	// 2. This code loads the IFrame Player API code asynchronously.
	var tag = document.createElement('script');

	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	// 3. This function creates an <iframe> (and YouTube player)
	//    after the API code downloads.
	var player;
	function onYouTubeIframeAPIReady() {
		player = new YT.Player('player', {
			height: '600',
			width: '1110',
			playerVars: {
		        autoplay: 1,
		        loop: 1,
		       	rel: 0,
		       	showinfo: 0,
		        controls: 2,
		        showinfo: 0,
		        autohide: 1,
		        modestbranding: 1,
		        vq: 'hd1080'
		    },
			videoId: video_ID,
			events: {
				'onReady': onPlayerReady,
				'onStateChange': onPlayerStateChange
			}
		});
	}
	// 4. The API will call this function when the video player is ready.
	function onPlayerReady(event) {
		event.target.playVideo();
		player.mute();
	}

	var done = false;
	function onPlayerStateChange(event) {

	}
	function stopVideo() {
		player.stopVideo();
	}
</script>