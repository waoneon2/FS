<?php
/**
 * Template for Alert Feature
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Trinity_College
 */
?>

<?php (get_current_blog_id() > 1) ? switch_to_blog(1) : '' ?>

	<?php $alerts = get_posts(array(
		'posts_per_page ' 	=> 1,
		'post_type' 		=> 'alerts_post',
		'post_status'       => 'publish',
		'order' => 'DESC'
	));

	if(!empty($alerts)):

		$alert = $alerts[0];
		$alert_meta = get_post_meta($alert->ID);

		$start_date = strtotime($alert_meta['start_date'][0]);
		$end_date 	= strtotime($alert_meta['end_date'][0]);
		$now 		= current_time( 'timestamp' );
		?>

		<?php if ($alert && ((!$start_date && !$end_date) || (($start_date < $now) && !$end_date) || (($start_date < $now) && ($end_date > $now)))): ?>
		<section class="js-alert alert<?php if ( is_admin_bar_showing() ) { ?> admin_alert<?php } ?>" role="alert" data-time="<?php echo date_i18n( 'g:ia', strtotime($alert->post_date) ) ?>">
			    <button class="js-toggle_handle js-alert-close alert_close">
			        <span class="alert_close_label">Close Alert</span>
			        <span class="alert_close_icon">
			            <svg class="icon icon_close">
			                <use xlink:href="<?php tric_icon('close') ?>"></use>
			            </svg>
			        </span>
			    </button>
			    <div class="fs-row">
			        <div class="fs-cell fs-lg-10">
			            <div class="alert_body">
			                <div class="alert_content">
			                    <header class="alert_header">
			                        <h1 class="alert_title">
			                            <span class="alert_title_icon">
			                                <svg class="icon icon_bell">
			                                    <use xlink:href="<?php tric_icon('bell') ?>"></use>
			                                </svg>
			                            </span>
			                            <span class="alert_title_label"><?php echo $alert->post_title; ?></span>
			                        </h1>
			                    </header>
			                    <div class="alert_description">
			                      	<?php echo $alert_meta['blurb'][0] ?>
			                    </div>
			                    <footer class="alert_footer">
			                        <a class="alert_link" <?php tric_tblank( $alert_meta['link_url'][0]) ?> href="<?php echo $alert_meta['link_url'][0] ?>">
			                            <span class="alert_link_label"><?php echo $alert_meta['link_title'][0] ?></span>
			                            <span class="alert_link_icon" aria-hidden="true">
			                                <svg class="icon icon_arrow_right">
			                                    <use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
			                                </svg>
			                            </span>
			                        </a>
			                    </footer>
			                </div>
			            </div>
			        </div>
			    </div>
			</section>
		<?php endif ?>
	<?php endif ?>

<?php restore_current_blog() ?>