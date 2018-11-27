<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Trinity_College
 */

?>
<div class="page_feature"></div>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="page_header">
		<?php if (get_field('header_image')): ?>
			<div class="js-background page_background" data-background-options='{"source": {
				"0px": "<?php tric_image(get_field('header_image'),'740x555') ?>",
				"500px": "<?php tric_image(get_field('header_image'),'980x552') ?>",
				"980px": "<?php tric_image(get_field('header_image'),'1220x686') ?>",
				"1220px": "<?php tric_image(get_field('header_image'),'1440x617') ?>"
			}}'></div>
		<?php endif ?>
		<div class="page_header_inner">
			<div class="fs-row">
				<!-- Main Content -->
				 <div class="fs-cell fs-lg-11 fs-xl-10 fs-xl-push-1 content_wrapper">
					<div class="page_header_body">
						<?php
							$parent 		= get_post($post->post_parent);
							$pb_link 		= esc_url(get_permalink($parent->ID));
							$pb_title 		= $parent->post_title;
							$pb_secondary 	= false;
							$pb_front 		= get_page(get_option( 'page_on_front' ));

							if ((get_current_blog_id() > 1) && !(is_front_page())) {
								$pb_secondary 	= true;
								$pb_front 		= get_page(get_option( 'page_on_front' ));
								$pb_link 		= esc_url(get_permalink($pb_front->ID));
								$pb_title 		= $pb_front->post_title;
							}
						?>
						<?php if ($post->post_parent || $pb_secondary): ?>
							<a class="page_back" href="<?php echo $pb_link  ?>">
								<span class="page_back_icon">
									<svg class="icon icon_back">
										<use xlink:href="<?php tric_icon('back') ?>"></use>
									</svg>
								</span>
								<span class="page_back_label">Back to <?php echo $pb_title; ?></span>
							</a>
						<?php endif ?>

						<h1 class="page_title"><?php the_title() ?></h1>
						<?php get_template_part( 'inc/partials/navigation', 'sub' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div><!-- .page_header -->

	<!-- .content -->
	<div class="page_content">
		<div class="fs-row">
			<div class="fs-cell fs-lg-11 fs-xl-9 fs-xl-push-1 content_wrapper">
				<main class="main_content" id="main_content" itemprop="mainContentOfPage">
					<div class="typography">
						<p class="intro"><?php the_field('intro_paragraph') ?></p>
						<?php the_content() ?>
					</div>
					<div class="in_content_callouts">
						<?php
							if (get_field('in-content_components')) {
								tric_the_in_content_components(get_field('in-content_components'));
							}
						?>
					</div>
				</main>
			</div>
		</div>
		<div class="full_width_callouts">
			<?php
				if (get_field('full-width_components')) {
					tric_the_full_width_components(get_field('full-width_components'));
				}
			?>
			<?php include get_template_directory() . '/inc/full-width-components/template-share.php' ?>
		</div><!--.full_width_callouts -->
	</div><!--.page_content-->

</div><!-- #post-<?php the_ID(); ?> -->
