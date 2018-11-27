<?php
/**
 * Template Name: Parent Portal
 */

function get_post_id($slug) {
  $obj = get_page_by_path ( $slug, OBJECT, 'post' );
  if ( $obj ) {
    return $obj->ID;
  }
  return null;
}
?>
<?php get_header(); ?>
	<div id="content" class="content-padding">
		<div class="section-27">
			<div class="main-container">
				<div class="wrap-box">
					<h2><?php the_title(); ?></h2>

						<?php
							$latest_blog = latest_blog();

							// Display the "Parent Portal" boxes in this order
							$pp_order = array(
								'skyward', # Skyward
								'st-pauls-conversations-2', # St Paul's Conversations
								'extended-day-programs', # Athletics / Extended Day Programs
								'lunches', # Lunches (K-12)
								'field-trips', # Field Trips / Medical Forms
								'uniforms-and-dress-code', # Uniforms and dress code
								'resources-forms', # Resources / Forms
								'pals', # PALS
								'school-startfinish-times-2', # School Start/Finish Times
								'calendar' # Calendar
							);

							foreach ( $pp_order as $slug ) {
								$pp_order_query[] = get_post_id ( $slug );
							}

							$args = array(
								'post_type' => 'post',
								'cat' => get_cat_ID('Parent Portal'),
								'post__in' => $pp_order_query,
								'post_status' => 'publish',
								'posts_per_page' => -1,
								'orderby' => 'post__in',
							);
							$portals = query_posts($args);
						?>
					<ul class="portal-list">
						<?php foreach($portals as $key => $portal) { the_post();
							?>
							<li>
								<a href="<?= get_the_permalink() == home_url('/st-pauls-conversations-2/') ? home_url('/conversations/') : get_the_permalink(); ?>">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="wrap-img">
										<?php if ($key == 1 && (time()-(60*60*24*5)) <= strtotime($latest_blog)): ?>
											<img width="540" height="255" src="http://stpaul.academy/wp-content/uploads/2016/02/New-Blog.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="img-85" sizes="(max-width: 540px) 100vw, 540px">
										<?php else: ?>
											<?php the_post_thumbnail(); ?>
										<?php endif ?>
										</div>
									<?php } ?>

									<div class="box"><div class="table-box"><div class="cell-box"><span><?php the_title(); ?></span></div></div></div>
								</a>
							</li>
						<?php } ?>

					</ul>
				</div>
			</div>
		</div>
	</div>

	<?php
	function latest_blog(){
		$blog_args = array(
		    'numberposts' => 1,
		    'cat' => get_cat_ID('Blog'),
		    'orderby' => 'post_date',
		    'order' => 'DESC',
		    'post_type' => 'post',
		    'post_status' => 'publish' );
	    $recent_blog = wp_get_recent_posts( $blog_args, ARRAY_A );

	    return $recent_blog[0]['post_date'];
	}
	?>

<?php get_footer(); ?>
